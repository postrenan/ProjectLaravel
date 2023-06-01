<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
class ServiceManagerController extends Controller
{
    public function ServiceDrop(int $value){
        $toDelete = Service::where('id','=', $value)
                        ->first();
        $toDelete->delete();
        if($toDelete){
            return response(status:200);
        }else{
            return response(status:400);
        }
    }
}
