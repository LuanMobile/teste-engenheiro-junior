<?php

namespace App\Services;

use App\Models\Produto;
use App\Repositories\Order\OrderRepositoryInterface;

class OrderService
{
    public function __construct(
        protected OrderRepositoryInterface $orderRepository
    ) {
    }

    public function createOrder(array $data, int $id)
    {
        return $this->orderRepository->createOrder($data, $id);
    }

    public function createOrderProduct(array $data, int $pedido_id)
    {
        return $this->orderRepository->createOrderProduct($data, $pedido_id);
    }

    public function updateOrder(array $data, int $id, int $pedido_id)
    {
        return $this->orderRepository->updateOrder($data, $id, $pedido_id);
    }

    public function getOrders()
    {
        return $this->orderRepository->getOrders();
    }

    public function findOrder($client_id)
    {
        return $this->orderRepository->findOrder($client_id);
    }

    public function deleteOrder($client_id, $pedido_id)
    {
        return $this->orderRepository->deleteOrder($client_id, $pedido_id);
    }

    public function getValorTotalProdutos($produtoId, $item)
    {
        $produto = Produto::select('price')->where('id', '=', $produtoId)->first();
        $valorTotal = floatval($produto->price) * $item;

        return $valorTotal;
    }

    public function calcula_valor_total_pedidos(int $client_id)
    {
        return $this->orderRepository->calcula_valor_total_pedidos($client_id);
    }
}
