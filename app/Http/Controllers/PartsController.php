<?php

namespace App\Http\Controllers;

use App\Models\Agree;
use App\Models\Parts\FooterModel;
use App\Models\Parts\HeaderModel;
use Illuminate\Http\Request;

class PartsController extends Controller
{
    public function parts()
    {
        $dataHeader = HeaderModel::firstOrFail();
        $header = $dataHeader->getFullData();

        $dataFooter = FooterModel::firstOrFail();
        $footer = $dataFooter->getFullData();

        $dataAgree = Agree::firstOrFail();
        $agree = $dataAgree->getFullData();

        /*return json obj*/
        return response()->json([
            'status' => 'success',
            'header' => $header,
            'footer' => $footer,
            'agree' => $agree
        ]);
    }
}
