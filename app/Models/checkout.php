<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class checkout extends Model
{
    use HasFactory;
    protected $fillable=['name','country','address','streetaddress','city','state','pincode','contact','email','product_name','total_bill','payment'];
}
