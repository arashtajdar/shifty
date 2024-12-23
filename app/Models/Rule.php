<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rule extends Model
{
    use HasFactory;

    protected $fillable = ['employee_id', 'rule_type', 'rule_data', 'shop_id'];

    protected $casts = [
        'rule_data' => 'array', // Automatically cast JSON to an array
    ];

    public function employee()
    {
        return $this->belongsTo(User::class, 'employee_id');
    }

    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }

}
