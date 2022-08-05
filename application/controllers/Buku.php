<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');
require('./application/third_party/phpoffice/vendor/autoload.php');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Buku extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
    protek_login();
    genBooking();
    if ($this->session->userdata("role_id") == 3 ) {
      redirect("block");
    }
  }

  public function view_katalog()
  {
    $data = [
      'title' => 'Data Katalog',
      'menu' => $this->M_data->get_access_menu()->result_array(),
      'user' => $this->M_data->editData(['user_id' => $this->session->userdata('admin_id')],'tb_user')->row(),
      'list_katalog' => $this->M_data->getData("tb_buku")->result()
    ];
    $this->load->view('template/v_head', $data);
    $this->load->view('admin/v_katalogBuku', $data);
    $this->load->view('template/v_footer');
  }

  public function validation_katalog_add()
  {
    $this->form_validation->set_rules('buku_author', 'Buku', 'required');
    $this->form_validation->set_rules('buku_badanKoorporasi', 'Buku', 'required');
    $this->form_validation->set_rules('buku_seminar', 'Buku', 'required');
    $this->form_validation->set_rules('buku_judulSeragam', 'Buku', 'required');
    $this->form_validation->set_rules('buku_judul', 'Buku', 'required');
    $this->form_validation->set_rules('buku_penulis', 'Buku', 'required');
    $this->form_validation->set_rules('buku_edisi', 'Buku', 'required');
    $this->form_validation->set_rules('buku_kota', 'Buku', 'required');
    $this->form_validation->set_rules('buku_penerbit', 'Buku', 'required');
    $this->form_validation->set_rules('buku_tahunTerbit', 'Buku', 'required|numeric');
    $this->form_validation->set_rules('buku_kolasi', 'Buku', 'required');
    $this->form_validation->set_rules('buku_seri', 'Buku', 'required');
    $this->form_validation->set_rules('buku_judulAsli', 'Buku', 'required');
    $this->form_validation->set_rules('buku_catatan', 'Buku', 'required');
    $this->form_validation->set_rules('buku_blibiografi', 'Buku', 'required');
    $this->form_validation->set_rules('buku_indeks', 'Buku', 'required');
    $this->form_validation->set_rules('buku_isbn', 'Buku', 'required');
    $this->form_validation->set_rules('buku_noSKU', 'Buku', 'required|numeric');
    $this->form_validation->set_rules('buku_stok', 'Buku', 'required|numeric');
    $this->form_validation->set_rules('buku_rak', 'Buku', 'required');
    $this->form_validation->set_rules('buku_sumber1', 'Buku', 'required');
    $this->form_validation->set_rules('buku_keterangan', 'Buku', 'required');
    $this->form_validation->set_rules('buku_tahunAnggaran', 'Buku', 'required|numeric');
    
    if ($this->form_validation->run() == FALSE) {
      $this->session->set_flashdata('pesan', '<script>sweet("Gagal", "Dikarenakan data tidak lengkap / di isi dengan benar!", "error", "tutup")</script>');
      redirect('katalogBuku');
    } else {
      $this->process_katalog_add();
    }
  }

  private function process_katalog_add()
  {
    $input = (object)html_escape($this->db->escape_str($this->input->post()));
    $data = [
      "buku_author" => $input->buku_author,
      "buku_badanKoorporasi" => $input->buku_badanKoorporasi,
      "buku_seminar" => $input->buku_seminar,
      "buku_judulSeragam" => $input->buku_judulSeragam,
      "buku_judul" => $input->buku_judul,
      "buku_penulis" => $input->buku_penulis,
      "buku_edisi" => $input->buku_edisi,
      "buku_kota" => $input->buku_kota,
      "buku_penerbit" => $input->buku_penerbit,
      "buku_tahunTerbit" => $input->buku_tahunTerbit,
      "buku_kolasi" => $input->buku_kolasi,
      "buku_seri" => $input->buku_seri,
      "buku_judulAsli" => $input->buku_judulAsli,
      "buku_catatan" => $input->buku_catatan,
      "buku_blibiografi" => $input->buku_blibiografi,
      "buku_indeks" => $input->buku_indeks,
      "buku_isbn" => $input->buku_isbn,
      "buku_noSKU" => $input->buku_noSKU,
      "buku_stok" => $input->buku_stok,
      "buku_jumlah" => $input->buku_stok,
      "buku_rak" => $input->buku_rak,
      "buku_sumber1" => $input->buku_sumber1,
      "buku_keterangan" => $input->buku_keterangan,
      "buku_tahunAnggaran" => $input->buku_tahunAnggaran,
      "buku_foto" => "default.jpg"
    ];
    $check = $this->M_data->insertData($data, "tb_buku");
    if ($check) {
      $this->session->set_flashdata('pesan', '<script>sweet("Sukses", "Katalog berhasil ditambahkan!", "success", "tutup")</script>');
      redirect('katalogBuku');
    } else {
      $this->session->set_flashdata('pesan', '<script>sweet("Gagal", "Query failed!", "error", "tutup")</script>');
      redirect('katalogBuku');
    }
  }

  public function process_katalog_delete($id)
  {
    $buku_id = (int)$this->db->escape_str($id);
    $check = $this->M_data->deleteData(["buku_id" => $buku_id], "tb_buku");
    if ($check) {
      $this->session->set_flashdata('pesan', '<script>sweet("Sukses", "Katalog berhasil dihapus!", "success", "tutup")</script>');
      redirect('katalogBuku');
    } else {
      $this->session->set_flashdata('pesan', '<script>sweet("Gagal", "Query failed!", "error", "tutup")</script>');
      redirect('katalogBuku');
    }
  }

  public function katalog_edit($id)
  {
    $buku_id = (int)$this->db->escape_str($id);
    $check = $this->M_data->editData(["buku_id" => $buku_id], "tb_buku");
    if ($check) {
      $data = [
        'title' => 'Katalog Buku',
        'menu' => $this->M_data->get_access_menu()->result_array(),
        'user' => $this->M_data->editData(['user_id' => $this->session->userdata('admin_id')],'tb_user')->row(),
        'katalog' => $check->row()
      ];
      $this->load->view('template/v_head', $data);
      $this->load->view('admin/v_editKatalog', $data);
      $this->load->view('template/v_footer');
    }
  }

  public function validation_katalog_edit()
  {
    $this->form_validation->set_rules('buku_author', 'Buku', 'required');
    $this->form_validation->set_rules('buku_badanKoorporasi', 'Buku', 'required');
    $this->form_validation->set_rules('buku_seminar', 'Buku', 'required');
    $this->form_validation->set_rules('buku_judulSeragam', 'Buku', 'required');
    $this->form_validation->set_rules('buku_judul', 'Buku', 'required');
    $this->form_validation->set_rules('buku_penulis', 'Buku', 'required');
    $this->form_validation->set_rules('buku_edisi', 'Buku', 'required');
    $this->form_validation->set_rules('buku_kota', 'Buku', 'required');
    $this->form_validation->set_rules('buku_penerbit', 'Buku', 'required');
    $this->form_validation->set_rules('buku_tahunTerbit', 'Buku', 'required|numeric');
    $this->form_validation->set_rules('buku_kolasi', 'Buku', 'required');
    $this->form_validation->set_rules('buku_seri', 'Buku', 'required');
    $this->form_validation->set_rules('buku_judulAsli', 'Buku', 'required');
    $this->form_validation->set_rules('buku_catatan', 'Buku', 'required');
    $this->form_validation->set_rules('buku_blibiografi', 'Buku', 'required');
    $this->form_validation->set_rules('buku_indeks', 'Buku', 'required');
    $this->form_validation->set_rules('buku_isbn', 'Buku', 'required');
    $this->form_validation->set_rules('buku_noSKU', 'Buku', 'required|numeric');
    $this->form_validation->set_rules('buku_stok', 'Buku', 'required|numeric');
    $this->form_validation->set_rules('buku_jumlah', 'Buku', 'required|numeric');
    $this->form_validation->set_rules('buku_rak', 'Buku', 'required');
    $this->form_validation->set_rules('buku_sumber1', 'Buku', 'required');
    $this->form_validation->set_rules('buku_keterangan', 'Buku', 'required');
    $this->form_validation->set_rules('buku_tahunAnggaran', 'Buku', 'required|numeric');
    $buku_id = html_escape($this->db->escape_str($this->input->post("buku_id")));
    
    if ($this->form_validation->run() == FALSE) {
      $this->session->set_flashdata('pesan', '<script>sweet("Gagal", "Dikarenakan data tidak lengkap / di isi dengan benar!", "error", "tutup")</script>');
      redirect('edit_katalog/'.$buku_id);
    } else {
      $this->process_katalog_update();
    }
  }

  private function process_katalog_update()
  {
    $input = (object)html_escape($this->db->escape_str($this->input->post()));
    $buku_foto = $_FILES["buku_foto"]["name"];

    if ($buku_foto != "") {
      $check = $this->M_data->editData(["buku_id" => $input->buku_id], "tb_buku")->row();
      // var_dump($input->petugas_id);
      if ($check->buku_foto != "default.jpg") {
        unlink("./vendor/img/buku/".$check->buku_foto);
      }
      $config['upload_path']          = './vendor/img/buku/';
      $config['allowed_types']        = 'jpg|png|jpeg';
      $config['max_size']             = 5024;
      $config['max_width']            = 2048;
      $config['max_height']           = 1512;

      $this->load->library('upload');
      $this->upload->initialize($config);
      if (!$this->upload->do_upload('buku_foto')) {
        $this->session->set_flashdata('pesan', '<script>sweet("Gagal","Gagal upload foto!","error","Tutup")</script>');
        redirect('katalog_edit/'.$input->buku_id);
      }
      $data = ["buku_foto" => $buku_foto];
      $where = ["buku_id" => $input->buku_id];
      $this->M_data->updateData($data, $where, "tb_buku");
    }
    $data = [
      "buku_author" => $input->buku_author,
      "buku_badanKoorporasi" => $input->buku_badanKoorporasi,
      "buku_seminar" => $input->buku_seminar,
      "buku_judulSeragam" => $input->buku_judulSeragam,
      "buku_judul" => $input->buku_judul,
      "buku_penulis" => $input->buku_penulis,
      "buku_edisi" => $input->buku_edisi,
      "buku_kota" => $input->buku_kota,
      "buku_penerbit" => $input->buku_penerbit,
      "buku_tahunTerbit" => $input->buku_tahunTerbit,
      "buku_kolasi" => $input->buku_kolasi,
      "buku_seri" => $input->buku_seri,
      "buku_judulAsli" => $input->buku_judulAsli,
      "buku_catatan" => $input->buku_catatan,
      "buku_blibiografi" => $input->buku_blibiografi,
      "buku_indeks" => $input->buku_indeks,
      "buku_isbn" => $input->buku_isbn,
      "buku_noSKU" => $input->buku_noSKU,
      "buku_stok" => $input->buku_stok,
      "buku_jumlah" => $input->buku_jumlah,
      "buku_rak" => $input->buku_rak,
      "buku_sumber1" => $input->buku_sumber1,
      "buku_keterangan" => $input->buku_keterangan,
      "buku_tahunAnggaran" => $input->buku_tahunAnggaran
    ];
    $where = ["buku_id" => $input->buku_id];
    $check = $this->M_data->updateData($data, $where, "tb_buku");
    if ($check) {
      $this->session->set_flashdata('pesan', '<script>sweet("Sukses", "Katalog berhasil ditambahkan!", "success", "tutup")</script>');
      redirect('katalogBuku');
    } else {
      $this->session->set_flashdata('pesan', '<script>sweet("Gagal", "Query failed!", "error", "tutup")</script>');
      redirect('edit_katalog/'.$input->buku_id);
    }
  }

  public function view_buku()
  {
    $data = [
      'title' => 'Data Buku',
      'menu' => $this->M_data->get_access_menu()->result_array(),
      'user' => $this->M_data->editData(['user_id' => $this->session->userdata('admin_id')],'tb_user')->row(),
      'list_katalog' => $this->M_data->getData("tb_buku")->result(),
			'katalog_aktif' => $this->M_data->editData(['buku_status' => 1], 'tb_buku')->result(),
			'katalog_nonaktif' => $this->M_data->editData(['buku_status' => 0], 'tb_buku')->result(),
    ];
    $this->load->view('template/v_head', $data);
    $this->load->view('admin/v_dataBuku', $data);
    $this->load->view('template/v_footer');
  }

	public function view_buku1()
	{
		$data = [
			'title' => 'Data Buku',
			'menu' => $this->M_data->get_access_menu()->result_array(),
			'user' => $this->M_data->editData(['user_id' => $this->session->userdata('admin_id')], 'tb_user')->row(),
			'list_katalog' => $this->M_data->getData("tb_buku")->result(),
			'katalog_aktif' => $this->M_data->editData(['buku_status' => 1], 'tb_buku')->result(),
			'katalog_nonaktif' => $this->M_data->editData(['buku_status' => 0], 'tb_buku')->result(),
		];
		$this->load->view('template/v_head', $data);
		$this->load->view('admin/v_dataBuku1', $data);
		$this->load->view('template/v_footer');
	}

	public function view_buku2()
	{
		$data = [
			'title' => 'Data Buku',
			'menu' => $this->M_data->get_access_menu()->result_array(),
			'user' => $this->M_data->editData(['user_id' => $this->session->userdata('admin_id')], 'tb_user')->row(),
			'list_katalog' => $this->M_data->getData("tb_buku")->result(),
			'katalog_aktif' => $this->M_data->editData(['buku_status' => 1], 'tb_buku')->result(),
			'katalog_nonaktif' => $this->M_data->editData(['buku_status' => 0], 'tb_buku')->result(),
		];
		$this->load->view('template/v_head', $data);
		$this->load->view('admin/v_dataBuku2', $data);
		$this->load->view('template/v_footer');
	}
	
	public function process_buku_check($id)
	{
		$cek = $this->M_data->editData(["buku_id" => $id], "tb_buku")->row();
		if ($cek->buku_status == 1){
			$data = [
				"buku_status" => 0
			];
		} else {
			$data = [
				"buku_status" => 1
			];
		}
		$where = ["buku_id" => $id];
		$check = $this->M_data->updateData($data, $where, "tb_buku");
		if ($check) {
			$this->session->set_flashdata('pesan', '<script>sweet("Sukses", "Status berhasil diubah!", "success", "tutup")</script>');
			redirect('dataBuku');
		} else {
			$this->session->set_flashdata('pesan', '<script>sweet("Gagal", "Query failed!", "error", "tutup")</script>');
			redirect('dataBuku');
		}
	}

  public function export_buku()
  {
    $this->load->library('dompdf_gen');
    $data = [
      'title' => 'Cetak Data Buku',
      'list_katalog' => $this->M_data->getData("tb_buku")->result()    
    ];
    $this->load->view('admin/v_pdfBuku', $data);
    
    $uk_kertas = 'A4';
    $orientasi = 'landscape';
    $html = $this->output->get_output();
    $this->dompdf->set_paper($uk_kertas,$orientasi);

    $this->dompdf->load_html($html);
    $this->dompdf->render();
    $this->dompdf->stream('Data_buku.pdf',['Attachment' => 1]);
  }

  public function export_katalog()
  {
    $list_katalog = $this->M_data->getData("tb_buku")->result();

    $spreadsheet = new Spreadsheet;

    $spreadsheet->setActiveSheetIndex(0)
      ->setCellValue('A1', 'Nomor')
      ->setCellValue('B1', 'Author')
      ->setCellValue('C1', 'Badan Koorporasi')
      ->setCellValue('D1', 'Seminar')
      ->setCellValue('E1', 'Judul Seragam')
      ->setCellValue('F1', 'Judul')
      ->setCellValue('G1', 'Penulis')
      ->setCellValue('H1', 'Edisi')
      ->setCellValue('I1', 'Kota')
      ->setCellValue('J1', 'Penerbit')
      ->setCellValue('K1', 'Tahun Terbit')
      ->setCellValue('L1', 'Kolasi')
      ->setCellValue('M1', 'Seri')
      ->setCellValue('N1', 'Judul Asli')
      ->setCellValue('O1', 'Catatan')
      ->setCellValue('P1', 'Blibiografi')
      ->setCellValue('Q1', 'Indeks')
      ->setCellValue('R1', 'ISBN')
      ->setCellValue('S1', 'Kelas')
      ->setCellValue('T1', 'Stok')
      ->setCellValue('U1', 'Jumlah')
      ->setCellValue('V1', 'Rak')
      ->setCellValue('W1', 'Sumber Pertama')
      ->setCellValue('X1', 'Keterangan')
      ->setCellValue('Y1', 'Tahun Anggaran');

    $kolom = 2;
    $nomor = 1;
    foreach ($list_katalog as $item) {

      $spreadsheet->setActiveSheetIndex(0)
        ->setCellValue('A' . $kolom, $nomor)
        ->setCellValue('B' . $kolom, $item->buku_author)
        ->setCellValue('C' . $kolom, $item->buku_badanKoorporasi)
        ->setCellValue('D' . $kolom, $item->buku_seminar)
        ->setCellValue('E' . $kolom, $item->buku_judulSeragam)
        ->setCellValue('F' . $kolom, $item->buku_judul)
        ->setCellValue('G' . $kolom, $item->buku_penulis)
        ->setCellValue('H' . $kolom, $item->buku_edisi)
        ->setCellValue('I' . $kolom, $item->buku_kota)
        ->setCellValue('J' . $kolom, $item->buku_penerbit)
        ->setCellValue('K' . $kolom, $item->buku_tahunTerbit)
        ->setCellValue('L' . $kolom, $item->buku_kolasi)
        ->setCellValue('M' . $kolom, $item->buku_seri)
        ->setCellValue('N' . $kolom, $item->buku_judulAsli)
        ->setCellValue('O' . $kolom, $item->buku_catatan)
        ->setCellValue('P' . $kolom, $item->buku_blibiografi)
        ->setCellValue('Q' . $kolom, $item->buku_indeks)
        ->setCellValue('R' . $kolom, $item->buku_isbn)
        ->setCellValue('S' . $kolom, $item->buku_noSKU)
        ->setCellValue('T' . $kolom, $item->buku_stok)
        ->setCellValue('U' . $kolom, $item->buku_jumlah)
        ->setCellValue('V' . $kolom, $item->buku_rak)
        ->setCellValue('W' . $kolom, $item->buku_sumber1)
        ->setCellValue('X' . $kolom, $item->buku_keterangan)
        ->setCellValue('Y' . $kolom, $item->buku_tahunAnggaran);

      $kolom++;
      $nomor++;
    }

    $writer = new Xlsx($spreadsheet);

    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename="Data_katalog.xlsx"');
    header('Cache-Control: max-age=0');

    $writer->save('php://output');
  }

  public function import_katalog()
  {
    include APPPATH . 'third_party/PHPExcel/PHPExcel.php';

    $config['upload_path'] = realpath('./vendor/file/');
    $config['allowed_types'] = 'xlsx|xls|csv';
    $config['max_size'] = '10000';
    $config['encrypt_name'] = true;

    $this->load->library('upload');
    $this->upload->initialize($config);

    if (!$this->upload->do_upload('import_katalog')) {
      $this->session->set_flashdata('pesan', '<script>sweet("Gagal","File excel gagal diunggah!","error","Tutup")</script>');
      redirect('dataKatalog');
    } else {

      $data_upload = $this->upload->data();

      $excelreader     = new PHPExcel_Reader_Excel2007();
      $loadexcel         = $excelreader->load('./vendor/file/' . $data_upload['file_name']); // Load file yang telah diunggah ke folder excel
      $sheet             = $loadexcel->getActiveSheet()->toArray(null, true, true, true);

      $data = array();

      $numrow = 1;
      foreach ($sheet as $row) {
        if ($numrow > 1) {

          array_push($data, array(
            "buku_author" => $row["B"],
            "buku_badanKoorporasi" => $row["C"],
            "buku_seminar" => $row["D"],
            "buku_judulSeragam" => $row["E"],
            "buku_judul" => $row["F"],
            "buku_penulis" => $row["G"],
            "buku_edisi" => $row["H"],
            "buku_kota" => $row["I"],
            "buku_penerbit" => $row["J"],
            "buku_tahunTerbit" => $row["K"],
            "buku_kolasi" => $row["L"],
            "buku_seri" => $row["M"],
            "buku_judulAsli" => $row["N"],
            "buku_catatan" => $row["O"],
            "buku_blibiografi" => $row["P"],
            "buku_indeks" => $row["Q"],
            "buku_isbn" => $row["R"],
            "buku_noSKU" => $row["S"],
            "buku_stok" => $row["T"],
            "buku_jumlah" => $row["U"],
            "buku_rak" => $row["V"],
            "buku_sumber1" => $row["W"],
            "buku_keterangan" => $row["X"],
            "buku_tahunAnggaran" => $row["Y"],
            "buku_foto" => "default.jpg"
          ));

        }
        $numrow++;
      }
      $this->db->insert_batch('tb_buku', $data);
      //delete file from server
      unlink(realpath('./vendor/file/' . $data_upload['file_name']));

      //upload success
      $this->session->set_flashdata('pesan', '<script>sweet("Sukses","File berhasil diunggah!","success","Tutup")</script>');
      //redirect halaman
      redirect('katalogBuku');
    }
  }

	public function view_kebutuhanpemustaka()
	{
		$data = [
			'title' => 'Kebutuhan Pemustaka',
			'menu' => $this->M_data->get_access_menu()->result_array(),
			'user' => $this->M_data->editData(['user_id' => $this->session->userdata('admin_id')], 'tb_user')->row(),
			'list_kebutuhanpemustaka' => $this->M_data->getData("tb_kebutuhanpemustaka")->result()
		];
		$this->load->view('template/v_head', $data);
		$this->load->view('admin/v_kebutuhanPemustaka', $data);
		$this->load->view('template/v_footer');
	}

	public function validation_kebutuhanpemustaka_add()
	{
		$this->form_validation->set_rules('kebutuhanpemustaka_kunjungan', 'Kuisioner', 'required');
		$this->form_validation->set_rules('kebutuhanpemustaka_jenisKoleksi', 'Kuisioner', 'required');
		$this->form_validation->set_rules('kebutuhanpemustaka_koleksiBidang', 'Kuisioner', 'required');
		$this->form_validation->set_rules('kebutuhanpemustaka_keperluan', 'Kuisioner', 'required');
		$this->form_validation->set_rules('kebutuhanpemustaka_koleksiTerbaru', 'Kuisioner', 'required');
		$this->form_validation->set_rules('kebutuhanpemustaka_koleksiKebutuhan', 'Kuisioner', 'required');
		$this->form_validation->set_rules('kebutuhanpemustaka_ketersediaanKoleksi', 'Kuisioner', 'required');
		$this->form_validation->set_rules('kebutuhanpemustaka_judul', 'Kuisioner', 'required');
		$this->form_validation->set_rules('kebutuhanpemustaka_pengarang', 'Kuisioner', 'required');
		$this->form_validation->set_rules('kebutuhanpemustaka_penerbit', 'Kuisioner', 'required');

		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('pesan', '<script>sweet("Gagal", "Dikarenakan data tidak lengkap / di isi dengan benar!", "error", "tutup")</script>');
			redirect('kebutuhanpemustaka');
		} else {
			$this->process_kebutuhanpemustaka_add();
		}
	}

	private function process_kebutuhanpemustaka_add()
	{
		$input = (object)html_escape($this->db->escape_str($this->input->post()));
		$data1 = [
			"kebutuhanpemustaka_kunjungan" => $input->kebutuhanpemustaka_kunjungan,
			"kebutuhanpemustaka_jenisKoleksi" => $input->kebutuhanpemustaka_jenisKoleksi,
			"kebutuhanpemustaka_koleksiBidang" => $input->kebutuhanpemustaka_koleksiBidang,
			"kebutuhanpemustaka_keperluan" => $input->kebutuhanpemustaka_keperluan,
			"kebutuhanpemustaka_koleksiTerbaru" => $input->kebutuhanpemustaka_koleksiTerbaru,
			"kebutuhanpemustaka_koleksiKebutuhan" => $input->kebutuhanpemustaka_koleksiKebutuhan,
			"kebutuhanpemustaka_ketersediaanKoleksi" => $input->kebutuhanpemustaka_ketersediaanKoleksi,
			"kebutuhanpemustaka_judul" => $input->kebutuhanpemustaka_judul,
			"kebutuhanpemustaka_pengarang" => $input->kebutuhanpemustaka_pengarang,
			"kebutuhanpemustaka_penerbit" => $input->kebutuhanpemustaka_penerbit,
		];
		$data2 = [
			"pengadaan_judul" => $input->kebutuhanpemustaka_judul,
			"pengadaan_pengarang" => $input->kebutuhanpemustaka_pengarang,
			"pengadaan_penerbit" => $input->kebutuhanpemustaka_penerbit,
		];	
		$check1 = $this->M_data->insertData($data1, "tb_kebutuhanpemustaka");
		$check2 = $this->M_data->insertData($data2, "tb_pengadaan");

		if ($check1) {
			if ($check2) {
				$this->session->set_flashdata('pesan', '<script>sweet("Sukses", "Kebutuhan pemustaka berhasil ditambahkan!", "success", "tutup")</script>');
				redirect('kebutuhanpemustaka');
			} else {
				$this->session->set_flashdata('pesan', '<script>sweet("Gagal", "Query failed!", "error", "tutup")</script>');
				redirect('kebutuhanpemustaka');
			}
		} else {
			$this->session->set_flashdata('pesan', '<script>sweet("Gagal", "Query failed!", "error", "tutup")</script>');
			redirect('kebutuhanpemustaka');
		}
	}

	public function process_kebutuhanpemustaka_delete($id)
	{
		$kebutuhanpemustaka_id = (int)$this->db->escape_str($id);
		$check = $this->M_data->deleteData(["kebutuhanpemustaka_id" => $kebutuhanpemustaka_id], "tb_kebutuhanpemustaka");
		if ($check) {
			$this->session->set_flashdata('pesan', '<script>sweet("Sukses", "Kebutuhan pemustaka berhasil dihapus!", "success", "tutup")</script>');
			redirect('kebutuhanpemustaka');
		} else {
			$this->session->set_flashdata('pesan', '<script>sweet("Gagal", "Query failed!", "error", "tutup")</script>');
			redirect('kebutuhanpemustaka');
		}
	}

	public function kebutuhanpemustaka_edit($id)
	{
		$kebutuhanpemustaka_id = (int)$this->db->escape_str($id);
		$check = $this->M_data->editData(["kebutuhanpemustaka_id" => $kebutuhanpemustaka_id], "tb_kebutuhanpemustaka");
		if ($check) {
			$data = [
				'title' => 'Kebutuhan Pemustaka',
				'menu' => $this->M_data->get_access_menu()->result_array(),
				'user' => $this->M_data->editData(['user_id' => $this->session->userdata('admin_id')], 'tb_user')->row(),
				'kebutuhanpemustaka' => $check->row()
			];
			$this->load->view('template/v_head', $data);
			$this->load->view('admin/v_editKebutuhanPemustaka', $data);
			$this->load->view('template/v_footer');
		}
	}

	public function validation_kebutuhanpemustaka_edit()
	{
		$this->form_validation->set_rules('kebutuhanpemustaka_kunjungan', 'Kuisioner', 'required');
		$this->form_validation->set_rules('kebutuhanpemustaka_jenisKoleksi', 'Kuisioner', 'required');
		$this->form_validation->set_rules('kebutuhanpemustaka_koleksiBidang', 'Kuisioner', 'required');
		$this->form_validation->set_rules('kebutuhanpemustaka_keperluan', 'Kuisioner', 'required');
		$this->form_validation->set_rules('kebutuhanpemustaka_koleksiTerbaru', 'Kuisioner', 'required');
		$this->form_validation->set_rules('kebutuhanpemustaka_koleksiKebutuhan', 'Kuisioner', 'required');
		$this->form_validation->set_rules('kebutuhanpemustaka_ketersediaanKoleksi', 'Kuisioner', 'required');
		$kebutuhanpemustaka_id = html_escape($this->db->escape_str($this->input->post("kebutuhanpemustaka_id")));

		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('pesan', '<script>sweet("Gagal", "Dikarenakan data tidak lengkap / di isi dengan benar!", "error", "tutup")</script>');
			redirect('edit_kebutuhanpemustaka/' . $kebutuhanpemustaka_id);
		} else {
			$this->process_kebutuhanpemustaka_update();
		}
	}

	private function process_kebutuhanpemustaka_update()
	{
		$input = (object)html_escape($this->db->escape_str($this->input->post()));
		$data = [
			"kebutuhanpemustaka_kunjungan" => $input->kebutuhanpemustaka_kunjungan,
			"kebutuhanpemustaka_jenisKoleksi" => $input->kebutuhanpemustaka_jenisKoleksi,
			"kebutuhanpemustaka_koleksiBidang" => $input->kebutuhanpemustaka_koleksiBidang,
			"kebutuhanpemustaka_keperluan" => $input->kebutuhanpemustaka_keperluan,
			"kebutuhanpemustaka_koleksiTerbaru" => $input->kebutuhanpemustaka_koleksiTerbaru,
			"kebutuhanpemustaka_koleksiKebutuhan" => $input->kebutuhanpemustaka_koleksiKebutuhan,
			"kebutuhanpemustaka_ketersediaanKoleksi" => $input->kebutuhanpemustaka_ketersediaanKoleksi,
		];
		$where = ["kebutuhanpemustaka_id" => $input->kebutuhanpemustaka_id];
		$check = $this->M_data->updateData($data, $where, "tb_kebutuhanpemustaka");
		if ($check) {
			$this->session->set_flashdata('pesan', '<script>sweet("Sukses", "Kebutuhan pemustaka berhasil diubah!", "success", "tutup")</script>');
			redirect('kebutuhanpemustaka');
		} else {
			$this->session->set_flashdata('pesan', '<script>sweet("Gagal", "Query failed!", "error", "tutup")</script>');
			redirect('edit_kebutuhanpemustaka/' . $input->kebutuhanpemustaka_id);
		}
	}

	public function export_kebutuhanpemustaka()
	{
		$list_kebutuhanpemustaka = $this->M_data->getData("tb_kebutuhanpemustaka")->result();

		$spreadsheet = new Spreadsheet;

		$spreadsheet->setActiveSheetIndex(0)
			->setCellValue('A1', 'Nomor')
			->setCellValue('B1', 'Kunjungan')
			->setCellValue('C1', 'Jenis Koleksi')
			->setCellValue('D1', 'Koleksi Bidang')
			->setCellValue('E1', 'Keperluan')
			->setCellValue('F1', 'Koleksi Terbaru')
			->setCellValue('G1', 'Koleksi Kebutuhan')
			->setCellValue('H1', 'Ketersediaa Koleksi')
			->setCellValue('I1', 'Usulan Judul')
			->setCellValue('J1', 'Usulan Pengarang')
			->setCellValue('K1', 'Usulan Penerbit');

		$kolom = 2;
		$nomor = 1;
		foreach ($list_kebutuhanpemustaka as $item) {

			$spreadsheet->setActiveSheetIndex(0)
				->setCellValue('A' . $kolom, $nomor)
				->setCellValue('B' . $kolom, $item->kebutuhanpemustaka_kunjungan)
				->setCellValue('C' . $kolom, $item->kebutuhanpemustaka_jenisKoleksi)
				->setCellValue('D' . $kolom, $item->kebutuhanpemustaka_koleksiBidang)
				->setCellValue('E' . $kolom, $item->kebutuhanpemustaka_keperluan)
				->setCellValue('F' . $kolom, $item->kebutuhanpemustaka_koleksiTerbaru)
				->setCellValue('G' . $kolom, $item->kebutuhanpemustaka_koleksiKebutuhan)
				->setCellValue('H' . $kolom, $item->kebutuhanpemustaka_ketersediaanKoleksi)
				->setCellValue('I' . $kolom, $item->kebutuhanpemustaka_judul)
				->setCellValue('J' . $kolom, $item->kebutuhanpemustaka_pengarang)
				->setCellValue('K' . $kolom, $item->kebutuhanpemustaka_penerbit);

			$kolom++;
			$nomor++;
		}

		$writer = new Xlsx($spreadsheet);

		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="Data_Survei_Kebutuhan_Pemustaka.xlsx"');
		header('Cache-Control: max-age=0');

		$writer->save('php://output');
	}

	public function import_kebutuhanpemustaka()
	{
		include APPPATH . 'third_party/PHPExcel/PHPExcel.php';

		$config['upload_path'] = realpath('./vendor/file/');
		$config['allowed_types'] = 'xlsx|xls|csv';
		$config['max_size'] = '10000';
		$config['encrypt_name'] = true;

		$this->load->library('upload');
		$this->upload->initialize($config);

		if (!$this->upload->do_upload('import_kebutuhanpemustaka')) {
			$this->session->set_flashdata('pesan', '<script>sweet("Gagal","File excel gagal diunggah!","error","Tutup")</script>');
			redirect('kebutuhanpemustaka');
		} else {

			$data_upload = $this->upload->data();

			$excelreader     = new PHPExcel_Reader_Excel2007();
			$loadexcel         = $excelreader->load('./vendor/file/' . $data_upload['file_name']); // Load file yang telah diunggah ke folder excel
			$sheet             = $loadexcel->getActiveSheet()->toArray(null, true, true, true);

			$data = array();

			$numrow = 1;
			foreach ($sheet as $row) {
				if ($numrow > 1) {

					array_push($data, array(
						"kebutuhanpemustaka_kunjungan" => $row["B"],
						"kebutuhanpemustaka_jenisKoleksi" => $row["C"],
						"kebutuhanpemustaka_koleksiBidang" => $row["D"],
						"kebutuhanpemustaka_keperluan" => $row["E"],
						"kebutuhanpemustaka_koleksiTerbaru" => $row["F"],
						"kebutuhanpemustaka_koleksiKebutuhan" => $row["G"],
						"kebutuhanpemustaka_ketersediaanKoleksi" => $row["H"],
						"kebutuhanpemustaka_judul" => $row["I"],
						"kebutuhanpemustaka_pengarang" => $row["J"],
						"kebutuhanpemustaka_penerbit" => $row["K"]
					));
				}
				$numrow++;
			}
			$this->db->insert_batch('tb_kebutuhanpemustaka', $data);
			//upload success
			$this->session->set_flashdata('pesan', '<script>sweet("Sukses","File berhasil diunggah!","success","Tutup")</script>');
			//redirect halaman
			redirect('kebutuhanpemustaka');
		}
	}

	public function view_pengadaan()
	{
		$data = [
			'title' => 'Data Pengadaan',
			'menu' => $this->M_data->get_access_menu()->result_array(),
			'user' => $this->M_data->editData(['user_id' => $this->session->userdata('admin_id')], 'tb_user')->row(),
			'list_pengadaan' => $this->M_data->getData("tb_pengadaan")->result()
		];
		$this->load->view('template/v_head', $data);
		$this->load->view('admin/v_pengadaan', $data);
		$this->load->view('template/v_footer');
	}

	public function validation_pengadaan_add()
	{
		$this->form_validation->set_rules('pengadaan_judul', 'Kuisioner', 'required');
		$this->form_validation->set_rules('pengadaan_pengarang', 'Kuisioner', 'required');
		$this->form_validation->set_rules('pengadaan_penerbit', 'Kuisioner', 'required');

		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('pesan', '<script>sweet("Gagal", "Dikarenakan data tidak lengkap / di isi dengan benar!", "error", "tutup")</script>');
			redirect('pengadaan');
		} else {
			$this->process_pengadaan_add();
		}
	}

	private function process_pengadaan_add()
	{
		$input = (object)html_escape($this->db->escape_str($this->input->post()));
		$data = [
			"pengadaan_judul" => $input->pengadaan_judul,
			"pengadaan_pengarang" => $input->pengadaan_pengarang,
			"pengadaan_penerbit" => $input->pengadaan_penerbit,
		];
		$check = $this->M_data->insertData($data, "tb_pengadaan");
		if ($check) {
			$this->session->set_flashdata('pesan', '<script>sweet("Sukses", "Data pengadaan berhasil ditambahkan!", "success", "tutup")</script>');
			redirect('pengadaan');
		} else {
			$this->session->set_flashdata('pesan', '<script>sweet("Gagal", "Query failed!", "error", "tutup")</script>');
			redirect('pengadaan');
		}
	}

	public function process_pengadaan_delete($id)
	{
		$pengadaan_id = (int)$this->db->escape_str($id);
		$check = $this->M_data->deleteData(["pengadaan_id" => $pengadaan_id], "tb_pengadaan");
		if ($check) {
			$this->session->set_flashdata('pesan', '<script>sweet("Sukses", "Data pengadaan berhasil dihapus!", "success", "tutup")</script>');
			redirect('pengadaan');
		} else {
			$this->session->set_flashdata('pesan', '<script>sweet("Gagal", "Query failed!", "error", "tutup")</script>');
			redirect('pengadaan');
		}
	}

	public function pengadaan_edit($id)
	{
		$pengadaan_id = (int)$this->db->escape_str($id);
		$check = $this->M_data->editData(["pengadaan_id" => $pengadaan_id], "tb_pengadaan");
		if ($check) {
			$data = [
				'title' => 'Data Pengadaan',
				'menu' => $this->M_data->get_access_menu()->result_array(),
				'user' => $this->M_data->editData(['user_id' => $this->session->userdata('admin_id')], 'tb_user')->row(),
				'pengadaan' => $check->row()
			];
			$this->load->view('template/v_head', $data);
			$this->load->view('admin/v_editPengadaan', $data);
			$this->load->view('template/v_footer');
		}
	}

	public function validation_pengadaan_edit()
	{
		$this->form_validation->set_rules('pengadaan_judul', 'Kuisioner', 'required');
		$this->form_validation->set_rules('pengadaan_pengarang', 'Kuisioner', 'required');
		$this->form_validation->set_rules('pengadaan_penerbit', 'Kuisioner', 'required');
		$pengadaan_id = html_escape($this->db->escape_str($this->input->post("pengadaan_id")));

		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('pesan', '<script>sweet("Gagal", "Dikarenakan data tidak lengkap / di isi dengan benar!", "error", "tutup")</script>');
			redirect('edit_pengadaan/' . $pengadaan_id);
		} else {
			$this->process_pengadaan_update();
		}
	}

	private function process_pengadaan_update()
	{
		$input = (object)html_escape($this->db->escape_str($this->input->post()));
		$data = [
			"pengadaan_judul" => $input->pengadaan_judul,
			"pengadaan_pengarang" => $input->pengadaan_pengarang,
			"pengadaan_penerbit" => $input->pengadaan_penerbit,
		];
		$where = ["pengadaan_id" => $input->pengadaan_id];
		$check = $this->M_data->updateData($data, $where, "tb_pengadaan");
		if ($check) {
			$this->session->set_flashdata('pesan', '<script>sweet("Sukses", "Data pengadaan berhasil diubah!", "success", "tutup")</script>');
			redirect('pengadaan');
		} else {
			$this->session->set_flashdata('pesan', '<script>sweet("Gagal", "Query failed!", "error", "tutup")</script>');
			redirect('edit_pengadaan/' . $input->pengadaan_id);
		}
	}

	public function export_pengadaan()
	{
		$list_pengadaan = $this->M_data->getData("tb_pengadaan")->result();

		$spreadsheet = new Spreadsheet;

		$spreadsheet->setActiveSheetIndex(0)
		->setCellValue('A1', 'Nomor')
		->setCellValue('B1', 'Judul')
		->setCellValue('C1', 'Pengarang')
		->setCellValue('D1', 'Penerbit');

		$kolom = 2;
		$nomor = 1;
		foreach ($list_pengadaan as $item) {

			$spreadsheet->setActiveSheetIndex(0)
				->setCellValue('A' . $kolom, $nomor)
				->setCellValue('B' . $kolom, $item->pengadaan_judul)
				->setCellValue('C' . $kolom, $item->pengadaan_pengarang)
				->setCellValue('D' . $kolom, $item->pengadaan_penerbit);

			$kolom++;
			$nomor++;
		}

		$writer = new Xlsx($spreadsheet);

		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="Data_Pengadaan_Buku.xlsx"');
		header('Cache-Control: max-age=0');

		$writer->save('php://output');
	}

	public function import_pengadaan()
	{
		include APPPATH . 'third_party/PHPExcel/PHPExcel.php';

		$config['upload_path'] = realpath('./vendor/file/');
		$config['allowed_types'] = 'xlsx|xls|csv';
		$config['max_size'] = '10000';
		$config['encrypt_name'] = true;

		$this->load->library('upload');
		$this->upload->initialize($config);

		if (!$this->upload->do_upload('import_pengadaan')) {
			$this->session->set_flashdata('pesan', '<script>sweet("Gagal","File excel gagal diunggah!","error","Tutup")</script>');
			redirect('pengadaan');
		} else {

			$data_upload = $this->upload->data();

			$excelreader     = new PHPExcel_Reader_Excel2007();
			$loadexcel         = $excelreader->load('./vendor/file/' . $data_upload['file_name']); // Load file yang telah diunggah ke folder excel
			$sheet             = $loadexcel->getActiveSheet()->toArray(null, true, true, true);

			$data = array();

			$numrow = 1;
			foreach ($sheet as $row) {
				if ($numrow > 1) {

					array_push($data, array(
						"pengadaan_judul" => $row["B"],
						"pengadaan_pengarang" => $row["C"],
						"pengadaan_penerbit" => $row["D"]
					));
				}
				$numrow++;
			}
			$this->db->insert_batch('tb_pengadaan', $data);
			//upload success
			$this->session->set_flashdata('pesan', '<script>sweet("Sukses","File berhasil diunggah!","success","Tutup")</script>');
			//redirect halaman
			redirect('pengadaan');
		}
	}
}
