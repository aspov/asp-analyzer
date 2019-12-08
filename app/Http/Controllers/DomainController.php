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
            \DB::table('domains')->insert([
                'name' => $request->name,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
                ]);
        } else {
            \DB::table('domains')
              ->where('name', $request->name)
              ->update(['updated_at' => date("Y-m-d H:i:s")]);
        };

        $domain = \DB::table('domains')->where('name', $request->name)->first();
        
        return redirect()
            ->route('domains.show', ['id' => $domain->id]);
    }

    public function show(Request $request, $id)
    {
        $domain = \DB::table('domains')->find($id);
        return view('domain.show', ['domain' => $domain]);
    }
}
