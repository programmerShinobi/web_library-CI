<?= $this->session->flashdata('pesan'); ?>
<div class="container-fluid">
	<h4><?= $title; ?></h4>
	<div class="card">
		<div class="card-body">
			<div class="table-responsive">
				<table class="table table-bordered table-hover" id="dataVisibility">
					<thead>
						<tr>
							<th width="1%">#</th>
							<th>Nomor Booking</th>
							<th>Nama</th>
							<th>Buku</th>
							<th>Jumlah</th>
							<th>Tanggal Booking</th>
							<th>Tanggal Pengembalian</th>
							<th>Waktu Expired</th>
							<th>Opsi</th>
							<!--<th>Aksi</th>-->
						</tr>
					</thead>
					<tbody>
						<?php $no = 1;
						foreach ($booking as $item) : ?>
							<tr>
								<td><?= $no++; ?></td>
								<td><?= $item->booking_noId; ?></td>
								<td><?= $item->user_nama; ?></td>
								<td><?= $item->buku_judul; ?></td>
								<td><?= $item->booking_jumlah; ?></td>
								<td><?= date('d M Y', strtotime($item->booking_waktu)); ?></td>
								<td><?= date("d M Y", strtotime($item->booking_pengembalian)); ?></td>
								<td><?= date('d M Y H:i:s', strtotime($item->booking_expired)); ?></td>
								<td>
									<?php if ($item->booking_accept == 0) : ?>
										<a href="<?= base_url('process_booking_tolak/' . $item->booking_id); ?>" class="btn btn-danger btn-sm mb-2" onclick="return confirm('Yakin menolak data booking?')">Tolak</a>
										<a href="<?= base_url('process_booking_terima/' . $item->booking_id); ?>" class="btn btn-success btn-sm">Terima</a>
									<?php elseif ($item->booking_accept == 1) : ?>
										<div class="badge badge-success">Diterima</div>
									<?php elseif ($item->booking_accept == 2) : ?>
										<div class="badge badge-danger">Ditolak</div>
									<?php endif; ?>
								</td>
								<?php if ($user->user_role == 1) { ?>
									<td>
										<?php if ($item->booking_accept == 1 || $item->booking_accept == 2) : ?>
											<?php if ($user->user_role == 1) { ?>
												<a href="<?= base_url('process_booking_delete/' . $item->booking_id); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin menghapus data?')">Hapus</a>
											<?php
											} else { ?>
												<p>-</p>
											<?php } ?>
										<?php endif; ?>
									</td>
								<?php } ?>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
				<hr>
				<center class="card badge-danger text-white"><b>"Dalam waktu 1 pekan, data akan otomatis terhapus !" </b></center>
			</div>
		</div>
	</div>
</div>
