<?php

namespace App\Presenters;

use App\Transformers\UserGroupsTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class UserGroupsPresenter.
 *
 * @package namespace App\Presenters;
 */
class UserGroupsPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new UserGroupsTransformer();
    }
}
