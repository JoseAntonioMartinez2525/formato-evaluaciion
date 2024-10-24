<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DictaminatorsResponseForm3_18 extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'dictaminador_id',
        'user_id',
        'email',
        'score3_18',
        'comision3_18',
        'cantComOrgInt',
        'cantComOrgNac',
        'cantComOrgReg',
        'cantComApoyoInt',
        'cantComApoyoNac',
        'cantComApoyoReg',
        'cantCicloComOrgInt',
        'cantCicloComOrgNac',
        'cantCicloComOrgReg',
        'cantCicloComApoyoInt',
        'cantCicloComApoyoNac',
        'cantCicloComApoyoReg',
        'subtotalComOrgInt',
        'subtotalComOrgNac',
        'subtotalComOrgReg',
        'subtotalComApoyoInt',
        'subtotalComApoyoNac',
        'subtotalComApoyoReg',
        'subtotalCicloComOrgInt',
        'subtotalCicloComOrgNac',
        'subtotalCicloComOrgReg',
        'subtotalCicloComApoyoInt',
        'subtotalCicloComApoyoNac',
        'subtotalCicloComApoyoReg',
        'obsComOrgInt',
        'obsComOrgNac',
        'obsComOrgReg',
        'obsComApoyoInt',
        'obsComApoyoNac',
        'obsComApoyoReg',
        'obsCicloComOrgInt',
        'obsCicloComOrgNac',
        'obsCicloComOrgReg',
        'obsCicloComApoyoInt',
        'obsCicloComApoyoNac',
        'obsCicloComApoyoReg',
        'comisionComOrgInt',
        'comisionComOrgNac',
        'comisionComOrgReg',
        'comisionComApoyoInt',
        'comisionComApoyoNac',
        'comisionComApoyoReg',
        'comisionCicloComOrgInt',
        'comisionCicloComOrgNac',
        'comisionCicloComOrgReg',
        'comisionCicloComApoyoInt',
        'comisionCicloComApoyoNac',
        'comisionCicloComApoyoReg',        
        'user_type',

    ];

    public $incrementing = true; // Indicates the primary key is not auto-incrementing
    protected $primaryKey = 'id'; // Specifies the primary key
    //protected $keyType = 'bigint'; // Specifies the key type


    protected $table = 'dictaminators_response_form3_18';
    public function user()
    {
        return $this->belongsTo(User::class, 'dictaminador_id', 'id');
    }

    public function usersResponseForm1()
    {
        return $this->belongsTo(UsersResponseForm1::class, 'user_id', 'user_id');
    }

    public function docentes()
    {
        return $this->belongsToMany(UsersResponseForm3_18::class, 'dictaminador_docente', 'dictaminator_form_id', 'user_id')
            ->withPivot('form_type')
            ->withTimestamps();
    }
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->table = 'dictaminators_response_form3_18';
        $this->connection = 'mysql';
    }

    public function scopeLatest($query)
    {
        return $query->orderBy('created_at', 'desc')->first();
    }


}


