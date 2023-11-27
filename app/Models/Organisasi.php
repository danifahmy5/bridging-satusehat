<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organisasi extends Model
{
    use HasFactory; 
    protected $table = 'organisasi';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'identifier',
        'value_identifier',
        'pathOf',
        'organitation_name',
        'ihs',
        'typecode',
        'typedisplay',
        'address_type',
        'address_use',
        'address_text',
        'address_line',
        'address_city', 
    ];
}
