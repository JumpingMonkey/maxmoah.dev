<?php

namespace App\Http\Controllers;

use App\Models\FiltersModel;
use App\Models\FullCollectionPageModel;
use App\Models\ProductAvailablePageModel;
use Illuminate\Http\Request;

class CatalogPagesController extends Controller
{
    public function full()
    {
        $data = FullCollectionPageModel::firstOrFail();
        $content = $data->getFullData();
        if(array_key_exists('filter', $content)){
            $filters = FiltersModel::firstOrFail();
            $filtersContent = $filters->getFullData();
            $content['filter'] = $filtersContent;
        }

        ///*return json obj*/
        return response()->json([
            'status' => 'success',
            'data' => $content
        ]);
    }

    public function available()
    {
        $data = ProductAvailablePageModel::firstOrFail();
        $content = $data->getFullData();
        if(array_key_exists('filter', $content)){
            $filters = FiltersModel::firstOrFail();
            $filtersContent = $filters->getFullData();
            $content['filter'] = $filtersContent;
        }

        ///*return json obj*/
        return response()->json([
            'status' => 'success',
            'data' => $content
        ]);
    }
}
