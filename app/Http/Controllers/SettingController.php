<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function get(Request $request)
    {
        if($request->user()->can('manage-settings'))
        {
            return response()->json(setting()->all());
        }
        return response()->json([], 403);
    }

    public function store(Request $request)
    {
        if($request->user()->can('manage-settings'))
        {
            setting($request->all())->save();
        }
    }
}
