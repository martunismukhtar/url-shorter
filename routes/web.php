<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Support\Facades\DB;

Route::get('/', function () {
    return view('welcome');
});
$cur_url = url()->current();

$ex_url = explode('/', $cur_url);

// if(count($ex_url)>3) {
     
//     $url = $ex_url[3];
//     $allow_url = ['home', 'login', 'logout', 'register'];
//     if (!in_array($url, $allow_url)) {
  
//         DB::table('link')
//             ->where('short_link', 'http://bitly.site/'.$url)
//             ->update(array('jlh_click_link' => DB::raw('jlh_click_link + 1')));

//         $link = DB::table('link')->select('id', 'long_link')->where('short_link', 'http://bitly.site/'.$url)->first();
       
//         return redirect()->to($link->long_link)->send();

//     }    
// }

Auth::routes(['verify' => true ]);

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/home/getdata', 'HomeController@getdata');//->name('home');
Route::post('/home/getdatabyid/', 'HomeController@getdatabyid');//->name('home');
Route::post('/home/code', 'HomeController@getcode');//->name('home');
Route::post('/home/store', 'HomeController@store');//->name('home');
Route::post('/home/storeedit', 'HomeController@storeedit');//->name('home');
