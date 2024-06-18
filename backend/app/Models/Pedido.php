<?php

namespace App\Models;

use App\Enum\StatusOrderEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pedido extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'status',
        'dt_pedido',
        'desconto',
        'valor_total'
    ];

    public function users(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function itens(): HasMany
    {
        return $this->hasMany(PedidoProduto::class);
    }

    protected function casts(): array
    {
        return [
            'dt_pedido' => 'datetime:d-m-Y H:i:s',
            'status'    => StatusOrderEnum::class
        ];
    }
}
