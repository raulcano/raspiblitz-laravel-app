<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;

class MainMenuController extends Controller
{
    public function index(){
        return view('main');
    }

    public function home(){
        return view('home');
    }

    public function refreshStatus(){
        $files = array (
            'conf' => env('RASPIBLITZ_CONF'),
            'info'=> env('RASPIBLITZ_INFO')
        );
        $status_db_line = array();
        foreach($files as $prefix => $file){
            $fcontents = array_filter(array_map("trim", file($file)), "strlen");
            foreach($fcontents as $line){
                if($line[0] != '#'){
                    $variableArray = explode('=', $line);
                    $var = $variableArray[0];
                    $value = $variableArray[1];
                    if($value[0]=="'" && $value[strlen($value)-1]=="'"){
                        $value = trim($value, " '");
                    }
                    $status_db_line[$prefix . '_' . $var] = $value;
                }
            }
        }
        $id = 1;
        $status_db_line['id'] = $id;
        DB::table('status')->upsert($status_db_line, 'id', array_keys($status_db_line));

        $res = json_encode(DB::table('status')->where('id', $id)->first(), true);
        return $res;
    }
}
