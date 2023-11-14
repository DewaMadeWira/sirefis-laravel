<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Gpu;
use App\Models\Company;
use App\Models\Company_employee;
use App\Models\Gpu_recom;

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

    public function store_Gpu_recom(Request $request)
    {
        $save = new Gpu_recom;
        $save->best_gpu = $request->best_gpu;
        $save->similar_1 = $request->similar_1;
        $save->recommendation_date = $request->recommendation_date;
        $save->save();

        return "Berhasil Menyimpan Data GPU";
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

    public function destroy_gpu_recom(Request $request)
    {
        $del = Gpu_recom::all()->where('recommendation_id', $request->id)->first();
        $del->delete();
        return "Berhasil menghapus data rekomendasi gpu king";
    }

    public function destroy_company(Request $request)
    {
        $del = Company::all()->where('company_id', $request->id)->first();
        $del->delete();
        return "Berhasil menghapus data perusahaan king";
    }

    public function destroy_company_employee(Request $request)
    {
        $del = Company_employee::all()->where('company_employee_id', $request->id)->first();
        $del->delete();
        return "Berhasil menghapus data karyawan king";
    }
}