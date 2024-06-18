<?php

namespace App\Repositories\Product;

interface ProductRepositoryInterface
{
    public function getProducts();
    public function createProduct(array $data);
    public function updateProduct(array $data, int $id);
    public function deleteProduct(int $id);
    public function findProduct(int $id);
    public function findByCategory(string $category);
}
