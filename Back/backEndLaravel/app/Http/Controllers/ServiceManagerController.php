<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use Illuminate\Support\Facades\DB;
class ServiceManagerController extends Controller
{
    public function destroy(int $serviceId){
        $toDelete = Service::where('id','=', $serviceId)
                        ->first();
        $toDelete->delete();
        if($toDelete){
            return response(status:200);
        }else{
            return response(status:400);
        }
    }
    public function store(int $serviceId){
        $toUp = DB::table('service')
            ->where('id', $serviceId)
            ->update(['deleted_at'=> null]);

        if($toUp){
            return response( status:200);
        }else{
            return response(status:400);
        }
    }
}
