<?php

  
  function protek_login()
  {
    $ci = get_instance();

    if(!$ci->session->userdata('status')) {
      $ci->session->set_flashdata('pesan', '<script>sweet("Gagal Masuk!","Wajib login terlebih dahulu!","error","Tutup");</script>');
      
      redirect('login');
    }
  }

  function get_pengunjung()
  {
    $ci = get_instance();
    $pengunjung = new stdClass();
    $pengunjung->browser = $_SERVER["HTTP_USER_AGENT"];
    $pengunjung->alamat_ip = $_SERVER["REMOTE_ADDR"];
    $data = [
      "browser" => $pengunjung->browser,
      "alamat_ip" => $pengunjung->alamat_ip,
      "waktu" => date("Y-m-d")
    ];
    $ci->db->insert("tb_pengunjung", $data);
  }

  function hariIndonesia()
  {
    $hariIni = date('D');
		if($hariIni == "Sun") {
		$hariIni='Minggu';
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

  }

  function genBooking()
  {
    $ci = get_instance();

    date_default_timezone_set('Asia/Jakarta');
    // $cek = $ci->db->where("TIME(booking_expired) < NOW()")->where('booking_accept = 0')->get('tb_booking');

    // if($cek->num_rows() > 0) {
    //   $data = $cek->result();
    //   foreach($data as $da) {
    //     $data = [
    //       'booking_accept' => 2
    //     ];
    //     $where = ['booking_id' => $da->booking_id];
  
    //     $ci->db->where($where)->update('tb_booking',$data);

    //     $where = ['buku_id' => $da->booking_buku];
    //     $buku = $ci->db->get_where('tb_buku',$where)->row();

    //     $data = [
    //       'buku_stok' => $buku->buku_stok+$da->booking_jumlah
    //     ];
    //     $ci->db->where($where)->update('tb_buku',$data);
    //   }
    // }  
  }

?>
