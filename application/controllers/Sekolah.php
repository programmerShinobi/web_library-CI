<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');
require('./application/third_party/phpoffice/vendor/autoload.php');


use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Sekolah extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
    protek_login();
    genBooking();
    if ($this->session->userdata("role_id") == 3 ) {
      redirect("block");
    }
  }

  public function index()
  {
    $data = [
      'title' => 'Data Sekolah',
      'menu' => $this->M_data->get_access_menu()->result_array(),
      'user' => $this->M_data->editData(['user_id' => $this->session->userdata('admin_id')],'tb_user')->row(),
      'list_sekolah' => $this->M_data->getData("tb_sekolah")->result(),
			'sekolah'	=> $this->M_data->get_sekolah()->row(),
    ];
    $this->load->view('template/v_head', $data);
    $this->load->view('admin/v_dataSekolah', $data);
    $this->load->view('template/v_footer');
  }

  public function validation_sekolah_add()
  {
    $this->form_validation->set_rules('sekolah_nama', 'Sekolah', 'required|is_unique[tb_sekolah.sekolah_nama]');
    $this->form_validation->set_rules('sekolah_namaKepala', 'Sekolah', 'required');
    $this->form_validation->set_rules('sekolah_alamat', 'Sekolah', 'required');
    
    if ($this->form_validation->run() == FALSE) {
      $this->session->set_flashdata('pesan', '<script>sweet("Gagal ", "Dikarenakan data tidak lengkap / sekolah sudah terdaftar!", "error", "tutup")</script>');
      redirect("dataSekolah");
    } else {
      $this->process_sekolah_add();
    }
  }

  private function process_sekolah_add()
  {
    $input = (object)$this->db->escape_str($this->input->post());
    $data = [
      'sekolah_nama' => $input->sekolah_nama,
      'sekolah_namaKepala' => $input->sekolah_namaKepala,
      'sekolah_alamat' => $input->sekolah_alamat,
    ];
    $query = $this->M_data->insertData($data, "tb_sekolah");
    if ($query) {
      $this->session->set_flashdata('pesan', '<script>sweet("Sukses ", "Data sekolah berhasil ditambahkan!", "success", "tutup")</script>');
      redirect("dataSekolah");
    } else {
      $this->session->set_flashdata('pesan', '<script>sweet("Gagal ", "Query failed!", "danger", "tutup")</script>');
      redirect("dataSekolah");
    }
  }

  public function view_sekolah_edit($id)
  {
    $sekolah_id = (int)$this->db->escape_str($id);
    $check = $this->M_data->get_sekolah_detail($sekolah_id);
    if ($check) {
      $data = [
        'title' => 'Data Sekolah',
        'menu' => $this->M_data->get_access_menu()->result_array(),
        'user' => $this->M_data->editData(['user_id' => $this->session->userdata('admin_id')],'tb_user')->row(),
        'sekolah_detail' => $check->row()
      ];
      $this->load->view('template/v_head', $data);
      $this->load->view('admin/v_editSekolah', $data);
      $this->load->view('template/v_footer');
    } else {
      $this->session->set_flashdata('pesan', '<script>sweet("Gagal", "Query failed!", "error", "tutup")</script>');
      redirect("dataSekolah");
    }
  }

  public function validation_sekolah_edit()
  {
    $this->form_validation->set_rules('sekolah_nama', 'Nama Sekolah', 'required|is_unique[tb_sekolah.sekolah_nama]');
    $this->form_validation->set_rules('sekolah_namaKepala', 'Kepala Sekolah', 'required');
    $this->form_validation->set_rules('sekolah_alamat', 'Alamat Sekolah', 'required');
    $sekolah_id = (int)$this->input->post("sekolah_id");
    
    if ($this->form_validation->run() == FALSE) {
      $this->process_sekolah_update();
    } else {
      $this->session->set_flashdata('pesan', '<script>sweet("Gagal", "Isi data dengan benar & lengkap!", "error", "tutup")</script>');
      redirect("sekolah_edit/".$sekolah_id);
    }
  }

  private function process_sekolah_update()
  {
    $sekolah_id = (int)$this->input->post("sekolah_id");
    $input = (object)$this->db->escape_str($this->input->post());
    $data = [
      'sekolah_nama' => $input->sekolah_nama,
      'sekolah_namaKepala' => $input->sekolah_namaKepala,
      'sekolah_alamat' => $input->sekolah_alamat
    ];
    $where = ["sekolah_id" => $input->sekolah_id];
    $query = $this->M_data->updateData($data, $where, "tb_sekolah");
    if ($query) {
      $this->session->set_flashdata('pesan', '<script>sweet("Sukses","Data sekolah berhasil diubah!","success","Tutup")</script>');
      redirect("dataSekolah");
    } else {
      $this->session->set_flashdata('pesan', '<script>sweet("Gagal","Query failed!","error","Tutup")</script>');
      redirect('sekolah_edit/'.$input->sekolah_id);
    }
  }

  public function process_sekolah_delete($id)
  {
    $sekolah_id = (int)$this->db->escape_str($id);
    $get_sekolah = $this->M_data->editData(["sekolah_id" => $sekolah_id], "tb_sekolah")->row();
    $check = $this->M_data->deleteData(["sekolah_id" => $sekolah_id], "tb_sekolah");
    if ($check) {
      $this->M_data->deleteData(["sekolah_id" => $sekolah_id], "tb_sarana");
      $this->M_data->deleteData(["sekolah_id" => $sekolah_id], "tb_perpus");
      $this->M_data->deleteData(["sekolah_id" => $sekolah_id], "tb_koleksi");
      $this->M_data->deleteData(["sekolah_id" => $sekolah_id], "tb_person");
      $this->session->set_flashdata('pesan', '<script>sweet("Sukses","Data sekolah berhasil dihapus!","success","Tutup")</script>');
      redirect("dataSekolah");
    } else {
      $this->session->set_flashdata('pesan', '<script>sweet("Gagal","Query failed!","error","Tutup")</script>');
      redirect("dataSekolah");
    }
  }

  public function export_sekolah()
  {
    $list_sekolah = $this->M_data->getData("tb_sekolah")->result();

    $spreadsheet = new Spreadsheet;

    $spreadsheet->setActiveSheetIndex(0)
      ->setCellValue('A1', 'No.')
      ->setCellValue('B1', 'Sekolah')
      ->setCellValue('C1', 'Nama Kepala Sekolah')
      ->setCellValue('D1', 'Alamat');

    $kolom = 2;
    $nomor = 1;
    foreach ($list_sekolah as $item) {
      $spreadsheet->setActiveSheetIndex(0)
        ->setCellValue('A' . $kolom, $nomor)
        ->setCellValue('B' . $kolom, $item->sekolah_nama)
        ->setCellValue('C' . $kolom, $item->sekolah_namaKepala)
        ->setCellValue('D' . $kolom, $item->sekolah_alamat);
        $kolom++;
        $nomor++;
      }


    $writer = new Xlsx($spreadsheet);

    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename="Data_Sekolah.xlsx"');
    header('Cache-Control: max-age=0');

    $writer->save('php://output');
  }

  public function import_sekolah()
  {
    include APPPATH . 'third_party/PHPExcel/PHPExcel.php';
    $config['upload_path'] = realpath('./vendor/file/');
    $config['allowed_types'] = 'xlsx|xls|csv';
    $config['max_size'] = '1000000000';
    $config['encrypt_name'] = true;

    $this->load->library('upload');
    $this->upload->initialize($config);

    if (!$this->upload->do_upload('import_sekolah')) {
      $this->session->set_flashdata('pesan', '<script>sweet("Gagal!","File excel gagal diunggah!","error","Tutup")</script>');
      redirect('dataSekolah');
    } else {
      $data_upload = $this->upload->data();
      $excelreader   = new PHPExcel_Reader_Excel2007();
      $loadexcel     = $excelreader->load('./vendor/file/' . $data_upload['file_name']); // Load file yang telah diunggah ke folder excel
      $sheet         = $loadexcel->getActiveSheet()->toArray(null, true, true, true);

      $data  = array();

      $numrow = 1;
      foreach ($sheet as $row) {
        if ($numrow > 1) {
          array_push($data, array(
            "sekolah_nama" => $row["B"],
            "sekolah_namaKepala" => $row["C"],
            "sekolah_alamat" => $row["D"],
          ));
        }
        $numrow++;
      }

       //delete file from server
      unlink(realpath('./vendor/file/' . $data_upload['file_name']));
      $this->db->insert_batch('tb_sekolah', $data);
      //upload success
      $this->session->set_flashdata('pesan', '<script>sweet("Sukses!","File berhasil diunggah!","success","Tutup")</script>');
      //redirect halaman
      redirect('dataSekolah');
    }
  }

  public function view_perpus_check($id)
  {
    $sekolah_id = (int)$this->db->escape_str($id);
    $data = [
      'title' => 'Data Sekolah',
      'menu' => $this->M_data->get_access_menu()->result_array(),
      'user' => $this->M_data->editData(['user_id' => $this->session->userdata('admin_id')],'tb_user')->row(),
      'nama_sekolah' => $this->M_data->get_sekolah_detail($sekolah_id)->result(),
      'list_perpus' => $this->M_data->get_perpus_detail($sekolah_id)->result(),
      'list_sarana' => $this->M_data->get_sarana_detail($sekolah_id)->result(),
      'list_koleksi'=> $this->M_data->get_koleksi_detail($sekolah_id)->result(),
      'list_koleksi_umum'=> $this->M_data->get_koleksi_umum_detail($sekolah_id)->result(),
      'list_koleksi_referensi'=> $this->M_data->get_koleksi_referensi_detail($sekolah_id)->result(),
      'list_koleksi_terbitan'=> $this->M_data->get_koleksi_terbitan_detail($sekolah_id)->result(),
      'list_person' => $this->M_data->get_person_detail($sekolah_id)->result(),
      'list_person_anggota' => $this->M_data->get_person_anggota_detail($sekolah_id)->result(),
      'list_person_pemustaka' => $this->M_data->get_person_pemustaka_detail($sekolah_id)->result(),
      'list_person_pengunjung' => $this->M_data->get_person_pengunjung_detail($sekolah_id)->result(),
      'sekolah_total_rak_sirkulasi_tahunIni' => $this->M_data->get_sekolah_total_sarana_tahunIni($id)->row('sarana_jumlahRakSirkulasi'),
      'sekolah_total_rak_referensi_tahunIni' => $this->M_data->get_sekolah_total_sarana_tahunIni($id)->row('sarana_jumlahRakReferensi'),
      'sekolah_total_rak_terbitan_tahunIni' => $this->M_data->get_sekolah_total_sarana_tahunIni($id)->row('sarana_jumlahRakTerbitan'),
      'sekolah_total_koleksi_umum_tahunIni' => $this->M_data->get_sekolah_total_koleksi_umum_tahunIni($id)->row('koleksi_jumlah'),
      'sekolah_total_koleksi_referensi_tahunIni' => $this->M_data->get_sekolah_total_koleksi_referensi_tahunIni($id)->row('koleksi_jumlah'),
      'sekolah_total_koleksi_terbitan_tahunIni' => $this->M_data->get_sekolah_total_koleksi_terbitan_tahunIni($id)->row('koleksi_jumlah'),
      'sekolah_total_person_anggota_guru_tahunIni' => $this->M_data->get_sekolah_total_person_anggota_tahunIni($id)->row('person_jumlahGuruStaff'),
      'sekolah_total_person_pemustaka_guru_tahunIni' => $this->M_data->get_sekolah_total_person_pemustaka_tahunIni($id)->row('person_jumlahGuruStaff'),
      'sekolah_total_person_pengunjung_guru_tahunIni' => $this->M_data->get_sekolah_total_person_pengunjung_tahunIni($id)->row('person_jumlahGuruStaff'),
      'sekolah_total_person_anggota_siswa_tahunIni' => $this->M_data->get_sekolah_total_person_anggota_tahunIni($id)->row('person_jumlahSiswa'),
      'sekolah_total_person_pemustaka_siswa_tahunIni' => $this->M_data->get_sekolah_total_person_pemustaka_tahunIni($id)->row('person_jumlahSiswa'),
      'sekolah_total_person_pengunjung_siswa_tahunIni' => $this->M_data->get_sekolah_total_person_pengunjung_tahunIni($id)->row('person_jumlahSiswa'),
    ];

    $this->load->view('template/v_head', $data);
    $this->load->view('admin/v_checkPerpus', $data);
    $this->load->view('template/v_footer');
  }

  public function validation_perpus_add()
  {
    $this->form_validation->set_rules('perpus_namaPengelola', 'perpus', 'required');
    $this->form_validation->set_rules('perpus_kontakPengelola', 'perpus', 'required|min_length[10]|max_length[12]',
    ['min_lenght'	=> 'Digit terlalu pendek Minimal 10 Digit!'],
    ['max_lenght'	=> 'Digit terlalu panjang Maksimal 12 Digit!']);
    $this->form_validation->set_rules('perpus_namaSekretaris', 'perpus', 'required');
    $this->form_validation->set_rules('perpus_namaPetugas', 'perpus', 'required');
    $this->form_validation->set_rules('perpus_pertahun', 'perpus', 'required|min_length[4]|max_length[4]',
    ['min_lenght'	=> 'Digit terlalu pendek Minimal 4 Digit!'],
    ['max_lenght'	=> 'Digit terlalu panjang Maksimal 4 Digit!']);
    if ($this->form_validation->run() == FALSE) {
      $this->session->set_flashdata('pesan', '<script>sweet("Gagal ", "Dikarenakan data tidak lengkap / data sudah terdaftar!", "error", "tutup")</script>');
      $sekolahCheck = (int)$this->input->post("sekolah_id");
      redirect("perpus_check/".$sekolahCheck);
    } else {
      $this->process_perpus_add();
    }
  }

  private function process_perpus_add()
  {
    $input = (object)$this->db->escape_str($this->input->post());
    $data = [
      'perpus_namaPengelola' => $input->perpus_namaPengelola,
      'perpus_kontakPengelola' => $input->perpus_kontakPengelola,
      'perpus_namaSekretaris' => $input->perpus_namaSekretaris,
      'perpus_namaPetugas' => $input->perpus_namaPetugas,
      'perpus_pertahun' => $input->perpus_pertahun,
      'sekolah_id'=> $input->sekolah_id
    ];
    $query = $this->M_data->insertData($data, "tb_perpus");
    if ($query) {
      $this->session->set_flashdata('pesan', '<script>sweet("Sukses ", "Data perpustakaan berhasil ditambahkan!", "success", "tutup")</script>');
      $sekolahCheck = (int)$this->input->post("sekolah_id");
      redirect("perpus_check/".$sekolahCheck);
    } else {
      $this->session->set_flashdata('pesan', '<script>sweet("Gagal ", "Query failed!", "danger", "tutup")</script>');
      $sekolahCheck = (int)$this->input->post("sekolah_id");
      redirect("perpus_check/".$sekolahCheck);
    }
  }
  
  public function validation_sarana_add()
  {
    $this->form_validation->set_rules('sarana_luasGedung', 'sarana', 'required');
    $this->form_validation->set_rules('sarana_jumlahRakSirkulasi', 'sarana', 'required');
    $this->form_validation->set_rules('sarana_jumlahRakReferensi', 'sarana', 'required');
    $this->form_validation->set_rules('sarana_jumlahRakTerbitan', 'sarana', 'required');
    $this->form_validation->set_rules('sarana_pertahun', 'sarana', 'required|min_length[4]|max_length[4]',
    ['min_lenght'	=> 'Digit terlalu pendek Minimal 4 Digit!'],
    ['max_lenght'	=> 'Digit terlalu panjang Maksimal 4 Digit!']);

    if ($this->form_validation->run() == FALSE) {
      $this->session->set_flashdata('pesan', '<script>sweet("Gagal ", "Dikarenakan data tidak lengkap / data sudah terdaftar!", "error", "tutup")</script>');
      $sekolahCheck = (int)$this->input->post("sekolah_id");
      redirect("perpus_check/".$sekolahCheck);
    } else {
      $this->process_sarana_add();
    }
  }

  private function process_sarana_add()
  {
    $input = (object)$this->db->escape_str($this->input->post());
    $data = [
      'sarana_luasGedung' => $input->sarana_luasGedung,
      'sarana_jumlahRakSirkulasi' => $input->sarana_jumlahRakSirkulasi,
      'sarana_jumlahRakReferensi' => $input->sarana_jumlahRakReferensi,
      'sarana_jumlahRakTerbitan' => $input->sarana_jumlahRakTerbitan,
      'sarana_pertahun' => $input->sarana_pertahun,
      'sekolah_id'=> $input->sekolah_id
    ];
    $query = $this->M_data->insertData($data, "tb_sarana");
    if ($query) {
      $this->session->set_flashdata('pesan', '<script>sweet("Sukses ", "Data sarana berhasil ditambahkan!", "success", "tutup")</script>');
      $sekolahCheck = (int)$this->input->post("sekolah_id");
      redirect("perpus_check/".$sekolahCheck);
    } else {
      $this->session->set_flashdata('pesan', '<script>sweet("Gagal ", "Query failed!", "danger", "tutup")</script>');
      $sekolahCheck = (int)$this->input->post("sekolah_id");
      redirect("perpus_check/".$sekolahCheck);
    }
  }

  public function validation_koleksi_add()
  {
    $this->form_validation->set_rules('koleksi_kriteria', 'koleksi', 'required');
    $this->form_validation->set_rules('koleksi_kelas', 'koleksi', 'required');
    $this->form_validation->set_rules('koleksi_judul', 'koleksi', 'required');
    $this->form_validation->set_rules('koleksi_jumlah', 'koleksi', 'required');
    $this->form_validation->set_rules('koleksi_pertahun', 'koleksi', 'required|min_length[4]|max_length[4]',
    ['min_lenght'	=> 'Digit terlalu pendek Minimal 4 Digit!'],
    ['max_lenght'	=> 'Digit terlalu panjang Maksimal 4 Digit!']);

    if ($this->form_validation->run() == FALSE) {
      $this->session->set_flashdata('pesan', '<script>sweet("Gagal ", "Dikarenakan data tidak lengkap / data sudah terdaftar!", "error", "tutup")</script>');
      $sekolahCheck = (int)$this->input->post("sekolah_id");
      redirect("perpus_check/".$sekolahCheck);
    } else {
      $this->process_koleksi_add();
    }
  }

  private function process_koleksi_add()
  {
    $input = (object)$this->db->escape_str($this->input->post());
    $data = [
      'koleksi_kriteria' => $input->koleksi_kriteria,
      'koleksi_kelas' => $input->koleksi_kelas,
      'koleksi_judul' => $input->koleksi_judul,
      'koleksi_jumlah' => $input->koleksi_jumlah,
      'koleksi_pertahun' => $input->koleksi_pertahun,
      'sekolah_id'=> $input->sekolah_id
    ];
    $query = $this->M_data->insertData($data, "tb_koleksi");
    if ($query) {
      $this->session->set_flashdata('pesan', '<script>sweet("Sukses ", "Data koleksi berhasil ditambahkan!", "success", "tutup")</script>');
      $sekolahCheck = (int)$this->input->post("sekolah_id");
      redirect("perpus_check/".$sekolahCheck);
    } else {
      $this->session->set_flashdata('pesan', '<script>sweet("Gagal ", "Query failed!", "danger", "tutup")</script>');
      $sekolahCheck = (int)$this->input->post("sekolah_id");
      redirect("perpus_check/".$sekolahCheck);
    }
  }

  public function validation_person_add()
  {
    $this->form_validation->set_rules('person_kriteria', 'person', 'required');
    $this->form_validation->set_rules('person_jumlahGuruStaff', 'person', 'required');
    $this->form_validation->set_rules('person_jumlahSiswa', 'person', 'required');
    $this->form_validation->set_rules('person_pertahun', 'person', 'required|min_length[4]|max_length[4]',
    ['min_lenght'	=> 'Digit terlalu pendek Minimal 4 Digit!'],
    ['max_lenght'	=> 'Digit terlalu panjang Maksimal 4 Digit!']);

    if ($this->form_validation->run() == FALSE) {
      $this->session->set_flashdata('pesan', '<script>sweet("Gagal ", "Dikarenakan data tidak lengkap / data sudah terdaftar!", "error", "tutup")</script>');
      $sekolahCheck = (int)$this->input->post("sekolah_id");
      redirect("perpus_check/".$sekolahCheck);
    } else {
      $this->process_person_add();
    }
  }

  private function process_person_add()
  {
    $input = (object)$this->db->escape_str($this->input->post());
    $data = [
      'person_kriteria' => $input->person_kriteria,
      'person_jumlahGuruStaff' => $input->person_jumlahGuruStaff,
      'person_jumlahSiswa' => $input->person_jumlahSiswa,
      'person_pertahun' => $input->person_pertahun,
      'sekolah_id'=> $input->sekolah_id
    ];
    $query = $this->M_data->insertData($data, "tb_person");
    if ($query) {
      $this->session->set_flashdata('pesan', '<script>sweet("Sukses ", "Data person berhasil ditambahkan!", "success", "tutup")</script>');
      $sekolahCheck = (int)$this->input->post("sekolah_id");
      redirect("perpus_check/".$sekolahCheck);
    } else {
      $this->session->set_flashdata('pesan', '<script>sweet("Gagal ", "Query failed!", "danger", "tutup")</script>');
      $sekolahCheck = (int)$this->input->post("sekolah_id");
      redirect("perpus_check/".$sekolahCheck);
    }
  }

  public function view_perpus_edit($id)
  {
    $perpus_id = (int)$this->db->escape_str($id);
    $check = $this->M_data->get_perpus($perpus_id);
    if ($check) {
      $data = [
        'title' => 'Data Sekolah',
        'menu' => $this->M_data->get_access_menu()->result_array(),
        'user' => $this->M_data->editData(['user_id' => $this->session->userdata('admin_id')],'tb_user')->row(),
        'perpus' => $check->row()
      ];
      $this->load->view('template/v_head', $data);
      $this->load->view('admin/v_editPerpus', $data);
      $this->load->view('template/v_footer');
    } else {
      $this->session->set_flashdata('pesan', '<script>sweet("Gagal", "Query failed!", "error", "Tutup")</script>');
      $sekolahCheck = (int)$this->input->post("sekolah_id");
      redirect("perpus_check/".$sekolahCheck);    
    }
  }

  public function validation_perpus_edit()
  {
    $this->form_validation->set_rules('perpus_namaPengelola', 'Nama Pengelola', 'required',
    ['required' => 'Wajib untuk masukan Nama Pengelola!']);

    $perpus_id = (int)$this->input->post("perpus_id");
    
    if ($this->form_validation->run() == FALSE)
    {
      $this->session->set_flashdata('pesan', '<script>sweet("Gagal", "Isi data nama pengelola dengan benar & lengkap!", "error", "tutup")</script>');
      redirect("perpus_edit/".$perpus_id);
    } 
    else 
    {
      $this->form_validation->set_rules('perpus_kontakPengelola', 'Kontak Pengelola', 'required',
      ['required' => 'Wajib untuk masukan Kontak Pengelola!']);
      
      if ($this->form_validation->run() == FALSE)
      {
        $this->session->set_flashdata('pesan', '<script>sweet("Gagal", "Isi data nama pengelola dengan benar & lengkap!", "error", "tutup")</script>');
        redirect("perpus_edit/".$perpus_id);
      } 
      else 
      {
        $this->form_validation->set_rules('perpus_kontakPengelola', 'Kontak Pengelola', 'min_length[10]',
        ['min_lenght'	=> 'Digit terlalu pendek Minimal 10 Digit!']);
        
      
        if ($this->form_validation->run() == FALSE)
        {
          $this->session->set_flashdata('pesan', '<script>sweet("Gagal", "Isi data kontak pengelola dengan benar & lengkap.. Digit terlalu pendek, Minimal 10 Digit!", "error", "tutup")</script>');
          redirect("perpus_edit/".$perpus_id);
        } 
        else
        {
          $this->form_validation->set_rules('perpus_kontakPengelola', 'Kontak Pengelola', 'max_length[12]',
          ['max_lenght'	=> 'Digit terlalu panjang Maksimal 12 Digit!']);
          
          if ($this->form_validation->run() == FALSE)
          {
            $this->session->set_flashdata('pesan', '<script>sweet("Gagal", "Isi data kontak pengelola dengan benar & lengkap.. Digit terlalu panjang, Maksimal 12 Digit!", "error", "tutup")</script>');
            redirect("perpus_edit/".$perpus_id);
          } 
          else
          {
            $this->form_validation->set_rules('perpus_namaSekretaris', 'Nama Sekretaris',  'required',
            ['required' => 'Wajib untuk masukan Nama Sekretaris!']);

            if ($this->form_validation->run() == FALSE)
            {
              $this->session->set_flashdata('pesan', '<script>sweet("Gagal", "Isi data nama sekretaris dengan benar & lengkap!", "error", "tutup")</script>');
              redirect("perpus_edit/".$perpus_id);
            } 
            else
            {
              $this->form_validation->set_rules('perpus_namaPetugas', 'Nama Petugas',  'required',
              ['required' => 'Wajib untuk masukan Nama Petugas!']);


              if ($this->form_validation->run() == FALSE)
              {
                $this->session->set_flashdata('pesan', '<script>sweet("Gagal", "Isi data nama petugas dengan benar & lengkap!", "error", "tutup")</script>');
                redirect("perpus_edit/".$perpus_id);
              } 
              else
              {
                $this->form_validation->set_rules('perpus_pertahun', 'Pertahun', 'required',
                ['required' => 'Wajib untuk masukan Pertahun!']);
                if ($this->form_validation->run() == FALSE)
                {
                  $this->session->set_flashdata('pesan', '<script>sweet("Gagal", "Isi data tahun dengan benar & lengkap!", "error", "tutup")</script>');
                  redirect("perpus_edit/".$perpus_id);
                } 
                else
                {
                  $this->form_validation->set_rules('perpus_pertahun', 'Pertahun', 'min_length[4]',
                  ['min_lenght'	=> 'Digit terlalu pendek Minimal 4 Digit!']);
                  if ($this->form_validation->run() == FALSE)
                  {
                    $this->session->set_flashdata('pesan', '<script>sweet("Gagal", "Isi data tahun dengan benar & lengkap.. Digit terlalu pendek, Minimal 4 Digit!", "error", "tutup")</script>');
                    redirect("perpus_edit/".$perpus_id);
                  } 
                  else
                  {
                    $this->form_validation->set_rules('perpus_pertahun', 'Pertahun', 'max_length[4]',
                    ['max_lenght'	=> 'Digit terlalu panjang Maksimal 4 Digit!']);
                    if ($this->form_validation->run() == FALSE)
                    {
                      $this->session->set_flashdata('pesan', '<script>sweet("Gagal", "Isi data tahun dengan benar & lengkap.. Digit terlalu pendek, Maksimal 4 Digit!", "error", "tutup")</script>');
                      redirect("perpus_edit/".$perpus_id);
                    } 
                    else
                    {
                      $this->process_perpus_update(); 
                    }
                  }
                }
              }
            }
          }  
        }
      }
    }
  }

  private function process_perpus_update()
  {
    $perpus_id = (int)$this->input->post("perpus_id");
    $input = (object)$this->db->escape_str($this->input->post());
    $data = [
      'perpus_namaPengelola' => $input->perpus_namaPengelola,
      'perpus_kontakPengelola' => $input->perpus_kontakPengelola,
      'perpus_namaSekretaris' => $input->perpus_namaSekretaris,
      'perpus_namaPetugas' => $input->perpus_namaPetugas,
      'perpus_pertahun' => $input->perpus_pertahun,
    ];
    $where = ["perpus_id" => $perpus_id];
    $query = $this->M_data->updateData($data, $where, "tb_perpus");
    if ($query) {
      $this->session->set_flashdata('pesan', '<script>sweet("Sukses","Data perpustakaan berhasil diubah!","success","Tutup")</script>');
      redirect("perpus_edit/".$perpus_id);
    } else {
      $this->session->set_flashdata('pesan', '<script>sweet("Gagal","Query failed!","error","Tutup")</script>');
      redirect('perpus_edit/'.$perpus_id);
    }
  }

  public function view_sarana_edit($id)
  {
    $sarana_id = (int)$this->db->escape_str($id);
    $check = $this->M_data->get_sarana($sarana_id);
    if ($check) {
      $data = [
        'title' => 'Data Sekolah',
        'menu' => $this->M_data->get_access_menu()->result_array(),
        'user' => $this->M_data->editData(['user_id' => $this->session->userdata('admin_id')],'tb_user')->row(),
        'sarana' => $check->row()
      ];
      $this->load->view('template/v_head', $data);
      $this->load->view('admin/v_editSarana', $data);
      $this->load->view('template/v_footer');
    } else {
      $this->session->set_flashdata('pesan', '<script>sweet("Gagal", "Query failed!", "error", "Tutup")</script>');
      $sekolahCheck = (int)$this->input->post("sekolah_id");
      redirect("perpus_check/".$sekolahCheck."#saranaTab");
    }
  }

  public function validation_sarana_edit()
  {
    $this->form_validation->set_rules('sarana_luasGedung', 'Luas Gedung', 'required',
    ['required' => 'Wajib untuk masukan Luas Gedung!']);

    $sarana_id = (int)$this->input->post("sarana_id");
    
    if ($this->form_validation->run() == FALSE)
    {
      $this->session->set_flashdata('pesan', '<script>sweet("Gagal", "Isi data luas gedung dengan benar & lengkap!", "error", "tutup")</script>');
      redirect("sarana_edit/".$sarana_id);
    } 
    else 
    {
      $this->form_validation->set_rules('sarana_jumlahRakSirkulasi', 'Jumlah Rak Sirkulasi', 'required',
      ['required' => 'Wajib untuk masukan Jumlah Rak Sirkulasi!']);
      
      if ($this->form_validation->run() == FALSE)
      {
        $this->session->set_flashdata('pesan', '<script>sweet("Gagal", "Isi data jumlah rak sirkulasi dengan benar & lengkap!", "error", "tutup")</script>');
        redirect("sarana_edit/".$sarana_id);
      } 
      else 
      {
        $this->form_validation->set_rules('sarana_jumlahRakReferensi', 'Jumlah Rak Referensi', 'required',
        ['required' => 'Wajib untuk masukan Jumlah Rak Referensi!']);
        if ($this->form_validation->run() == FALSE)
        {
          $this->session->set_flashdata('pesan', '<script>sweet("Gagal", "Isi data jumlah rak referensi dengan benar & lengkap!", "error", "tutup")</script>');
          redirect("sarana_edit/".$sarana_id);
        } 
        else
        {
          $this->form_validation->set_rules('sarana_jumlahRakTerbitan', 'Jumlah Rak Terbitan', 'required',
          ['required' => 'Wajib untuk masukan Jumlah Rak Terbitan!']);
          if ($this->form_validation->run() == FALSE)
          {
            $this->session->set_flashdata('pesan', '<script>sweet("Gagal", "Isi data jumlah rak terbitan dengan benar & lengkap!", "error", "tutup")</script>');
            redirect("sarana_edit/".$sarana_id);
          } 
          else
          {
            $this->form_validation->set_rules('sarana_pertahun', 'Pertahun', 'required',
            ['required' => 'Wajib untuk masukan Pertahun!']);
            if ($this->form_validation->run() == FALSE)
            {
              $this->session->set_flashdata('pesan', '<script>sweet("Gagal", "Isi data tahun dengan benar & lengkap!", "error", "tutup")</script>');
              redirect("sarana_edit/".$sarana_id);
            } 
            else
            {
              $this->form_validation->set_rules('sarana_pertahun', 'Pertahun', 'min_length[4]',
              ['min_lenght'	=> 'Digit terlalu pendek Minimal 4 Digit!']);
              if ($this->form_validation->run() == FALSE)
              {
                $this->session->set_flashdata('pesan', '<script>sweet("Gagal", "Isi data tahun dengan benar & lengkap.. Digit terlalu pendek, Minimal 4 Digit!", "error", "tutup")</script>');
                redirect("sarana_edit/".$sarana_id);
              } 
              else
              {
                $this->form_validation->set_rules('sarana_pertahun', 'Pertahun', 'max_length[4]',
                ['max_lenght'	=> 'Digit terlalu panjang Maksimal 4 Digit!']);
                if ($this->form_validation->run() == FALSE)
                {
                  $this->session->set_flashdata('pesan', '<script>sweet("Gagal", "Isi data tahun dengan benar & lengkap.. Digit terlalu pendek, Maksimal 4 Digit!", "error", "tutup")</script>');
                  redirect("sarana_edit/".$sarana_id);
                } 
                else
                {
                  $this->process_sarana_update(); 
                }
              }
            }  
          }  
        }
      }
    }
  }

  private function process_sarana_update()
  {
    $sarana_id = (int)$this->input->post("sarana_id");
    $input = (object)$this->db->escape_str($this->input->post());
    $data = [
      'sarana_luasGedung' => $input->sarana_luasGedung,
      'sarana_jumlahRakSirkulasi' => $input->sarana_jumlahRakSirkulasi,
      'sarana_jumlahRakReferensi' => $input->sarana_jumlahRakReferensi,
      'sarana_jumlahRakTerbitan' => $input->sarana_jumlahRakTerbitan,
      'sarana_pertahun' => $input->sarana_pertahun,
    ];
    $where = ["sarana_id" => $input->sarana_id];
    $query = $this->M_data->updateData($data, $where, "tb_sarana");
    if ($query) {
      $this->session->set_flashdata('pesan', '<script>sweet("Sukses","Data sarana berhasil diubah!","success","Tutup")</script>');
      redirect("sarana_edit/".$sarana_id);
    } else {
      $this->session->set_flashdata('pesan', '<script>sweet("Gagal","Query failed!","error","Tutup")</script>');
      redirect("sarana_edit/".$sarana_id);
    }
  }

  public function view_koleksi_edit($id)
  {
    $koleksi_id = (int)$this->db->escape_str($id);
    $check = $this->M_data->get_koleksi($koleksi_id);
    if ($check) {
      $data = [
        'title' => 'Data Sekolah',
        'menu' => $this->M_data->get_access_menu()->result_array(),
        'user' => $this->M_data->editData(['user_id' => $this->session->userdata('admin_id')],'tb_user')->row(),
        'koleksi' => $check->row()
      ];
      $this->load->view('template/v_head', $data);
      $this->load->view('admin/v_editKoleksi', $data);
      $this->load->view('template/v_footer');
    } else {
      $this->session->set_flashdata('pesan', '<script>sweet("Gagal", "Query failed!", "error", "Tutup")</script>');
      $sekolahCheck = (int)$this->input->post("sekolah_id");
      redirect("perpus_check/".$sekolahCheck."#koleksiTab");
    }
  }

  public function validation_koleksi_edit()
  {
    $this->form_validation->set_rules('koleksi_kriteria', 'Kriteria', 'required',
    ['required' => 'Wajib untuk masukan Kriteria!']);

    $koleksi_id = (int)$this->input->post("koleksi_id");
    
    if ($this->form_validation->run() == FALSE)
    {
      $this->session->set_flashdata('pesan', '<script>sweet("Gagal", "Isi data kriteria dengan benar & lengkap!", "error", "tutup")</script>');
      redirect("koleksi_edit/".$koleksi_id);
    } 
    else 
    {
      $this->form_validation->set_rules('koleksi_kelas', 'Kelas', 'required',
      ['required' => 'Wajib untuk masukan Kelas!']);
      
      if ($this->form_validation->run() == FALSE)
      {
        $this->session->set_flashdata('pesan', '<script>sweet("Gagal", "Isi data kelas dengan benar & lengkap!", "error", "tutup")</script>');
        redirect("koleksi_edit/".$koleksi_id);
      } 
      else 
      {
        $this->form_validation->set_rules('koleksi_judul', 'Judul', 'required',
        ['required' => 'Wajib untuk masukan Judul!']);
        if ($this->form_validation->run() == FALSE)
        {
          $this->session->set_flashdata('pesan', '<script>sweet("Gagal", "Isi data judul dengan benar & lengkap!", "error", "tutup")</script>');
          redirect("koleksi_edit/".$koleksi_id);
        } 
        else
        {
          $this->form_validation->set_rules('koleksi_jumlah', 'Jumlah', 'required',
          ['required' => 'Wajib untuk masukan Jumlah!']);
          if ($this->form_validation->run() == FALSE)
          {
            $this->session->set_flashdata('pesan', '<script>sweet("Gagal", "Isi data jumlah dengan benar & lengkap!", "error", "tutup")</script>');
            redirect("koleksi_edit/".$koleksi_id);
          } 
          else
          {
            $this->form_validation->set_rules('koleksi_pertahun', 'Pertahun', 'required',
            ['required' => 'Wajib untuk masukan Pertahun!']);
            if ($this->form_validation->run() == FALSE)
            {
              $this->session->set_flashdata('pesan', '<script>sweet("Gagal", "Isi data tahun dengan benar & lengkap!", "error", "tutup")</script>');
              redirect("koleksi_edit/".$koleksi_id);
            } 
            else
            {
              $this->form_validation->set_rules('koleksi_pertahun', 'Pertahun', 'min_length[4]',
              ['min_lenght'	=> 'Digit terlalu pendek Minimal 4 Digit!']);
              if ($this->form_validation->run() == FALSE)
              {
                $this->session->set_flashdata('pesan', '<script>sweet("Gagal", "Isi data tahun dengan benar & lengkap.. Digit terlalu pendek, Minimal 4 Digit!", "error", "tutup")</script>');
                redirect("koleksi_edit/".$koleksi_id);
              } 
              else
              {
                $this->form_validation->set_rules('koleksi_pertahun', 'Pertahun', 'max_length[4]',
                ['max_lenght'	=> 'Digit terlalu panjang Maksimal 4 Digit!']);
                if ($this->form_validation->run() == FALSE)
                {
                  $this->session->set_flashdata('pesan', '<script>sweet("Gagal", "Isi data tahun dengan benar & lengkap.. Digit terlalu pendek, Maksimal 4 Digit!", "error", "tutup")</script>');
                  redirect("koleksi_edit/".$koleksi_id);
                } 
                else
                {
                  $this->process_koleksi_update(); 
                }
              }
            }  
          }  
        }
      }
    }
  }

  private function process_koleksi_update()
  {
    $koleksi_id = (int)$this->input->post("koleksi_id");
    $input = (object)$this->db->escape_str($this->input->post());
    $data = [
      'koleksi_kriteria' => $input->koleksi_kriteria,
      'koleksi_kelas' => $input->koleksi_kelas,
      'koleksi_judul' => $input->koleksi_judul,
      'koleksi_jumlah' => $input->koleksi_jumlah,
      'koleksi_pertahun' => $input->koleksi_pertahun,
    ];
    $where = ["koleksi_id" => $input->koleksi_id];
    $query = $this->M_data->updateData($data, $where, "tb_koleksi");
    if ($query) {
      $this->session->set_flashdata('pesan', '<script>sweet("Sukses","Data koleksi berhasil diubah!","success","Tutup")</script>');
      redirect("koleksi_edit/".$koleksi_id);
    } else {
      $this->session->set_flashdata('pesan', '<script>sweet("Gagal","Query failed!","error","Tutup")</script>');
      redirect("koleksi_edit/".$koleksi_id);
    }
  }

  public function view_person_edit($id)
  {
    $person_id = (int)$this->db->escape_str($id);
    $check = $this->M_data->get_person($person_id);
    if ($check) {
      $data = [
        'title' => 'Data Sekolah',
        'menu' => $this->M_data->get_access_menu()->result_array(),
        'user' => $this->M_data->editData(['user_id' => $this->session->userdata('admin_id')],'tb_user')->row(),
        'person' => $check->row()
      ];
      $this->load->view('template/v_head', $data);
      $this->load->view('admin/v_editPerson', $data);
      $this->load->view('template/v_footer');
    } else {
      $this->session->set_flashdata('pesan', '<script>sweet("Gagal", "Query failed!", "error", "Tutup")</script>');
      $sekolahCheck = (int)$this->input->post("sekolah_id");
      redirect("perpus_check/".$sekolahCheck."#personTab");
    }
  }

  public function validation_person_edit()
  {
    $this->form_validation->set_rules('person_kriteria', 'Kriteria', 'required',
    ['required' => 'Wajib untuk masukan Kriteria!']);

    $person_id = (int)$this->input->post("person_id");
    
    if ($this->form_validation->run() == FALSE)
    {
      $this->session->set_flashdata('pesan', '<script>sweet("Gagal", "Isi data kriteria dengan benar & lengkap!", "error", "tutup")</script>');
      redirect("person_edit/".$person_id);
    } 
    else 
    {
      $this->form_validation->set_rules('person_jumlahGuruStaff', 'Jumlah Guru/Staff', 'required',
      ['required' => 'Wajib untuk masukan Jumlah Guru/Staff!']);
      
      if ($this->form_validation->run() == FALSE)
      {
        $this->session->set_flashdata('pesan', '<script>sweet("Gagal", "Isi data jumlah guru/staff dengan benar & lengkap!", "error", "tutup")</script>');
        redirect("person_edit/".$person_id);
      } 
      else 
      {
        $this->form_validation->set_rules('person_jumlahSiswa', 'Jumlah Siswa', 'required',
        ['required' => 'Wajib untuk masukan Jumlah Siswa!']);
        if ($this->form_validation->run() == FALSE)
        {
          $this->session->set_flashdata('pesan', '<script>sweet("Gagal", "Isi data jumlah siswa dengan benar & lengkap!", "error", "tutup")</script>');
          redirect("person_edit/".$person_id);
        } 
        else
        {
          $this->form_validation->set_rules('person_pertahun', 'Pertahun', 'required',
          ['required' => 'Wajib untuk masukan Pertahun!']);
          if ($this->form_validation->run() == FALSE)
          {
            $this->session->set_flashdata('pesan', '<script>sweet("Gagal", "Isi data tahun dengan benar & lengkap!", "error", "tutup")</script>');
            redirect("person_edit/".$person_id);
          } 
          else
          {
            $this->form_validation->set_rules('person_pertahun', 'Pertahun', 'min_length[4]',
            ['min_lenght'	=> 'Digit terlalu pendek Minimal 4 Digit!']);
            if ($this->form_validation->run() == FALSE)
            {
              $this->session->set_flashdata('pesan', '<script>sweet("Gagal", "Isi data tahun dengan benar & lengkap.. Digit terlalu pendek, Minimal 4 Digit!", "error", "tutup")</script>');
              redirect("person_edit/".$person_id);
            } 
            else
            {
              $this->form_validation->set_rules('person_pertahun', 'Pertahun', 'max_length[4]',
              ['max_lenght'	=> 'Digit terlalu panjang Maksimal 4 Digit!']);
              if ($this->form_validation->run() == FALSE)
              {
                $this->session->set_flashdata('pesan', '<script>sweet("Gagal", "Isi data tahun dengan benar & lengkap.. Digit terlalu pendek, Maksimal 4 Digit!", "error", "tutup")</script>');
                redirect("person_edit/".$person_id);
              } 
              else
              {
                $this->process_person_update(); 
              }
            }
          }  
        }
      }
    }
  }

  private function process_person_update()
  {
    $person_id = (int)$this->input->post("person_id");
    $input = (object)$this->db->escape_str($this->input->post());
    $data = [
      'person_kriteria' => $input->person_kriteria,
      'person_jumlahGuruStaff' => $input->person_jumlahGuruStaff,
      'person_jumlahSiswa' => $input->person_jumlahSiswa,
      'person_pertahun' => $input->person_pertahun,
    ];
    $where = ["person_id" => $input->person_id];
    $query = $this->M_data->updateData($data, $where, "tb_person");
    if ($query) {
      $this->session->set_flashdata('pesan', '<script>sweet("Sukses","Data person berhasil diubah!","success","Tutup")</script>');
      redirect("person_edit/".$person_id);
    } else {
      $this->session->set_flashdata('pesan', '<script>sweet("Gagal","Query failed!","error","Tutup")</script>');
      redirect("person_edit/".$person_id);
    }
  }

  public function process_perpus_lapor($variable, $sekolah_id)
  {
		$id = (int)$this->db->escape_str($sekolah_id);
		$user = $this->M_data->editData(['user_id' => $this->session->userdata('admin_id')], 'tb_user')->row();
			if ($variable==0){
				$data = [
					'laporan_nama' => $user->user_nama,
					'laporan_jenis' => "Semua",
					'laporan_catatan' => "Laporan Tahunan Selesai",
					'laporan_tanggal' => date("Y")."-".date("m")."-".date("d"),
					'sekolah_id' => $id
				];
			} else if ($variable == 1) {
				$data = [
					'laporan_nama' => $user->user_nama,
					'laporan_jenis' => "Perpustakaan",
					'laporan_catatan' => "Laporan Tahunan Selesai",
					'laporan_tanggal' => date("Y") . "-" . date("m") . "-" . date("d"),
					'sekolah_id' => $id
				];
			} else if ($variable == 2) {
				$data = [
					'laporan_nama' => $user->user_nama,
					'laporan_jenis' => "Sarana - Prasarana",
					'laporan_catatan' => "Laporan Tahunan Selesai",
					'laporan_tanggal' => date("Y") . "-" . date("m") . "-" . date("d"),
					'sekolah_id' => $id
				];
			} else if ($variable == 3) {
				$data = [
					'laporan_nama' => $user->user_nama,
					'laporan_jenis' => "Koleksi",
					'laporan_catatan' => "Laporan Tahunan Selesai",
					'laporan_tanggal' => date("Y") . "-" . date("m") . "-" . date("d"),
					'sekolah_id' => $id
				];
			} else if ($variable == 4) {
				$data = [
					'laporan_nama' => $user->user_nama,
					'laporan_jenis' => "Person",
					'laporan_catatan' => "Laporan Tahunan Selesai",
					'laporan_tanggal' => date("Y") . "-" . date("m") . "-" . date("d"),
					'sekolah_id' => $id
				];
			} else {
				$data = [
					'laporan_nama' => $user->user_nama,
					'laporan_jenis' => "-",
					'laporan_catatan' => "-",
					'laporan_tanggal' => date("Y") . "-" . date("m") . "-" . date("d"),
					'sekolah_id' => $id
				];
		}
			$query = $this->M_data->insertData($data, "tb_laporan_data_sekolah");
			if ($query) {
				$this->session->set_flashdata('pesan', '<script>sweet("Sukses","Semua data sekolah berhasil dilaporkan ke Pemda!","success","Tutup")</script>');
				redirect("perpus_check/" . $id); 
			} else {
				$this->session->set_flashdata('pesan', '<script>sweet("Gagal","Query failed!","error","Tutup")</script>');
				redirect("perpus_check/" . $id); 
			}
  }

  public function process_perpus_delete($id,$sekolah_id)
  {
    $perpus_id = (int)$this->db->escape_str($id);
    $check = $this->M_data->deleteData(["perpus_id" => $perpus_id], "tb_perpus");
		
    if ($check) {
      $this->M_data->deleteData(["perpus_id" => $perpus_id], "tb_perpus");
      $this->session->set_flashdata('pesan', '<script>sweet("Sukses","Data perpustakaan berhasil dihapus!","success","Tutup")</script>');
      redirect("perpus_check/".$sekolah_id); 
    } else {
      $this->session->set_flashdata('pesan', '<script>sweet("Gagal","Query failed!","error","Tutup")</script>');
      redirect("perpus_check/".$sekolah_id); 
    }
  }

  public function process_sarana_delete($id,$sekolah_id)
  {
    $sarana_id = (int)$this->db->escape_str($id);
    $check = $this->M_data->deleteData(["sarana_id" => $sarana_id], "tb_sarana");
    if ($check) {
      $this->M_data->deleteData(["sarana_id" => $sarana_id], "tb_sarana");
      $this->session->set_flashdata('pesan', '<script>sweet("Sukses","Data sarana-prasarana berhasil dihapus!","success","Tutup")</script>');
      $sekolahCheck = (int)$this->input->post("sekolah_id");
      redirect("perpus_check/".$sekolah_id."#saranaTab"); 
    } else {
      $this->session->set_flashdata('pesan', '<script>sweet("Gagal","Query failed!","error","Tutup")</script>');
      $sekolahCheck = (int)$this->input->post("sekolah_id");
      redirect("perpus_check/".$sekolah_id."#saranaTab"); 
    }
  }

  public function process_koleksi_delete($id,$sekolah_id)
  {
    $koleksi_id = (int)$this->db->escape_str($id);
    $check = $this->M_data->deleteData(["koleksi_id" => $koleksi_id], "tb_koleksi");
    if ($check) {
      $this->M_data->deleteData(["koleksi_id" => $koleksi_id], "tb_koleksi");
      $this->session->set_flashdata('pesan', '<script>sweet("Sukses","Data koleksi berhasil dihapus!","success","Tutup")</script>');
      redirect("perpus_check/".$sekolah_id."#koleksiTab"); 
    } else {
      $this->session->set_flashdata('pesan', '<script>sweet("Gagal","Query failed!","error","Tutup")</script>');
      redirect("perpus_check/".$sekolah_id."#koleksiTab"); 
    }
  }

  public function process_person_delete($id,$sekolah_id)
  {
    $person_id = (int)$this->db->escape_str($id);
    $check = $this->M_data->deleteData(["person_id" => $person_id], "tb_person");
    if ($check) {
      $this->M_data->deleteData(["person_id" => $person_id], "tb_person");
      $this->session->set_flashdata('pesan', '<script>sweet("Sukses","Data person berhasil dihapus!","success","Tutup")</script>');
      redirect("perpus_check/".$sekolah_id."#personTab"); 
    } else {
      $this->session->set_flashdata('pesan', '<script>sweet("Gagal","Query failed!","error","Tutup")</script>');
      redirect("perpus_check/".$sekolah_id."#personTab"); 
    }
  }
}
