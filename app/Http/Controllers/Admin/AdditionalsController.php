<?php

namespace App\Http\Controllers\Admin;

use App\Additional;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdditionalsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.additionals.index',['additionals'=>Additional::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.additionals.create',['additional'=>new Additional()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $additional = new Additional();
        $additional->fill($data);
        $additional->price = (double)$this->parseCurrency($data['price']);
        $additional->save();
        return redirect()->route('additionals.index')->with('flash.success','Adicional Cadastrado com Sucesso');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Additional  $additional
     * @return \Illuminate\Http\Response
     */
    public function show(Additional $additional)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Additional  $additional
     * @return \Illuminate\Http\Response
     */
    public function edit(Additional $additional)
    {
        return view('admin.additionals.edit',['additional'=> $additional]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Additional  $additional
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Additional $additional)
    {
        $data = $request->all();
        $additional->fill($data);
        $additional->price = (double)$this->parseCurrency($data['price']);
        $additional->save();
        return redirect()->route('additionals.index')->with('flash.success','Adicional Editado com Sucesso');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Additional  $additional
     * @return \Illuminate\Http\Response
     */
    public function destroy(Additional $additional)
    {
        $additional->delete();
        return redirect()->route('additionals.index')->with('flash.success','Adicional Cadastrado com Sucesso');
    }
}
