<?php

namespace App\Http\Controllers\website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Domainlist;
use App\Models\Notice;
use App\Models\User;
use App\Models\category;
use App\Models\subcategory;
use App\Models\Basic;

class NoticeViewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $currentDomain = request()->getHttpHost();
        $domainlist = new Domainlist();
        $url = $domainlist->where('url', $currentDomain)->first();
        $ins_id = $url->institute_id;

        $users = User::where('institute_id', $ins_id)->get();
        $notices = Notice::where('institute_id', $ins_id)->paginate(20);
        $categories = category::where('institute_id', $ins_id)->get();
        $subcategories = subcategory::where('institute_id', $ins_id)->get();
        $basics = Basic::where('institute_id', $ins_id)->get();
        return view('layouts.frontend.more.notice.index', compact('categories', 'subcategories','basics', 'notices','users'));
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $currentDomain = request()->getHttpHost();
        $domainlist = new Domainlist();
        $url = $domainlist->where('url', $currentDomain)->first();
        $ins_id = $url->institute_id;

        $users = User::where('institute_id', $ins_id)->get();
        $selectedNotice = Notice::find($id);
        $notices = Notice::where('institute_id', $ins_id)->orderBy('id', 'desc')->get();
        $categories = category::where('institute_id', $ins_id)->get();
        $subcategories = subcategory::where('institute_id', $ins_id)->get();
        $basics = Basic::where('institute_id', $ins_id)->get();
        return view('layouts.frontend.more.notice.view', compact('categories', 'subcategories','basics', 'selectedNotice','users','notices'));

    }

    public function download($id)
    {
        $notices = Notice::find($id);
        return response()->download(public_path('notice/'.$notices->file));
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
