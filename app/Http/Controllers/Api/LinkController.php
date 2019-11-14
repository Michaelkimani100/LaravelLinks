<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Link;

class LinkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $links=Link::with('user')->paginate(10);
        return response()->json($links);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules=array(
            'name'=>'required',
            'link'=>'required'
        );
        $this->validate($request,$rules);
        return Link::create([
            'name'=>$request->input('name'),
            'link'=>$request->input('link'),
            'user_id'=>$request->user('api')->id

        ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $link=Link::FindOrFail($id);
        return response()->json($link);
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
        $link=Link::FindOrFail($id);

        $rules=array(
            'name'=>'required',
            'link'=>'required'
        );
        $this->validate($request,$rules);
        $link->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $link=Link::FindOrFail($id);
        $link->delete();
    }
}
