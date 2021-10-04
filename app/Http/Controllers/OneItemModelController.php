<?php

namespace App\Http\Controllers;

use App\Models\OneItemModel;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\DocBlock\Tag;

class OneItemModelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getProductList() {

        $data = OneItemModel::query()->select('prod_slug', 'prod_title', 'prod_photo', 'prod_price', 'tag_id')->get();

        $content = [];
        foreach ($data as $oneProduct) {
            $tagName = OneItemModel::getFullData($oneProduct);
            if (isset($tagName['tag_id'])){
                $tagName['prod_tag'] = $oneProduct->tag->tag_title;
                unset($tagName['tag_id']);
            }


            $content[] = $tagName;
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
    public function getProductListAvailable() {

        $data = OneItemModel::query()->select('prod_slug', 'prod_title', 'prod_photo', 'prod_price', 'tag_id')
            ->where('available', 'true')->get();

        $content = [];
        foreach ($data as $oneProduct) {
            $tagName = OneItemModel::getFullData($oneProduct);
            if (isset($tagName['tag_id'])){
                $tagName['prod_tag'] = $oneProduct->tag->tag_title;
                unset($tagName['tag_id']);
            }

            $content[] = $tagName;
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
    public function getOneProduct(Request $request) {
        $data = OneItemModel::query()->where('prod_slug', $request->slug)->firstOrFail();
        $tagName = OneItemModel::getFullData($data);
        if (isset($tagName['tag_id'])){
            $tagName['prod_tag'] = $data->tag->tag_title;
            unset($tagName['tag_id']);
        }

        $content = $tagName;

        /*return json obj*/
        return response()->json([
            'status' => 'success',
            'data' => $content
        ]);

    }

//    /**
//     * Display a listing of the resource.
//     *
//     * @return \Illuminate\Http\JsonResponse
//     */
//    public function getOneProduct() {
//
//    }
}
