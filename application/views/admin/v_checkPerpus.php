<?= $this->session->flashdata('pesan'); ?>
<script src="<?= base_url("assets/vendor/ckeditor/ckeditor.js") ?>"></script>
<div class="container-fluid">
	<h4><?= $title; ?></h4>
	<div class="card">
		<div class="card-header">
			<a href="<?= base_url("dataSekolah") ?>" class="btn btn-info btn-sm"><i class="fas fa-fw fa-chevron-left"></i></a>
			<b><?php foreach ($nama_sekolah as $sekolah) {
					echo $sekolah->sekolah_nama;
					$variable = 0; ?></b>
			<hr>
			<?php if ($user->user_role != 4) { ?>
				<div class="row">
					<div class="col-xl-4 col-md-6 mb-4">
						<div class="card border-left-dark shadow h-100 py-2">
							<div class="card-body">
								<div class="row no-gutters align-items-center">
									<div class="col mr-2">
										<div class="text-xs font-weight-bold text-dark text-uppercase mb-1">Total Rak Sirkulasi Tahun Ini</div>
										<div class="h5 mb-0 font-weight-bold text-gray-800"><?= $sekolah_total_rak_sirkulasi_tahunIni; ?></div>
									</div>
									<div class="col-auto">
										<i class="fas fa-fw fa-server fa-2x text-gray-300"></i>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-xl-4 col-md-6 mb-4">
						<div class="card border-left-dark shadow h-100 py-2">
							<div class="card-body">
								<div class="row no-gutters align-items-center">
									<div class="col mr-2">
										<div class="text-xs font-weight-bold text-dark text-uppercase mb-1">Total Rak Referensi Tahun Ini</div>
										<div class="h5 mb-0 font-weight-bold text-gray-800"><?= $sekolah_total_rak_referensi_tahunIni; ?></div>
									</div>
									<div class="col-auto">
										<i class="fas fa-fw fa-server fa-2x text-gray-300"></i>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-xl-4 col-md-6 mb-4">
						<div class="card border-left-dark shadow h-100 py-2">
							<div class="card-body">
								<div class="row no-gutters align-items-center">
									<div class="col mr-2">
										<div class="text-xs font-weight-bold text-dark text-uppercase mb-1">Total Rak Terbitan Tahun Ini</div>
										<div class="h5 mb-0 font-weight-bold text-gray-800"><?= $sekolah_total_rak_terbitan_tahunIni; ?></div>
									</div>
									<div class="col-auto">
										<i class="fas fa-fw fa-server fa-2x text-gray-300"></i>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<hr class="bg-dark">
				<div class="row">
					<div class="col-xl-4 col-md-6 mb-4">
						<div class="card border-left-dark shadow h-100 py-2">
							<div class="card-body">
								<div class="row no-gutters align-items-center">
									<div class="col mr-2">
										<div class="text-xs font-weight-bold text-dark text-uppercase mb-1">Total Koleksi Umum Tahun Ini</div>
										<div class="h5 mb-0 font-weight-bold text-gray-800"><?= $sekolah_total_koleksi_umum_tahunIni ?></div>
									</div>
									<div class="col-auto">
										<i class="fas fa-fw fa-book fa-2x text-gray-300"></i>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-xl-4 col-md-6 mb-4">
						<div class="card border-left-dark shadow h-100 py-2">
							<div class="card-body">
								<div class="row no-gutters align-items-center">
									<div class="col mr-2">
										<div class="text-xs font-weight-bold text-dark text-uppercase mb-1">Total Koleksi Referensi Tahun Ini</div>
										<div class="h5 mb-0 font-weight-bold text-gray-800"><?= $sekolah_total_koleksi_referensi_tahunIni ?></div>
									</div>
									<div class="col-auto">
										<i class="fas fa-fw fa-book fa-2x text-gray-300"></i>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-xl-4 col-md-6 mb-4">
						<div class="card border-left-dark shadow h-100 py-2">
							<div class="card-body">
								<div class="row no-gutters align-items-center">
									<div class="col mr-2">
										<div class="text-xs font-weight-bold text-dark text-uppercase mb-1">Total Koleksi Terbitan Tahun Ini</div>
										<div class="h5 mb-0 font-weight-bold text-gray-800"><?= $sekolah_total_koleksi_terbitan_tahunIni ?></div>
									</div>
									<div class="col-auto">
										<i class="fas fa-fw fa-book fa-2x text-gray-300"></i>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<hr class="bg-dark">
				<div class="row">
					<div class="col-xl-4 col-md-6 mb-4">
						<div class="card border-left-dark shadow h-100 py-2">
							<div class="card-body">
								<div class="row no-gutters align-items-center">
									<div class="col mr-2">
										<div class="text-xs font-weight-bold text-dark text-uppercase mb-1">Total Anggota (Guru) Tahun Ini</div>
										<div class="h5 mb-0 font-weight-bold text-gray-800"><?= $sekolah_total_person_anggota_guru_tahunIni; ?></div>
									</div>
									<div class="col-auto">
										<i class="fas fa-fw fa-user-tag fa-2x text-gray-300"></i>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-xl-4 col-md-6 mb-4">
						<div class="card border-left-dark shadow h-100 py-2">
							<div class="card-body">
								<div class="row no-gutters align-items-center">
									<div class="col mr-2">
										<div class="text-xs font-weight-bold text-dark text-uppercase mb-1">Total Pemustaka (Guru) Tahun Ini</div>
										<div class="h5 mb-0 font-weight-bold text-gray-800"><?= $sekolah_total_person_pemustaka_guru_tahunIni; ?></div>
									</div>
									<div class="col-auto">
										<i class="fas fa-fw fa-user-tie fa-2x text-gray-300"></i>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-xl-4 col-md-6 mb-4">
						<div class="card border-left-dark shadow h-100 py-2">
							<div class="card-body">
								<div class="row no-gutters align-items-center">
									<div class="col mr-2">
										<div class="text-xs font-weight-bold text-dark text-uppercase mb-1">Total Pengunjung (Guru) Tahun Ini</div>
										<div class="h5 mb-0 font-weight-bold text-gray-800"><?= $sekolah_total_person_pengunjung_guru_tahunIni; ?></div>
									</div>
									<div class="col-auto">
										<i class="fas fa-fw fa-users fa-2x text-gray-300"></i>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-xl-4 col-md-6 mb-4">
						<div class="card border-left-dark shadow h-100 py-2">
							<div class="card-body">
								<div class="row no-gutters align-items-center">
									<div class="col mr-2">
										<div class="text-xs font-weight-bold text-dark text-uppercase mb-1">Total Anggota (Siswa) Tahun Ini</div>
										<div class="h5 mb-0 font-weight-bold text-gray-800"><?= $sekolah_total_person_anggota_siswa_tahunIni; ?></div>
									</div>
									<div class="col-auto">
										<i class="fas fa-fw fa-user-tag fa-2x text-gray-300"></i>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-xl-4 col-md-6 mb-4">
						<div class="card border-left-dark shadow h-100 py-2">
							<div class="card-body">
								<div class="row no-gutters align-items-center">
									<div class="col mr-2">
										<div class="text-xs font-weight-bold text-dark text-uppercase mb-1">Total Pemustaka (Siswa) Tahun Ini</div>
										<div class="h5 mb-0 font-weight-bold text-gray-800"><?= $sekolah_total_person_pemustaka_siswa_tahunIni; ?></div>
									</div>
									<div class="col-auto">
										<i class="fas fa-fw fa-user-tie fa-2x text-gray-300"></i>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-xl-4 col-md-6 mb-4">
						<div class="card border-left-dark shadow h-100 py-2">
							<div class="card-body">
								<div class="row no-gutters align-items-center">
									<div class="col mr-2">
										<div class="text-xs font-weight-bold text-dark text-uppercase mb-1">Total Pengunjung (Siswa) Tahun Ini</div>
										<div class="h5 mb-0 font-weight-bold text-gray-800"><?= $sekolah_total_person_pengunjung_siswa_tahunIni; ?></div>
									</div>
									<div class="col-auto">
										<i class="fas fa-fw fa-users fa-2x text-gray-300"></i>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<hr class="bg-dark"><br>
				<div class="col text-right">
			<?php } else if ($user->user_role == 4) { ?>
				<a href="<?= base_url('perpus_lapor/' . $variable . '/' . $sekolah->sekolah_id); ?>" class="btn btn-dark btn-sm " onclick="return confirm('Yakin akan melaporkan semua data ke Pemda?')"><i class="fa fa-paper-plane"></i> Laporkan Semua Data ke Pemda</a>
			<?php } ?>
				</div>
				<hr>
			<?php
					$url_Aktif = $this->uri->segment(1) . "/" . $this->uri->segment(2) . "/" . $this->uri->segment(3);
					$perpus = "perpus_check/" . $sekolah->sekolah_id . "/perpusTab";
					$sarana = "perpus_check/" . $sekolah->sekolah_id . "/saranaTab";
					$koleksi = "perpus_check/" . $sekolah->sekolah_id . "/koleksiTab";
					$person = "perpus_check/" . $sekolah->sekolah_id . "/personTab";
				}
				if ($perpus == $url_Aktif) { ?>
				<ul class="nav nav-pills" role="tablist">
					<li class="nav-item border border-primary rounded m-1">
						<a class="nav-link active" data-toggle="pill" href="#perpusTab"><i class="fas fa-book-reader"></i> Perpustakaan</a>
					</li>
					<li class="nav-item border border-primary rounded m-1">
						<a class="nav-link" data-toggle="pill" href="#saranaTab"><i class="fas fa-store-alt"></i> Sarana-Prasarana</a>
					</li>
					<li class="nav-item border border-primary rounded m-1">
						<a class="nav-link" data-toggle="pill" href="#koleksiTab"><i class="fas fa-swatchbook"></i> Koleksi</a>
					</li>
					<li class="nav-item border border-primary rounded m-1">
						<a class="nav-link" data-toggle="pill" href="#personTab"><i class="fas fa-id-card-alt"></i> Person</a>
					</li>
				</ul>
			<?php } else if ($sarana == $url_Aktif) { ?>
				<ul class="nav nav-pills" role="tablist">
					<li class="nav-item border border-primary rounded m-1">
						<a class="nav-link" data-toggle="pill" href="#perpusTab"><i class="fas fa-book-reader"></i> Perpustakaan</a>
					</li>
					<li class="nav-item border border-primary rounded m-1">
						<a class="nav-link active" data-toggle="pill" href="#saranaTab"><i class="fas fa-store-alt"></i> Sarana-Prasarana</a>
					</li>
					<li class="nav-item border border-primary rounded m-1">
						<a class="nav-link" data-toggle="pill" href="#koleksiTab"><i class="fas fa-swatchbook"></i> Koleksi</a>
					</li>
					<li class="nav-item border border-primary rounded m-1">
						<a class="nav-link" data-toggle="pill" href="#personTab"><i class="fas fa-id-card-alt"></i> Person</a>
					</li>
				</ul>
			<?php } else if ($koleksi == $url_Aktif) { ?>
				<ul class="nav nav-pills" role="tablist">
					<li class="nav-item border border-primary rounded m-1">
						<a class="nav-link" data-toggle="pill" href="#perpusTab"><i class="fas fa-book-reader"></i> Perpustakaan</a>
					</li>
					<li class="nav-item border border-primary rounded m-1">
						<a class="nav-link" data-toggle="pill" href="#saranaTab"><i class="fas fa-store-alt"></i> Sarana-Prasarana</a>
					</li>
					<li class="nav-item border border-primary rounded m-1">
						<a class="nav-link active" data-toggle="pill" href="#koleksiTab"><i class="fas fa-swatchbook"></i> Koleksi</a>
					</li>
					<li class="nav-item border border-primary rounded m-1">
						<a class="nav-link" data-toggle="pill" href="#personTab"><i class="fas fa-id-card-alt"></i> Person</a>
					</li>
				</ul>
			<?php } else if ($person == $url_Aktif) { ?>
				<ul class="nav nav-pills" role="tablist">
					<li class="nav-item border border-primary rounded m-1">
						<a class="nav-link" data-toggle="pill" href="#perpusTab"><i class="fas fa-book-reader"></i> Perpustakaan</a>
					</li>
					<li class="nav-item border border-primary rounded m-1">
						<a class="nav-link" data-toggle="pill" href="#saranaTab"><i class="fas fa-store-alt"></i> Sarana-Prasarana</a>
					</li>
					<li class="nav-item border border-primary rounded m-1">
						<a class="nav-link" data-toggle="pill" href="#koleksiTab"><i class="fas fa-swatchbook"></i> Koleksi</a>
					</li>
					<li class="nav-item border border-primary rounded m-1">
						<a class="nav-link active" data-toggle="pill" href="#personTab"><i class="fas fa-id-card-alt"></i> Person</a>
					</li>
				</ul>
			<?php } else { ?>
				<ul class="nav nav-pills" role="tablist">
					<li class="nav-item border border-primary rounded m-1">
						<a class="nav-link active" data-toggle="pill" href="#perpusTab"><i class="fas fa-book-reader"></i> Perpustakaan</a>
					</li>
					<li class="nav-item border border-primary rounded m-1">
						<a class="nav-link" data-toggle="pill" href="#saranaTab"><i class="fas fa-store-alt"></i> Sarana-Prasarana</a>
					</li>
					<li class="nav-item border border-primary rounded m-1">
						<a class="nav-link" data-toggle="pill" href="#koleksiTab"><i class="fas fa-swatchbook"></i> Koleksi</a>
					</li>
					<li class="nav-item border border-primary rounded m-1">
						<a class="nav-link" data-toggle="pill" href="#personTab"><i class="fas fa-id-card-alt"></i> Person</a>
					</li>
				</ul>
			<?php } ?>
		</div>
		<div class="card-body">
			<div class="tab-content">
				<?php if ($perpus == $url_Aktif) { ?>
					<div id="perpusTab" class="tab-pane container active">
					<?php } else if ($sarana == $url_Aktif) { ?>
						<div id="perpusTab" class="tab-pane container fade">
						<?php } else if ($koleksi == $url_Aktif) { ?>
							<div id="perpusTab" class="tab-pane container fade">
							<?php } else if ($person == $url_Aktif) { ?>
								<div id="perpusTab" class="tab-pane container fade">
								<?php } else { ?>
									<div id="perpusTab" class="tab-pane container active">
									<?php } ?>
									<b><?= "Data Perpustakaan" ?></b>
									<div class="col text-right">
										<?php foreach ($nama_sekolah as $sekolah) {
											$variable = 1; if ($user->user_role == 4) { ?>
											<a href="<?= base_url('perpus_lapor/' . $variable . '/' . $sekolah->sekolah_id); ?>" class="btn btn-dark btn-sm ml-auto" onclick="return confirm('Yakin akan melaporkan data Perpustakaan ke Pemda?')"><i class="fa fa-paper-plane"></i> Laporkan Data Perpustakaan ke Pemda</a>
										<?php }} ?>
									</div>
									<hr>
									<a href="<?= base_url("dataSekolah") ?>" class="btn btn-info btn-sm mb-4"><i class="fas fa-fw fa-chevron-left"></i> </a>
									<a href="" data-toggle="modal" data-target="#addPerpustakaan" class="btn btn-success btn-sm mb-4"><i class="fa fa-plus"></i> Tambah data</a>
									<?php foreach ($list_perpus as $p) { ?>
										<tr>
											<td>
											</td>
										</tr>
									<?php } ?>
									<div class="table-responsive">
										<table class="table table-bordered table-hover w-100" id="dataPerpus">
											<thead>
												<tr>
													<th>Tahun</th>
													<th>Nama Pengelola</th>
													<th>Kontak Pengelola</th>
													<th>Nama Sekretaris</th>
													<th>Nama Petugas</th>
													<th>Aksi</th>
												</tr>
											</thead>
											<tbody>
												<?php foreach ($list_perpus as $item) { ?>
													<tr>
														<td><?= $item->perpus_pertahun; ?></td>
														<td><?= $item->perpus_namaPengelola; ?></td>
														<td><?= $item->perpus_kontakPengelola; ?></td>
														<td><?= $item->perpus_namaSekretaris; ?></td>
														<td><?= $item->perpus_namaPetugas; ?></td>
														<td>
															<div class="form-group card ">
																<a href="<?= base_url('perpus_edit/' . $item->perpus_id); ?>" class="btn btn-light btn-sm"><i class="fa fa-edit"></i> Edit</a>
															</div>
															<?php if ($user->user_role == 1) { ?>
																<div class="form-group card ">
																	<a href="<?= base_url('perpus_delete/' . $item->perpus_id . '/' . $item->sekolah_id); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin menghapus data perpustakaan?')"><i class="fa fa-trash"></i> Hapus</a>
																</div>
															<?php } ?>
														</td>
													</tr>
												<?php } ?>
											</tbody>
										</table>
									</div>
									</div>
									<?php if ($perpus == $url_Aktif) { ?>
										<div id="saranaTab" class="tab-pane container fade">
										<?php } else if ($sarana == $url_Aktif) { ?>
											<div id="saranaTab" class="tab-pane container active">
											<?php } else if ($koleksi == $url_Aktif) { ?>
												<div id="saranaTab" class="tab-pane container fade">
												<?php } else if ($person == $url_Aktif) { ?>
													<div id="saranaTab" class="tab-pane container fade">
													<?php } else { ?>
														<div id="saranaTab" class="tab-pane container fade">
														<?php } ?>
														<b> <?= "Data Sarana-Prasarana" ?></b>
														<div class="col text-right">
															<?php foreach ($nama_sekolah as $sekolah) {
																$variable = 2; ?>
																<a href="<?= base_url('perpus_lapor/' . $variable . '/' . $sekolah->sekolah_id); ?>" class="btn btn-dark btn-sm ml-auto" onclick="return confirm('Yakin akan melaporkan data sarana-prasarana ke Pemda?')"><i class="fa fa-paper-plane"></i> Laporkan Data Sarana-Prasarana ke Pemda</a>
															<?php } ?>
														</div>
														<hr>
														<a href="<?= base_url("dataSekolah") ?>" class="btn btn-info btn-sm mb-4"><i class="fas fa-fw fa-chevron-left"></i> </a>
														<a href="" data-toggle="modal" data-target="#addSarana" class="btn btn-success btn-sm mb-4"><i class="fa fa-plus"></i> Tambah data</a>
														<div class="table-responsive">
															<table class="table table-bordered table-hover w-100" id="dataSarana">
																<thead>
																	<tr>
																		<th>Tahun</th>
																		<th>Luas Gedung</th>
																		<th>Jumlah Rak Sirkulasi</th>
																		<th>Jumlah Rak Referensi</th>
																		<th>Jumlah Rak Terbitan</th>
																		<th>Aksi</th>
																	</tr>
																</thead>
																<tbody>
																	<?php foreach ($list_sarana as $item) { ?>
																		<tr>
																			<td><?= $item->sarana_pertahun; ?></td>
																			<td><?= $item->sarana_luasGedung; ?> m<sup>2</sup></td>
																			<td><?= $item->sarana_jumlahRakSirkulasi; ?></td>
																			<td><?= $item->sarana_jumlahRakReferensi; ?></td>
																			<td><?= $item->sarana_jumlahRakTerbitan; ?></td>
																			<td>
																				<div class="form-group card ">
																					<a href="<?= base_url('sarana_edit/' . $item->sarana_id); ?>" class="btn btn-light btn-sm"><i class="fa fa-edit"></i> Edit</a>
																				</div>
																				<?php if ($user->user_role == 1) { ?>
																					<div class="form-group card ">
																						<a href="<?= base_url('sarana_delete/' . $item->sarana_id . '/' . $item->sekolah_id); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin menghapus data sarana-prasarana?')"><i class="fa fa-trash"></i> Hapus</a>
																					</div>
																				<?php } ?>
																			</td>
																		</tr>
																	<?php } ?>
																</tbody>
															</table>
														</div>
														</div>
														<?php if ($perpus == $url_Aktif) { ?>
															<div id="koleksiTab" class="tab-pane container fade">
															<?php } else if ($sarana == $url_Aktif) { ?>
																<div id="koleksiTab" class="tab-pane container fade">
																<?php } else if ($koleksi == $url_Aktif) { ?>
																	<div id="koleksiTab" class="tab-pane container active">
																	<?php } else if ($person == $url_Aktif) { ?>
																		<div id="koleksiTab" class="tab-pane container fade">
																		<?php } else { ?>
																			<div id="koleksiTab" class="tab-pane container fade">
																			<?php } ?>
																			<b><?= "Data Koleksi Perpustakaan" ?></b>
																			<div class="col text-right">
																				<?php foreach ($nama_sekolah as $sekolah) {
																					$variable = 3; ?>
																					<a href="<?= base_url('perpus_lapor/' . $variable . '/' . $sekolah->sekolah_id); ?>" class="btn btn-dark btn-sm ml-auto" onclick="return confirm('Yakin akan melaporkan data koleksi perpustakaan ke Pemda?')"><i class="fa fa-paper-plane"></i> Laporkan Data Koleksi ke Pemda</a>
																				<?php } ?>
																			</div>
																			<hr>
																			<ul class="nav nav-pills" role="tablist">
																				<li class="nav-item border border-primary rounded m-1">
																					<a class="nav-link active" data-toggle="pill" href="#koleksiSemuaTab"><i class="fas fa-list-alt"></i> Semua</a>
																				</li>
																				<li class="nav-item border border-primary rounded m-1">
																					<a class="nav-link" data-toggle="pill" href="#koleksiUmumTab"><i class="fas fa-globe-asia"></i> Umum</a>
																				</li>
																				<li class="nav-item border border-primary rounded m-1">
																					<a class="nav-link" data-toggle="pill" href="#koleksiReferensiTab"><i class="fas fa-bookmark"></i> Referensi</a>
																				</li>
																				<li class="nav-item border border-primary rounded m-1">
																					<a class="nav-link" data-toggle="pill" href="#koleksiTerbitanTab"><i class="fas fa-passport"></i> Terbitan Berkala</a>
																				</li>
																			</ul>
																			<hr>
																			<div class="tab-content">
																				<div id="koleksiSemuaTab" class="tab-pane container active">
																					<a href="<?= base_url("dataSekolah") ?>" class="btn btn-info btn-sm mb-4"><i class="fas fa-fw fa-chevron-left"></i> </a>
																					<a href="" data-toggle="modal" data-target="#addKoleksi" class="btn btn-success btn-sm mb-4"><i class="fa fa-plus"></i> Tambah data</a>
																					<div class="table-responsive">
																						<table class="table table-bordered table-hover w-100" id="dataKoleksi">
																							<thead>
																								<tr>
																									<th>Tahun</th>
																									<th>Kriteria</th>
																									<th>Kelas</th>
																									<th>Judul</th>
																									<th>Jumlah</th>
																									<th>Aksi</th>
																								</tr>
																							</thead>
																							<tbody>
																								<?php foreach ($list_koleksi as $item) { ?>
																									<tr>
																										<td><?= $item->koleksi_pertahun; ?></td>
																										<td>
																											<?php
																											if ($item->koleksi_kriteria == "umum") {
																												echo "Umum";
																											} elseif ($item->koleksi_kriteria == "referensi") {
																												echo "Referensi";
																											} elseif ($item->koleksi_kriteria == "terbitan_berkala") {
																												echo "Terbitan Berkala";
																											}
																											?>
																										</td>
																										<td><?= $item->koleksi_kelas; ?></td>
																										<td><?= $item->koleksi_judul; ?></td>
																										<td><?= $item->koleksi_jumlah; ?></td>
																										<td>
																											<div class="form-group card ">
																												<a href="<?= base_url('koleksi_edit/' . $item->koleksi_id); ?>" class="btn btn-light btn-sm"><i class="fa fa-edit"></i> Edit</a>
																											</div>
																											<?php if ($user->user_role == 1) { ?>
																												<div class="form-group card ">
																													<a href="<?= base_url('koleksi_delete/' . $item->koleksi_id . '/' . $item->sekolah_id); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin menghapus data koleksi?')"><i class="fa fa-trash"></i> Hapus</a>
																												</div>
																											<?php } ?>
																										</td>
																									</tr>
																								<?php } ?>
																							</tbody>
																						</table>
																					</div>
																				</div>
																				<div id="koleksiUmumTab" class="tab-pane container fade">
																					<a href="<?= base_url("dataSekolah") ?>" class="btn btn-info btn-sm mb-4"><i class="fas fa-fw fa-chevron-left"></i> </a>
																					<a href="" data-toggle="modal" data-target="#addKoleksiUmum" class="btn btn-success btn-sm mb-4"><i class="fa fa-plus"></i> Tambah data</a>
																					<div class="table-responsive">
																						<table class="table table-bordered table-hover w-100" id="dataKoleksiUmum">
																							<thead>
																								<tr>
																									<th>Tahun</th>
																									<th>Kriteria</th>
																									<th>Kelas</th>
																									<th>Judul</th>
																									<th>Jumlah</th>
																									<th>Aksi</th>
																								</tr>
																							</thead>
																							<tbody>
																								<?php foreach ($list_koleksi_umum as $item) { ?>
																									<tr>
																										<td><?= $item->koleksi_pertahun; ?></td>
																										<td>
																											<?php
																											if ($item->koleksi_kriteria == "umum") {
																												echo "Umum";
																											} elseif ($item->koleksi_kriteria == "referensi") {
																												echo "Referensi";
																											} elseif ($item->koleksi_kriteria == "terbitan_berkala") {
																												echo "Terbitan Berkala";
																											}
																											?>
																										</td>
																										<td><?= $item->koleksi_kelas; ?></td>
																										<td><?= $item->koleksi_judul; ?></td>
																										<td><?= $item->koleksi_jumlah; ?></td>
																										<td>
																											<div class="form-group card ">
																												<a href="<?= base_url('koleksi_edit/' . $item->koleksi_id); ?>" class="btn btn-light btn-sm"><i class="fa fa-edit"></i> Edit</a>
																											</div>
																											<?php if ($user->user_role == 1) { ?>
																												<div class="form-group card ">
																													<a href="<?= base_url('koleksi_delete/' . $item->koleksi_id . '/' . $item->sekolah_id); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin menghapus data koleksi?')"><i class="fa fa-trash"></i> Hapus</a>
																												</div>
																											<?php } ?>
																										</td>
																									</tr>
																								<?php } ?>
																							</tbody>
																						</table>
																					</div>
																				</div>
																				<div id="koleksiReferensiTab" class="tab-pane container fade">
																					<a href="<?= base_url("dataSekolah") ?>" class="btn btn-info btn-sm mb-4"><i class="fas fa-fw fa-chevron-left"></i> </a>
																					<a href="" data-toggle="modal" data-target="#addKoleksiReferensi" class="btn btn-success btn-sm mb-4"><i class="fa fa-plus"></i> Tambah data</a>
																					<div class="table-responsive">
																						<table class="table table-bordered table-hover w-100" id="dataKoleksiReferensi">
																							<thead>
																								<tr>
																									<th>Tahun</th>
																									<th>Kriteria</th>
																									<th>Kelas</th>
																									<th>Judul</th>
																									<th>Jumlah</th>
																									<th>Aksi</th>
																								</tr>
																							</thead>
																							<tbody>
																								<?php foreach ($list_koleksi_referensi as $item) { ?>
																									<tr>
																										<td><?= $item->koleksi_pertahun; ?></td>
																										<td>
																											<?php
																											if ($item->koleksi_kriteria == "umum") {
																												echo "Umum";
																											} elseif ($item->koleksi_kriteria == "referensi") {
																												echo "Referensi";
																											} elseif ($item->koleksi_kriteria == "terbitan_berkala") {
																												echo "Terbitan Berkala";
																											}
																											?>
																										</td>
																										<td><?= $item->koleksi_kelas; ?></td>
																										<td><?= $item->koleksi_judul; ?></td>
																										<td><?= $item->koleksi_jumlah; ?></td>
																										<td>
																											<div class="form-group card ">
																												<a href="<?= base_url('koleksi_edit/' . $item->koleksi_id); ?>" class="btn btn-light btn-sm"><i class="fa fa-edit"></i> Edit</a>
																											</div>
																											<?php if ($user->user_role == 1) { ?>
																												<div class="form-group card ">
																													<a href="<?= base_url('koleksi_delete/' . $item->koleksi_id . '/' . $item->sekolah_id); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin menghapus data koleksi?')"><i class="fa fa-trash"></i> Hapus</a>
																												</div>
																											<?php } ?>
																										</td>
																									</tr>
																								<?php } ?>
																							</tbody>
																						</table>
																					</div>
																				</div>
																				<div id="koleksiTerbitanTab" class="tab-pane container fade">
																					<a href="<?= base_url("dataSekolah") ?>" class="btn btn-info btn-sm mb-4"><i class="fas fa-fw fa-chevron-left"></i> </a>
																					<a href="" data-toggle="modal" data-target="#addKoleksiTerbitan" class="btn btn-success btn-sm mb-4"><i class="fa fa-plus"></i> Tambah data</a>
																					<div class="table-responsive">
																						<table class="table table-bordered table-hover w-100" id="dataKoleksiTerbitan">
																							<thead>
																								<tr>
																									<th>Tahun</th>
																									<th>Kriteria</th>
																									<th>Kelas</th>
																									<th>Judul</th>
																									<th>Jumlah</th>
																									<th>Aksi</th>
																								</tr>
																							</thead>
																							<tbody>
																								<?php foreach ($list_koleksi_terbitan as $item) { ?>
																									<tr>
																										<td><?= $item->koleksi_pertahun; ?></td>
																										<td>
																											<?php
																											if ($item->koleksi_kriteria == "umum") {
																												echo "Umum";
																											} elseif ($item->koleksi_kriteria == "referensi") {
																												echo "Referensi";
																											} elseif ($item->koleksi_kriteria == "terbitan_berkala") {
																												echo "Terbitan Berkala";
																											}
																											?>
																										</td>
																										<td><?= $item->koleksi_kelas; ?></td>
																										<td><?= $item->koleksi_judul; ?></td>
																										<td><?= $item->koleksi_jumlah; ?></td>
																										<td>
																											<div class="form-group card ">
																												<a href="<?= base_url('koleksi_edit/' . $item->koleksi_id); ?>" class="btn btn-light btn-sm"><i class="fa fa-edit"></i> Edit</a>
																											</div>
																											<?php if ($user->user_role == 1) { ?>
																												<div class="form-group card ">
																													<a href="<?= base_url('koleksi_delete/' . $item->koleksi_id . '/' . $item->sekolah_id); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin menghapus data koleksi?')"><i class="fa fa-trash"></i> Hapus</a>
																												</div>
																											<?php } ?>
																										</td>
																									</tr>
																								<?php } ?>
																							</tbody>
																						</table>
																					</div>
																				</div>
																			</div>
																			</div>
																			<?php if ($perpus == $url_Aktif) { ?>
																				<div id="personTab" class="tab-pane container fade">
																				<?php } else if ($sarana == $url_Aktif) { ?>
																					<div id="personTab" class="tab-pane container fade">
																					<?php } else if ($koleksi == $url_Aktif) { ?>
																						<div id="personTab" class="tab-pane container fade">
																						<?php } else if ($person == $url_Aktif) { ?>
																							<div id="personTab" class="tab-pane container active">
																							<?php } else { ?>
																								<div id="personTab" class="tab-pane container fade">
																								<?php } ?>
																								<b> <?= "Data Person" ?></b>
																								<div class="col text-right">
																									<?php foreach ($nama_sekolah as $sekolah) {
																										$variable = 4; ?>
																										<a href="<?= base_url('perpus_lapor/' . $variable . '/' . $sekolah->sekolah_id); ?>" class="btn btn-dark btn-sm ml-auto" onclick="return confirm('Yakin akan melaporkan data person ke Pemda?')"><i class="fa fa-paper-plane"></i> Laporkan Data Person ke Pemda</a>
																									<?php } ?>
																								</div>
																								<hr>
																								<ul class="nav nav-pills" role="tablist">
																									<li class="nav-item border border-primary rounded m-1">
																										<a class="nav-link active" data-toggle="pill" href="#personSemuaTab"><i class="fas fa-list-alt"></i> Semua</a>
																									</li>
																									<li class="nav-item border border-primary rounded m-1">
																										<a class="nav-link" data-toggle="pill" href="#personAnggotaTab"><i class="fas fa-user-tie"></i> Anggota</a>
																									</li>
																									<li class="nav-item border border-primary rounded m-1">
																										<a class="nav-link" data-toggle="pill" href="#personPemustakaTab"><i class="fas fa-user-tag"></i> Pemustaka</a>
																									</li>
																									<li class="nav-item border border-primary rounded m-1">
																										<a class="nav-link" data-toggle="pill" href="#personPengunjungTab"><i class="fas fa-user-minus"></i> Pengunjung</a>
																									</li>
																								</ul>
																								<hr>
																								<div class="tab-content">
																									<div id="personSemuaTab" class="tab-pane container active">
																										<a href="<?= base_url("dataSekolah") ?>" class="btn btn-info btn-sm mb-4"><i class="fas fa-fw fa-chevron-left"></i> </a>
																										<a href="" data-toggle="modal" data-target="#addPerson" class="btn btn-success btn-sm mb-4"><i class="fa fa-plus"></i> Tambah data</a>
																										<div class="table-responsive">
																											<table class="table table-bordered table-hover w-100" id="dataPerson">
																												<thead>
																													<tr>
																														<th>Tahun</th>
																														<th>Kriteria</th>
																														<th>Jumlah Guru/Staff</th>
																														<th>Jumlah Siswa</th>
																														<th>Aksi</th>
																													</tr>
																												</thead>
																												<tbody>
																													<?php foreach ($list_person as $item) { ?>
																														<tr>
																															<td><?= $item->person_pertahun; ?></td>
																															<td>
																																<?php if ($item->person_kriteria == "anggota") {
																																	echo "Anggota";
																																} elseif ($item->person_kriteria == "pemustaka") {
																																	echo "Pemustaka";
																																} elseif ($item->person_kriteria == "pengunjung") {
																																	echo "Pengunjung";
																																} ?>
																															</td>
																															<td><?= $item->person_jumlahGuruStaff; ?></td>
																															<td><?= $item->person_jumlahSiswa; ?></td>
																															<td>
																																<div class="form-group card ">
																																	<a href="<?= base_url('person_edit/' . $item->person_id); ?>" class="btn btn-light btn-sm"><i class="fa fa-edit"></i> Edit</a>
																																</div>
																																<?php if ($user->user_role == 1) { ?>
																																	<div class="form-group card ">
																																		<a href="<?= base_url('person_delete/' . $item->person_id . '/' . $item->sekolah_id); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin menghapus data person?')"><i class="fa fa-trash"></i> Hapus</a>
																																	</div>
																																<?php } ?>
																															</td>
																														</tr>
																													<?php } ?>
																												</tbody>
																											</table>
																										</div>
																									</div>
																									<div id="personAnggotaTab" class="tab-pane container fade">
																										<a href="<?= base_url("dataSekolah") ?>" class="btn btn-info btn-sm mb-4"><i class="fas fa-fw fa-chevron-left"></i> </a>
																										<a href="" data-toggle="modal" data-target="#addPersonAnggota" class="btn btn-success btn-sm mb-4"><i class="fa fa-plus"></i> Tambah data</a>
																										<div class="table-responsive">
																											<table class="table table-bordered table-hover w-100" id="dataPersonAnggota">
																												<thead>
																													<tr>
																														<th>Tahun</th>
																														<th>Kriteria</th>
																														<th>Jumlah Guru/Staff</th>
																														<th>Jumlah Siswa</th>
																														<th>Aksi</th>
																													</tr>
																												</thead>
																												<tbody>
																													<?php foreach ($list_person_anggota as $item) { ?>
																														<tr>
																															<td><?= $item->person_pertahun; ?></td>
																															<td>
																																<?php
																																if ($item->person_kriteria == "anggota") {
																																	echo "Anggota";
																																} elseif ($item->person_kriteria == "pemustaka") {
																																	echo "Pemustaka";
																																} elseif ($item->person_kriteria == "pengunjung") {
																																	echo "Pengunjung";
																																}
																																?>
																															</td>
																															<td><?= $item->person_jumlahGuruStaff; ?></td>
																															<td><?= $item->person_jumlahSiswa; ?></td>
																															<td>
																																<div class="form-group card ">
																																	<a href="<?= base_url('person_edit/' . $item->person_id); ?>" class="btn btn-light btn-sm"><i class="fa fa-edit"></i> Edit</a>
																																</div>
																																<?php if ($user->user_role == 1) { ?>
																																	<div class="form-group card ">
																																		<a href="<?= base_url('person_delete/' . $item->person_id . '/' . $item->sekolah_id); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin menghapus data person?')"><i class="fa fa-trash"></i> Hapus</a>
																																	</div>
																																<?php } ?>
																															</td>
																														</tr>
																													<?php } ?>
																												</tbody>
																											</table>
																										</div>
																									</div>
																									<div id="personPemustakaTab" class="tab-pane container fade">
																										<a href="<?= base_url("dataSekolah") ?>" class="btn btn-info btn-sm mb-4"><i class="fas fa-fw fa-chevron-left"></i> </a>
																										<a href="" data-toggle="modal" data-target="#addPersonPemustaka" class="btn btn-success btn-sm mb-4"><i class="fa fa-plus"></i> Tambah data</a>
																										<div class="table-responsive">
																											<table class="table table-bordered table-hover w-100" id="dataPersonPemustaka">
																												<thead>
																													<tr>
																														<th>Tahun</th>
																														<th>Kriteria</th>
																														<th>Jumlah Guru/Staff</th>
																														<th>Jumlah Siswa</th>
																														<th>Aksi</th>
																													</tr>
																												</thead>
																												<tbody>
																													<?php foreach ($list_person_pemustaka as $item) { ?>
																														<tr>
																															<td><?= $item->person_pertahun; ?></td>
																															<td>
																																<?php
																																if ($item->person_kriteria == "anggota") {
																																	echo "Anggota";
																																} elseif ($item->person_kriteria == "pemustaka") {
																																	echo "Pemustaka";
																																} elseif ($item->person_kriteria == "pengunjung") {
																																	echo "Pengunjung";
																																}
																																?>
																															</td>
																															<td><?= $item->person_jumlahGuruStaff; ?></td>
																															<td><?= $item->person_jumlahSiswa; ?></td>
																															<td>
																																<div class="form-group card ">
																																	<a href="<?= base_url('person_edit/' . $item->person_id); ?>" class="btn btn-light btn-sm"><i class="fa fa-edit"></i> Edit</a>
																																</div>
																																<?php if ($user->user_role == 1) { ?>
																																	<div class="form-group card ">
																																		<a href="<?= base_url('person_delete/' . $item->person_id . '/' . $item->sekolah_id); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin menghapus data person?')"><i class="fa fa-trash"></i> Hapus</a>
																																	</div>
																																<?php } ?>
																															</td>
																														</tr>
																													<?php } ?>
																												</tbody>
																											</table>
																										</div>
																									</div>
																									<div id="personPengunjungTab" class="tab-pane container fade">
																										<a href="<?= base_url("dataSekolah") ?>" class="btn btn-info btn-sm mb-4"><i class="fas fa-fw fa-chevron-left"></i> </a>
																										<a href="" data-toggle="modal" data-target="#addPersonPengunjung" class="btn btn-success btn-sm mb-4"><i class="fa fa-plus"></i> Tambah data</a>
																										<div class="table-responsive">
																											<table class="table table-bordered table-hover w-100" id="dataPersonPengunjung">
																												<thead>
																													<tr>
																														<th>Tahun</th>
																														<th>Kriteria</th>
																														<th>Jumlah Guru/Staff</th>
																														<th>Jumlah Siswa</th>
																														<th>Aksi</th>
																													</tr>
																												</thead>
																												<tbody>
																													<?php foreach ($list_person_pengunjung as $item) { ?>
																														<tr>
																															<td><?= $item->person_pertahun; ?></td>
																															<td>
																																<?php
																																if ($item->person_kriteria == "anggota") {
																																	echo "Anggota";
																																} elseif ($item->person_kriteria == "pemustaka") {
																																	echo "Pemustaka";
																																} elseif ($item->person_kriteria == "pengunjung") {
																																	echo "Pengunjung";
																																}
																																?>
																															</td>
																															<td><?= $item->person_jumlahGuruStaff; ?></td>
																															<td><?= $item->person_jumlahSiswa; ?></td>
																															<td>
																																<div class="form-group card ">
																																	<a href="<?= base_url('person_edit/' . $item->person_id); ?>" class="btn btn-light btn-sm"><i class="fa fa-edit"></i> Edit</a>
																																</div>
																																<?php if ($user->user_role == 1) { ?>
																																	<div class="form-group card ">
																																		<a href="<?= base_url('person_delete/' . $item->person_id . '/' . $item->sekolah_id); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin menghapus data person?')"><i class="fa fa-trash"></i> Hapus</a>
																																	</div>
																																<?php } ?>
																															</td>
																														</tr>
																													<?php } ?>
																												</tbody>
																											</table>
																										</div>
																									</div>
																								</div>
																								</div>
																							</div>
																						</div>
																						<div class="modal fade" id="addPerpustakaan">
																							<div class="modal-dialog modal-dialog-scrollable">
																								<div class="modal-content">
																									<div class="modal-header">
																										<h4 class="modal-title"><b>Form</b> | Tambah Data Perpustakaan</h4>
																										<button type="button" data-dismiss="modal" class="close">&times;</button>
																									</div>
																									<div class="modal-body">
																										<?= form_open('add_perpus'); ?>
																										<div class="form-group">
																											<?= form_label('Tahun') ?>
																											<input type="number" name="perpus_pertahun" class="form-control">
																										</div>
																										<div class="form-group">
																											<?= form_label('Nama Pengelola') ?>
																											<?= form_input("perpus_namaPengelola", "", "class='form-control'"); ?>
																										</div>
																										<div class="form-group">
																											<?= form_label('Kontak Pengelola') ?>
																											<input type="number" name="perpus_kontakPengelola" class="form-control">

																										</div>
																										<div class="form-group">
																											<?= form_label('Nama Sekretaris') ?>
																											<?= form_input("perpus_namaSekretaris", "", "class='form-control'"); ?>
																										</div>
																										<div class="form-group">
																											<?= form_label('Nama Petugas') ?>
																											<?= form_input("perpus_namaPetugas", "", "class='form-control'"); ?>
																										</div>
																										<?php foreach ($nama_sekolah as $id_sekolah) { ?>
																											<input type="hidden" name="sekolah_id" value="<?= $id_sekolah->sekolah_id; ?>" class="form-control">
																										<?php } ?>
																										<input type="submit" value="Simpan" class="btn btn-success btn-sm">
																										<?= form_close(); ?>
																									</div>
																									<div class="modal-footer">
																										<button type="button" data-dismiss="modal" class="btn btn-danger btn-sm">Close</button>
																									</div>
																								</div>
																							</div>
																						</div>
																						<div class="modal fade" id="addSarana">
																							<div class="modal-dialog modal-dialog-scrollable">
																								<div class="modal-content">
																									<div class="modal-header">
																										<h4 class="modal-title"><b>Form</b> | Tambah Data Sarana-Prasarana</h4>
																										<button type="button" data-dismiss="modal" class="close">&times;</button>
																									</div>
																									<div class="modal-body">
																										<?= form_open('add_sarana'); ?>
																										<div class="form-group">
																											<?= form_label('Tahun') ?>
																											<input type="number" name="sarana_pertahun" class="form-control">
																										</div>
																										<div class="form-group">
																											<?= form_label('Luas Gedung (m<sup>2</sup>)') ?>
																											<?= form_input("sarana_luasGedung", "", "class='form-control'"); ?>
																										</div>
																										<div class="form-group">
																											<?= form_label('Jumlah Rak Sirkulasi') ?>
																											<input type="number" name="sarana_jumlahRakSirkulasi" class="form-control">
																										</div>
																										<div class="form-group">
																											<?= form_label('Jumlah Rak Referensi') ?>
																											<input type="number" name="sarana_jumlahRakReferensi" class="form-control">
																										</div>
																										<div class="form-group">
																											<?= form_label('Jumlah Rak Terbitan') ?>
																											<input type="number" name="sarana_jumlahRakTerbitan" class="form-control">
																										</div>
																										<?php foreach ($nama_sekolah as $id_sekolah) { ?>
																											<input type="hidden" name="sekolah_id" value="<?= $id_sekolah->sekolah_id; ?>" class="form-control">
																										<?php } ?>
																										<input type="submit" value="Simpan" class="btn btn-success btn-sm">
																										<?= form_close(); ?>
																									</div>
																									<div class="modal-footer">
																										<button type="button" data-dismiss="modal" class="btn btn-danger btn-sm">Close</button>
																									</div>
																								</div>
																							</div>
																						</div>
																						<div class="modal fade" id="addKoleksi">
																							<div class="modal-dialog modal-dialog-scrollable">
																								<div class="modal-content">
																									<div class="modal-header">
																										<h4 class="modal-title"><b>Form</b> | Tambah Data Koleksi</h4>
																										<button type="button" data-dismiss="modal" class="close">&times;</button>
																									</div>
																									<div class="modal-body">
																										<?= form_open('add_koleksi'); ?>
																										<div class="form-group">
																											<?= form_label('Tahun') ?>
																											<input type="number" name="koleksi_pertahun" class="form-control">
																										</div>
																										<div class="form-group">
																											<label>Kriteria</label>
																											<select class="form-control" id="koleksi_kriteria" name="koleksi_kriteria">
																												<option disabled selected>-- Pilih Kriteria --</option>
																												<option value="umum">Umum</option>
																												<option value="referensi">Referensi</option>
																												<option value="terbitan_berkala">Terbitan Berkala</option>
																											</select>
																										</div>
																										<div class="form-group">
																											<?= form_label('Kelas') ?>
																											<?= form_input("koleksi_kelas", "", "class='form-control'"); ?>
																										</div>
																										<div class="form-group">
																											<?= form_label('Judul') ?>
																											<?= form_input("koleksi_judul", "", "class='form-control'"); ?>
																										</div>
																										<div class="form-group">
																											<?= form_label('Jumlah') ?>
																											<input type="number" name="koleksi_jumlah" class="form-control">
																										</div>
																										<?php foreach ($nama_sekolah as $id_sekolah) { ?>
																											<input type="hidden" name="sekolah_id" value="<?= $id_sekolah->sekolah_id; ?>" class="form-control">
																										<?php } ?>
																										<input type="submit" value="Simpan" class="btn btn-success btn-sm">
																										<?= form_close(); ?>
																									</div>
																									<div class="modal-footer">
																										<button type="button" data-dismiss="modal" class="btn btn-danger btn-sm">Close</button>
																									</div>
																								</div>
																							</div>
																						</div>
																						<div class="modal fade" id="addKoleksiUmum">
																							<div class="modal-dialog modal-dialog-scrollable">
																								<div class="modal-content">
																									<div class="modal-header">
																										<h4 class="modal-title"><b>Form</b> | Tambah Data Koleksi</h4>
																										<button type="button" data-dismiss="modal" class="close">&times;</button>
																									</div>
																									<div class="modal-body">
																										<?= form_open('add_koleksi'); ?>
																										<div class="form-group">
																											<?= form_label('Tahun') ?>
																											<input type="number" name="koleksi_pertahun" class="form-control">
																										</div>
																										<div class="form-group">
																											<label>Kriteria</label>
																											<select class="form-control" id="koleksi_kriteria" name="koleksi_kriteria">
																												<option disabled>-- Pilih Kriteria --</option>
																												<option value="umum" selected>Umum</option>
																												<option value="referensi">Referensi</option>
																												<option value="terbitan_berkala">Terbitan Berkala</option>
																											</select>
																										</div>
																										<div class="form-group">
																											<?= form_label('Kelas') ?>
																											<?= form_input("koleksi_kelas", "", "class='form-control'"); ?>
																										</div>
																										<div class="form-group">
																											<?= form_label('Judul') ?>
																											<?= form_input("koleksi_judul", "", "class='form-control'"); ?>
																										</div>
																										<div class="form-group">
																											<?= form_label('Jumlah') ?>
																											<input type="number" name="koleksi_jumlah" class="form-control">
																										</div>
																										<?php foreach ($nama_sekolah as $id_sekolah) { ?>
																											<input type="hidden" name="sekolah_id" value="<?= $id_sekolah->sekolah_id; ?>" class="form-control">
																										<?php } ?>
																										<input type="submit" value="Simpan" class="btn btn-success btn-sm">
																										<?= form_close(); ?>
																									</div>
																									<div class="modal-footer">
																										<button type="button" data-dismiss="modal" class="btn btn-danger btn-sm">Close</button>
																									</div>
																								</div>
																							</div>
																						</div>
																						<div class="modal fade" id="addKoleksiReferensi">
																							<div class="modal-dialog modal-dialog-scrollable">
																								<div class="modal-content">
																									<div class="modal-header">
																										<h4 class="modal-title"><b>Form</b> | Tambah Data Koleksi</h4>
																										<button type="button" data-dismiss="modal" class="close">&times;</button>
																									</div>
																									<div class="modal-body">
																										<?= form_open('add_koleksi'); ?>
																										<div class="form-group">
																											<?= form_label('Tahun') ?>
																											<input type="number" name="koleksi_pertahun" class="form-control">
																										</div>
																										<div class="form-group">
																											<label>Kriteria</label>
																											<select class="form-control" id="koleksi_kriteria" name="koleksi_kriteria">
																												<option disabled>-- Pilih Kriteria --</option>
																												<option value="umum">Umum</option>
																												<option value="referensi" selected>Referensi</option>
																												<option value="terbitan_berkala">Terbitan Berkala</option>
																											</select>
																										</div>
																										<div class="form-group">
																											<?= form_label('Kelas') ?>
																											<?= form_input("koleksi_kelas", "", "class='form-control'"); ?>
																										</div>
																										<div class="form-group">
																											<?= form_label('Judul') ?>
																											<?= form_input("koleksi_judul", "", "class='form-control'"); ?>
																										</div>
																										<div class="form-group">
																											<?= form_label('Jumlah') ?>
																											<input type="number" name="koleksi_jumlah" class="form-control">
																										</div>
																										<?php foreach ($nama_sekolah as $id_sekolah) { ?>
																											<input type="hidden" name="sekolah_id" value="<?= $id_sekolah->sekolah_id; ?>" class="form-control">
																										<?php } ?>
																										<input type="submit" value="Simpan" class="btn btn-success btn-sm">
																										<?= form_close(); ?>
																									</div>
																									<div class="modal-footer">
																										<button type="button" data-dismiss="modal" class="btn btn-danger btn-sm">Close</button>
																									</div>
																								</div>
																							</div>
																						</div>
																						<div class="modal fade" id="addKoleksiTerbitan">
																							<div class="modal-dialog modal-dialog-scrollable">
																								<div class="modal-content">
																									<div class="modal-header">
																										<h4 class="modal-title"><b>Form</b> | Tambah Data Koleksi</h4>
																										<button type="button" data-dismiss="modal" class="close">&times;</button>
																									</div>
																									<div class="modal-body">
																										<?= form_open('add_koleksi'); ?>
																										<div class="form-group">
																											<?= form_label('Tahun') ?>
																											<input type="number" name="koleksi_pertahun" class="form-control">
																										</div>
																										<div class="form-group">
																											<label>Kriteria</label>
																											<select class="form-control" id="koleksi_kriteria" name="koleksi_kriteria">
																												<option disabled>-- Pilih Kriteria --</option>
																												<option value="umum">Umum</option>
																												<option value="referensi">Referensi</option>
																												<option value="terbitan_berkala" selected>Terbitan Berkala</option>
																											</select>
																										</div>
																										<div class="form-group">
																											<?= form_label('Kelas') ?>
																											<?= form_input("koleksi_kelas", "", "class='form-control'"); ?>
																										</div>
																										<div class="form-group">
																											<?= form_label('Judul') ?>
																											<?= form_input("koleksi_judul", "", "class='form-control'"); ?>
																										</div>
																										<div class="form-group">
																											<?= form_label('Jumlah') ?>
																											<input type="number" name="koleksi_jumlah" class="form-control">
																										</div>
																										<?php foreach ($nama_sekolah as $id_sekolah) { ?>
																											<input type="hidden" name="sekolah_id" value="<?= $id_sekolah->sekolah_id; ?>" class="form-control">
																										<?php } ?>
																										<input type="submit" value="Simpan" class="btn btn-success btn-sm">
																										<?= form_close(); ?>
																									</div>
																									<div class="modal-footer">
																										<button type="button" data-dismiss="modal" class="btn btn-danger btn-sm">Close</button>
																									</div>
																								</div>
																							</div>
																						</div>
																						<div class="modal fade" id="addPerson">
																							<div class="modal-dialog modal-dialog-scrollable">
																								<div class="modal-content">
																									<div class="modal-header">
																										<h4 class="modal-title"><b>Form</b> | Tambah Data Person</h4>
																										<button type="button" data-dismiss="modal" class="close">&times;</button>
																									</div>
																									<div class="modal-body">
																										<?= form_open('add_person'); ?>
																										<div class="form-group">
																											<?= form_label('Tahun') ?>
																											<input type="number" name="person_pertahun" class="form-control">
																										</div>
																										<div class="form-group">
																											<label>Kriteria</label>
																											<select class="form-control" id="person_kriteria" name="person_kriteria">
																												<option disabled selected>-- Pilih Kriteria --</option>
																												<option value="anggota">Anggota</option>
																												<option value="pemustaka">Pemustaka</option>
																												<option value="pengunjung">Pengunjung</option>
																											</select>
																										</div>
																										<div class="form-group">
																											<?= form_label('Jumlah Guru/Staff') ?>
																											<input type="number" name="person_jumlahGuruStaff" class="form-control">
																										</div>
																										<div class="form-group">
																											<?= form_label('Jumlah Siswa') ?>
																											<input type="number" name="person_jumlahSiswa" class="form-control">
																										</div>
																										<?php foreach ($nama_sekolah as $id_sekolah) { ?>
																											<input type="hidden" name="sekolah_id" value="<?= $id_sekolah->sekolah_id; ?>" class="form-control">
																										<?php } ?>
																										<input type="submit" value="Simpan" class="btn btn-success btn-sm">
																										<?= form_close(); ?>
																									</div>
																									<div class="modal-footer">
																										<button type="button" data-dismiss="modal" class="btn btn-danger btn-sm">Close</button>
																									</div>
																								</div>
																							</div>
																						</div>
																						<div class="modal fade" id="addPersonAnggota">
																							<div class="modal-dialog modal-dialog-scrollable">
																								<div class="modal-content">
																									<div class="modal-header">
																										<h4 class="modal-title"><b>Form</b> | Tambah Data Person</h4>
																										<button type="button" data-dismiss="modal" class="close">&times;</button>
																									</div>
																									<div class="modal-body">
																										<?= form_open('add_person'); ?>
																										<div class="form-group">
																											<?= form_label('Tahun') ?>
																											<input type="number" name="person_pertahun" class="form-control">
																										</div>
																										<div class="form-group">
																											<label>Kriteria</label>
																											<select class="form-control" id="person_kriteria" name="person_kriteria">
																												<option disabled>-- Pilih Kriteria --</option>
																												<option value="anggota" selected>Anggota</option>
																												<option value="pemustaka">Pemustaka</option>
																												<option value="pengunjung">Pengunjung</option>
																											</select>
																										</div>
																										<div class="form-group">
																											<?= form_label('Jumlah Guru/Staff') ?>
																											<input type="number" name="person_jumlahGuruStaff" class="form-control">
																										</div>
																										<div class="form-group">
																											<?= form_label('Jumlah Siswa') ?>
																											<input type="number" name="person_jumlahSiswa" class="form-control">
																										</div>
																										<?php foreach ($nama_sekolah as $id_sekolah) { ?>
																											<input type="hidden" name="sekolah_id" value="<?= $id_sekolah->sekolah_id; ?>" class="form-control">
																										<?php } ?>
																										<input type="submit" value="Simpan" class="btn btn-success btn-sm">
																										<?= form_close(); ?>
																									</div>
																									<div class="modal-footer">
																										<button type="button" data-dismiss="modal" class="btn btn-danger btn-sm">Close</button>
																									</div>
																								</div>
																							</div>
																						</div>
																						<div class="modal fade" id="addPersonPemustaka">
																							<div class="modal-dialog modal-dialog-scrollable">
																								<div class="modal-content">
																									<div class="modal-header">
																										<h4 class="modal-title"><b>Form</b> | Tambah Data Person</h4>
																										<button type="button" data-dismiss="modal" class="close">&times;</button>
																									</div>
																									<div class="modal-body">
																										<?= form_open('add_person'); ?>
																										<div class="form-group">
																											<?= form_label('Tahun') ?>
																											<input type="number" name="person_pertahun" class="form-control">
																										</div>
																										<div class="form-group">
																											<label>Kriteria</label>
																											<select class="form-control" id="person_kriteria" name="person_kriteria">
																												<option disabled>-- Pilih Kriteria --</option>
																												<option value="anggota">Anggota</option>
																												<option value="pemustaka" selected>Pemustaka</option>
																												<option value="pengunjung">Pengunjung</option>
																											</select>
																										</div>
																										<div class="form-group">
																											<?= form_label('Jumlah Guru/Staff') ?>
																											<input type="number" name="person_jumlahGuruStaff" class="form-control">
																										</div>
																										<div class="form-group">
																											<?= form_label('Jumlah Siswa') ?>
																											<input type="number" name="person_jumlahSiswa" class="form-control">
																										</div>
																										<?php foreach ($nama_sekolah as $id_sekolah) { ?>
																											<input type="hidden" name="sekolah_id" value="<?= $id_sekolah->sekolah_id; ?>" class="form-control">
																										<?php } ?>
																										<input type="submit" value="Simpan" class="btn btn-success btn-sm">
																										<?= form_close(); ?>
																									</div>
																									<div class="modal-footer">
																										<button type="button" data-dismiss="modal" class="btn btn-danger btn-sm">Close</button>
																									</div>
																								</div>
																							</div>
																						</div>
																						<div class="modal fade" id="addPersonPengunjung">
																							<div class="modal-dialog modal-dialog-scrollable">
																								<div class="modal-content">
																									<div class="modal-header">
																										<h4 class="modal-title"><b>Form</b> | Tambah Data Person</h4>
																										<button type="button" data-dismiss="modal" class="close">&times;</button>
																									</div>
																									<div class="modal-body">
																										<?= form_open('add_person'); ?>
																										<div class="form-group">
																											<?= form_label('Tahun') ?>
																											<input type="number" name="person_pertahun" class="form-control">
																										</div>
																										<div class="form-group">
																											<label>Kriteria</label>
																											<select class="form-control" id="person_kriteria" name="person_kriteria">
																												<option disabled>-- Pilih Kriteria --</option>
																												<option value="anggota">Anggota</option>
																												<option value="pemustaka">Pemustaka</option>
																												<option value="pengunjung" selected>Pengunjung</option>
																											</select>
																										</div>
																										<div class="form-group">
																											<?= form_label('Jumlah Guru/Staff') ?>
																											<input type="number" name="person_jumlahGuruStaff" class="form-control">
																										</div>
																										<div class="form-group">
																											<?= form_label('Jumlah Siswa') ?>
																											<input type="number" name="person_jumlahSiswa" class="form-control">
																										</div>
																										<?php foreach ($nama_sekolah as $id_sekolah) { ?>
																											<input type="hidden" name="sekolah_id" value="<?= $id_sekolah->sekolah_id; ?>" class="form-control">
																										<?php } ?>
																										<input type="submit" value="Simpan" class="btn btn-success btn-sm">
																										<?= form_close(); ?>
																									</div>
																									<div class="modal-footer">
																										<button type="button" data-dismiss="modal" class="btn btn-danger btn-sm">Close</button>
																									</div>
																								</div>
																							</div>
																						</div>
																					</div>
