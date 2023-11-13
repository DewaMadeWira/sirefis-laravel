<?php

// use cors;


use App\Models\Gpu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use GuzzleHttp\Client;
use App\Http\Controllers\APIController;

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
    // return "hellow";
    return Gpu::all();
    // return "hello";
});
Route::get('post-rank', function(){
    $data = Gpu::all();
    $response = Http::post('http://127.0.0.1:5000/post-rank',["gpu_data"=>$data]);
    return $response;
    // return Gpu::all();
    // return "hello";
});
Route::post('gpu', function(Request $request){
    $jsonData = $request->json()->all();
    return $jsonData;
    // $name = $request->name;
    // return $name;
    // return Gpu::all();
    // return "hello";
});

Route::get('rank-gpu', function(){
    $response = Http::get('http://127.0.0.1:5000/');
    // return "requested";
    return $response;
    // return "hello";
});

Route::post("create_data",[APIController::class, "store"]);
Route::post("create_data_company",[APIController::class, "store_company"]);
Route::post("delete_data", [APIController::class, "destroy"]);

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