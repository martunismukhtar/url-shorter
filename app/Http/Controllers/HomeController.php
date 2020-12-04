<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

use KubAT\PhpSimple\HtmlDomParser;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth' => 'verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index() {
        $userId = \Auth::id();
        $link = DB::table('link')->select('*')->where('user_id', $userId)->orderBy('created_at', 'DESC')->get();
        
        return view('home', ["link"=>$link]);
    }
    function getdatabyid(Request $request){
        $id = $request['id'];
        $link = DB::table('link')->select('*')->where('id', $id)->get()->toArray()[0];

        echo json_encode($link);
    }
    function getdata() {
        $link = DB::table('link')->select('*')->where('user_id', $userId)->orderBy('created_at', 'DESC')->get();
        
        $active = 'active';
        $div = '';$detail ='';
        foreach($link as $ll) {
            $time = strtotime($ll->created_at);
            $div .='<a class="list-group-item list-group-item-action '.$active.'" 
            id="list-'.$ll->id.'-list" data-toggle="list" href="#list-'.$ll->id.'" 
            role="tab" aria-controls="home">
            <div class="d-flex w-100 justify-content-between">
                <h5 class="mb-1">'.$ll->title.'</h5>
                <small>'.date('d-m-Y',$time).'</small>
            </div>
            <small class="small-link">'.$ll->short_link.'</small>
        </a>';
            $active= '';
        }

        $active_d = 'active';
        foreach($link as $ll) {

            $time = strtotime($ll->created_at);
            $detail .='<div class="tab-pane fade show '.$active_d.'" id="list-'.$ll->id.'" 
            role="tabpanel" aria-labelledby="list-'.$ll->id.'-list"
            style="margin-top: 15px;"
            >
            <div class="wrapper row"> 
                <div class="details col-md-12">
                    <h3 class="product-title"></h3>
                    <h3 class="product-title">'.$ll->title.'</h3>
                    <a target="_blank" href="'.$ll->short_link.'">
                        <input type="hidden" value="{{$lk->short_link}}" id="linkshortlink">
                        <p class="vote">'.$ll->long_link.'</p></a>
                    <br>
                    <div>
                        <a target="_blank" class="a-ref" href="'.$ll->short_link.'"><p class="vote">'.$ll->short_link.'</p></a>
                        <button type="button" class="btn btn-outline-primary btn-sm" onclick="edit('.$ll->id.')">Edit</button>
                        <button type="button" class="btn btn-outline-primary btn-sm" onclick="copy()">Copy</button>
                    </div>
                    <hr>
                    <div class="item-detail--click-stats-wrapper">
                        <div class="info-wrapper--user-clicks">
                            <div class="info-wrapper--header">
                                <span class="info-wrapper--clicks-text">
                                    '.$ll->jlh_click_link.' <i class=\'far fa-chart-bar\'></i></span><span class="icon clicks-icon"></span></div><div class="item-detail--selected-day">total clicks</div></div></div>
                </div>
            </div>
        </div>';
            $active_d= '';
        }

        $data = [$div, $detail];

        echo json_encode($data);

    }
    function store(Request $request) {

        $userId = \Auth::id();
        $shortlink = str_replace(' ', '', $request['short_link']);

        $cek_long_link = DB::table('link')->select('long_link')
            ->where('long_link', $request['long_link'])->get()->toArray();
        
        if(count($cek_long_link)>0) {
            echo "Long link sudah terdaftar";
            exit();
        }

        $cek_short = DB::table('link')->select('short_name')
            ->where('short_name', $shortlink)->get()->toArray();
        
        if(count($cek_short)>0) {
            echo "Short link sudah terdaftar";
            exit();
        }

        

        // $dom = HtmlDomParser::file_get_html($request['long_link'], false, null, 0 );

        // $title = $dom->find('title',0);
        // print_r ($title->innertext);
        // exit();

        if(empty($request['title'])) {
            $dom = HtmlDomParser::file_get_html($request['long_link']);
            $title = $dom->find('title',0);
            $texttile = $title->innertext;
        } else {
            $texttile = $request['title'];
        }
        DB::table('link')->insert([
            'long_link' => $request['long_link'],
            'title' => $texttile,
            'short_link' => 'http://bitly.site/'.$shortlink,
            'user_id' => $userId,
            'jlh_click_link'=>0,
            'short_name'=> $shortlink,
            'created_at'=> date('Y-m-d H:i:s')
        ]);

        echo 1;
    }

    function storeedit (Request $request){
        $userId = \Auth::id();
        $shortlink = str_replace(' ', '', $request['short_link']);

        DB::table('link')
            ->where('id', $request['id'])
            ->update(
                array(
                    'long_link' => $request['long_link'],
                    'title' => $request['title'],
                    'short_link' => 'http://bitly.site/'.$shortlink,
                    'short_name' => $shortlink,
                )
        );
        echo 1;
    }

    function getcode() {
        return $this->random_str(7);
    }

    function random_str(
        int $length = 64,
        string $keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'
    ): string {
        if ($length < 1) {
            throw new \RangeException("Length must be a positive integer");
        }
        $pieces = [];
        $max = mb_strlen($keyspace, '8bit') - 1;
        for ($i = 0; $i < $length; ++$i) {
            $pieces []= $keyspace[random_int(0, $max)];
        }
        return implode('', $pieces);
    }
}
