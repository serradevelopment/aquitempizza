<?php

namespace App\Http\Controllers\Admin;

use App\Freight;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FreightsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.freights.index', [
            'freights'  =>  Freight::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.freights.create', [
            'freight'  =>  new Freight
        ]);
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
        if ($data['value']) {
            $data['value'] = (float) $this->parseCurrency($data['value']);
        }
        $freight = new Freight();
        $freight->fill($data);
        $freight->save();

        return redirect()->route('freights.create')->with('flash.success', 'Bairro cadastrado com sucesso.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Freight  $freight
     * @return \Illuminate\Http\Response
     */
    public function show(Freight $freight)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Freight  $freight
     * @return \Illuminate\Http\Response
     */
    public function edit(Freight $freight)
    {
        return view('admin.freights.edit', [
            'freight'  =>  $freight
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Freight  $freight
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Freight $freight)
    {
        $data = $request->all();
        if ($data['value'] and strpos($data['value'] , 'R$') !== false) {
            $data['value'] = (float) $this->parseCurrency($data['value']);
        }
        
        $freight->fill($data);
        $freight->save();

        return redirect()->route('freights.index')->with('flash.success', 'Bairro editado com sucesso.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Freight  $freight
     * @return \Illuminate\Http\Response
     */
    public function destroy(Freight $freight)
    {
        $freight->delete();
        return redirect()->route('freights.index')->with('flash.success', 'Bairro deletado com sucesso.');
    }
}
