<?php

namespace App\Http\Controllers;

use App\Advertisement;
use Illuminate\Http\Request;

class RenderController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $adver = Advertisement::find($id);

        return view("render", [ "data" => $adver ]);
    }
}
