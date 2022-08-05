<?php 
    date_default_timezone_set('Asia/Jakarta');
    
    $hariIni = date('D', strtotime('+1days'));
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
	
	$bulanIni = date('m', strtotime('+1days'));
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
    
    $server = "localhost";
    $user = "ewebid_admin_perpus";
    $pass = "@dm!n_perpus";
    $database = "ewebid_perpus";
    $con = mysqli_connect("localhost", "ewebid_admin_perpus", "@dm!n_perpus", "ewebid_perpus");
    mysqli_select_db($con, "ewebid_perpus");

    $date = date('Y-m-d', strtotime('+1days'));

    $dataa = mysqli_query($con,"SELECT * FROM tb_peminjaman JOIN tb_user on tb_peminjaman.peminjaman_user = tb_user.user_id WHERE peminjaman_sampai='$date'");

    while ($key = mysqli_fetch_array($dataa,MYSQLI_ASSOC))
    {		
	    if ($key['user_jk'] == "L") {
	        $jk = "saudara";
	    } else if ($key['user_jk'] == "P") {
	        $jk = "saudari";
	    } else {
	        $jk = "saudara/i";
	    }
        ini_set( 'display_errors', 1 );   
        error_reporting( E_ALL );    
        $from = "eperpusipkrw@gmail.com";    
        $to = $key['user_email'];    
        $subject = "Info Pengembalian Buku di Perpustakaan Pemda Karawang";    
        $message = 'Selamat '.$waktu.'..<p align="justify"> Diberitahukan kepada '.$jk.' '.$key['user_nama'].', bahwa batas waktu pengembalian buku di Perpustakaan Pemda Karawang sampai hari '.$hariIni.', '.date('j', strtotime('+1days')).' '.$bulanIni.' '.date('Y', strtotime('+1days')).', jika belum mengembalikan buku sesuai dengan batas waktu pengembalian buku, maka Anda dikenakan denda sebesar Rp. 5000 perhari. Denda tersebut akan dilipat gandakan perharinya, terhitung dari tanggal batas waktu pengembalian buku.</p>Terimakasih..<p align="justify">Dinas Perpustakaan dan Kearsipan Daerah Kabupaten Karawang.<br>Jalan Jendaral A.Yani nomor 10 Kelurahan Nagarasari, Kecamatan Karawang Barat, Kabupaten Karawang, Provinsi Jawa Barat 41316.</p>Silahkan kunjung website Kami : https://e-web.id/';
        $headers = 'From:' . $from . "\r\n";
        $headers .= 'Content-type: text/html'."\r\n";
        $process = mail($to,$subject,$message,$headers);

        if($process){
            echo '<p align="justify">Email berhasil terkirim ke '.$key['user_nama'].' / '.$key['user_noId'].' mengenai pengembalian buku di perpustakaan. </p>';
        }else{
             echo '<p align="justify">Email gagal terkirim ke '.$key['user_nama'].' / '.$key['user_noId'].' mengenai pengembalian buku di perpustakaan.</p>';
        }
	}
?>
