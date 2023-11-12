<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Gpu;

class APIController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $save = new Gpu;
        $save->gpu_name = $request->gpu_name;
        $save->G3Dmark = $request->G3Dmark;
        $save->G2Dmark = $request->G2Dmark;
        $save->price = $request->price;
        $save->gpu_value = $request->gpu_value;
        $save->TDP = $request->TDP;
        $save->power_performance = $request->power_performance;
        $save->test_date = $request->test_date;
        $save->category = $request->category;
        $save->save();

        return "Berhasil Menyimpan Data";
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
