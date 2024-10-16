<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DictaminatorsResponseForm3_16 extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'dictaminador_id',
        'user_id',
        'email',
        'score3_16',
        'comision3_16',
        'cantArbInt',
        'cantArbNac',
        'cantPubInt',
        'cantPubNac',
        'cantRevInt',
        'cantRevNac',
        'cantRevista',                      
        'subtotalArbInt',
        'subtotalArbNac',
        'subtotalPubInt',
        'subtotalPubNac',
        'subtotalRevInt',
        'subtotalRevNac',
        'subtotalRevista',
        'comisionArbInt',
        'comisionArbNac',
        'comisionPubInt',
        'comisionPubNac',
        'comisionRevInt',
        'comisionRevNac',
        'comisionRevista',
        'obsArbInt',
        'obsArbNac',
        'obsPubInt',
        'obsPubNac',
        'obsRevInt',
        'obsRevNac',
        'obsRevista',
        'user_type',

    ];

    public $incrementing = true; // Indicates the primary key is not auto-incrementing
    protected $primaryKey = 'id'; // Specifies the primary key
    //protected $keyType = 'bigint'; // Specifies the key type


    protected $table = 'dictaminators_response_form3_16';
    public function user()
    {
        return $this->belongsTo(User::class, 'dictaminador_id', 'id');
    }

    public function usersResponseForm1()
    {
        return $this->belongsTo(UsersResponseForm1::class, 'user_id', 'user_id');
    }
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->table = 'dictaminators_response_form3_16';
        $this->connection = 'mysql';
    }

    public function scopeLatest($query)
    {
        return $query->orderBy('created_at', 'desc')->first();
    }


}


