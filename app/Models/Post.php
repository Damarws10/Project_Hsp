<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class Post extends Model
{
    protected $table = 'jabatan';


	public function addAccess($data)
	{
		DB::table('users')->insert($data);
	}

	public function updateAccess($id, $data){
		DB::table('users')->where('id', $id)->update($data);
	}

	public function deleteAccess($id){
		DB::table('users')->where('id', $id)->delete();
	}

	public function user(){
		return DB::table('users')
            ->select('*','jabatan.id_jabatan','jabatan.nama_jabatan')
            ->leftJoin('jabatan', 'users.id_jabatan', '=', 'jabatan.id_jabatan')
            ->get();
	}

	//Jumlah user
	public function UserJumlah(){
		return DB::table('users')->select('id')->where('role','=','user')->count();
	}

	public function KendaraanJumlah(){
		return DB::table('kendaraan')->select('id_kendaraan')->count();
	}

	public function jumlahKendaraanTerpakai(){
		return DB::table('transaksi_kendaraan')->select('id_transaksi')->count();
	}

	public function kendaraan_search($search){
            return DB::table('kendaraan')
            ->join('keterangan as ketstatus', 'kendaraan.status', '=', 'ketstatus.id_status')
            ->join('model_kendaraan', 'kendaraan.mrk_kendaraan', '=', 'model_kendaraan.mrk_kendaraan')
            ->join('jns_kendaraan', 'kendaraan.tp_kendaraan', '=', 'jns_kendaraan.tp_kendaraan')
            ->join('keterangan as ketIdpinjam', 'kendaraan.id_ketPinjam', '=', 'ketIdpinjam.id_status')
            ->select('kendaraan.*',
                       'model_kendaraan.mrk_kendaraan',
                       'ketstatus.id_status',
                       'ketstatus.status as status',
                       'ketIdpinjam.status as statusPinjam')
            ->where('no_plat', 'LIKE', "%{$search}%")
            ->orWhere('nama_kendaraan', 'LIKE', "%{$search}%")
            ->latest()->paginate(5);
    }

	public function kendaraan_info(){
		return DB::table('kendaraan')
            ->join('keterangan as ketstatus', 'kendaraan.status', '=', 'ketstatus.id_status')
            ->join('model_kendaraan', 'kendaraan.mrk_kendaraan', '=', 'model_kendaraan.mrk_kendaraan')
            ->join('jns_kendaraan', 'kendaraan.tp_kendaraan', '=', 'jns_kendaraan.tp_kendaraan')
            ->join('keterangan as ketIdpinjam', 'kendaraan.id_ketPinjam', '=', 'ketIdpinjam.id_status')
            ->select('kendaraan.*',
            	     'model_kendaraan.mrk_kendaraan',
            	     'ketstatus.id_status',
            	     'ketstatus.status as status',
            	     'ketIdpinjam.status as statusPinjam')
            ->get();
	}

	public function kendaraan_infoPaginate(){
		return DB::table('kendaraan')
            ->join('keterangan as ketstatus', 'kendaraan.status', '=', 'ketstatus.id_status')
            ->join('model_kendaraan', 'kendaraan.mrk_kendaraan', '=', 'model_kendaraan.mrk_kendaraan')
            ->join('jns_kendaraan', 'kendaraan.tp_kendaraan', '=', 'jns_kendaraan.tp_kendaraan')
            ->join('keterangan as ketIdpinjam', 'kendaraan.id_ketPinjam', '=', 'ketIdpinjam.id_status')
            ->select('kendaraan.*',
            	     'model_kendaraan.mrk_kendaraan',
            	     'ketstatus.id_status',
            	     'ketstatus.status as status',
            	     'ketIdpinjam.status as statusPinjam')
            ->latest()->paginate(6);
	}

	public function addAccesskendaraan($data){
		DB::table('kendaraan')->insert($data);	
	}

	public function updateAccess_kendaraan($id, $data){
		DB::table('kendaraan')->where('id_kendaraan', $id)->update($data);
	}

	public function deleteAccess_kendaraan($id){
		DB::table('kendaraan')->where('id_kendaraan', $id)->delete();
	}

	public function getId($id){
		return DB::table('kendaraan')->where('id_kendaraan', $id)->pluck('foto');
	}

	public function transaksi_kendaraan($id){
		return DB::table('transaksi_kendaraan')
		->join('users', 'users.id', '=', 'transaksi_kendaraan.id_user')
		->join('kendaraan', 'kendaraan.no_plat', '=', 'transaksi_kendaraan.no_plat')
		->join('keterangan as statusPinjam', 'statusPinjam.id_status', '=', 'transaksi_kendaraan.keterangan')
		->leftJoin('keterangan as status_aprove', 'status_aprove.id_status', '=', 'transaksi_kendaraan.status_approve')
		->leftJoin('keterangan as pengembalian', 'pengembalian.id_status', '=', 'transaksi_kendaraan.status_pengembalian')
		->select('transaksi_kendaraan.id_user',
				 'transaksi_kendaraan.id_transaksi',
				 'transaksi_kendaraan.tgl_peminjaman',
				 'transaksi_kendaraan.tgl_pengembalian',
				 'users.name',
				 'kendaraan.no_plat',
				 'kendaraan.foto',
				 'statusPinjam.status as statpinjam',
				 'status_aprove.status as statapprove',
				 'pengembalian.status as statpengembalian',
				 'transaksi_kendaraan.keterangan')
		->where('id_user', $id)->get();
	}

	public function transaksi_kendaraan_superuser(){
		return DB::table('transaksi_kendaraan')
		->join('users', 'users.id', '=', 'transaksi_kendaraan.id_user')
		->join('kendaraan', 'kendaraan.no_plat', '=', 'transaksi_kendaraan.no_plat')
		->join('keterangan as statusPinjam', 'statusPinjam.id_status', '=', 'transaksi_kendaraan.keterangan')
		->leftJoin('keterangan as status_aprove', 'status_aprove.id_status', '=', 'transaksi_kendaraan.status_approve')
		->leftJoin('keterangan as pengembalian', 'pengembalian.id_status', '=', 'transaksi_kendaraan.status_pengembalian')
		->select('transaksi_kendaraan.id_user',
				 'transaksi_kendaraan.id_transaksi',
				 'transaksi_kendaraan.tgl_peminjaman',
				 'transaksi_kendaraan.tgl_pengembalian',
				 'users.name',
				 'kendaraan.no_plat',
				 'kendaraan.foto',
				 'statusPinjam.status as statpinjam',
				 'status_aprove.status as statapprove',
				 'pengembalian.status as statpengembalian',
				 'transaksi_kendaraan.keterangan')
		->get();
	}

	public function transaksi_kendaraan_create($data){
		DB::table('transaksi_kendaraan')->insert($data);	
	}

	public function update_kendaraan($id, $data){
		DB::table('transaksi_kendaraan')->where('id_transaksi', $id)->update($data);
	}

	public function deleteAccess_transaksi($id){
		DB::table('transaksi_kendaraan')->where('id_transaksi', $id)->delete();	
	}

	//update data kendaraan dipakai
	public function updateApprove_kendaraan($no_plat, $data){
		DB::table('kendaraan')->where('no_plat', $no_plat)->update($data);
	}

	public function historikendaraan($id){
		return DB::table('histori_kendaraan')
		->join('users', 'users.id', '=', 'histori_kendaraan.id_user')
		->select('histori_kendaraan.*','users.name')
		->where('id_user', $id)
		->get();
	}


	public function historikendaraan_superuser(){
		return DB::table('histori_kendaraan')
		->join('kendaraan', 'histori_kendaraan.no_plat', '=', 'kendaraan.no_plat')
		->select('kendaraan.id_kendaraan as plat_id','histori_kendaraan.no_plat','kendaraan.nama_kendaraan','kendaraan.mrk_kendaraan')->groupBy('plat_id','no_plat','nama_kendaraan','mrk_kendaraan')->get();
	}

	public function hitungpemakaian($no_plat){
		return DB::table('histori_kendaraan')->select('no_plat')
				->where('no_plat', $no_plat)
				->count();
	}

	public function tanggalpemakaian($no_plat){
		return DB::table('histori_kendaraan')->select('approve_pengembalian')
				->where('no_plat', $no_plat)
				->orderBy('approve_pengembalian', 'desc')
				->first();
	}

	public function historikendaraanDetail($no_plat){
      return DB::table('histori_kendaraan')
                ->where('no_plat', $no_plat)
                ->select('no_plat', 'approve_pengembalian')
                ->first();
	}

	public function userhistori($no_plat){
		return DB::table('histori_kendaraan')
                ->where('no_plat', $no_plat)
                ->select('users.name')
                ->leftjoin('users', 'histori_kendaraan.id_user', '=', 'users.id')
                ->orderBy('histori_kendaraan.tanggal_request', 'desc')
                ->first();
	}

	public function CreatedByhistori($no_plat){
		return DB::table('histori_kendaraan')
		->select('histori_kendaraan.updated_by','users.name')
		->Leftjoin('users', 'histori_kendaraan.updated_by', '=', 'users.id')
		->where('no_plat', $no_plat)
		->orderBy('histori_kendaraan.approve_pengembalian', 'desc')
		->first();
	}
	

	public function showGambarhistori($no_plat){
		return DB::table('histori_kendaraan')
		->select('kendaraan.foto')
		->join('kendaraan', 'histori_kendaraan.no_plat', '=', 'kendaraan.no_plat')
		->where('histori_kendaraan.no_plat', $no_plat)
		->first();
	}

	public function storehistorikendaraan($data){
		DB::table('histori_kendaraan')->insert($data);	
	}

	public function updatehistorikendaraan($id, $data){
		DB::table('histori_kendaraan')->where('tanggal_request', $id)->update($data);	
	}

	public function profil($id){
		return DB::table('users')
		->join('jabatan', 'users.id_jabatan', '=', 'jabatan.id_jabatan')
		->select('users.*','jabatan.nama_jabatan')
		->where('id', $id)->get();
	}

	public function getFotoUser($id){
		return DB::table('users')->where('id', $id)->pluck('foto_user');
	}

	public function profileUpdate($id, $data){
		DB::table('users')->where('id', $id)->update($data);
	}

	public function Fotouser($id){
		return DB::table('users')->select('foto_user')->where('id', $id)->first();
	}

	public function approvePersetujuan($id, $data){
		DB::table('transaksi_kendaraan')->where('id_transaksi', $id)->update($data);
	}

	public function detailHistorikendaraan($no_plat){
		return DB::table('histori_kendaraan')
						->join('users as usersName', 'usersName.id', '=', 'histori_kendaraan.id_user')
						->leftJoin('keterangan', 'keterangan.id_status', '=', 'histori_kendaraan.keterangan')
						->leftJoin('users as updatedName', 'updatedName.id', '=', 'histori_kendaraan.updated_by')
						->select('histori_kendaraan.*', 
								'usersName.name as userName',
								'keterangan.status as keteranganStats',
								'updatedName.name as updateName')
						->where('no_plat', $no_plat)
						->get();
	}
}