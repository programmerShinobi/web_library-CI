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
			text-align: center;
			height: 100%;
			width: 100%;
		}
	</style>
</head>

<body class="bg-utama">
	<?= $this->session->flashdata('pesan');?>
	<div class="container">
		<?php if ($this->session->userdata('admin_id')) : ?>
			<br>
			<div class="row shadow justify-content-center" data-aos="fade-down" data-aos-duration="1500">
				<h4>BUKU TAMU</h4>
			</div>
		<?php else : ?>
			<div class="row shadow justify-content-center" data-aos="fade-down" data-aos-duration="1500">
				<h4>BUKU TAMU</h4>
			</div>
		<?php endif; ?>
		<!-- Nested Row within Card Body -->
		<div class="row shadow justify-content-center" data-aos="fade-up" data-aos-duration="1500">
			<?= form_open('buku_tamu') ?>
			<div class="row justify-content-center">
				<div class="col-md mx-auto">
					<div class="text-center">
						<div class="form-group">
							<label class="text-center">Nama</label>
							<input type="text" name="pengunjung_nama" class="form-control text-center form-control-user" placeholder="Masukkan nama lengkap" required autofocus>
							<?= form_error('pengunjung_nama', '<small class="text-danger" ><b>', '</b></small>') ?>
						</div>
						<div class="form-group">
							<label class="text-center">Jenis Kelamin</label>
							<select class="form-control form-control-user" id="pengunjung_jk" name="pengunjung_jk">
								<option class="text-center" disabled selected>-- Pilih Jenis Kelamin --</option>
								<option class="text-center" value="L">Laki - laki</option>
								<option class="text-center" value="P">Perempuan</option>
							</select>
							<?= form_error('pengunjung_jk', '<small class="text-danger" ><b>', '</b></small>') ?>
						</div>
						<div class="form-group">
							<label class="text-center">Klasifikasi</label>
							<select class="form-control form-control-user" id="pengunjung_klasifikasi" name="pengunjung_klasifikasi">
								<option class="text-center" disabled selected>-- Pilih Klasifikasi --</option>
								<?php foreach ($pekerjaan as $item) { ?>
									<option vclass="text-center" alue="<?php echo $item->pekerjaan_id; ?>"><?php echo $item->pekerjaan; ?></option>
								<?php } ?>
							</select>
							<?= form_error('pengunjung_klasifikasi', '<small class="text-danger" ><b>', '</b></small>') ?>
						</div>
						<div class="form-group">
							<label class="text-center">Alamat</label>
							<input type="text" name="pengunjung_alamat" id="pengunjung_alamat" placeholder="Masukkan alamat" class="form-control text-center form-control-user" required>
							<?= form_error('pengunjung_alamat', '<small class="text-danger" ><b>', '</b></small>') ?>
						</div>
						<div class="form-group">
							<label class="text-center">Informasi Yang Dicari </label>
							<select class="form-control  form-control-user" id="pengunjung_info" name="pengunjung_info">
								<option class="text-center" disabled selected>-- Pilih Informasi Yang Dicari--</option>
								<option class="text-center" value="Baca">Baca Buku</option>
								<option class="text-center" value="Pinjam">Pinjam Buku</option>
								<option class="text-center" value="Kembali">Kembalikan Buku</option>
							</select>
							<?= form_error('pengunjung_info', '<small class="text-danger" ><b>', '</b></small>') ?>
						</div>
						<button type="submit" class="btn btn-success btn-user btn-block " style="display: inline;"><i class="fas fa-plus fa-sm fa-fw mr-2"></i>Submit</button>
						<br><br>
					</div>
				</div>
				<?= form_close(); ?>
			</div>
		</div>
	</div>


	<!-- Font Awesome -->
	<script src="https://kit.fontawesome.com/0c21508fc5.js" crossorigin="anonymous"></script>

	<!-- Bootstrap core JavaScript-->
	<script src="<?= base_url('vendor/vendor/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>

	<!-- Core plugin JavaScript-->
	<script src="<?= base_url('vendor/vendor/jquery-easing/jquery.easing.min.js') ?>"></script>

	<!-- Custom scripts for all pages-->
	<script src="<?= base_url('vendor/js/sb-admin-2.min.js') ?>"></script>

	<script src="<?= base_url('vendor/datatables/js/jquery.dataTables.js'); ?>"></script>
	<script src="<?= base_url('vendor/datatables/js/dataTables.bootstrap4.min.js'); ?>"></script>
	<script src="<?= base_url('/vendor/js/demo.js'); ?>"></script>
	<!-- Core Bootstrap -->
	<script src="<?= base_url('vendor/vendor/bootstrap/js/bootstrap.min.js'); ?>"></script>
	<script src="<?= base_url('vendor/vendor/bootstrap/js/cari.js'); ?>"></script>
	<!-- Font Awesome -->
	<script src="<?= base_url('vendor/font-awesome/js/all.min.js') ?>"></script>
	<!-- AOS -->
	<script src="<?= base_url('vendor/js/aos.js'); ?>"></script>
	<script>
		AOS.init();
	</script>
	<script>
		// membuat fungsi change
		function change() {

			// membuat variabel berisi tipe input dari id='pass', id='pass' adalah form input password 
			var x = document.getElementById('pass').type;

			//membuat if kondisi, jika tipe x adalah password maka jalankan perintah di bawahnya
			if (x == 'password') {

				//ubah form input password menjadi text
				document.getElementById('pass').type = 'text';

				//ubah icon mata terbuka menjadi tertutup
				document.getElementById('mybutton').innerHTML = `<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-eye-slash-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
																		<path d="M10.79 12.912l-1.614-1.615a3.5 3.5 0 0 1-4.474-4.474l-2.06-2.06C.938 6.278 0 8 0 8s3 5.5 8 5.5a7.029 7.029 0 0 0 2.79-.588zM5.21 3.088A7.028 7.028 0 0 1 8 2.5c5 0 8 5.5 8 5.5s-.939 1.721-2.641 3.238l-2.062-2.062a3.5 3.5 0 0 0-4.474-4.474L5.21 3.089z"/>
																		<path d="M5.525 7.646a2.5 2.5 0 0 0 2.829 2.829l-2.83-2.829zm4.95.708l-2.829-2.83a2.5 2.5 0 0 1 2.829 2.829z"/>
																		<path fill-rule="evenodd" d="M13.646 14.354l-12-12 .708-.708 12 12-.708.708z"/>
																		</svg>`;
			} else {
				//ubah form input password menjadi text
				document.getElementById('pass').type = 'password';
				//ubah icon mata terbuka menjadi tertutup
				document.getElementById('mybutton').innerHTML = `<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-eye-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
																		<path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
																		<path fill-rule="evenodd" d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/>
																		</svg>`;
			}
		}
	</script>
	<script>
		// membuat fungsi change
		function changeG1() {

			// membuat variabel berisi tipe input dari id='pass', id='pass' adalah form input password 
			var x = document.getElementById('passG1').type;

			//membuat if kondisi, jika tipe x adalah password maka jalankan perintah di bawahnya
			if (x == 'password') {

				//ubah form input password menjadi text
				document.getElementById('passG1').type = 'text';

				//ubah icon mata terbuka menjadi tertutup
				document.getElementById('mybuttonG1').innerHTML = `<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-eye-slash-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
																		<path d="M10.79 12.912l-1.614-1.615a3.5 3.5 0 0 1-4.474-4.474l-2.06-2.06C.938 6.278 0 8 0 8s3 5.5 8 5.5a7.029 7.029 0 0 0 2.79-.588zM5.21 3.088A7.028 7.028 0 0 1 8 2.5c5 0 8 5.5 8 5.5s-.939 1.721-2.641 3.238l-2.062-2.062a3.5 3.5 0 0 0-4.474-4.474L5.21 3.089z"/>
																		<path d="M5.525 7.646a2.5 2.5 0 0 0 2.829 2.829l-2.83-2.829zm4.95.708l-2.829-2.83a2.5 2.5 0 0 1 2.829 2.829z"/>
																		<path fill-rule="evenodd" d="M13.646 14.354l-12-12 .708-.708 12 12-.708.708z"/>
																		</svg>`;
			} else {
				//ubah form input password menjadi text
				document.getElementById('passG1').type = 'password';
				//ubah icon mata terbuka menjadi tertutup
				document.getElementById('mybuttonG1').innerHTML = `<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-eye-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
																		<path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
																		<path fill-rule="evenodd" d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/>
																		</svg>`;
			}
		}
	</script>
	<script>
		// membuat fungsi change
		function changeG2() {

			// membuat variabel berisi tipe input dari id='pass', id='pass' adalah form input password 
			var x = document.getElementById('passG2').type;

			//membuat if kondisi, jika tipe x adalah password maka jalankan perintah di bawahnya
			if (x == 'password') {

				//ubah form input password menjadi text
				document.getElementById('passG2').type = 'text';

				//ubah icon mata terbuka menjadi tertutup
				document.getElementById('mybuttonG2').innerHTML = `<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-eye-slash-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
																		<path d="M10.79 12.912l-1.614-1.615a3.5 3.5 0 0 1-4.474-4.474l-2.06-2.06C.938 6.278 0 8 0 8s3 5.5 8 5.5a7.029 7.029 0 0 0 2.79-.588zM5.21 3.088A7.028 7.028 0 0 1 8 2.5c5 0 8 5.5 8 5.5s-.939 1.721-2.641 3.238l-2.062-2.062a3.5 3.5 0 0 0-4.474-4.474L5.21 3.089z"/>
																		<path d="M5.525 7.646a2.5 2.5 0 0 0 2.829 2.829l-2.83-2.829zm4.95.708l-2.829-2.83a2.5 2.5 0 0 1 2.829 2.829z"/>
																		<path fill-rule="evenodd" d="M13.646 14.354l-12-12 .708-.708 12 12-.708.708z"/>
																		</svg>`;
			} else {
				//ubah form input password menjadi text
				document.getElementById('passG2').type = 'password';
				//ubah icon mata terbuka menjadi tertutup
				document.getElementById('mybuttonG2').innerHTML = `<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-eye-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
																		<path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
																		<path fill-rule="evenodd" d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/>
																		</svg>`;
			}
		}
	</script>
	<script>
		// membuat fungsi change
		function changeG3() {

			// membuat variabel berisi tipe input dari id='pass', id='pass' adalah form input password 
			var x = document.getElementById('passG3').type;

			//membuat if kondisi, jika tipe x adalah password maka jalankan perintah di bawahnya
			if (x == 'password') {

				//ubah form input password menjadi text
				document.getElementById('passG3').type = 'text';

				//ubah icon mata terbuka menjadi tertutup
				document.getElementById('mybuttonG3').innerHTML = `<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-eye-slash-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
																		<path d="M10.79 12.912l-1.614-1.615a3.5 3.5 0 0 1-4.474-4.474l-2.06-2.06C.938 6.278 0 8 0 8s3 5.5 8 5.5a7.029 7.029 0 0 0 2.79-.588zM5.21 3.088A7.028 7.028 0 0 1 8 2.5c5 0 8 5.5 8 5.5s-.939 1.721-2.641 3.238l-2.062-2.062a3.5 3.5 0 0 0-4.474-4.474L5.21 3.089z"/>
																		<path d="M5.525 7.646a2.5 2.5 0 0 0 2.829 2.829l-2.83-2.829zm4.95.708l-2.829-2.83a2.5 2.5 0 0 1 2.829 2.829z"/>
																		<path fill-rule="evenodd" d="M13.646 14.354l-12-12 .708-.708 12 12-.708.708z"/>
																		</svg>`;
			} else {
				//ubah form input password menjadi text
				document.getElementById('passG3').type = 'password';
				//ubah icon mata terbuka menjadi tertutup
				document.getElementById('mybuttonG3').innerHTML = `<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-eye-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
																		<path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
																		<path fill-rule="evenodd" d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/>
																		</svg>`;
			}
		}
	</script>
	<!--<script src="https://widget.flowxo.com/embed.js" data-fxo-widget="eyJ0aGVtZSI6IiM2N2MxOGUiLCJ3ZWIiOnsiYm90SWQiOiI1ZmYyNjA4ZWI2YzM2MDAwNzUwM2FjMGUiLCJ0aGVtZSI6IiM2N2MxOGUiLCJsYWJlbCI6IlBlcnB1c3Rha2FhbiBPbmxpbmUifSwid2VsY29tZVRleHQiOiJLcml0aWsgJiBTYXJhbi4uIPCfmYIiLCJwb3B1cEhlaWdodCI6IjUwJSJ9" async defer></script>-->
	<script type="text/javascript">
		window.$crisp = [];
		window.CRISP_WEBSITE_ID = "d15e57ed-3843-452f-9c36-ff4dafb83a98";
		(function() {
			d = document;
			s = d.createElement("script");
			s.src = "https://client.crisp.chat/l.js";
			s.async = 1;
			d.getElementsByTagName("head")[0].appendChild(s);
		})();
	</script>
	<!-- Datatable booking-->
	<script>
		$(function() {
			$("#dataV").DataTable({
				"paging": true,
				"lengthChange": true,
				"searching": true,
				"ordering": true,
				"info": true,
				"autoWidth": false,
				"responsive": true,
				"buttons": ["copy", "colvis"]
			}).buttons().container().appendTo('#dataV_wrapper .col-md-6:eq(0)');
		});
	</script>
	<!-- DataTables-->
	<script src="<?= base_url('vendor/datatables_old/js/jquery.dataTables.js'); ?>"></script>
	<script src="<?= base_url('vendor/datatables_old/js/dataTables.bootstrap4.min.js'); ?>"></script>
	<script src="<?php echo base_url() ?>vendor/datatables/jquery.dataTables.min.js"></script>
	<script src="<?php echo base_url() ?>vendor/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
	<script src="<?php echo base_url() ?>vendor/datatables-responsive/js/dataTables.responsive.min.js"></script>
	<script src="<?php echo base_url() ?>vendor/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
	<script src="<?php echo base_url() ?>vendor/datatables-buttons/js/dataTables.buttons.min.js"></script>
	<script src="<?php echo base_url() ?>vendor/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
	<script src="<?php echo base_url() ?>vendor/jszip/jszip.min.js"></script>
	<script src="<?php echo base_url() ?>vendor/pdfmake/pdfmake.min.js"></script>
	<script src="<?php echo base_url() ?>vendor/pdfmake/vfs_fonts.js"></script>
	<script src="<?php echo base_url() ?>vendor/datatables-buttons/js/buttons.html5.min.js"></script>
	<script src="<?php echo base_url() ?>vendor/datatables-buttons/js/buttons.print.min.js"></script>
	<script src="<?php echo base_url() ?>vendor/datatables-buttons/js/buttons.colVis.min.js"></script>

	<!-- Logout Modal-->
	<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
					<button class="close" type="button" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>
				<div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
				<div class="modal-footer">
					<button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
					<a class="btn btn-primary" href="<?= base_url('logout'); ?>">Logout</a>
				</div>
			</div>
		</div>
	</div>
</body>
<footer class="sticky-footer">
	<div class="copyright text-center text-dark">
		<span>Copyright &copy; <?= date('Y'); ?> FaQih</span>
	</div>
</footer>

</html>
