<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestGpu extends Model
{
    use HasFactory;
    protected $table = 'request_gpu';
    public $timestamps = false;
    protected $primaryKey = 'request_id';
    protected $fillable = ['gpu_id','company_id'];
}