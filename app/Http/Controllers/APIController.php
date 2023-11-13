<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Gpu;
use App\Models\Company;

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

        return "Berhasil Menyimpan Data GPU";
    }


    public function store_company(Request $request)
    {
        $save = new Company;
        $save->company_name = $request->company_name;
        $save->ceo = $request->ceo;
        $save->location = $request->location;
        $save->save();

        return "Berhasil Menyimpan Data Company";
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
     * Remove the specified resource from storage. 🗿🗿
     */
    public function destroy(Request $request)
    {
        $del = Gpu::all()->where('id', $request->id)->first();
        $del->delete();
        return "Berhasil menghapus data king";
    }
}