<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Produto extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'cod_sku',
        'price',
        'category'
    ];

    public function pedidoProdutos(): HasMany
    {
        return $this->hasMany(PedidoProduto::class);
    }
}
