<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    use HasFactory;
    protected $primaryKey = 'iso';
    public $incrementing = false;

    protected $table = 'currencies';
    protected $fillable = ['iso','created_at','updated_at'];
    protected $hidden = ['created_at','updated_at'];
    public $timestamps = true;

}
