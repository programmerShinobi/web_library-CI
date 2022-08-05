<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

use PHPMailer\PHPMailer\PHPMailer;
require "vendor/autoload.php";

class Welcome extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
	}

	public function login()
	{
		$data = [
			'title' => 'LOGIN',
		];
		$this->load->view('v_header', $data);
		$this->load->view('v_footer');

		$this->session->unset_userdata('status');
		$this->session->unset_userdata('admin_id');
		
		$this->form_validation->set_rules('username', 'Username', 'required|min_length[4]',[
			'required' => 'Wajib masukan username!',
			'min_length' => 'Masukan minimal 4 karakter!'
		]);
		$this->form_validation->set_rules('password', 'Password', 'required|min_length[4]',[
			'required' => 'Wajib masukan password!',
			'min_length' => 'Masukan minimal 4 karakter!'
		]);
		$this->form_validation->set_rules('captcha', 'Captcha', 'required',[
			'required' => 'Wajib masukan captcha!'
		]);
		
		
		if ($this->form_validation->run() == FALSE) {
			
			$options = [
				'img_path' => './vendor/img/captcha/',
				'img_url' => base_url('vendor/img/captcha/'),
				'img_width' => 205,
				'img_height' => 35,
				'expiration' =>7200
			];
			$cap = create_captcha($options);
			$img = $cap['image'];
	
			$text = $cap['word'];
			$this->session->set_userdata('captcha',$text);
			
			$data = [
				'img' => $img,
				'text' => $text,
				'title' => 'LOGIN'
			];
    		
			$this->load->view('v_login', $data);	
    			
		} else {
			$captcha = $this->input->post('captcha');

			if($captcha == $this->session->userdata('captcha')) {
				$this->prosesLogin();
			} else {
				$this->session->set_flashdata('pesan', '<script>sweet("Gagal","Captcha tidak sesuai!","error","Tutup");</script>');
			
				redirect('login');
			}			
		}		
	}

	private function prosesLogin()
	{

		$user 		= html_escape($this->input->post('username',true));
		$pass 		= html_escape($this->input->post('password',true));

		$cek = $this->M_data->editData(['user_username' => $this->db->escape_str($user)],'tb_user')->row();
		date_default_timezone_set('Asia/Jakarta');

		if($cek) {
			if(password_verify($pass,$cek->user_password)) {
				if($cek->user_role == 1){
					$sesi = [
						'admin_id' => $cek->user_id,
						'role_id' => $cek->user_role,
						'status' => TRUE
					];

					$data = [
						'log_user' => $cek->user_id,
						'log_tanggal' => date('Y-m-d'),
						'log_time' => date('H:i:s')
					];
					$this->M_data->insertData($data,'tb_log');
					$this->session->set_flashdata('pesan', '<script>sweet("Sukses", "Selamat datang!", "success", "tutup")</script>');
					$this->session->set_userdata($sesi);
					redirect('admin');
				} elseif ($cek->user_role == 2) {
					$sesi = [
						'admin_id' => $cek->user_id,
						'role_id' => $cek->user_role,
						'status' => TRUE
					];

					$data = [
						'log_user' => $cek->user_id,
						'log_tanggal' => date('Y-m-d'),
						'log_time' => date('H:i:s')
					];
					$this->M_data->insertData($data,'tb_log');
					$this->session->set_flashdata('pesan', '<script>sweet("Sukses", "Selamat datang!", "success", "tutup")</script>');
					$this->session->set_userdata($sesi);
					redirect('admin');
				} else if ($cek->user_role > 5 ) {
					$sesi = [
						'admin_id' => $cek->user_id,
						'role_id' => $cek->user_role,
						'status' => TRUE
					];

					$data = [
						'log_user' => $cek->user_id,
						'log_tanggal' => date('Y-m-d'),
						'log_time' => date('H:i:s')
					];
					$this->M_data->insertData($data, 'tb_log');
					$this->session->set_flashdata('pesan', '<script>sweet("Sukses", "Selamat datang!", "success", "tutup")</script>');
					$this->session->set_userdata($sesi);
					redirect('admin');
				} elseif ($cek->user_role == 4) {
					$sesi = [
						'admin_id' => $cek->user_id,
						'role_id' => $cek->user_role,
						'status' => TRUE
					];

					$data = [
						'log_user' => $cek->user_id,
						'log_tanggal' => date('Y-m-d'),
						'log_time' => date('H:i:s')
					];
					$this->M_data->insertData($data, 'tb_log');
					$this->session->set_flashdata('pesan', '<script>sweet("Sukses", "Selamat datang!", "success", "tutup")</script>');
					$this->session->set_userdata($sesi);
					redirect('admin');
				} elseif($cek->user_role == 3){
					$user_backlist =$cek->user_backlist;
					if ($user_backlist != 1) {
						$user_status = $cek->user_status;
						if ($user_status == 1) {
							$sesi = [
								'admin_id' => $cek->user_id,
								'role_id' => $cek->user_role,
								'status' => TRUE
							];

							$data = [
								'log_user' => $cek->user_id,
								'log_tanggal' => date('Y-m-d'),
								'log_time' => date('H:i:s')
							];
							$this->M_data->insertData($data, 'tb_log');

							$this->session->set_userdata($sesi);
							$this->session->set_flashdata('pesan', '<script>sweet("Sukses", "Selamat datang!", "success", "tutup")</script>');
							redirect('index');
						} else {
						    $this->session->set_flashdata('pesan', '<script>sweet("Gagal","Silahkan verifikasi email Anda!","error","Tutup");</script>');
							redirect('login');
						}
					} else {
						$this->session->set_flashdata('pesan', '<script>sweet("Gagal","Akun Anda telah diblokir!","error","Tutup");</script>');
						redirect('login');
					}
					
				}
			} else {
				$this->session->set_flashdata('pesan', '<script>sweet("Gagal","Username / Password yang Anda masukan salah!","error","Tutup");</script>');
				redirect('login');
			}
		} else {
			$this->session->set_flashdata('pesan', '<script>sweet("Gagal","Username Anda belum terdaftar!","error","Tutup");</script>');
			redirect('login');
		}
	}

	public function register()
	{
		$data = [
			'title' => 'REGISTRASI',
			'total_anggota' => $this->M_data->editData(["user_role" => 3], "tb_user")->num_rows(),
		];
		$this->load->view('v_header', $data);
		$this->load->view('v_footer');
		
		$this->form_validation->set_rules('nama', 'Nama', 'required',[
			'required' => 'Wajib untuk masukan nama!'
		]);
		$this->form_validation->set_rules('jk', 'jenis kelamin', 'required',[
			'required' => 'Wajib untuk masukan jenis kelamin!'
		]);
		$this->form_validation->set_rules('tempatLahir', 'tempat lahir', 'required',[
			'required' => 'Wajib untuk masukan tempat lahir!'
		]);
		$this->form_validation->set_rules('tanggalLahir', 'tanggal lahir', 'required',[
			'required' => 'Wajib untuk masukan tanggal lahir!'
		]);
		$this->form_validation->set_rules('klasifikasi', 'klasifikasi', 'required',[
			'required' => 'Wajib untuk masukan klasifikasi!'
		]);
		$this->form_validation->set_rules('alamat', 'alamat', 'required',[
			'required' => 'Wajib untuk masukan alamat!'
		]);
		$this->form_validation->set_rules('nomorHP', 'nomor HP', 'required|numeric|min_length[11]|max_length[12]',[
			'required' => 'Wajib untuk masukan nomor HP!',
			'numeric' => 'Masukan nomor HP dengan angka!',
			'min_length' => 'Masukan nomor HP minimal 11 karakter!',
			'max_length' => 'Masukan nomor HP maksimal 12 karakter!'
		]);
		$this->form_validation->set_rules('noKTP', 'nomor induk KTP / Kartu Pelajar', 'required|numeric|is_unique[tb_user.user_ktp]|min_length[10]|max_length[20]',[
			'required' => 'Wajib untuk masukan nomor induk KTP / Kartu Pelajar !',
			'numeric' => 'Masukan nomor induk KTP / Kartu Pelajar hanya angka!',
			'is_unique' => 'Nomor induk KTP / Kartu Pelajar sudah terdaftar!',
			'min_length' => 'Masukan nomor induk KTP / Kartu Pelajar minimal 10 karakter!',
			'max_length' => 'Masukan nomor induk KTP / Kartu Pelajar maksimal 20 karakter!'
		]);
		$this->form_validation->set_rules('mail', 'email', 'required|valid_email|is_unique[tb_user.user_email]',[
			'required' => 'Wajib untuk masukan email!',
			'valid_email' => 'Masukan format email dengan benar!',
			'is_unique' => 'Email sudah didaftarkan!'
		]);
		$this->form_validation->set_rules('user', 'username', 'required|min_length[4]|is_unique[tb_user.user_username]',[
			'required' => 'Wajib untuk masukan username!',
			'is_unique' => 'Username sudah terdaftar!',
			'min_length' => 'Masukan username minimal 4 karakter!'
		]);
		$this->form_validation->set_rules('pass', 'password', 'required|matches[pas1]|min_length[4]',[
			'required' => 'Wajib untuk masukan password!',
			'matches' => 'Password tidak sesuai!',
			'min_length' => 'Masukan password minimal 4 karakter!'
		]);
		$this->form_validation->set_rules('pas1', 'ulangi password', 'required|matches[pass]|min_length[4]',[
			'required' => 'Wajib untuk masukan ulangi password!',
			'matches' => 'Password tidak sesuai! ulangi password',
			'min_length' => 'Masukan minimal 4 karakter! ulangi password'
		]);
		$this->form_validation->set_rules('namaOrangTua', 'nama orangtua / wali', 'required',[
			'required' => 'Wajib untuk masukan nama orangtua / wali!'
		]);
		$this->form_validation->set_rules('noHPOrangTua', 'nomor HP orangtua', 'required|numeric|min_length[11]|max_length[12]',[
			'required' => 'Wajib untuk masukan nomor HP orangtua / wali!',
			'numeric' => 'Wajib masukan dengan angka!',
			'min_length' => 'Masukan nomor HP minimal 11 karakter!',
			'max_length' => 'Masukan nomor HP maksimal 12 karakter!'
		]);
		$this->form_validation->set_rules('tempatLahirOrangTua', 'tempat lahir orangtua', 'required',[
			'required' => 'Wajib untuk masukan tempat lahir orangtua / wali!'
		]);
		$this->form_validation->set_rules('tanggalLahirOrangTua', 'tanggal lahir orangtua', 'required',[
			'required' => 'Wajib untuk masukan tanggal lahir orangtua / wali!'
		]);
		$this->form_validation->set_rules('alamatOrangTua', 'alamat orangtua', 'required',[
			'required' => 'Wajib untuk masukan alamat orangtua / wali!'
		]);
		$this->form_validation->set_rules('pertanyaan', 'pertanyaan', 'required',[
			'required' => 'Wajib untuk memilih pertanyaan!'
		]);
		$this->form_validation->set_rules('jawaban', 'jawaban', 'required',[
			'required' => 'Wajib untuk menjawab pertanyaan!'
		]);

		
		if($this->form_validation->run() == FALSE) {
			$data = [
				'title' => 'REGISTRASI',
				"pekerjaan" => $this->M_data->getData("tb_klasifikasi")->result()
			];
			$this->load->view('v_regis',$data);

		} else {
			$this->prosesRegis();
		}		
	}

	private function prosesRegis()
	{
		$nama 					= html_escape($this->input->post('nama', true));
		$jk 					= html_escape($this->input->post('jk', true));
		$tempatLahir 			= html_escape($this->input->post('tempatLahir', true));
		$tanggalLahir 			= html_escape($this->input->post('tanggalLahir', true));
		$klasifikasi 			= html_escape($this->input->post('klasifikasi', true));
		$alamat 				= html_escape($this->input->post('alamat', true));
		$user 					= html_escape($this->input->post('user', true));
		$noKTP 					= html_escape($this->input->post('noKTP', true));
		$nomorHP 				= html_escape($this->input->post('nomorHP', true));
		$mail 					= html_escape($this->input->post('mail', true));
		$pass 					= html_escape($this->input->post('pass', true));
		$namaOrangTua			= html_escape($this->input->post('namaOrangTua', true));
		$alamatOrangTua			= html_escape($this->input->post('alamatOrangTua', true));
		$noHPOrangTua       	= html_escape($this->input->post('noHPOrangTua', true));
		$tempatLahirOrangTua	= html_escape($this->input->post('tempatLahirOrangTua', true));
		$tanggalLahirOrangTua 	= html_escape($this->input->post('tanggalLahirOrangTua', true));
		$pertanyaan 			= html_escape($this->input->post('pertanyaan', true));
		$jawaban 				= html_escape($this->input->post('jawaban', true));
//		$noId 					= rand(1, 1000000);
		$noId 					= html_escape($this->input->post('noId', true));
		$user_verifikasi 	= rand(1, 1000000);

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

		$image_name=$noId.'.png'; //buat name dari qr code sesuai dengan nim
		
		$dataqr = $noId;

		$params['data'] = $dataqr; //data yang akan di jadikan QR CODE
		$params['level'] = 'H'; //H=High
		$params['size'] = 10;
		$params['savename'] = $config['imagedir'].$image_name; //simpan image QR CODE ke folder assets/images/
		$this->ciqrcode->generate($params);
		
		$tiga=3;
		$data = [
			'user_noId' => $noId,
			'user_nama' => $this->db->escape_str($nama),
			'user_jk' => $this->db->escape_str($jk),
			'user_tempatLahir' => $this->db->escape_str($tempatLahir),
			'user_tanggalLahir' => $this->db->escape_str($tanggalLahir),
			'user_klasifikasi' => $this->db->escape_str($klasifikasi),
			'user_alamat' => $this->db->escape_str($alamat),
			'user_ktp' => $this->db->escape_str($noKTP),
			'user_foto' => 'default.jpg',
			'user_username' => $this->db->escape_str($user),
			'user_password' => password_hash($pass, PASSWORD_DEFAULT),
			'user_role' => $tiga,
			'user_noHP' => $this->db->escape_str($nomorHP),
			'user_email' => $this->db->escape_str($mail),
			'user_qr' => $image_name,
			'user_verifikasi' => $user_verifikasi,
			'user_token' => hash('sha256', md5(date('Y-m-d'))),
		];

		$this->M_data->insertData($data,'tb_user');
		$user_id = $this->M_data->editData(['user_ktp' => $noKTP],'tb_user')->row();

		$data2 = [
			'orangtua_user' => $user_id->user_id,
			'orangtua_nama' => $this->db->escape_str($namaOrangTua),
			'orangtua_alamat' => $this->db->escape_str($alamatOrangTua),
			'orangtua_tempatLahir' => $this->db->escape_str($tempatLahirOrangTua),
			'orangtua_tanggalLahir' => $this->db->escape_str($tanggalLahirOrangTua),
			'orangtua_noHP' => $this->db->escape_str($noHPOrangTua)
		];
		$this->M_data->insertData($data2,'tb_identitas_orangtua');

		$data3 = [
			'pertanyaan_user' => $user_id->user_id,
			'pertanyaan' => $pertanyaan,
			'pertanyaan_jawaban' => $this->db->escape_str($jawaban)
		];
		$this->M_data->insertData($data3,'tb_pertanyaan_keamanan');

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

		$data_array = $this->M_data->get_verifikasiProccesed($user_id->user_id);
		foreach ($data_array as $key) {
		    
            // $from = "dinas.perpus.karawang@gmail.com";    
            // $to = $key->user_email;    
            // $subject = "Info Verifikasi Email di Perpustakaan Pemda Karawang";    
            // $message = 'Selamat ' . $waktu . '.. ' . '<p align="justify">Diberitahukan kepada saudara/i ' . $key->user_nama . '.. Selamat, Anda berhasil membuat akun. Untuk mengaktifkan akun Anda silahkan klik link dibawah ini.</p><p><a href="https://e-web.id/activation.php?t='.$key->user_token.'">https://e-web.id/verifikasi_email-</a></p>Terimakasih..<p align="justify">Dinas Perpustakaan dan Kearsipan Daerah Kabupaten Karawang.<br>Jalan Jendaral A.Yani nomor 10 Kelurahan Nagarasari, Kecamatan Karawang Barat, Kabupaten Karawang, Provinsi Jawa Barat 41316.</p>Silahkan kunjung website Kami : https://e-web.id/';
            // $headers = 'From:' . $from . "\r\n";
            // $headers .= 'Content-type: text/html'."\r\n";
            // $kirim = mail($to,$subject,$message,$headers);
            
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
			$this->email->subject('Info Verifikasi Email di Perpustakaan Pemda Karawang');
			$this->email->message('Selamat ' . $waktu . '.. ' . '<p align="justify">Diberitahukan kepada saudara/i ' . $key->user_nama . '.. Selamat, Anda berhasil membuat akun. Untuk mengaktifkan akun Anda silahkan klik link dibawah ini.</p><p><a href="https://e-web.id/activation.php?t='.$key->user_token.'">https://e-web.id/verifikasi_email-</a></p>Terimakasih..<p align="justify">Dinas Perpustakaan dan Kearsipan Daerah Kabupaten Karawang.<br>Jalan Jendaral A.Yani nomor 10 Kelurahan Nagarasari, Kecamatan Karawang Barat, Kabupaten Karawang, Provinsi Jawa Barat 41316.</p>Silahkan kunjung website Kami : https://e-web.id/');
			$kirim = $this->email->send();
			
		}

		if ($kirim) { 
		$this->session->set_flashdata('pesan','<script>sweet("Sukses","Anda berhasil registrasi, silahkan verifikasi email Anda!","success","Tutup");</script>');
		redirect('login');
		} else {
            $this->session->set_flashdata('pesan', '<script>sweet("Gagal", "Silahkan cek kembali email Anda!", "error", "tutup")</script>');
            redirect('register');
		}
	}

	public function lupaPassword()
	{
		$data = [
			'title' => 'LUPA PASSWORD',
		];
		$this->load->view('v_header', $data);
		$this->load->view('v_footer');

		$this->form_validation->set_rules('email', 'Email', 'required|valid_email',[
			'required' => 'Wajib masukan email',
			'valid_email' => 'Masukan format email dengan benar!'
		]);
		
		
		if ($this->form_validation->run() == FALSE) {
			$data = [
				'title' => 'LUPA PASSWORD'
			];
			$this->load->view('v_lupaPassword',$data);
		} else {
			$email = html_escape($this->input->post('email'));
			
			$this->session->set_userdata('email',$email);
			redirect('pertanyaan');
		}
	}

	public function pertanyaan()
	{
		$data = [
			'title' => 'LUPA PASSWORD',
		];
		$this->load->view('v_header', $data);
		$this->load->view('v_footer');

		if(!$this->session->userdata('email')) {
			$this->session->set_flashdata('pesan', '<script>sweet("Gagal!","Masukan email terlebih dahulu!","error","Tutup")</script>');
			redirect('lupaPassword');
		}	else {
			$this->form_validation->set_rules('jawaban', 'Jawaban', 'required',[
				'required' => 'Wajib menjawab pertanyaan!'
			]);
			
			$user_id = $this->M_data->editData(['user_email' => $this->session->userdata('email')],'tb_user')->row();
			if ($this->form_validation->run() == FALSE) {
				if ($user_id){
					$data = [
						'title' => 'LUPA PASSWORD',
						'pertanyaan' => $this->M_data->editData(['pertanyaan_user' => $user_id->user_id],'tb_pertanyaan_keamanan')->row()
					];
					$this->load->view('v_lupaPassword2',$data);
				} else {
					$data = [
						'title' => 'LUPA PASSWORD'
					];
					$this->session->set_flashdata('pesan', '<script>sweet("Gagal!","E-mail Anda salah!","error","Tutup")</script>');
					redirect('lupaPassword');
				}
			} else {
				$jawaban = html_escape($this->input->post('jawaban',true));

				$where = [
					'pertanyaan_user' => $user_id->user_id,
					'pertanyaan_jawaban' => $jawaban
				];
				$cekJawaban = $this->M_data->editData($where,'tb_pertanyaan_keamanan')->row();

				if($cekJawaban) {
					$this->session->set_userdata('user',$user_id->user_id);
					redirect('resetPassword');
				} else {
					$this->session->set_flashdata('pesan', '<script>sweet("Gagal!","Jawaban Anda salah!","error","Tutup")</script>');
					redirect('pertanyaan');
				}
			}
		}
	}

	public function resetPassword()
	{
		$data = [
			'title' => 'RESET PASSWORD',
		];
		$this->load->view('v_header', $data);
		$this->load->view('v_footer');

		if(!$this->session->userdata('user')) {
			$this->session->set_flashdata('pesan', '<script>sweet("Gagal!","Wajib menjawab pertanyaan terlebih dahulu!","error","Tutup")</script>');
			redirect('pertanyaan');
		} else {
			$this->form_validation->set_rules('password', 'Password', 'required',[
				'required' => 'Wajib masukan Password'
			]);
			
			if ($this->form_validation->run() == FALSE) {
				$data = ['title' => 'RESET PASSWORD'];
				$this->load->view('v_lupaPassword3',$data);
			} else {
				$this->resetPasswordAct();
			}
		}		
	}

	private function resetPasswordAct()
	{
		$password   = html_escape($this->input->post('password',true));
		$data 			= ['user_password' => password_hash($password,PASSWORD_DEFAULT)];
		$where 			= ['user_id' => $this->session->userdata('user')];
		$this->M_data->updateData($data,$where,'tb_user');
		
		$this->session->set_flashdata('pesan', '<script>sweet("Sukses","Password berhasil diubah!","success","Tutup")</script>');
		redirect('login');
	}

	public function myprofile()
	{
		$data = [
			'title' => 'PROFILE',
		];
		$this->load->view('v_header', $data);

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
				'w' => $this->M_data->getData('tb_website')->row(),	
				'totalp' => $this->M_data->editData(['cart_user' => $this->session->userdata('id'),'cart_kategori' => 2],'tb_cart')->num_rows(),
				'totalb' => $this->M_data->editData(['cart_user' => $this->session->userdata('id'),'cart_kategori' => 1],'tb_cart')->num_rows(),
				'book' => $this->M_data->editData(['booking_user' => $this->session->userdata('id')],'tb_booking')->num_rows(),
				'u' => $this->M_data->editData(['user_id' => $this->session->userdata('id')],'tb_user')->row()
			];
			$this->load->view('v_header',$data);
			$this->load->view('user/v_profile',$data);
			$this->load->view('v_footer');
		} else {
			redirect('myprofile');
		}
	}

	public function usulan()
	{
		$data = [
			'title' => 'SURVEI KEBUTUHAN PEMUSTAKA',
			'user' => $this->M_data->editData(['user_id' => $this->session->userdata('admin_id')], 'tb_user')->row(),
			'total_anggota' => $this->M_data->editData(["user_role" => 3], "tb_user")->num_rows(),
			'total_pinjaman' => $this->M_data->editData(["cart_user" => $this->session->userdata("admin_id")], "tb_cart")->num_rows(),
			'total_buku_saya' => $this->M_data->buku_saya()->num_rows(),
			'total_buku_pinjam' => $this->M_data->buku_pinjam()->num_rows(),
		];
		$this->load->view('v_header', $data);
		$this->load->view('v_footer');

		$this->form_validation->set_rules('kebutuhanpemustaka_kunjungan', 'Kuisioner', 'required', [
			'required' => 'Wajib untuk masukan data!'
		]);
		$this->form_validation->set_rules('kebutuhanpemustaka_jenisKoleksi', 'Kuisioner', 'required', [
			'required' => 'Wajib untuk masukan data!'
		]);
		$this->form_validation->set_rules('kebutuhanpemustaka_koleksiBidang', 'Kuisioner', 'required', [
			'required' => 'Wajib untuk masukan data!'
		]);
		$this->form_validation->set_rules('kebutuhanpemustaka_koleksiTerbaru', 'Kuisioner', 'required', [
			'required' => 'Wajib untuk masukan data!'
		]);
		$this->form_validation->set_rules('kebutuhanpemustaka_koleksiKebutuhan', 'Kuisioner', 'required', [
			'required' => 'Wajib untuk masukan data!'
		]);
		$this->form_validation->set_rules('kebutuhanpemustaka_ketersediaanKoleksi', 'Kuisioner', 'required', [
			'required' => 'Wajib untuk masukan data!'
		]);
		$this->form_validation->set_rules('kebutuhanpemustaka_judul', 'Kuisioner', 'required', [
			'required' => 'Wajib untuk masukan data!'
		]);
		$this->form_validation->set_rules('kebutuhanpemustaka_pengarang', 'Kuisioner', 'required', [
			'required' => 'Wajib untuk masukan data!'
		]);
		$this->form_validation->set_rules('kebutuhanpemustaka_penerbit', 'Kuisioner', 'required', [
			'required' => 'Wajib untuk masukan data!'
		]);

		if ($this->form_validation->run() == FALSE) {
			$data = [
				'title' => 'SURVEI KEBUTUHAN PEMUSTAKA',
				'total_pinjaman' => $this->M_data->editData(["cart_user" => $this->session->userdata("admin_id")], "tb_cart")->num_rows(),
				'total_buku_saya' => $this->M_data->buku_saya()->num_rows(),
				'total_buku_pinjam' => $this->M_data->buku_pinjam()->num_rows(),
			];
			$this->load->view('v_usulan', $data);
		} else {
			$this->process_usulan_add();
		}	
	}

	private function process_usulan_add()
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
		$check1 = $this->M_data->insertData($data1, "tb_kebutuhanpemustaka");
		if ($check1) {
			$data2 = [
				"pengadaan_judul" => $input->kebutuhanpemustaka_judul,
				"pengadaan_pengarang" => $input->kebutuhanpemustaka_pengarang,
				"pengadaan_penerbit" => $input->kebutuhanpemustaka_penerbit,
			];
			$check2 = $this->M_data->insertData($data2, "tb_pengadaan");
			if ($check2){
				$this->session->set_flashdata('pesan', '<script>sweet("Sukses", "Studi kebutuhan pemustaka berhasil disimpan!", "success", "tutup")</script>');
				redirect('index');
			} else {
				$this->session->set_flashdata('pesan', '<script>sweet("Gagal", "Query failed!", "error", "tutup")</script>');
				redirect('index');
			}
		} else {
			$this->session->set_flashdata('pesan', '<script>sweet("Gagal", "Query failed!", "error", "tutup")</script>');
			redirect('index');
		}
	}

	public function buku_tamu()
	{
		$data = [
			'title' => 'BUKU TAMU',
			'user' => $this->M_data->editData(['user_id' => $this->session->userdata('admin_id')], 'tb_user')->row(),
			'total_anggota' => $this->M_data->editData(["user_role" => 3], "tb_user")->num_rows(),
			'pekerjaan' => $this->M_data->getData("tb_klasifikasi")->result(),
			'total_pinjaman' => $this->M_data->editData(["cart_user" => $this->session->userdata("admin_id")], "tb_cart")->num_rows(),
			'total_buku_saya' => $this->M_data->buku_saya()->num_rows(),
			'total_buku_pinjam' => $this->M_data->buku_pinjam()->num_rows(),
		];

		$this->form_validation->set_rules('pengunjung_nama', 'Pengunjung Perpustakaan', 'required', [
			'required' => 'Wajib untuk masukan data!'
		]);
		$this->form_validation->set_rules('pengunjung_jk', 'Pengunjung Perpustakaan', 'required', [
			'required' => 'Wajib untuk masukan data!'
		]);
		$this->form_validation->set_rules('pengunjung_klasifikasi', 'Pengunjung Perpustakaan', 'required', [
			'required' => 'Wajib untuk masukan data!'
		]);
		$this->form_validation->set_rules('pengunjung_alamat', 'Pengunjung Perpustakaan', 'required', [
			'required' => 'Wajib untuk masukan data!'
		]);
		$this->form_validation->set_rules('pengunjung_info', 'Pengunjung Perpustakaan', 'required', [
			'required' => 'Wajib untuk masukan data!'
		]);
		if ($this->form_validation->run() == FALSE) {
			$data = [
				'title' => 'BUKU TAMU',
				"pekerjaan" => $this->M_data->getData("tb_klasifikasi")->result(),
			];
			$this->load->view('v_buku_tamu', $data);
		} else {
			$this->buku_tamu_add();
		}
	}

	private function buku_tamu_add()
	{
		$input = (object)html_escape($this->db->escape_str($this->input->post()));
		$data = [
			"pengunjung_nama" => $input->pengunjung_nama,
			'pengunjung_jk' => $input->pengunjung_jk,
			"pengunjung_klasifikasi" => $input->pengunjung_klasifikasi,
			"pengunjung_alamat" => $input->pengunjung_alamat,
			"pengunjung_info" => $input->pengunjung_info,
			"pengunjung_tanggal" => date("Y-m-d"),
			"pengunjung_masuk" => date("h:i"),
		];
		$check = $this->M_data->insertData($data, "tb_pengunjung_perpus");
		if ($check) {
			$this->session->set_flashdata('pesan', '<script>sweet("Sukses", "Input buku tamu berhasil disimpan!", "success", "tutup")</script>');
			redirect('buku_tamu');
		} else {
			$this->session->set_flashdata('pesan', '<script>sweet("Gagal", "Input buku tamu berhasil gagal disimpan!!", "error", "tutup")</script>');
			redirect('buku_tamu');
		}
	}
	
    public function lupaVerifikasiEmail()
	{

		$data = [
			'title' => 'LUPA KODE VERIFIKASI',
		];
		$this->load->view('v_header', $data);
		$this->load->view('v_footer');

		$this->form_validation->set_rules('user_email', 'email', 'required|valid_email', [
			'required' => 'Wajib untuk masukan email!',
			'valid_email' => 'Masukan format email dengan benar!',
		]);


		if ($this->form_validation->run() == FALSE) {
			$data = [
				'title' => 'LUPA KODE VERIFIKASI',
			];
			$this->load->view('v_lupaVerifikasiEmail', $data);
		} else {
			$this->prosesLupaVerifikasiEmail();
		}		
	}

	private function prosesLupaVerifikasiEmail()
	{

		$mail = html_escape($this->input->post('user_email', true));
		
		$user_id = $this->M_data->editData(['user_email' => $mail], 'tb_user')->row();

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

		$data_array = $this->M_data->get_verifikasiProccesed($user_id->user_id);
		foreach ($data_array as $key) {
		    
            // $from = "dinas.perpus.karawang@gmail.com";    
            // $to = $key->user_email;    
            // $subject = "Info Verifikasi Email di Perpustakaan Pemda Karawang";    
            // $message = 'Selamat ' . $waktu . '.. ' . '<p align="justify">Diberitahukan kepada saudara/i ' . $key->user_nama . '.. Kode Verifikasi Email Anda adalah ' . $key->user_verifikasi . '</p> Terimakasih..<p align="justify">Dinas Perpustakaan dan Kearsipan Daerah Kabupaten Karawang.<br>Jalan Jendaral A.Yani nomor 10 Kelurahan Nagarasari, Kecamatan Karawang Barat, Kabupaten Karawang, Provinsi Jawa Barat 41316.</p>Silahkan kunjung website Kami : https://e-web.id/';
            // $headers = 'From:' . $from . "\r\n";
            // $headers .= 'Content-type: text/html'."\r\n";
            // $kirim = mail($to,$subject,$message,$headers);
            
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
			$this->email->subject('Info Verifikasi Email di Perpustakaan Pemda Karawang');
			$this->email->message('Selamat ' . $waktu . '.. ' . '<p align="justify">Diberitahukan kepada saudara/i ' . $key->user_nama . '.. Kode Verifikasi Email Anda adalah ' . $key->user_verifikasi . '</p> Terimakasih..<p align="justify">Dinas Perpustakaan dan Kearsipan Daerah Kabupaten Karawang.<br>Jalan Jendaral A.Yani nomor 10 Kelurahan Nagarasari, Kecamatan Karawang Barat, Kabupaten Karawang, Provinsi Jawa Barat 41316.</p>Silahkan kunjung website Kami : https://e-web.id/');
			$kirim = $this->email->send();

		}

		if ($kirim) { 
			$this->session->set_flashdata('pesan', '<script>sweet("Sukses ","Silahkan cek kode verifikasi di email Anda!","success","Tutup");</script>');
			redirect('verifikasiEmail');
		} else {
            $this->session->set_flashdata('pesan', '<script>sweet("Gagal", "Silahkan cek kembali email Anda!", "error", "tutup")</script>');
            redirect('lupaVerifikasiEmail');
		}
	}
	
	public function lupaKodeAkses()
	{

		$data = [
			'title' => 'LUPA KODE AKSES',
		];
		$this->load->view('v_header', $data);
		$this->load->view('v_footer');

		$this->form_validation->set_rules('user_email', 'email', 'required|valid_email', [
			'required' => 'Wajib untuk masukan email!',
			'valid_email' => 'Masukan format email dengan benar!',
		]);


		if ($this->form_validation->run() == FALSE) {
			$data = [
				'title' => 'LUPA KODE AKSES',
			];
			$this->load->view('v_lupaKodeAkses', $data);
		} else {
			$this->prosesLupaKodeAkses();
// 			$this->load->view('v_lupaKodeAkses', $data);
		}		
	}

	private function prosesLupaKodeAkses()
	{

		$user_email = html_escape($this->input->post('user_email', true));
		$email = $this->M_data->editData(['user_email' => $user_email], 'tb_user')->result();
		foreach ($email as $emails) {
            if ($user_email == $emails->user_email) {
                $user_id = $this->M_data->editData(['user_email' => $user_email], 'tb_user')->row();
        
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
        
        		$data_array = $this->M_data->get_verifikasiProccesed($user_id->user_id);
        		foreach ($data_array as $key) {
        		    
                    // $from = "dinas.perpus.karawang@gmail.com";    
                    // $to = $key->user_email;    
                    // $subject = "Info Username & Kode Verifikasi di Website e-web.id";    
                    // $message = 'Selamat ' . $waktu . '.. ' . '<p align="justify">Diberitahukan kepada saudara/i ' . $key->user_nama . '<br>Username : ' . $key->user_username .'<br>Kode Verifikasi : ' . $key->user_verifikasi  . '</p> Terimakasih..<p align="justify">Dinas Perpustakaan dan Kearsipan Daerah Kabupaten Karawang.<br>Jalan Jendaral A.Yani nomor 10 Kelurahan Nagarasari, Kecamatan Karawang Barat, Kabupaten Karawang, Provinsi Jawa Barat 41316.</p>Silahkan kunjung website Kami : https://e-web.id/';
                    // $headers = 'From:' . $from . "\r\n";
                    // $headers .= 'Content-type: text/html'."\r\n";
                    // $kirim = mail($to,$subject,$message,$headers);
        
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
        			$this->email->subject('Info Username & Kode Verifikasi di Website e-web.id');
        			$this->email->message('Selamat ' . $waktu . '.. ' . '<p align="justify">Diberitahukan kepada saudara/i ' . $key->user_nama . '<br>Username : ' . $key->user_username .'<br>Kode Verifikasi : ' . $key->user_verifikasi  . '</p>Terimakasih..<p align="justify">Dinas Perpustakaan dan Kearsipan Daerah Kabupaten Karawang.<br>Jalan Jendaral A.Yani nomor 10 Kelurahan Nagarasari, Kecamatan Karawang Barat, Kabupaten Karawang, Provinsi Jawa Barat 41316.</p>Silahkan kunjung website Kami : https://e-web.id/');
        			$kirim = $this->email->send();
        
            		if ($kirim) { 
            			$this->session->set_flashdata('pesan', '<script>sweet("Sukses ","Silahkan cek username & kode verifikasi di email Anda!","success","Tutup");</script>');
                        $this->session->set_userdata('user',$key->user_id);
            			redirect('verifikasiEmail_lupaKodeAkses');
            		} else {
                        $this->session->set_flashdata('pesan', '<script>sweet("Gagal", "Silahkan cek koneksi internet Anda!", "error", "tutup")</script>');
                        redirect('lupaKodeAkses');
            		}
        		}   $this->session->set_flashdata('pesan', '<script>sweet("Gagal", "Email Anda belum terdaftar!", "error", "tutup")</script>');
        		    redirect('lupaKodeAkses');
    		} else {
    		    $this->session->set_flashdata('pesan', '<script>sweet("Gagal", "Email Anda belum terdaftar!", "error", "tutup")</script>');
                redirect('lupaKodeAkses');
    		}
		}   $this->session->set_flashdata('pesan', '<script>sweet("Gagal", "Email Anda belum terdaftar!", "error", "tutup")</script>');
	        redirect('lupaKodeAkses');
	}
	
	public function verifikasiEmail_lupaKodeAkses()
    {
        $data = [
			'title' => 'VERIFIKASI EMAIL',
			
		];
		$this->load->view('v_header', $data);
		$this->load->view('v_footer');

		$this->form_validation->set_rules('user_username', 'user_username', 'required',[
			'required' => 'Wajib masukan username',
		]);
		
		$this->form_validation->set_rules('user_verifikasi', 'user_verifikasi', 'required',[
			'required' => 'Wajib masukan kode verfikikasi'
		]);
		
		
		if ($this->form_validation->run() == FALSE) {
			$data = [
				'title' => 'VERIFIKASI EMAIL'
			];
			$this->load->view('v_verifikasiEmail_lupaKodeAkses',$data);
		} else {
            $user = $this->session->userdata('user');
            $user_username = html_escape($this->input->post('user_username', true));
            $user_verifikasi = html_escape($this->input->post('user_verifikasi', true));
			$user_id = $this->M_data->editData(['user_username' => $user_username],'tb_user')->row();
			if ($user == $user_id->user_id){
    			if ($user_username == $user_id->user_username AND $user_verifikasi == $user_id->$user_verifikasi){
        			redirect('resetPassword_');
    			} else {
    			    $this->session->set_flashdata('pesan', '<script>sweet("Gagal", "Username / kode verifikasi Anda salah!", "error", "tutup")</script>');
    			    redirect('verifikasiEmail_lupaKodeAkses');
    			}
			} else {
			    $this->session->set_flashdata('pesan', '<script>sweet("Gagal", "Username / kode verifikasi Anda salah!", "error", "tutup")</script>');
			    redirect('verifikasiEmail_lupaKodeAkses');
			}
		}
        
    }

	public function resetPassword_()
	{
		$data = [
			'title' => 'RESET PASSWORD',
			'total_pinjaman' => $this->M_data->editData(["cart_user" => $this->session->userdata("admin_id")], "tb_cart")->num_rows(),
			'total_buku_saya' => $this->M_data->buku_saya()->num_rows(),
			'total_buku_pinjam' => $this->M_data->buku_pinjam()->num_rows(),
		];
		$this->load->view('v_header', $data);
		$this->load->view('v_footer');


			$this->form_validation->set_rules('password', 'Password', 'required',[
				'required' => 'Wajib masukan Password'
			]);
			
			if ($this->form_validation->run() == FALSE) {
				$data = ['title' => 'RESET PASSWORD'];
				$this->load->view('v_resetPassword',$data);
			} else {
				$this->resetPasswordAct_();
			}
	}

	private function resetPasswordAct_()
	{
	    $id = $this->session->userdata('user');
		$password   = html_escape($this->input->post('password',true));
		$data 			= ['user_password' => password_hash($password,PASSWORD_DEFAULT)];
		$where 			= ['user_id' => $id];
		$this->M_data->updateData($data,$where,'tb_user');
		
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
		    
            // $from = "dinas.perpus.karawang@gmail.com";    
            // $to = $key->user_email;    
            // $subject = "Info Username & Password di Website e-web.id";    
            // $message = 'Selamat ' . $waktu . '.. ' . '<p align="justify">Diberitahukan kepada saudara/i ' . $key->user_nama . '<br>Username : ' . $key->user_username .'<br>Password : ' . $password  . '</p> Terimakasih..<p align="justify">Dinas Perpustakaan dan Kearsipan Daerah Kabupaten Karawang.<br>Jalan Jendaral A.Yani nomor 10 Kelurahan Nagarasari, Kecamatan Karawang Barat, Kabupaten Karawang, Provinsi Jawa Barat 41316.</p>Silahkan kunjung website Kami : https://e-web.id/';
            // $headers = 'From:' . $from . "\r\n";
            // $headers .= 'Content-type: text/html'."\r\n";
            // $kirim = mail($to,$subject,$message,$headers);
            
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
			$this->email->subject('Info Username & Kode Verifikasi di Website e-web.id');
			$this->email->message('Selamat ' . $waktu . '.. ' . '<p align="justify">Diberitahukan kepada saudara/i ' . $key->user_nama . '<br>Username : ' . $key->user_username .'<br>Password : ' . $password  . '</p> Terimakasih..<p align="justify">Dinas Perpustakaan dan Kearsipan Daerah Kabupaten Karawang.<br>Jalan Jendaral A.Yani nomor 10 Kelurahan Nagarasari, Kecamatan Karawang Barat, Kabupaten Karawang, Provinsi Jawa Barat 41316.</p>Silahkan kunjung website Kami : https://e-web.id/');
			$kirim = $this->email->send();
			
    		if ($kirim){
                $this->session->set_flashdata('pesan', '<script>sweet("Sukses","Password berhasil diubah! Silahkan cek email Anda!","success","Tutup")</script>');
                redirect('login');		    
    		} else {
    		    $this->session->set_flashdata('pesan', '<script>sweet("Sukses","Password berhasil diubah!","success","Tutup")</script>');
                redirect('login');  
    		}
		}

	}
}
