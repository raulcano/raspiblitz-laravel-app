<?php

namespace App\Http\Controllers;

use Exception;
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

    public function loadSettings(){
        $res = json_encode(DB::table('settings')->get(), true);
        return $res;
    }
    
    // $settings is a Json object
    public function upsertSettings(Request $request){
        $data = $request->all();
        $name = $data['params']['name'];
        $settings = json_encode($data['params']['settings']);
        DB::table('settings')->upsert(['name' => $name, 'settings' => $settings], ['name'], ['settings']);
    }

    public function initializeSettingsToDB(Request $request){
        $data = $request->all();
        $settings = $data['params']['settings'];
        foreach($settings as $s){
            DB::table('settings')->insertOrIgnore(['name' => $s['name'], 'settings' => json_encode($s['settings'])]);
        }
        
    }
}
