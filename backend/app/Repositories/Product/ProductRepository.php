<?php

namespace App\Repositories\Product;

use App\Models\Produto;
use App\Http\Resources\ProdutoCollection;

class ProductRepository implements ProductRepositoryInterface
{

    public function getProducts()
    {
        return new ProdutoCollection(Produto::paginate(20));
    }

    public function findProduct($id)
    {
        return Produto::find($id);
    }

    public function findByCategory(string $category)
    {
        return Produto::where('category', 'ILIKE', $category)->paginate(20);
    }

    public function createProduct(array $data)
    {
        $product = Produto::create($data);
        return $product;
    }

    public function updateProduct(array $data, int $id)
    {
        $product = Produto::find($id);
        $productUpdated = $product->update($data);
        return $productUpdated;
    }

    public function deleteProduct(int $id)
    {
        $product = Produto::findOrFail($id);
        $product->delete();
    }
}
