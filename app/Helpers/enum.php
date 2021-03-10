<?php
class enum
{
    const PENDING = 1;
    const RESERVED = 2;
    const PAIED = 3;
    const CANCELLED = 4;

    public function getEnumValues()
    {
        return ['PENDING', 'RESERVED', 'PAIED', 'CANCELLED'];
    }
}
