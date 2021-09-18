<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expenses extends Model
{
    use HasFactory;
    protected $fillable = [
        "expense_category_id",
        "expense_category",
        "expense_amount",
        "entry_date"
    ];
}
