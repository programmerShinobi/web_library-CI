<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');
class Admin extends CI_Controller {

  public function __construct()
  {
    parent::__construct();  
	protek_login();
    genBooking();
  }

  public function index()
  {
	if ($this->session->userdata("role_id") == 3) {
		redirect("block");
	}
    //Data Statistik klasifikasi User (Anggota)
    $klasifikasi = $this->M_data->getData("tb_klasifikasi")->result();
    $klasifikasi_user = [];
    $jumlah_klasifikasi_user = [];
    foreach($klasifikasi as $item) {
      array_push($klasifikasi_user, $item->pekerjaan);
      $user = $this->M_data->editData_2(["user_klasifikasi" => $item->pekerjaan_id],["user_role" => 3], "tb_user")->num_rows();
      array_push($jumlah_klasifikasi_user, $user);
    }

    //Data Statistik klasifikasi Pengunjung
    $klasifikasi_peng = $this->M_data->getData("tb_klasifikasi")->result();
    $klasifikasi_pengunjung = [];
    $jumlah_klasifikasi_pengunjung = [];
    foreach($klasifikasi_peng as $item) {
      array_push($klasifikasi_pengunjung, $item->pekerjaan);
      $_pengunjung = $this->M_data->editData(["pengunjung_klasifikasi" => $item->pekerjaan_id], "tb_pengunjung_perpus")->num_rows();
      array_push($jumlah_klasifikasi_pengunjung, $_pengunjung);
    }

    //Data statistik buku dipinjam & booking
    $jumlah_pinjaman = $this->M_data->editData(["peminjaman_status" => 1], "tb_peminjaman")->num_rows();
    $jumlah_booking = $this->M_data->editData(["booking_accept" => 0], "tb_booking")->num_rows();
    $perbandingan_buku = [$jumlah_pinjaman, $jumlah_booking];

    //Data statistik buku dipinjam & booking
    $total_pinjam = $this->M_data->editData(["peminjaman_status" => 1], "tb_peminjaman")->num_rows();
    $total_kembali = $this->M_data->editData(["peminjaman_status" => 2], "tb_peminjaman")->num_rows();
    $perbandingan_buku = [$total_pinjam, $total_kembali];

		$orang= $this->M_data->editData(['user_id' => $this->session->userdata('admin_id')], 'tb_user')->row();
		if ($orang->user_role != 4){
			$data = [
					'title' => 'Dashboard',
					'menu' => $this->M_data->get_access_menu()->result_array(),
					'user' => $this->M_data->editData(['user_id' => $this->session->userdata('admin_id')],'tb_user')->row(),
					'total_log' => $this->M_data->getData("tb_log")->num_rows(),		
					'total_log_today' => $this->M_data->editData(["log_tanggal" => date("Y-m-d")], "tb_log")->num_rows(),
					'total_buku' => $this->M_data->getData('tb_buku')->num_rows(),
					'total_pinjam' => $this->M_data->editData_2(["peminjaman_status" => 1], ["peminjaman_dari" => date("Y-m-d")], "tb_peminjaman")->num_rows(),
					'total_kembali' => $this->M_data->editData_2(["peminjaman_status" => 2], ["peminjaman_dari" => date("Y-m-d")], "tb_peminjaman")->num_rows(),
					'total_peminjaman' => $this->M_data->getData('tb_peminjaman')->num_rows(),
					'total_pengembalian' => $this->M_data->getData('tb_peminjaman')->num_rows(),
					'total_booking' => $this->M_data->editData(["booking_accept" => 0], "tb_booking")->num_rows(),
					'total_user' => $this->M_data->getData('tb_user')->num_rows(),
					'total_admin' => $this->M_data->editData(["user_role" => 1], "tb_user")->num_rows(),
					'total_petugas' => $this->M_data->editData(["user_role" => 2], "tb_user")->num_rows(),
					'total_anggota' => $this->M_data->editData(["user_role" => 3], "tb_user")->num_rows(),
					'total_pengunjung_website' => $this->M_data->getData("tb_pengunjung")->num_rows(),
					'total_pengunjung_perpus' => $this->M_data->getData("tb_pengunjung_perpus")->num_rows(),
					'total_pengunjung_website_today' => $this->M_data->editData(["waktu" => date("Y-m-d")], "tb_pengunjung")->num_rows(),
					'total_pengunjung_perpus_today' => $this->M_data->editData(["pengunjung_tanggal" => date("Y-m-d")], "tb_pengunjung_perpus")->num_rows(),
					'total_petugas_sekolah' => $this->M_data->editData(["user_role" => 4], "tb_user")->num_rows(),
					'total_sekolah' => $this->M_data->getData('tb_sekolah')->num_rows(),
					'total_kebutuhanpemustaka' => $this->M_data->getData('tb_kebutuhanpemustaka')->num_rows(),
					'total_pengadaan' => $this->M_data->getData('tb_pengadaan')->num_rows(),
					'total_buku_aktif' => $this->M_data->editData(["buku_status" => 1], "tb_buku")->num_rows(),
					'total_buku_nonaktif' => $this->M_data->editData(["buku_status" => 0], "tb_buku")->num_rows(),
					'website' => $this->M_data->getData('tb_website')->row(),
					"klasifikasi" => $klasifikasi_user,
					"jumlah_klasifikasi" => $jumlah_klasifikasi_user,
					"klasifikasi_pengunjung" => $klasifikasi_pengunjung,
					"jumlah_klasifikasi_pengunjung" => $jumlah_klasifikasi_pengunjung,
					"perbandingan_buku" => $perbandingan_buku,
			];
		} else if ($orang->user_role >= 6) {
			$data = [
				'title' => 'Dashboard',
				'menu' => $this->M_data->get_access_menu()->result_array(),
				'user' => $this->M_data->editData(['user_id' => $this->session->userdata('admin_id')], 'tb_user')->row(),
				'total_log' => $this->M_data->getData("tb_log")->num_rows(),
				'total_log_today' => $this->M_data->editData(["log_tanggal" => date("Y-m-d")], "tb_log")->num_rows(),
				'total_buku' => $this->M_data->getData('tb_buku')->num_rows(),
				'total_pinjam' => $this->M_data->editData_2(["peminjaman_status" => 1], ["peminjaman_dari" => date("Y-m-d")], "tb_peminjaman")->num_rows(),
				'total_kembali' => $this->M_data->editData_2(["peminjaman_status" => 2], ["peminjaman_dari" => date("Y-m-d")], "tb_peminjaman")->num_rows(),
				'total_peminjaman' => $this->M_data->getData('tb_peminjaman')->num_rows(),
				'total_pengembalian' => $this->M_data->getData('tb_peminjaman')->num_rows(),
				'total_booking' => $this->M_data->editData(["booking_accept" => 0], "tb_booking")->num_rows(),
				'total_user' => $this->M_data->getData('tb_user')->num_rows(),
				'total_admin' => $this->M_data->editData(["user_role" => 1], "tb_user")->num_rows(),
				'total_petugas' => $this->M_data->editData(["user_role" => 2], "tb_user")->num_rows(),
				'total_anggota' => $this->M_data->editData(["user_role" => 3], "tb_user")->num_rows(),
				'total_pengunjung_website' => $this->M_data->getData("tb_pengunjung")->num_rows(),
				'total_pengunjung_perpus' => $this->M_data->getData("tb_pengunjung_perpus")->num_rows(),
				'total_pengunjung_website_today' => $this->M_data->editData(["waktu" => date("Y-m-d")], "tb_pengunjung")->num_rows(),
				'total_pengunjung_perpus_today' => $this->M_data->editData(["pengunjung_tanggal" => date("Y-m-d")], "tb_pengunjung_perpus")->num_rows(),
				'total_petugas_sekolah' => $this->M_data->editData(["user_role" => 4], "tb_user")->num_rows(),
				'total_sekolah' => $this->M_data->getData('tb_sekolah')->num_rows(),
				'website' => $this->M_data->getData('tb_website')->row(),
				"klasifikasi" => $klasifikasi_user,
				"jumlah_klasifikasi" => $jumlah_klasifikasi_user,
				"klasifikasi_pengunjung" => $klasifikasi_pengunjung,
				"jumlah_klasifikasi_pengunjung" => $jumlah_klasifikasi_pengunjung,
				"perbandingan_buku" => $perbandingan_buku,
			];
		} else if ($orang->user_role == 4) {
			$data = [
				'title' => 'Dashboard',
				'menu' => $this->M_data->get_access_menu()->result_array(),
				'user' => $this->M_data->editData(['user_id' => $this->session->userdata('admin_id')], 'tb_user')->row(),
				'total_rak_sirkulasi_tahunIni' => $this->M_data->get_total_sarana_tahunIni()->row('sarana_jumlahRakSirkulasi'),
				'total_rak_referensi_tahunIni' => $this->M_data->get_total_sarana_tahunIni()->row('sarana_jumlahRakReferensi'),
				'total_rak_terbitan_tahunIni' => $this->M_data->get_total_sarana_tahunIni()->row('sarana_jumlahRakTerbitan'),
				'total_koleksi_umum_tahunIni' => $this->M_data->get_total_koleksi_umum_tahunIni()->row('koleksi_jumlah'),
				'total_koleksi_referensi_tahunIni' => $this->M_data->get_total_koleksi_referensi_tahunIni()->row('koleksi_jumlah'),
				'total_koleksi_terbitan_tahunIni' => $this->M_data->get_total_koleksi_terbitan_tahunIni()->row('koleksi_jumlah'),
				'total_person_anggota_guru_tahunIni' => $this->M_data->get_total_person_anggota_tahunIni()->row('person_jumlahGuruStaff'),
				'total_person_pemustaka_guru_tahunIni' => $this->M_data->get_total_person_pemustaka_tahunIni()->row('person_jumlahGuruStaff'),
				'total_person_pengunjung_guru_tahunIni' => $this->M_data->get_total_person_pengunjung_tahunIni()->row('person_jumlahGuruStaff'),
				'total_person_anggota_siswa_tahunIni' => $this->M_data->get_total_person_anggota_tahunIni()->row('person_jumlahSiswa'),
				'total_person_pemustaka_siswa_tahunIni' => $this->M_data->get_total_person_pemustaka_tahunIni()->row('person_jumlahSiswa'),
				'total_person_pengunjung_siswa_tahunIni' => $this->M_data->get_total_person_pengunjung_tahunIni()->row('person_jumlahSiswa'),
			];
		}
    $this->load->view('template/v_head', $data);
    $this->load->view('admin/v_index', $data);
    $this->load->view('template/v_footer');
  }

  public function view_menu()
  {
    $this->form_validation->set_rules('menu_judul', 'Judul Menu', 'required');
    
    if ($this->form_validation->run() != FALSE) {
      $input = (object) $this->input->post();
      $this->process_menu_add($input);
    } else {
      $data = [
        'title' => 'Menu Management',
        'menu' => $this->M_data->get_access_menu()->result_array(),
        'user' => $this->M_data->editData(['user_id' => $this->session->userdata('admin_id')],'tb_user')->row(),
        'list_access' => $this->M_data->get_access_join_menu()->result(),
        'list_menu' => $this->M_data->getData('tb_menu')->result()
      ];
      $this->load->view('template/v_head', $data);
      $this->load->view('admin/v_menu', $data);
      $this->load->view('template/v_footer');
    }
  }

  public function view_menu_edit($id)
  {
    $menu_id = (int)$this->db->escape_str($id);
    $check = $this->M_data->editData(['menu_id' => $menu_id],'tb_menu');
    if ($check) {
      $data = [
        'title' => 'Menu Management',
        'menu' => $this->M_data->get_access_menu()->result_array(),
        'user' => $this->M_data->editData(['user_id' => $this->session->userdata('admin_id')],'tb_user')->row(),
        'menu_item' => $check->row()
      ];
      $this->load->view('template/v_head', $data);
      $this->load->view('admin/v_editMenu', $data);
      $this->load->view('template/v_footer');
    } else {
      $this->session->set_flashdata('pesan', '<script>sweet("Gagal", "Query Failed", "error", "tutup")</script>');
      redirect('menu');
    }
  }

  public function process_menu_edit()
  {
    $this->form_validation->set_rules('menu_judul', 'Menu', 'required');
    $menu_id = $this->input->post('menu_id');

    if ($this->form_validation->run() != FALSE) {
      $this->process_menu_edit_act();
    } else {
      $this->session->set_flashdata('pesan', '<script>sweet("Gagal", "Masukan data dengan benar dan lengkap!", "error", "tutup")</script>');
      redirect('view_menu_edit/'.$menu_id);
    }
  }

  private function process_menu_edit_act()
  {
    $input = (object) $this->input->post();
    $data = ['menu_judul' => $this->db->escape_str($input->menu_judul)];
    $where = ['menu_id' => $this->db->escape_str($input->menu_id)];

    $check = $this->M_data->updateData($data, $where, 'tb_menu');
    if ($check["success"] === TRUE) {
      $this->session->set_flashdata('pesan', '<script>sweet("Sukses", "Menu berhasil diubah", "success", "tutup")</script>');
      redirect('menu');
    } else {
      $this->session->set_flashdata('pesan', '<script>sweet("Gagal", "Query failed!", "error", "tutup")</script>');
      redirect('view_menu_edit/'.$input->menu_id);
    }
  }

  public function process_menu_delete($id)
  {
    $menu_id = (int)$this->db->escape_str($id);
    $check = $this->M_data->delete_menu(['menu_id' => $menu_id]);
    if ($check) {
      $this->session->set_flashdata('pesan', '<script>sweet("Sukses", "Data menu berhasil dihapus", "success", "tutup")</script>');
      redirect('menu');
    } else {
      $this->session->set_flashdata('pesan', '<script>sweet("Gagal", "Data menu Gagal", "error", "tutup")</script>');
      redirect('menu');
    }
  }

  private function process_menu_add($input)
  {
    $data = ['menu_judul' => $this->db->escape_str($input->menu_judul)];
    $check = $this->M_data->insertData($data,'tb_menu');
    if ($check["success"] === TRUE) {
      $this->session->set_flashdata('pesan', '<script>sweet("Sukses", "Data menu sukses ditambahkan", "success", "tutup")</script>');
      redirect("menu");
    } else {
      $this->session->set_flashdata('pesan', '<script>sweet("Gagal", "Query failed", "error", "tutup")</script>');
      redirect("menu");
    }
  }

  public function view_access_edit($id) 
  {
    $access_id = (int)$this->db->escape_str($id);
    $check = $this->M_data->editData(['access_id' => $access_id], 'tb_access');
    if ($check) {
      $data = [
        'title' => 'Menu Management',
        'menu' => $this->M_data->get_access_menu()->result_array(),
        'user' => $this->M_data->editData(['user_id' => $this->session->userdata('admin_id')],'tb_user')->row(),
        'access_item' => $check->row(),
        'list_menu' => $this->M_data->getData('tb_menu')->result()
      ];
      $this->load->view('template/v_head', $data);
      $this->load->view('admin/v_editAccess', $data);
      $this->load->view('template/v_footer');
    }
  }

  public function validation_access_edit()
  {
    $this->form_validation->set_rules('menu_id', 'Menu', 'required');
    $this->form_validation->set_rules('role_id', 'Role', 'required');
    $access_id = (int)$this->input->post('access_id');

    if ($this->form_validation->run() === FALSE) {
      $this->session->set_flashdata('pesan', '<script>sweet("Gagal", "Masukan data dengan benar & lengkap!", "error", "tutup")</script>');
      redirect("access_edit/".$access_id);
    } else {
      $this->process_access_update();
    }
  }

  private function process_access_update()
  {
    $input = (object)$this->db->escape_str($this->input->post());
    $data = [
      'menu_id' => $input->menu_id,
      'role_id' => $input->role_id
    ];
    $where = ['access_id' => $input->access_id];
    $check = $this->M_data->updateData($data, $where, 'tb_access');
    if ($check["success"] === TRUE) {
      $this->session->set_flashdata('pesan', '<script>sweet("Sukses", "Data access berhasil diubah!", "success", "tutup")</script>');
      redirect("menu");
    } else {
      $this->session->set_flashdata('pesan', '<script>sweet("Gagal", "Query failed!", "error", "tutup")</script>');
      redirect("access_edit/".$input->access_id);
    }
  }

  public function process_access_add()
  {
    $this->form_validation->set_rules('menu_id', 'Menu', 'required');
    $this->form_validation->set_rules('role_id', 'Role', 'required');

    if ($this->form_validation->run() === FALSE) {
      $this->session->set_flashdata('pesan', '<script>sweet("Gagal", "Masukan data dengan benar & lengkap!", "error", "tutup")</script>');
      redirect("menu");
    } else {
      $this->process_access_add_act();
    }
  }

  public function process_access_add_act()
  {
    $input = (object)$this->db->escape_str($this->input->post());
    $data = [
      'menu_id' => $input->menu_id,
      'role_id' => $input->role_id
    ];
    $check = $this->M_data->insertData($data, 'tb_access');
    if ($check["success"] === TRUE) {
      $this->session->set_flashdata('pesan', '<script>sweet("Sukses", "Data access berhasil ditambahkankan!", "success", "tutup")</script>');
      redirect("menu");
    } else {
      $this->session->set_flashdata('pesan', '<script>sweet("Gagal", "Query failed", "error", "tutup")</script>');
      redirect("menu");
    }
  }

  public function process_access_delete($id)
  {
    $access_id = (int)$this->db->escape_str($id);
    $check = $this->M_data->deleteData(['access_id' => $access_id], 'tb_access');
    if ($check["success"] === TRUE) {
      $this->session->set_flashdata('pesan', '<script>sweet("Sukses", "Data access berhasil dihapus!", "success", "tutup")</script>');
      redirect("menu");
    } else {
      $this->session->set_flashdata('pesan', '<script>sweet("Gagal menghapus", "Query failed!", "success", "tutup")</script>');
      redirect("menu");
    }
  }

  public function view_sub_menu()
  {
    $data = [
      'title' => 'Submenu Management',
      'menu' => $this->M_data->get_access_menu()->result_array(),
      'user' => $this->M_data->editData(['user_id' => $this->session->userdata('admin_id')],'tb_user')->row(),
      'list_sub' => $this->M_data->get_sub_join_menu()->result(),
      'list_menu' => $this->M_data->getData('tb_menu')->result()
    ];
    $this->load->view('template/v_head', $data);
    $this->load->view('admin/v_subMenu', $data);
    $this->load->view('template/v_footer');
  }

  public function view_sub_edit($id)
  {
    $sub_id = (int)$this->db->escape_str($id);
    $check = $this->M_data->editData(['sub_id' => $id], 'tb_sub');
    if ($check) {
      $data = [
        'title' => 'Submenu Management',
        'menu' => $this->M_data->get_access_menu()->result_array(),
        'user' => $this->M_data->editData(['user_id' => $this->session->userdata('admin_id')],'tb_user')->row(),
        'sub_item' => $check->row(),
        'list_menu' => $this->M_data->getData('tb_menu')->result()
      ];
      $this->load->view('template/v_head', $data);
      $this->load->view('admin/v_editSub', $data);
      $this->load->view('template/v_footer');
    }
  }

  public function validation_sub_add()
  {
    $this->form_validation->set_rules('menu_id', 'Menu', 'required|numeric');
    $this->form_validation->set_rules('sub_judul', 'Menu', 'required');
    $this->form_validation->set_rules('sub_link', 'Menu', 'required');
    $this->form_validation->set_rules('sub_icon', 'Menu', 'required');
    $this->form_validation->set_rules('sub_status', 'Menu', 'required|numeric');
    
    if ($this->form_validation->run() == FALSE) {
      $this->session->set_flashdata('pesan', '<script>sweet("Gagal", "Masukan data dengan benar & lengkap!", "error", "tutup")</script>');
      redirect("subMenu");
    } else {
      $this->process_sub_add();
    }
  }

  public function validation_sub_edit()
  {
    $this->form_validation->set_rules('sub_id', 'Menu', 'required|numeric');
    $this->form_validation->set_rules('menu_id', 'Menu', 'required|numeric');
    $this->form_validation->set_rules('sub_judul', 'Menu', 'required');
    $this->form_validation->set_rules('sub_link', 'Menu', 'required');
    $this->form_validation->set_rules('sub_icon', 'Menu', 'required');
    $this->form_validation->set_rules('sub_status', 'Menu', 'required|numeric');

    if ($this->form_validation->run() == FALSE) {
      $sub_id = (int)$this->input->post("sub_id");
      $this->session->set_flashdata('pesan', '<script>sweet("Gagal", "Masukan data dengan benar & lengkap!", "error", "tutup")</script>');
      redirect("edit_sub/".$sub_id);
    } else {
      $this->process_sub_update();
    }
  }

  private function process_sub_update()
  {
    $input = (object)$this->db->escape_str($this->input->post());
    $data = [
      'menu_id' => $input->menu_id,
      'sub_judul' => $input->sub_judul,
      'sub_link' => $input->sub_link,
      'sub_icon' => $input->sub_icon,
      'sub_status' => $input->sub_status
    ];
    $where = ['sub_id' => $input->sub_id];
    $check = $this->M_data->updateData($data, $where, "tb_sub");
    if ($check["success"] === TRUE) {
      $this->session->set_flashdata('pesan', '<script>sweet("Sukses", "Data submenu berhasil diubah!", "success", "tutup")</script>');
      redirect("subMenu");
    } else {
      $this->session->set_flashdata('pesan', '<script>sweet("Gagal", "Query failed!", "error", "tutup")</script>');
      redirect("subMenu");
    }
  }

  private function process_sub_add() 
  {
    $input = (object)$this->db->escape_str($this->input->post());
    $data = [
      'menu_id' => $input->menu_id,
      'sub_judul' => $input->sub_judul,
      'sub_link' => $input->sub_link,
      'sub_icon' => $input->sub_icon,
      'sub_status' => $input->sub_status
    ];
    $check = $this->M_data->insertData($data, 'tb_sub');
    if ($check["success"] === TRUE) {
      $this->session->set_flashdata('pesan', '<script>sweet("Sukses", "Data submenu berhasil ditambahkankan!", "success", "tutup")</script>');
      redirect("subMenu");
    } else {
      $this->session->set_flashdata('pesan', '<script>sweet("Gagal", "Query failed!", "error", "tutup")</script>');
      redirect("subMenu");
    }
  }

  public function process_sub_delete($id)
  {
    $sub_id = (int)$this->db->escape_str($id);
    $check = $this->M_data->deleteData(['sub_id' => $sub_id], 'tb_sub');
    if ($check["success"] === TRUE) {
      $this->session->set_flashdata('pesan', '<script>sweet("Sukses", "Data submenu berhasil dihapus!", "success", "tutup")</script>');
      redirect("subMenu");
    } else {
      $this->session->set_flashdata('pesan', '<script>sweet("Gagal", "Query failed!", "error", "tutup")</script>');
      redirect("subMenu");
    }
  }

  public function view_petugas()
  {
    $data = [
      'title' => 'Data Petugas',
      'menu' => $this->M_data->get_access_menu()->result_array(),
      'user' => $this->M_data->editData(['user_id' => $this->session->userdata('admin_id')],'tb_user')->row(),
      'pekerjaan' => $this->M_data->getData("tb_klasifikasi")->result(),
      'list_petugas' => $this->M_data->editData(['user_role' => 2],'tb_user')->result(),
			'total_petugas' => $this->M_data->editData(["user_role" => 2], "tb_user")->num_rows(),
    ];
    $this->load->view('template/v_head', $data);
    $this->load->view('admin/v_dataPetugas', $data);
    $this->load->view('template/v_footer');
  }

  public function validation_petugas_add()
  {
    
    $this->form_validation->set_rules('user_noId', 'User', 'required|is_unique[tb_user.user_noId]');
    $this->form_validation->set_rules('user_nama', 'User', 'required');
    $this->form_validation->set_rules('user_tempatLahir', 'User', 'required');
    $this->form_validation->set_rules('user_tanggalLahir', 'User', 'required');
    $this->form_validation->set_rules('user_klasifikasi', 'User', 'required');
    $this->form_validation->set_rules('user_ktp', 'User', 'required|numeric');
    $this->form_validation->set_rules('user_username', 'User', 'required');
    $this->form_validation->set_rules('user_password', 'User', 'required');
    $this->form_validation->set_rules('user_noHP', 'User', 'required|numeric');
    $this->form_validation->set_rules('user_email', 'User', 'required|valid_email|is_unique[tb_user.user_email]');
    $this->form_validation->set_rules('orangtua_nama', 'User', 'required');
    $this->form_validation->set_rules('orangtua_noHP', 'User', 'required|numeric');
    $this->form_validation->set_rules('orangtua_tempatLahir', 'User', 'required');
    $this->form_validation->set_rules('orangtua_tanggalLahir', 'User', 'required');
    $this->form_validation->set_rules('pertanyaan', 'User', 'required');
    $this->form_validation->set_rules('jawaban', 'User', 'required');
    
    if ($this->form_validation->run() == FALSE) {
      $this->session->set_flashdata('pesan', '<script>sweet("Gagal", "Dikarenakan data tidak lengkap / email user sudah terdaftar!", "error", "tutup")</script>');
      redirect("dataPetugas");
    } else {
      $this->process_petugas_add();
    }
  }

  private function process_petugas_add()
  {
    $input = (object)$this->db->escape_str($this->input->post());
    // $user_noId=$input->user_noId;
    $user_noId = html_escape($this->input->post('user_noId', true));

    // $user_noId = rand(1, 1000000);
    $this->load->library('ciqrcode');

    $config['cacheable']    = true; //boolean, the default is true
    $config['cachedir']     = './vendor/'; //string, the default is application/cache/
    $config['errorlog']     = './vendor/'; //string, the default is application/logs/
    $config['imagedir']     = './vendor/img/qr/'; //direktori penyimpanan qr code
    $config['quality']      = true; //boolean, the default is true
    $config['size']         = '512'; //interger, the default is 1024
    $config['black']        = array(224,255,255); // array, default is array(255,255,255)
    $config['white']        = array(70,130,180); // array, default is array(0,0,0)
    $this->ciqrcode->initialize($config);

		$image_name=$user_noId.'.png'; //buat name dari qr code sesuai dengan nim
		
		$dataqr = $user_noId;

    $params['data'] = $dataqr; //data yang akan di jadikan QR CODE
    $params['level'] = 'H'; //H=High
    $params['size'] = 10;
    $params['savename'] = $config['imagedir'].$image_name; //simpan image QR CODE ke folder assets/images/
    $this->ciqrcode->generate($params);

    $data1 = [
      'user_noId' => $user_noId,
      'user_nama' => $input->user_nama,
      'user_tempatLahir' => $input->user_tempatLahir,
      'user_tanggalLahir' => $input->user_tanggalLahir,
      'user_klasifikasi' => $input->user_klasifikasi,

      'user_ktp' => $input->user_ktp,
      'user_foto' => "default.jpg",
      'user_username' => $input->user_username,
      'user_password' => password_hash($input->user_password, PASSWORD_DEFAULT),
      'user_role' => 2,
      'user_noHP' => $input->user_noHP,
      'user_email' => $input->user_email,
      'user_qr' => $image_name
    ];
    $query = $this->M_data->insertData($data1, "tb_user");
    $user_noId = $this->db->insert_id();
    if ($query) {
      $data2 = [
        'orangtua_user' => $user_noId,
        'orangtua_nama' => $input->orangtua_nama,
        'orangtua_tempatLahir' => $input->orangtua_tempatLahir,
        'orangtua_tanggalLahir' => $input->orangtua_tanggalLahir,
        'orangtua_noHP' => $input->orangtua_noHP
      ];
      $query2 = $this->M_data->insertData($data2, "tb_identitas_orangtua");
      if ($query2) {
        $data3 = [
          'pertanyaan_user' => $user_noId,
          'pertanyaan' => $input->pertanyaan,
          'pertanyaan_jawaban' => $input->jawaban
        ];
        $query3 = $this->M_data->insertData($data3, "tb_pertanyaan_keamanan");
        if ($query3) {
          $this->session->set_flashdata('pesan', '<script>sweet("Sukses", "Data petugas berhasil ditambahkan!", "success", "tutup")</script>');
          redirect("dataPetugas");
        } else {
          $this->session->set_flashdata('pesan', '<script>sweet("Gagal", "Query3 failed!", "success", "tutup")</script>');
          redirect("dataPetugas");
        }
      } else {
        $this->session->set_flashdata('pesan', '<script>sweet("Gagal", "Query2 failed!", "success", "tutup")</script>');
        redirect("dataPetugas");
      }
    } else {
      $this->session->set_flashdata('pesan', '<script>sweet("Gagal", "Query1 failed!", "success", "tutup")</script>');
      redirect("dataPetugas");
    }
  }

  public function view_petugas_edit($id)
  {
    $petugas_id = (int)$this->db->escape_str($id);
    $check = $this->M_data->get_petugas_detail($petugas_id);
    if ($check) {
      $data = [
        'title' => 'Data Petugas',
        'menu' => $this->M_data->get_access_menu()->result_array(),
        'user' => $this->M_data->editData(['user_id' => $this->session->userdata('admin_id')],'tb_user')->row(),
        'petugas' => $check->row()
      ];
      $this->load->view('template/v_head', $data);
      $this->load->view('admin/v_editPetugas', $data);
      $this->load->view('template/v_footer');
    } else {
      $this->session->set_flashdata('pesan', '<script>sweet("Gagal", "Query failed!", "error", "tutup")</script>');
      redirect("dataPetugas");
    }
  }

  public function validation_petugas_edit()
  {
    $this->form_validation->set_rules('user_noId', 'User', 'required|is_unique[tb_user.user_noId]');
    $this->form_validation->set_rules('user_nama', 'User', 'required');
    $this->form_validation->set_rules('user_tempatLahir', 'User', 'required');
    $this->form_validation->set_rules('user_tanggalLahir', 'User', 'required');
    $this->form_validation->set_rules('user_klasifikasi', 'User', 'required');
    $this->form_validation->set_rules('user_ktp', 'User', 'required|numeric');
    $this->form_validation->set_rules('user_username', 'User', 'required');
    $this->form_validation->set_rules('user_noHP', 'User', 'required|numeric');
    $this->form_validation->set_rules('user_email', 'User', 'required|valid_email|is_unique[tb_user.user_email]');
    $this->form_validation->set_rules('orangtua_nama', 'User', 'required');
    $this->form_validation->set_rules('orangtua_noHP', 'User', 'required|numeric');
    $this->form_validation->set_rules('orangtua_tempatLahir', 'User', 'required');
    $this->form_validation->set_rules('orangtua_tanggalLahir', 'User', 'required');
    $this->form_validation->set_rules('pertanyaan', 'User', 'required');
    $this->form_validation->set_rules('jawaban', 'User', 'required');
    
    if ($this->form_validation->run() == FALSE) {
      $this->process_petugas_update();
    } else {
      $this->session->set_flashdata('pesan', '<script>sweet("Gagal", "Isi data dengan benar & lengkap!", "success", "tutup")</script>');
      redirect("petugas_edit/");
    }
  }

  private function process_petugas_update()
  {
    $input = (object)$this->db->escape_str($this->input->post());
    $user_foto = $_FILES["user_foto"]["name"];
    $data = [];
    
    if ($user_foto != "") {
      $check = $this->M_data->editData(["user_id" => $input->petugas_id], "tb_user")->row();
      // var_dump($input->petugas_id);
      if ($check->user_foto != "default.jpg") {
        unlink("./vendor/img/user/".$check->user_foto);
      }
      $config['upload_path']          = './vendor/img/user/';
      $config['allowed_types']        = 'jpg|png|jpeg';
      $config['max_size']             = 802400;
      $config['max_width']            = 100000;
      $config['max_height']           = 100000;

      $this->load->library('upload');
      $this->upload->initialize($config);
      if (!$this->upload->do_upload('user_foto')) {
        $this->session->set_flashdata('pesan', '<script>sweet("Gagal","Gagal upload foto!","error","Tutup")</script>');
        redirect('petugas_edit/'.$input->petugas_id);
      }
      $data = ["user_foto" => $user_foto];
      $where = ["user_id" => $input->petugas_id];
      $query = $this->M_data->updateData($data, $where, "tb_user");
    } 
    if ($input->user_password != "") {
      $data = ["user_password" => password_hash($input->user_password, PASSWORD_DEFAULT)];
      $where = ["user_id" => $input->petugas_id];
      $query = $this->M_data->updateData($data, $where, "tb_user");
    }
    $user_noId=$input->user_noId;
    $this->load->library('ciqrcode');

    $config['cacheable']    = true; //boolean, the default is true
    $config['cachedir']     = './vendor/'; //string, the default is application/cache/
    $config['errorlog']     = './vendor/'; //string, the default is application/logs/
    $config['imagedir']     = './vendor/img/qr/'; //direktori penyimpanan qr code
    $config['quality']      = true; //boolean, the default is true
    $config['size']         = '512'; //interger, the default is 1024
    $config['black']        = array(224,255,255); // array, default is array(255,255,255)
    $config['white']        = array(70,130,180); // array, default is array(0,0,0)
    $this->ciqrcode->initialize($config);

		$image_name=$user_noId.'.png'; //buat name dari qr code sesuai dengan nim
		
		$dataqr = $user_noId;

    $params['data'] = $dataqr; //data yang akan di jadikan QR CODE
    $params['level'] = 'H'; //H=High
    $params['size'] = 10;
    $params['savename'] = $config['imagedir'].$image_name; //simpan image QR CODE ke folder assets/images/
    $this->ciqrcode->generate($params);
    $data = [
      'user_noId' => $input->user_noId,
      'user_nama' => $input->user_nama,
      'user_tempatLahir' => $input->user_tempatLahir,
      'user_tanggalLahir' => $input->user_tanggalLahir,
      'user_klasifikasi' => $input->user_klasifikasi,
      'user_ktp' => $input->user_ktp,
      'user_username' => $input->user_username,
      'user_noHP' => $input->user_noHP,
      'user_email' => $input->user_email,
      'user_qr' => $image_name
    ];
    $where1 = ["user_id" => $input->petugas_id];
    $query = $this->M_data->updateData($data, $where1, "tb_user");
    if ($query) {
      $data2 = [
        'orangtua_nama' => $input->orangtua_nama,
        'orangtua_tempatLahir' => $input->orangtua_tempatLahir,
        'orangtua_tanggalLahir' => $input->orangtua_tanggalLahir,
        'orangtua_noHP' => $input->orangtua_noHP
      ];
      $where2 = ["orangtua_user" => $input->petugas_id];
      $query2 = $this->M_data->updateData($data2, $where2, "tb_identitas_orangtua");
      if ($query2) {
        $data3 = [
          'pertanyaan' => $input->pertanyaan,
          'pertanyaan_jawaban' => $input->jawaban
        ];
        $where3 = ["pertanyaan_user" => $input->petugas_id];
        $query3 = $this->M_data->updateData($data3, $where3, "tb_pertanyaan_keamanan");
        if ($query3) {
          $this->session->set_flashdata('pesan', '<script>sweet("Sukses","Data petugas berhasil diubah!","success","Tutup")</script>');
          redirect("dataPetugas");
        } else {
          $this->session->set_flashdata('pesan', '<script>sweet("Gagal","Query3 failed!","error","Tutup")</script>');
          redirect('petugas_edit/'.$input->petugas_id);
        }
      } else {
        $this->session->set_flashdata('pesan', '<script>sweet("Gagal","Query2 failed!","error","Tutup")</script>');
        redirect('petugas_edit/'.$input->petugas_id);
      }
    } else {
      $this->session->set_flashdata('pesan', '<script>sweet("Gagal","Query1 failed!","error","Tutup")</script>');
      redirect('petugas_edit/'.$input->petugas_id);
    }
  }

  public function process_petugas_delete($id)
  {
    $user_id = (int)$this->db->escape_str($id);
    $get_user = $this->M_data->editData(["user_id" => $user_id], "tb_user")->row();
    unlink("./vendor/img/qr/".$get_user->user_qr);
    $check = $this->M_data->deleteData(["user_id" => $user_id], "tb_user");
    if ($check) {
      $this->M_data->deleteData(["orangtua_user" => $user_id], "tb_identitas_orangtua");
      $this->M_data->deleteData(["pertanyaan_user" => $user_id], "tb_pertanyaan_keamanan");
      $this->session->set_flashdata('pesan', '<script>sweet("Sukses","Data petugas berhasil dihapus!","success","Tutup")</script>');
      redirect("dataPetugas");
    } else {
      $this->session->set_flashdata('pesan', '<script>sweet("Gagal","Query failed!","success","Tutup")</script>');
      redirect("dataPetugas");
    }
  }

  public function cetakPetugas($id)
  {
    $data = [
      'title' => 'Cetak Kartu Petugas',
      'user' => $this->M_data->editData(['user_id' => $this->session->userdata('id')],'tb_user')->row(),
      'menu' => $this->M_data->get_access_menu()->result_array(),
      'user' => $this->M_data->editData(['user_id' => (int)$id],'tb_user')->row()
    ];
    $this->load->view('admin/v_cetakUser',$data);
  }
	
	public function logout()
	{
		// $this->session->sess_destroy();
		$this->session->unset_userdata('admin_id');
		$this->session->unset_userdata('role_id');
		$this->session->unset_userdata('id');
		$this->session->unset_userdata('status');
		$this->session->set_flashdata('pesan', '<script>sweet("Anda telah logout", "Sampai jumpa!", "warning", "tutup")</script>');
		redirect("index");
	}
}
