<?= $this->session->flashdata('pesan'); ?>
<div class="container-fluid">
	<?php if ($user->user_role <= 2) { ?>
		<div class="row">
			<div class="col-xl-6 col-md-6 mb-4">
				<div class="card border-left-primary shadow h-100 py-2">
					<div class="card-body">
						<div class="row no-gutters align-items-center">
							<div class="col mr-2">
								<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Buku</div>
								<div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_buku; ?></div>
							</div>
							<div class="col-auto">
								<i class="fas fa-fw fa-book fa-2x text-gray-300"></i>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xl-6 col-md-6 mb-4">
				<div class="card border-left-primary shadow h-100 py-2">
					<div class="card-body">
						<div class="row no-gutters align-items-center">
							<div class="col mr-2">
								<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Booking Buku Hari Ini</div>
								<div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_booking; ?></div>
							</div>
							<div class="col-auto">
								<i class="fas fa-fw fa-comments fa-2x text-gray-300"></i>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<hr class="bg-primary">
		<div class="row">
			<div class="col-xl-6 col-md-6 mb-4">
				<div class="card border-left-primary shadow h-100 py-2">
					<div class="card-body">
						<div class="row no-gutters align-items-center">
							<div class="col mr-2">
								<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Peminjaman Buku Hari Ini</div>
								<div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_pinjam; ?></div>
							</div>
							<div class="col-auto">
								<i class="fas fa-fw fa-book-reader fa-2x text-gray-300"></i>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xl-6 col-md-6 mb-4">
				<div class="card border-left-primary shadow h-100 py-2">
					<div class="card-body">
						<div class="row no-gutters align-items-center">
							<div class="col mr-2">
								<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Pengembalian Buku Hari Ini</div>
								<div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_kembali; ?></div>
							</div>
							<div class="col-auto">
								<i class="fas fa-fw fa-book-reader fa-2x text-gray-300"></i>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row mb-4 justify-content-center">
			<div class="col-md mb-4">
				<div class="card shadow">
					<div class="card-body">
						<center>
							<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Peminjaman & Pengembalian Buku</div>
						</center>
						<div class="chart-pie pt-4 pb-2">
							<canvas id="chartBuku"></canvas>
						</div>
						<div class="mt-4 text-center small">
							<span class="mr-2">
								<i class="fas fa-circle text-success"></i> Peminjaman
							</span>
							<span class="mr-2">
								<i class="fas fa-circle text-primary"></i> Pengembalian
							</span>
						</div>
					</div>
				</div>
			</div>
		</div>
		<hr class="bg-primary">
		<div class="row ">
			<div class="col-xl-6 col-md-6 mb-4">
				<div class="card border-left-primary shadow h-100 py-2">
					<div class="card-body">
						<div class="row no-gutters align-items-center">
							<div class="col mr-2">
								<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Pengunjung Perpustakaan</div>
								<div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_pengunjung_perpus; ?></div>
							</div>
							<div class="col-auto">
								<i class="fas fa-fw fa-users fa-2x text-gray-300"></i>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xl-6 col-md-6 mb-4">
				<div class="card border-left-primary shadow h-100 py-2">
					<div class="card-body ">
						<div class="row no-gutters align-items-center">
							<div class="col mr-2">
								<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Pengunjung Perpustakaan Hari ini</div>
								<div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_pengunjung_perpus_today; ?></div>
							</div>
							<div class="col-auto">
								<i class="fas fa-users fa-2x text-gray-300"></i>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="card shadow">
					<div class="card-body">
						<center>
							<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Data Klasifikasi Pengunjung Perpustakaan</div>
						</center>
						<div class="chart-pie pt-4 pb-2">
							<canvas id="chartKlasifikasi_pengunjung"></canvas>
						</div>
					</div>
				</div>
			</div>
		</div>
		<hr class="bg-primary ">
		<div class="row justify-content-center">
			<div class="col-xl col-md mb-4">
				<div class="card border-left-primary shadow h-100 py-2">
					<div class="card-body">
						<div class="row no-gutters align-items-center">
							<div class="col mr-2">
								<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Anggota Perpustakaan (Pemda)</div>
								<div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_anggota; ?></div>
							</div>
							<div class="col-auto">
								<i class="fas fa-fw fa-user-tag fa-2x text-gray-300"></i>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row justify-content-center">
			<div class="col-md">
				<div class="card shadow">
					<div class="card-body">
						<center>
							<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Data Klasifikasi Anggota Perpustakaan (Pemda)</div>
						</center>
						<div class="chart-pie pt-4 pb-2">
							<canvas id="chartKlasifikasi"></canvas>
						</div>
					</div>
				</div>
			</div>
		</div>
		<p></p>
		<p></p>
		<hr class="bg-primary">
		<div class="row">
			<div class="col-xl-6 col-md-6 mb-4">
				<div class="card border-left-primary shadow h-100 py-2">
					<div class="card-body">
						<div class="row no-gutters align-items-center">
							<div class="col mr-2">
								<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Pengunjung Website Tahun Ini</div>
								<div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_pengunjung_website; ?></div>
							</div>
							<div class="col-auto">
								<i class="fas fa-chalkboard-teacher fa-2x text-gray-300"></i>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xl-6 col-md-6 mb-4">
				<div class="card border-left-primary shadow h-100 py-2">
					<div class="card-body">
						<div class="row no-gutters align-items-center">
							<div class="col mr-2">
								<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Pengunjung Website Hari ini</div>
								<div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_pengunjung_website_today; ?></div>
							</div>
							<div class="col-auto">
								<i class="fas fa-chalkboard-teacher fa-2x text-gray-300"></i>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<hr class="bg-primary">
		<div class="row">
			<div class="col-xl-6 col-md-6 mb-4">
				<div class="card border-left-primary shadow h-100 py-2">
					<div class="card-body">
						<div class="row no-gutters align-items-center">
							<div class="col mr-2">
								<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Login User Tahun Ini</div>
								<div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_log; ?></div>
							</div>
							<div class="col-auto">
								<i class="fas fa-fw fa-sign-in-alt fa-2x text-gray-300"></i>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xl-6 col-md-6 mb-4">
				<div class="card border-left-primary shadow h-100 py-2">
					<div class="card-body">
						<div class="row no-gutters align-items-center">
							<div class="col mr-2">
								<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Log User Hari Ini</div>
								<div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_log_today; ?></div>
							</div>
							<div class="col-auto">
								<i class="fas fa-fw fa-sign-in-alt fa-2x text-gray-300"></i>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<hr class="bg-primary">
		<div class="row">
			<div class="col-xl-6 col-md-6 mb-4">
				<div class="card border-left-primary shadow h-100 py-2">
					<div class="card-body">
						<div class="row no-gutters align-items-center">
							<div class="col mr-2">
								<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Petugas (Sekolah)</div>
								<div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_petugas_sekolah; ?></div>
							</div>
							<div class="col-auto">
								<i class="fas fa-fw fa-user-tie fa-2x text-gray-300"></i>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xl-6 col-md-6 mb-4">
				<div class="card border-left-primary shadow h-100 py-2">
					<div class="card-body">
						<div class="row no-gutters align-items-center">
							<div class="col mr-2">
								<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Sekolah</div>
								<div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_sekolah; ?></div>
							</div>
							<div class="col-auto">
								<i class="fas fa-fw fa-school fa-2x text-gray-300"></i>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<hr class="bg-primary">
	<?php } else if ($user->user_role == 6) { ?>
		<div class="row">
			<div class="col-xl-6 col-md-6 mb-4">
				<div class="card border-left-primary shadow h-100 py-2">
					<div class="card-body">
						<div class="row no-gutters align-items-center">
							<div class="col mr-2">
								<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Buku</div>
								<div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_buku; ?></div>
							</div>
							<div class="col-auto">
								<i class="fas fa-fw fa-book fa-2x text-gray-300"></i>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xl-6 col-md-6 mb-4">
				<div class="card border-left-primary shadow h-100 py-2">
					<div class="card-body">
						<div class="row no-gutters align-items-center">
							<div class="col mr-2">
								<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Booking Buku Hari Ini</div>
								<div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_booking; ?></div>
							</div>
							<div class="col-auto">
								<i class="fas fa-fw fa-comments fa-2x text-gray-300"></i>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<hr class="bg-primary">
		<div class="row">
			<div class="col-xl-6 col-md-6 mb-4">
				<div class="card border-left-primary shadow h-100 py-2">
					<div class="card-body">
						<div class="row no-gutters align-items-center">
							<div class="col mr-2">
								<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Peminjaman Buku Hari Ini</div>
								<div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_pinjam; ?></div>
							</div>
							<div class="col-auto">
								<i class="fas fa-fw fa-book-reader fa-2x text-gray-300"></i>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xl-6 col-md-6 mb-4">
				<div class="card border-left-primary shadow h-100 py-2">
					<div class="card-body">
						<div class="row no-gutters align-items-center">
							<div class="col mr-2">
								<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Pengembalian Buku Hari Ini</div>
								<div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_kembali; ?></div>
							</div>
							<div class="col-auto">
								<i class="fas fa-fw fa-book-reader fa-2x text-gray-300"></i>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row mb-4 justify-content-center">
			<div class="col-md mb-4">
				<div class="card shadow">
					<div class="card-body">
						<center>
							<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Peminjaman & Pengembalian Buku</div>
						</center>
						<div class="chart-pie pt-4 pb-2">
							<canvas id="chartBuku"></canvas>
						</div>
						<div class="mt-4 text-center small">
							<span class="mr-2">
								<i class="fas fa-circle text-success"></i> Peminjaman
							</span>
							<span class="mr-2">
								<i class="fas fa-circle text-primary"></i> Pengembalian
							</span>
						</div>
					</div>
				</div>
			</div>
		</div>
		<hr class="bg-primary">
		<div class="row ">
			<div class="col-xl-6 col-md-6 mb-4">
				<div class="card border-left-primary shadow h-100 py-2">
					<div class="card-body">
						<div class="row no-gutters align-items-center">
							<div class="col mr-2">
								<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Pengunjung Perpustakaan</div>
								<div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_pengunjung_perpus; ?></div>
							</div>
							<div class="col-auto">
								<i class="fas fa-fw fa-users fa-2x text-gray-300"></i>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xl-6 col-md-6 mb-4">
				<div class="card border-left-primary shadow h-100 py-2">
					<div class="card-body ">
						<div class="row no-gutters align-items-center">
							<div class="col mr-2">
								<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Pengunjung Perpustakaan Hari ini</div>
								<div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_pengunjung_perpus_today; ?></div>
							</div>
							<div class="col-auto">
								<i class="fas fa-users fa-2x text-gray-300"></i>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="card shadow">
					<div class="card-body">
						<center>
							<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Data Klasifikasi Pengunjung Perpustakaan</div>
						</center>
						<div class="chart-pie pt-4 pb-2">
							<canvas id="chartKlasifikasi_pengunjung"></canvas>
						</div>
					</div>
				</div>
			</div>
		</div>
		<hr class="bg-primary ">
		<div class="row justify-content-center">
			<div class="col-xl col-md mb-4">
				<div class="card border-left-primary shadow h-100 py-2">
					<div class="card-body">
						<div class="row no-gutters align-items-center">
							<div class="col mr-2">
								<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Anggota Perpustakaan (Pemda)</div>
								<div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_anggota; ?></div>
							</div>
							<div class="col-auto">
								<i class="fas fa-fw fa-user-tag fa-2x text-gray-300"></i>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row justify-content-center">
			<div class="col-md">
				<div class="card shadow">
					<div class="card-body">
						<center>
							<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Data Klasifikasi Anggota Perpustakaan (Pemda)</div>
						</center>
						<div class="chart-pie pt-4 pb-2">
							<canvas id="chartKlasifikasi"></canvas>
						</div>
					</div>
				</div>
			</div>
		</div>
		<p></p>
		<p></p>
		<hr class="bg-primary">
		<div class="row">
			<div class="col-xl-6 col-md-6 mb-4">
				<div class="card border-left-primary shadow h-100 py-2">
					<div class="card-body">
						<div class="row no-gutters align-items-center">
							<div class="col mr-2">
								<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Pengunjung Website Tahun Ini</div>
								<div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_pengunjung_website; ?></div>
							</div>
							<div class="col-auto">
								<i class="fas fa-chalkboard-teacher fa-2x text-gray-300"></i>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xl-6 col-md-6 mb-4">
				<div class="card border-left-primary shadow h-100 py-2">
					<div class="card-body">
						<div class="row no-gutters align-items-center">
							<div class="col mr-2">
								<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Pengunjung Website Hari ini</div>
								<div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_pengunjung_website_today; ?></div>
							</div>
							<div class="col-auto">
								<i class="fas fa-chalkboard-teacher fa-2x text-gray-300"></i>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<hr class="bg-primary">
		<div class="row">
			<div class="col-xl-6 col-md-6 mb-4">
				<div class="card border-left-primary shadow h-100 py-2">
					<div class="card-body">
						<div class="row no-gutters align-items-center">
							<div class="col mr-2">
								<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Login User Tahun Ini</div>
								<div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_log; ?></div>
							</div>
							<div class="col-auto">
								<i class="fas fa-fw fa-sign-in-alt fa-2x text-gray-300"></i>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xl-6 col-md-6 mb-4">
				<div class="card border-left-primary shadow h-100 py-2">
					<div class="card-body">
						<div class="row no-gutters align-items-center">
							<div class="col mr-2">
								<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Log User Hari Ini</div>
								<div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_log_today; ?></div>
							</div>
							<div class="col-auto">
								<i class="fas fa-fw fa-sign-in-alt fa-2x text-gray-300"></i>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<hr class="bg-primary">
		<div class="row">
			<div class="col-xl-6 col-md-6 mb-4">
				<div class="card border-left-primary shadow h-100 py-2">
					<div class="card-body">
						<div class="row no-gutters align-items-center">
							<div class="col mr-2">
								<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Petugas (Sekolah)</div>
								<div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_petugas_sekolah; ?></div>
							</div>
							<div class="col-auto">
								<i class="fas fa-fw fa-user-tie fa-2x text-gray-300"></i>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xl-6 col-md-6 mb-4">
				<div class="card border-left-primary shadow h-100 py-2">
					<div class="card-body">
						<div class="row no-gutters align-items-center">
							<div class="col mr-2">
								<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Sekolah</div>
								<div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_sekolah; ?></div>
							</div>
							<div class="col-auto">
								<i class="fas fa-fw fa-school fa-2x text-gray-300"></i>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<hr class="bg-primary">
	<?php } else if ($user->user_role == 7) { ?>
		<div class="row">
			<div class="col-xl col-md mb-4">
				<div class="card border-left-primary shadow h-100 py-2">
					<div class="card-body">
						<div class="row no-gutters align-items-center">
							<div class="col mr-2">
								<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Buku</div>
								<div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_buku; ?></div>
							</div>
							<div class="col-auto">
								<i class="fas fa-fw fa-book fa-2x text-gray-300"></i>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-xl-6 col-md-6 mb-4">
				<div class="card border-left-primary shadow h-100 py-2">
					<div class="card-body">
						<div class="row no-gutters align-items-center">
							<div class="col mr-2">
								<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Buku Aktif</div>
								<div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_buku_aktif; ?></div>
							</div>
							<div class="col-auto">
								<i class="fas fa-fw fa-book fa-2x text-gray-300"></i>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xl-6 col-md-6 mb-4">
				<div class="card border-left-primary shadow h-100 py-2">
					<div class="card-body">
						<div class="row no-gutters align-items-center">
							<div class="col mr-2">
								<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Buku Nonaktif</div>
								<div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_buku_nonaktif; ?></div>
							</div>
							<div class="col-auto">
								<i class="fas fa-fw fa-book fa-2x text-gray-300"></i>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-xl-6 col-md-6 mb-4">
				<div class="card border-left-primary shadow h-100 py-2">
					<div class="card-body">
						<div class="row no-gutters align-items-center">
							<div class="col mr-2">
								<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Kebutuhan Pemustaka</div>
								<div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_kebutuhanpemustaka; ?></div>
							</div>
							<div class="col-auto">
								<i class="fas fa-fw fa-solid fa-envelope fa-2x text-gray-300"></i>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xl-6 col-md-6 mb-4">
				<div class="card border-left-primary shadow h-100 py-2">
					<div class="card-body">
						<div class="row no-gutters align-items-center">
							<div class="col mr-2">
								<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Pengadaan Buku</div>
								<div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_pengadaan; ?></div>
							</div>
							<div class="col-auto">
								<i class="fas fa-fw fa-solid fa-envelope-open-text fa-2x text-gray-300"></i>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<hr class="bg-primary">
	<?php } else if ($user->user_role == 8) { ?>
		<div class="row">
			<div class="col-xl-6 col-md-6 mb-4">
				<div class="card border-left-primary shadow h-100 py-2">
					<div class="card-body">
						<div class="row no-gutters align-items-center">
							<div class="col mr-2">
								<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Buku</div>
								<div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_buku; ?></div>
							</div>
							<div class="col-auto">
								<i class="fas fa-fw fa-book fa-2x text-gray-300"></i>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xl-6 col-md-6 mb-4">
				<div class="card border-left-primary shadow h-100 py-2">
					<div class="card-body">
						<div class="row no-gutters align-items-center">
							<div class="col mr-2">
								<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Booking Buku Hari Ini</div>
								<div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_booking; ?></div>
							</div>
							<div class="col-auto">
								<i class="fas fa-fw fa-comments fa-2x text-gray-300"></i>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<hr class="bg-primary ">
		<div class="row justify-content-center">
			<div class="col-xl col-md mb-4">
				<div class="card border-left-primary shadow h-100 py-2">
					<div class="card-body">
						<div class="row no-gutters align-items-center">
							<div class="col mr-2">
								<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Kebutuhan Pemustaka</div>
								<div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_kebutuhanpemustaka; ?></div>
							</div>
							<div class="col-auto">
								<i class="fas fa-fw fa-solid fa-envelope fa-2x text-gray-300"></i>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<hr class="bg-primary">
		<div class="row">
			<div class="col-xl-6 col-md-6 mb-4">
				<div class="card border-left-primary shadow h-100 py-2">
					<div class="card-body">
						<div class="row no-gutters align-items-center">
							<div class="col mr-2">
								<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Peminjaman Buku Hari Ini</div>
								<div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_pinjam; ?></div>
							</div>
							<div class="col-auto">
								<i class="fas fa-fw fa-book-reader fa-2x text-gray-300"></i>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xl-6 col-md-6 mb-4">
				<div class="card border-left-primary shadow h-100 py-2">
					<div class="card-body">
						<div class="row no-gutters align-items-center">
							<div class="col mr-2">
								<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Pengembalian Buku Hari Ini</div>
								<div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_kembali; ?></div>
							</div>
							<div class="col-auto">
								<i class="fas fa-fw fa-book-reader fa-2x text-gray-300"></i>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- <div class="row mb-4 justify-content-center">
			<div class="col-md mb-4">
				<div class="card shadow">
					<div class="card-body">
						<center>
							<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Peminjaman & Pengembalian Buku</div>
						</center>
						<div class="chart-pie pt-4 pb-2">
							<canvas id="chartBuku"></canvas>
						</div>
						<div class="mt-4 text-center small">
							<span class="mr-2">
								<i class="fas fa-circle text-success"></i> Peminjaman
							</span>
							<span class="mr-2">
								<i class="fas fa-circle text-primary"></i> Pengembalian
							</span>
						</div>
					</div>
				</div>
			</div>
		</div> -->
		<hr class="bg-primary">
	<?php } else if ($user->user_role == 9) { ?>
		<div class="row ">
			<div class="col-xl-6 col-md-6 mb-4">
				<div class="card border-left-primary shadow h-100 py-2">
					<div class="card-body">
						<div class="row no-gutters align-items-center">
							<div class="col mr-2">
								<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Pengunjung Perpustakaan</div>
								<div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_pengunjung_perpus; ?></div>
							</div>
							<div class="col-auto">
								<i class="fas fa-fw fa-users fa-2x text-gray-300"></i>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xl-6 col-md-6 mb-4">
				<div class="card border-left-primary shadow h-100 py-2">
					<div class="card-body ">
						<div class="row no-gutters align-items-center">
							<div class="col mr-2">
								<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Pengunjung Perpustakaan Hari ini</div>
								<div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_pengunjung_perpus_today; ?></div>
							</div>
							<div class="col-auto">
								<i class="fas fa-users fa-2x text-gray-300"></i>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="card shadow">
					<div class="card-body">
						<center>
							<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Data Klasifikasi Pengunjung Perpustakaan</div>
						</center>
						<div class="chart-pie pt-4 pb-2">
							<canvas id="chartKlasifikasi_pengunjung"></canvas>
						</div>
					</div>
				</div>
			</div>
		</div>
		<hr class="bg-primary ">
		<div class="row justify-content-center">
			<div class="col-xl col-md mb-4">
				<div class="card border-left-primary shadow h-100 py-2">
					<div class="card-body">
						<div class="row no-gutters align-items-center">
							<div class="col mr-2">
								<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Anggota Perpustakaan (Pemda)</div>
								<div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_anggota; ?></div>
							</div>
							<div class="col-auto">
								<i class="fas fa-fw fa-user-tag fa-2x text-gray-300"></i>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row justify-content-center">
			<div class="col-md">
				<div class="card shadow">
					<div class="card-body">
						<center>
							<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Data Klasifikasi Anggota Perpustakaan (Pemda)</div>
						</center>
						<div class="chart-pie pt-4 pb-2">
							<canvas id="chartKlasifikasi"></canvas>
						</div>
					</div>
				</div>
			</div>
		</div>
		<p></p>
		<p></p>
		<hr class="bg-primary">
	<?php } else if ($user->user_role == 10) { ?>
		<div class="row">
			<div class="col-xl-6 col-md-6 mb-4">
				<div class="card border-left-primary shadow h-100 py-2">
					<div class="card-body">
						<div class="row no-gutters align-items-center">
							<div class="col mr-2">
								<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Buku</div>
								<div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_buku; ?></div>
							</div>
							<div class="col-auto">
								<i class="fas fa-fw fa-book fa-2x text-gray-300"></i>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xl-6 col-md-6 mb-4">
				<div class="card border-left-primary shadow h-100 py-2">
					<div class="card-body">
						<div class="row no-gutters align-items-center">
							<div class="col mr-2">
								<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Booking Buku Hari Ini</div>
								<div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_booking; ?></div>
							</div>
							<div class="col-auto">
								<i class="fas fa-fw fa-comments fa-2x text-gray-300"></i>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<hr class="bg-primary">
		<div class="row">
			<div class="col-xl-6 col-md-6 mb-4">
				<div class="card border-left-primary shadow h-100 py-2">
					<div class="card-body">
						<div class="row no-gutters align-items-center">
							<div class="col mr-2">
								<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Peminjaman Buku Hari Ini</div>
								<div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_pinjam; ?></div>
							</div>
							<div class="col-auto">
								<i class="fas fa-fw fa-book-reader fa-2x text-gray-300"></i>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xl-6 col-md-6 mb-4">
				<div class="card border-left-primary shadow h-100 py-2">
					<div class="card-body">
						<div class="row no-gutters align-items-center">
							<div class="col mr-2">
								<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Pengembalian Buku Hari Ini</div>
								<div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_kembali; ?></div>
							</div>
							<div class="col-auto">
								<i class="fas fa-fw fa-book-reader fa-2x text-gray-300"></i>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row mb-4 justify-content-center">
			<div class="col-md mb-4">
				<div class="card shadow">
					<div class="card-body">
						<center>
							<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Peminjaman & Pengembalian Buku</div>
						</center>
						<div class="chart-pie pt-4 pb-2">
							<canvas id="chartBuku"></canvas>
						</div>
						<div class="mt-4 text-center small">
							<span class="mr-2">
								<i class="fas fa-circle text-success"></i> Peminjaman
							</span>
							<span class="mr-2">
								<i class="fas fa-circle text-primary"></i> Pengembalian
							</span>
						</div>
					</div>
				</div>
			</div>
		</div>
		<hr class="bg-primary">
		<div class="row ">
			<div class="col-xl-6 col-md-6 mb-4">
				<div class="card border-left-primary shadow h-100 py-2">
					<div class="card-body">
						<div class="row no-gutters align-items-center">
							<div class="col mr-2">
								<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Pengunjung Perpustakaan</div>
								<div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_pengunjung_perpus; ?></div>
							</div>
							<div class="col-auto">
								<i class="fas fa-fw fa-users fa-2x text-gray-300"></i>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xl-6 col-md-6 mb-4">
				<div class="card border-left-primary shadow h-100 py-2">
					<div class="card-body ">
						<div class="row no-gutters align-items-center">
							<div class="col mr-2">
								<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Pengunjung Perpustakaan Hari ini</div>
								<div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_pengunjung_perpus_today; ?></div>
							</div>
							<div class="col-auto">
								<i class="fas fa-users fa-2x text-gray-300"></i>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="card shadow">
					<div class="card-body">
						<center>
							<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Data Klasifikasi Pengunjung Perpustakaan</div>
						</center>
						<div class="chart-pie pt-4 pb-2">
							<canvas id="chartKlasifikasi_pengunjung"></canvas>
						</div>
					</div>
				</div>
			</div>
		</div>
		<hr class="bg-primary ">
		<div class="row justify-content-center">
			<div class="col-xl col-md mb-4">
				<div class="card border-left-primary shadow h-100 py-2">
					<div class="card-body">
						<div class="row no-gutters align-items-center">
							<div class="col mr-2">
								<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Anggota Perpustakaan (Pemda)</div>
								<div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_anggota; ?></div>
							</div>
							<div class="col-auto">
								<i class="fas fa-fw fa-user-tag fa-2x text-gray-300"></i>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row justify-content-center">
			<div class="col-md">
				<div class="card shadow">
					<div class="card-body">
						<center>
							<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Data Klasifikasi Anggota Perpustakaan (Pemda)</div>
						</center>
						<div class="chart-pie pt-4 pb-2">
							<canvas id="chartKlasifikasi"></canvas>
						</div>
					</div>
				</div>
			</div>
		</div>
		<p></p>
		<p></p>
		<hr class="bg-primary">
		<div class="row">
			<div class="col-xl-6 col-md-6 mb-4">
				<div class="card border-left-primary shadow h-100 py-2">
					<div class="card-body">
						<div class="row no-gutters align-items-center">
							<div class="col mr-2">
								<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Pengunjung Website Tahun Ini</div>
								<div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_pengunjung_website; ?></div>
							</div>
							<div class="col-auto">
								<i class="fas fa-chalkboard-teacher fa-2x text-gray-300"></i>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xl-6 col-md-6 mb-4">
				<div class="card border-left-primary shadow h-100 py-2">
					<div class="card-body">
						<div class="row no-gutters align-items-center">
							<div class="col mr-2">
								<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Pengunjung Website Hari ini</div>
								<div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_pengunjung_website_today; ?></div>
							</div>
							<div class="col-auto">
								<i class="fas fa-chalkboard-teacher fa-2x text-gray-300"></i>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<hr class="bg-primary">
		<div class="row">
			<div class="col-xl-6 col-md-6 mb-4">
				<div class="card border-left-primary shadow h-100 py-2">
					<div class="card-body">
						<div class="row no-gutters align-items-center">
							<div class="col mr-2">
								<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Login User Tahun Ini</div>
								<div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_log; ?></div>
							</div>
							<div class="col-auto">
								<i class="fas fa-fw fa-sign-in-alt fa-2x text-gray-300"></i>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xl-6 col-md-6 mb-4">
				<div class="card border-left-primary shadow h-100 py-2">
					<div class="card-body">
						<div class="row no-gutters align-items-center">
							<div class="col mr-2">
								<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Log User Hari Ini</div>
								<div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_log_today; ?></div>
							</div>
							<div class="col-auto">
								<i class="fas fa-fw fa-sign-in-alt fa-2x text-gray-300"></i>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<hr class="bg-primary">
		<div class="row">
			<div class="col-xl-6 col-md-6 mb-4">
				<div class="card border-left-primary shadow h-100 py-2">
					<div class="card-body">
						<div class="row no-gutters align-items-center">
							<div class="col mr-2">
								<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Kebutuhan Pemustaka</div>
								<div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_kebutuhanpemustaka; ?></div>
							</div>
							<div class="col-auto">
								<i class="fas fa-fw fa-solid fa-envelope fa-2x text-gray-300"></i>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xl-6 col-md-6 mb-4">
				<div class="card border-left-primary shadow h-100 py-2">
					<div class="card-body">
						<div class="row no-gutters align-items-center">
							<div class="col mr-2">
								<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Pengadaan Buku</div>
								<div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_pengadaan; ?></div>
							</div>
							<div class="col-auto">
								<i class="fas fa-fw fa-solid fa-envelope-open-text fa-2x text-gray-300"></i>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<hr class="bg-primary">
	<?php } else if ($user->user_role == 4) { ?>
		<div class="row">
			<div class="col-xl-4 col-md-6 mb-4">
				<div class="card border-left-primary shadow h-100 py-2">
					<div class="card-body">
						<div class="row no-gutters align-items-center">
							<div class="col mr-2">
								<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Rak Sirkulasi Tahun Ini</div>
								<div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_rak_sirkulasi_tahunIni; ?></div>
							</div>
							<div class="col-auto">
								<i class="fas fa-fw fa-server fa-2x text-gray-300"></i>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xl-4 col-md-6 mb-4">
				<div class="card border-left-primary shadow h-100 py-2">
					<div class="card-body">
						<div class="row no-gutters align-items-center">
							<div class="col mr-2">
								<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Rak Referensi Tahun Ini</div>
								<div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_rak_referensi_tahunIni; ?></div>
							</div>
							<div class="col-auto">
								<i class="fas fa-fw fa-server fa-2x text-gray-300"></i>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xl-4 col-md-6 mb-4">
				<div class="card border-left-primary shadow h-100 py-2">
					<div class="card-body">
						<div class="row no-gutters align-items-center">
							<div class="col mr-2">
								<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Rak Terbitan Tahun Ini</div>
								<div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_rak_terbitan_tahunIni; ?></div>
							</div>
							<div class="col-auto">
								<i class="fas fa-fw fa-server fa-2x text-gray-300"></i>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<hr class="bg-primary">
		<div class="row">
			<div class="col-xl-4 col-md-6 mb-4">
				<div class="card border-left-primary shadow h-100 py-2">
					<div class="card-body">
						<div class="row no-gutters align-items-center">
							<div class="col mr-2">
								<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Koleksi Umum Tahun Ini</div>
								<div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_koleksi_umum_tahunIni ?></div>
							</div>
							<div class="col-auto">
								<i class="fas fa-fw fa-book fa-2x text-gray-300"></i>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xl-4 col-md-6 mb-4">
				<div class="card border-left-primary shadow h-100 py-2">
					<div class="card-body">
						<div class="row no-gutters align-items-center">
							<div class="col mr-2">
								<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Koleksi Referensi Tahun Ini</div>
								<div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_koleksi_referensi_tahunIni ?></div>
							</div>
							<div class="col-auto">
								<i class="fas fa-fw fa-book fa-2x text-gray-300"></i>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xl-4 col-md-6 mb-4">
				<div class="card border-left-primary shadow h-100 py-2">
					<div class="card-body">
						<div class="row no-gutters align-items-center">
							<div class="col mr-2">
								<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Koleksi Terbitan Tahun Ini</div>
								<div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_koleksi_terbitan_tahunIni ?></div>
							</div>
							<div class="col-auto">
								<i class="fas fa-fw fa-book fa-2x text-gray-300"></i>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<hr class="bg-primary">
		<div class="row">
			<div class="col-xl-4 col-md-6 mb-4">
				<div class="card border-left-primary shadow h-100 py-2">
					<div class="card-body">
						<div class="row no-gutters align-items-center">
							<div class="col mr-2">
								<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Anggota (Guru) Tahun Ini</div>
								<div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_person_anggota_guru_tahunIni; ?></div>
							</div>
							<div class="col-auto">
								<i class="fas fa-fw fa-user-tag fa-2x text-gray-300"></i>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xl-4 col-md-6 mb-4">
				<div class="card border-left-primary shadow h-100 py-2">
					<div class="card-body">
						<div class="row no-gutters align-items-center">
							<div class="col mr-2">
								<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Pemustaka (Guru) Tahun Ini</div>
								<div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_person_pemustaka_guru_tahunIni; ?></div>
							</div>
							<div class="col-auto">
								<i class="fas fa-fw fa-user-tie fa-2x text-gray-300"></i>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xl-4 col-md-6 mb-4">
				<div class="card border-left-primary shadow h-100 py-2">
					<div class="card-body">
						<div class="row no-gutters align-items-center">
							<div class="col mr-2">
								<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Pengunjung (Guru) Tahun Ini</div>
								<div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_person_pengunjung_guru_tahunIni; ?></div>
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
				<div class="card border-left-primary shadow h-100 py-2">
					<div class="card-body">
						<div class="row no-gutters align-items-center">
							<div class="col mr-2">
								<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Anggota (Siswa) Tahun Ini</div>
								<div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_person_anggota_siswa_tahunIni; ?></div>
							</div>
							<div class="col-auto">
								<i class="fas fa-fw fa-user-tag fa-2x text-gray-300"></i>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xl-4 col-md-6 mb-4">
				<div class="card border-left-primary shadow h-100 py-2">
					<div class="card-body">
						<div class="row no-gutters align-items-center">
							<div class="col mr-2">
								<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Pemustaka (Siswa) Tahun Ini</div>
								<div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_person_pemustaka_siswa_tahunIni; ?></div>
							</div>
							<div class="col-auto">
								<i class="fas fa-fw fa-user-tie fa-2x text-gray-300"></i>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xl-4 col-md-6 mb-4">
				<div class="card border-left-primary shadow h-100 py-2">
					<div class="card-body">
						<div class="row no-gutters align-items-center">
							<div class="col mr-2">
								<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Pengunjung (Siswa) Tahun Ini</div>
								<div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_person_pengunjung_siswa_tahunIni; ?></div>
							</div>
							<div class="col-auto">
								<i class="fas fa-fw fa-users fa-2x text-gray-300"></i>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<hr class="bg-primary">
	<?php } ?>
</div>

<script src="<?= base_url('vendor/vendor/chart.js/Chart.min.js'); ?>"></script>
<script>
	// Set new default font family and font color to mimic Bootstrap's default styling
	Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
	Chart.defaults.global.defaultFontColor = '#858796';


	var klasifikasi = <?php echo json_encode($klasifikasi); ?>;
	var jumlahKlasifikasi = <?php echo json_encode($jumlah_klasifikasi) ?>;
	var warnaKlasifikasi = [];
	var r, g, b;
	for (i = 0; i < klasifikasi.length; i++) {
		r = Math.round(Math.random() * 200 + 1);
		g = Math.round(Math.random() * 200 + 1);
		b = Math.round(Math.random() * 200 + 1);
		warnaKlasifikasi.push("rgb(" + r + ", " + g + ", " + b + ")");
	}
	var chartKlasifikasi = document.getElementById("chartKlasifikasi");
	var barChart = new Chart(chartKlasifikasi, {
		type: 'bar',
		data: {
			labels: klasifikasi,
			datasets: [{
				data: jumlahKlasifikasi,
				backgroundColor: warnaKlasifikasi,
				label: 'Jumlah'
			}],
		},
		options: {
			maintainAspectRatio: false,
			tooltips: {
				backgroundColor: "rgb(255,255,255)",
				bodyFontColor: "#858796",
				borderColor: 'rgb(255,255,255)',
				borderWidth: 1,
				titleFontColor: 'black',
				xPadding: 15,
				yPadding: 15,
				displayColors: true,
				caretPadding: 10
			},
			legend: {
				display: false,
				labels: {
					fontColor: 'black'
				}
			},
			cutoutPercentage: 100,
			scales: {
				yAxes: [{
					ticks: {
						beginAtZero: true
					}
				}]
			}
		}
	});


	var klasifikasi_pengunjung = <?php echo json_encode($klasifikasi_pengunjung); ?>;
	var jumlahKlasifikasi_pengunjung = <?php echo json_encode($jumlah_klasifikasi_pengunjung) ?>;
	var warnaKlasifikasi_pengunjung = [];
	var r, g, b;
	for (i = 0; i < klasifikasi.length; i++) {
		r = Math.round(Math.random() * 200 + 1);
		g = Math.round(Math.random() * 200 + 1);
		b = Math.round(Math.random() * 200 + 1);
		warnaKlasifikasi_pengunjung.push("rgb(" + r + ", " + g + ", " + b + ")");
	}
	var chartKlasifikasi_pengunjung = document.getElementById("chartKlasifikasi_pengunjung");
	var barChart = new Chart(chartKlasifikasi_pengunjung, {
		type: 'bar',
		data: {
			labels: klasifikasi_pengunjung,
			datasets: [{
				data: jumlahKlasifikasi_pengunjung,
				backgroundColor: warnaKlasifikasi_pengunjung,
				label: 'Jumlah'
			}],
		},
		options: {
			maintainAspectRatio: false,
			tooltips: {
				backgroundColor: "rgb(255,255,255)",
				bodyFontColor: "#858796",
				borderColor: 'rgb(255,255,255)',
				borderWidth: 1,
				titleFontColor: 'black',
				xPadding: 15,
				yPadding: 15,
				displayColors: true,
				caretPadding: 10
			},
			legend: {
				display: false,
				labels: {
					fontColor: 'black'
				}
			},
			cutoutPercentage: 100,
			scales: {
				yAxes: [{
					ticks: {
						beginAtZero: true
					}
				}]
			}
		}
	});


	var perbandinganBuku = <?php echo json_encode($perbandingan_buku); ?>;
	var ctx = document.getElementById("chartBuku");
	var myPieChart = new Chart(ctx, {
		type: 'doughnut',
		data: {
			labels: ["Peminjaman", "Pengembalian"],
			datasets: [{
				data: perbandinganBuku,
				backgroundColor: ['#1cc88a', '#4e73df'],
				hoverBackgroundColor: ['#17a673', '#2e59d9'],
				hoverBorderColor: "rgba(234, 236, 244, 1)",
			}],
		},
		options: {
			maintainAspectRatio: false,
			tooltips: {
				backgroundColor: "rgb(255,255,255)",
				bodyFontColor: "#858796",
				borderColor: '#dddfeb',
				borderWidth: 1,
				xPadding: 15,
				yPadding: 15,
				displayColors: false,
				caretPadding: 10,
			},
			legend: {
				display: false
			},
			cutoutPercentage: 80,
		},
	});
</script>
