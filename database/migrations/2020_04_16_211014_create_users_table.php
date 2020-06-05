<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateUsersTable.
 */
class CreateUsersTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table) {
            $table->increments('id');
			$table->string('cpf',11)->unique()->nullable();
			$table->string('name', 90);
			$table->char('phone',11);
			$table->date('birth')->nullable();
			$table->char('gender', 1)->nullable();
			$table->text('notes')->nullable();
			
			$table->string('email',80)->unique();
			$table->string('password',254)->nullable();

			$table->string('status')->default('active');
			$table->string('permission')->default('app.user');
			
			$table->rememberToken();
			/*
			 * Evitar de usar. o destroy e editar no método UsersController foram implementados de forma diferente
			 * pois o softDeletes afeta os dois. Ele não apaga os arquivos simplesmente adiciona deleted_at aquele registro
			 *  e o sistema não lê ele mais, mas no banco ele aparece só que com o campo deleted_at com a data em que foi mandado remover.
			 */
			$table->softDeletes();
			$table->timestamps();
		
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('users', function(Blueprint $table) {
			
		});
		Schema::drop('users');
	}
}
 