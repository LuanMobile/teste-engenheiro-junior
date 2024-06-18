<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProdutoCollection;
use App\Models\Produto;
use App\Repositories\Product\ProductRepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{

    public function __construct(
        protected ProductRepositoryInterface $service
    ) {
    }
    public function index()
    {
        if (empty($this->service->getProducts())) return response()->json([
            'status' => 'error',
            'message' => 'Nenhum produto encontrado'
        ], 404);
        return response()->json($this->service->getProducts());
    }

    public function store(ProductRequest $request)
    {
        try {
            $product = $this->service->createProduct($request->all());

            return response()->json([
                'message'   => 'Produto criado com sucesso',
                'data'      => $product
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status'    => 'error',
                'message'   => 'Erro ao criar Produto: ' . $e->getMessage()
            ], 500);
        }
    }

    public function findById(int $id)
    {
        $product = $this->service->findProduct($id);
        if (!$product) return response()->json([
            'status'    => 'error',
            'message'   => 'Produto não encontrado'
        ], 404);

        return response()->json([
            'status'    => 'success',
            'data'      => $product
        ]);
    }

    public function findByCategory(string $category)
    {
        $products = $this->service->findByCategory($category);

        if (!$products->all()) return response()->json([
            'status'    => 'error',
            'message'   => 'Não foi encontrado produtos dessa categoria'
        ], 404);

        return new ProdutoCollection($products);
    }

    public function update(Request $request, Produto $produto, $id)
    {
        $request->validate([
            'name'          => ['nullable', 'string', 'max:100'],
            'description'   => ['nullable', 'string', 'max:220'],
            'cod_sku'       => ['nullable', 'string', 'max:20'],
            'price'         => ['nullable', 'numeric', 'decimal:2'],
            'category'      => ['nullable', 'string', 'max:10']
        ]);

        $product = $this->service->updateProduct($request->all(), $id);
        if (!$product) return response([
            'status'    => 'error',
            'message'   => 'Erro ao atualizar produto'
        ], 500);

        return response()->json([
            'status'    => 'success',
            'message'   => 'Produto atualizado com sucesso'
        ]);
    }

    public function destroy($id)
    {
        try {
            $this->service->deleteProduct($id);

            return response()->json(['message' => 'Produto deletado com sucesso.']);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Produto não encontrado: ' . $e->getMessage()], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao deletar o produto: ' . $e->getMessage()], 500);
        }
    }
}
