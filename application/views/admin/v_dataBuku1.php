<!-- <?= $this->session->flashdata('pesan'); ?>
<div class="container-fluid">
	<h4>Data Buku</h4>
	<div class="card">
		<div class="card-body">
			<table class="table table-bordered table-hover table-responsive" id="dataVisibility">
				<thead>
					<tr>
						<th width="1%">#</th>
						<th>Judul</th>
						<th>Penulis</th>
						<th>Edisi</th>
						<th>Penerbit</th>
						<th>Tahun Terbit</th>
						<th>Kelas</th>
						<th>Stok</th>
						<th>Tahun Anggaran</th>
						<th>Foto</th>
						<th>Status</th>
					</tr>
				</thead>
				<tbody>
					<?php $no = 1;
					foreach ($list_katalog as $item) { ?>
						<tr>
							<td><?= $no++; ?></td>
							<td><?= $item->buku_judul; ?></td>
							<td><?= $item->buku_penulis; ?></td>
							<td><?= $item->buku_edisi; ?></td>
							<td><?= $item->buku_penerbit; ?></td>
							<td><?= $item->buku_tahunTerbit; ?></td>
							<td><?= $item->buku_noSKU; ?></td>
							<td><?= $item->buku_stok; ?></td>
							<td><?= $item->buku_tahunAnggaran; ?></td>
							<td><img src="<?= base_url("vendor/img/buku/" . $item->buku_foto) ?>" alt="" style="max-width: 70px;"></td>
							<td>
								<center>
									<?php if ($item->buku_status == 1) {
									?>

										<a href="<?= base_url('process_buku_check/' . $item->buku_id); ?>" class="btn btn-success btn-sm" onclick="return confirm('Yakin menonaktifkan data?')">
											<i class='fa fa-check'></i>
										</a>

									<?php
									} else {
									?>

										<a href="<?= base_url('process_buku_check/' . $item->buku_id); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin mengaktifkan data?')">
											X
										</a>

									<?php
									}
									?>
								</center>
							</td>
						</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
</div> -->
<!-- <link href="http://cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css" rel="stylesheet"> -->
<script src="http://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>
<?= $this->session->flashdata('pesan'); ?>
<script src="<?= base_url("assets/vendor/ckeditor/ckeditor.js") ?>"></script>
<div class="container-fluid">
	<h4><?= $title; ?></h4>
	<div class="card">
		<div class="card-header">
			<ul class="nav nav-pills" role="tablist">
				<li class="nav-item border border-primary rounded m-1">
					<a class="nav-link " data-toggle="pill" href="#SemuaBuku"><i class="fas fa-fw fa-book"></i> - Semua Buku</a>
				</li>
				<li class="nav-item border border-primary rounded m-1">
					<a class="nav-link active" data-toggle="pill" href="#BukuAktif"><i class="fas fa-check"></i> - Buku Aktif</a>
				</li>
				<li class="nav-item border border-primary rounded m-1">
					<a class="nav-link" data-toggle="pill" href="#BukuNonaktif">X - Buku Nonaktif</a>
				</li>
			</ul>
		</div>
		<div class="card-body">
			<div class="tab-content">
				<div id="SemuaBuku" class="tab-pane container">
					<b><?= "Semua Buku" ?></b>
					<hr>
					<div class="table-responsive">
						<table class="table table-bordered table-responsive table-hover w-100" id="dataVisibility">
							<thead>
								<tr>
									<th width="1%">#</th>
									<th>Judul</th>
									<th>Penulis</th>
									<th>Edisi</th>
									<th>Penerbit</th>
									<th>Tahun Terbit</th>
									<th>Kelas</th>
									<th>Stok</th>
									<th>Tahun Anggaran</th>
									<!-- <th>Foto</th> -->
									<th>Status</th>
								</tr>
							</thead>
							<tbody>
								<?php $no = 1;
								foreach ($list_katalog as $item) { ?>
									<tr>
										<td><?= $no++; ?></td>
										<td><?= $item->buku_judul; ?></td>
										<td><?= $item->buku_penulis; ?></td>
										<td><?= $item->buku_edisi; ?></td>
										<td><?= $item->buku_penerbit; ?></td>
										<td><?= $item->buku_tahunTerbit; ?></td>
										<td><?= $item->buku_noSKU; ?></td>
										<td><?= $item->buku_stok; ?></td>
										<td><?= $item->buku_tahunAnggaran; ?></td>
										<!-- <td><img src="<?= base_url("vendor/img/buku/" . $item->buku_foto) ?>" alt="" style="max-width: 70px;"></td> -->
										<td>
											<center>
												<?php if ($item->buku_status == 1) {
												?>

													<a href="<?= base_url('process_buku_check/' . $item->buku_id); ?>" class="btn btn-success btn-sm" onclick="return confirm('Yakin menonaktifkan data?')">
														<i class='fa fa-check'></i>
													</a>

												<?php
												} else {
												?>

													<a href="<?= base_url('process_buku_check/' . $item->buku_id); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin mengaktifkan data?')">
														X
													</a>

												<?php
												}
												?>
											</center>
										</td>
									</tr>
								<?php } ?>
							</tbody>
						</table>
					</div>
				</div>
				<div id="BukuAktif" class="tab-pane container active">
					<b><?= "Buku Aktif" ?></b>
					<hr>
					<div class="table-responsive">
						<table class="table table-bordered  table-responsive table-hover w-100" id="dataVisibility1">
							<thead>
								<tr>
									<th width="1%">#</th>
									<th>Judul</th>
									<th>Penulis</th>
									<th>Edisi</th>
									<th>Penerbit</th>
									<th>Tahun Terbit</th>
									<th>Kelas</th>
									<th>Stok</th>
									<th>Tahun Anggaran</th>
									<!-- <th>Foto</th> -->
									<th>Status</th>
								</tr>
							</thead>
							<tbody>
								<?php $no = 1;
								foreach ($katalog_aktif as $item1) {
									if ($item1->buku_status == 1) { ?>
										<tr>
											<td><?= $no++; ?></td>
											<td><?= $item1->buku_judul; ?></td>
											<td><?= $item1->buku_penulis; ?></td>
											<td><?= $item1->buku_edisi; ?></td>
											<td><?= $item1->buku_penerbit; ?></td>
											<td><?= $item1->buku_tahunTerbit; ?></td>
											<td><?= $item1->buku_noSKU; ?></td>
											<td><?= $item1->buku_stok; ?></td>
											<td><?= $item1->buku_tahunAnggaran; ?></td>
											<!-- <td><img src="<?= base_url("vendor/img/buku/" . $item1->buku_foto) ?>" alt="" style="max-width: 70px;"></td> -->
											<td>
												<center>
													<a href="<?= base_url('process_buku_check/' . $item1->buku_id); ?>" class="btn btn-success btn-sm" onclick="return confirm('Yakin menonaktifkan data?')">
														<i class='fa fa-check'></i>
													</a>
												</center>
											</td>
										</tr>
								<?php }
								} ?>
							</tbody>
						</table>
					</div>
				</div>
				<div id="BukuNonaktif" class="tab-pane container">
					<b><?= "Buku Non Aktif" ?></b>
					<hr>
					<div class="table-responsive">
						<table class="table table-bordered table-hover w-100" id="dataVisibility2">
							<thead>
								<tr>
									<th width="1%">#</th>
									<th>Judul</th>
									<th>Penulis</th>
									<th>Edisi</th>
									<th>Penerbit</th>
									<th>Tahun Terbit</th>
									<th>Kelas</th>
									<th>Stok</th>
									<th>Tahun Anggaran</th>
									<!-- <th>Foto</th> -->
									<th>Status</th>
								</tr>
							</thead>
							<tbody>
								<?php $no = 1;
								foreach ($katalog_nonaktif as $item2) {
									if ($item2->buku_status == 0) { ?>
										<tr>
											<td><?= $no++; ?></td>
											<td><?= $item2->buku_judul; ?></td>
											<td><?= $item2->buku_penulis; ?></td>
											<td><?= $item2->buku_edisi; ?></td>
											<td><?= $item2->buku_penerbit; ?></td>
											<td><?= $item2->buku_tahunTerbit; ?></td>
											<td><?= $item2->buku_noSKU; ?></td>
											<td><?= $item2->buku_stok; ?></td>
											<td><?= $item2->buku_tahunAnggaran; ?></td>
											<!-- <td><img src="<?= base_url("vendor/img/buku/" . $item2->buku_foto) ?>" alt="" style="max-width: 70px;"></td> -->
											<td>
												<center>
													<a href="<?= base_url('process_buku_check/' . $item2->buku_id); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin mengaktifkan data?')">
														X
													</a>
												</center>
											</td>
										</tr>
								<?php }
								} ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	var table1;
	var table2;
	$(document).ready(function() {

		//datatables karyawan aktif
		table1 = $('#table1').DataTable({
			"processing": true, //Feature control the processing indicator.
			"serverSide": true, //Feature control DataTables' servermside processing mode.
			"iDisplayLength": 10,
			// Load data for the table's content from an Ajax source
			"ajax": {
				"url": "<?php echo site_url('/dataBuku/view_buku1') ?>",
				"type": "POST",
				"dataType": "json",
				"dataSrc": function(jsonData) {
					return jsonData.data;
				}
			},
			"paging": true,
			"lengthChange": true,
			"searching": true,
			"ordering": true,
			"info": true,
			"autoWidth": false,
			"responsive": true,
			"buttons": ["copy", "colvis"]
		}).buttons().container().appendTo('#table1_wrapper .col-md-6:eq(0)');


		//datatables karyawan nonaktif
		table2 = $('#table2').DataTable({
			"processing": true, //Feature control the processing indicator.
			"serverSide": true, //Feature control DataTables' servermside processing mode.
			//"order": [], //Initial no order.
			"iDisplayLength": 10,
			// "order": [2, "asc"],

			// Load data for the table's content from an Ajax source
			"ajax": {
				"url": "<?php echo site_url('/dataBuku/view_buku2') ?>",
				"type": "POST",
				"dataType": "json",
				"dataSrc": function(jsonData) {
					return jsonData.data;
				}
			},
			"paging": true,
			"lengthChange": true,
			"searching": true,
			"ordering": true,
			"info": true,
			"autoWidth": false,
			"responsive": true,
			"buttons": ["copy", "colvis"]
		}).buttons().container().appendTo('#table2_wrapper .col-md-6:eq(0)');
	});
</script>
