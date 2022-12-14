<?php

namespace App\Http\Controllers\dashboard\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Designation;
use App\Models\Speech;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;

class SpeechController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $speeches = Speech::where('institute_id', Auth::user()->institute_id)->get();
        $designations = Designation::all();
        $users = User::all();
        return  view('layouts.dashboard.frontend.speech.index', compact('designations', 'speeches','users'));
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
            'name' => 'required',
            'designation' => 'required',
            'serial' => 'required',
            'message' => 'required',
            'pro_img' => 'required',
        ]);

        
        try {
            $speeches = new Speech();
        
            $speeches->institute_id = $request->institute_id;
            $speeches->name = $request->name;
            $speeches->designation = $request->designation;
            $speeches->serial = $request->serial;
            $speeches->message = $request->message;
    
            if($request->hasFile('pro_img')){
                $file = $request->file('pro_img');
                $extension = $file->getClientOriginalExtension();
                $filename = time().'.'.$extension;
                $file->move('images/speech/',$filename);
                $speeches->pro_img = $filename;
            }else{
                $speeches->pro_img = '';
            }
            
            $speeches->save();

            return redirect(route('speech.index'))->with('message', 'Data Upload Successfully');
        } catch (QueryException $e) {
            $errorCode = $e->errorInfo[1];
            if ($errorCode == 1062) {
                return redirect(route('speech.index'))->with('error', 'This Serial is already configured.');
            }
        }
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
        $speeches = Speech::find($id);
        $users = User::all();
        return view('layouts.dashboard.frontend.speech.edit', compact('speeches','users'));
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
        $this->validate($request, [
            'institute_id' => 'nullable',
            'name' => 'nullable',
            'designation' => 'nullable',
            'message' => 'nullable',
            'pro_img' => 'nullable',
        ]);

        $speeches = Speech::find($id);
        
        $speeches->name = $request->name;
        $speeches->designation = $request->designation;
        $speeches->message = $request->message;

        if($request->hasFile('pro_img')){
            $file = $request->file('pro_img');
            $extension = $file->getClientOriginalExtension();
            $filename = time().'.'.$extension;
            $file->move('images/speech/',$filename);
            $speeches->pro_img = $filename;
        }
        
        $speeches->save();

        return redirect(route('speech.index'));
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
