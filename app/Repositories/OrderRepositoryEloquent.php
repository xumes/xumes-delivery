<?php

namespace CodeDelivery\Repositories;

use CodeDelivery\Presenters\OrderPresenter;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use CodeDelivery\Repositories\OrderRepository;
use CodeDelivery\Entities\Order;


/**
 * Class OrderRepositoryEloquent
 * @package namespace CodeDelivery\Repositories;
 */
class OrderRepositoryEloquent extends BaseRepository implements OrderRepository
{

    protected $skipPresenter = true;

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Order::class;
    }

    public function getByIdAndDeliveryman($id, $idDeliveryman)
    {
        $result = $this->with(['client', 'items', 'cupom', 'deliveryman'])->findWhere([
                'id' => $id,
                'user_deliveryman_id' => $idDeliveryman
            ]);

        if ($result instanceof Collection){
            $result = $result->first();
        }else{
            if(isset($result['data']) && count($result['data'])==1){
                $result = [
                    'data' => $result['data'][0]
                ];
            }else{
                throw new ModelNotFoundException("Order not found");
            }
        }

        return $result;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function presenter()
    {
        return OrderPresenter::class;
    }

}
