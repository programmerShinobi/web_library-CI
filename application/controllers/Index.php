<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');
class Index extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
    genBooking();
  }

	public function index()
	{
		if ($this->session->userdata("role_id") == 1) {
			redirect("logout");
		} else if ($this->session->userdata("role_id") == 2) {
			redirect("logout");
		} else if ($this->session->userdata("role_id") >= 4) {
			redirect("logout");
		}

		get_pengunjung();
		$this->session->unset_userdata('status');
		$data = [
			'title' => 'Perpustakaan Karawang',
		    'user' => $this->M_data->editData(['user_id' => $this->session->userdata('admin_id')], 'tb_user')->row(),
			'website' => $this->M_data->getData("tb_website")->row(),
			'list_buku' => $this->M_data->editData(["buku_stok >" => 0], "tb_buku", 6)->result(),
			'total_pinjaman' => $this->M_data->editData(["cart_user" => $this->session->userdata("admin_id")],"tb_cart")->num_rows(),
			'list_katalog' => $this->M_data->getData("tb_buku")->result(),
			'total_buku_saya' => $this->M_data->buku_saya()->num_rows(),
			'total_buku_pinjam' => $this->M_data->buku_pinjam()->num_rows(),
		];
		$this->load->view("v_header", $data);
		$this->load->view("user/v_user", $data);
		$this->load->view("v_footer");
		
	}

	public function pinjam_buku($id)
	{
		if ($this->session->userdata("role_id") == 1) {
			redirect("block");
		} else if ($this->session->userdata("role_id") == 2) {
			redirect("block");
		} else if ($this->session->userdata("role_id") >= 4) {
			redirect("block");
		}
		
        $jam_now = date('H i s');
		if(!$this->session->userdata('admin_id')) {
			$this->session->set_flashdata('pesan', '<script>sweet("Gagal","Anda perlu login terlebih dahulu!","warning","Tutup");</script>');			
			redirect('login');
		} elseif ($jam_now > "12 00 00") {
		    $this->session->set_flashdata('pesan', '<script>sweet("Gagal","Batas waktu booking buku dari pukul 05:00 - 12.00 WIB","warning","Tutup");</script>');
		    redirect('index');
		} elseif ($jam_now < "05 00 00") {
		    $this->session->set_flashdata('pesan', '<script>sweet("Gagal","Batas waktu booking buku dari pukul 05:00 - 12.00 WIB","warning","Tutup");</script>');
		    redirect('index');
		} else {
			$buku_id = (int)$this->db->escape_str($id);
			$cek = $this->M_data->editData(['cart_buku' => $buku_id, 'cart_user' => $this->session->userdata('admin_id')],'tb_cart')->row();
			$buku = $this->M_data->editData(['buku_id' => $buku_id,],'tb_buku')->row();

			if($cek) {
				$data = ['cart_jumlah' => $cek->cart_jumlah+1];
				$where = ['cart_id' => $cek->cart_id];

				$this->M_data->updateData($data,$where,'tb_cart');
			} else {
				$noId = rand(1,100000);
				$data = [
					'cart_noId' => $noId,
					'cart_user' => $this->session->userdata('admin_id'),
					'cart_buku' => $buku_id,
					'cart_jumlah' => 1,
					'cart_hari' => hariIndonesia(),
					'cart_tanggal' => date('Y-m-d')
				];
				$this->M_data->insertData($data,'tb_cart');
				$this->session->set_flashdata('pesan', '<script>sweet("Sukses","Buku berhasil dimasukan kedalam keranjang peminjamanan!","success","Tutup");</script>');
				redirect('pinjaman_saya');
			}

		}		
	}
	
	public function koleksi_buku($num = "")
	{
		if ($this->session->userdata("role_id") == 1) {
			redirect("block");
		} else if ($this->session->userdata("role_id") == 2) {
			redirect("block");
		} else if ($this->session->userdata("role_id") >= 4) {
			redirect("block");
		}
		$config['base_url'] = base_url('koleksi_buku');
		$config['total_rows'] = $this->M_data->editData(['buku_stok >' => -1],'tb_buku')->num_rows();
		$config['per_page'] = 12;

		$config['first_link']       = 'First';
		$config['last_link']        = 'Last';
		$config['next_link']        = 'Next';
		$config['prev_link']        = 'Prev';
		$config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
		$config['full_tag_close']   = '</ul></nav></div>';
		$config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
		$config['num_tag_close']    = '</span></li>';
		$config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
		$config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
		$config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
		$config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['prev_tagl_close']  = '</span>Next</li>';
		$config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
		$config['first_tagl_close'] = '</span></li>';
		$config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['last_tagl_close']  = '</span></li>';
		$this->pagination->initialize($config);
		$data = [
			'title' => 'KOLEKSI BUKU',
		    'user' => $this->M_data->editData(['user_id' => $this->session->userdata('admin_id')], 'tb_user')->row(),
			'website' => $this->M_data->getData("tb_website")->row(),
			'buku' => $this->M_data->data(12,$num,['buku_stok >' => -1])->result(),
			'link' => $this->pagination->create_links(),
			'total_pinjaman' => $this->M_data->editData(["cart_user" => $this->session->userdata("admin_id")],"tb_cart")->num_rows(),
			'total_buku_saya' => $this->M_data->buku_saya()->num_rows(),
			'total_buku_pinjam' => $this->M_data->buku_pinjam()->num_rows(),
		];
		if ($this->uri->segment('3')==''){
			$dari = 0;
		}else{
			$dari = $this->uri->segment('3');
		}
		if (is_numeric($dari)) {
			if ($this->input->post('kata')){
				$config['base_url'] = base_url('koleksi_buku');
				$config['total_rows'] = $this->M_data->editData(['buku_stok >' => 0],'tb_buku')->num_rows();
				$config['per_page'] = 99999999999;
		
				$config['first_link']       = 'First';
				$config['last_link']        = 'Last';
				$config['next_link']        = 'Next';
				$config['prev_link']        = 'Prev';
				$config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
				$config['full_tag_close']   = '</ul></nav></div>';
				$config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
				$config['num_tag_close']    = '</span></li>';
				$config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
				$config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
				$config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
				$config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
				$config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
				$config['prev_tagl_close']  = '</span>Next</li>';
				$config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
				$config['first_tagl_close'] = '</span></li>';
				$config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
				$config['last_tagl_close']  = '</span></li>';
				$this->pagination->initialize($config);
				// $data['buku'] = $this->db->query("SELECT * FROM tb_buku  where buku_judul LIKE '%".cetak($this->input->post('kata'))."%' ORDER BY buku_id DESC LIMIT $dari,$config[per_page]");
				$data = [
					'website' => $this->M_data->getData("tb_website")->row(),
					// 'buku' => $this->M_data->data(12,$num,['buku_judul'=>$this->input->post('kata')])->result(),
					'buku' => $this->M_data->get_buku(99999999999,$num,['buku_stok >' => -1])->result(),					
					'link' => $this->pagination->create_links(),
					'total_pinjaman' => $this->M_data->editData(["cart_user" => $this->session->userdata("admin_id")],"tb_cart")->num_rows(),
					'total_buku_saya' => $this->M_data->buku_saya()->num_rows(),
					'total_buku_pinjam' => $this->M_data->buku_pinjam()->num_rows(),
				];
				// $where = ["buku_judul LIKE '%".$this->input->post('kata')."%' OR buku_penulis LIKE '%".$this->input->post('kata')."%' OR buku_tahunTerbit LIKE '%".$this->input->post('kata')."%' ORDER BY buku_id DESC"];
			} 

		}
		$this->load->view('v_header',$data);
		$this->load->view('user/v_bukuLainnya',$data);
		$this->load->view('v_footer');
	}

	public function koleksi_literasi($num = "")
	{
		if ($this->session->userdata("role_id") == 1) {
			redirect("block");
		} else if ($this->session->userdata("role_id") == 2) {
			redirect("block");
		} else if ($this->session->userdata("role_id") >= 4) {
			redirect("block");
		}

		$config['base_url'] = base_url('koleksi_literasi');
		$config['total_rows'] = $this->M_data->editData(['buku_stok >' => -1], 'tb_buku')->num_rows();
		$config['per_page'] = 12;

		$config['first_link']       = 'First';
		$config['last_link']        = 'Last';
		$config['next_link']        = 'Next';
		$config['prev_link']        = 'Prev';
		$config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
		$config['full_tag_close']   = '</ul></nav></div>';
		$config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
		$config['num_tag_close']    = '</span></li>';
		$config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
		$config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
		$config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
		$config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['prev_tagl_close']  = '</span>Next</li>';
		$config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
		$config['first_tagl_close'] = '</span></li>';
		$config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['last_tagl_close']  = '</span></li>';
		$this->pagination->initialize($config);
		$data = [
			'title' => 'KOLEKSI LITERASI',
			'user' => $this->M_data->editData(['user_id' => $this->session->userdata('admin_id')], 'tb_user')->row(),
			'website' => $this->M_data->getData("tb_website")->row(),
			'buku' => $this->M_data->data(12, $num, ['buku_stok >' => -1])->result(),
			'link' => $this->pagination->create_links(),
			'total_pinjaman' => $this->M_data->editData(["cart_user" => $this->session->userdata("admin_id")], "tb_cart")->num_rows(),
			'total_buku_saya' => $this->M_data->buku_saya()->num_rows(),
			'total_buku_pinjam' => $this->M_data->buku_pinjam()->num_rows(),
		];
		if ($this->uri->segment('3') == '') {
			$dari = 0;
		} else {
			$dari = $this->uri->segment('3');
		}
		if (is_numeric($dari)) {
			if ($this->input->post('kata')) {
				$config['base_url'] = base_url('koleksi_literasi');
				$config['total_rows'] = $this->M_data->editData(['buku_stok >' => 0], 'tb_buku')->num_rows();
				$config['per_page'] = 99999999999;

				$config['first_link']       = 'First';
				$config['last_link']        = 'Last';
				$config['next_link']        = 'Next';
				$config['prev_link']        = 'Prev';
				$config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
				$config['full_tag_close']   = '</ul></nav></div>';
				$config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
				$config['num_tag_close']    = '</span></li>';
				$config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
				$config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
				$config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
				$config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
				$config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
				$config['prev_tagl_close']  = '</span>Next</li>';
				$config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
				$config['first_tagl_close'] = '</span></li>';
				$config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
				$config['last_tagl_close']  = '</span></li>';
				$this->pagination->initialize($config);
				// $data['buku'] = $this->db->query("SELECT * FROM tb_buku  where buku_judul LIKE '%".cetak($this->input->post('kata'))."%' ORDER BY buku_id DESC LIMIT $dari,$config[per_page]");
				$data = [
					'website' => $this->M_data->getData("tb_website")->row(),
					// 'buku' => $this->M_data->data(12,$num,['buku_judul'=>$this->input->post('kata')])->result(),
					'buku' => $this->M_data->get_buku(99999999999, $num, ['buku_stok >' => -1])->result(),
					'link' => $this->pagination->create_links(),
					'total_pinjaman' => $this->M_data->editData(["cart_user" => $this->session->userdata("admin_id")], "tb_cart")->num_rows(),
					'total_buku_saya' => $this->M_data->buku_saya()->num_rows(),
					'total_buku_pinjam' => $this->M_data->buku_pinjam()->num_rows(),
				];
				// $where = ["buku_judul LIKE '%".$this->input->post('kata')."%' OR buku_penulis LIKE '%".$this->input->post('kata')."%' OR buku_tahunTerbit LIKE '%".$this->input->post('kata')."%' ORDER BY buku_id DESC"];
			}
		}
		$this->load->view('v_header', $data);
		$this->load->view('user/v_ebook', $data);
		$this->load->view('v_footer');
	}
	
	public function koleksi_film($num = "")
	{
		if ($this->session->userdata("role_id") == 1) {
			redirect("block");
		} else if ($this->session->userdata("role_id") == 2) {
			redirect("block");
		} else if ($this->session->userdata("role_id") >= 4) {
			redirect("block");
		}

		$config['base_url'] = base_url('koleksi_film');
		$config['total_rows'] = $this->M_data->editData(['buku_stok >' => -1], 'tb_buku')->num_rows();
		$config['per_page'] = 12;

		$config['first_link']       = 'First';
		$config['last_link']        = 'Last';
		$config['next_link']        = 'Next';
		$config['prev_link']        = 'Prev';
		$config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
		$config['full_tag_close']   = '</ul></nav></div>';
		$config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
		$config['num_tag_close']    = '</span></li>';
		$config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
		$config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
		$config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
		$config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['prev_tagl_close']  = '</span>Next</li>';
		$config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
		$config['first_tagl_close'] = '</span></li>';
		$config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['last_tagl_close']  = '</span></li>';
		$this->pagination->initialize($config);
		$data = [
			'title' => 'KOLEKSI FILM',
			'user' => $this->M_data->editData(['user_id' => $this->session->userdata('admin_id')], 'tb_user')->row(),
			'website' => $this->M_data->getData("tb_website")->row(),
			'buku' => $this->M_data->data(12, $num, ['buku_stok >' => -1])->result(),
			'link' => $this->pagination->create_links(),
			'total_pinjaman' => $this->M_data->editData(["cart_user" => $this->session->userdata("admin_id")], "tb_cart")->num_rows(),
			'total_buku_saya' => $this->M_data->buku_saya()->num_rows(),
			'total_buku_pinjam' => $this->M_data->buku_pinjam()->num_rows(),
		];
		if ($this->uri->segment('3') == '') {
			$dari = 0;
		} else {
			$dari = $this->uri->segment('3');
		}
		if (is_numeric($dari)) {
			if ($this->input->post('kata')) {
				$config['base_url'] = base_url('koleksi_film');
				$config['total_rows'] = $this->M_data->editData(['buku_stok >' => 0], 'tb_buku')->num_rows();
				$config['per_page'] = 99999999999;

				$config['first_link']       = 'First';
				$config['last_link']        = 'Last';
				$config['next_link']        = 'Next';
				$config['prev_link']        = 'Prev';
				$config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
				$config['full_tag_close']   = '</ul></nav></div>';
				$config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
				$config['num_tag_close']    = '</span></li>';
				$config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
				$config['cur_tag_close']    = '<span ckoleksi_filmlass="sr-only">(current)</span></span></li>';
				$config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
				$config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
				$config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
				$config['prev_tagl_close']  = '</span>Next</li>';
				$config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
				$config['first_tagl_close'] = '</span></li>';
				$config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
				$config['last_tagl_close']  = '</span></li>';
				$this->pagination->initialize($config);
				// $data['buku'] = $this->db->query("SELECT * FROM tb_buku  where buku_judul LIKE '%".cetak($this->input->post('kata'))."%' ORDER BY buku_id DESC LIMIT $dari,$config[per_page]");
				$data = [
					'title' => 'KOLEKSI FILM',
					'website' => $this->M_data->getData("tb_website")->row(),
					// 'buku' => $this->M_data->data(12,$num,['buku_judul'=>$this->input->post('kata')])->result(),
					'buku' => $this->M_data->get_buku(99999999999, $num, ['buku_stok >' => -1])->result(),
					'link' => $this->pagination->create_links(),
					'total_pinjaman' => $this->M_data->editData(["cart_user" => $this->session->userdata("admin_id")], "tb_cart")->num_rows(),
					'total_buku_saya' => $this->M_data->buku_saya()->num_rows(),
					'total_buku_pinjam' => $this->M_data->buku_pinjam()->num_rows(),
				];
				// $where = ["buku_judul LIKE '%".$this->input->post('kata')."%' OR buku_penulis LIKE '%".$this->input->post('kata')."%' OR buku_tahunTerbit LIKE '%".$this->input->post('kata')."%' ORDER BY buku_id DESC"];
			}
		}
		$this->load->view('v_header', $data);
		$this->load->view('user/v_emovie', $data);
		$this->load->view('v_footer');
	}
	
	public function pinjaman_saya()
	{
		if ($this->session->userdata("role_id") == 1) {
			redirect("block");
		} else if ($this->session->userdata("role_id") == 2) {
			redirect("block");
		} else if ($this->session->userdata("role_id") >= 4) {
			redirect("block");
		}
		$start = $this->input->post('start_order_date');
		$end = $this->input->post('end_order_date');
    	$data = [
    	  'title' => 'KERANJANG BUKU',
  	      'user' => $this->M_data->editData(['user_id' => $this->session->userdata('admin_id')], 'tb_user')->row(),
          'website' => $this->M_data->getData("tb_website")->row(),
          'list_cart' => $this->M_data->get_cart_buku()->result(),
          'total_pinjaman' => $this->M_data->editData(["cart_user" => $this->session->userdata("admin_id")],"tb_cart")->num_rows(),
          'total_buku_saya' => $this->M_data->buku_saya()->num_rows(),
		  'total_buku_pinjam' => $this->M_data->buku_pinjam()->num_rows(),
        ];
        $this->load->view("v_header", $data);
        $this->load->view("user/v_pinjamanSaya", $data);
        $this->load->view("v_footer");
	}

	public function process_cart()
	{
        if ($this->session->userdata("role_id") <= 2) {
    		redirect("block");
    	} else if ($this->session->userdata("role_id") >= 4) {
    		redirect("block");
    	}
		$this->form_validation->set_rules('dikembalikan', 'Dikembalikan', 'required');
		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('pesan', '<script>sweet("Gagal","Buku gagal dibooking","error","Tutup")</script>');
			redirect('pinjaman_saya');
		} else {
			$tgl = html_escape($this->input->post('dikembalikan'));
			$cek = $this->M_data->editData(['cart_user' => $this->session->userdata('admin_id')],'tb_cart')->result();
			$noId = rand(1,1000000);
			foreach($cek as $c) {
				 
				//Ambil data buku & pengurangan jumlah stok yang akan di-cart
				$buku = $this->M_data->editData(['buku_id' => $c->cart_buku],'tb_buku')->row();				
				$actual = $buku->buku_stok;
				$dest = $c->cart_jumlah;
				
				if ($actual >= $dest) {
					if ($actual == 0) {
					} else {
						$data = [
							'booking_noid' => $noId,
							'booking_user' => $c->cart_user,
							'booking_buku' => $c->cart_buku,
							'booking_jumlah' => $c->cart_jumlah,
							'booking_waktu' => date('Y-m-d H:i:s'),
							'booking_pengembalian' => $tgl,
							'booking_expired' => date('Y-m-d 16:00:00'),
							'booking_accept' => 0
						];
						$this->M_data->insertData($data,'tb_booking');	
	
						// $buku = $this->M_data->editData(['buku_id' => $c->cart_buku],'tb_buku')->row();
						// $kurang = $actual - $dest;
						// $data1 = ['buku_stok' => $kurang];
						// $where = ['buku_id' => $c->cart_buku];
						// $this->M_data->updateData($data1,$where,'tb_buku');

                		$hariIni = date('D') ;
                		if ($hariIni == "Sun") {
                			$hariIni = 'Minggu';
                		} else if ($hariIni == "Mon") {
                			$hariIni = 'Senin';
                		} else if ($hariIni == "Tue") {
                			$hariIni = 'Selasa';
                		} else if ($hariIni == "Wed") {
                			$hariIni = 'Rabu';
                		} else if ($hariIni == "Thu") {
                			$hariIni = 'Kamis';
                		} else if ($hariIni == "Fri") {
                			$hariIni = 'Jumat';
                		} else if ($hariIni == "Sat") {
                			$hariIni = 'Sabtu';
                		}
                		$bulanIni = date('m');
                		if ($bulanIni == "01") {
                			$bulanIni = 'Januari';
                		} else if ($bulanIni == "02") {
                			$bulanIni = 'Februari';
                		} else if ($bulanIni == "03") {
                			$bulanIni = 'Maret';
                		} else if ($bulanIni == "04") {
                			$bulanIni = 'April';
                		} else if ($bulanIni == "05") {
                			$bulanIni = 'Mei';
                		} else if ($bulanIni == "06") {
                			$bulanIni = 'Juni';
                		} else if ($bulanIni == "07") {
                			$bulanIni = 'Juli';
                		} else if ($bulanIni == "08") {
                			$bulanIni = 'Agustus';
                		} else if ($bulanIni == "09") {
                			$bulanIni = 'September';
                		} else if ($bulanIni == "10") {
                			$bulanIni = 'Oktober';
                		} else if ($bulanIni == "11") {
                			$bulanIni = 'November';
                		} else if ($bulanIni == "12") {
                			$bulanIni = 'Desember';
                		}
                		
                		$jam_now = date('H i s');
                		if ($jam_now > "03 00 00" && $jam_now < "10 00 00") {
                			$waktu = "Pagi";
                		} elseif ($jam_now > "10 00 00" && $jam_now < "15 00 00") {
                			$waktu = "Siang";
                		} elseif ($jam_now > "15 00 00"&& $jam_now < "18 00 00") {
                			$waktu = "Sore";
                		} elseif ($jam_now > "18 00 00" && $jam_now < "24 00 00") {
                			$waktu = "Malam";
                		} elseif ($jam_now > "00 00 00" && $jam_now < "03 00 00") {
                			$waktu = "Malam";
                		}
                
                		$idBooking = $noId;
                		$data_array = $this->M_data->get_bookingProccesed($idBooking);
                		foreach ($data_array as $key) {
                			$config = array(
                			    //---SMTP with SSL/TLS
                				'protocol' => 'SMTP',
                				'smtp_host' => 'ssl://mail.e-web.id',
                				'smtp_port' => 465,
                				'smtp_user' => 'admin@e-web.id',
                				'smtp_pass' => 'Faqih_12195',
                				'mailtype' => 'html',
                				'charset' => 'iso-8859-1'
                			    
                			    // //---POP3 with SSL/TLS
                				// 'protocol' => 'pop3',
                				// 'smtp_host' => 'ssl://mail.e-web.id',
                				// 'smtp_port' => 995,
                				// 'smtp_user' => 'admin@e-web.id',
                				// 'smtp_pass' => 'Faqih_12195',
                				// 'mailtype' => 'html',
                				// 'charset' => 'iso-8859-1'
                				
                				// //---IMAP with SSL/TLS
                				// 'protocol' => 'imap',
                				// 'smtp_host' => 'ssl://mail.e-web.id',
                				// 'smtp_port' => 993,
                				// 'smtp_user' => 'admin@e-web.id',
                				// 'smtp_pass' => 'Faqih_12195',
                				// 'mailtype' => 'html',
                				// 'charset' => 'iso-8859-1'
                				
                				// //---IMAP with non SSL/TLS
                				// 'protocol' => 'imap',
                				// 'smtp_host' => 'mail.e-web.id',
                				// 'smtp_port' => 143,
                				// 'smtp_user' => 'admin@e-web.id',
                				// 'smtp_pass' => 'Faqih_12195',
                				// 'mailtype' => 'html',
                				// 'charset' => 'iso-8859-1'
                				
                				// //---POP3 with non SSL/TLS
                				// 'protocol' => 'POP3',
                				// 'smtp_host' => 'mail.e-web.id',
                				// 'smtp_port' => 110,
                				// 'smtp_user' => 'admin@e-web.id',
                				// 'smtp_pass' => 'Faqih_12195',
                				// 'mailtype' => 'html',
                				// 'charset' => 'iso-8859-1'
                			);
                			$this->load->library('email', $config);
                			$this->email->set_newline("\r\n");
                			$this->email->from('admin@e-web.id');
                			$this->email->to($key->user_email);
                			$this->email->subject('Info Booking Buku di Perpustakaan Pemda Karawang');
                			$this->email->message('Selamat '.$waktu.'.. '.'<p align="justify">Diberitahukan kepada saudara/i '.$key->user_nama.'.. Segera datang ke Perpustakaan Pemda Karawang hari ini. Kami harapkan Anda datang ke perpustakaan tidak lewat pukul '.date("H:i", strtotime($key->booking_expired)).' WIB, jika melawati batas waktu booking tersebut, maka proses booking tidak akan diterima.</p> Terimakasih..<p align="justify">Dinas Perpustakaan dan Kearsipan Daerah Kabupaten Karawang.<br>Jalan Jendaral A.Yani nomor 10 Kelurahan Nagarasari, Kecamatan Karawang Barat, Kabupaten Karawang, Provinsi Jawa Barat 41316.</p>Silahkan kunjung website Kami : https://e-web.id/');
        		            $kirim = $this->email->send();
						}
						
						$this->session->set_flashdata('pesan', '<script>sweet("Sukses","Silahkan cek email Anda untuk info lebih lanjut!","success","Tutup")</script>');
						
						$this->M_data->deleteData(['cart_user' => $this->session->userdata('admin_id')],'tb_cart');
					}
					
					
				} elseif ($actual <= $dest) {
					if ($actual == 0) {
					} else {
						$data = [
							'booking_noid' => $noId,
							'booking_user' => $c->cart_user,
							'booking_buku' => $c->cart_buku,
							'booking_jumlah' => $actual,
							'booking_waktu' => date('Y-m-d H:i:s'),
							'booking_pengembalian' => $tgl,
							'booking_expired' => date('Y-m-d 16:00:00'),
							'booking_accept' => 0
						];
						$this->M_data->insertData($data,'tb_booking');										
	
						// $buku = $this->M_data->editData(['buku_id' => $c->cart_buku],'tb_buku')->row();
						// $data1 = ['buku_stok' => 0];
						// $where = ['buku_id' => $c->cart_buku];
						// $this->M_data->updateData($data1,$where,'tb_buku');

                		$hariIni = date('D') ;
                		if ($hariIni == "Sun") {
                			$hariIni = 'Minggu';
                		} else if ($hariIni == "Mon") {
                			$hariIni = 'Senin';
                		} else if ($hariIni == "Tue") {
                			$hariIni = 'Selasa';
                		} else if ($hariIni == "Wed") {
                			$hariIni = 'Rabu';
                		} else if ($hariIni == "Thu") {
                			$hariIni = 'Kamis';
                		} else if ($hariIni == "Fri") {
                			$hariIni = 'Jumat';
                		} else if ($hariIni == "Sat") {
                			$hariIni = 'Sabtu';
                		}
                		$bulanIni = date('m');
                		if ($bulanIni == "01") {
                			$bulanIni = 'Januari';
                		} else if ($bulanIni == "02") {
                			$bulanIni = 'Februari';
                		} else if ($bulanIni == "03") {
                			$bulanIni = 'Maret';
                		} else if ($bulanIni == "04") {
                			$bulanIni = 'April';
                		} else if ($bulanIni == "05") {
                			$bulanIni = 'Mei';
                		} else if ($bulanIni == "06") {
                			$bulanIni = 'Juni';
                		} else if ($bulanIni == "07") {
                			$bulanIni = 'Juli';
                		} else if ($bulanIni == "08") {
                			$bulanIni = 'Agustus';
                		} else if ($bulanIni == "09") {
                			$bulanIni = 'September';
                		} else if ($bulanIni == "10") {
                			$bulanIni = 'Oktober';
                		} else if ($bulanIni == "11") {
                			$bulanIni = 'November';
                		} else if ($bulanIni == "12") {
                			$bulanIni = 'Desember';
                		}
                		
                		$jam_now = date('H i s');
                		if ($jam_now > "03 00 00" && $jam_now < "10 00 00") {
                			$waktu = "Pagi";
                		} elseif ($jam_now > "10 00 00" && $jam_now < "15 00 00") {
                			$waktu = "Siang";
                		} elseif ($jam_now > "15 00 00"&& $jam_now < "18 00 00") {
                			$waktu = "Sore";
                		} elseif ($jam_now > "18 00 00" && $jam_now < "24 00 00") {
                			$waktu = "Malam";
                		} elseif ($jam_now > "00 00 00" && $jam_now < "03 00 00") {
                			$waktu = "Malam";
                		}
                
                		$idBooking = $noId;
                		$data_array = $this->M_data->get_bookingProccesed($idBooking);
                		foreach ($data_array as $key) {
                			$config = array(
                			    //---SMTP with SSL/TLS
                				'protocol' => 'SMTP',
                				'smtp_host' => 'ssl://mail.e-web.id',
                				'smtp_port' => 465,
                				'smtp_user' => 'admin@e-web.id',
                				'smtp_pass' => 'Faqih_12195',
                				'mailtype' => 'html',
                				'charset' => 'iso-8859-1'
                			    
                			    // //---POP3 with SSL/TLS
                				// 'protocol' => 'pop3',
                				// 'smtp_host' => 'ssl://mail.e-web.id',
                				// 'smtp_port' => 995,
                				// 'smtp_user' => 'admin@e-web.id',
                				// 'smtp_pass' => 'Faqih_12195',
                				// 'mailtype' => 'html',
                				// 'charset' => 'iso-8859-1'
                				
                				// //---IMAP with SSL/TLS
                				// 'protocol' => 'imap',
                				// 'smtp_host' => 'ssl://mail.e-web.id',
                				// 'smtp_port' => 993,
                				// 'smtp_user' => 'admin@e-web.id',
                				// 'smtp_pass' => 'Faqih_12195',
                				// 'mailtype' => 'html',
                				// 'charset' => 'iso-8859-1'
                				
                				// //---IMAP with non SSL/TLS
                				// 'protocol' => 'imap',
                				// 'smtp_host' => 'mail.e-web.id',
                				// 'smtp_port' => 143,
                				// 'smtp_user' => 'admin@e-web.id',
                				// 'smtp_pass' => 'Faqih_12195',
                				// 'mailtype' => 'html',
                				// 'charset' => 'iso-8859-1'
                				
                				// //---POP3 with non SSL/TLS
                				// 'protocol' => 'POP3',
                				// 'smtp_host' => 'mail.e-web.id',
                				// 'smtp_port' => 110,
                				// 'smtp_user' => 'admin@e-web.id',
                				// 'smtp_pass' => 'Faqih_12195',
                				// 'mailtype' => 'html',
                				// 'charset' => 'iso-8859-1'
                			);
                			$this->load->library('email', $config);
                			$this->email->set_newline("\r\n");
                			$this->email->from('admin@e-web.id');
                			$this->email->to($key->user_email);
                			$this->email->subject('Info Booking Buku di Perpustakaan Pemda Karawang');
                			$this->email->message('Selamat '.$waktu.'.. '.'<p align="justify">Diberitahukan kepada saudara/i '.$key->user_nama.'.. Segera datang ke Perpustakaan Pemda Karawang hari ini. Kami harapkan Anda datang ke perpustakaan tidak lewat pukul '.date("H:i", strtotime($key->booking_expired)).' WIB, jika melawati batas waktu booking tersebut, maka proses booking tidak akan diterima.</p> Terimakasih..<p align="justify">Dinas Perpustakaan dan Kearsipan Daerah Kabupaten Karawang.<br>Jalan Jendaral A.Yani nomor 10 Kelurahan Nagarasari, Kecamatan Karawang Barat, Kabupaten Karawang, Provinsi Jawa Barat 41316.</p>Silahkan kunjung website Kami : https://e-web.id/');
        		            $kirim = $this->email->send();
						}
						
						$this->session->set_flashdata('pesan', '<script>sweet("Sukses","Silahkan cek email Anda untuk info lebih lanjut! (".$key->buku_judul.")","success","Tutup")</script>');
						
						$this->M_data->deleteData(['cart_user' => $this->session->userdata('admin_id')],'tb_cart');
						
					}	
					

				} elseif ($actual == $dest) {
					if ($actual == 0) {
					} else {
						$data = [
							'booking_noid' => $noId,
							'booking_user' => $c->cart_user,
							'booking_buku' => $c->cart_buku,
							'booking_jumlah' => $actual,
							'booking_waktu' => date('Y-m-d H:i:s'),
							'booking_pengembalian' => $tgl,
							'booking_expired' => date('Y-m-d 16:00:00'),
							'booking_accept' => 0
						];
						$this->M_data->insertData($data,'tb_booking');
	
						// $buku = $this->M_data->editData(['buku_id' => $c->cart_buku],'tb_buku')->row();
						// $data1 = ['buku_stok' => 0];
						// $where = ['buku_id' => $c->cart_buku];
						// $this->M_data->updateData($data1,$where,'tb_buku');
                	
                		$hariIni = date('D') ;
                		if ($hariIni == "Sun") {
                			$hariIni = 'Minggu';
                		} else if ($hariIni == "Mon") {
                			$hariIni = 'Senin';
                		} else if ($hariIni == "Tue") {
                			$hariIni = 'Selasa';
                		} else if ($hariIni == "Wed") {
                			$hariIni = 'Rabu';
                		} else if ($hariIni == "Thu") {
                			$hariIni = 'Kamis';
                		} else if ($hariIni == "Fri") {
                			$hariIni = 'Jumat';
                		} else if ($hariIni == "Sat") {
                			$hariIni = 'Sabtu';
                		}
                		$bulanIni = date('m');
                		if ($bulanIni == "01") {
                			$bulanIni = 'Januari';
                		} else if ($bulanIni == "02") {
                			$bulanIni = 'Februari';
                		} else if ($bulanIni == "03") {
                			$bulanIni = 'Maret';
                		} else if ($bulanIni == "04") {
                			$bulanIni = 'April';
                		} else if ($bulanIni == "05") {
                			$bulanIni = 'Mei';
                		} else if ($bulanIni == "06") {
                			$bulanIni = 'Juni';
                		} else if ($bulanIni == "07") {
                			$bulanIni = 'Juli';
                		} else if ($bulanIni == "08") {
                			$bulanIni = 'Agustus';
                		} else if ($bulanIni == "09") {
                			$bulanIni = 'September';
                		} else if ($bulanIni == "10") {
                			$bulanIni = 'Oktober';
                		} else if ($bulanIni == "11") {
                			$bulanIni = 'November';
                		} else if ($bulanIni == "12") {
                			$bulanIni = 'Desember';
                		}
                		
                		$jam_now = date('H i s');
                		if ($jam_now > "03 00 00" && $jam_now < "10 00 00") {
                			$waktu = "Pagi";
                		} elseif ($jam_now > "10 00 00" && $jam_now < "15 00 00") {
                			$waktu = "Siang";
                		} elseif ($jam_now > "15 00 00"&& $jam_now < "18 00 00") {
                			$waktu = "Sore";
                		} elseif ($jam_now > "18 00 00" && $jam_now < "24 00 00") {
                			$waktu = "Malam";
                		} elseif ($jam_now > "00 00 00" && $jam_now < "03 00 00") {
                			$waktu = "Malam";
                		}
                
                		$idBooking = $noId;
                		$data_array = $this->M_data->get_bookingProccesed($idBooking);
                		foreach ($data_array as $key) {
                			$config = array(
                			    //---SMTP with SSL/TLS
                				'protocol' => 'SMTP',
                				'smtp_host' => 'ssl://mail.e-web.id',
                				'smtp_port' => 465,
                				'smtp_user' => 'admin@e-web.id',
                				'smtp_pass' => 'Faqih_12195',
                				'mailtype' => 'html',
                				'charset' => 'iso-8859-1'
                			    
                			    // //---POP3 with SSL/TLS
                				// 'protocol' => 'pop3',
                				// 'smtp_host' => 'ssl://mail.e-web.id',
                				// 'smtp_port' => 995,
                				// 'smtp_user' => 'admin@e-web.id',
                				// 'smtp_pass' => 'Faqih_12195',
                				// 'mailtype' => 'html',
                				// 'charset' => 'iso-8859-1'
                				
                				// //---IMAP with SSL/TLS
                				// 'protocol' => 'imap',
                				// 'smtp_host' => 'ssl://mail.e-web.id',
                				// 'smtp_port' => 993,
                				// 'smtp_user' => 'admin@e-web.id',
                				// 'smtp_pass' => 'Faqih_12195',
                				// 'mailtype' => 'html',
                				// 'charset' => 'iso-8859-1'
                				
                				// //---IMAP with non SSL/TLS
                				// 'protocol' => 'imap',
                				// 'smtp_host' => 'mail.e-web.id',
                				// 'smtp_port' => 143,
                				// 'smtp_user' => 'admin@e-web.id',
                				// 'smtp_pass' => 'Faqih_12195',
                				// 'mailtype' => 'html',
                				// 'charset' => 'iso-8859-1'
                				
                				// //---POP3 with non SSL/TLS
                				// 'protocol' => 'POP3',
                				// 'smtp_host' => 'mail.e-web.id',
                				// 'smtp_port' => 110,
                				// 'smtp_user' => 'admin@e-web.id',
                				// 'smtp_pass' => 'Faqih_12195',
                				// 'mailtype' => 'html',
                				// 'charset' => 'iso-8859-1'
                			);
                			$this->load->library('email', $config);
                			$this->email->set_newline("\r\n");
                			$this->email->from('admin@e-web.id');
                			$this->email->to($key->user_email);
                			$this->email->subject('Info Booking Buku di Perpustakaan Pemda Karawang');
                			$this->email->message('Selamat '.$waktu.'.. '.'<p align="justify">Diberitahukan kepada saudara/i '.$key->user_nama.'.. Segera datang ke Perpustakaan Pemda Karawang hari ini. Kami harapkan Anda datang ke perpustakaan tidak lewat pukul '.date("H:i", strtotime($key->booking_expired)).' WIB, jika melawati batas waktu booking tersebut, maka proses booking tidak akan diterima.</p> Terimakasih..<p align="justify">Dinas Perpustakaan dan Kearsipan Daerah Kabupaten Karawang.<br>Jalan Jendaral A.Yani nomor 10 Kelurahan Nagarasari, Kecamatan Karawang Barat, Kabupaten Karawang, Provinsi Jawa Barat 41316.</p>Silahkan kunjung website Kami : https://e-web.id/');
        		            $kirim = $this->email->send();
						}
						
						$this->session->set_flashdata('pesan', '<script>sweet("Sukses","Silahkan cek email Anda untuk info lebih lanjut! (".$key->buku_judul.")","success","Tutup")</script>');
						
						$this->M_data->deleteData(['cart_user' => $this->session->userdata('admin_id')],'tb_cart');
						
					}
				}
			}
			redirect('buku_saya');
		}
	}


	public function process_cart_delete($id)
	{
		if ($this->session->userdata("role_id") == 1) {
			redirect("block");
		} else if ($this->session->userdata("role_id") == 2) {
			redirect("block");
		} else if ($this->session->userdata("role_id") >= 4) {
			redirect("block");
		}
	    $cart_id = (int)$this->db->escape_str($id);
	    $check = $this->M_data->deleteData(["cart_id" => $cart_id], "tb_cart");
	    if ($check) {
    		$this->session->set_flashdata('pesan', '<script>sweet("Sukses","Data buku berhasil dihapus!","success","Tutup")</script>');
    		redirect("pinjaman_saya");
	    } else {
        	$this->session->set_flashdata('pesan', '<script>sweet("Gagal","Query failed!","error","Tutup")</script>');
        	redirect("pinjaman_saya");
	    }
	}

	public function buku_saya()
	{
        if ($this->session->userdata("role_id") <= 2) {
    		redirect("block");
    	} else if ($this->session->userdata("role_id") >= 4) {
    		redirect("block");
    	}
		$data = [
			'title' => 'BOOKING BUKU',
		    'user' => $this->M_data->editData(['user_id' => $this->session->userdata('admin_id')], 'tb_user')->row(),
			'website' => $this->M_data->getData("tb_website")->row(),
			'list_booking' => $this->M_data->booking_saya()->result(),
			'total_pinjaman' => $this->M_data->editData(["cart_user" => $this->session->userdata("admin_id")],"tb_cart")->num_rows(),
			'total_buku_saya' => $this->M_data->buku_saya()->num_rows(),
			'total_buku_pinjam' => $this->M_data->buku_pinjam()->num_rows(),
		];
		$this->load->view("v_header", $data);
		$this->load->view("user/v_bookPinjam", $data);
		$this->load->view("v_footer");
		if ($this->uri->segment('3')==''){
			$dari = 0;
		}else{
			$dari = $this->uri->segment('3');
		}
		if (is_numeric($dari)) {
			if ($this->input->post('kata')){
				$data = [
					'title' => 'BOOKING BUKU',
					'website' => $this->M_data->getData("tb_website")->row(),
					'list_booking' => $this->M_data->booking_saya()->result(),
					'total_pinjaman' => $this->M_data->editData(["cart_user" => $this->session->userdata("admin_id")],"tb_cart")->num_rows(),
					'total_buku_saya' => $this->M_data->buku_saya()->num_rows(),
					'total_buku_pinjam' => $this->M_data->buku_pinjam()->num_rows(),
				];
			} 

		}

	}

	public function booking_delete($id)
	{
		if ($this->session->userdata("role_id") == 1) {
			redirect("block");
		} else if ($this->session->userdata("role_id") == 2) {
			redirect("block");
		} else if ($this->session->userdata("role_id") >= 4) {
			redirect("block");
		}
		$booking_id = (int) $this->db->escape_str($id);
		$check = $this->M_data->deleteData(['booking_id' => $booking_id], 'tb_booking');
		if ($check) {
			$this->session->set_flashdata('pesan', '<script>sweet("Sukses","Data booking berhasil dihapus!","success","Tutup")</script>');
			redirect("buku_saya");
		} else {
			$this->session->set_flashdata('pesan', '<script>sweet("Gagal","Data booking gagal dihapus!","error","Tutup")</script>');
			redirect("buku_saya");
		}
	}

	public function myprofile()
	{
		if ($this->session->userdata("role_id") == 1) {
			redirect("block");
		} else if ($this->session->userdata("role_id") == 2) {
			redirect("block");
		} else if ($this->session->userdata("role_id") >= 4) {
			redirect("block");
		}
		$this->form_validation->set_rules('nama', 'Nama', 'required',[
			'required' => 'Masukan nama!'
		]);
		$this->form_validation->set_rules('hp', 'HP', 'required|numeric',[
			'required' => 'Masukan nomor HP!',
			'numeric' => 'Masukan hanya angka!'
		]);
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email',[
			'required' => 'Masukan Email!',
			'valid_email' => 'Masukan format email dengan benar!'
		]);

		
		if ($this->form_validation->run() == FALSE) {
			$data = [
				'title' => 'PROFILE',
			    'user' => $this->M_data->editData(['user_id' => $this->session->userdata('admin_id')], 'tb_user')->row(),
				'website' => $this->M_data->getData("tb_website")->row(),
				'total_pinjaman' => $this->M_data->editData(["cart_user" => $this->session->userdata("admin_id")],"tb_cart")->num_rows(),
				'total_buku_saya' => $this->M_data->buku_saya()->num_rows(),
				'total_buku_pinjam' => $this->M_data->buku_pinjam()->num_rows(),
				'u' => $this->M_data->editData(['user_id' => $this->session->userdata('admin_id')],'tb_user')->row()
			];
			$this->load->view('v_header',$data);
			$this->load->view('user/v_profile',$data);
			$this->load->view('v_footer');
		} else {
			$this->editProfile();
		}
	}

	private function editProfile()
	{
		if ($this->session->userdata("role_id") == 1) {
			redirect("block");
		} else if ($this->session->userdata("role_id") == 2) {
			redirect("block");
		} else if ($this->session->userdata("role_id") >= 4) {
			redirect("block");
		}
		$id 				= $this->session->userdata('admin_id');
		$nama 				= html_escape($this->input->post('nama',true));
		$hp   				= html_escape($this->input->post('hp',true));
		$email 				= html_escape($this->input->post('email',true));
		$foto 				= $_FILES['foto']['name'];

		if($foto != '') {
			$user = $this->M_data->editData(['user_id' => $id],'tb_user')->row();

			if($user->user_foto != 'default.jpg') {
				unlink('./vendor/img/user/'.$user->user_foto);
			}

			$config['upload_path']          = './vendor/img/user/';
			$config['allowed_types']        = 'gif|jpg|png|jpeg';
			$config['max_size']             = 50000;
			$config['max_width']            = 5000;
			$config['max_height']           = 5000;

			$this->load->library('upload');
			$this->upload->initialize($config);

			if(!$this->upload->do_upload('foto')) {
				$this->session->set_flashdata('pesan', '<script>sweet("Gagal","Foto gagal diubah!","error","Tutup")</script>');
				redirect('myprofile');
			} else {
				$foto = $this->upload->data('file_name');
			}

			if ($user->user_email == $email){
				$data = [
					'user_nama' => $this->db->escape_str($nama),
					'user_noHP' => $this->db->escape_str($hp),
					'user_email' => $this->db->escape_str($email),
					'user_foto' => $this->db->escape_str($foto),
				];
				$where = ['user_id' => $id];
				$this->M_data->updateData($data, $where, 'tb_user');
				$this->session->set_flashdata('pesan', '<script>sweet("Sukses","Data berhasil diubah!","success","Tutup")</script>');
				redirect('myprofile');
			} else if ($user->user_email != $email) {
				$data = [
					'user_nama' => $this->db->escape_str($nama),
					'user_noHP' => $this->db->escape_str($hp),
					'user_email' => $this->db->escape_str($email),
					'user_foto' => $this->db->escape_str($foto),
					'user_status' => 0,
				];

				$hariIni = date('D');
				if ($hariIni == "Sun") {
					$hariIni = 'Minggu';
				} else if ($hariIni == "Mon") {
					$hariIni = 'Senin';
				} else if ($hariIni == "Tue") {
					$hariIni = 'Selasa';
				} else if ($hariIni == "Wed") {
					$hariIni = 'Rabu';
				} else if ($hariIni == "Thu") {
					$hariIni = 'Kamis';
				} else if ($hariIni == "Fri") {
					$hariIni = 'Jumat';
				} else if ($hariIni == "Sat") {
					$hariIni = 'Sabtu';
				}
				$bulanIni = date('m');
				if ($bulanIni == "01") {
					$bulanIni = 'Januari';
				} else if ($bulanIni == "02") {
					$bulanIni = 'Februari';
				} else if ($bulanIni == "03") {
					$bulanIni = 'Maret';
				} else if ($bulanIni == "04") {
					$bulanIni = 'April';
				} else if ($bulanIni == "05") {
					$bulanIni = 'Mei';
				} else if ($bulanIni == "06") {
					$bulanIni = 'Juni';
				} else if ($bulanIni == "07") {
					$bulanIni = 'Juli';
				} else if ($bulanIni == "08") {
					$bulanIni = 'Agustus';
				} else if ($bulanIni == "09") {
					$bulanIni = 'September';
				} else if ($bulanIni == "10") {
					$bulanIni = 'Oktober';
				} else if ($bulanIni == "11") {
					$bulanIni = 'November';
				} else if ($bulanIni == "12") {
					$bulanIni = 'Desember';
				}

				$jam_now = date('H i s');
				if ($jam_now > "03 00 00" && $jam_now < "10 00 00") {
					$waktu = "Pagi";
				} elseif ($jam_now > "10 00 00" && $jam_now < "15 00 00") {
					$waktu = "Siang";
				} elseif ($jam_now > "15 00 00" && $jam_now < "18 00 00") {
					$waktu = "Sore";
				} elseif ($jam_now > "18 00 00" && $jam_now < "24 00 00") {
					$waktu = "Malam";
				} elseif ($jam_now > "00 00 00" && $jam_now < "03 00 00") {
					$waktu = "Malam";
				}
				
				$data_array = $this->M_data->get_verifikasiProccesed($id);
				foreach ($data_array as $key) {
					$config = array(
        			    //---SMTP with SSL/TLS
        				'protocol' => 'SMTP',
        				'smtp_host' => 'ssl://mail.e-web.id',
        				'smtp_port' => 465,
        				'smtp_user' => 'admin@e-web.id',
        				'smtp_pass' => 'Faqih_12195',
        				'mailtype' => 'html',
        				'charset' => 'iso-8859-1'
        			    
        			    // //---POP3 with SSL/TLS
        				// 'protocol' => 'pop3',
        				// 'smtp_host' => 'ssl://mail.e-web.id',
        				// 'smtp_port' => 995,
        				// 'smtp_user' => 'admin@e-web.id',
        				// 'smtp_pass' => 'Faqih_12195',
        				// 'mailtype' => 'html',
        				// 'charset' => 'iso-8859-1'
        				
        				// //---IMAP with SSL/TLS
        				// 'protocol' => 'imap',
        				// 'smtp_host' => 'ssl://mail.e-web.id',
        				// 'smtp_port' => 993,
        				// 'smtp_user' => 'admin@e-web.id',
        				// 'smtp_pass' => 'Faqih_12195',
        				// 'mailtype' => 'html',
        				// 'charset' => 'iso-8859-1'
        				
        				// //---IMAP with non SSL/TLS
        				// 'protocol' => 'imap',
        				// 'smtp_host' => 'mail.e-web.id',
        				// 'smtp_port' => 143,
        				// 'smtp_user' => 'admin@e-web.id',
        				// 'smtp_pass' => 'Faqih_12195',
        				// 'mailtype' => 'html',
        				// 'charset' => 'iso-8859-1'
        				
        				// //---POP3 with non SSL/TLS
        				// 'protocol' => 'POP3',
        				// 'smtp_host' => 'mail.e-web.id',
        				// 'smtp_port' => 110,
        				// 'smtp_user' => 'admin@e-web.id',
        				// 'smtp_pass' => 'Faqih_12195',
        				// 'mailtype' => 'html',
        				// 'charset' => 'iso-8859-1'
					);
					$this->load->library('email', $config);
					$this->email->set_newline("\r\n");
					$this->email->from('admin@e-web.id');
					$this->email->to($email);
					$this->email->subject('Info Verifikasi Email di Perpustakaan Pemda Karawang');
					$this->email->message('Selamat ' . $waktu . '.. ' . '<p align="justify">Diberitahukan kepada saudara/i ' . $key->user_nama . '.. Kode Verifikasi Email Anda adalah ' . $key->user_verifikasi . '</p> Terimakasih..<p align="justify">Dinas Perpustakaan dan Kearsipan Daerah Kabupaten Karawang.<br>Jalan Jendaral A.Yani nomor 10 Kelurahan Nagarasari, Kecamatan Karawang Barat, Kabupaten Karawang, Provinsi Jawa Barat 41316.</p>Silahkan kunjung website Kami : https://e-web.id/');
					$kirim = $this->email->send();

    				if ($kirim===true){
    					$where = ['user_id' => $id];
    					$this->M_data->updateData($data, $where, 'tb_user');
    					$this->session->set_flashdata('pesan', '<script>sweet("Sukses","Data berhasil diubah! Silahkan cek kode verifikasi email kembali","success","Tutup")</script>');
    					redirect('myprofile');
    				} else {
        				$this->session->set_flashdata('pesan', '<script>sweet("Gagal","Silahkan cek koneksi internet Anda","error","Tutup")</script>');
    					redirect('myprofile');
    				}
				}
			} else {
				$this->session->set_flashdata('pesan', '<script>sweet("Gagal","Silahkan cek koneksi internet Anda","error","Tutup")</script>');
				redirect('myprofile');
			}

		} else {
		    $user = $this->M_data->editData(['user_id' => $id],'tb_user')->row();
			if ($user->user_email == $email) {
				$data = [
					'user_nama' => $this->db->escape_str($nama),
					'user_noHP' => $this->db->escape_str($hp),
					'user_email' => $this->db->escape_str($email)
				];
				$where = ['user_id' => $id];
				$this->M_data->updateData($data, $where, 'tb_user');
				$this->session->set_flashdata('pesan', '<script>sweet("Sukses","Data berhasil diubah!","success","Tutup")</script>');
				redirect('myprofile');			
			} else if ($user->user_email != $email) {
				$data = [
					'user_nama' => $this->db->escape_str($nama),
					'user_noHP' => $this->db->escape_str($hp),
					'user_email' => $this->db->escape_str($email),
					'user_status' => 0,
				];

				$hariIni = date('D');
				if ($hariIni == "Sun") {
					$hariIni = 'Minggu';
				} else if ($hariIni == "Mon") {
					$hariIni = 'Senin';
				} else if ($hariIni == "Tue") {
					$hariIni = 'Selasa';
				} else if ($hariIni == "Wed") {
					$hariIni = 'Rabu';
				} else if ($hariIni == "Thu") {
					$hariIni = 'Kamis';
				} else if ($hariIni == "Fri") {
					$hariIni = 'Jumat';
				} else if ($hariIni == "Sat") {
					$hariIni = 'Sabtu';
				}
				$bulanIni = date('m');
				if ($bulanIni == "01") {
					$bulanIni = 'Januari';
				} else if ($bulanIni == "02") {
					$bulanIni = 'Februari';
				} else if ($bulanIni == "03") {
					$bulanIni = 'Maret';
				} else if ($bulanIni == "04") {
					$bulanIni = 'April';
				} else if ($bulanIni == "05") {
					$bulanIni = 'Mei';
				} else if ($bulanIni == "06") {
					$bulanIni = 'Juni';
				} else if ($bulanIni == "07") {
					$bulanIni = 'Juli';
				} else if ($bulanIni == "08") {
					$bulanIni = 'Agustus';
				} else if ($bulanIni == "09") {
					$bulanIni = 'September';
				} else if ($bulanIni == "10") {
					$bulanIni = 'Oktober';
				} else if ($bulanIni == "11") {
					$bulanIni = 'November';
				} else if ($bulanIni == "12") {
					$bulanIni = 'Desember';
				}

				$jam_now = date('H i s');
				if ($jam_now > "03 00 00" && $jam_now < "10 00 00") {
					$waktu = "Pagi";
				} elseif ($jam_now > "10 00 00" && $jam_now < "15 00 00") {
					$waktu = "Siang";
				} elseif ($jam_now > "15 00 00" && $jam_now < "18 00 00") {
					$waktu = "Sore";
				} elseif ($jam_now > "18 00 00" && $jam_now < "24 00 00") {
					$waktu = "Malam";
				} elseif ($jam_now > "00 00 00" && $jam_now < "03 00 00") {
					$waktu = "Malam";
				}
				$data_array = $this->M_data->get_verifikasiProccesed($id);
				foreach ($data_array as $key) {
					$config = array(
        			    //---SMTP with SSL/TLS
        				'protocol' => 'SMTP',
        				'smtp_host' => 'ssl://mail.e-web.id',
        				'smtp_port' => 465,
        				'smtp_user' => 'admin@e-web.id',
        				'smtp_pass' => 'Faqih_12195',
        				'mailtype' => 'html',
        				'charset' => 'iso-8859-1'
        			    
        			    // //---POP3 with SSL/TLS
        				// 'protocol' => 'pop3',
        				// 'smtp_host' => 'ssl://mail.e-web.id',
        				// 'smtp_port' => 995,
        				// 'smtp_user' => 'admin@e-web.id',
        				// 'smtp_pass' => 'Faqih_12195',
        				// 'mailtype' => 'html',
        				// 'charset' => 'iso-8859-1'
        				
        				// //---IMAP with SSL/TLS
        				// 'protocol' => 'imap',
        				// 'smtp_host' => 'ssl://mail.e-web.id',
        				// 'smtp_port' => 993,
        				// 'smtp_user' => 'admin@e-web.id',
        				// 'smtp_pass' => 'Faqih_12195',
        				// 'mailtype' => 'html',
        				// 'charset' => 'iso-8859-1'
        				
        				// //---IMAP with non SSL/TLS
        				// 'protocol' => 'imap',
        				// 'smtp_host' => 'mail.e-web.id',
        				// 'smtp_port' => 143,
        				// 'smtp_user' => 'admin@e-web.id',
        				// 'smtp_pass' => 'Faqih_12195',
        				// 'mailtype' => 'html',
        				// 'charset' => 'iso-8859-1'
        				
        				// //---POP3 with non SSL/TLS
        				// 'protocol' => 'POP3',
        				// 'smtp_host' => 'mail.e-web.id',
        				// 'smtp_port' => 110,
        				// 'smtp_user' => 'admin@e-web.id',
        				// 'smtp_pass' => 'Faqih_12195',
        				// 'mailtype' => 'html',
        				// 'charset' => 'iso-8859-1'
					);
					$this->load->library('email', $config);
					$this->email->set_newline("\r\n");
					$this->email->from('admin@e-web.id');
					$this->email->to($email);
					$this->email->subject('Info Verifikasi Email di Perpustakaan Pemda Karawang');
					$this->email->message('Selamat ' . $waktu . '.. ' . '<p align="justify">Diberitahukan kepada saudara/i ' . $key->user_nama . '.. Kode Verifikasi Email Anda adalah ' . $key->user_verifikasi . '</p> Terimakasih..<p align="justify">Dinas Perpustakaan dan Kearsipan Daerah Kabupaten Karawang.<br>Jalan Jendaral A.Yani nomor 10 Kelurahan Nagarasari, Kecamatan Karawang Barat, Kabupaten Karawang, Provinsi Jawa Barat 41316.</p>Silahkan kunjung website Kami : https://e-web.id/');
					$kirim = $this->email->send();
					
    				if ($kirim===true) {
    					$where = ['user_id' => $id];
    					$this->M_data->updateData($data, $where, 'tb_user');
    					$this->session->set_flashdata('pesan', '<script>sweet("Sukses","Data berhasil diubah! Silahkan cek kode verifikasi email kembali","success","Tutup")</script>');
    					redirect('myprofile');
    				} else {
    					$this->session->set_flashdata('pesan', '<script>sweet("Gagal","Silahkan cek koneksi internet Anda","error","Tutup")</script>');
    					redirect('myprofile');
    				}
				}
			} else {
				$this->session->set_flashdata('pesan', '<script>sweet("Gagal","Silahkan cek koneksi internet Anda","error","Tutup")</script>');
				redirect('myprofile');
			}

		}
	}

	public function profilePassword()
	{
		if ($this->session->userdata("role_id") == 1) {
			redirect("block");
		} else if ($this->session->userdata("role_id") == 2) {
			redirect("block");
		} else if ($this->session->userdata("role_id") >= 4) {
			redirect("block");
		}
		$id = $this->session->userdata('admin_id');
		$this->form_validation->set_rules('passLama', 'Password Lama', 'required',[
			'required' => 'Wajib masukan password lama!'
		]);
		$this->form_validation->set_rules('passBaru', 'Password Baru', 'required|matches[retypeBaru]',[
			'required' => 'Wajib masukan password Baru!',
			'matches' => 'Password tidak sesuai!'
		]);
		$this->form_validation->set_rules('retypeBaru', 'Password Baru', 'required|matches[passBaru]',[
			'required' => 'Tulis ulang password baru!',
			'matches' => 'Password tidak sesuai'
		]);

		
		if ($this->form_validation->run() == FALSE) {
			$data = [
				'title' => 'GANTI PASSWORD',
			    'user' => $this->M_data->editData(['user_id' => $this->session->userdata('admin_id')], 'tb_user')->row(),
				'website' => $this->M_data->getData("tb_website")->row(),
				'total_pinjaman' => $this->M_data->editData(["cart_user" => $this->session->userdata("admin_id")],"tb_cart")->num_rows(),
				'total_buku_saya' => $this->M_data->buku_saya()->num_rows(),
				'total_buku_pinjam' => $this->M_data->buku_pinjam()->num_rows(),
			];
			$this->load->view('v_header',$data);
			$this->load->view('user/v_profilePassword',$data);
			$this->load->view('v_footer');
		} else {
			$passLama = html_escape($this->input->post('passLama'));
			$cek = $this->M_data->editData(['user_id' => $id],'tb_user')->row();

			if(password_verify($passLama,$cek->user_password)) {
				$this->gantiPassAct();
			} else {				
				$this->session->set_flashdata('pesan', '<script>sweet("Gagal","Password lama anda tidak sesuai!","error","Tutup")</script>');
				redirect('profilePassword');
			}
		}
	}

	private function gantiPassAct()
	{
		if ($this->session->userdata("role_id") == 1) {
			redirect("block");
		} else if ($this->session->userdata("role_id") == 2) {
			redirect("block");
		} else if ($this->session->userdata("role_id") >= 4) {
			redirect("block");
		}
		$passBaru = html_escape($this->input->post('passBaru'));
		$data = ['user_password' => password_hash($passBaru,PASSWORD_DEFAULT)];
		$where = ['user_id' => $this->session->userdata('admin_id')];

		$this->M_data->updateData($data,$where,'tb_user');
		$this->session->set_flashdata('pesan', '<script>sweet("Sukses","Password Anda telah diubah!","success","Tutup")</script>');
		redirect('profilePassword');
	}

	public function search_buku()
	{
		if ($this->session->userdata("role_id") == 1) {
			redirect("block");
		} else if ($this->session->userdata("role_id") == 2) {
			redirect("block");
		} else if ($this->session->userdata("role_id") >= 4) {
			redirect("block");
		}
		$keyword = html_escape($this->input->get("buku"));
		$check = $this->M_data->search_buku($keyword, 30);
		if ($check->success === TRUE) {
			if ($this->session->userdata("status") === TRUE) {
				$data = [
					'title' => 'PENCARIAN BUKU',
				    'user' => $this->M_data->editData(['user_id' => $this->session->userdata('admin_id')], 'tb_user')->row(),
					'list_cari' => $check->data,
					'website' => $this->M_data->getData("tb_website")->row(),
					'total_pinjaman' => $this->M_data->editData(["cart_user" => $this->session->userdata("admin_id")],"tb_cart")->num_rows(),
					'total_buku_saya' => $this->M_data->buku_saya()->num_rows(),
					'total_buku_pinjam' => $this->M_data->buku_pinjam()->num_rows(),
				];
			} else {
				$data = [
					'title' => 'PENCARIAN BUKU',
				    'user' => $this->M_data->editData(['user_id' => $this->session->userdata('admin_id')], 'tb_user')->row(),
					'list_cari' => $check->data,
					'website' => $this->M_data->getData("tb_website")->row(),
					'total_pinjaman' => $this->M_data->editData(["cart_user" => $this->session->userdata("admin_id")],"tb_cart")->num_rows(),
					'total_buku_saya' => $this->M_data->buku_saya()->num_rows(),
					'total_buku_pinjam' => $this->M_data->buku_pinjam()->num_rows(),
				];
			}
			$this->load->view('v_header',$data);
			$this->load->view('user/v_searchBuku',$data);
			$this->load->view('v_footer');
		} else {
			$this->session->set_flashdata('pesan', '<script>sweet("Gagal", "Buku yang kamu cari tidak ada :(", "error", "Tutup")</script>');
			redirect("index");
		}
	}

	public function saran()
	{
		if ($this->session->userdata("role_id") == 1) {
			redirect("block");
		} else if ($this->session->userdata("role_id") == 2) {
			redirect("block");
		} else if ($this->session->userdata("role_id") >= 4) {
			redirect("block");
		}
		$this->form_validation->set_rules('nama_depan', 'Saran', 'required');
		$this->form_validation->set_rules('nama_belakang', 'Saran', 'required');
		$this->form_validation->set_rules('email', 'Saran', 'required|valid_email');
		$this->form_validation->set_rules('subjek', 'Saran', 'required');
		$this->form_validation->set_rules('pesan', 'Saran', 'required');
		
		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('pesan', '<script>sweet("Gagal", "Masukan data dengan benar & lengkap!", "error", "Tutup")</script>');
			redirect("index");
		} else {
			$input = (object)$this->input->post();
			$this->load->library("email");
			$message = "<h4>"."Dari : $input->email"."</h4><br>";
			$message .= "Subjek: $input->subjek"."<br>";
			$message .= "<p>"."Pesan : $input->pesan"."</p>";

			$this->email->from($input->email);
			$this->email->to("eperpusipkrw@gmail.com");
			$this->email->subject("Saran dari website perpusda karawang");
			$this->email->message($message);
			$this->email->send();

			$nama_lengkap = $input->nama_depan." ";
			$nama_lengkap .= $input->nama_belakang;
			$data = [
				"nama" => $nama_lengkap,
				"email" => $input->email,
				"subjek" => $input->subjek,
				"pesan" => $input->pesan,
				"waktu" => date("Y-m-d H:i:s")
			];
			$query = $this->M_data->insertData($data, "tb_masukan");
			if ($query) {
				$this->session->set_flashdata('pesan', '<script>sweet("Sukses", "Terima kasih, pesan anda sudah terkirim!", "success", "Tutup")</script>');
				redirect("index");
			} else {
				$this->session->set_flashdata('pesan', '<script>sweet("Gagal", "Maaf, pesan kamu gagal terkirim, coba lagi", "error", "Tutup")</script>');
				redirect("index");
			}
		}
	}
	
	public function cardAnggota($id)
	{
		$data = [
			'title' => 'Kartu Digital',
			'user' => $this->M_data->editData(['user_id' => $this->session->userdata('id')], 'tb_user')->row(),
			'menu' => $this->M_data->get_access_menu()->result_array(),
			'user' => $this->M_data->editData(['user_id' => (int)$id], 'tb_user')->row(),
		];
		$this->load->view('user/v_cardProfile', $data);
	}

	public function buku_pinjam()
	{
		$start = $this->input->post('start_order_date');
		$end = $this->input->post('end_order_date');
		$data = [
			'title' => 'Peminjaman Buku',
			'menu' => $this->M_data->get_access_menu()->result_array(),
			'user' => $this->M_data->editData(['user_id' => $this->session->userdata('admin_id')], 'tb_user')->row(),
			'list_peminjaman' => $this->M_data->get_peminjaman_user($start, $end)->result(),
			'list_denda' => $this->M_data->getData("tb_denda")->row(),
			'list_buku' => $this->M_data->editData(["buku_stok >" => 1], "tb_buku")->result(),
			'list_katalog' => $this->M_data->getData("tb_buku")->result(),
			'denda' => $this->M_data->editData(["denda_id" => 1], "tb_denda")->row(),
			'list_user' => $this->M_data->getData("tb_user")->result(),
			'total_pinjaman' => $this->M_data->editData(["cart_user" => $this->session->userdata("admin_id")], "tb_cart")->num_rows(),
			'total_buku_saya' => $this->M_data->buku_saya()->num_rows(),
			'total_buku_pinjam' => $this->M_data->buku_pinjam()->num_rows(),
		];
		$this->load->view("v_header", $data);
		$this->load->view('user/v_dataPeminjaman', $data);
		$this->load->view("v_footer");
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
