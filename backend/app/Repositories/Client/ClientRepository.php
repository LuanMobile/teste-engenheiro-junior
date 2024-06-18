<?php

namespace App\Repositories\Client;

use App\Http\Resources\UserCollection;
use App\Models\User;

class ClientRepository implements ClientRepositoryInterface
{
    public function fetchAll()
    {
        return new UserCollection(User::paginate(20));
    }

    public function create(array $data)
    {
        return User::create($data);
    }

    public function update(array $data, $id)
    {
        $client = User::find($id);
        $client->update($data);
        return $client;
    }

    public function delete($id)
    {
        $client = User::findOrFail($id);
        $client->delete();
    }

    public function find($id)
    {
        return User::find($id);
    }
}
