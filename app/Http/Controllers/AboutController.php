<?php

namespace App\Http\Controllers;

use App\Models\About;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    /**  @OA\Get(
     *        path="/api/about",
     *        summary="Create an about",
     *        description="Send data for creating an about",
     *        tags={"About"},
     *        @OA\Response(
     *            response=200,
     *            description="Success",
     *            @OA\JsonContent(
     *                @OA\Property(property="status", type="string", example="success"),
     *                @OA\Property(
     *                    property="data",
     *                    type="object",
     *                    @OA\Property(
     *                      @OA\Property(property="layout", type="string", example="atelier"),
     *                      @OA\Property(property="key", type="string", example="HRJJ9V3VhJrgU2ko"),
     *                      @OA\Property(property="attributes", type="object",
     *                                @OA\Property(property="image", type="string", example="/storage/Image.jpg"),
     *                                @OA\Property(property="title", type="string", example="title"),
     *                                @OA\Property(property="description", type="string", example="description"),
     *                                @OA\Property(property="bg_image", type="string", example="/storage/Image.jpg"),
     *                             ),
     *                      ),
     *
     *
     *                 )
     *            )
     *        )
     *     )
     */
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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\About  $about
     * @return \Illuminate\Http\Response
     */
    public function show(About $about)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\About  $about
     * @return \Illuminate\Http\Response
     */
    public function edit(About $about)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\About  $about
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, About $about)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\About  $about
     * @return \Illuminate\Http\Response
     */
    public function destroy(About $about)
    {
        //
    }
}
