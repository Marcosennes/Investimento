<?php

namespace App\Http\Controllers;

use App\Entities\Moviment;
use App\Entities\Product;
use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\MovimentCreateRequest;
use App\Http\Requests\MovimentUpdateRequest;
use App\Repositories\MovimentRepository;
use App\Validators\MovimentValidator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

/**
 * Class MovimentsController.
 *
 * @package namespace App\Http\Controllers;
 */
class MovimentsController extends Controller
{
    /**
     * @var MovimentRepository
     */
    protected $repository;

    /**
     * @var MovimentValidator
     */
    protected $validator;

    /**
     * MovimentsController constructor.
     *
     * @param MovimentRepository $repository
     * @param MovimentValidator $validator
     */
    public function __construct(MovimentRepository $repository, MovimentValidator $validator)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
    }

    public function index()
    {
        return view('moviment.index', [
            'product_list' => Product::all(),
        ]);
    }

    public function all(Moviment $moviment)
    {
        $id_user     = Auth::id();
        
        $moviment_list = $moviment->listar();

        /*                    
        $moviment_list = Auth::user()->moviments;   // Sem paginação
        */
        return view('moviment.all', [
            'moviment_list' => $moviment_list,
        ]);
    }

    public function application(){

        
        /*
        //faço um join da tabela users com user_groups
        $teste = DB::table('users')
        ->join('user_groups', 'user_id', 'users.id')
        ->select('users.id', 'user_groups.group_id')
        ->get();
        
        //faço um join da tabela user_groups com groups
        //faço um join da tabela user_groups com users
        //No final as tres tabelas viram uma só. o campo name de users.name e groups.name se sobrepoem dependendo do select
        //se eu por no select 'users.name', o campo name será o nome do usuário
        //se eu por no select 'groups.name', o campo name será o nome do grupo
        $teste2 = DB::table('user_groups')
        ->join('groups', 'groups.id', 'user_groups.group_id')
        ->join('users', 'users.id', 'user_groups.user_id')
        ->select('*')
        ->get();
        */
        
        $user   = Auth::user();
        $id_user     = Auth::id();
        //faço um join da tabela user_groups com groups enviando na função o id do usuário autenticado no sistema
        //dentro da função do join o where filtra as linhas da tabela para todos os grupos onde o usuário está
        $GLOBALS['id_user'] = $id_user;
        $user_group_list = DB::table('user_groups')
                    ->join('groups', function($join){
                        $join->on('user_groups.group_id', '=', 'groups.id')
                             ->where('user_groups.user_id', '=', $GLOBALS['id_user']);
                    })
                    ->select('groups.id', 'groups.name')
                    ->get();

        $product_list = DB::table('products')
                        ->select('id', 'name')
                        ->get();

        return view('moviment.application', [
            'user_group_list'    => $user_group_list,
            'product_list'  => $product_list,
        ]);
    }

    public function storeApplication(Request $request){

        $movimento = Moviment::create([

            'user_id'       =>Auth::user()->id,
            'group_id'      =>$request->get('group_id'),
            'product_id'    =>$request->get('product_id'),
            'value'         =>$request->get('value'),
            'type'          =>1,                //Movimentação para adição de dinheiro
                                                // 2 é movimentação para resgate de dinheiro
        ]);

        session()->flash('success', [
            'success'   => true,
            'messages'  => "Aplicação de ". $movimento->value ." reais no produto " . $movimento->product->name . " foi realizada com sucesso"    
        ]);
    
        return redirect()->route('moviment.application');
    }

    public function getback(){
        
        $user   = Auth::user();
        $id_user     = Auth::id();

        $GLOBALS['id_user'] = $id_user;
        $user_group_list = DB::table('user_groups')
                    ->join('groups', function($join){
                        $join->on('user_groups.group_id', '=', 'groups.id')
                             ->where('user_groups.user_id', '=', $GLOBALS['id_user']);
                    })
                    ->select('groups.id', 'groups.name')
                    ->get();

        $product_list = DB::table('products')
                        ->select('id', 'name')
                        ->get();

                        
        return view('moviment.getback', [
            'user_group_list'    => $user_group_list,
            'product_list'  => $product_list,
        ]);
    }

    public function storeGetBack(Request $request){

        $user_id     = Auth::id();
        $value_application_list = DB::table('moviments')
                                ->where([
                                    ['user_id', '=', $user_id],
                                    ['product_id', '=', $request->product_id],
                                    ['group_id', '=', $request->group_id],
                                    ['type', '=', 1],
                                ])
                                ->select('value')
                                ->get();
        
        $value_getback_list = DB::table('moviments')
                                ->where([
                                    ['user_id', '=', $user_id],
                                    ['product_id', '=', $request->product_id],
                                    ['group_id', '=', $request->group_id],
                                    ['type', '=', 2],
                                ])
                                ->select('value')
                                ->get();
        $total_application_value = 0;
        $total_getback_value = 0;

        foreach($value_application_list as $array)
        {

            $total_application_value += $array->value;
        }

        foreach($value_getback_list as $array)
        {

            $total_getback_value += $array->value;
        }

        $remaining_value = $total_application_value - $total_getback_value;

        
        $product_name_array = DB::table('products')
                            ->where('id', '=', $request->product_id)
                            ->select('name')
                            ->get();

        $group_name_array = DB::table('groups')
                            ->where('id', '=', $request->group_id)
                            ->select('name')
                            ->get();

        if($remaining_value < $request->value)
        {
            session()->flash('fail', [
                'success'   => false,
                'messages'  => "Resgate de ". $request->value ." reais no produto " . $product_name_array[0]->name . " falhou pois seu saldo neste produto pelo grupo " . $group_name_array[0]->name . " é: R$" . $remaining_value  
            ]);

            return redirect()->route('moviment.getback');
        }
        $movimento = Moviment::create([

            'user_id'       =>Auth::user()->id,
            'group_id'      =>$request->get('group_id'),
            'product_id'    =>$request->get('product_id'),
            'value'         =>$request->get('value'),
            'type'          =>2,                // 1 Movimentação para adição de dinheiro
                                                // 2 Movimentação para resgate de dinheiro
        ]);

        session()->flash('success', [
            'success'   => true,
            'messages'  => "Resgate de ". $movimento->value ." reais no produto " . $movimento->product->name . " pelo grupo " . $group_name_array[0]->name . " foi realizada com sucesso" 
        ]);
    
        return redirect()->route('moviment.getback');
    }

    public function searchMoviments(Request $request, Moviment $moviment)
    {
        $moviment_list = $moviment->search($request->all(), 10);

        return view('moviment.all', [
            'moviment_list' => $moviment_list,
            'dataForm'      => $request->except('_token'),
        ]);
    }
}
