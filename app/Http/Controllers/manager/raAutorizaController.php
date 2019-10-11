<?php

namespace App\Http\Controllers\manager;

use App\Model\raAutorizado;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class raAutorizaController extends Controller
{
    public function index(){
        $ra = raAutorizado::orderBy('created_at','asc')->get();
        return view('manager.ralibera', compact('ra'));
    }
    public function save(Request $request){
        $ra = new raAutorizado();
        $ra->ra = $request->ra;
        $ra->user = Auth::user()->email;
        $ra->save();
        return redirect()->back();
    }
    public function destroy($id, $id_ra){
        raAutorizado::where('id_ra', $id_ra)->delete();
        return redirect()->back();
    }
}
