<?php

namespace App\Repositories\Order;

use App\Http\Resources\PedidoCollection;
use App\Models\Pedido;
use App\Models\PedidoProduto;
use App\Models\Produto;
use Carbon\Carbon;

class OrderRepository implements OrderRepositoryInterface
{
    public function getOrders()
    {
        return new PedidoCollection(Pedido::paginate(20));
    }

    public function findOrder($client_id)
    {
        $pedidos = Pedido::where('user_id', '=', $client_id)->get();
        #dd($pedidos->all());
        return $pedidos;
    }

    public function createOrder(array $data, int $client_id)
    {
        $pedido = Pedido::create([
            'user_id'       => $client_id,
            'status'        => 'Em aberto',
            'dt_pedido'     => Carbon::now('America/Sao_Paulo'),
            'desconto'      => $data['desconto'] ?? null,
        ]);

        return $pedido;
    }

    public function createOrderProduct(array $data, int $pedido_id)
    {
        PedidoProduto::create([
            'pedido_id'     => $pedido_id,
            'produto_id'    => $data['produto_id'],
            'quantidade'    => (int) $data['quantidade'],
            'valor'         => $this->getValorTotalProdutos($data['produto_id'], $data['quantidade'])
        ]);
    }

    public function updateOrder(array $data, int $client_id, int $pedido_id)
    {
        $pedido = Pedido::where('id', '=', $pedido_id)
            ->where('user_id', $client_id)
            ->update($data);

        return $pedido;
    }


    public function deleteOrder(int $client_id, int $pedido_id)
    {
        Pedido::where('id', $pedido_id)
            ->where('user_id', auth()->id())
            ->delete();
    }

    public function getValorTotalProdutos(int $produto_id, $total_itens)
    {
        $produto = Produto::select('price')->where('id', '=', $produto_id)->first();
        $valorTotal = floatval($produto->price) * $total_itens;

        return $valorTotal;
    }

    public function calcula_valor_total_pedidos(int $client_id)
    {
        $pedidos = Pedido::where('user_id', '=', $client_id)
            ->with('itens')
            ->get();

        foreach ($pedidos as $pedido) {
            $valorTotal = $pedido->itens->sum('valor');

            if (is_null($pedido->desconto)) {
                $pedido->valor_total = $valorTotal;
                $pedido->save();
            }

            $pedido->valor_total = $this->apllydiscount($pedido->desconto, $valorTotal);
            $pedido->save();
        }
    }

    public function apllydiscount($discount, $valorTotal)
    {
        $discountApplied = (($discount / 100) * $valorTotal);
        $valuediscounted = $valorTotal - $discountApplied;

        return $valuediscounted;
    }
}
