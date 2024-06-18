<?php

namespace App\Enum;

enum StatusOrderEnum: string
{
    case EM_ABERTO = 'Em aberto';
    case PAGO = 'Pago';
    case CANCELADO = 'Cancelado';
}
