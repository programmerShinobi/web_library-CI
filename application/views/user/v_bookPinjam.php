<?= $this->session->flashdata('pesan'); ?>
<div class="container konten">
	<div class="">
		<div class="card-body  shadow-lg my-5" data-aos="fade-left" data-aos-duration="1000">
			<h4 class="text-center"><?= $title; ?></h4>
			<?= form_open('buku_saya'); ?>
			<hr>
			<div class="table-responsive ">
				<table class="table table-hover text-dark" id="dataV">
					<thead>
						<tr>
							<th>#</th>
							<th>Buku</th>
							<th>Penerbit</th>
							<th>Tahun Terbit</th>
							<th>Waktu Booking</th>
							<th>Batas Pengembalian</th>
							<th>Kode Booking</th>
							<th>Status</th>
							<!-- <th>Aksi</th> -->
						</tr>
					</thead>
					<tbody>
						<?php $no = 1;
						foreach ($list_booking as $item) : ?>
							<tr>
								<?php
								$bulanIni = date('m', strtotime($item->booking_waktu));
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
								?>
								<td><?= $no++; ?></td>
								<td><?= $item->buku_judul; ?></td>
								<td><?= $item->buku_penerbit; ?></td>
								<td><?= $item->buku_tahunTerbit; ?></td>
								<td>
									<?php
									echo date('j', strtotime($item->booking_waktu)) . "&nbsp;" . $bulanIni . "&nbsp;" . date('Y', strtotime($item->booking_waktu));

									?>
								</td>
								<td>
									<?php
									echo date('j', strtotime($item->booking_pengembalian)) . '&nbsp;' . $bulanIni . '&nbsp;' . date('Y', strtotime($item->booking_pengembalian));
									?>
								</td>
								<td><?= $item->booking_noId; ?></td>
								<td>
									<?php
									if ($item->booking_accept == 0) {
										echo '<div class="badge shadow badge-info">Tunggu dikonfirmasi</div>';
									} elseif ($item->booking_accept == 1) {
										echo '<div class="badge shadow badge-success">Dikonfirmasi</div>';
									} else {
										echo '<div class="badge shadow badge-danger">Ditolak</div>';
									}
									?>
								</td>
								<!-- <td>
									<a href="<?= base_url('booking_delete/' . $item->booking_id); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin menghapus data?')">Hapus</a>
									<p></p>
								</td> -->
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
				<?php if ($no > 1) { ?>
					<hr>
					<center class="card badge-info text-white">
						<b>Note : Jika status "Tunggu dikonfirmasi", maka segera datang ke perpustakaan sebelum pukul 16.00 WIB</b>
					</center>
					<hr>
					<center class="card badge-danger text-white">
						<b>"Dalam waktu 1 pekan, data akan otomatis terhapus !" </b>
					</center>
				<?php } ?>
			</div>
		</div>
	</div>
</div>
