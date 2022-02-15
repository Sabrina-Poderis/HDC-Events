<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Establishment extends Model{
    use SoftDeletes;

    protected $table = "establishment";

    protected $fillable = [
        'name',
        'cnpj',
        'address',
        'address_number',
        'address_addon',
        'district',
        'city',
        'uf',
        'cep'
    ];
}