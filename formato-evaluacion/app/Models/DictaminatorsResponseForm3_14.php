<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DictaminatorsResponseForm3_14 extends Model
{
    use HasFactory;
    protected $fillable = [
        'dictaminador_id',
        'user_id',
        'email',
        'score3_14',
        'comision3_14',
        'cantCongresoInt',
        'cantCongresoNac',
        'cantCongresoLoc',
        'subtotalCongresoInt',
        'subtotalCongresoNac',
        'subtotalCongresoLoc',
        'comisionCongresoInt',
        'comisionCongresoNac',
        'comisionCongresoLoc',
        'obsCongresoInt',
        'obsCongresoNac',
        'obsCongresoLoc',
        'user_type',

    ];

    public $incrementing = false; // Indicates the primary key is not auto-incrementing
    protected $primaryKey = 'dictaminador_id'; // Specifies the primary key
    protected $keyType = 'bigint'; // Specifies the key type


    protected $table = 'dictaminators_response_form3_14';

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->table = 'dictaminators_response_form3_14';
        $this->connection = 'mysql';
    }

    public function scopeLatest($query)
    {
        return $query->orderBy('created_at', 'desc')->first();
    }


}

