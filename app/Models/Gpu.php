<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gpu extends Model
{
    use HasFactory;
    protected $table = 'gpu_data';
    public $timestamps = false;
    protected $primaryKey = 'gpu_id';
    protected $fillable = ['gpu_name','G3Dmark','G2Dmark','price','gpu_value','TDP','power_performance','test_date','category'];
}
