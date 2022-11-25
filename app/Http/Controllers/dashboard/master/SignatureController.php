<?php

namespace App\Http\Controllers\dashboard\master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Signature;
use App\Models\Place;
use Illuminate\Support\Facades\Auth;

class SignatureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        $places = Place::all();
        $signatures = Signature::all();
        return view('layouts.dashboard.master_setting.signature.index', compact('users','places','signatures'));
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
            'place_id' => 'required',
            'status' => 'required',
            'title' => 'required',
            'sign' => 'required'

        ]);
        $input = new Signature();
        
        $input->institute_id = Auth::user()->institute_id;
        $input->place_id = $request->place_id;
        $input->status = $request->status;
        $input->title = $request->title;

        if($request->hasFile('sign')){


            $allowedfileExtension = ['jpeg', 'jpg', 'png'];
            $file = $request->file('sign');
            $extension = $file->getClientOriginalExtension();
            $filename = time().'.'.$extension;
            $check = in_array($extension, $allowedfileExtension);
            if ($check) {
                $filename = $file->storeAs('sign', $filename);
            }


            $file = $request->file('sign');
            $extension = $file->getClientOriginalExtension();
            $filename = time().'.'.$extension;
            $file->move('images/sign/',$filename);



            $input->sign = $filename;
        }else{
            $input->sign = '';
        }
        
        $input->save();
        
        return redirect(route('signature.index'));
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
        Signature::find($id)->delete();
        return redirect()->back();
    }
}
