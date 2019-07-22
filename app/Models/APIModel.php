<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

class APIModel
{
    public static function music($id)
    {
        return DB::table('playlist')
                     ->where('id', $id)
                     ->first();
    }

    public static function musicLocal($id)
    {
        return DB::table('musicLocal')
                     ->select('localURL')
                     ->where('id', $id)
                     ->first();
    }

    public static function musicNetease($id)
    {
        return DB::table('musicNetease')
                     ->select('neteaseID')
                     ->where('id', $id)
                     ->first();
    }

    public static function musicRand()
    {
        return DB::table('playlist')
                 ->inRandomOrder()
                 ->take(1)
                 ->first();
    }

    public static function count()
    {
        return DB::table('playlist')->count();
    }

    public static function search($name)
    {
        return DB::table('playlist')
                     ->select('id', 'name')
                     ->where('name', 'like', '%' . $name . '%')
                     ->orderBy('id', 'desc')
                     ->get();
    }
}