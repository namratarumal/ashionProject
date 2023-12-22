<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class inward extends Model
{
    use HasFactory;
    protected $fillable=['pid','stock','date'];
    
}
