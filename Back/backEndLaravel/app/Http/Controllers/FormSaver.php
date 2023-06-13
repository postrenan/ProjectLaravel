<?php

namespace App\Http\Controllers;

use App\Models\Form;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class formSaver extends Controller
{
    public function dataUpload(Request $request)
    {
        $form = new Form($request->only(['email', 'msg', 'phone', 'name']));
        $insert = $form->save();

        if ($insert) {
            return response(status: 200);
        } else {
            return response(status: 500);
        }
    }
}
