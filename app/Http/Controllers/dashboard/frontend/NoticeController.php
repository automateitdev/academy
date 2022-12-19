<?php

namespace App\Http\Controllers\dashboard\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Notice;
use Illuminate\Support\Facades\Auth;

class NoticeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        $notices = Notice::all();
        return view('layouts.dashboard.frontend.notice.index', compact('users','notices'));
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
        $request->validate([
            'name'=>'required',
            'description'=>'nullable',
            'file'=>'nullable',
            'date'=>'required'
        ]);
        $document = new Notice();
        $document->institute_id = Auth::user()->institute_id;
        $document->name = $request->name;
        $document->description = $request->description;
        $document->date = $request->date;

        if($request->hasFile('file')){
            // $allowedfileExtension = ['pdf'];
            $file = $request->file('file');
            $extension = $file->getClientOriginalExtension();
            $filename = time().'.'.$extension;
            $file->move('notice/',$filename);
            $document->file = $filename;

            // $check = in_array($extension, $allowedfileExtension);
            // if ($check) {
            //     $filename = $file->storeAs('notice', $filename);
            //     $document->file = $filename;
            // }
            // $filename = $file->storeAs('notice', $filename);
            
        }else{
            $document->file = '';
        }
        $document->save();

        return redirect()->route('notice.index')->with('message', 'Data Upload Success');
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
        Notice::find($id)->delete();
        return redirect()->back();
    }
}
