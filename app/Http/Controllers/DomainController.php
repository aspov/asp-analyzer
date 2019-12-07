<?php

namespace App\Http\Controllers;

use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

class DomainController extends Controller
{
    public function store(Request $request)
    {
        
        $this->validate($request, [
            'name' => 'required'
        ]);
        
       
        if (\DB::table('domains')->where('name', $request->name)->doesntExist()) {
            \DB::table('domains')->insert(['name' => $request->name]);
        };
        
        $domain = \DB::table('domains')->where('name', $request->name)->get()->toArray();
        
        print_r($domain[0]->id);
        return view('page.home');
    }

    public function show(Request $request, $id)
    {
        return ;
    }
}
