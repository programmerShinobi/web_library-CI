<head>
	<title><?= $title; ?> </title>
</head>
<?= $this->session->flashdata('pesan'); ?>

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
							<?= form_open('profilePassword'); ?>
							<div class="form-group">
								<div class="input-group">
									<input type="password" class="form-control form-control-user" placeholder="Password Lama" name="passLama" id="passG1">
									<div class="input-group-append">
										<!-- kita pasang onclick untuk merubah icon buka/tutup mata setiap diklik  -->
										<span id="mybuttonG1" onclick="changeG1()" class="input-group-text">
											<!-- icon mata bawaan bootstrap  -->
											<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-eye-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
												<path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z" />
												<path fill-rule="evenodd" d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z" />
											</svg>
										</span>
									</div>
								</div>
								<?= form_error('passLama', '<small class="text-danger">', '</small>') ?>
							</div>
							<div class="form-group">
								<div class="input-group">
									<input type="password" class="form-control form-control-user" placeholder="Password Baru" name="passBaru" id="passG2">
									<div class="input-group-append">
										<!-- kita pasang onclick untuk merubah icon buka/tutup mata setiap diklik  -->
										<span id="mybuttonG2" onclick="changeG2()" class="input-group-text">
											<!-- icon mata bawaan bootstrap  -->
											<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-eye-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
												<path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z" />
												<path fill-rule="evenodd" d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z" />
											</svg>
										</span>
									</div>
								</div>
								<?= form_error('passBaru', '<small class="text-danger">', '</small>') ?>
							</div>
							<div class="form-group">
								<div class="input-group">
									<input type="password" class="form-control form-control-user" placeholder="Ulangi Password Baru" name="retypeBaru" id="passG3">
									<div class="input-group-append">
										<!-- kita pasang onclick untuk merubah icon buka/tutup mata setiap diklik  -->
										<span id="mybuttonG3" onclick="changeG3()" class="input-group-text">
											<!-- icon mata bawaan bootstrap  -->
											<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-eye-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
												<path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z" />
												<path fill-rule="evenodd" d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z" />
											</svg>
										</span>
									</div>
								</div>
								<?= form_error('retypeBaru', '<small class="text-danger">', '</small>') ?>
							</div>
							<?= form_submit('Ganti', 'Ganti', 'class="btn btn-success btn-sm"') ?>
							<?= form_close(); ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
