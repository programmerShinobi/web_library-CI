<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="<?= base_url('vendor/css/bootstrap.min.css'); ?>">
	<!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> -->

	<!-- AOS -->
	<link rel="stylesheet" href="<?= base_url('vendor/css/aos.css'); ?>">

	<!-- Custom -->
	<link rel="stylesheet" href="<?= base_url('vendor/css/custom.css'); ?>">

	<!-- Font Awesome -->
	<link rel="stylesheet" href="<?= base_url('vendor/font-awesome/css/all.min.css'); ?>">

	<!-- icon Title -->
	<link rel="icon" href="<?= base_url('vendor/img/Icon/Karawang.png'); ?>">

	<!-- Custom fonts for this template-->
	<link href="<?= base_url('vendor/vendor/fontawesome-free/css/all.min.css') ?>" rel="stylesheet" type="text/css">
	<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

	<!-- jQuery -->
	<script src="<?= base_url('vendor/vendor/jquery/jquery.min.js') ?>"></script>
	<script src="<?= base_url('vendor/js/sweet.js'); ?>"></script>
	<script src="<?= base_url('/vendor/js/custom.js'); ?>"></script>

	<!-- Custom styles for this template-->
	<link href="<?= base_url('vendor/css/sb-admin-2.min.css') ?>" rel="stylesheet">

	<!-- DataTables -->
	<link rel="stylesheet" href="<?php echo base_url('vendor/datatables-bs4/css/dataTables.bootstrap4.min.css') ?>">
	<link rel="stylesheet" href="<?php echo base_url('vendor/datatables-responsive/css/responsive.bootstrap4.min.css') ?>">
	<link rel="stylesheet" href="<?php echo base_url('vendor/datatables-buttons/css/buttons.bootstrap4.min.css') ?>">
	<!-- <link rel="stylesheet" href="<?= base_url('vendor/datatables_old/css/dataTables.bootstrap4.min.css'); ?>"> -->

	<script src="<?= base_url('vendor/ckeditor/ckeditor.js'); ?>"></script>

	<title><?= $title; ?></title>

	<style type="text/css">
		html,
		body {
			height: 100%;
		}

		.bg-utama {
			background-image: url("<?= base_url('vendor/img/website/back_image.png') ?>");
			/* no-repeat; */
			background-size: 100% 100%;
			background-attachment: fixed;
			background-size: cover;
			background-position: center;
			/* text-align: center; */
			height: 100%;
			width: 100%;
		}
	</style>
</head>

<body class="bg-utama">
	<nav class="navbar navbar-expand-md navbar-light bg-light fixed-top">
		<div class="container">
			<a href="<?= base_url('index'); ?>" class="navbar-brand"></a>
			<button class="navbar-toggler" data-toggle="collapse" data-target="#navbar">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse my-1" id="navbar">
				<div class="navbar-nav">
					<div class="nav-item">
						<a href="<?= base_url('index') ?>" class="nav-link"><i class="fas fa-fw fa-thin fa-landmark"></i> Home</a>
					</div>
					<!-- <li class="nav-item">
						<a href="<?= base_url('koleksi_buku') ?>" class="nav-link"> <i class="fas fa-fw fa-thin fa-book"></i> Koleksi</a>
					</li> -->
					<div class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown">
							<i class="fas fa-fw fa-thin fa-folder"></i> Layanan
						</a>
						<div class="dropdown-menu">
							<a class="dropdown-item" href="<?= base_url('koleksi_buku') ?>"><i class="fas fa-fw fa-thin fa-book"></i> Koleksi Buku</a>
							<a class="dropdown-item" href="<?= base_url('koleksi_literasi') ?>"><i class="fas fa-fw fa-thin fa-archive"></i> Koleksi Literasi</a>
							<a class="dropdown-item" href="<?= base_url('koleksi_film') ?>"><i class="fas fa-fw fa-thin fa-film"></i> Koleksi Film</a>
							<a class="dropdown-item" href="<?= base_url('usulan') ?>"><i class="fas fa-fw fa-thin fa-receipt"></i> Survei Kebutuhan Pemustaka</a>
							<!-- <a class="dropdown-item" href="<?= base_url('buku_tamu') ?>"><i class="fas fa-fw fa-users"></i> Buku Tamu</a> -->
							<!-- <hr>
							<a class="dropdown-item" target="_blank" href="https://bni.perpusnas.go.id/"><i class="fas fa-fw fa-solid fa-flag-checkered"></i> Bibliografi Nasional</a> -->
						</div>
					</div>
					<?php if ($this->session->userdata('admin_id')) { ?>
						<div class="nav-item dropdown">
							<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown">
								<i class="fas fa-fw fa-thin fa-bookmark "></i> Booking
							</a>
							<div class="dropdown-menu">
								<a class="dropdown-item" href="<?= base_url('pinjaman_saya') ?>"><i class="fas fa-fw fa-thin fa-cart-arrow-down"></i> Keranjang Buku (<?= $total_pinjaman; ?>)</a>
								<a class="dropdown-item" href="<?= base_url('buku_saya') ?>"><i class="fas fa-fw fa-thin fa-tags"></i> Booking Buku (<?= $total_buku_saya; ?>)</a>
								<a class="dropdown-item" href="<?= base_url('buku_pinjam') ?>"><i class="fas fa-fw fa-thin fa-book-reader"></i> Peminjaman Buku (<?= $total_buku_pinjam; ?>)</a>
							</div>
						</div>
					<?php }
					echo $this->session->flashdata('pesan'); ?>
					<?php if ($this->session->userdata('admin_id')) { ?>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<?php } else { ?>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<?php } ?>
					<div class='form'>
						<form action="<?php echo base_url("cari_buku"); ?>" method="GET">
							<div class="input-group my-1">
								<input type="text" placeholder="Pencarian Buku ..." name='buku' aria-label="Search" class="search-input form-control my-6" required>
								<div class="input-group-append">
									<button class="btn btn-primary" type="submit">
										<i class="fas fa-search fa-sm"></i>
								</div>
							</div>
						</form>
					</div>
				</div>

				<?php if ($this->session->userdata('admin_id')) : ?>
					<nav class="navbar-nav ml-auto navbar-expand topbar static-top">
						<!-- Topbar Navbar -->
						<div class="navbar-nav ml-auto">
							<div class="nav-item no-arrow">
								<div class="nav-link">
									<span class="mr-2 d-lg-inline text-gray-600 small">
										<?php
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
										$bulaniIni = date('m');
										if ($bulaniIni == "01") {
											$bulaniIni = 'Januari';
										} else if ($bulaniIni == "02") {
											$bulaniIni = 'Februari';
										} else if ($bulaniIni == "03") {
											$bulaniIni = 'Maret';
										} else if ($bulaniIni == "04") {
											$bulaniIni = 'April';
										} else if ($bulaniIni == "05") {
											$bulaniIni = 'Mei';
										} else if ($bulaniIni == "06") {
											$bulaniIni = 'Juni';
										} else if ($bulaniIni == "07") {
											$bulaniIni = 'Juli';
										} else if ($bulaniIni == "08") {
											$bulaniIni = 'Agustus';
										} else if ($bulaniIni == "09") {
											$bulaniIni = 'September';
										} else if ($bulaniIni == "10") {
											$bulaniIni = 'Oktober';
										} else if ($bulaniIni == "11") {
											$bulaniIni = 'November';
										} else if ($bulaniIni == "12") {
											$bulaniIni = 'Desember';
										}
										echo $hariIni;
										echo ",&nbsp";
										echo date("d");
										echo "&nbsp";
										echo $bulaniIni;
										echo "&nbsp";
										echo date("Y");
										?>
									</span>
								</div>
							</div>
							<div class="topbar-divider d-sm-block"></div>
							<div class="nav-item dropdown no-arrow">
								<a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									<!--<span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $user->user_nama; ?></span>-->
									<img class="img-profile rounded-circle" src="<?= base_url('vendor/img/user/' . $user->user_foto); ?>">
								</a>
								<!-- Dropdown - User Information -->
								<div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
									<a class="dropdown-item" href="<?= base_url('myprofile'); ?>">
										<i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
										Profile
									</a>
									<a class="dropdown-item" href="<?= base_url('profilePassword'); ?>">
										<i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
										Ganti Password
									</a>
									<div class="dropdown-divider"></div>
									<a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
										<i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
										Logout
									</a>
								</div>
							</div>
						</div>
					</nav>
				<?php else : ?>
					<hr>
					<div class="navbar-nav ml-auto ">
						<a href="<?= base_url('login'); ?>" class="btn btn-sm btn-outline-primary mx-2 my-2"><i class="fas fa-sign-in-alt fa-sm fa-fw mr-2"></i>Login</a>
						<a href="<?= base_url('register'); ?>" class="btn btn-sm btn-outline-success mx-2 my-2"><i class="fas fa-user-plus fa-sm fa-fw mr-2"></i>Registrasi</a>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</nav>
