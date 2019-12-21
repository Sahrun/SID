<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Staff;


class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $staff = Staff::all();
        return view('pages.staff.index',['staff' => $staff]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
     
        return view('pages.staff.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Staff::create([ 
            "nama_staff" => $request->nama_staff,
            "staff_nip" => $request->staff_nip,
            "staff_nik" => $request->staff_nik,
            "staff_posisi" => $request->staff_posisi,
            "created_at" => Date("Y-m-d h:i:s"),
            "updated_at" => Date("Y-m-d h:i:s")
            ]);
            return redirect()->action('StaffController@index');
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
        $staff = Staff::find($id);
        return view('pages.staff.edit',['staff' => $staff]);
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
        $staff = Staff::find($id);
        $staff->nama_staff      = $request->nama_staff;
        $staff->staff_nip       = $request->staff_nip;
        $staff->staff_nik       = $request->staff_nik;
        $staff->staff_posisi    = $request->staff_posisi;
        $staff->updated_at      = Date("Y-m-d h:i:s");
        $staff->save();
        return redirect()->action('StaffController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $staff = Staff::find($id);
        $staff->delete();
        return redirect()->back();
    }
}
