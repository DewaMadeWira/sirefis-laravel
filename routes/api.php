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
    return Gpu::all()->where('status', '=', "validated");
    // return "hello";
});
// Route::get('gpu', function(){
//     // Data
//     return Gpu::all();
//     // return "hello";
// });
Route::post('login-admin', function(Request $request){
   $email = $request->email;
   $password = $request->password;
   $data = Admin::where('admin_email','=',$email)->
   where('password','=',$password)->first();

   if(empty($data)){
    // return "wrong credential";
     return response('', 401);
    // return "invalid";
   }
   return response($data->admin_name,200);

//    $token = uniqid();
//    $cookie = cookie('nim', $data->admin_name, $minutes = 60);
//    return response()
//        ->json(['success' => "logged in"], 200)   // JsonResponse object
//        ->withCookie(cookie('name', $data->admin_name, $minutes = 60));
    // return $token;
    // return response('logged in', 200)
    //               ->header('Authorization', $token);
});

Route::post('login-company', function(Request $request){
   $email = $request->email;
   $password = $request->password;
   $data = Company_employee::where('employee_email','=',$email)->
   where('password','=',$password)->first();

   if(empty($data)){
    // return "wrong credential";
     return response('', 401);
    // return "invalid";
   }
   return response($data->company_id,200);
});
Route::post('count-company', function(Request $request){
   $company_id = $request->company_id;
   $count = DB::table('gpu_data')->where('company','=',$company_id)->count();
   return $count;
});


Route::post('company-gpu', function(Request $request){
   $company_id = $request->company_id;
//    return $company_id;
   $data = Gpu::select("gpu_data.*")->where('company', $company_id)->get()->toArray();;
   return $data;
});







Route::post('gpu-rank', function(Request $request){
    $company;
    $priceMin=0;
    $priceMax=219999;

    $priceMax=$request->priceMax;
    
    if($request->priceMax==""){
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
        $data = Gpu::select('gpu_id', 'gpu_name', 'G3Dmark','G2Dmark','price','gpu_value','TDP','power_performance','test_date','category','company')->where('category', '=', 'Desktop')
            ->whereBetween('price', [$priceMin, $priceMax])
            ->where('company', '=', $company)
            ->where('status', '=', "validated")
            ->get()
            ->toArray();
            // return

        // return $data;
        $response = Http::post('http://127.0.0.1:5000/post-rank',["gpu_data"=>$data]);
        return $response;
    }
    else if($request->desktop == "false" && $request->workstation == "true"){
            // $data = Gpu::all()->where('category', '=', 'Workstation')->where('price', '>', $priceMin)->where('company', '=', $company)->where('price', '<', $priceMax);
            // $response = Http::post('http://127.0.0.1:5000/post-rank',["gpu_data"=>$data]);
            // return $response;

            $data = Gpu::select('gpu_id', 'gpu_name', 'G3Dmark','G2Dmark','price','gpu_value','TDP','power_performance','test_date','category','company')->where('category', '=', 'Workstation')
            ->whereBetween('price', [$priceMin, $priceMax])
            ->where('company', '=', $company)
            ->where('status', '=', "validated")
            ->get()
            ->toArray();
        // return $data;
        $response = Http::post('http://127.0.0.1:5000/post-rank',["gpu_data"=>$data]);
        return $response;
   
    }
    else{
        //    $data = Gpu::all()->where('price', '>', $priceMin)->where('company', '=', $company)->where('price', '<', $priceMax);
        //    $response = Http::post('http://127.0.0.1:5000/post-rank',["gpu_data"=>$data]);
        //     return $response;

            $data = Gpu::select('gpu_id', 'gpu_name', 'G3Dmark','G2Dmark','price','gpu_value','TDP','power_performance','test_date','category','company')
            ->whereBetween('price', [$priceMin, $priceMax])
            ->where('company', '=', $company)
            ->where('status', '=', "validated")
            ->get()
            ->toArray();

            // return $data;
        $response = Http::post('http://127.0.0.1:5000/post-rank',["gpu_data"=>$data]);
        return $response;
        
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
Route::get("get_Gpu_recom", [APIController::class, "get_Gpu_recom"]);

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
Route::post("update_admin",[APIController::class, "update_admin"]);

// Company

Route::get("company", [APIController::class, "indexCompany"]);
Route::post("company", [APIController::class, "get_company"]);
// Employee

Route::get("company-employee", [APIController::class, "indexCompanyEmployee"]);

// Update
Route::post("update_data", [APIController::class, "update"]);
Route::post("update_data_gpu_recom", [APIController::class, "update_gpu_recom"]);
Route::post("update_data_company", [APIController::class, "update_company"]);
Route::post("update_data_company_employee", [APIController::class, "update_company_employee"]);
 
// GPU Request

Route::get("gpu-request", [APIController::class, "index_request"]);
Route::post("gpu-request", [APIController::class, "get_request"]);
Route::post("create-request",[APIController::class, "store_request"]);
Route::post("delete-request",[APIController::class, "destroy_request"]);
Route::post("update-request",[APIController::class, "update_request"]);
Route::post("approve-request",[APIController::class, "approve_request"]);


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

