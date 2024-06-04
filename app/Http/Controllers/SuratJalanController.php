<?php

namespace App\Http\Controllers;

use Auth;
use Session;
use Carbon\Carbon;
use App\User;
use App\Acces;
use App\Activity;
use App\Customer;
use App\Transaction;
use App\Product;
use App\Supir;
use App\Market;
use App\SuratJalan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use PDF;

class SuratJalanController extends Controller
{
    public function viewSuratJalan()
    {
        $market = Market::first();
        $id_account = Auth::id();
        $check_access = Acces::where('user', $id_account)
        ->first();
        $customers = Customer::all(); 
        $products = Product::all();
        $supirs = Supir::all(); 
        if($check_access->kelola_akun == 1){
        	$sj = SuratJalan::with('product', 'customer', 'transaksi')
            ->orderBy('no_surat', 'DESC')
            ->get();
        	return view('surat_jalan.index', compact('sj', 'market', 'customers', 'products', 'supirs'));
        }else{
            return back();
        }
    }

    public function viewNewSuratJalan()
    {
        $market = Market::first();
        $id_account = Auth::id();
        $check_access = Acces::where('user', $id_account)->first();
        $customers = Customer::all(); 
        // dd($customers);
        $products = Product::all(); 
        $supirs = Supir::all(); 
        $transasksi = Transaction::select('kode_transaksi')
        ->distinct('kode_transaksi')
        ->orderBy('kode_transaksi', 'DESC')
        ->get();

        if($check_access->kelola_akun == 1){
            return view('surat_jalan.new_sj', compact('market', 'customers', 'products', 'supirs', 'transasksi'));
        }else{
            return back();
        }
    }

    public function getProductsByTransaction($kode_transaksi)
    {
        $products = Transaction::with('customer', 'sj')->where('kode_transaksi', $kode_transaksi)
            ->select('kode_barang', 'nama_barang', 'id_customer', 'jumlah', 'harga', 'metodePem', 'status')
            ->get();
            // dd($products);
        return response()->json($products);
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

    public function createSuratJalan(Request $req)
    {
        $id_account = Auth::id();
        $check_access = Acces::where('user', $id_account)->first();
    
        if($check_access->kelola_akun == 1) {
            $selectedProduct = $req->input('selected_product');
            
            $sj = new SuratJalan;
            $sj->no_surat = $req->no_surat;
            $sj->kode_transaksi = $req->kode_transaksi;
            $sj->id_customer = $req->id_cust;
            $sj->id_supir = $req->id_supir;
            $sj->ekspedisi = $req->ekspedisi;
            $sj->tgl_jalan = $req->tgl_jalan;
            $sj->kode_barang = $selectedProduct;
            $sj->status = 1;
            // dd($sj);
            $sj->save();

            Transaction::where('kode_transaksi', $req->kode_transaksi)
                ->where('kode_barang', $selectedProduct)
                ->update(['status' => 1]);
    
            Session::flash('create_success', 'Surat Jalan baru berhasil dibuat');

            return response()->json(['success' => true]);
        } else {
            return back();
        }
    }

    public function editSuratJalan($id)
    {
        $id_account = Auth::id();
        $check_access = Acces::where('user', $id_account)
        ->first();
        if($check_access->kelola_akun == 1){
            $sj = SuratJalan::find($id);

            return response()->json(['sj' => $sj]);
        }else{
            return back();
        }
    }

    public function detailSuratJalan($id)
    {
        $id_account = Auth::id();
        $check_access = Acces::where('user', $id_account)
        ->first();
        if($check_access->kelola_akun == 1){
            $sj = SuratJalan::find($id);

            return response()->json(['sj' => $sj]);
        }else{
            return back();
        }
    }

    public function updateSuratJalan(Request $req)
    {
        $id_account = Auth::id();
        $check_access = Acces::where('user', $id_account)->first();
        
        if($check_access->kelola_akun == 1){

        	$sj = SuratJalan::find($req->id);
            $sj->no_surat = $req->no_surat;
            $sj->id_customer = $req->id_customer;
            $sj->id_product = $req->id_product;
            $sj->tgl_jalan = $req->tgl_jalan;
            $sj->pembayaran = $req->pembayaran;
            $sj->jumlah = $req->jumlah;
            $sj->id_supir = $req->id_supir;
            $sj->ekspedisi = $req->ekspedisi;
            // dd($sj);
            $sj->save();

            Session::flash('create_success', 'Surat Jalan baru berhasil dibuat');

            return redirect('/surat-jalan');
        }else{
            return back();
        }     
    }        

    public function deleteSuratJalan($id)
    {
        $id_account = Auth::id();
        $check_access = Acces::where('user', $id_account)
        ->first();
        if($check_access->kelola_akun == 1){
            SuratJalan::destroy($id);
            Acces::where('user', $id)->delete();

            Session::flash('delete_success', 'Surat Jalan berhasil dihapus');

            return back();
        }else{
            return back();
        }
    }

    public function detail($id)
    {
        $suratJalan = SuratJalan::with('product', 'customer', 'transaksi', 'supir')->findOrFail($id);
        $market = Market::first();
        $user = User::first();

        return view('surat_jalan.detail', compact('suratJalan', 'market', 'user'));
    }

    public function cetakSJ($id)
    {
        $suratJalan = SuratJalan::with('product', 'customer', 'transaksi', 'supir')->findOrFail($id);
        $market = Market::first();
        $user = User::first();

        $pdf = PDF::loadView('surat_jalan.cetakSJ', compact('suratJalan', 'market', 'user'));
        return $pdf->download('surat_jalan_' . $suratJalan->id . '.pdf');
    }
}
