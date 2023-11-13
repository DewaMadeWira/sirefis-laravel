<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gpu_recom extends Model
{
    use HasFactory;
    protected $table = 'gpu_recommendation';
    public $timestamps = false;
    protected $primaryKey = 'recommendation_id';
    protected $fillable = ['recommendation_id', 'best_gpu', 'similar_1', 'recommendation_date'];
}
