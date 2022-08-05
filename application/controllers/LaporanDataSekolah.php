<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');
require('./application/third_party/phpoffice/vendor/autoload.php');


use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class LaporanDataSekolah extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
    protek_login();
    genBooking();
    if ($this->session->userdata("role_id") == 3 ) {
      redirect("block");
    } elseif ($this->session->userdata("role_id") == 4) {
			redirect("block");
		}
  }

  public function index()
  {
    $data = [
      'title' => 'Laporan Data Sekolah',
      'menu' => $this->M_data->get_access_menu()->result_array(),
      'user' => $this->M_data->editData(['user_id' => $this->session->userdata('admin_id')],'tb_user')->row(),
			'list_laporan_data_sekolah' => $this->M_data->get_laporan_data_sekolah()->result(),
			'laporan_data_sekolah'	=> $this->M_data->get_laporan_data_sekolah()->row(),
    ];
    $this->load->view('template/v_head', $data);
    $this->load->view('admin/v_laporanDataSekolah', $data);
    $this->load->view('template/v_footer');
  }

  public function export_laporanDataSekolah()
  {
		$list_laporan_data_sekolah = $this->M_data->get_laporan_data_sekolah()->result();

    $spreadsheet = new Spreadsheet;

    $spreadsheet->setActiveSheetIndex(0)
      ->setCellValue('A1', 'No.')
      ->setCellValue('B1', 'Tanggal Kirim')
			->setCellValue('C1', 'ID Sekolah')
      ->setCellValue('D1', 'Nama Sekolah')
      ->setCellValue('E1', 'Jenis Laporan')
			->setCellValue('F1', 'Nama Petugas')
			->setCellValue('G1', 'Catatan');


    $kolom = 2;
    $nomor = 1;
    foreach ($list_laporan_data_sekolah as $item) {
      $spreadsheet->setActiveSheetIndex(0)
        ->setCellValue('A' . $kolom, $nomor)
        ->setCellValue('B' . $kolom, $item->laporan_tanggal)
				->setCellValue('C' . $kolom, $item->sekolah_id)
        ->setCellValue('D' . $kolom, $item->sekolah_nama)
				->setCellValue('E' . $kolom, $item->laporan_jenis)
				->setCellValue('F' . $kolom, $item->laporan_nama)
        ->setCellValue('G' . $kolom, $item->laporan_catatan);
        $kolom++;
        $nomor++;
      }


    $writer = new Xlsx($spreadsheet);

    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename="Laporan_Data_Sekolah.xlsx"');
    header('Cache-Control: max-age=0');

    $writer->save('php://output');
  }

  public function import_laporanDataSekolah()
  {
    include APPPATH . 'third_party/PHPExcel/PHPExcel.php';
    $config['upload_path'] = realpath('./vendor/file/');
    $config['allowed_types'] = 'xlsx|xls|csv';
    $config['max_size'] = '1000000000';
    $config['encrypt_name'] = true;

    $this->load->library('upload');
    $this->upload->initialize($config);

    if (!$this->upload->do_upload('import_laporanDataSekolah')) {
      $this->session->set_flashdata('pesan', '<script>sweet("Gagal","File excel gagal diunggah!","error","Tutup")</script>');
      redirect('laporanDataSekolah');
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
						"laporan_tanggal" => $row["B"],
						"sekolah_id" => $row["C"],
						"laporan_jenis" => $row["E"],
						"laporan_nama" => $row["F"],
						"laporan_catatan" => $row["G"],
          ));
        }
        $numrow++;
      }

       //delete file from server
      unlink(realpath('./vendor/file/' . $data_upload['file_name']));
      $this->db->insert_batch('tb_laporan_data_sekolah', $data);
      //upload success
      $this->session->set_flashdata('pesan', '<script>sweet("Sukses","File berhasil diunggah!","success","Tutup")</script>');
      //redirect halaman
      redirect('laporanDataSekolah');
    }
  }
	public function process_laporanDataSekolah_delete($laporan_id)
	{
		$lapor_id = (int)$this->db->escape_str($laporan_id);
		$check = $this->M_data->deleteData(["laporan_id" => $lapor_id], "tb_laporan_data_sekolah");

		if ($check) {
			$this->session->set_flashdata('pesan', '<script>sweet("Sukses","Data laporan berhasil dihapus!","success","Tutup")</script>');
			redirect("laporanDataSekolah");
		} else {
			$this->session->set_flashdata('pesan', '<script>sweet("Gagal","Query failed!","error","Tutup")</script>');
			redirect("laporanDataSekolah");
		}
	}
 }
