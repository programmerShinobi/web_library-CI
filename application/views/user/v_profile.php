<head>
	<title><?= $title; ?> </title>
</head>
<?= $this->session->flashdata('pesan'); ?>
<div class="container konten">
	<br>
	<div class="row justify-content-center">
		<div class="col-md-4">
			<div class="o-hidden border-0 shadow-lg " data-aos="fade-down" data-aos-duration="1000">
				<h4 class="text-center"><?= $title; ?></h4>
			</div>
		</div>
	</div>
	<!-- Outer Row -->
	<div class="row justify-content-center">
		<div class="col-md-4">
			<div class="o-hidden border-0 shadow-lg " data-aos="fade-up" data-aos-duration="1000">
				<!-- Nested Row within Card Body -->
				<div class="row">
					<div class="col-lg-12">
						<div class="p-5">
							<img src="<?= base_url('vendor/img/user/' . $u->user_foto); ?>" alt="Foto Profile" class="d-block mx-auto rounded-circle gbr-profile">
							<?= form_open_multipart('myprofile'); ?>
							<br><br><br>
							<div class="form-group">
								<label>Foto</label>
								<?= form_upload('foto', '', 'class="form-control form-control-file text-center"'); ?>
							</div>
							<div class="form-group">
								<label>Nama</label>
								<?= form_input('nama', $u->user_nama, 'class="form-control text-center"'); ?>
								<?= form_error('nama', '<small class="text-danger">', '</small>') ?>
							</div>
							<div class="form-group">
								<label>Username</label>
								<?= form_input('username', $u->user_username, 'class="form-control text-center" disabled') ?>
							</div>
							<div class="form-group">
								<label>Nomor HP</label>
								<?= form_input('hp', $u->user_noHP, 'class="form-control text-center"'); ?>
								<?= form_error('hp', '<small class="text-danger">', '</small>') ?>
							</div>
							<div class="form-group">
								<label>Email</label>
								<?= form_input('email', $u->user_email, 'class="form-control text-center"') ?>
								<?= form_error('email', '<small class="text-danger">', '</small>') ?>
							</div>
							<div class="form-group card ">
								<?= form_submit('submit', 'Simpan', 'class="btn btn-success btn-sm"') ?>
							</div>
							<?= form_close(); ?>
							<div class="form-group card ">
								<a href="<?= base_url('cardAnggota/' . $u->user_id); ?>" target="_blank" class="btn btn-primary btn-sm"><i class="fa fa-id-card"></i> Lihat Kartu Digital</a>
							</div>
							<br>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
