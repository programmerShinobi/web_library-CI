<div class="container konten">
	<br>
	<h4 class="text-center"><?= $title; ?></h4>
	<hr>
	<div class="row justify-content-center">
		<?php foreach ($list_cari as $item) {
			$status = $item->buku_status;
			if ($status == 1) { ?>
				<div class="col-md-3 text-dark">
					<div data-aos="fade-up" data-aos-duration="1000" class="card-body shadow mr-auto ml-md-2 my-2 my-md-2 mw-100 mx-auto my-auto mw-auto">
						<img src="<?= base_url('vendor/img/buku/' . $item->buku_foto); ?>" alt="" class="img-top gbr-buku">
						<hr>
						<div class="body mt-100 md-100 mx-auto my-auto mw-auto">
							<div class="title mt-100 md-100 mx-auto my-auto mw-auto">
								<h6 style="font-size: 14px;"><?= $item->buku_judul; ?></h6>
								<h6 style="font-size: 14px;">Penerbit : <?= $item->buku_penerbit; ?></h6>
								<h6 style="font-size: 14px;">Terbit : <?= $item->buku_tahunTerbit; ?></h6>
								<h6 style="font-size: 14px;">Kelas : <?= $item->buku_noSKU; ?></h6>
								<h6 style="font-size: 14px;">Rak : <?= $item->buku_rak; ?></h6>
								<h6 style="font-size: 14px;">Stok : <?= $item->buku_stok; ?></h6>
							</div>
						</div>
						<hr>
						<?php
						$stok = $item->buku_stok;
						if ($stok <= 0) { ?>
						<?php
						} else { ?>
							<div class="shadow">
								<a href="<?= base_url('pinjam_buku/' . $item->buku_id); ?>" class="btn btn-sm btn-success btn-block">Booking</a>
							</div>
						<?php
						}
						?>
					</div>
				</div>
		<?php }
		} ?>
	</div>
</div>
