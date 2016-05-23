<?php

namespace CodeDelivery\Transformers;

use League\Fractal\TransformerAbstract;
use CodeDelivery\Entities\Client;

/**
 * Class ClientTransformer
 * @package namespace CodeDelivery\Transformers;
 */
class ClientTransformer extends TransformerAbstract
{

    protected $defaultIncludes = ['user'];

    /**
     * Transform the \Client entity
     * @param \Client $model
     *
     * @return array
     */
    public function transform(Client $model)
    {
        return [

            'phone'       => $model->phone,
            'address'      => $model->address,
            'zipcode'       => $model->zipcode,
            'city'       => $model->city,
            'state'       => $model->state,

        ];
    }

    public function includeUser(Client $model)
    {
        return $this->item($model->user, new UserTransformer());
    }

}

