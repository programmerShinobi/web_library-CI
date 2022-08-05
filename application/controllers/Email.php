<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    date_default_timezone_set('Asia/Jakarta');
    
    class Email extends CI_Controller {
    
        public function __construct()
        {
            parent::__construct();
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
           
            $sendHariIni = date('D', strtotime('+1days'));
        	if ($sendHariIni == "Sun") {
        		$hariIni = 'Minggu';
        	} else if ($sendHariIni == "Mon") {
        		$hariIni = 'Senin';
        	} else if ($sendHariIni == "Tue") {
        		$hariIni = 'Selasa';
        	} else if ($sendHariIni == "Wed") {
        		$hariIni = 'Rabu';
        	} else if ($sendHariIni == "Thu") {
        		$hariIni = 'Kamis';
        	} else if ($sendHariIni == "Fri") {
        		$hariIni = 'Jumat';
        	} else if ($sendHariIni == "Sat") {
        		$hariIni = 'Sabtu';
        	}
        	
        	$sendBulanIni = date('m', strtotime('+1days'));
        	if ($sendBulanIni == "01") {
        		$bulanIni = 'Januari';
        	} else if ($sendBulanIni == "02") {
        		$bulanIni = 'Februari';
        	} else if ($sendBulanIni == "03") {
        		$bulanIni = 'Maret';
        	} else if ($sendBulanIni == "04") {
        		$bulanIni = 'April';
        	} else if ($sendBulanIni == "05") {
        		$bulanIni = 'Mei';
        	} else if ($sendBulanIni == "06") {
        		$bulanIni = 'Juni';
        	} else if ($sendBulanIni == "07") {
        		$bulanIni = 'Juli';
        	} else if ($sendBulanIni == "08") {
        		$bulanIni = 'Agustus';
        	} else if ($sendBulanIni == "09") {
        		$bulanIni = 'September';
        	} else if ($sendBulanIni == "10") {
        		$bulanIni = 'Oktober';
        	} else if ($sendBulanIni == "11") {
        		$bulanIni = 'November';
        	} else if ($sendBulanIni == "12") {
        		$bulanIni = 'Desember';
        	}
        	
        	$jam_now = date('H i s');
        	if ($jam_now > "03 00 00" && $jam_now < "09 59 59") {
        		$waktu = "Pagi";
        	} elseif ($jam_now > "10 00 00" && $jam_now < "14 59 59") {
        		$waktu = "Siang";
        	} elseif ($jam_now > "15 00 00"&& $jam_now < "18 59 59") {
        		$waktu = "Sore";
        	} elseif ($jam_now > "18 00 00" && $jam_now < "23 59 59") {
        		$waktu = "Malam";
        	} elseif ($jam_now > "00 00 00" && $jam_now < "02 59 59") {
        		$waktu = "Malam";
        	}  
    
    		
    		$date =  date('Y-m-d', strtotime('+1days'));
    		$data_array = $this->M_data->get_pengembalianBukuProccesed($date);
    		foreach ($data_array as $key) {
    		    if ($key->user_jk == "L") {
    		        $jk = "saudara";
    		    } else if ($key->user_jk == "P") {
    		        $jk = "saudari";
    		    } else {
    		        $jk = "saudara/i";
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
    			$this->email->subject('Info Pengembalian Buku di Perpustakaan Pemda Karawang');
    			$this->email->message('Selamat '.$waktu.'..<p align="justify"> Diberitahukan kepada '.$jk.' '.$key->user_nama.', bahwa batas waktu pengembalian buku di Perpustakaan Pemda Karawang sampai hari '.$hariIni.', '.date('j', strtotime('+1days')).' '.$bulanIni.' '.date('Y', strtotime('+1days')).', jika belum mengembalikan buku sesuai dengan batas waktu pengembalian buku, maka Anda dikenakan denda sebesar Rp. 5000 perhari. Denda tersebut akan dilipat gandakan perharinya, terhitung dari tanggal batas waktu pengembalian buku.</p>Terimakasih..<p align="justify">Dinas Perpustakaan dan Kearsipan Daerah Kabupaten Karawang.<br>Jalan Jendaral A.Yani nomor 10 Kelurahan Nagarasari, Kecamatan Karawang Barat, Kabupaten Karawang, Provinsi Jawa Barat 41316.</p>Silahkan kunjung website Kami : https://e-web.id/');
    			
    	    	if ($jam_now > "05 00 00" && $jam_now < "18 59 59") {
            		if ($key->peminjaman_notifikasi == null && $key->peminjaman_status == 1) {
        				$dataPeminjaman = ['peminjaman_notifikasi' => 1];
        				$wherePeminjaman = ['peminjaman_id' => $key->peminjaman_id];
        				$this->M_data->updateData($dataPeminjaman,$wherePeminjaman,'tb_peminjaman');
        			    $this->email->send();
        			}
            	} 
    		} 
    		$date1 =  date('Y-m-d', strtotime('-30days'));
            $data_array1 = $this->M_data->get_blokirAnggotaProccesed($date1);
    		foreach ($data_array1 as $key1) {
    		    if ($key1->user_jk == "L") {
    		        $jk = "saudara";
    		    } else if ($key1->user_jk == "P") {
    		        $jk = "saudari";
    		    } else {
    		        $jk = "saudara/i";
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
    			$this->email->to($key1->user_email);
    			$this->email->subject('Info Pengembalian Buku di Perpustakaan Pemda Karawang');
    			$this->email->message('Selamat '.$waktu.'..<p align="justify"> Diberitahukan kepada '.$jk.' '.$key1->user_nama.', bahwa akun Anda telah diblokir, karena melewati batas waktu pengembalian buku lebih dari 30 hari di Perpustakaan Pemda Karawang.</p>Terimakasih..<p align="justify">Dinas Perpustakaan dan Kearsipan Daerah Kabupaten Karawang.<br>Jalan Jendaral A.Yani nomor 10 Kelurahan Nagarasari, Kecamatan Karawang Barat, Kabupaten Karawang, Provinsi Jawa Barat 41316.</p>Silahkan kunjung website Kami : https://e-web.id/');

    	    	if ($jam_now > "05 00 00" && $jam_now < "18 59 59") {
            	    $old_date = $key1->peminjaman_sampai;
                    $next_due_date = date('Y-m-d', strtotime($old_date. ' +30 days'));
    	    	    $cekBlokir = $key1->user_backlist;
    	    	    if ($cekBlokir != 1){
        				if ($next_due_date == date('Y-m-d')) {
        					$change1 =["user_backlist" => 1];
        					$where1 = ["user_id" => $key1->user_id];
        					$check1 = $this->M_data->updateData($change1, $where1, "tb_user");
            			    if ($check1) {
            			        $this->email->send();
            			    }
        				}
    	    	    }
            	} 
    		}       
        }
    }
?>