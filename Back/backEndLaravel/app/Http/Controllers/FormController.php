<?php

namespace app\Http\Controllers;

use App\Models\Form;
use Illuminate\Http\Request;


class FormController extends Controller
{
    public function store(Request $request)
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
