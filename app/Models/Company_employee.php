<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company_employee extends Model
{
    use HasFactory;
    protected $table = 'company_employee';
    public $timestamps = false;
    protected $primaryKey = 'employee_id';
    protected $fillable = ['employee_name','employee_email','password','company_id','company_id'];
}