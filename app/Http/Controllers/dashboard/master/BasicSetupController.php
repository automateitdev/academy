<?php

namespace App\Http\Controllers\dashboard\master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Basic;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class BasicSetupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $basics = Basic::all();
        $users = User::all();
        return view('layouts.dashboard.master_setting.basic.index', compact('basics','users'));
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
        $this->validate($request,[
            'institute_id' => 'required',
            'institute_title' => 'nullable',
            'web_link' => 'nullable',
            'google_map' => 'nullable',
            'fb_link' => 'nullable',
            'youtube_link' => 'nullable',
            'twitter_link' => 'nullable',
            'insta_link' => 'nullable',
            'pi_link' => 'nullable',
            'logo' => 'required',
        ]);
        $basics = new Basic();
        
        $basics->institute_id = $request->institute_id;
        $basics->institute_title = $request->institute_title;
        $basics->web_link = $request->web_link;
        $basics->google_map = $request->google_map;
        $basics->fb_link = $request->fb_link;
        $basics->youtube_link = $request->youtube_link;
        $basics->twitter_link = $request->twitter_link;
        $basics->insta_link = $request->insta_link;
        $basics->pi_link = $request->pi_link;

        if($request->hasFile('logo')){
            $file = $request->file('logo');
            $extension = $file->getClientOriginalExtension();
            $filename = time().'.'.$extension;
            $file->move(storage_path('images/logo/',$filename));
            $basics->logo = $filename;
        }else{
            //return $request;
            $basics->logo = '';
        }
        
        $basics->save();
        
        return redirect(route('basic.index'));
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
        $basics = Basic::find($id);
        $users = User::all();
        return view('layouts.dashboard.master_setting.basic.edit', compact('basics','users'));
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
        $basics = Basic::find($id);        
        // $basics->institute_id = $request->institute_id;
        $basics->institute_title = $request->institute_title;
        $basics->web_link = $request->web_link;
        $basics->google_map = $request->google_map;
        $basics->fb_link = $request->fb_link;
        $basics->youtube_link = $request->youtube_link;
        $basics->twitter_link = $request->twitter_link;
        $basics->insta_link = $request->insta_link;
        $basics->pi_link = $request->pi_link;

        if($request->hasFile('logo')){
            $file = $request->file('logo');
            $extension = $file->getClientOriginalExtension();
            $filename = time().'.'.$extension;
            $file->move('images/logo/',$filename);
            $basics->logo = $filename;
        }else{
            //return $request;
            $basics->logo = '';
        }
        
        $basics->save();
        
        return redirect(route('basic.index'));
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
