<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Breakfast extends Model
{
    protected $table = "tbl_breakfast";

    public static function breakfastData()
    {
        return Breakfast::all();
    }
}
