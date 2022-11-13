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

	public function kendaraan_info(){
		return DB::table('kendaraan')
            ->join('keterangan', 'kendaraan.status', '=', 'keterangan.id_status')
            ->join('model_kendaraan', 'kendaraan.mrk_kendaraan', '=', 'model_kendaraan.mrk_kendaraan')
            ->join('jns_kendaraan', 'kendaraan.tp_kendaraan', '=', 'jns_kendaraan.tp_kendaraan')
            ->select('kendaraan.*','model_kendaraan.mrk_kendaraan', 'keterangan.id_status', 'keterangan.status')
            ->get();
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

	public function transaksi_kendaraan(){
		return DB::table('transaksi_kendaraan')
		->join('users', 'users.id', '=', 'transaksi_kendaraan.id')
		->join('kendaraan', 'kendaraan.no_plat', '=', 'transaksi_kendaraan.no_plat')
		->join('keterangan', 'keterangan.id_status', '=', 'transaksi_kendaraan.keterangan')
		->select('transaksi_kendaraan.id_transaksi','transaksi_kendaraan.tgl_peminjaman','users.name','kendaraan.no_plat','kendaraan.foto','keterangan.status', 'transaksi_kendaraan.keterangan')->get();
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
}
