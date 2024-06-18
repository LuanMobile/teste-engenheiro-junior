<?php

namespace App\Repositories\Order;

interface OrderRepositoryInterface
{
    public function getOrders();
    public function createOrder(array $data, int $client_id);
    public function createOrderProduct(array $data, int $pedido_id);
    public function updateOrder(array $data, int $client_id, int $pedido_id);
    public function findOrder(int $client_id);
    public function deleteOrder(int $client_id, int $pedido_id);
    public function getValorTotalProdutos(int $produto_id, array $item);
    public function calcula_valor_total_pedidos(int $client_id);
    public function apllydiscount(int $desconto, float $valor_total);
}
