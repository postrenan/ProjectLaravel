<?php

namespace App\Http\Controllers;

use App\Models\Service;
use http\QueryString;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ServiceController extends Controller
{
    public function ServiceUp(Request $request){
        $title = $request->input('title');
        $content = $request->input('content');

        $service = new Service();
        $service->title = strip_tags($title);
        $service->content = strip_tags($content);

        $successUp = $service->save();

        if($successUp){
            return response(status:200);
        } else {
            return response(status:401);
        }

    }
    public function ServiceGet(){
            $enables = DB::table('service')
                ->where('deleted_at', null )
                ->get();
            return $enables;
    }

    public function ServiceDeleteGet(){
        $disable = DB::table('service')
            ->where('deleted_at', '!=',null )
            ->get();
        return $disable;
    }

}