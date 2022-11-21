<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class turboTradeInfo extends Model
{
    use HasFactory;

    protected $fillable = ['vin', 'body', 'username', 'address'];
}
