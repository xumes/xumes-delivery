<?php

namespace CodeDelivery\Http\Controllers;

use CodeDelivery\Repositories\OrderRepository;
use CodeDelivery\Repositories\UserRepository;
use Illuminate\Http\Request;

use CodeDelivery\Http\Requests;

class OrderController extends Controller
{
    /**
     * @var OrderRepository
     */
    private $repository;

    /**
     * OrderController constructor.
     * @param OrderRepository $repository
     */
    public function __construct(OrderRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        $orders = $this->repository->paginate(3);

        return view('admin.orders.index', compact('orders'));
    }

    public function edit($id, UserRepository $userRepository)
    {

        $list_status = [0=>'Pending', 1=>'Delivery in Progress', 2=>'Delivered', 3=>'Canceled'];
        $order= $this->repository->find($id);

        $deliveryman = $userRepository->getDeliverymen(['role'=> 'deliveryman'], ['name', 'id']);

        return view('admin.orders.edit', compact('order', 'list_status', 'deliveryman'));
    }

    public function update(Request $request, $id)
    {
        $all = $request->all();
        $this->repository->update($all, $id);
        return redirect()->route('admin.orders.index');
    }
}
