<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-4">
			<div class="o-hidden border-0 shadow-lg " data-aos="fade-down" data-aos-duration="1000">
				<h4 class="text-center">LUPA PASSWORD</h4>
			</div>
		</div>
	</div>
	<!-- Outer Row -->
	<div class="row justify-content-center" data-aos="fade-up" data-aos-duration="1000">
		<div class="col-md-4">
			<div class="o-hidden border-0 shadow-lg">
				<div class="card-body">
					<div class="text-center">
						<!-- <h1 class="h4 text-900 text-dark mb-4">LUPA PASSWORD</h1> -->
					</div>
					<?= form_open('pertanyaan') ?>
					<div class="form-group">
						<label><?= $pertanyaan->pertanyaan; ?></label>
						<input type="text" name="jawaban" class="form-control form-control-user" placeholder="Masukan jawaban anda">
						<?= form_error('jawaban', '<small class="text-danger">', '</small>'); ?>
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
