<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsersResponseForm3_15 extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'email',
        'score3_15',
        //'comision3_15',
        'cantPatentes',
        'cantPrototipos',
        'subtotalPatentes',
        'subtotalPrototipos',
        'obsPatentes',
        'obsPrototipos',
        'user_type',


    ];
    protected $table = 'users_response_form3_15';

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->table = 'users_response_form3_15';
        $this->connection = 'mysql';
    }

    public function scopeLatest($query)
    {
        return $query->orderBy('created_at', 'desc')->first();
    }

    public function dictaminadores()
    {
        return $this->belongsToMany(DictaminatorsResponseForm3_15::class, 'dictaminador_docente', 'user_id', 'dictaminator_form_id')
            ->withPivot('form_type')
            ->withTimestamps();
    }
}
