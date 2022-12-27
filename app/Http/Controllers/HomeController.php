<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

use Auth;
use Carbon\Carbon;
use Redirect,Response;

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

        $data=[
            'userJumlah' => $this->post->UserJumlah(),
            'kendaraanJumlah' => $this->post->KendaraanJumlah(),
            'kendaraanTerpakai' => $this->post->jumlahKendaraanTerpakai()
        ];

        $kendaraan = $this->post->kendaraan_infoPaginate();

        // print_r($data);
        return view('home', $data, compact('kendaraan'));
    }

    public function search_kendaraan(Request $request){
        
        $search = $request->input('search');

        $data=[
            'userJumlah' => $this->post->UserJumlah(),
            'kendaraanJumlah' => $this->post->KendaraanJumlah(),
            'kendaraanTerpakai' => $this->post->jumlahKendaraanTerpakai(),
            'kendaraan' => $this->post->kendaraan_search($search)    
        ];

        // print_r($dataSearch);
        return view('search', $data);
    }

    public function profile()
    {
        $id= Auth::user()->id;  
        $user = $this->post->profil($id);

        $user2 = DB::table('users')->where('id', $id)->get();

        $foto_user  = $this->post->Fotouser($id);

        return view('profile', compact('user', 'user2','foto_user'));
    }

    //Profile Update by User
    public function profileUpdate(Request $request){

        $this->validate($request,[
            'foto' => 'image|mimes:png,jpg,jpeg',
            'nama' => 'required',
            'email' => 'required|string|email|max:255',
            'no_tlpn' => 'required',
            'alamat'=> 'required', 
        ]);

        $email = Auth::user()->email;
        $id = Auth::user()->id;
        $foto = $request->file('foto');

        if($email == $request->email && empty($foto)){
            $data = ([
                'name' => $request->nama,
                'no_tlpn' => $request->no_tlpn,
                'alamat' => $request->alamat,
                'jns_klmn' => $request->jns_klmn
            ]);
        }else if($email != $request->email){

            $getData = $this->post->getFotoUser($id);

            foreach ($getData as $value) {
                $get = $value;
            }
            
            // Storage Delete
            if(File::exists('uploads/user/'.$get)){
                File::delete('uploads/user/'.$get);
            }

            // upload image

            $nama_file = time()."_".$foto->getClientOriginalName();
            $foto->move('uploads/user/', $nama_file);

            $data = ([
                'name' => $request->nama,
                'email' => $request->email,
                'foto_user' => $nama_file,
                'no_tlpn' => $request->no_tlpn,
                'alamat' => $request->alamat,
                'jns_klmn' => $request->jns_klmn
            ]);
        }else{
            $getData = $this->post->getFotoUser($id);

            foreach ($getData as $value) {
                $get = $value;
            }
            
            // Storage Delete
            if(File::exists('uploads/user/'.$get)){
                File::delete('uploads/user/'.$get);
            }
            // upload image

            $nama_file = time()."_".$foto->getClientOriginalName();
            $foto->move('uploads/user/', $nama_file);

            $data = ([
                'name' => $request->nama,
                'foto_user' => $nama_file,
                'no_tlpn' => $request->no_tlpn,
                'alamat' => $request->alamat,
                'jns_klmn' => $request->jns_klmn
            ]);
        }

        $this->post->profileUpdate($id, $data);

        return redirect()->route('profile')->with(['success' => 'Data Berhasil DiUpdate!']);
    }

    //Update password user
    public function changePassword(Request $request){

        $request->validate([
            'password' => ['required', 'string', 'min:8', 'confirmed']
        ]);

        $currentPasswordStatus = Hash::check($request->password, auth()->user()->password);

        if(!$currentPasswordStatus){

            // echo "berhasil";

            User::findOrFail(Auth::user()->id)->update([
                'password' => Hash::make($request->password),
            ]);

            return redirect()->back()->with('message','Password Updated Successfully');
        }else{
            // echo "Tidak berhasil";

            return redirect()->back()->with('message','Masukkan Password Terbaru');
        }
    }

    public function transaksikendaraan(){

        $id = Auth::user()->id;

        $kendaraan = $this->post->kendaraan_info();



        if(Auth::user()->role == "superuser" || Auth::user()->role == "admin" ){
            $histori = $this->post->transaksi_kendaraan_superuser();
        }else{
            $histori = $this->post->transaksi_kendaraan($id);
        }
        $kendaraan = DB::table('kendaraan')->get();
        return view('transaksikendaraan', compact('histori', 'kendaraan'));
    }

    public function approveKendaraan($id){

        date_default_timezone_set('Asia/Jakarta');

        $getTanggal = DB::table('transaksi_kendaraan')->select('tgl_peminjaman', 'no_plat')->where('id_transaksi', $id)->get();

        $id_super = Auth::user()->id;

        foreach ($getTanggal as $key) {
            $tanggal = $key->tgl_peminjaman;
            $no_plat = $key->no_plat;
        }

        $data=([
            'status_approve' => 9
        ]);

        $statusTerpakai=([
            'id_ketPinjam' => 5
        ]);

        $waktunow = Carbon::now()->format('Y-m-d H:i');
        $datarequest=([
            'approve_request' => $waktunow,
            'updated_by'=> $id_super,
            'keterangan' => 9
        ]);

        // print_r($data);
        // print_r($statusTerpakai);

        $this->post->approvePersetujuan($id,$data);
        $this->post->updateApprove_kendaraan($no_plat, $statusTerpakai);
        $this->post->updatehistorikendaraan($tanggal, $datarequest);


        return redirect()->route('transaksikendaraan')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    public function approveKendaraankembali($id){
        
        date_default_timezone_set('Asia/Jakarta');        

        $getTanggal = DB::table('transaksi_kendaraan')->select('tgl_peminjaman', 'no_plat')->where('id_transaksi', $id)->get();

        $id_super = Auth::user()->id;

        foreach ($getTanggal as $key) {
            $tanggal = $key->tgl_peminjaman;
            $no_plat = $key->no_plat;
        }

        $data=([
            'status_pengembalian' => 11
        ]);

         $statusTerpakai=([
            'id_ketPinjam' => 6
        ]);

        $waktunow = Carbon::now()->format('Y-m-d H:i');
        $datarequest=([
            'approve_pengembalian' => $waktunow,
            'updated_by'=> $id_super
        ]);

        // print_r($data);
        $this->post->approvePersetujuan($id,$data);
        //masuk ke database histori
        $this->post->updatehistorikendaraan($tanggal, $datarequest);
        //masuk ke database kendaraan kembali
        $this->post->updateApprove_kendaraan($no_plat, $statusTerpakai);
        //delete
        $this->post->deleteAccess_transaksi($id);

        return redirect()->route('transaksikendaraan')->with(['warning' => 'Mobil Telah dikembalikan data Dihapus!']);
    }

    public function store_transaksi(Request $request){

        $no_plat = Request()->no_plat;

        $this->validate($request,[
            'no_plat' => 'required|unique:transaksi_kendaraan',
            'tgl_pinjam' => 'required',
            'tgl_pengembalian' => 'required'
        ]);

        $data=([
            'id_user' => $request->id,
            'no_plat' => $request->no_plat,
            'tgl_peminjaman' => $request->tgl_pinjam,
            'tgl_pengembalian' => $request->tgl_pengembalian,
            'keterangan' => $request->keter,
            'created_by' => $request->id,
        ]);

        $statusTerpakai=([
            'id_ketPinjam' => 11
        ]);

        $data2=([
            'id_user' => $request->id,
            'no_plat' => $request->no_plat,
            'tanggal_request' => $request->tgl_pinjam,
            'tanggal_pengembalian' => $request->tgl_pengembalian,
            'created_by' => $request->id
        ]);


        // print_r($data);
        // print_r($data2);

        $this->post->transaksi_kendaraan_create($data);
        $this->post->storehistorikendaraan($data2);

        //update pada kendaraan
         $this->post->updateApprove_kendaraan($no_plat, $statusTerpakai);             

        if($data&&$data2){
            return redirect()->route('home')->with(['success' => 'Data Berhasil Disimpan!']);
        }else{
            return redirect()->route('home')->with(['Danger' => 'Data Tidak Berhasil Disimpan!']);
        }
    }

    //update transaksi kendaraan
    public function update_transaksiKendaraan(Request $request)
    {
        //echo "test";
        date_default_timezone_set('Asia/Jakarta');
        $id_super = Auth::user()->id;

        $id = Request()->id_gue;
        $id_histori = Request()->tgl_pinjam;
        $approve = Request()->approve_stats;
        $no_plat = Request()->no_plat;

        
        $data=([
            'id_user' => $request->id,
            'no_plat' => $request->no_plat,
            'tgl_peminjaman' => $request->tgl_pinjam,
            'keterangan' => $request->keter,
            'status_approve' => $request->approve_stats,
            'status_pengembalian' => $request->approve_pengembalian,
            'update_by' => $id_super,
            'updated_at' => Carbon::now()->format('Y-m-d H:i')

        ]);

         $statusTerpakaiPengembalian=([
                'id_ketPinjam' => 6
            ]);


        if($approve == 9){
            $waktunow = Carbon::now()->format('Y-m-d H:i');
            $data1=([
                'id_user' => $request->id,
                'no_plat' => $request->no_plat,
                'approve_request' => $waktunow,
                'updated_by'=> $id_super
            ]);

            $statusTerpakai=([
                'id_ketPinjam' => 5
            ]);

        }else{
            $waktunow = Carbon::now()->format('Y-m-d H:i');
            $data1=([
                'id_user' => $request->id,
                'no_plat' => $request->no_plat,
                'approve_pengembalian' => $waktunow,
                'updated_by'=> $id_super
            ]);

            $statusTerpakai=([
                'id_ketPinjam' => 6
            ]);
        }


        // print_r($data);
        // print_r($data1);

        if($request->approve_stats == 9 && $request->approve_pengembalian == 11 ){
        //update data waktu
           $this->post->updatehistorikendaraan($id_histori, $data1);

           $this->post->updateApprove_kendaraan($no_plat, $statusTerpakaiPengembalian);

        //hapus setelah transaksi
           $this->post->deleteAccess_transaksi($id);
        }else if($request->approve_stats == 9){
        //menyimpan data setelah update by superuser
           $this->post->update_kendaraan($id, $data);

           $this->post->updatehistorikendaraan($id_histori, $data1);

        $this->post->updateApprove_kendaraan($no_plat, $statusTerpakai);

        }else if($request->approve_pengembalian == 11){
        //update data waktu
           $this->post->updatehistorikendaraan($id_histori, $data1);
        //update pada kendaraan
         $this->post->updateApprove_kendaraan($no_plat, $statusTerpakai);
        //hapus data setelah transaksi
           $this->post->deleteAccess_transaksi($id);
        }

        if($data && $data1){
            return redirect()->route('transaksikendaraan')->with(['info' => 'Data Berhasil diupdate!']);
            }else{
            return redirect()->route('transaksikendaraan')->with(['info' => 'Data Tidak Berhasil diupdate!']);
        }
    }

    public function deleteTransaksi(Request $request){


        $id = Request()->id_gue;

        $getTanggal = DB::table('transaksi_kendaraan')->select('tgl_peminjaman', 'no_plat')->where('id_transaksi', $id)->get();

        foreach ($getTanggal as $key) {
            $tanggal = $key->tgl_peminjaman;            
        }

        $id_super = Auth::user()->id;

        $datarequest=([
            'updated_by'=> $id_super,
            'keterangan' => 10
        ]);


        $no_plat = Request()->no_plat;
        $statusTerpakai = ([
            'id_ketPinjam' => 6
        ]);

        //masuk ke database histori
        $this->post->updatehistorikendaraan($tanggal, $datarequest);
        //masuk ke database kendaraan kembali
        $this->post->updateApprove_kendaraan($no_plat, $statusTerpakai);
        // print($id);
        $this->post->deleteAccess_transaksi($id);
     
        return redirect()->route('transaksikendaraan')->with(['delete' => 'Data Berhasil diHapus!']);
    }

    public function historikendaraan()
    {
        date_default_timezone_set('Asia/Jakarta');

        $id = Auth::user()->id;
        $user = Auth::user()->role;

        $user_histori = DB::table('histori_kendaraan')
                        ->leftJoin('users','users.id','=','histori_kendaraan.updated_by')
                        ->select('histori_kendaraan.*','users.name')
                        ->get();

       $detail_histori = DB::table('histori_kendaraan')
        ->join('kendaraan', 'histori_kendaraan.no_plat', '=', 'kendaraan.no_plat')
        ->select('kendaraan.id_kendaraan as id_plat','histori_kendaraan.no_plat')->groupBy('no_plat','id_plat')->get();

        

        if($user == "superuser" || $user == "admin"){
            $histori = $this->post->historikendaraan_superuser();
        }else{
            $histori = $this->post->historikendaraan($id);
        }

        // print_r($histori);

        return view('historikendaraan', compact('histori','user_histori','detail_histori'));
    }

    //detail kendaraan

    function detailkendaraan($no_plat){
        
        $itemtransaksi = $this->post->historikendaraanDetail($no_plat);
        $tanggalpemakaian = $this->post->tanggalpemakaian($no_plat);
        $userhistori = $this->post->userhistori($no_plat);
        $CreatedByhistori = $this->post->CreatedByhistori($no_plat);
        //$showGambarhistori = $this->post->showGambarhistori($no_plat);
        $detailkend = $this->post->detailHistorikendaraan($no_plat);

        if($itemtransaksi){

            $data = [
                     'NomerPlat' => $itemtransaksi->no_plat,
                     'itemtransaksi' => $itemtransaksi->approve_pengembalian,
                     'hitungpemakaian' => $this->post->hitungpemakaian($no_plat),
                     'tanggalBaru' => $tanggalpemakaian->approve_pengembalian,
                     'userhistori' => $userhistori->name,
                     'CreatedByhistori' =>$CreatedByhistori->name,
                     //'showGambarhistori' => $showGambarhistori->foto,
                     'ShowDetailKendaraan' => $detailkend
                    ];
            // print_r($data);

                    
            return view('detailkendaraan',$data);
        }else{
            return abort('404');
        }

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
            'foto' => 'required|image|mimes:png,jpg,jpeg|max:1572',
            'thn_pembuatan' => 'required',
            'warna' => 'required',
            'tipe_kendaraan' => 'required',
            'tipe' => 'required',
            'merek_kendaraan' => 'required',
            'status' => 'required',
            'tgl_stnk' => 'required'
        ]);

        //upload image
        $foto = $request->file('foto');
        $nama_file = time()."_".$foto->getClientOriginalName();
        $foto->move('uploads/kendaraan/', $nama_file);
 
        $data=([
            'no_plat' => $request->no_plat,
            'nama_kendaraan' => $request->nama_kendaraan,
            'foto' => $nama_file,
            'thn_buat' => $request->thn_pembuatan,
            'warna' => $request->warna,
            'tipe' => $request->tipe_kendaraan,
            'tp_kendaraan' => $request->tipe,
            'mrk_kendaraan' => $request->merek_kendaraan,
            'status' => $request->status,
            'id_ketPinjam'=> 6,
            'tgl_pajak' => $request->tgl_stnk,
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
        date_default_timezone_set('Asia/Jakarta');
        
        $kendaraan = $this->post->kendaraan_info();
        $model = DB::table('model_kendaraan')->get();
        $tipe = DB::table('jns_kendaraan')->get();

        // dump($kendaraan);

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
                'tipe' => $request->tipe_kendaraan,
                'tp_kendaraan' => $request->tipe,
                'mrk_kendaraan' => $request->merek_kendaraan,
                'status' => $request->status,
                'tgl_pajak' => $request->tgl_stnk,
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
            $nama_file = time()."_".$foto->getClientOriginalName();
            $foto->move('uploads/kendaraan/', $nama_file);         

            $data=([
                'no_plat' => $request->no_plat,
                'nama_kendaraan' => $request->nama_kendaraan,
                'foto' => $nama_file,
                'thn_buat' => $request->thn_pembuatan,
                'warna' => $request->warna,
                'tipe' => $request->tipe_kendaraan,
                'tp_kendaraan' => $request->tipe,
                'mrk_kendaraan' => $request->merek_kendaraan,
                'status' => $request->status,
                'tgl_pajak' => $request->tgl_stnk,
                'updated_at' => Carbon::now()->format('Y-m-d H:i'),
                'updated_by' => $request->id_user
            ]);
        }

        // print_r($data);

        // dump($request->all());

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
