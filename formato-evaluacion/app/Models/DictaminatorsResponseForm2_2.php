<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DictaminatorsResponseForm2_2 extends RulesForm2_2
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'email',
        'actv2Comision',
        'obs2',
        'obs2_2',

    ];

    protected $table = 'dictaminators_response_form2_2';

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->table = 'dictaminators_response_form2_2';
        $this->connection = 'mysql';
    }

    public function scopeLatest($query)
    {
        return $query->orderBy('created_at', 'desc')->first();
    }


}




