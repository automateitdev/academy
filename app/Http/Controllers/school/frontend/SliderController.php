<?php

namespace App\Http\Controllers\school\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sliders = Slider::all();
        return view('layouts.dashboard.frontend.slider.index', compact('sliders'));
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
        $this->validate($request, [
            'institute_id' => 'required',
            'slider_img' => 'required',
            'slider_pos' => 'required',
            'title' => 'nullable',
            'description' => 'nullable',
        ]);
        $sliders = new Slider();
        
        $sliders->institute_id = $request->institute_id;
        $sliders->slider_pos = $request->slider_pos;
        $sliders->title = $request->title;
        $sliders->description = $request->description;

        if($request->hasFile('slider_img')){
            $file = $request->file('slider_img');
            $extension = $file->getClientOriginalExtension();
            $filename = time().'.'.$extension;
            $file->move('images/carousel/',$filename);
            $sliders->slider_img = $filename;
        }else{
            //return $request;
            $sliders->lslider_img = '';
        }
        
        $sliders->save();

        return redirect(route('slider.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
