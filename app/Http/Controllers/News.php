<?php

namespace App\Http\Controllers;


use App\Models\OneNews;
use Illuminate\Http\Request;

class News extends Controller
{
    public function getOneNews(Request $request)
    {
        $data = OneNews::query()
        ->where('slug', $request->slug)
        ->firstOrFail();
        $content = $data->getFullData();

        return response()->json([
            'status' => 'success',
            'data' => $content
        ]);
    }

    public function getNewsList() {
        $data = OneNews::query()
            ->get();
        foreach ($data as $datum){
            $content[] = $datum->getFullData();
        }


        return response()->json([
            'status' => 'success',
            'data' => $content
        ]);
    }
}
