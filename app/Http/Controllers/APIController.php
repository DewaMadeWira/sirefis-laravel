<?php

namespace App\Http\Controllers;

use App\Models\Gpu;
use App\Models\Admin;
use App\Models\Company;
use App\Models\Gpu_recom;
use Illuminate\Http\Request;
use App\Models\Company_employee;
use App\Http\Controllers\Controller;

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
        $save->company = $request->company;
        $save->save();

        return "Berhasil Menyimpan Data GPU";
    }

     public function indexCompany()
    {
        //
         $data = Company::all();
         return $data;
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
    public function get_Gpu_recom(Request $request)
    {
    $data = Gpu_recom::all();
         return $data;
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

     public function update(Request $request)
    {
        $data = Gpu::all()->where('gpu_id', $request->id)->first();
        $data->gpu_name = $request->gpu_name;
        $data->G3Dmark = $request->G3Dmark;
        $data->G2Dmark = $request->G2Dmark;
        $data->price = $request->price;
        $data->gpu_value = $request->gpu_value;
        $data->TDP = $request->TDP;
        $data->power_performance = $request->power_performance;
        $data->test_date = $request->test_date;
        $data->category = $request->category;
        $data->company = $request->company;
        $data->save();

        return "Berhasil mengubah Data gpu";
    }

    public function update_gpu_recom(Request $request)
    
    {
        $data = gpu_recom::all()->where('recommendation_id', $request->id)->first();
        $data->best_gpu = $request->best_gpu;
        $data->similar_1 = $request->similar_1;
        $data->recommendation_date = $request->recommendation_date;
        $data->save();
        
        return "Berhasil mengubah Data gpu";
    }

    public function update_company(Request $request)
    {
        $data = Company::all()->where('company_id', $request->id)->first();
        $data->company_name = $request->company_name;
        $data->ceo = $request->ceo;
        $data->location = $request->location;
        $data->save();
    
        return "Berhasil mengubah Data gpu";
    }
    public function update_company_employee(Request $request)
    
    {
        $data = Company_employee::all()->where('company_employee_id', $request->id)->first();
        $data->employee_id = $request->employee_id;
        $data->company_id = $request->company_id;
        $data->save();
        
        return "Berhasil mengubah Data gpu";

    /**
     * Remove the specified resource from storage. 🗿🗿
     */

      public function get_gpu(Request $request)
    {
        $data = Gpu::all()->where('gpu_id', $request->gpu_id)->first();
        return $data;
    }

    public function destroy(Request $request)
    {

        $del = Gpu::all()->where('gpu_id', $request->gpu_id)->first();


        $del->delete();
        return "Berhasil menghapus data gpu king";
    }

    public function destroy_gpu_recom(Request $request)
    {
        $del = Gpu_recom::all()->where('recommendation_id', $request->recommendation_id)->first();
        $del->delete();
        return "Berhasil menghapus data rekomendasi gpu king";
    }

    public function destroy_company(Request $request)
    {
        $del = Company::all()->where('company_id', $request->company_id)->first();
        $del->delete();
        return "Berhasil menghapus data perusahaan king";
    }

      public function get_company(Request $request)
    {
        $data = Company::all()->where('company_id', $request->company_id)->first();
        return $data;
    }

    public function destroy_company_employee(Request $request)
    {
        $del = Company_employee::all()->where('employee_id', $request->employee_id)->first();
        $del->delete();
        return "Berhasil menghapus data karyawan king";
    }

       public function indexCompanyEmployee()
    {
        //
         $data = Company_employee::all();
         return $data;
    }

    public function store_company_employee(Request $request)
    {
        $save = new Company_employee;
        $save->employee_name = $request->employee_name;
        $save->employee_email = $request->employee_email;
        $save->password = $request->password;
        $save->company_id = $request->company_id;
        $save->save();

        return "Berhasil Menyimpan Data Company Employee";
    }



    // Admin

    public function search_gpu(Request $request)
    {
        $data = Gpu::where('gpu_name', 'like', '%' . $request->gpu_name . '%')->get();
        return $data;
    }

    public function indexAdmin()
    {
        //
         $data = Admin::all();
         return $data;
    }

        public function store_admin(Request $request)
    {
        $save = new Admin;
        $save->admin_name = $request->admin_name;
        $save->admin_email = $request->admin_email;
        $save->password = $request->password;
        $save->save();

        return "Berhasil Menyimpan Data Admin";
    }

      public function get_admin(Request $request)
    {
        $data = Admin::all()->where('admin_id', $request->admin_id)->first();
        return $data;
    }

    public function destroy_admin(Request $request)
    {

        $del = Admin::all()->where('admin_id', $request->admin_id)->first();


        $del->delete();
        return "Berhasil menghapus data admin king";
    }
}