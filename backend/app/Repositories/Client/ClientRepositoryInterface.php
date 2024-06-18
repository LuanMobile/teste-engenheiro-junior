<?php

namespace App\Repositories\Client;

interface ClientRepositoryInterface
{
    public function fetchAll();
    public function create(array $data);
    public function update(array $data, int $id);
    public function delete(int $id);
    public function find(int $id);
}
