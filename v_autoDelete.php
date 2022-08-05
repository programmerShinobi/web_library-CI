<?php 
    date_default_timezone_set('Asia/Jakarta');

    $server = "localhost";
    $user = "ewebid_admin_perpus";
    $pass = "@dm!n_perpus";
    $database = "ewebid_perpus";
    $con = mysqli_connect("localhost", "ewebid_admin_perpus", "@dm!n_perpus", "ewebid_perpus");
    mysqli_select_db($con, "ewebid_perpus");

	$plus1years_date =  date('Y-m-d', strtotime('+365days'));
	$min1years_date =  date('Y-m-d', strtotime('-365days'));
	$plus1weeks_date =  date('Y-m-d', strtotime('+1weeks'));
	$min1weeks_date =  date('Y-m-d', strtotime('-1weeks'));
	$min1days_date =  date('Y-m-d', strtotime('-1days'));
	
	$deleteBooking = ("DELETE FROM tb_booking WHERE booking_waktu='$min1weeks_date'");
    mysqli_query ($con,$deleteBooking);
   
   	$deleteCart = ("DELETE FROM tb_cart WHERE cart_tanggal='$min1days_date'");
    mysqli_query ($con,$deleteCart); 
    
    $deletePengunjung = ("DELETE FROM tb_pengunjung WHERE waktu='$min1years_date'");
    mysqli_query ($con,$deletePengunjung); 
    
    $deleteLog = ("DELETE FROM tb_log WHERE log_tanggal='$min1years_date'");
    mysqli_query ($con,$deleteLog);
?>
