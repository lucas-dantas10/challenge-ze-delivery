<?php

namespace App\Infrastructure\Exception\Partner;

use App\Domain\Exception\Partner\PartnerNotCreatedInterface;

class PartnerNotCreated extends \Exception implements PartnerNotCreatedInterface
{
    public static function getMessageError(): string
    {
        return "Erro na criação do Parceiro!";
    }
}
