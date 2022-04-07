<?php

namespace App\Http\Controllers;


use App\Models\NewsCategory;
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
        if ($data->count() > 0){
            foreach ($data as $datum){
                $content[] = $datum->getFullData();
            }
        } else {
            $content = [];
        }



        return response()->json([
            'status' => 'success',
            'data' => $content
        ]);
    }

    public function getNewsPage(){
        $data = NewsCategory::query()
            ->with('oneNews')
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
