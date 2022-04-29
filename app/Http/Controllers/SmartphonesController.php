<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http;
use Response;
use App\Smartphone;

class SmartphonesController extends Controller
{
    //
    function index() {
        return ['data'=>Smartphone::all()];
    }

    public function store(Request $req) {
        $new_phone = new Smartphone;
        $new_phone->brand = $req->brand;
        $new_phone->model = $req->model;
        $new_phone->year = $req->year;

        $new_phone->save();

        return $new_phone;
    }

    public function show($id) {
        $show_phone = Smartphone::find($id);

        return $show_phone;
    }

    public function edit($id) {
        $edit_phone = Smartphone::find($id);
    }

    public function update($id, Request $req) {
        $update_phone = Smartphone::find($id);

        $validatedData = $req->validate([
            'brand' => 'required',
            'model' => 'required',
            'year' => 'required',
        ]);

        $update_phone->update($validatedData);

        return Response::json([
            'message' => 'Smartphone Updated Successfully',
            'data' => $update_phone
        ], 200); 
    }

    public function destroy($id) {
        $delete_phone = Smartphone::find($id)->delete();

        return Response::json([
            'message' => 'Smartphone Deleted Successfully'
        ], 200);
    }

}
