<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');
require('./application/third_party/phpoffice/vendor/autoload.php');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Website extends CI_Controller {

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
      'title' => 'Website Settings',
      'menu' => $this->M_data->get_access_menu()->result_array(),
      'user' => $this->M_data->editData(['user_id' => $this->session->userdata('admin_id')],'tb_user')->row(),
      'list_katalog' => $this->M_data->getData("tb_buku")->result(),

      'website' => $this->M_data->getData("tb_website")->row()
    ];
    $this->load->view('template/v_head', $data);
    $this->load->view('admin/v_website', $data);
    $this->load->view('template/v_footer');
  }

  public function validation_website_edit()
  {
    $this->form_validation->set_rules('website_jum', 'Jumbotron', 'required');
    $this->form_validation->set_rules('website_subJum', 'Sub Jumbotron', 'required');
    $this->form_validation->set_rules('website_tentang', 'Tentang', 'required');
    $this->form_validation->set_rules('website_kontak', 'Kontak', 'required');
    $this->form_validation->set_rules('website_email', 'Email', 'required|valid_email');
    $this->form_validation->set_rules('website_alamat', 'Alamat', 'required');
    $this->form_validation->set_rules('website_wa', 'WhatsApp', 'required');
    
    if ($this->form_validation->run() == FALSE) {
      $this->session->set_flashdata("pesan", "<script>sweet('Gagal', 'Isi data dengan benarr & lengkap!', 'error, 'Tutup')</script>");
      redirect("websiteSettings");
    } else {
      $this->process_website_update();
    }    
  }

  private function process_website_update()
  {
    $input = (object)$this->input->post();
    $website_gbrjum = $_FILES["website_gbrJum"]["name"];

    if ($website_gbrjum != "") {
      $cek = $this->M_data->editData(['website_id' => $input->website_id],'tb_website')->row();
      unlink('./vendor/img/website/'.$cek->website_gbrjum);
      // var_dump($_FILES['gbrJum']['type']);
      // var_dump($gambar);
      $config['upload_path']          = './vendor/img/website/';
      $config['allowed_types']        = 'jpg|png|jpeg|svg&xml';
      $config['max_size']             = 5024;
      $config['max_width']            = 2048;
      $config['max_height']           = 1512;

      $this->load->library('upload');
      $this->upload->initialize($config);

      // $cek = $this->upload->do_upload('gbrJum');
      // var_dump($cek);

      if (!$this->upload->do_upload('website_gbrJum'))
      {
        $this->session->set_flashdata('pesan', '<script>sweet("Gagal","Gagal upload foto!","error","Tutup")</script>');
        redirect('websiteSettings');
      } 
      $data = ["website_gbrjum" => $website_gbrjum];
      $where = ['website_id' => $input->website_id];
      $this->M_data->updateData($data,$where,'tb_website');
    } 
    $data   = [
      'website_jum' => $this->db->escape_str($input->website_jum),
      'website_subJum' => $this->db->escape_str($input->website_subJum),
      'website_tentang' => $input->website_tentang,
      'website_kontak' => $input->website_kontak,
      'website_email' => $this->db->escape_str($input->website_email),
      'website_alamat' => $input->website_alamat,
      'website_wa' => $this->db->escape_str($input->website_wa)
    ];
    $where = ['website_id' => $input->website_id];
    $this->M_data->updateData($data,$where,'tb_website');

    $this->session->set_flashdata('pesan', '<script>sweet("Sukes","Data berhasil diubah!","success","Tutup")</script>');
    redirect('websiteSettings');
  }
}