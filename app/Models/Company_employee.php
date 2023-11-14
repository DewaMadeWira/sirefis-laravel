<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company_employee extends Model
{
    use HasFactory;
    protected $table = 'company_employee';
    public $timestamps = false;
    protected $primaryKey = 'company_employee_id';
    protected $fillable = ['company_employee_id','employee_id','company_id'];
}