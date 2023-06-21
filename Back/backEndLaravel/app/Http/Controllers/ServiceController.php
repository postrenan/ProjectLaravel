<?php

namespace App\Http\Controllers;

use App\Models\Service;
use http\QueryString;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ServiceController extends Controller
{
    public function store(Request $request)
    {
        $title = $request->input('title');
        $content = $request->input('content');

        $service = new Service();
        $service->title = strip_tags($title);
        $service->content = strip_tags($content);

        $successUp = $service->save();

        if ($successUp) {
            return response(status: 200);
        } else {
            return response(status: 401);
        }

    }

    public function index(Request $request)
    {
        $search = $request->input('search');
        $services = DB::table('service')
            ->where('created_at', '!=' , null)
            ->get();

        return response()->json(['services' => $services]);
    }
    public function destroy(int $id)
    {
        $toDelete = DB::table('service')
            ->where('id', '=', $id)
            ->delete();

    }

    public function update(int $id)
    {
        $toUp = DB::table('service')
            ->where('id', $id)
            ->update(['deleted_at' => null]);

        if ($toUp) {
            return response(status: 200);
        } else {
            return response(status: 400);
        }
    }
}
