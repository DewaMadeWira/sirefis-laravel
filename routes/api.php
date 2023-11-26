<?php

// use cors;


use App\Models\Gpu;
use App\Models\Admin;
use GuzzleHttp\Client;
use App\Models\Company;
use App\Models\Gpu_recom;
use Illuminate\Http\Request;
use App\Models\Company_employee;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\APIController;
use App\Http\Controllers\Api\UserController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('gpu', function(){
    // Data
    return Gpu::all();
    // return "hello";
});
Route::get('gpu', function(){
    // Data
    return Gpu::all();
    // return "hello";
});
Route::get('gpu-rank', function(){
    $data = Gpu::all();
    $response = Http::post('http://127.0.0.1:5000/post-rank',["gpu_data"=>$data]);
//     return $response;
//     // return Gpu::all();
//     // return "hello";
// });
Route::post('login-admin', function(Request $request){
   $email = $request->email;
   $password = $request->password;
   $data = Admin::where('admin_email','=',$email)->
   where('password','=',$password)->first();

//    $cookie = cookie('nim', $data->admin_name, $minutes = 60);
   return response()
       ->json(['success' => "logged in"], 200)   // JsonResponse object
       ->withCookie(cookie('name', $data->admin_name, $minutes = 60));


});
Route::get('gpu-rank', function(Request $request){
    $company;
    $priceMin=0;
    $priceMax=219999;

    $priceMax=$request->priceMax;
    
    if($request->priceMax=="0"){
        $priceMax=219999;
    }

    $priceMin=$request->priceMin;


    if($request->amd=="true"){
        $company=1;
    }
    else{
        $company=2;
    }

    // return $company;
    
    if($request->desktop == "true" && $request->workstation == "false"){
        // $data = Gpu::all();
        $data = Gpu::select('gpu_id', 'gpu_name', 'G3Dmark','G2Dmark','price','gpu_value','TDP','power_performance','test_date','category','company')->where('category', '=', 'Desktop')
            ->whereBetween('price', [$priceMin, $priceMax])
            ->where('company', '=', $company)
            ->get()
            ->toArray();
            // $data = Gpu::all()->where('category', '=', 'Desktop')->where('price', '>', $priceMin)->where('company', '=', $company)->where('price', '<', $priceMax)->toArray();
            // $send_data = [$data.value];
            // $response = Http::post('http://127.0.0.1:5000/post-rank',["gpu_data"=>$send_data]);
            // return $response;
        // return $data;
        // $send_data = ;
        return $data;

    }
    else if($request->desktop == "false" && $request->workstation == "true"){
            $data = Gpu::all()->where('category', '=', 'Workstation')->where('price', '>', $priceMin)->where('company', '=', $company)->where('price', '<', $priceMax);
            $response = Http::post('http://127.0.0.1:5000/post-rank',["gpu_data"=>$data]);
            return $response;
            // return $data;
    }
    else{
           $data = Gpu::all()->where('price', '>', $priceMin)->where('company', '=', $company)->where('price', '<', $priceMax);
           $response = Http::post('http://127.0.0.1:5000/post-rank',["gpu_data"=>$data]);
            return $response;
        //    return $data;
    }



    // return $data;
    // $response = Http::post('http://127.0.0.1:5000/post-rank',["gpu_data"=>$data]);
    // return $response;
});
Route::post('gpu', function(Request $request){
    $jsonData = $request->json()->all();
    return $jsonData;
    // $name = $request->name;
    // return $name;
    // return Gpu::all();
    // return "hello";
});

// Route::get('rank-gpu', function(){
//     $response = Http::get('http://127.0.0.1:5000/');
//     // return "requested";
//     return $response;
//     // return "hello";
// });


// Tambah Data
// Login and Create

Route::post("create_user",[UserController::class, "createUser"]);
Route::post("login_user",[UserController::class, "loginUser"]);

// GPU
Route::post("create_data",[APIController::class, "store"]);
Route::post("get-gpu",[APIController::class, "get_gpu"]);
Route::get("search_gpu/{gpu_name}", [APIController::class, "search_gpu"]);
Route::post("create_data_company",[APIController::class, "store_company"]);
Route::post("create_data_company_employee",[APIController::class, "store_company_employee"]);
Route::post("create_data_Gpu_recom",[APIController::class, "store_Gpu_recom"]);

// Hapus Data
Route::post("delete_data", [APIController::class, "destroy"]);
Route::post("delete_data_gpu_recom", [APIController::class, "destroy_gpu_recom"]);
Route::post("delete_data_company", [APIController::class, "destroy_company"]);
Route::post("delete_data_company_employee", [APIController::class, "destroy_company_employee"]);


// Admin
Route::get("admin", [APIController::class, "indexAdmin"]);
Route::post("admin", [APIController::class, "get_admin"]);
Route::post("create_admin",[APIController::class, "store_admin"]);
Route::post("delete_admin",[APIController::class, "destroy_admin"]);

// Company

Route::get("company", [APIController::class, "indexCompany"]);
Route::post("company", [APIController::class, "get_company"]);
// Employee

Route::get("company-employee", [APIController::class, "indexCompanyEmployee"]);



// Route::get('rank-gpu', function(){
    
//     // return Gpu::all();
//     // return "hello";

//     // $response = Http::get('http://127.0.0.1:5000/');
//     $response = Http::withHeaders([
//     'Origin' => 'http://127.0.0.1:5000/'  // Replace with your Flask API local URL
// ])->get('http://127.0.0.1:5000/'); 
//     return $response;
// });

// Route::middleware(['cors'])->group(function () {
//     // Define your routes here
//     Route::get('rank-gpu', function () {
//         $client = new Client();

//         $response = $client->request('GET', 'http://127.0.0.1:5000/');

//         $body = $response->getBody();
//         $jsonResponse = json_decode($body, true);
//         return  $jsonResponse;
//         // $response = Http::get('http://127.0.0.1:5000/');
//         // return $response;
//     });
// });

//
