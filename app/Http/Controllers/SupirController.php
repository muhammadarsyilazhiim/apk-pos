<?php

namespace App\Http\Controllers;

use Auth;
use Session;
use App\User;
use App\Acces;
use App\Activity;
use App\Supir;
use App\Market;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SupirController extends Controller
{
    public function viewSupir()
    {
        $market = Market::first();
        $id_account = Auth::id();
        $check_access = Acces::where('user', $id_account)
        ->first();
        if($check_access->kelola_akun == 1){
        	$supir = Supir::all();

        	return view('manage_supir.index', compact('supir', 'market'));
        }else{
            return back();
        }
    }

    public function viewNewSupir()
    {
        $market = Market::first();
        $id_account = Auth::id();
        $check_access = Acces::where('user', $id_account)
        ->first();
        if($check_access->kelola_akun == 1){

        	return view('manage_supir.new_supir', compact('market'));
        }else{
            return back();
        }
    }

    public function filterTable($id)
    {
        $id_account = Auth::id();
        $check_access = Acces::where('user', $id_account)
        ->first();
        if($check_access->kelola_barang == 1){
            $supir = Supir::orderBy($id, 'asc')
            ->get();

            return view('manage_pcust.filter_table.table_view', compact('supir'));
        }else{
            return back();
        }
    }

    public function createSupir(Request $req)
    {
        $id_account = Auth::id();
        $check_access = Acces::where('user', $id_account)
        ->first();
        if($check_access->kelola_akun == 1){

        	$supir = new Supir;
            $supir->nama = $req->nama;
            $supir->no_tel = $req->no_tel;
            // dd($supir);
            $supir->save();

            Session::flash('create_success', 'Supir baru berhasil dibuat');

            return redirect('/supir');
        }else{
            return back();
        }
    }

    public function editSupir($id)
    {
        $id_account = Auth::id();
        $check_access = Acces::where('user', $id_account)
        ->first();
        if($check_access->kelola_akun == 1){
            $supir = Supir::find($id);

            return response()->json(['supir' => $supir]);
        }else{
            return back();
        }
    }

    public function updateSupir(Request $req)
    {
        $id_account = Auth::id();
        $check_access = Acces::where('user', $id_account)->first();
        
        if($check_access->kelola_akun == 1){

        	$supir = Supir::find($req->id);
            $supir->nama = $req->nama;
            $supir->no_tel = $req->no_tel;
            // dd($supir);
            $supir->save();

            Session::flash('create_success', 'Supir baru berhasil dibuat');

            return redirect('/supir');
        }else{
            return back();
        }     
    }        

    public function deleteSupir($id)
    {
        $id_account = Auth::id();
        $check_access = Acces::where('user', $id_account)
        ->first();
        if($check_access->kelola_akun == 1){
            Supir::destroy($id);
            // Acces::where('user', $id)->delete();

            Session::flash('delete_success', 'Supir berhasil dihapus');

            return back();
        }else{
            return back();
        }
    }
}
