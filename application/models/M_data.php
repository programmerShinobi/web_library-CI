<?php

use phpDocumentor\Reflection\Types\False_;

defined('BASEPATH') OR exit('No direct script access allowed');

class M_data extends CI_Model {
	protected $response = [];

	//Fungsi Input Daata
	public function insertData($data,$table) {
		$insert = $this->db->insert($table,$data);
		if($insert) {
			$this->response['success'] = TRUE;
		} else {
			$this->response['failed'] = FALSE;
		}
		return $this->response;
	}

	//Fungsi Read Data
	public function getData($table)
	{
		$get = $this->db->get($table);
		if ($get) {
			return $get;
		} else {
			var_dump($get);
			return FALSE;
		}
	}

	//Fungsi Ambil Data tertetnu
	public function editData($where,$table, $limit = "") {
		$get = $this->db->where($where)->get($table, $limit);
		if ($get) {
			return $get;
		} else {
			return FALSE;
		}
	}
	
	//Fungsi Ambil 2 Data tertetnu
	public function editData_2($where1,$where2,$table, $limit = "") {
		$get = $this->db->where($where1)->where($where2)->get($table, $limit);
		if ($get) {
			return $get;
		} else {
			return FALSE;
		}
	}

	//Fungsi Update Data
	public function updateData($data,$where,$table)
	{
		$update = $this->db->where($where)->update($table,$data);
		if ($update) {
			$this->response['success'] = TRUE;
		} else {
			$this->response['failed'] = FALSE;
		}
		return $this->response;
	}

	//Fungsi hapus data
	public function deleteData($where,$table)
	{
		$delete = $this->db->delete($table,$where);
		if ($delete) {
			$this->response['success'] = TRUE;
		} else {
			$this->response['success'] = FALSE;
		}
		return $this->response;
	}

	//Join Access & Menu
	public function get_access_menu()
	{
		return $this->db->select('*')
										->from('tb_menu')
										->join('tb_access', 'tb_menu.menu_id = tb_access.menu_id')
										->where('tb_access.role_id = '.$this->session->userdata("role_id"))
										->get();
	}

	//Delete Menu, Access, Sub Menu
	public function delete_menu($where)
	{
		$delete_sub = $this->db->where($where)->delete("tb_sub");
		if ($delete_sub) {
			$delete_access = $this->db->where($where)->delete("tb_access");
			if ($delete_access) {
				$delete_menu = $this->db->where($where)->delete("tb_menu");
				if ($delete_sub) {
					return TRUE;
				} else {
					return FALSE;
				}
			} else {
				return FALSE;
			}
		} else {
			return False;
		}
	}

	//Join tb_access & tb_menu
	public function get_access_join_menu()
	{
		return $this->db->select('*')
										->from('tb_access')
										->join('tb_menu', 'tb_menu.menu_id = tb_access.menu_id')
										->get();
	}

	//Join tb_sub & tb_menu
	public function get_sub_join_menu()
	{
		return $this->db->select('*')
										->from('tb_sub')
										->join('tb_menu', 'tb_menu.menu_id = tb_sub.menu_id')
										->get();
	}

	//list user dengan role admin & petugas
	public function get_petugas()
	{
		return $this->db->select("*")
										->from("tb_user")
										->where("user_role = 2")
										->get();
	}

	//list user dengan role admin & petugas & petugas perpus Sekolah
	public function get_petugas_perpusSekolah()
	{
		return $this->db->select('*')
										->from('tb_user')
										->join('tb_sekolah', 'tb_user.sekolah_id = tb_sekolah.sekolah_id')
										->where("user_role = 4")
										->get();
	}

	//Get petugas perus sekolah detail
	public function get_petugas_perpusSekolah_detail($user_id)
	{
		return $this->db->select("*" )
										->from("`tb_user` tbu")
										->join("`tb_sekolah` tbs", "tbu.`sekolah_id` = tbs.`sekolah_id`")
										->join("`tb_klasifikasi` tbk", "tbu.`user_klasifikasi` = tbk.`pekerjaan_id`")
										->join("`tb_identitas_orangtua` tbio", "tbu.`user_id` = tbio.`orangtua_user`")
										->join("`tb_pertanyaan_keamanan` tbpk", "tbu.`user_id` = tbpk.`pertanyaan_user`")
										->where("tbu.`user_id` = ". $user_id)
										->get();
	}

	//Get petugas detail
	public function get_petugas_detail($petugas_id)
	{
		return $this->db->select("*")
		->from("`tb_user` tbu")
		->join("`tb_identitas_orangtua` tbio", "tbu.`user_id` = tbio.`orangtua_user`")
		->join("`tb_pertanyaan_keamanan` tbpk", "tbu.`user_id` = tbpk.`pertanyaan_user`")
		->where("tbu.`user_id` = " . $petugas_id)
			->get();
	}

	//Get user detail
	public function get_user_detail($user_id)
	{
		return $this->db->select("*")
										->from("`tb_user` tbu")
										->join("`tb_identitas_orangtua` tbio", "tbu.`user_id` = tbio.`orangtua_user`")
										->join("`tb_pertanyaan_keamanan` tbpk", "tbu.`user_id` = tbpk.`pertanyaan_user`")
										->where("tbu.`user_id` = ".$user_id)
										->get();
	}

	//Get pengunjung perpustakaan
	public function get_pengunjung_perpus($start, $end)
	{
		if ($start == null || $end == null) {
			// $start = date("Y-m-d", strtotime("-30Days"));
			// $end = date("Y-m-d");
			return $this->db->select("*")
			->from("`tb_pengunjung_perpus`")
			// ->where('pengunjung_tanggal BETWEEN "' . $start . '" AND "' . $end . '" ')
			->order_by("tb_pengunjung_perpus. `pengunjung_id`", "DESC")
			->get();
		} else {
			return $this->db->select("*")
			->from("`tb_pengunjung_perpus`")
			->where('pengunjung_tanggal BETWEEN "' . $start . '" AND "' . $end . '" ')
			->order_by("tb_pengunjung_perpus. `pengunjung_id`", "DESC")
			->get();
		}
	}

	//Get pengunjung perpustakaan
	public function get_pengunjung_website($start, $end)
	{
		if ($start == null || $end == null) {
			// $start = date("Y-m-d", strtotime("-30Days"));
			// $end = date("Y-m-d");
			return $this->db->select("*")
			->from("`tb_pengunjung`")
			// ->where('waktu BETWEEN "' . $start . '" AND "' . $end . '" ')
			->order_by("tb_pengunjung. `pengunjung_id`", "DESC")
			->get();
		} else {
			return $this->db->select("*")
			->from("`tb_pengunjung`")
			->where('waktu BETWEEN "' . $start . '" AND "' . $end . '" ')
			->order_by("tb_pengunjung. `pengunjung_id`", "DESC")
			->get();
		}
	}

	//Get pengunjung detail
	public function get_pengunjung_detail($pengunjung_id)
	{
	return $this->db->select("*")
					->from("`tb_pengunjung_perpus`")
					->where("`pengunjung_id` = ".$pengunjung_id)
					->get();
	}


	//Get peminjaman join user & Buku
	public function get_peminjaman($start, $end)
	{
		if ($start == null || $end == null) {
			// $start = date("Y-m-d", strtotime("-30Days"));
			// $end = date("Y-m-d");
			return $this->db->select("*")
				->from("`tb_peminjaman` tbp")
				->join("`tb_buku` tbb", "tbp.`peminjaman_buku` = tbb.`buku_id`")
				->join("`tb_user` tbu", "tbp.`peminjaman_user` = tbu.`user_id`")
				// ->where('peminjaman_dari BETWEEN "' . $start . '" AND "' . $end . '" ')
				->order_by("tbp. `peminjaman_id`", "DESC")
				->get();
		} else {
			return $this->db->select("*")
				->from("`tb_peminjaman` tbp")
				->join("`tb_buku` tbb", "tbp.`peminjaman_buku` = tbb.`buku_id`")
				->join("`tb_user` tbu", "tbp.`peminjaman_user` = tbu.`user_id`")
				->where('peminjaman_dari BETWEEN "' . $start . '" AND "' . $end . '" ')
				->order_by("tbp. `peminjaman_id`", "DESC")
				->get();
		}
	}

	public function get_pengembalianBukuProccesed($date)
	{
		return $this->db->select("*")
			->from("`tb_peminjaman` tbp")
			->join("`tb_buku` tbb", "tbp.`peminjaman_buku` = tbb.`buku_id`")
			->join("`tb_user` tbu", "tbp.`peminjaman_user` = tbu.`user_id`")
			->where("tbp.`peminjaman_status`",1)
			->where("tbp.`peminjaman_sampai`", $date)
			->get()->result();
	}
	
	public function get_blokirAnggotaProccesed($date1)
	{
		return $this->db->select("*")
			->from("`tb_peminjaman` tbp")
			->join("`tb_buku` tbb", "tbp.`peminjaman_buku` = tbb.`buku_id`")
			->join("`tb_user` tbu", "tbp.`peminjaman_user` = tbu.`user_id`")
			->where("tbp.`peminjaman_status`",1)
// 			->where("tbp.`peminjaman_sampai`", $date1)
			->get()->result();
	}	
	
	public function get_bookingAccepted($idBooking)
	{
		return $this->db->select("*")
			->from("`tb_booking` tbb")
			->join("`tb_buku` tbbu", "tbb.`booking_buku` = tbbu.`buku_id`")
			->join("`tb_user` tbu", "tbb.`booking_user` = tbu.`user_id`")
			->where("tbb.`booking_id`", $idBooking)
			->get()->result();
	}
	
	public function get_bookingProccesed($idBooking)
	{
		return $this->db->select("*")
			->from("`tb_booking` tbc")
			->join("`tb_buku` tbbu", "tbc.`booking_buku` = tbbu.`buku_id`")
			->join("`tb_user` tbu", "tbc.`booking_user` = tbu.`user_id`")
			->where("tbc.`booking_noId`", $idBooking)
			->get()->result();
	}
	
	//Get sekolah detail
	public function get_sekolah_detail($sekolah_id)
	{
		return $this->db->select("*")
			->from("`tb_sekolah` tbu")
			->where("tbu.`sekolah_id` = ".$sekolah_id)
			->get();
	}

	//Get perpus
	public function get_perpus($perpus_id)
	{
		return $this->db->select("*")
			->from("`tb_perpus` tbp")
			->join("`tb_sekolah` tbs", "tbp.`sekolah_id` = tbs.`sekolah_id`")
			->where("tbp.`perpus_id` = ".$perpus_id)
			->get();
	}

	//Get perpus detail
	public function get_perpus_detail($sekolah_id)
	{
		return $this->db->select("*")
			->from("`tb_perpus` tbu")
			->where("tbu.`sekolah_id` = ".$sekolah_id)
			->get();
	}

	//Get sarana
	public function get_sarana($sarana_id)
	{
		return $this->db->select("*")
			->from("`tb_sarana` tbp")
			->join("`tb_sekolah` tbs", "tbp.`sekolah_id` = tbs.`sekolah_id`")
			->where("tbp.`sarana_id` = ".$sarana_id)
			->get();
	}

	//Get sarana detail
	public function get_sarana_detail($sekolah_id)
	{
		return $this->db->select("*")
			->from("`tb_sarana` tbu")
			->where("tbu.`sekolah_id` = ".$sekolah_id)
			->get();
	} 

	//Get koleksi
	public function get_koleksi($koleksi_id)
	{
		return $this->db->select("*")
			->from("`tb_koleksi` tbp")
			->join("`tb_sekolah` tbs", "tbp.`sekolah_id` = tbs.`sekolah_id`")
			->where("tbp.`koleksi_id` = ".$koleksi_id)
			->get();
	}

	//Get koleksi detail
	public function get_koleksi_detail($sekolah_id)
	{
		return $this->db->select("*")
			->from("`tb_koleksi` tbu")
			->where("tbu.`sekolah_id` = ".$sekolah_id)
			->get();
	} 

	//Get koleksi_umum detail
	public function get_koleksi_umum_detail($sekolah_id)
	{
		$umum="umum";
		return $this->db->select("*")
			->from("`tb_koleksi` tbu")
			->where("tbu.`sekolah_id` = ".$sekolah_id)
			->like('koleksi_kriteria', $umum)
			->get();
	} 

	//Get koleksi_referensi detail
	public function get_koleksi_referensi_detail($sekolah_id)
	{
		$referensi="referensi";
		return $this->db->select("*")
			->from("`tb_koleksi` tbu")
			->where("tbu.`sekolah_id` = ".$sekolah_id)
			->like('koleksi_kriteria', $referensi)
			->get();
	} 

	//Get koleksi_terbitan detail
	public function get_koleksi_terbitan_detail($sekolah_id)
	{
		$terbitan="terbitan";
		return $this->db->select("*")
			->from("`tb_koleksi` tbu")
			->where("tbu.`sekolah_id` = ".$sekolah_id)
			->like('koleksi_kriteria', $terbitan)
			->get();
	} 

	//Get person
	public function get_person($person_id)
	{
		return $this->db->select("*")
			->from("`tb_person` tbp")
			->join("`tb_sekolah` tbs", "tbp.`sekolah_id` = tbs.`sekolah_id`")
			->where("tbp.`person_id` = ".$person_id)
			->get();
	}

	//Get person detail
	public function get_person_detail($sekolah_id)
	{
		return $this->db->select("*")
			->from("`tb_person` tbu")
			->where("tbu.`sekolah_id` = ".$sekolah_id)
			->get();
	}

	//Get person_anggota detail
	public function get_person_anggota_detail($sekolah_id)
	{
		$anggota="anggota";
		return $this->db->select("*")
			->from("`tb_person` tbu")
			->where("tbu.`sekolah_id` = ".$sekolah_id)
			->like('person_kriteria', $anggota)
			->get();
	}
	
	//Get person_pemustaka detail
	public function get_person_pemustaka_detail($sekolah_id)
	{
		$pemustaka="pemustaka";
		return $this->db->select("*")
			->from("`tb_person` tbu")
			->where("tbu.`sekolah_id` = ".$sekolah_id)
			->like('person_kriteria', $pemustaka)
			->get();
	}

	//Get person_pengunjung detail
	public function get_person_pengunjung_detail($sekolah_id)
	{
		$pengunjung="pengunjung";
		return $this->db->select("*")
			->from("`tb_person` tbu")
			->where("tbu.`sekolah_id` = ".$sekolah_id)
			->like('person_kriteria', $pengunjung)
			->get();
	}

	public function get_peminjaman_detail($id)
	{
		return $this->db->select("*")
			->from("`tb_peminjaman` tbp")
			->join("`tb_buku` tbb", "tbp.`peminjaman_buku` = tbb.`buku_id`")
			->join("`tb_user` tbu", "tbp.`peminjaman_user` = tbu.`user_id`")
			->where("tbp.`peminjaman_id` = ".$id)
			->order_by("tbp. `peminjaman_id`", "DESC")
			->get();
	}

	public function get_booking()
	{
		return $this->db->select('*')
		->from('tb_booking')
		->join('tb_buku', 'tb_buku.buku_id=tb_booking.booking_buku')
		->join('tb_user', 'tb_user.user_id=tb_booking.booking_user')
		->order_by("tb_booking. `booking_id`", "DESC")
		->get();
	}

	public function buku_saya()
	{
		// $this->db->query("SELECT a.*, b.buku_judul FROM tb_booking a LEFT JOIN tb_buku b ON a.booking_buku=b.buku_id ORDER BY a.booking_id DESC");
		return $this->db->select("*")
		->from("`tb_booking` tbb ")
		->join("`tb_user` tbu", "tbb.`booking_user` = tbu.`user_id`")
		->join("`tb_buku` tbbu", "tbb.`booking_buku` = tbbu.`buku_id`")
		->where("tbu.`user_id` ", $this->session->userdata("admin_id"))
		->order_by("tbb. `booking_id`", "DESC")
		->get();	
	}

	//Get peminjaman join user & Buku
	public function get_peminjaman_user($start, $end)
	{
		if ($start == null || $end == null) {
			// $start = date("Y-m-d", strtotime("-30Days"));
			// $end = date("Y-m-d");
			return $this->db->select("*")
			->from("`tb_peminjaman` tbp")
			->join("`tb_buku` tbb", "tbp.`peminjaman_buku` = tbb.`buku_id`")
			->join("`tb_user` tbu", "tbp.`peminjaman_user` = tbu.`user_id`")
			// ->where('peminjaman_dari BETWEEN "' . $start . '" AND "' . $end . '" ')
			->where("tbu.`user_id` ", $this->session->userdata("admin_id"))
			->order_by("tbp. `peminjaman_id`", "DESC")
			->get();
		} else {
			return $this->db->select("*")
			->from("`tb_peminjaman` tbp")
			->join("`tb_buku` tbb", "tbp.`peminjaman_buku` = tbb.`buku_id`")
			->join("`tb_user` tbu", "tbp.`peminjaman_user` = tbu.`user_id`")
			->where('peminjaman_dari BETWEEN "' . $start . '" AND "' . $end . '" ')
			->where("tbu.`user_id` ", $this->session->userdata("admin_id"))
			->order_by("tbp. `peminjaman_id`", "DESC")
			->get();
		}
	}

	public function buku_pinjam()
	{
		return $this->db->select("*")
		->from("`tb_peminjaman` tbp")
		->join("`tb_buku` tbb", "tbp.`peminjaman_buku` = tbb.`buku_id`")
		->join("`tb_user` tbu", "tbp.`peminjaman_user` = tbu.`user_id`")
		->where("tbu.`user_id` ", $this->session->userdata("admin_id"))
		->order_by("tbp. `peminjaman_id`", "DESC")
		->get();
	}

	public function booking_saya()
	{
		// $this->db->query("SELECT a.*, b.buku_judul FROM tb_booking a LEFT JOIN tb_buku b ON a.booking_buku=b.buku_id ORDER BY a.booking_id DESC");
		return $this->db->select("*")
		->from("`tb_booking` tbb")
		->join("`tb_user` tbu", "tbb.`booking_user` = tbu.`user_id`")
		->join("`tb_buku` tbbu", "tbb.`booking_buku` = tbbu.`buku_id`")
		->where("tbu.`user_id` ", $this->session->userdata("admin_id"))
		->order_by("tbb. `booking_id`", "DESC")
		->get();
	}  

	public function get_buku_saya()
	{
		return $this->db->select("*")
			->from("`tb_booking`")
			->join("`tb_user` tbu", "tbb.`booking_user` = tbu.`user_id`")
			->join("`tb_buku` tbbu", "tbb.`booking_buku` = tbbu.`buku_id`")
			->where(" buku_judul LIKE '%".$this->input->post('kata')."%' OR  buku_penulis LIKE '%".$this->input->post('kata')."%' OR  buku_penerbit LIKE '%".$this->input->post('kata')."%' OR  buku_tahunTerbit LIKE '%".$this->input->post('kata')."%' ORDER BY buku_id DESC ")
			->get();
	}

	public function get_buku()
	{
		return $this->db->select("*")
			->from("`tb_buku`")
			->where(" buku_judul LIKE '%".$this->input->post('kata')."%' OR  buku_penulis LIKE '%".$this->input->post('kata')."%' OR  buku_penerbit LIKE '%".$this->input->post('kata')."%' OR  buku_tahunTerbit LIKE '%".$this->input->post('kata')."%' ORDER BY buku_id DESC ")
			->get();
	}

	public function data($limit,$offset,$where)
	{
		return $this->db->where($where)->get('tb_buku',$limit,$offset);
	}

	public function get_cart_buku()
	{
		return $this->db->select("*")
				->from("`tb_cart` tbc")
				->join("`tb_buku` tbb", "tbc.`cart_buku` = tbb.`buku_id`")
				->where("cart_user", $this->session->userdata("admin_id"))
				->get();
	}

	public function get_log($start, $end)
	{
		if ($start == null || $end == null) {
			// $start = date("Y-m-d", strtotime("-1Days"));
			// $end = date("Y-m-d");
			return $this->db->select("*")
				->from("tb_log")
				->join("tb_user", "tb_log.log_user = tb_user.user_id")
				// ->where('log_tanggal BETWEEN "' . $start . '" AND "' . $end . '" ')
				->order_by("tb_log.log_id", "DESC")
				->get();
		} else {
			return $this->db->select("*")
				->from("tb_log")
				->join("tb_user", "tb_log.log_user = tb_user.user_id")
				->where('log_tanggal BETWEEN "' . $start . '" AND "' . $end . '" ')
				->order_by("tb_log.log_id", "DESC")
				->get();
		}
	}

	public function search_buku($keyword, $limit)
	{
		$response = new stdClass();
		$query = $this->db->select("*")
				->from("tb_buku")
				->like("buku_judul", $keyword, "both")
				->where("buku_stok >", 0)
				->limit($limit)
				->get();
		if ($query->num_rows() > 0) {
			$response->success = TRUE;
			$response->data = $query->result();
		} else {
			$response->success = FALSE;
		}
		return $response;
	}

	public function search_user($keyword, $limit = FALSE)
	{
		$response = new stdClass();
		$query = $this->db->select("*")
											->from("tb_user")
											->like("user_nama", $keyword, "both")
											->limit($limit)
											->get();
		if ($query->num_rows() > 0) {
			$response->success = TRUE;
			$response->data = $query->result();
		} else {
			$response->success = FALSE;
		}
		return $response;
	}

	public function get_sekolah()
	{
		return $this->db->select('*')
		->from('tb_user')
		->join('tb_sekolah', 'tb_sekolah.sekolah_id = tb_user.sekolah_id')
		->where('tb_user.user_id = ' , $this->session->userdata("admin_id"))
		->get();
	}
	
	public function get_klasifikasi_anggota()
	{
			$klasifikasi = $this->M_data->getData("tb_klasifikasi")->result();
				$klasifikasi_user = [];
				$jumlah_klasifikasi_user = [];
				foreach($klasifikasi as $item) {
				return $this->db->select('*')
				->from('tb_user')
				->where('tb_user.user_role = 3')
				->where('tb_user.user_role = ', $item->pekerjaan_id)
				->get();
				array_push($jumlah_klasifikasi_user, $klasifikasi_user);
				}
	}

	public function get_laporan_data_sekolah()
	{
		return $this->db->select('*')
		->from('tb_laporan_data_sekolah')
		->join('tb_sekolah', 'tb_sekolah.sekolah_id = tb_laporan_data_sekolah.sekolah_id')
		->order_by("tb_laporan_data_sekolah. `laporan_tanggal`", "DESC")
		->get();
	}

	public function get_total_sarana_tahunIni()
	{
		$sekolah=$this->M_data->get_sekolah()->row();
		return $this->db
		->select('*')
		->from('tb_sarana')
		->join('tb_sekolah', 'tb_sarana.sekolah_id = tb_sekolah.sekolah_id')
		->where('tb_sarana.sarana_pertahun = ', date("Y"))
		->where('tb_sarana.sekolah_id = ', $sekolah->sekolah_id)
		->get();
	}

	public function get_total_koleksi_umum_tahunIni()
	{
		$sekolah = $this->M_data->get_sekolah()->row();
		return $this->db
		->select('*')
		->from('tb_koleksi')
		->join('tb_sekolah', 'tb_koleksi.sekolah_id = tb_sekolah.sekolah_id')
		->where('tb_koleksi.koleksi_pertahun = ', date("Y"))
		->where('tb_koleksi.sekolah_id = ', $sekolah->sekolah_id)
		->where('tb_koleksi.koleksi_kriteria =', "umum")
		->get();
	}

	public function get_total_koleksi_referensi_tahunIni()
	{
		$sekolah = $this->M_data->get_sekolah()->row();
		return $this->db
		->select('*')
		->from('tb_koleksi')
		->join('tb_sekolah', 'tb_koleksi.sekolah_id = tb_sekolah.sekolah_id')
		->where('tb_koleksi.koleksi_pertahun = ', date("Y"))
		->where('tb_koleksi.sekolah_id = ', $sekolah->sekolah_id)
		->where('tb_koleksi.koleksi_kriteria =', "referensi")
		->get();
	}

	public function get_total_koleksi_terbitan_tahunIni()
	{
		$sekolah = $this->M_data->get_sekolah()->row();
		return $this->db
		->select('*')
		->from('tb_koleksi')
		->join('tb_sekolah', 'tb_koleksi.sekolah_id = tb_sekolah.sekolah_id')
		->where('tb_koleksi.koleksi_pertahun = ', date("Y"))
		->where('tb_koleksi.sekolah_id = ', $sekolah->sekolah_id)
		->where('tb_koleksi.koleksi_kriteria =', "terbitan_berkala")
		->get();
	}

	public function get_total_person_anggota_tahunIni()
	{
		$sekolah = $this->M_data->get_sekolah()->row();
		return $this->db
		->select('*')
		->from('tb_person')
		->join('tb_sekolah', 'tb_person.sekolah_id = tb_sekolah.sekolah_id')
		->where('tb_person.person_pertahun = ', date("Y"))
		->where('tb_person.sekolah_id = ', $sekolah->sekolah_id)
		->where('tb_person.person_kriteria =', "anggota")
		->get();
	}

	public function get_total_person_pemustaka_tahunIni()
	{
		$sekolah = $this->M_data->get_sekolah()->row();
		return $this->db
		->select('*')
		->from('tb_person')
		->join('tb_sekolah', 'tb_person.sekolah_id = tb_sekolah.sekolah_id')
		->where('tb_person.person_pertahun = ', date("Y"))
		->where('tb_person.sekolah_id = ', $sekolah->sekolah_id)
		->where('tb_person.person_kriteria =', "pemustaka")
		->get();
	}

	public function get_total_person_pengunjung_tahunIni()
	{
		$sekolah = $this->M_data->get_sekolah()->row();
		return $this->db
		->select('*')
		->from('tb_person')
		->join('tb_sekolah', 'tb_person.sekolah_id = tb_sekolah.sekolah_id')
		->where('tb_person.person_pertahun = ', date("Y"))
		->where('tb_person.sekolah_id = ', $sekolah->sekolah_id)
		->where('tb_person.person_kriteria =', "pengunjung")
		->get();
	}

	public function get_sekolah_total_sarana_tahunIni($id)
	{
		return $this->db
		->select('*')
		->from('tb_sarana')
		->join('tb_sekolah', 'tb_sarana.sekolah_id = tb_sekolah.sekolah_id')
		->where('tb_sarana.sarana_pertahun = ', date("Y"))
		->where('tb_sarana.sekolah_id = ', $id)
		->get();
	}

	public function get_sekolah_total_koleksi_umum_tahunIni($id)
	{
		return $this->db
		->select('*')
		->from('tb_koleksi')
		->join('tb_sekolah', 'tb_koleksi.sekolah_id = tb_sekolah.sekolah_id')
		->where('tb_koleksi.koleksi_pertahun = ', date("Y"))
		->where('tb_koleksi.sekolah_id = ', $id)
		->where('tb_koleksi.koleksi_kriteria =', "umum")
		->get();
	}

	public function get_sekolah_total_koleksi_referensi_tahunIni($id)
	{
		return $this->db
		->select('*')
		->from('tb_koleksi')
		->join('tb_sekolah', 'tb_koleksi.sekolah_id = tb_sekolah.sekolah_id')
		->where('tb_koleksi.koleksi_pertahun = ', date("Y"))
		->where('tb_koleksi.sekolah_id = ', $id)
		->where('tb_koleksi.koleksi_kriteria =', "referensi")
		->get();
	}

	public function get_sekolah_total_koleksi_terbitan_tahunIni($id)
	{
		return $this->db
		->select('*')
		->from('tb_koleksi')
		->join('tb_sekolah', 'tb_koleksi.sekolah_id = tb_sekolah.sekolah_id')
		->where('tb_koleksi.koleksi_pertahun = ', date("Y"))
		->where('tb_koleksi.sekolah_id = ', $id)
		->where('tb_koleksi.koleksi_kriteria =', "terbitan_berkala")
		->get();
	}

	public function get_sekolah_total_person_anggota_tahunIni($id)
	{
		return $this->db
		->select('*')
		->from('tb_person')
		->join('tb_sekolah', 'tb_person.sekolah_id = tb_sekolah.sekolah_id')
		->where('tb_person.person_pertahun = ', date("Y"))
		->where('tb_person.sekolah_id = ', $id)
		->where('tb_person.person_kriteria =', "anggota")
		->get();
	}

	public function get_sekolah_total_person_pemustaka_tahunIni($id)
	{
		return $this->db
		->select('*')
		->from('tb_person')
		->join('tb_sekolah', 'tb_person.sekolah_id = tb_sekolah.sekolah_id')
		->where('tb_person.person_pertahun = ', date("Y"))
		->where('tb_person.sekolah_id = ', $id)
		->where('tb_person.person_kriteria =', "pemustaka")
		->get();
	}

	public function get_sekolah_total_person_pengunjung_tahunIni($id)
	{
		return $this->db
		->select('*')
		->from('tb_person')
		->join('tb_sekolah', 'tb_person.sekolah_id = tb_sekolah.sekolah_id')
		->where('tb_person.person_pertahun = ', date("Y"))
		->where('tb_person.sekolah_id = ', $id)
		->where('tb_person.person_kriteria =', "pengunjung")
		->get();
	}
	
	public function get_verifikasiProccesed($user_id)
	{
		return $this->db->select("*")
			->from("`tb_user` tbu")
			->where("tbu.`user_id`", $user_id)
			->get()->result();
	}

}
