<?= $this->session->flashdata('pesan'); ?>
<div class="container konten">
	<div class="row justify-content-center">
		<div class="col-md-4">
			<div class="o-hidden border-0 shadow-lg " data-aos="fade-down" data-aos-duration="1000">
				<h4 class="text-center"><?= $title; ?></h4>
			</div>
		</div>
	</div>
		<!-- Outer Row -->
	<div class="row justify-content-center" data-aos="fade-up" data-aos-duration="1000">
		<div class="col-md-4">
			<div class="o-hidden border-0 shadow-lg">
				<!-- Nested Row within Card Body -->
				<div class="row">
					<div class="col-lg-12">
						<div class="p-5">
							<?= form_open('verifikasiEmail_lupaKodeAkses') ?>
							<div class="form-group">
								<label>Username</label>
								<input type="text" name="user_username" class="form-control form-control-user" placeholder="Masukan username Anda">
								<?= form_error('user_username', '<small class="text-danger">', '</small>'); ?>
							</div>
							<div class="form-group">
								<label>Kode Verifikasi</label>
								<input type="number" name="user_verifikasi" class="form-control form-control-user" placeholder="Masukan kode verifikasi Anda">
								<?= form_error('user_verifikasi2', '<small class="text-danger">', '</small>'); ?>
							</div>
							<button data-aos="fade-right" data-aos-duration="1000" type="submit" class="btn btn-success btn-sm"><i class="fas fa-arrow-circle-right  fa-sm fa-fw mr-2 text-gray-400"></i>Lanjut</button>
							<?= form_close(); ?>
							<hr>
							<div class="text-center" data-aos="fade-left" data-aos-duration="1000">
								<a class="small" href="<?= base_url('login'); ?>">Kembali ke halaman login</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
