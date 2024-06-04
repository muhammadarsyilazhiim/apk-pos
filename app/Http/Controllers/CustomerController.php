<?php

namespace App\Http\Controllers;

use Auth;
use Session;
use App\User;
use App\Acces;
use App\Activity;
use App\Customer;
use App\Market;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{
    public function viewCustomer()
    {
        $market = Market::first();
        $id_account = Auth::id();
        $check_access = Acces::where('user', $id_account)
        ->first();
        if($check_access->kelola_akun == 1){
        	$cust = Customer::all();

        	return view('manage_cust.cust', compact('cust', 'market'));
        }else{
            return back();
        }
    }

    public function viewNewCustomer()
    {
        $market = Market::first();
        $id_account = Auth::id();
        $check_access = Acces::where('user', $id_account)
        ->first();
        if($check_access->kelola_akun == 1){

        	return view('manage_cust.new_cust', compact('market'));
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
            $cust = Customer::orderBy($id, 'asc')
            ->get();

            return view('manage_pcust.filter_table.table_view', compact('cust'));
        }else{
            return back();
        }
    }

    public function createCustomer(Request $req)
    {
        $id_account = Auth::id();
        $check_access = Acces::where('user', $id_account)
        ->first();
        if($check_access->kelola_akun == 1){

        	$cust = new Customer;
            $cust->nama = $req->nama;
            $cust->notel = $req->notel;
            if ($req->email != '') {
                $existing_emaill = Customer::where('email', $req->email)->first();
                if ($existing_emaill) {
                    Session::flash('create_failed', 'email telah digunakan');
                    return back();
                }
                $cust->email = $req->email;
            }
            $cust->alamat = $req->alamat;
            // dd($cust);
            $cust->save();

            Session::flash('create_success', 'customer baru berhasil dibuat');

            return redirect('/customer');
        }else{
            return back();
        }
    }

    public function editCustomer($id)
    {
        $id_account = Auth::id();
        $check_access = Acces::where('user', $id_account)
        ->first();
        if($check_access->kelola_akun == 1){
            $customer = Customer::find($id);

            return response()->json(['customer' => $customer]);
        }else{
            return back();
        }
    }

    public function updateCustomer(Request $req)
    {
        $id_account = Auth::id();
        $check_access = Acces::where('user', $id_account)->first();
        
        if($check_access->kelola_akun == 1){

        	$cust = Customer::find($req->id);
            $cust->nama = $req->nama;
            $cust->notel = $req->notel;
            $cust->email = $req->email;
            $cust->alamat = $req->alamat;
            // dd($cust);
            $cust->save();

            Session::flash('create_success', 'customer baru berhasil dibuat');

            return redirect('/customer');
        }else{
            return back();
        }     
    }        

    public function deleteCustomer($id)
    {
        $id_account = Auth::id();
        $check_access = Acces::where('user', $id_account)
        ->first();
        if($check_access->kelola_akun == 1){
            Customer::destroy($id);
            // Acces::where('user', $id)->delete();

            Session::flash('delete_success', 'Customer berhasil dihapus');

            return back();
        }else{
            return back();
        }
    }
}
