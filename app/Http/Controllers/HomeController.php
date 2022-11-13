<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

use Carbon\Carbon;

Use App\Models\Post;
Use App\Models\User;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    protected $post;
    
    public function __construct()
    {
        $this->post = new Post();
        $this->middleware('auth');
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function profile()
    {
        return view('profile');
    }

    public function historikendaraan(){

        $histori = $this->post->transaksi_kendaraan();
        $kendaraan = DB::table('kendaraan')->get();
        return view('historikendaraan', compact('histori', 'kendaraan'));
    }

    public function store_transaksi(Request $request){

        $this->validate($request,[
            'no_plat' => 'required|unique:transaksi_kendaraan',
            'tgl_pinjam' => 'required'
        ]);

        $data=([
            'id' => $request->id,
            'no_plat' => $request->no_plat,
            'tgl_peminjaman' => $request->tgl_pinjam,
            'keterangan' => $request->keter,
            'created_by' => $request->id
        ]);


        // print_r($data);

        $this->post->transaksi_kendaraan_create($data);                

        if($data){
            return redirect()->route('historikendaraan')->with(['success' => 'Data Berhasil Disimpan!']);
        }else{
            return redirect()->route('historikendaraan')->with(['Danger' => 'Data Tidak Berhasil Disimpan!']);
        }
    }

    //update transaksi kendaraan
    public function update_transaksiKendaraan(Request $request)
    {
        //echo "test";
        date_default_timezone_set('Asia/Jakarta');

        $id = Request()->id_gue;

        $data=([
            'id' => $request->id,
            'no_plat' => $request->no_plat,
            'tgl_peminjaman' => $request->tgl_pinjam,
            'keterangan' => $request->keter,
            'update_by' => $request->id,
            'updated_at' => Carbon::now()->format('Y-m-d H:i')

        ]);
        // print_r($data);
        // echo $id;
  
        $this->post->update_kendaraan($id, $data);
     
       if($data){
        return redirect()->route('historikendaraan')->with(['info' => 'Data Berhasil diupdate!']);
        }else{
        return redirect()->route('historikendaraan')->with(['info' => 'Data Tidak Berhasil diupdate!']);
        }
    }

    public function deleteTransaksi(Request $request){
        $id = Request()->id_gue;

        // print($id);
        $this->post->deleteAccess_transaksi($id);
     
        return redirect()->route('historikendaraan')->with(['delete' => 'Data Berhasil diHapus!']);
    }

    public function formuser(){
        $user= Post::all();
        return view('formuser', ['user'=>$user]);
    }

    public function post(Request $request)
    {
        $this->validate($request,[
            'email' => ['required','string','email','max:255','unique:users'],
            'nama' => 'required',
            'inputPassword' => 'required',
            'alamat' => 'required',
            'no_tlpn' => 'required',
            'jabatan' => 'required',
            'jns_klmn' => 'required',
            'role' => 'required'
        ]);
 
        $data=([
            'email' => $request->email,
            'name' => $request->nama,
            'password' => Hash::make(Request()->inputPassword),
            'no_tlpn' => $request->no_tlpn,
            'alamat' => $request->alamat,
            'id_jabatan' => $request->jabatan,
            'jns_klmn' => $request->jns_klmn,
            'role' => $request->role

        ]);

            $this->post->addAccess($data);
     
            return redirect()->route('formuser')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    public function informasiuser() 
    {  
        $user =  $this->post->user();
        $jabatan= Post::all();
        return view('informasiuser', ['user' => $user], ['jabatan' => $jabatan]);
    }

    public function update(Request $request)
    {
        //echo "test";
        date_default_timezone_set('Asia/Jakarta');        
        $id = Request()->id_gue;

        $data=([
            'name' => $request->nama,
            'no_tlpn' => $request->no_tlpn,
            'alamat' => $request->alamat,
            'id_jabatan' => $request->jabatan,
            'jns_klmn' => $request->jns_klmn,
            'role' => $request->role,
            'updated_at' => Carbon::now()->format('Y-m-d H:i')

        ]);
        // print_r($data);

            $this->post->updateAccess($id, $data);
     
            return redirect()->route('informasiuser')->with(['info' => 'Data Berhasil diupdate!']);
    }

    public function delete(Request $request){
        $id = Request()->id_gue;

        // print($id);
        $this->post->deleteAccess($id);
     
        return redirect()->route('informasiuser')->with(['delete' => 'Data Berhasil diHapus!']);
    }

    public function formkendaraan() 
    {
        $tipe = DB::table('jns_kendaraan')->get();
        $model = DB::table('model_kendaraan')->get();
        return view('formkendaraan', ['tipe' => $tipe], ['model' => $model]);
    }


    public function store_kendaraan(Request $request){

        $this->validate($request,[
            'no_plat' => 'required|unique:kendaraan',
            'nama_kendaraan' => 'required',
            'foto' => 'required|image|mimes:png,jpg,jpeg',
            'thn_pembuatan' => 'required',
            'warna' => 'required',
            'tipe' => 'required',
            'merek_kendaraan' => 'required',
            'status' => 'required'
        ]);

        //upload image
        $foto = $request->file('foto');
        $foto->storeAs('public', $foto->hashName());
 
        $data=([
            'no_plat' => $request->no_plat,
            'nama_kendaraan' => $request->nama_kendaraan,
            'foto' => $foto->hashName(),
            'thn_buat' => $request->thn_pembuatan,
            'warna' => $request->warna,
            'tp_kendaraan' => $request->tipe,
            'mrk_kendaraan' => $request->merek_kendaraan,
            'status' => $request->status,
            'created_by' => $request->id_user
        ]);
        
            $this->post->addAccesskendaraan($data);
            
            if($data){
            return redirect()->route('formkendaraan')->with(['success' => 'Data Berhasil Disimpan!']);
            }else{
            return redirect()->route('formkendaraan')->with(['danger' => 'Data Tidak Berhasil Disimpan!']);
            }

    }


    public function informasikendaraan() 
    {
        $kendaraan = $this->post->kendaraan_info();
        $model = DB::table('model_kendaraan')->get();
        $tipe = DB::table('jns_kendaraan')->get();
        return view('informasikendaraan', compact('kendaraan', 'model', 'tipe'));
    }

    //update Kendaraan
    public function update_kendaraan(Request $request)
    {
        date_default_timezone_set('Asia/Jakarta');
        //echo "test";
        
        $id = Request()->id_gue;
        // echo $getData;

        $this->validate($request,[
            'foto' => 'image|mimes:png,jpg,jpeg'
        ]);

        if(empty($request->file('foto'))){
            $data=([
                'no_plat' => $request->no_plat,
                'nama_kendaraan' => $request->nama_kendaraan,
                'thn_buat' => $request->thn_pembuatan,
                'warna' => $request->warna,
                'tp_kendaraan' => $request->tipe,
                'mrk_kendaraan' => $request->merek_kendaraan,
                'status' => $request->status,
                'updated_at' => Carbon::now()->format('Y-m-d H:i'),
                'updated_by' => $request->id_user
            ]);
        }else{
            $getData = $this->post->getId($id);

            foreach ($getData as $value) {
                $get = $value;
            }
            
            // Storage Delete
            Storage::delete('public/'.$get);

            // upload image
            $foto = $request->file('foto');
            $foto->storeAs('public', $foto->hashName());            

            $data=([
                'no_plat' => $request->no_plat,
                'nama_kendaraan' => $request->nama_kendaraan,
                'foto' => $foto->hashName(),
                'thn_buat' => $request->thn_pembuatan,
                'warna' => $request->warna,
                'tp_kendaraan' => $request->tipe,
                'mrk_kendaraan' => $request->merek_kendaraan,
                'status' => $request->status,
                'updated_at' => Carbon::now()->format('Y-m-d H:i'),
                'updated_by' => $request->id_user
            ]);
        }

        // print_r($data);

            $this->post->updateAccess_kendaraan($id, $data);
     
            if($data){
                return redirect()->route('informasikendaraan')->with(['info' => 'Data Berhasil diupdate!']);
            }else{
                return redirect()->route('informasikendaraan')->with(['danger' => 'Data Tidak Berhasil diupdate!']);
            }
    }

    public function delete_kendaraan(Request $request){
        $id = Request()->id_gue;

        $getData = $this->post->getId($id);

            foreach ($getData as $value) {
                $get = $value;
            }
            
        // Storage Delete
        Storage::delete('public/'.$get);

        $this->post->deleteAccess_kendaraan($id);

        if($id){
            return redirect()->route('informasikendaraan')->with(['delete' => 'Data Berhasil diHapus!']);

        }else{
            return redirect()->route('informasikendaraan')->with(['warning' => 'Data Tidak Berhasil diHapus!']);
        }
     
    }

}
