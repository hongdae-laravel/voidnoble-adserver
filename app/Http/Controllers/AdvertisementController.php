<?php

namespace App\Http\Controllers;

use App\Advertisement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class AdvertisementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $advers = Advertisement::latest()->orderBy("created_at", "asc")->get();

        return view("advertisement.index", [
            "advers" => $advers
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $form_method = "post";

        return view("advertisement.form", [
            "form_method" => $form_method,
            "id" => "",
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatorRules = [
            "type" => "required",
            "title" => "required|max:255",
            "code" => "nullable|alpha_num",
            "position" => "nullable",
            "sequence" => "nullable|numeric",
            "width" => "required|numeric",
            "height" => "required|numeric",
            "link" => "nullable|url",
            "link_title" => "nullable",
            "start_date" => "required|date",
            "end_date" => "required|date",
            "publish_at" => "nullable|date",
        ];

        // 배너 형식에 따른 필드 검사 룰을 필요로
        $validatorRules[$request->type] = "required";

        if ($request->type == "file") {
            $validatorRules[$request->type] .= "|image|mimetypes:image/jpeg,image/gif,image/png|max:2000";
        }

        $validator = Validator::make($request->all(), $validatorRules);

        if ($validator->fails()) {
            return redirect("/advertisements/create")
                ->withInput($validator)
                ->withErrors();
        }

        // store
        $adver = new Advertisement();
        $adver->type = $request->type;
        $adver->title = $request->title;
        $adver->file = $request->file;
        $adver->code = $request->code;
        $adver->html = $request->html;
        $adver->url = $request->url;
        $adver->position = $request->position;
        $adver->sequence = $request->sequence;
        $adver->width = $request->width;
        $adver->height = $request->height;
        $adver->link = $request->link;
        $adver->link_title = $request->link_title;
        $adver->link_new_window = $request->link_new_window;
        $adver->start_date = $request->start_date;
        $adver->end_date = $request->end_date;

        if (is_null($adver->html) || empty($adver->html)) $adver->html = "";
        if (is_null($adver->url) || empty($adver->url)) $adver->url = "";
        if (is_null($adver->link_new_window) || empty($adver->link_new_window)) $adver->link_new_window = 0;

        // 파일 업로드
        if ($request->hasFile('file') && $request->file('file')->isValid()) {
            $adver->file = basename($request->file->store("public"));
        }

        $adver->save();

        // redirect
        Session::flash('message', 'Successfully created!');
        return redirect("/advertisements");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Advertisement::find($id);

        $data->link_target = ($data->link_new_window)? "_blank" : "";
        $data->host = request()->getSchemeAndHttpHost();

        return view("advertisement.show", [
            "data" => $data
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $adver = Advertisement::find($id);

        $form_method = "put";

        return view("advertisement.form", [
            "adver" => $adver->toArray(),
            "form_method" => $form_method,
            "id" => $id,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatorRules = [
            "type" => "required",
            "title" => "required|max:255",
            "code" => "nullable|alpha_num",
            "position" => "nullable",
            "sequence" => "nullable|numeric",
            "width" => "required|numeric",
            "height" => "required|numeric",
            "link" => "nullable|url",
            "link_title" => "nullable",
            "start_date" => "required|date",
            "end_date" => "required|date",
            "publish_at" => "nullable|date",
        ];

        // 배너 형식에 따른 필드 검사 룰을 필요로
        $validatorRules[$request->type] = "required";

        if ($request->type == "file") {
            $validatorRules[$request->type] .= "|image|mimetypes:image/jpeg,image/gif,image/png|max:2000";
        }

        $validator = Validator::make($request->all(), $validatorRules);

        if ($validator->fails()) {
            return redirect("/advertisements/{$id}/edit")
                ->withErrors($validator)
                ->withInput();
        }

        $adver = Advertisement::find($id);
        $adver->type = $request->type;
        $adver->title = $request->title;
        $adver->file = $request->file;
        $adver->code = $request->code;
        $adver->html = $request->html;
        $adver->url = $request->url;
        $adver->position = $request->position;
        $adver->sequence = $request->sequence;
        $adver->width = $request->width;
        $adver->height = $request->height;
        $adver->link = $request->link;
        $adver->link_title = $request->link_title;
        $adver->link_new_window = $request->link_new_window;
        $adver->start_date = $request->start_date;
        $adver->end_date = $request->end_date;

        if (is_null($adver->html) || empty($adver->html)) $adver->html = "";
        if (is_null($adver->url) || empty($adver->url)) $adver->url = "";
        if (is_null($adver->link_new_window) || empty($adver->link_new_window)) $adver->link_new_window = 0;

        // 파일 업로드
        if ($request->hasFile('file') && $request->file('file')->isValid()) {
            $adver->file = basename($request->file->store("public"));
        }

        $adver->save();

        // redirect
        Session::flash("message", "Successfully updated!");
        return redirect("/advertisements");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $adver = Advertisement::find($id);
        $adver->delete();

        // redirect
        Session::flash("message", "Successfully deleted!");
        return redirect("/advertisements");
    }
}
