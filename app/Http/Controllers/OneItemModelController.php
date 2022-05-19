<?php

namespace App\Http\Controllers;

use App\Models\OneItemModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\DocBlock\Tag;

class OneItemModelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getProductList(OneItemModel $oneItemModel) {

        $data = $oneItemModel
            ->getFields()
            ->get();

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
    public function getProductListAvailable(OneItemModel $oneItemModel) {

        $data = $oneItemModel->getFields()
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
