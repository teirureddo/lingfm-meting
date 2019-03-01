<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\APIModel;

class APIController extends Controller
{
    public function music(Request $request)
    {
        $id = $request->input('id');

        if(is_numeric($id))
        {
            $results = APIModel::music($id);

            if($results)
            {
                return response()->json([
                    'id' => (string)$results->id,
                    'name' => $results->name,
                    'music' => $results->music,
                    'image' => $results->image
                ]);
            }
        }

        $results = APIModel::musicRand();

        return response()->json([
            'id' => (string)$results->id,
            'name' => $results->name,
            'music' => $results->music,
            'image' => $results->image
        ]);
    }

/*
    public function musicList(Request $request)
    {
        $row = $request->input('row');

        if(is_numeric($row) && $row > 0 && $row < 11)
        {
            $results = APIModel::musicList($row);

            return response()->json($results);
        }

        return response()->json();
    }
*/

    public function count()
    {
        $results = APIModel::count();

        return response()->json(['count' => (string)$results]);
    }

    public function search(Request $request)
    {
        $name = $request->input('name');
        $namelen = strlen($name);
        
        if($name && $namelen !=1)
        {
            $results = APIModel::search($name);

            if($results)
            {
                return response()->json($results);
            }
        }

        return response()->json();
    }
}
