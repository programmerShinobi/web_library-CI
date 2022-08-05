<?= $this->session->flashdata('pesan'); ?>
<div class="container-fluid">
	<h4><?= $title; ?></h4>
	<div class="card">
		<div class="card-header">
			<div class="dropdown">
				<button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					Tablist Data Peminjaman
				</button>
				<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
					<center>
						<ul class="nav nav-pills navbar-default" role="tablist">
							<li class="nav-item  dropdown-item">
								<a class="nav-link active" data-toggle="pill" href="#semuaData"><i class="fas fa-fw fa-book-reader"></i> Semua Data</a>
							</li>
							<li class="nav-item  dropdown-item">
								<a class="nav-link" data-toggle="pill" href="#belumDikembalikan"><i class="fas fa-hourglass-start"></i> Data Belum Dikembalikan</a>
							</li>
							<li class="nav-item  dropdown-item">
								<a class="nav-link" data-toggle="pill" href="#mendekatiJatuhTempo"><i class="fas fa-hourglass-start"></i> Data Mendekati Jatuh Tempo</a>
							</li>
							<li class="nav-item  dropdown-item">
								<a class="nav-link" data-toggle="pill" href="#sudahJatuhTempo"><i class="fas fa-hourglass-start"></i> Data Sudah Jatuh Tempo</a>
							</li>
							<li class="nav-item  dropdown-item">
								<a class="nav-link" data-toggle="pill" href="#sudahDikembalikan"><i class="fas fa-fw fa-hourglass-end"></i> Data Sudah Dikembalikan</a>
							</li>
							<li class="nav-item  dropdown-item">
								<a class="nav-link" data-toggle="pill" href="#dendaSudahLunas"><i class="fas fa-fw fa-check"></i> Data Denda Sudah Lunas</a>
							</li>
							<li class="nav-item  dropdown-item">
								<a class="nav-link" data-toggle="pill" href="#dendaBelumLunas"><i class="fas fa-fw fa-times"></i> Data Denda Belum Lunas</a>
							</li>
						</ul>
					</center>
				</div>
			</div>
		</div>
		<div class="card-body">
			<?= form_open('peminjamanBuku'); ?>
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
			<div class="tab-content">
				<div id="semuaData" class="tab-pane active">
					<b><?= "Semua Data" ?></b>
					<hr>
					<a href="" class="btn btn-success btn-sm mb-3" data-toggle="modal" data-target="#add"><i class="fa fa-plus"></i> Tambah peminjaman</a>
					<a href="" class="btn btn-info btn-sm mb-3" data-toggle="modal" data-target="#edit"><i class="fa fa-handshake"></i> Ubah denda harian</a>
					<a href="<?= base_url('export_peminjaman'); ?>" target="_blank" class="btn btn-dark btn-sm mb-3"><i class="fa fa-file-export"></i> Export ke Excel</a>
					<a href="" class="btn btn-dark btn-sm mb-3" data-toggle="modal" data-target="#addEx"> <i class="fa fa-file-import"></i> Import data Excel</a>
					<hr>
					<div class="table-responsive">
						<table class="table table-bordered table-hover" id="dataVisibility">
							<thead>
								<tr>
									<th>#</th>
									<th>Nomor Peminjaman</th>
									<th>Nama Peminjam</th>
									<th>Judul Buku</th>
									<th>Jumlah Buku</th>
									<th>Tanggal Meminjam</th>
									<th>Tanggal Pengembalian</th>
									<th>Tanggal Dikembalikan</th>
									<th>Denda</th>
									<th>Status</th>
									<th>Aksi</th>
								</tr>
							</thead>
							<tbody>
								<?php $no = 1;
								foreach ($list_peminjaman as $item) { ?>
									<tr>
										<td><?= $no++; ?></td>
										<td><?= $item->peminjaman_noId; ?></td>
										<td><?= $item->user_nama; ?></td>
										<td><?= $item->buku_judul; ?></td>
										<td><?= $item->peminjaman_jumlah; ?></td>
										<td><?= date('d M Y', strtotime($item->peminjaman_dari)); ?></td>
										<td><?= date('d M Y', strtotime($item->peminjaman_sampai)); ?></td>
										<td><?php
											if ($item->peminjaman_kembali == "0000-00-00") {
												if ($item->peminjaman_status == 3) {
													echo '<div class="badge badge-danger">Telah dibatalkan</div>';
												} else {
													echo '<div class="badge badge-warning text-dark">Masih dipinjam</div>';
												}
											} else {
												echo date('d M Y', strtotime($item->peminjaman_kembali));
											}
											?></td>
										<td>
											Rp. <?php echo number_format($item->peminjaman_denda, '0', ',', '.'); ?>
											<br> <?php
													if ($item->peminjaman_denda_status == 3) {
														echo '<div class="badge badge-info">Sudah Lunas</div>';
													} elseif ($item->peminjaman_denda_status == 2) { ?>
												<div class="badge badge-warning text-dark">Kurang
													<?php
														$denda_kurang = $item->peminjaman_denda - $item->peminjaman_denda_bayar;
														echo "Rp. " . number_format($denda_kurang, '0', ',', '.');
													?>
												</div>
												<a href="<?= base_url('peminjaman_didenda/' . $item->peminjaman_id); ?>" class="btn btn-warning btn-sm text-dark"><i class="fa fa-check-square"></i> Bayar Sekarang</a>
											<?php } elseif ($item->peminjaman_denda_status == 1) { ?>
												<div class="badge badge-danger">Belum lunas</div>
												<a href="<?= base_url('peminjaman_didenda/' . $item->peminjaman_id); ?>" class="btn btn-danger btn-sm"><i class="fa fa-check-square"></i> Bayar Sekarang</a>
											<?php } elseif ($item->peminjaman_denda_status == 4) { ?>
												<div class="badge badge-danger">Lebih
													<?php
														$denda_lebih = $item->peminjaman_denda_bayar - $item->peminjaman_denda;
														echo "Rp. " . number_format($denda_lebih, '0', ',', '.');
													?>
												</div>
												<a href="<?= base_url('peminjaman_didenda/' . $item->peminjaman_id); ?>" class="btn btn-danger btn-sm"><i class="fa fa-check-square"></i> Edit</a>
											<?php } ?>
										</td>
										<td>
											<?php
											if ($item->peminjaman_status == 1) {
												echo '<div class="badge badge-warning text-dark">Masih dipinjam</div>';
											} elseif ($item->peminjaman_status == 2) {
												echo '<div class="badge badge-info">Telah dikembalikan</div>';
											} elseif ($item->peminjaman_status == 3) {
												echo '<div class="badge badge-danger">Telah dibatalkan</div>';
											}
											?>
										</td>
										<td>
											<?php
											if ($item->peminjaman_status == 1) { ?>
												<div class="form-group card ">
													<a href="<?= base_url('peminjaman_dikembalikan/' . $item->peminjaman_id); ?>" class="btn btn-primary btn-sm"><i class="fa fa-check-square"></i> Dikembalikan</a>
												</div>
												<div class="form-group card ">
													<a href="<?= base_url('peminjaman_batal/' . $item->peminjaman_id); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin membatalkan data peminjaman buku?')"><i class="fa fa-ban"></i> Dibatalkan</a>
												</div>
											<?php
											} elseif ($item->peminjaman_status != 3) { ?>
												<?php if ($user->user_role == 1) { ?>
													<div class="form-group card ">
														<a href="<?= base_url('peminjaman_hapus/' . $item->peminjaman_id); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin menghapus data?')"><i class="fa fa-trash"></i> Hapus</a>
													</div>
												<?php } else { ?>
													<p>-</p>
											<?php }
											} ?>
										</td>
									</tr>
								<?php } ?>
							</tbody>
						</table>
					</div>
				</div>
				<div id="belumDikembalikan" class="tab-pane fade">
					<b><?= "Data Belum Dikembalikan" ?></b>
					<hr>
					<div class="table-responsive">
						<table class="table table-bordered table-hover" id="dataVisibility2">
							<thead>
								<tr>
									<th>#</th>
									<th>Nomor Peminjaman</th>
									<th>Nama Peminjam</th>
									<th>Judul Buku</th>
									<th>Jumlah Buku</th>
									<th>Tanggal Meminjam</th>
									<th>Tanggal Pengembalian</th>
									<th>Tanggal Dikembalikan</th>
									<th>Status</th>
									<th>Aksi</th>
								</tr>
							</thead>
							<tbody>
								<?php $no = 1;
								foreach ($list_peminjaman as $item3) {
									if ($item3->peminjaman_status == 1) { ?>
										<tr>
											<td><?= $no++; ?></td>
											<td><?= $item3->peminjaman_noId; ?></td>
											<td><?= $item3->user_nama; ?></td>
											<td><?= $item3->buku_judul; ?></td>
											<td><?= $item3->peminjaman_jumlah; ?></td>
											<td><?= date('d M Y', strtotime($item3->peminjaman_dari)); ?></td>
											<td><?= date('d M Y', strtotime($item3->peminjaman_sampai)); ?></td>
											<td><?php
												if ($item3->peminjaman_kembali == "0000-00-00") {
													if ($item3->peminjaman_status == 3) {
														echo '<div class="badge badge-danger">Telah dibatalkan</div>';
													} else {
														echo '<div class="badge badge-warning text-dark">Masih dipinjam</div>';
													}
												} else {
													echo date('d M Y', strtotime($item3->peminjaman_kembali));
												}
												?>
											</td>
											<td>
												<?php
												if ($item3->peminjaman_status == 1) {
													echo '<div class="badge badge-warning text-dark">Belum dikembalikan</div>';
												} elseif ($item3->peminjaman_status == 2) {
													echo '<div class="badge badge-info">Sudah dikembalikan</div>';
												} elseif ($item3->peminjaman_status == 3) {
													echo '<div class="badge badge-danger">Telah dibatalkan</div>';
												}
												?>
											</td>
											<td>
												<?php
												if ($item->peminjaman_status == 1) { ?>
													<div class="form-group card ">
														<a href="<?= base_url('peminjaman_dikembalikan/' . $item->peminjaman_id); ?>" class="btn btn-primary btn-sm"><i class="fa fa-check-square"></i> Dikembalikan</a>
													</div>
													<div class="form-group card ">
														<a href="<?= base_url('peminjaman_batal/' . $item->peminjaman_id); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin membatalkan data peminjaman buku?')"><i class="fa fa-ban"></i> Dibatalkan</a>
													</div>
												<?php
												} elseif ($item->peminjaman_status != 3) { ?>
													<?php if ($user->user_role == 1) { ?>
														<div class="form-group card ">
															<a href="<?= base_url('peminjaman_hapus/' . $item->peminjaman_id); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin menghapus data?')"><i class="fa fa-trash"></i> Hapus</a>
														</div>
													<?php } else { ?>
														<p>-</p>
												<?php }
												} ?>
											</td>
										</tr>
								<?php }
								} ?>
							</tbody>
						</table>
					</div>
				</div>
				<div id="mendekatiJatuhTempo" class="tab-pane fade">
					<b><?= "Data Mendekati Jatuh Tempo" ?></b>
					<hr>
					<div class="table-responsive">
						<table class="table table-bordered table-hover" id="dataVisibility3">
							<thead>
								<tr>
									<th>#</th>
									<th>Nomor Peminjaman</th>
									<th>Nama Peminjam</th>
									<th>Judul Buku</th>
									<th>Jumlah Buku</th>
									<th>Tanggal Meminjam</th>
									<th>Tanggal Pengembalian</th>
									<th>Tanggal Dikembalikan</th>
									<th>Status</th>
									<th>Aksi</th>
								</tr>
							</thead>
							<tbody>
								<?php $no = 1;
								foreach ($list_peminjaman as $item4) {
									$date_jatuhTempo = date('d M Y', strtotime($item4->peminjaman_sampai));
									$date_now = date('d M Y', strtotime('+1days'));
									if ($date_jatuhTempo == $date_now) { ?>
										<tr>
											<td><?= $no++; ?></td>
											<td><?= $item4->peminjaman_noId; ?></td>
											<td><?= $item4->user_nama; ?></td>
											<td><?= $item4->buku_judul; ?></td>
											<td><?= $item4->peminjaman_jumlah; ?></td>
											<td><?= date('d M Y', strtotime($item4->peminjaman_dari)); ?></td>
											<td><?= date('d M Y', strtotime($item4->peminjaman_sampai)); ?></td>
											<td><?php
												if ($item4->peminjaman_kembali == "0000-00-00") {
													if ($item4->peminjaman_status == 3) {
														echo '<div class="badge badge-danger">Telah dibatalkan</div>';
													} else {
														echo '<div class="badge badge-warning text-dark">Masih dipinjam</div>';
													}
												} else {
													echo date('d M Y', strtotime($item4->peminjaman_kembali));
												}
												?>
											</td>
											<td>
												<?php
												if ($item4->peminjaman_status == 1) {
													echo '<div class="badge badge-warning text-dark">Belum dikembalikan</div>';
												} elseif ($item4->peminjaman_status == 2) {
													echo '<div class="badge badge-info">Sudah dikembalikan</div>';
												} elseif ($item4->peminjaman_status == 3) {
													echo '<div class="badge badge-danger">Telah dibatalkan</div>';
												}
												?>
											</td>
											<td>
												<?php
												if ($item4->peminjaman_status == 1) { ?>
													<div class="form-group card ">
														<a href="<?= base_url('peminjaman_dikembalikan/' . $item4->peminjaman_id); ?>" class="btn btn-primary btn-sm"><i class="fa fa-check-square"></i> Dikembalikan</a>
													</div>
													<div class="form-group card ">
														<a href="<?= base_url('peminjaman_batal/' . $item4->peminjaman_id); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin membatalkan data peminjaman buku?')"><i class="fa fa-ban"></i> Dibatalkan</a>
													</div>
												<?php
												} elseif ($item4->peminjaman_status != 3) { ?>
													<?php if ($user->user_role == 1) { ?>
														<div class="form-group card ">
															<a href="<?= base_url('peminjaman_hapus/' . $item4->peminjaman_id); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin menghapus data?')"><i class="fa fa-trash"></i> Hapus</a>
														</div>
													<?php } else { ?>
														<p>-</p>
												<?php }
												} ?>
											</td>
										</tr>
								<?php }
								} ?>
							</tbody>
						</table>
					</div>
				</div>
				<div id="sudahJatuhTempo" class="tab-pane fade">
					<b><?= "Data Sudah Jatuh Tempo" ?></b>
					<hr>
					<div class="table-responsive">
						<table class="table table-bordered table-hover" id="dataVisibility4">
							<thead>
								<tr>
									<th>#</th>
									<th>Nomor Peminjaman</th>
									<th>Nama Peminjam</th>
									<th>Judul Buku</th>
									<th>Jumlah Buku</th>
									<th>Tanggal Meminjam</th>
									<th>Tanggal Pengembalian</th>
									<th>Tanggal Dikembalikan</th>
									<th>Status</th>
									<th>Aksi</th>
								</tr>
							</thead>
							<tbody>
								<?php $no = 1;
								foreach ($list_peminjaman as $item5) {
									$date_jatuhTempo = date('d M Y', strtotime($item5->peminjaman_sampai));
									$date_now = date('d M Y');
									if ($date_jatuhTempo == $date_now) { ?>
										<tr>
											<td><?= $no++; ?></td>
											<td><?= $item5->peminjaman_noId; ?></td>
											<td><?= $item5->user_nama; ?></td>
											<td><?= $item5->buku_judul; ?></td>
											<td><?= $item5->peminjaman_jumlah; ?></td>
											<td><?= date('d M Y', strtotime($item5->peminjaman_dari)); ?></td>
											<td><?= date('d M Y', strtotime($item5->peminjaman_sampai)); ?></td>
											<td><?php
												if ($item5->peminjaman_kembali == "0000-00-00") {
													if ($item5->peminjaman_status == 3) {
														echo '<div class="badge badge-danger">Telah dibatalkan</div>';
													} else {
														echo '<div class="badge badge-warning text-dark">Masih dipinjam</div>';
													}
												} else {
													echo date('d M Y', strtotime($item5->peminjaman_kembali));
												}
												?>
											</td>
											<td>
												<?php
												if ($item5->peminjaman_status == 1) {
													echo '<div class="badge badge-warning text-dark">Belum dikembalikan</div>';
												} elseif ($item5->peminjaman_status == 2) {
													echo '<div class="badge badge-info">Sudah dikembalikan</div>';
												} elseif ($item5->peminjaman_status == 3) {
													echo '<div class="badge badge-danger">Telah dibatalkan</div>';
												}
												?>
											</td>
											<td>
												<?php
												if ($item5->peminjaman_status == 1) { ?>
													<div class="form-group card ">
														<a href="<?= base_url('peminjaman_dikembalikan/' . $item5->peminjaman_id); ?>" class="btn btn-primary btn-sm"><i class="fa fa-check-square"></i> Dikembalikan</a>
													</div>
													<div class="form-group card ">
														<a href="<?= base_url('peminjaman_batal/' . $item5->peminjaman_id); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin membatalkan data peminjaman buku?')"><i class="fa fa-ban"></i> Dibatalkan</a>
													</div>
												<?php
												} elseif ($item5->peminjaman_status != 3) { ?>
													<?php if ($user->user_role == 1) { ?>
														<div class="form-group card ">
															<a href="<?= base_url('peminjaman_hapus/' . $item5->peminjaman_id); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin menghapus data?')"><i class="fa fa-trash"></i> Hapus</a>
														</div>
													<?php } else { ?>
														<p>-</p>
												<?php }
												} ?>
											</td>
										</tr>
								<?php }
								} ?>
							</tbody>
						</table>
					</div>
				</div>
				<div id="sudahDikembalikan" class="tab-pane fade">
					<b><?= "Data Sudah Dikembalikan" ?></b>
					<hr>
					<div class="table-responsive">
						<table class="table table-bordered table-hover" id="dataVisibility5">
							<thead>
								<tr>
									<th>#</th>
									<th>Nomor Peminjaman</th>
									<th>Nama Peminjam</th>
									<th>Judul Buku</th>
									<th>Jumlah Buku</th>
									<th>Tanggal Meminjam</th>
									<th>Tanggal Pengembalian</th>
									<th>Tanggal Dikembalikan</th>
									<th>Status</th>
								</tr>
							</thead>
							<tbody>
								<?php $no = 1;
								foreach ($list_peminjaman as $item6) {
									if ($item6->peminjaman_status == 2) { ?>
										<tr>
											<td><?= $no++; ?></td>
											<td><?= $item6->peminjaman_noId; ?></td>
											<td><?= $item6->user_nama; ?></td>
											<td><?= $item6->buku_judul; ?></td>
											<td><?= $item6->peminjaman_jumlah; ?></td>
											<td><?= date('d M Y', strtotime($item6->peminjaman_dari)); ?></td>
											<td><?= date('d M Y', strtotime($item6->peminjaman_sampai)); ?></td>
											<td><?php
												if ($item6->peminjaman_kembali == "0000-00-00") {
													if ($item6->peminjaman_status == 3) {
														echo '<div class="badge badge-danger">Telah dibatalkan</div>';
													} else {
														echo '<div class="badge badge-warning text-dark">Masih dipinjam</div>';
													}
												} else {
													echo date('d M Y', strtotime($item6->peminjaman_kembali));
												}
												?>
											</td>
											<td>
												<?php
												if ($item6->peminjaman_status == 1) {
													echo '<div class="badge badge-warning text-dark">Belum dikembalikan</div>';
												} elseif ($item6->peminjaman_status == 2) {
													echo '<div class="badge badge-info">Sudah dikembalikan</div>';
												} elseif ($item6->peminjaman_status == 3) {
													echo '<div class="badge badge-danger">Telah dibatalkan</div>';
												}
												?>
											</td>
										</tr>
								<?php }
								} ?>
							</tbody>
						</table>
					</div>
				</div>
				<div id="dendaSudahLunas" class="tab-pane fade">
					<b><?= "Data Denda Sudah Lunas" ?></b>
					<hr>
					<div class="table-responsive">
						<table class="table table-bordered table-hover" id="dataVisibility6">
							<thead>
								<tr>
									<th>#</th>
									<th>Nomor Peminjaman</th>
									<th>Nama Peminjam</th>
									<th>Judul Buku</th>
									<th>Jumlah Buku</th>
									<th>Tanggal Meminjam</th>
									<th>Tanggal Pengembalian</th>
									<th>Tanggal Dikembalikan</th>
									<th>Denda</th>
								</tr>
							</thead>
							<tbody>
								<?php $no = 1;
								foreach ($list_peminjaman as $item7) {
									if ($item7->peminjaman_status == 1) {
										if ($item7->peminjaman_denda_status == 3 || $item7->peminjaman_denda_status == 4) { ?>
											<tr>
												<td><?= $no++; ?></td>
												<td><?= $item7->peminjaman_noId; ?></td>
												<td><?= $item7->user_nama; ?></td>
												<td><?= $item7->buku_judul; ?></td>
												<td><?= $item7->peminjaman_jumlah; ?></td>
												<td><?= date('d M Y', strtotime($item7->peminjaman_dari)); ?></td>
												<td><?= date('d M Y', strtotime($item7->peminjaman_sampai)); ?></td>
												<td><?php
													if ($item7->peminjaman_kembali == "0000-00-00") {
														if ($item7->peminjaman_status == 3) {
															echo '<div class="badge badge-danger">Telah dibatalkan</div>';
														} else {
															echo '<div class="badge badge-warning text-dark">Masih dipinjam</div>';
														}
													} else {
														echo date('d M Y', strtotime($item7->peminjaman_kembali));
													}
													?>
												</td>
												<td>
													Rp. <?php echo number_format($item7->peminjaman_denda, '0', ',', '.'); ?>
													<br> <?php
															if ($item7->peminjaman_denda_status == 3) {
																echo '<div class="badge badge-info">Sudah Lunas</div>';
															} elseif ($item7->peminjaman_denda_status == 2) { ?>
														<div class="badge badge-warning text-dark">Kurang
															<?php
																$denda_kurang = $item7->peminjaman_denda - $item7->peminjaman_denda_bayar;
																echo "Rp. " . number_format($denda_kurang, '0', ',', '.');
															?>
														</div>
														<a href="<?= base_url('peminjaman_didenda/' . $item7->peminjaman_id); ?>" class="btn btn-warning btn-sm text-dark"><i class="fa fa-check-square"></i> Bayar Sekarang</a>
													<?php } elseif ($item7->peminjaman_denda_status == 1) { ?>
														<div class="badge badge-danger">Belum lunas</div>
														<a href="<?= base_url('peminjaman_didenda/' . $item7->peminjaman_id); ?>" class="btn btn-danger btn-sm"><i class="fa fa-check-square"></i> Bayar Sekarang</a>
													<?php } elseif ($item7->peminjaman_denda_status == 4) { ?>
														<div class="badge badge-danger">Lebih
															<?php
																$denda_lebih = $item7->peminjaman_denda_bayar - $item7->peminjaman_denda;
																echo "Rp. " . number_format($denda_lebih, '0', ',', '.');
															?>
														</div>
														<a href="<?= base_url('peminjaman_didenda/' . $item7->peminjaman_id); ?>" class="btn btn-danger btn-sm"><i class="fa fa-check-square"></i> Edit</a>
													<?php } ?>
												</td>
											</tr>
								<?php }
									}
								} ?>
							</tbody>
						</table>
					</div>
				</div>
				<div id="dendaBelumLunas" class="tab-pane fade">
					<b><?= "Data Denda Belum Lunas" ?></b>
					<hr>
					<div class="table-responsive">
						<table class="table table-bordered table-hover" id="dataVisibility7">
							<thead>
								<tr>
									<th>#</th>
									<th>Nomor Peminjaman</th>
									<th>Nama Peminjam</th>
									<th>Judul Buku</th>
									<th>Jumlah Buku</th>
									<th>Tanggal Meminjam</th>
									<th>Tanggal Pengembalian</th>
									<th>Tanggal Dikembalikan</th>
									<th>Denda</th>
								</tr>
							</thead>
							<tbody>
								<?php $no = 1;
								foreach ($list_peminjaman as $item8) {
									if ($item8->peminjaman_status == 2) {
										if ($item8->peminjaman_denda_status == 1 || $item8->peminjaman_denda_status == 2) { ?>
											<tr>
												<td><?= $no++; ?></td>
												<td><?= $item8->peminjaman_noId; ?></td>
												<td><?= $item8->user_nama; ?></td>
												<td><?= $item8->buku_judul; ?></td>
												<td><?= $item8->peminjaman_jumlah; ?></td>
												<td><?= date('d M Y', strtotime($item8->peminjaman_dari)); ?></td>
												<td><?= date('d M Y', strtotime($item8->peminjaman_sampai)); ?></td>
												<td><?php
													if ($item8->peminjaman_kembali == "0000-00-00") {
														if ($item8->peminjaman_status == 3) {
															echo '<div class="badge badge-danger">Telah dibatalkan</div>';
														} else {
															echo '<div class="badge badge-warning text-dark">Masih dipinjam</div>';
														}
													} else {
														echo date('d M Y', strtotime($item8->peminjaman_kembali));
													}
													?>
												</td>
												<td>
													Rp. <?php echo number_format($item8->peminjaman_denda, '0', ',', '.'); ?>
													<br> <?php
															if ($item8->peminjaman_denda_status == 3) {
																echo '<div class="badge badge-info">Sudah Lunas</div>';
															} elseif ($item8->peminjaman_denda_status == 2) { ?>
														<div class="badge badge-warning text-dark">Kurang
															<?php
																$denda_kurang = $item8->peminjaman_denda - $item8->peminjaman_denda_bayar;
																echo "Rp. " . number_format($denda_kurang, '0', ',', '.');
															?>
														</div>
														<a href="<?= base_url('peminjaman_didenda/' . $item8->peminjaman_id); ?>" class="btn btn-warning btn-sm text-dark"><i class="fa fa-check-square"></i> Bayar Sekarang</a>
													<?php } elseif ($item8->peminjaman_denda_status == 1) { ?>
														<div class="badge badge-danger">Belum lunas</div>
														<a href="<?= base_url('peminjaman_didenda/' . $item8->peminjaman_id); ?>" class="btn btn-danger btn-sm"><i class="fa fa-check-square"></i> Bayar Sekarang</a>
													<?php } elseif ($item8->peminjaman_denda_status == 4) { ?>
														<div class="badge badge-danger">Lebih
															<?php
																$denda_lebih = $item8->peminjaman_denda_bayar - $item8->peminjaman_denda;
																echo "Rp. " . number_format($denda_lebih, '0', ',', '.');
															?>
														</div>
														<a href="<?= base_url('peminjaman_didenda/' . $item8->peminjaman_id); ?>" class="btn btn-danger btn-sm"><i class="fa fa-check-square"></i> Edit</a>
													<?php } ?>
												</td>
											</tr>
								<?php }
									}
								} ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="add">
	<div class="modal-dialog modal-dialog-scrollable">
		<div class="modal-content">
			<div class="modal-header">
				<h5>Tambah Peminjam</h5>
				<button type="button" data-dismiss="modal" class="close">&times;</button>
			</div>
			<div class="modal-body">
				<?= form_open('validation_peminjaman_add'); ?>
				<div class="form-group">
					<label>User</label>
					<input type="text" id="searchUser" class="form-control" placeholder="Masukan nama user ..." autocomplete="off">
					<input type="hidden" name="peminjaman_user" id="userId">
					<div class="data-search-user d-none" id="resultUser"></div>
				</div>
				<div class="form-group">
					<label>Buku</label>
					<input type="text" class="form-control" placeholder="Masukan judul buku ..." id="searchBuku" autocomplete="off">
					<input type="hidden" name="peminjaman_buku" id="bukuId">
					<div class="data-buku-peminjaman d-none" id="resultBuku"></div>
				</div>
				<div class="form-group">
					<label>Jumlah Buku</label>
					<input type="number" name="peminjaman_jumlah" class="form-control" value="1" readonly>
				</div>
				<div class="form-group">
					<label>Tanggal Peminjaman</label>
					<input type="date" name="peminjaman_dari" class="form-control">
				</div>
				<div class="form-group">
					<label>Tanggal Dikembalikan</label>
					<input type="date" name="peminjaman_sampai" class="form-control">
				</div>
				<input type="submit" value="Simpan" class="btn btn-success btn-sm">
				<?= form_close() ?>
			</div>
			<div class="modal-footer">
				<button type="button" data-dismiss="modal" class="btn btn-danger btn-sm">Close</button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="edit">
	<div class="modal-dialog modal-dialog-scrollable">
		<div class="modal-content">
			<div class="modal-header">
				<h5>Ubah denda harian</h5>
				<button type="button" data-dismiss="modal" class="close">&times;</button>
			</div>
			<div class="modal-body">
				<?= form_open('validation_denda_edit'); ?>
				<div class="form-group">
					<label>Harga Denda</label>
					<input type="number" name="denda" value="<?= $denda->denda_harga; ?>" class="form-control">
					<?= form_error('denda', '<small class="text-danger">', '<small>'); ?>
				</div>
				<input type="submit" value="Simpan" class="btn btn-success btn-sm">
				<?= form_close() ?>
			</div>
			<div class="modal-footer">
				<button type="button" data-dismiss="modal" class="btn btn-danger btn-sm">Close</button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="addEx">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5>Upload file excel</h5>
				<button type="button" data-dismiss="modal" class="close">&times;</button>
			</div>
			<div class="modal-body">
				<?= form_open_multipart('import_peminjaman') ?>
				<div class="form-group">
					<?= form_label('Unggah file excel'); ?>
					<?= form_upload('files', '', 'class="form-control"'); ?>
				</div>
				<?= form_submit('', 'Upload', 'class="btn btn-success btn-sm"') ?>
				<?= form_close(); ?>
			</div>
			<div class="modal-footer">
				<button type="button" data-dismiss="modal" class="btn btn-danger btn-sm">Close</button>
			</div>
		</div>
	</div>
</div>

<script>
	function addBuku(judulBuku, bukuId) {
		$("#searchBuku").val(judulBuku);
		$("#bukuId").val(bukuId);
	};

	function addUser(userNama, userId) {
		$("#searchUser").val(userNama);
		$("#userId").val(userId);
	};
	$(document).ready(function() {
		$("#searchBuku").on("keyup", function() {
			let searchBuku = $("#searchBuku").val();
			$.ajax({
				url: "<?php echo base_url("search_buku"); ?>",
				type: "POST",
				data: {
					keyword: searchBuku
				},
				cache: false,
				success: function(result) {
					$("#resultBuku").removeClass("d-none");
					$("#resultBuku").html(result);
				}
			});
		})

		$("#searchUser").on("keyup", function() {
			let searchUser = $("#searchUser").val();
			$.ajax({
				url: "<?php echo base_url("search_user"); ?>",
				type: "POST",
				data: {
					keyword: searchUser
				},
				cache: false,
				success: function(result) {
					$("#resultUser").removeClass("d-none");
					$("#resultUser").html(result);
				}
			});
		})

		$("#searchBuku").on("blur", function() {
			window.setTimeout(function() {
				$("#resultBuku").addClass("d-none");
			}, 200)
		})

		$("#searchUser").on("blur", function() {
			window.setTimeout(function() {
				$("#resultUser").addClass("d-none");
			}, 200)
		})
	})
</script>
