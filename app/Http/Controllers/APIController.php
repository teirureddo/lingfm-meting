<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\APIModel;
use Metowolf\Meting;

class APIController extends Controller
{
    public function music(Request $request)
    {
        $id = $request->input('id');

        if(ctype_digit($id) && ($id != 0))
        {
            $music = APIModel::music($id);

            switch($music->play)
            {
                case 1:
                    $musicURL = APIModel::musicLocal($id);

                    return response()->json([
                    'id' => (string)$music->id,
                    'name' => $music->name,
                    'music' => $musicURL->localURL,
                    'image' => $music->image
                    ]);

                case 2:
                    $NeteaseID = APIModel::musicNetease($id);
                    $neteaseAPI = new Meting('netease');
                    $musicURL = $neteaseAPI->format(true)->url($NeteaseID->neteaseID);
                    $musicURL = json_decode($musicURL);

                    return response()->json([
                        'id' => (string)$music->id,
                        'name' => $music->name,
                        'music' => $musicURL->url,
                        'image' => $music->image
                    ]);
            }
        }

        $music = APIModel::musicRand();

        switch($music->play)
        {
            case 1:
                $musicURL = APIModel::musicLocal($music->id);

                return response()->json([
                    'id' => (string)$music->id,
                    'name' => $music->name,
                    'music' => $musicURL->localURL,
                    'image' => $music->image
                ]);

            case 2:
                $NeteaseID = APIModel::musicNetease($music->id);
                $neteaseAPI = new Meting('netease');
                $musicURL = $neteaseAPI->format(true)->url($NeteaseID->neteaseID);
                $musicURL = json_decode($musicURL);

                return response()->json([
                    'id' => (string)$music->id,
                    'name' => $music->name,
                    'music' => $musicURL->url,
                    'image' => $music->image
                ]);
        }
    }

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
