<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCategoryList() {

        $data = Category::query()->select('category_title', 'category_slug', 'tag_id')->get();
//        $data = Category::all();

        $content = [];
        foreach ($data as $oneCategory) {

            $category = Category::getFullData($oneCategory);

            $content[] = $category;
        }

        /*return json obj*/
        return response()->json([
            'status' => 'success',
            'data' => $content
        ]);

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getOneCategory(Request $request) {

        $data = Category::query()->where('category_slug', $request->slug)->firstOrFail();
        $content = Category::getFullData($data);

        /*return json obj*/
        return response()->json([
            'status' => 'success',
            'data' => $content
        ]);

    }
}
