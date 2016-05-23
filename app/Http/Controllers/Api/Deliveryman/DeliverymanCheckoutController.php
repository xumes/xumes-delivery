<?php

namespace CodeDelivery\Http\Controllers\Api\Deliveryman;

use CodeDelivery\Http\Controllers\Controller;
use CodeDelivery\Repositories\OrderRepository;

use CodeDelivery\Repositories\UserRepository;
use CodeDelivery\Services\OrderServices;
use Illuminate\Http\Request;

use CodeDelivery\Http\Requests;
use LucaDegasperi\OAuth2Server\Authorizer;

class DeliverymanCheckoutController extends Controller
{

    private $with = ['client', 'items', 'cupom', 'deliveryman'];

    /**
     * @var OrderRepository
     */
    private $repository;
    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * @var OrderServices
     */
    private $orderServices;
    /**
     * @var Authorizer
     */
    private $authorizer;

    /**
     * CheckoutController constructor.
     * @param OrderRepository $repository
     * @param UserRepository $userRepository
     * @param OrderServices $orderServices
     * @param Authorizer $authorizer
     */
    public function __construct(
                                OrderRepository $repository,
                                UserRepository $userRepository,
                                OrderServices $orderServices,
                                Authorizer $authorizer
                                )
    {
        $this->repository = $repository;
        $this->userRepository = $userRepository;
        $this->orderServices = $orderServices;
        $this->authorizer = $authorizer;
    }

    public function index()
    {

        $id = $this->authorizer->getResourceOwnerId();
        $orders = $this->repository
            ->skipPresenter(false)
            ->with($this->with)
            ->scopeQuery(function($query) use($id){
          return $query->where('user_deliveryman_id', '=', $id);
        })->paginate();

        return $orders;
    }


    public function show($id)
    {
        $deliverymanId = $this->authorizer->getResourceOwnerId();

        return $this->repository
            ->skipPresenter(false)
            ->getByIdAndDeliveryman($id, $deliverymanId);
    }
    
    public function updateStatus(Request $request,  $id)
    {
        $deliverymanId = $this->authorizer->getResourceOwnerId();
        $order = $this->orderServices->updateStatus($id, $deliverymanId, $request->get('status'));
        if ($order){
            return $this->repository->find($order->id);
        }
        abort(400, 'Order not found');
    }

}
