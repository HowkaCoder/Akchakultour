<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tour;
use Illuminate\Support\Facades\Validator;

class TourController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Tour::all();
        return $data;
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
        $data = Validator::make($request->all() , [
            'region'=>'required',
            'city'=>'required',
            'day'=>'required',
            'price'=>'required',
            'img'=>'required',
        ]);
        if($data->fails()){
            return [
                "message"=>$data->errors()->first()
            ];
        }
        else{
            $fileName = time().'_'.$request->file('img')->getClientOriginalName();
            $path = $request->file('img')->storeAs('public/images', $fileName);
            Tour::create([
                "region"=>$request->region,
                "city"=>$request->city,
                "day"=>$request->day,
                "price"=>$request->price,
                "img"=>$fileName
            ]);
            return [
                'message'=>"success"
            ];
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
        Tour::where('id' , $id)->delete();
    }
}
