<?php

namespace App\Enum;

enum DiscountEnum: int
{
    case PRIMEIRACOMPRA15 = 15;
    case DESCONTOOFF20 = 20;
    case DESCONTOOFF30 = 30;
    case DESCONTOOFF50 = 50;
}
