<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\UserGroups;

/**
 * Class UserGroupsTransformer.
 *
 * @package namespace App\Transformers;
 */
class UserGroupsTransformer extends TransformerAbstract
{
    /**
     * Transform the UserGroups entity.
     *
     * @param \App\Entities\UserGroups $model
     *
     * @return array
     */
    public function transform(UserGroups $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
