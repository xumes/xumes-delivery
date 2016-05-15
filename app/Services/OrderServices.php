<?php

namespace CodeDelivery\Services;




use CodeDelivery\Repositories\CupomRepository;
use CodeDelivery\Repositories\OrderRepository;
use CodeDelivery\Repositories\ProductRepository;
use Illuminate\Support\Facades\DB;

class OrderServices
{
    /**
     * @var OrderRepository
     */
    private $orderRepository;
    /**
     * @var CupomRepository
     */
    private $cupomRepository;
    /**
     * @var ProductRepository
     */
    private $productRepository;

    /**
     * OrderServices constructor.
     * @param OrderRepository $orderRepository
     * @param CupomRepository $cupomRepository
     * @param ProductRepository $productRepository
     */
    public function __construct(
                                    OrderRepository $orderRepository,
                                    CupomRepository $cupomRepository,
                                    ProductRepository $productRepository
                                    )
        {

            $this->orderRepository = $orderRepository;
            $this->cupomRepository = $cupomRepository;
            $this->productRepository = $productRepository;
        }

    public function create(array $data)
    {
        DB::beginTransaction();
        try {
            $data['status'] = 0;
            if(isset($data['cupom_code'])){
                $cupom = $this->cupomRepository->findByField('code', $data['cupom_code'])->first();
                $data['cupomj_id'] = $cupom->id;
                $cupom->used = 1;
                $cupom->save();
                unset($data['cupom_code']);
            }

            $items = $data['items'];
            unset($data['items']);

            $data['total'] = $total = 0;
            $order = $this->orderRepository->create($data);

            foreach ($items as $item){

                $item['price'] = $this->productRepository->find($item['product_id'])->price;
                $order->items()->create($item);
                $total += $item['price'] * $item['qtd'];
            }

            $order->total = $total;
            if(isset($cupom)){
                $order->total = $total - $cupom->value;
            }

            $order->save();
            DB::commit();
            return $order;

        } catch(\Exception $e) {
            DB::rollback();
            throw $e;
        }


    }

}