<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');
require('./application/third_party/phpoffice/vendor/autoload.php');


use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Pengunjung extends CI_Controller {

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
		$start = $this->input->post('start_order_date');
		$end = $this->input->post('end_order_date');
    $data = [
      'title' => 'Data Pengunjung',
      'menu' => $this->M_data->get_access_menu()->result_array(),
      'user' => $this->M_data->editData(['user_id' => $this->session->userdata('admin_id')],'tb_user')->row(),
      'list_pengunjung_perpus' => $this->M_data->get_pengunjung_perpus($start, $end)->result(),
			'list_pengunjung_website' => $this->M_data->get_pengunjung_website($start, $end)->result(),
      'pekerjaan' => $this->M_data->getData("tb_klasifikasi")->result(),
    ];
    $this->load->view('template/v_head', $data);
    $this->load->view('admin/v_dataPengunjung', $data);
    $this->load->view('template/v_footer');
  }

  public function validation_pengunjung_add()
  {
    $this->form_validation->set_rules('pengunjung_nama', 'Pengunjung', 'required');
    $this->form_validation->set_rules('pengunjung_jk', 'Pengunjung', 'required');
    $this->form_validation->set_rules('pengunjung_klasifikasi', 'Pengunjung', 'required');
    $this->form_validation->set_rules('pengunjung_info', 'Pengunjung', 'required');
    $this->form_validation->set_rules('pengunjung_alamat', 'Pengunjung', 'required');
    $this->form_validation->set_rules('pengunjung_tanggal', 'Pengunjung', 'required');
    $this->form_validation->set_rules('pengunjung_masuk', 'Pengunjung', 'required');
    
    if ($this->form_validation->run() == FALSE) {
      $this->session->set_flashdata('pesan', '<script>sweet("Gagal", "Dikarenakan data tidak lengkap!", "error", "tutup")</script>');
      redirect("dataPengunjung");
    } else {
      $this->process_pengunjung_add();
    }
  }

  private function process_pengunjung_add()
  {
    $input = (object)$this->db->escape_str($this->input->post());
    $data1 = [
      'pengunjung_nama' => $input->pengunjung_nama,
      'pengunjung_jk' => $input->pengunjung_jk,
      'pengunjung_klasifikasi' => $input->pengunjung_klasifikasi,
      'pengunjung_info' => $input->pengunjung_info,
      'pengunjung_alamat' => $input->pengunjung_alamat,
      'pengunjung_tanggal' => $input->pengunjung_tanggal,
      'pengunjung_masuk' => $input->pengunjung_masuk,
    ];
    $query = $this->M_data->insertData($data1, "tb_pengunjung_perpus");
    $user_id = $this->db->insert_id();
    if ($query) {
          $this->session->set_flashdata('pesan', '<script>sweet("Sukses", "Data pengunjung berhasil ditambahkan!", "success", "tutup")</script>');
          redirect("dataPengunjung");
        } else {
          $this->session->set_flashdata('pesan', '<script>sweet("Gagal", "Query failed!", "success", "tutup")</script>');
          redirect("dataPengunjung");
        } 
    }

  public function view_pengunjung_edit($id)
  {
    $pengunjung_id = (int)$this->db->escape_str($id);
    $check = $this->M_data->get_pengunjung_detail($pengunjung_id);
    if ($check) {
      $data = [
        'title' => 'Data pengunjung',
        'menu' => $this->M_data->get_access_menu()->result_array(),
        'user' => $this->M_data->editData(['user_id' => $this->session->userdata('admin_id')],'tb_user')->row(),
        'pengunjung_detail' => $check->row()
      ];
      $this->load->view('template/v_head', $data);
      $this->load->view('admin/v_editPengunjung', $data);
      $this->load->view('template/v_footer');
    } else {
      $this->session->set_flashdata('pesan', '<script>sweet("Gagal", "Query failed!", "error", "tutup")</script>');
      redirect("dataPengunjung");
    }
  }

  public function validation_pengunjung_edit()
  {
    $this->form_validation->set_rules('pengunjung_nama', 'Pengunjung', 'required');
    $this->form_validation->set_rules('pengunjung_jk', 'Pengunjung', 'required');
    $this->form_validation->set_rules('pengunjung_klasifikasi', 'Pengunjung', 'required');
    $this->form_validation->set_rules('pengunjung_info', 'Pengunjung', 'required');
    $this->form_validation->set_rules('pengunjung_alamat', 'Pengunjung', 'required');
    $this->form_validation->set_rules('pengunjung_tanggal', 'Pengunjung', 'required');
    $this->form_validation->set_rules('pengunjung_masuk', 'Pengunjung', 'required');
    $pengunjung_id = (int)$this->input->post("pengunjung_id");
    
    if ($this->form_validation->run() == FALSE) {
      $this->session->set_flashdata('pesan', '<script>sweet("Gagal", "Isi data dengan benar & lengkap!", "error", "tutup")</script>');
      redirect("pengunjung_edit/".$pengunjung_id);
    } else {

      $this->process_pengunjung_update();

    }
  }

  private function process_pengunjung_update()
  {
    $input = (object)$this->db->escape_str($this->input->post());    
    $data = [
      'pengunjung_nama' => $input->pengunjung_nama,
      'pengunjung_jk' => $input->pengunjung_jk,
      'pengunjung_klasifikasi' => $input->pengunjung_klasifikasi,
      'pengunjung_info' => $input->pengunjung_info,
      'pengunjung_alamat' => $input->pengunjung_alamat,
      'pengunjung_tanggal' => $input->pengunjung_tanggal,
      'pengunjung_masuk' => $input->pengunjung_masuk,
    ];
    $where1 = ["pengunjung_id" => $input->pengunjung_id];
    $query = $this->M_data->updateData($data, $where1, "tb_pengunjung_perpus");
    if ($query) {
          $this->session->set_flashdata('pesan', '<script>sweet("Sukses","Data pengunjung berhasil diubah!","success","Tutup")</script>');
          redirect("dataPengunjung");
        } else {
        $this->session->set_flashdata('pesan', '<script>sweet("Gagal","Query failed!","error","Tutup")</script>');
        redirect('pengunjung_edit/'.$input->pengunjung_id);
      }
  }

  public function process_pengunjung_delete($id)
  {
    $pengunjung_id = (int)$this->db->escape_str($id);
    $get_pengunjung = $this->M_data->editData(["pengunjung_id" => $pengunjung_id], "tb_pengunjung_perpus")->row();
    $check = $this->M_data->deleteData(["pengunjung_id" => $pengunjung_id], "tb_pengunjung_perpus");
    if ($check) {
      $this->session->set_flashdata('pesan', '<script>sweet("Sukses","Data petugas berhasil dihapus!","success","Tutup")</script>');
      redirect("dataPengunjung");
    } else {
      $this->session->set_flashdata('pesan', '<script>sweet("Gagal","Query failed!","success","Tutup")</script>');
      redirect("dataPengunjung");
    }
  }

  public function export_pengunjung()
  {
    $list_pengunjung = $this->M_data->getData("tb_pengunjung_perpus")->result();

    $spreadsheet = new Spreadsheet;

    $spreadsheet->setActiveSheetIndex(0)
      ->setCellValue('A1', 'No.')
      ->setCellValue('B1', 'Tanggal')
      ->setCellValue('C1', 'Nama')
      ->setCellValue('D1', 'JK')
      ->setCellValue('E1', 'Klasifikasi')
      ->setCellValue('F1', 'Info')
      ->setCellValue('G1', 'Masuk')
      ->setCellValue('H1', 'Alamat');
    $kolom = 2;
    $nomor = 1;
    foreach ($list_pengunjung as $item) {
        if ($item->pengunjung_klasifikasi == 1) {
          $klasifikasi_data = "TK";
        } elseif ($item->pengunjung_klasifikasi == 2) {
          $klasifikasi_data = "SD";
        } elseif ($item->pengunjung_klasifikasi == 3) {
          $klasifikasi_data = "SMP";
        } elseif ($item->pengunjung_klasifikasi == 4) {
          $klasifikasi_data = "SMA";
        } elseif ($item->pengunjung_klasifikasi == 5) {
          $klasifikasi_data = "Mahasiswa";
        } elseif ($item->pengunjung_klasifikasi == 6) {
          $klasifikasi_data = "PNS";
        } elseif ($item->pengunjung_klasifikasi == 7) {
          $klasifikasi_data = "Karyawan";
        } elseif ($item->pengunjung_klasifikasi == 8) {
          $klasifikasi_data = "Umum";
        } else {
          $klasifikasi_data = "Umum";
        }
        $spreadsheet->setActiveSheetIndex(0)
          ->setCellValue('A' . $kolom, $nomor)
          ->setCellValue('B' . $kolom, $item->pengunjung_tanggal)
          ->setCellValue('C' . $kolom, $item->pengunjung_nama)
          ->setCellValue('D' . $kolom, $item->pengunjung_jk)
          ->setCellValue('E' . $kolom, $klasifikasi_data)
          ->setCellValue('F' . $kolom, $item->pengunjung_info)
          ->setCellValue('G' . $kolom, $item->pengunjung_masuk)
          ->setCellValue('H' . $kolom, $item->pengunjung_alamat);
        $kolom++;
        $nomor++;
    }

    $writer = new Xlsx($spreadsheet);

    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename="Data_anggota.xlsx"');
    header('Cache-Control: max-age=0');

    $writer->save('php://output');
  }

  public function import_pengunjung()
  {
    include APPPATH . 'third_party/PHPExcel/PHPExcel.php';

    $config['upload_path'] = realpath('./vendor/file/');
    $config['allowed_types'] = 'xlsx|xls|csv';
    $config['max_size'] = '1000000000';
    $config['encrypt_name'] = true;

    $this->load->library('upload');
    $this->upload->initialize($config);

    if (!$this->upload->do_upload('import_pengunjung')) {
      $this->session->set_flashdata('pesan', '<script>sweet("Gagal!","File excel gagal diunggah!","error","Tutup")</script>');
      redirect('dataPengunjung');
    } else {

      $data_upload = $this->upload->data();

      $excelreader   = new PHPExcel_Reader_Excel2007();
      $loadexcel     = $excelreader->load('./vendor/file/' . $data_upload['file_name']); // Load file yang telah diunggah ke folder excel
      $sheet         = $loadexcel->getActiveSheet()->toArray(null, true, true, true);

      $data  = array();
      $data1 = array();
      $data2 = array();

      $numrow = 1;
      foreach ($sheet as $row) {
        if ($numrow > 1) {


          if ($row["E"] == "TK") {
            $klasifikasi_data = 1;
          } elseif ($row["E"] == "SD") {
            $klasifikasi_data = 2;
          } elseif ($row["E"] == "SMP") {
            $klasifikasi_data = 3;
          } elseif ($row["E"] == "SMA") {
            $klasifikasi_data = 4;
          } elseif ($row["E"] == "Mahasiswa") {
            $klasifikasi_data = 5;
          } elseif ($row["E"] == "PNS") {
            $klasifikasi_data = 6;
          } elseif ($row["E"] == "Karyawan") {
            $klasifikasi_data = 7;
          } elseif ($row["E"] == "Umum") {
            $klasifikasi_data = 8;
          } else {
            $klasifikasi_data = 8;
          }

          array_push($data, array(
            "pengunjung_tanggal" => $row["B"],
            "pengunjung_nama" => $row["C"],
            "pengunjung_jk" => $row["D"],
            "pengunjung_klasifikasi" => $klasifikasi_data,
            "pengunjung_info" => $row["F"],
            "pengunjung_masuk" => $row["G"],
            "pengunjung_alamat" => $row["H"]
          ));

        }
        $numrow++;
      }

      $this->db->insert_batch('tb_pengunjung_perpus', $data);
      //upload success
      $this->session->set_flashdata('pesan', '<script>sweet("Sukses!","File berhasil diunggah!","success","Tutup")</script>');
      //redirect halaman
      redirect('dataPengunjung');
    }
  }
}
