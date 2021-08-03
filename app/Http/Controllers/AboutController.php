<?php

namespace App\Http\Controllers;

use App\Models\About;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function about()
    {
        $data = About::firstOrFail();
        $data = $this->translateModelWithoutIdAndTime($data);
        $data = $data['content'];
//dd($data);

/*replace image ID on source*/
        foreach ($data as $key => $value)
        {
            if(isset($data[$key]['attributes']['image'])) {
                $data[$key]['attributes']['image'] = $this->getMedia($value['attributes']['image']);
            }
            if(isset($data[$key]['attributes']['bg_image'])) {
                $data[$key]['attributes']['bg_image'] = $this->getMedia($value['attributes']['bg_image']);
            }
            if (isset($data[$key]['attributes']['logo_and_description']))
            {
                foreach ($data[$key]['attributes']['logo_and_description'] as $keyTwo => $valueTwo)
                {
                    $data[$key]['attributes']['logo_and_description'][$keyTwo]['attributes']['image'] = $this->getMedia($valueTwo['attributes']['image']);
                }
            }

        }
/*return json obj*/
        return response()->json([
            'status' => 'success',
            'data' => $data
        ]);
    }
}
