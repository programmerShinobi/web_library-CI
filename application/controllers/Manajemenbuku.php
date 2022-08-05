<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');
require('./application/third_party/phpoffice/vendor/autoload.php');

date_default_timezone_set('Asia/Jakarta');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Manajemenbuku extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
    protek_login();
    genBooking();
    if ($this->session->userdata("role_id") == 3 ) {
      redirect("block");
    }
  }

  public function view_peminjaman()
  {
		$start = $this->input->post('start_order_date');
		$end = $this->input->post('end_order_date');
    $data = [
      'title' => 'Data Peminjaman Buku',
      'menu' => $this->M_data->get_access_menu()->result_array(),
      'user' => $this->M_data->editData(['user_id' => $this->session->userdata('admin_id')],'tb_user')->row(),
      'list_peminjaman' => $this->M_data->get_peminjaman($start, $end)->result(),
      'list_denda' => $this->M_data->getData("tb_denda")->row(),
      'list_buku' => $this->M_data->editData(["buku_stok >" => 1], "tb_buku")->result(),
      'list_katalog' => $this->M_data->getData("tb_buku")->result(),
			'denda' => $this->M_data->editData(["denda_id" => 1], "tb_denda")->row(),
      'list_user' => $this->M_data->getData("tb_user")->result()
    ];
    $this->load->view('template/v_head', $data);
    $this->load->view('admin/v_dataPeminjaman', $data);
    $this->load->view('template/v_footer');
  }

  public function validation_peminjaman_add()
  {
    $this->form_validation->set_rules('peminjaman_user', 'User', 'required');
    $this->form_validation->set_rules('peminjaman_buku', 'Buku', 'required');
    $this->form_validation->set_rules('peminjaman_jumlah', 'Jumlah Peminjaman', 'required');
    $this->form_validation->set_rules('peminjaman_dari', 'Tanggal Peminjaman', 'required');
    $this->form_validation->set_rules('peminjaman_sampai', 'Tanggal Kembali', 'required');

    if ($this->form_validation->run() == FALSE) {
      $this->session->set_flashdata('pesan', '<script>sweet("Gagal","Isi data dengan benar & lengkap!","error","Tutup")</script>');
      redirect('peminjamanBuku');
    } else {
      $this->process_peminjaman_add();
    }
  }

  private function process_peminjaman_add()
  {

    //Ambil inputan
    $input = (object)html_escape($this->db->escape_str($this->input->post()));

    //Ambil data buku & pengurangan jumlah stok
    $cek = $this->M_data->editData(['buku_id' => $input->peminjaman_buku], 'tb_buku')->row();
    $kurang = $cek->buku_stok - $input->peminjaman_jumlah;
    $actual = $cek->buku_stok;
    $dest   = $input->peminjaman_jumlah;

    if ($actual > $dest) {
      $data = ['buku_stok' => $kurang];
      $where = ['buku_id' => $input->peminjaman_buku];
      $this->M_data->updateData($data, $where, 'tb_buku');
  
      $data = [
        'peminjaman_user' => $input->peminjaman_user,
        'peminjaman_buku' => $input->peminjaman_buku,
        'peminjaman_jumlah' => $input->peminjaman_jumlah,
        'peminjaman_dari' => $input->peminjaman_dari,
        'peminjaman_sampai' => $input->peminjaman_sampai,
        'peminjaman_denda' => 0,
        'peminjaman_status' => 1,
        'peminjaman_noId' => rand(1, 1000000)
      ];
  
      $check = $this->M_data->insertData($data, 'tb_peminjaman');
      if ($check) {
        $this->session->set_flashdata('pesan', '<script>sweet("Sukses","Data peminjaman sukses ditambahkan!","success","Tutup")</script>');
        redirect('peminjamanBuku');
      } else {
        $this->session->set_flashdata('pesan', '<script>sweet("Gagal","Query failed!","error","Tutup")</script>');
        redirect('peminjamanBuku');
      }
    } elseif ($actual <= $dest) {
      if ($actual == 0) {
        $this->session->set_flashdata('pesan', '<script>sweet("Stok Kosong","Data peminjaman gagal ditambahkan!","error","Tutup")</script>');
        redirect('peminjamanBuku');
      } else {
        $data = ['buku_stok' => 0];
        $where = ['buku_id' => $input->peminjaman_buku];
        $this->M_data->updateData($data, $where, 'tb_buku');
    
        $data = [
          'peminjaman_user' => $input->peminjaman_user,
          'peminjaman_buku' => $input->peminjaman_buku,
          'peminjaman_jumlah' => $actual,
          'peminjaman_dari' => $input->peminjaman_dari,
          'peminjaman_sampai' => $input->peminjaman_sampai,
          'peminjaman_denda' => 0,
          'peminjaman_status' => 1,
          'peminjaman_noId' => rand(1, 1000000)
        ];
    
        $check = $this->M_data->insertData($data, 'tb_peminjaman');
        if ($check) {
          $this->session->set_flashdata('pesan', '<script>sweet("Sukses","Data peminjaman sukses ditambahkan!","success","Tutup")</script>');
          redirect('peminjamanBuku');
        } else {
          $this->session->set_flashdata('pesan', '<script>sweet("Gagal","Data peminjaman gagal ditambahkan!","error","Tutup")</script>');
          redirect('peminjamanBuku');
        }
      }
    }

  }

  public function peminjaman_dikembalikan($id)
  {
    $peminjaman_id = (int)$this->db->escape_str($id);
    $check = $this->M_data->get_peminjaman_detail($peminjaman_id);
    if ($check) {
      $data = [
        'title' => 'Data Peminjaman Buku',
        'menu' => $this->M_data->get_access_menu()->result_array(),
        'user' => $this->M_data->editData(['user_id' => $this->session->userdata('admin_id')],'tb_user')->row(),
        'peminjaman' => $check->row(),
        'list_denda' => $this->M_data->getData("tb_denda")->row(),
        'list_buku' => $this->M_data->getData("tb_buku")->result(),
        'list_user' => $this->M_data->getData("tb_user")->result()
      ];
      $this->load->view('template/v_head', $data);
      $this->load->view('admin/v_peminjamanKembali', $data);
      $this->load->view('template/v_footer');
    }
  }

  public function validation_peminjaman_kembali()
  {
    $id       = html_escape($this->input->post('peminjaman_id', true));
    $this->form_validation->set_rules('peminjaman_kembali', 'Dikembalikan', 'required');

    // $cek = $this->form_validation->run();
    // var_dump($cek);

    if ($this->form_validation->run() == FALSE) {
      $this->session->set_flashdata('pesan', '<script>sweet("Gagal","Data peminjaman gagal diubah! Isi dengan lengkap!","error","Tutup")</script>');
      redirect('peminjaman_dikembalikan/' . $id);
    } else {
      $this->process_peminjaman_kembali();
    }
  }

  private function process_peminjaman_kembali()
  {
    $input = (object)html_escape($this->db->escape_str($this->input->post()));
    $denda = $this->M_data->getData('tb_denda')->row();
    $buku = $this->M_data->editData(['buku_id' => $input->peminjaman_buku], 'tb_buku')->row();

    $sampai     = strtotime($input->peminjaman_sampai);
    $kembali    = strtotime($input->peminjaman_kembali);

  
    $tgl_dest = abs(($sampai) / (60 * 60 * 24));
    $tgl_act  = abs(($kembali) / (60 * 60 * 24));

    if ($tgl_act > $tgl_dest){
      $selisih    = abs(($sampai - $kembali) / (60 * 60 * 24));
      $denda      = $selisih * $denda->denda_harga;  
    }
    elseif ($tgl_act <= $tgl_dest){
      $denda      = 0;  
    }


    $data = ['buku_stok' => $buku->buku_stok + $input->peminjaman_jumlah];
    $where = ['buku_id' => $buku->buku_id];
    $this->M_data->updateData($data, $where, 'tb_buku');

    $data = [
      'peminjaman_status' => 2,
      'peminjaman_denda_status' => 1,
      'peminjaman_denda' => $denda,
      'peminjaman_kembali' => $input->peminjaman_kembali
    ];
    $where = ['peminjaman_id' => $input->peminjaman_id];

    $check = $this->M_data->updateData($data, $where, 'tb_peminjaman');
    if ($check) {
      $this->session->set_flashdata('pesan', '<script>sweet("Sukses","Data peminjaman sukses diubah!","success","Tutup")</script>');
      redirect('peminjamanBuku');
    } else {
      $this->session->set_flashdata('pesan', '<script>sweet("Gagal","Query failed!","error","Tutup")</script>');
      redirect('peminjamanBuku');
    }
  }

  public function peminjaman_batal($id)
  {
    $peminjaman_id = (int)$this->db->escape_str($id);
    $cek = $this->M_data->editData(['peminjaman_id' => $peminjaman_id], 'tb_peminjaman')->row();
    $buku = $this->M_data->editData(['buku_id' => $cek->peminjaman_buku], 'tb_buku')->row();

    $data = ['buku_stok' => $buku->buku_stok + $cek->peminjaman_jumlah];
    $where = ['buku_id' => $cek->peminjaman_buku];
    $this->M_data->updateData($data, $where, 'tb_buku');

    $data = ['peminjaman_status' => 3, 'peminjaman_denda_status' => 0];
    $where = ['peminjaman_id' => $peminjaman_id];
    $this->M_data->updateData($data, $where, 'tb_peminjaman');

    $this->session->set_flashdata('pesan', '<script>sweet("Batalkan!","Peminjaman buku telah dibatalkan!","warning","Tutup")</script>');
    redirect('peminjamanBuku');
  }

  public function peminjaman_hapus($id)
  {
    $peminjaman_id = (int)$this->db->escape_str($id);
    $check = $this->M_data->deleteData(['peminjaman_id' => $peminjaman_id], 'tb_peminjaman');

    if ($check) {
      $this->session->set_flashdata('pesan', '<script>sweet("Sukses","Peminjaman buku telah dihapus!","success","Tutup")</script>');
      redirect('peminjamanBuku');
    } else {
      $this->session->set_flashdata('pesan', '<script>sweet("Gagal","Query failed!","error","Tutup")</script>');
      redirect('peminjamanBuku');
    }
  }

  public function denda_edit()
  {
    $data = [
      'title' => 'Data Denda',
      'user' => $this->M_data->editData(['user_id' => $this->session->userdata('admin_id')], 'tb_user')->row(),
      'menu' => $this->M_data->get_access_menu()->result_array(),
      'denda' => $this->M_data->getData('tb_denda')->row()
    ];
    $this->load->view('template/v_head', $data);
    $this->load->view('admin/v_editDenda', $data);
    $this->load->view('template/v_footer');
  }

  public function validation_denda_edit()
  {
    $this->form_validation->set_rules('denda', 'Harga Denda', 'required|numeric');
    
    if ($this->form_validation->run() == FALSE) {
      $this->session->set_flashdata('pesan', '<script>sweet("Gagal","Isi data dengan benar & lengkap!","error","Tutup")</script>');
      redirect('peminjamanBuku');
    } else {
      $this->process_denda_edit();
    }    
  }

public function peminjaman_didenda($id)
	{
		$peminjaman_id = (int)$this->db->escape_str($id);
		$check = $this->M_data->get_peminjaman_detail($peminjaman_id);
		if ($check) {
			$data = [
				'title' => 'Data Denda Peminjaman Buku',
				'menu' => $this->M_data->get_access_menu()->result_array(),
				'user' => $this->M_data->editData(['user_id' => $this->session->userdata('admin_id')], 'tb_user')->row(),
				'peminjaman' => $check->row(),
				'list_denda' => $this->M_data->getData("tb_denda")->row(),
				'list_buku' => $this->M_data->getData("tb_buku")->result(),
				'list_user' => $this->M_data->getData("tb_user")->result(),
			];
			$this->load->view('template/v_head', $data);
			$this->load->view('admin/v_peminjamanDenda', $data);
			$this->load->view('template/v_footer');
		}
	}

	public function validation_peminjaman_denda()
	{
		$id = html_escape($this->input->post('peminjaman_id', true));
		$this->form_validation->set_rules('peminjaman_denda', 'didenda', 'required');

		// $cek = $this->form_validation->run();
		// var_dump($cek);

		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('pesan', '<script>sweet("Gagal","Data denda anggota gagal diubahi! Isi dengan lengkap!","error","Tutup")</script>');
			redirect('peminjaman_didenda/' . $id);
		} else {
			$this->process_peminjaman_denda($id);
		}
	}

	private function process_peminjaman_denda($id)
	{
		$input = (object)html_escape($this->db->escape_str($this->input->post()));
		$denda_now = $this->M_data->get_peminjaman_detail($id)->row('peminjaman_denda');
		$denda_now_bayar = $this->M_data->get_peminjaman_detail($id)->row('peminjaman_denda_bayar');
		$bayar_denda_new = $input->peminjaman_denda_bayar;

		if ($denda_now_bayar < $denda_now)
		{
			$denda_update = $bayar_denda_new + $denda_now_bayar;
		} elseif ($denda_now_bayar > $denda_now)
		{
			$denda_update = $denda_now_bayar - $bayar_denda_new ;
		}

		if ($denda_update < $denda_now){
			$status_denda = 2;
		} elseif ($denda_update == $denda_now) {
			$status_denda = 3;
		} elseif ($denda_update > $denda_now) {
			$status_denda = 4;
		}

		$data = [
			'peminjaman_denda_status' => $status_denda,
			'peminjaman_denda_bayar' => $denda_update,
		];
		$where = ['peminjaman_id' => $input->peminjaman_id];

		$check = $this->M_data->updateData($data, $where, 'tb_peminjaman');
		if ($check) {
			$this->session->set_flashdata('pesan', '<script>sweet("Sukses","Data denda anggota sukses diubah!","success","Tutup")</script>');
			redirect('peminjamanBuku');
		} else {
			$this->session->set_flashdata('pesan', '<script>sweet("Gagal","Query failed!","error","Tutup")</script>');
			redirect('peminjaman_didenda/' . $id);
		}
	}
	
  private function process_denda_edit()
  {
    $input = html_escape($this->db->escape_str($this->input->post('denda', true)));
    $list_peminjaman = $this->M_data->getData("tb_peminjaman")->result();


    // foreach($list_peminjaman as $item) {
    //   $sampai     = strtotime($item->peminjaman_sampai);
    //   $kembali    = strtotime($item->peminjaman_kembali);

    //   $selisih    = abs(($sampai - $kembali) / (60 * 60 * 24));
    //   $denda      = $selisih * $input;

    //   $sql = "SET `peminjaman_denda` = $denda";
    //   $sql2 = "UPDATE `tb_peminjaman` ".$sql." WHERE `peminjaman_id` = $item->peminjaman_id";
    //   $this->db->query($sql2);
    // }

    $data = ['denda_harga' => $input];
    $where = ['denda_id' => 1];
    $check = $this->M_data->updateData($data, $where, 'tb_denda');
    if ($check) {
      $this->session->set_flashdata('pesan', '<script>sweet("Sukses","Data denda sukses diubah!","success","Tutup")</script>');
      redirect('peminjamanBuku');
    } else {
      $this->session->set_flashdata('pesan', '<script>sweet("Gagal","Query failed!","error","Tutup")</script>');
      redirect('peminjamanBuku');
    }
  }

  public function export_peminjaman()
  {
    $semua_pengguna = $this->M_data->get_peminjaman()->result();

    $spreadsheet = new Spreadsheet;

    $spreadsheet->setActiveSheetIndex(0)
      ->setCellValue('A1', 'No')
      ->setCellValue('B1', 'Nomor Peminjaman')
      ->setCellValue('C1', 'User')
      ->setCellValue('D1', 'User ID')
      ->setCellValue('E1', 'Buku')
      ->setCellValue('F1', 'Buku Id')
      ->setCellValue('G1', 'Jumlah')
      ->setCellValue('H1', 'Tanggal Peminjaman')
      ->setCellValue('I1', 'Tanggal Pengembalian')
      ->setCellValue('J1', 'Tanggal Dikembalikan')
      ->setCellValue('K1', 'Denda')
			->setCellValue('L1', 'Denda Telah Dibayar')
			->setCellValue('M1', 'Status (Denda)')
      ->setCellValue('N1', 'Status (Peminjaman)');

    $kolom = 2;
    $nomor = 1;
    foreach ($semua_pengguna as $pengguna) {

			if ($pengguna->peminjaman_denda_bayar == null) {
				$denda_bayar = '-';
			} else {
				$denda_bayar = $pengguna->peminjaman_denda_bayar;
			}

			if ($pengguna->peminjaman_denda_status == 1) {
				$denda_status = 'Belum Lunas';
			} elseif ($pengguna->peminjaman_denda_status == 2) {
				$denda_status = 'Masih Kurang';
			} elseif ($pengguna->peminjaman_denda_status == 3) {
				$denda_status = 'Sudah Lunas';
			} elseif ($pengguna->peminjaman_denda_status == 4) {
				$denda_status = 'Lebih Bayar';
			} else {
				$denda_status = '';
			}

      if ($pengguna->peminjaman_status == 1) {
        $status = 'Masih dipinjam';
      } elseif ($pengguna->peminjaman_status == 2) {
        $status = 'Dikembalikan';
      } else {
        $status = 'Dibatalkan';
      }

      if ($pengguna->peminjaman_kembali == '0000-00-00') {
        $tgl = '0000-00-00';
      } else {
        $tgl = date('Y-m-d', strtotime($pengguna->peminjaman_kembali));
      }
      $spreadsheet->setActiveSheetIndex(0)
        ->setCellValue('A' . $kolom, $nomor)
        ->setCellValue('B' . $kolom, $pengguna->peminjaman_noId)
        ->setCellValue('C' . $kolom, $pengguna->user_nama)
        ->setCellValue('D' . $kolom, $pengguna->peminjaman_user)
        ->setCellValue('E' . $kolom, $pengguna->buku_judul)
        ->setCellValue('F' . $kolom, $pengguna->peminjaman_buku)
        ->setCellValue('G' . $kolom, $pengguna->peminjaman_jumlah)
        ->setCellValue('H' . $kolom, date('d M Y', strtotime($pengguna->peminjaman_dari)))
        ->setCellValue('I' . $kolom, date('d M Y', strtotime($pengguna->peminjaman_sampai)))
        ->setCellValue('J' . $kolom, $tgl)
        ->setCellValue('K' . $kolom, $pengguna->peminjaman_denda)
				->setCellValue('L' . $kolom, $denda_bayar)
				->setCellValue('M' . $kolom, $denda_status)
				->setCellValue('N' . $kolom, $status);

      $kolom++;
      $nomor++;
    }

    $writer = new Xlsx($spreadsheet);

    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename="Data_peminjaman.xlsx"');
    header('Cache-Control: max-age=0');

    $writer->save('php://output');
  }

  public function import_peminjaman()
  {
    include APPPATH . 'third_party/PHPExcel/PHPExcel.php';

    $config['upload_path'] = realpath('./vendor/file/');
    $config['allowed_types'] = 'xlsx|xls|csv';
    $config['max_size'] = '10000';
    $config['encrypt_name'] = true;

    $this->load->library('upload');
    $this->upload->initialize($config);

    if (!$this->upload->do_upload('files')) {
      $this->session->set_flashdata('pesan', '<script>sweet("Gagal","File excel gagal diunggah!","error","Tutup")</script>');
      redirect('peminjamanBuku');
    } else {

      $data_upload = $this->upload->data();

      $excelreader     = new PHPExcel_Reader_Excel2007();
      $loadexcel         = $excelreader->load('./vendor/file/' . $data_upload['file_name']); // Load file yang telah diunggah ke folder excel
      $sheet             = $loadexcel->getActiveSheet()->toArray(null, true, true, true);

      $data = array();

      $numrow = 1;
      foreach ($sheet as $row) {
        if ($numrow > 1) {

					if ($row['L'] == '-') {
						$pesan_denda_bayar = null;
					} elseif ($row['L'] != '-') {
						$pesan_denda_bayar = number_format($row['L']);
					}

          if ($row['M'] == 'Belum Lunas') {
            $pesan_denda = 1;
          } elseif ($row['M'] == 'Masih Kurang') {
						$pesan_denda = 2;
          } elseif ($row['M'] == 'Sudah Lunas') {
						$pesan_denda = 3;
          } elseif ($row['M'] == 'Lebih Bayar') {
						$pesan_denda = 4;
					} else {
						$pesan_denda = null;
					}

					if ($row['N'] == 'Masih dipinjam') {
						$pesan = 1;
					} elseif ($row['N'] == 'Dikembalikan') {
						$pesan = 2;
					} else {
						$pesan = 3;
					}
          array_push($data, array(
            'peminjaman_noId' => $row['B'],
            'peminjaman_user' => $row['D'],
            'peminjaman_buku' => $row['F'],
            'peminjaman_jumlah' => $row['G'],
            'peminjaman_dari' => date('Y-m-d', strtotime($row['H'])),
            'peminjaman_sampai' => date('Y-m-d', strtotime($row['I'])),
            'peminjaman_kembali' => date('Y-m-d', strtotime($row['J'])),
            'peminjaman_denda' => $row['K'],
						'peminjaman_denda_status' =>  $pesan_denda_bayar,
            'peminjaman_denda_status' =>  $pesan_denda,
						'peminjaman_status' =>  $pesan
          ));

        }
        $numrow++;
      }
      $this->db->insert_batch('tb_peminjaman', $data);
      //delete file from server
      unlink(realpath('./vendor/file/' . $data_upload['file_name']));

      //upload success
      $this->session->set_flashdata('pesan', '<script>sweet("Sukses","File berhasil diunggah!","success","Tutup")</script>');
      //redirect halaman
      redirect('peminjamanBuku');
    }
  }

  public function view_booking()
  {
    $data = [
      'title' => 'Data Booking',
      'user' => $this->M_data->editData(['user_id' => $this->session->userdata('admin_id')], 'tb_user')->row(),
      'menu' => $this->M_data->get_access_menu()->result_array(),
      'booking' => $this->M_data->get_booking()->result()
    ];
    $this->load->view('template/v_head', $data);
    $this->load->view('admin/v_dataBooking', $data);
    $this->load->view('template/v_footer');
  }

  public function process_booking_tolak($id)
  {
    $booking_id = (int)$this->db->escape_str($id);

    $booking = $this->M_data->editData(['booking_id' => $booking_id], 'tb_booking')->row();
    $buku = $this->M_data->editData(['buku_id' => $booking->booking_buku], 'tb_buku')->row();


    // $data = [
    //   'buku_stok' => $buku->buku_stok + $booking->booking_jumlah
    // ];
    // $where = ['buku_id' => $booking->booking_buku];
    // $this->M_data->updateData($data, $where, 'tb_buku');

    $data = [
      'booking_accept' => 2
    ];
    $where = ['booking_id' => $booking_id];
    $this->M_data->updateData($data, $where, 'tb_booking');

    $this->session->set_flashdata('pesan', '<script>sweet("Sukses","Data berhasil ditolak!","warning","Tutup")</script>');
    redirect('dataBooking');
  }

  public function process_booking_terima($id)
  {
    $booking_id = (int)$this->db->escape_str($id);
    $booking = $this->M_data->editData(['booking_id' => $booking_id], 'tb_booking')->row();

    $total_buku_booking = $booking->booking_jumlah;
    
    //Ambil data buku & pengurangan jumlah stok yang akan di-booking
    $cek_buku = $this->M_data->editData(['buku_id' =>$booking->booking_buku], 'tb_buku')->row();
    $kurang = $cek_buku->buku_stok - $booking->booking_jumlah;
    $actual = $cek_buku->buku_stok;
    $dest   = $booking->booking_jumlah;
    // $data = ['buku_stok' => $kurang];
    // $where = ['buku_id' => $input->peminjaman_buku];
    // $this->M_data->updateData($data, $where, 'tb_buku');
    if ($actual > $dest) {
      $data = [
        'peminjaman_user' => $booking->booking_user,
        'peminjaman_buku' => $booking->booking_buku,
        'peminjaman_jumlah' => $booking->booking_jumlah,
        'peminjaman_dari' => $booking->booking_waktu,
        'peminjaman_sampai' => $booking->booking_pengembalian,
        'peminjaman_denda' => 0,
        'peminjaman_status' => 1,
        'peminjaman_noId' => $booking->booking_noId
      ];
  
      $this->M_data->insertData($data, 'tb_peminjaman');
  
      $data = [
        'booking_accept' => 1
      ];
      $where = ['booking_id' => $booking_id];
      $this->M_data->updateData($data, $where, 'tb_booking');

      // Stok buku berkurang --------------------------------------------------------------
      $buku = $this->M_data->editData(['buku_id' => $booking->booking_buku], 'tb_buku')->row();
      $data_buku = [
        'buku_stok' => $buku->buku_stok - $booking->booking_jumlah
      ];
      $where = ['buku_id' => $booking->booking_buku];
      $this->M_data->updateData($data_buku, $where, 'tb_buku');
      // ----------------------------------------------------------------------------------

		$idBooking = $booking->booking_id;
		$data_array = $this->M_data->get_bookingAccepted($idBooking);
		foreach ($data_array as $key) {
		    
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
    		
    		$bulanIni = date('m', strtotime($key->booking_pengembalian));
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
				$this->email->subject('Info Peminjaman Buku di Perpustakaan Pemda Karawang');
				$this->email->message('Selamat '.$waktu.'.. '.'<p align="justify"> Diberitahukan kepada saudara/i '.$key->user_nama.'.. Proses booking buku Anda terima. Kami harapkan Anda mengembalikan buku ke perpustakaan tidak lewat dari tanggal '.date("j", strtotime($key->booking_pengembalian))." ".$bulanIni." ".date ("Y", strtotime($key->booking_pengembalian)).', jika melawati dari tanggal tersebut, maka akan dikenakan denda sebesar Rp. 5000 perhari. Denda tersebut akan dilipat gandakan perharinya, terhitung dari tanggal batas waktu pengembalian buku.</p> Terimakasih..<p align="justify">Dinas Perpustakaan dan Kearsipan Daerah Kabupaten Karawang.<br>Jalan Jendaral A.Yani nomor 10 Kelurahan Nagarasari, Kecamatan Karawang Barat, Kabupaten Karawang, Provinsi Jawa Barat 41316.</p>Silahkan kunjung website Kami : https://e-web.id/');
				$this->email->send();
				
		}
		
      $this->session->set_flashdata('pesan', '<script>sweet("Sukses","Data berhasil ditambahkan!","success","Tutup")</script>');
      redirect('dataBooking');
    } elseif ($actual <= $dest) {
      if ($actual == 0) {
        $this->session->set_flashdata('pesan', '<script>sweet("Stok Kosong","Data gagal ditambahkan!","error","Tutup")</script>');
        redirect('dataBooking');
      } else {
        $data = [
          'peminjaman_user' => $booking->booking_user,
          'peminjaman_buku' => $booking->booking_buku,
          'peminjaman_jumlah' => $actual,
          'peminjaman_dari' => $booking->booking_waktu,
          'peminjaman_sampai' => $booking->booking_pengembalian,
          'peminjaman_denda' => 0,
          'peminjaman_status' => 1,
          'peminjaman_noId' => $booking->booking_noId
        ];
    
        $this->M_data->insertData($data, 'tb_peminjaman');
    
        $data = [
          'booking_accept' => 1
        ];
        $where = ['booking_id' => $booking_id];
        $this->M_data->updateData($data, $where, 'tb_booking');

      // Stok buku berkurang --------------------------------------------------------------
      $buku = $this->M_data->editData(['buku_id' => $booking->booking_buku], 'tb_buku')->row();
      $data_buku = [
        'buku_stok' => $buku->buku_stok - $actual
      ];

      $where = ['buku_id' => $booking->booking_buku];
      $this->M_data->updateData($data_buku, $where, 'tb_buku');
      // ----------------------------------------------------------------------------------
		$idBooking = $booking->booking_id;
		$data_array = $this->M_data->get_bookingAccepted($idBooking);
		foreach ($data_array as $key) {
		    
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
    		
    		$bulanIni = date('m', strtotime($key->booking_pengembalian));
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
				$this->email->subject('Info Peminjaman Buku di Perpustakaan Pemda Karawang');
				$this->email->message('Selamat '.$waktu.'.. '.'<p align="justify"> Diberitahukan kepada saudara/i '.$key->user_nama.'.. Proses booking buku Anda terima. Kami harapkan Anda mengembalikan buku ke perpustakaan tidak lewat dari tanggal '.date("j", strtotime($key->booking_pengembalian))." ".$bulanIni." ".date ("Y", strtotime($key->booking_pengembalian)).', jika melawati dari tanggal tersebut, maka akan dikenakan denda sebesar Rp. 5000 perhari. Denda tersebut akan dilipat gandakan perharinya, terhitung dari tanggal batas waktu pengembalian buku.</p> Terimakasih.."');
				$this->email->send();

		}
		
        $this->session->set_flashdata('pesan', '<script>sweet("Sukses","Data berhasil ditambahkan!","success","Tutup")</script>');
        redirect('dataBooking');
      }


    } else {
      $this->session->set_flashdata('pesan', '<script>sweet("Gagal","Data gagal ditambahkan!","error","Tutup")</script>');
      redirect('dataBooking');
    }    
  }

  public function process_booking_delete($id)
  {
    $booking_id = (int) $this->db->escape_str($id);

    $this->M_data->deleteData(['booking_id' => $booking_id], 'tb_booking');
    $this->session->set_flashdata('pesan', '<script>sweet("Sukses","Data berhasil dihapus!","success","Tutup")</script>');
    redirect('dataBooking');
  }

  public function search_buku()
  {
    $keyword = html_escape($this->input->post("keyword"));
    if ($keyword != "") {
      $check = $this->M_data->search_buku($keyword, 10);
      if ($check->success === TRUE) {
        foreach($check->data as $item) {
          echo "<p onclick=\"addBuku('$item->buku_judul - $item->buku_noSKU', $item->buku_id)\">Judul: $item->buku_judul - $item->buku_noSKU</p>";
        }
      } else {
        echo "<p>Maaf Buku tidak tersedia</p>";
      }
    } else {
      echo "";
    }
  }

  public function search_user()
  {
    $keyword = html_escape($this->input->post("keyword"));
    if ($keyword != "") {
      $check = $this->M_data->search_user($keyword, 10);
      if ($check->success === TRUE) {
        foreach($check->data as $item) {
          echo "<p onclick=\"addUser('$item->user_nama - $item->user_noId', $item->user_id)\">Nama: $item->user_nama - $item->user_noId</p>";
        }
      } else {
        echo "<p>Maaf User tidak ada</p>";
      }
    } else {
      echo "";
    }
  }
}
