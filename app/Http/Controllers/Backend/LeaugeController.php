<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\LeaugeRequest;
use App\Http\service\LeaugeService;
use App\Models\League;
use Illuminate\Http\Request;

class LeaugeController extends Controller
{
     protected $leaugeservice;
     public function __construct(LeaugeService $leaugeService)
     {
         $this->leaugeservice=$leaugeService;
     }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $league =League::all();
        return view('pages.leauge.index-leauge',compact('league'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return  view('pages.leauge.create-leauge');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LeaugeRequest $request)
    {
        $leauge = $this->leaugeservice->storeLeauge($request);
        if ($leauge){
            return  redirect()->route('leauge.index')->with('success','Leauge Successfully Inserted');
        }
        else{
            return  redirect()->back()->with('error','Cannot Insert the Data');
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
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $editLeague=League::find($id);
        return  view('pages.leauge.edit-leauge',compact('editLeague'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(LeaugeRequest $request, $id)
    {
       $updateLeague = $this->leaugeservice->updateLeague($request,$id);
       if ($updateLeague){
           return  redirect()->route('leauge.index')->with('success','Successfully Updated');
       }
       else {
           return  redirect()->back()->with('error','Cannot Update Data');
       }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $playerDelete =League::where('id',$id)->delete();
        if ($playerDelete){
            return  redirect()->route('league.index')->with('success','successfully Deleted');
        }
        else{
            return  redirect()->back()->with('error','cannot be Deleted');
        }
    }
}
