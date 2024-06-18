<?php

namespace App\Services;

use App\Repositories\Product\ProductRepositoryInterface;

class ProductService
{
    public function __construct(
        protected ProductRepositoryInterface $productRepository
    ) {
    }

    public function getProducts()
    {
        return $this->productRepository->getProducts();
    }

    public function findProduct(int $id)
    {
        return $this->productRepository->findProduct($id);
    }

    public function findByCategory(string $category)
    {
        return $this->productRepository->findByCategory($category);
    }

    public function createProduct(array $data)
    {
        return $this->productRepository->createProduct($data);
    }

    public function updateProduct(array $data, int $id)
    {
        return $this->productRepository->updateProduct($data, $id);
    }

    public function deleteProduct(int $id)
    {
        return $this->productRepository->deleteProduct($id);
    }
}
