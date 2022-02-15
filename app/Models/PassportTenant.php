<?php

namespace App\Models;

class PassportTenant extends Tenant {
    protected $primaryKey = 'uuid';
    protected $keyType = 'string';
    public $incrementing = false;
}
