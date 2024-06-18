<?php

namespace App\Http\Resources;

use App\Models\Pedido;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class PedidoCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        if ($request->server('REQUEST_URI') == '/api/order/all')
            return parent::toArray($request);

        return [
            'data' => $this->where('user_id', auth()->id())->all()
        ];
    }

    public function paginationInformation($request, $paginated, $default)
    {
        unset($default['meta']['links']);

        return $default;
    }
}
