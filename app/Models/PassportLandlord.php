<?php

namespace App\Models;

class PassportLandlord extends Landlord {
    protected $primaryKey = 'uuid';
    protected $keyType = 'string';
    public $incrementing = false;
}
