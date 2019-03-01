<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

class APIModel
{
    public static function music($id)
    {
        return DB::table('lingfm')
                     ->where('id', $id)
                     ->first();
    }

    public static function musicRand()
    {
        return DB::table('lingfm')
                 ->inRandomOrder()
                 ->take(1)
                 ->first();
    }

    public static function count()
    {
        return DB::table('lingfm')->count();
    }

    public static function search($name)
    {
        return DB::table('lingfm')
                     ->where('name', 'like', '%' . $name . '%')
                     ->orderBy('id', 'desc')
                     ->get();
    }
}