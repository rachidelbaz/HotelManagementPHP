<?php
class enum
{
    public const PENDING = 1;
    public const RESERVED = 2;
    public const PAIED = 3;
    public const CANCELLED = 4;

    public function getEnumValues()
    {
        return [1 => 'PENDING', 2 => 'RESERVED', 3 => 'PAIED', 4 => 'CANCELLED'];
    }
}
