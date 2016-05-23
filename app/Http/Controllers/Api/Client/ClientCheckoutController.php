<?php

namespace CodeDelivery\Http\Controllers\Api\Client;

use CodeDelivery\Http\Controllers\Controller;
use CodeDelivery\Repositories\OrderRepository;
use CodeDelivery\Repositories\ProductRepository;
use CodeDelivery\Repositories\UserRepository;
use CodeDelivery\Services\OrderServices;
use Illuminate\Http\Request;

use CodeDelivery\Http\Requests;
use LucaDegasperi\OAuth2Server\Authorizer;

class ClientCheckoutController extends Controller
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
     * @var ProductRepository
     */
    private $productRepository;
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
     * @param ProductRepository $productRepository
     * @param OrderServices $orderServices
     * @param Authorizer $authorizer
     */
    public function __construct(
                                OrderRepository $repository,
                                UserRepository $userRepository,
                                ProductRepository $productRepository,
                                OrderServices $orderServices,
                                Authorizer $authorizer
                                )
    {
        $this->repository = $repository;
        $this->userRepository = $userRepository;
        $this->productRepository = $productRepository;
        $this->orderServices = $orderServices;
        $this->authorizer = $authorizer;
    }

    public function index()
    {

        $id = $this->authorizer->getResourceOwnerId();
        $clientId = $this->userRepository->find($id)->client->id;
        $orders = $this->repository
            ->skipPresenter(false)
            ->with($this->with)
            ->scopeQuery(function($query) use($clientId){
          return $query->where('client_id', '=', $clientId);
        })->paginate();

        return $orders;
    }

    public function store(Requests\CheckoutRequest $request)
    {
        $data = $request->all();
        $id = $this->authorizer->getResourceOwnerId();
        $clientId = $this->userRepository->find($id)->client->id;
        $data['client_id'] = $clientId;
        $order = $this->orderServices->create($data);

        return $this->repository
            ->skipPresenter(false)
            ->with($this->with)
            ->find($order->id);
    }

    public function show($id)
    {
        $order = $this->repository
            ->skipPresenter(false)
            ->with($this->with)
            ->find($id);

        return $order;
}

}
