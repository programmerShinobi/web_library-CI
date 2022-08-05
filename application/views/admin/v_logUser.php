<?= $this->session->flashdata('pesan'); ?>
<div class="container-fluid">
	<h4><?= $title; ?></h4>
	<div class="card">
		<div class="card-body">
			<?= form_open('logUser'); ?>
			<div class="row">
				<div class="col">
					<label>Period Start</label>
					<input type="date" class="form-control" name="start_order_date" id="inputStartDate">
				</div>
				<div class="col">
					<label>Period End</label>
					<input type="date" class="form-control" name="end_order_date" id="inputEndDate">
				</div>
			</div>
			<input type="submit" class="btn btn-primary btn-sm my-3" value="Filter">
			<?= form_close(); ?>
			<hr>
			<div class="table-responsive">
				<table class="table table-bordered table-hover" id="dataVisibility">
					<thead>
						<tr>
							<th width="1%">#</th>
							<th>User</th>
							<th>Role</th>
							<th>Tanggal Login</th>
							<th>Jam Login</th>
						</tr>
					</thead>
					<tbody>
						<?php $no = 1;
						foreach ($log_user as $item) { ?>
							<tr>
								<td><?= $no++; ?></td>
								<td><?= $item->user_nama; ?></td>
								<td>
									<?php
									if ($item->user_role == 1) {
										echo "Admin";
									} elseif ($item->user_role == 2) {
										echo "Petugas";
									} elseif ($item->user_role == 3) {
										echo "Anggota";
									} elseif ($item->user_role == 4) {
										echo "Petugas Perpustakaan (Sekolah)";
									} elseif ($item->user_role > 4) {
										echo "Petugas Perpustakaan (Pemda)";
									}
									?>
								</td>
								<td><?= date("d M Y", strtotime($item->log_tanggal)); ?></td>
								<td><?= date("H:i:s", strtotime($item->log_time)); ?></td>
							</tr>
						<?php } ?>
					</tbody>
				</table>
				<hr>
				<center class="card badge-danger text-white"><b>"Dalam waktu 1 tahun, data akan otomatis terhapus !" </b></center>
			</div>
		</div>
	</div>
</div>
