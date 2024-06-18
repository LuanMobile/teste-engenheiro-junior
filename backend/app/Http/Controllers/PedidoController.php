<?php

namespace App\Http\Controllers;

use App\Enum\DiscountEnum;
use App\Enum\StatusOrderEnum;
use App\Models\Pedido;
use App\Repositories\Order\OrderRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PedidoController extends Controller
{
    public function __construct(
        protected OrderRepositoryInterface $service
    ) {
    }
    public function index()
    {
        if (empty($this->service->getOrders())) return response()->json([
            'status'    => 'error',
            'message'   => 'Nenhum pedido encontrado'
        ], 404);
        return $this->service->getOrders();
    }

    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'itens'              => 'required|array',
                'itens.*.produto_id' => 'required|exists:produtos,id',
                'itens.*.quantidade' => 'required|numeric|min:1',
                'desconto'           => ['nullable', 'integer', Rule::enum(DiscountEnum::class)],
            ]);

            $pedido = $this->service->createOrder($validatedData, auth()->id());

            foreach ($validatedData['itens'] as $item) {
                $this->service->createOrderProduct($item, $pedido->id);
            }

            // calcula o valor total dos pedidos e salva no banco.
            $this->service->calcula_valor_total_pedidos(auth()->id());

            return response()->json([
                'status'    => 'success',
                'message'   => 'Pedido criado com sucesso'
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status'    => 'error',
                'message'   => 'Erro ao criar Pedido: ' . $e->getMessage()
            ], 500);
        }
    }

    public function findByClient()
    {
        $orders = $this->service->findOrder(auth()->id());

        if (!$orders->all()) return response()->json([
            'status'    => 'error',
            'message'   => 'Nenhum pedido encontrado para esse cliente'
        ], 404);

        return response()->json($orders);
    }

    public function update(Request $request, int $pedidoId)
    {
        $request->validate([
            'status' => ['required', Rule::enum(StatusOrderEnum::class)],
        ]);

        $pedido = $this->service->updateOrder($request->all(), $request->user()->id, $pedidoId);
        if (!$pedido) return response()->json([
            'error'     => 'error',
            'message'   => 'Erro ao atualizar pedido'
        ]);

        return response()->json([
            'status'    => 'success',
            'message'   => 'Pedido Atualizado com sucesso'
        ]);
    }

    public function destroy(int $pedido_id)
    {
        $deletedRows = $this->service->deleteOrder(auth()->id(), $pedido_id);

        if ($deletedRows > 0) {
            return response()->json(['message' => 'Pedido deletado com sucesso.']);
        }

        return response()->json(['error' => 'Pedido não encontrado.'], 404);
    }
}
