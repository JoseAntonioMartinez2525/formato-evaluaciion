<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DictaminatorsResponseForm3_13 extends Model
{
    use HasFactory;
    protected $fillable = [
        'dictaminador_id',
        'user_id',
        'email',
        'score3_13',
        'comision3_13',
        'cantInicioFinanExt',
        'subtotalInicioFinanExt',
        'comisionInicioFinancimientoExt',
        'obsInicioFinancimientoExt',
        'cantInicioInvInterno',
        'subtotalInicioInvInterno',
        'comisionInicioInvInterno',
        'obsInicioInvInterno',
        'cantReporteFinanciamExt',
        'subtotalReporteFinanciamExt',
        'comisionReporteFinanciamExt',
        'obsReporteFinanciamExt',
        'cantReporteInvInt',
        'subtotalReporteInvInt',
        'comisionReporteInvInt',
        'obsReporteInvInt',
        'user_type',

    ];

    public $incrementing = false; // Indicates the primary key is not auto-incrementing
    protected $primaryKey = 'dictaminador_id'; // Specifies the primary key
    protected $keyType = 'bigint'; // Specifies the key type


    protected $table = 'dictaminators_response_form3_13';

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->table = 'dictaminators_response_form3_13';
        $this->connection = 'mysql';
    }

    public function scopeLatest($query)
    {
        return $query->orderBy('created_at', 'desc')->first();
    }


}

