<?php

class Format
{
    public static function formatMoneyValue($value) {
        $numberFormatter = new NumberFormatter('pt_BR', NumberFormatter::CURRENCY);
        return $numberFormatter->formatCurrency($value, "BRL");
    }
}