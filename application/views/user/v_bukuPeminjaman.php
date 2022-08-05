<div class="container-fluid konten">
	<h4 class="text-light text-center" data-aos="fade-up" data-aos-duration="1000"><?= $title; ?></h4>
	<hr>
	<div class="row d-flex flex-wrap justify-content-center">
		<?php foreach ($buku as $b) { ?>
			<div class="col-md-3 mb-4">
				<div class="card user shadow" data-aos="fade-up" data-aos-duration="1000">
					<img src="<?= base_url('vendor/img/buku/' . $b->buku_foto); ?>" alt="" class="card-img-top gbr">
					<div class="card-body">
						<h6 class="card-title"><?= $b->buku_judul ?></h6>
						<div class="card-title">
							<p>Penulis: <?= $b->buku_penulis; ?></p>
							<p>Tahun Terbit: <?= $b->buku_tahunTerbit; ?></p>
							<p>Tebal Buku: <?= $b->buku_tebal; ?></p>
							<a href="<?= base_url('pinjamBuku/' . $b->buku_id); ?>" class="btn btn-sm btn-primary">Pinjam</a>
						</div>
					</div>
				</div>
			</div>
		<?php } ?>
	</div>
	<?= $link; ?>
</div>
