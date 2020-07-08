<?php

namespace App\Http\Controllers\Admin;

use App\Configuration;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ConfigurationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $configuration = Configuration::first();
        if(!$configuration){
            dd('n existe');
            $configuration = new Configuration();
            $configuration->save();
        }
        return view('admin.configurations.index')->with(['configuration'=>$configuration]);
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
     * @param  \App\Configuration  $configuration
     * @return \Illuminate\Http\Response
     */
    public function show(Configuration $configuration)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Configuration  $configuration
     * @return \Illuminate\Http\Response
     */
    public function edit(Configuration $configuration)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Configuration  $configuration
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Configuration $configuration)
    {
        $data = $request->all();
        $configuration->fill($data);
        if(!$request->has('is_online')){
            $configuration->is_online = false;
        }
        if(!$request->has('is_freight_unique')){
            $configuration->is_freight_unique = false;
        }
        if($request->has('freight_value')){
            $configuration->freight_value = $this->parseCurrency($request->input('freight_value'));
        }
        $configuration->save();
        return redirect()->route('configurations.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Configuration  $configuration
     * @return \Illuminate\Http\Response
     */
    public function destroy(Configuration $configuration)
    {
        //
    }
}
