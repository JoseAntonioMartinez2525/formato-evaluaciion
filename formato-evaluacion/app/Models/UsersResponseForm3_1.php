<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsersResponseForm3_1 extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'email',
        'elaboracion',
        'elaboracionSubTotal1',
        'elaboracion2',
        'elaboracionSubTotal2',
        'elaboracion3',
        'elaboracionSubTotal3',
        'elaboracion4',
        'elaboracionSubTotal4',
        'elaboracion5',
        'elaboracionSubTotal5',        
        'score3_1',
        'obs3_1_1',
        'obs3_1_2',
        'obs3_1_3',
        'obs3_1_4',
        'obs3_1_5',
        'user_type',
        'form_type',
    ];


    protected $table = 'users_response_form3_1';

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->table = 'users_response_form3_1';
        $this->connection = 'mysql';
    }

    public function scopeLatest($query)
    {
        return $query->orderBy('created_at', 'desc')->first();
    }


    public function dictaminadores()
    {
        return $this->morphedByMany(
            DictaminatorsResponseForm3_1::class,    // Modelo objetivo
            'id_type',                    // Nombre del campo morph
            'dictaminador_docente',               // Nombre de la tabla pivot
            'user_id',                            // Llave de la tabla de usuarios
            'dictaminador_form_id'                // Llave de la tabla objetivo en la relación polimórfica
        )
            ->withPivot('form_type', 'docente_email') // Campos adicionales en la tabla pivot
            ->withTimestamps();
    }

}