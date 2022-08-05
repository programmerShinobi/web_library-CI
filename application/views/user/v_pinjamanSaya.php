<?php
echo $this->session->flashdata('pesan');

date_default_timezone_set('Asia/Jakarta');

$hariIni = date('D', strtotime('+7days'));
if ($hariIni == "Sun") {
	$hari = 'Minggu';
} else if ($hariIni == "Mon") {
	$hari = 'Senin';
} else if ($hariIni == "Tue") {
	$hari = 'Selasa';
} else if ($hariIni == "Wed") {
	$hari = 'Rabu';
} else if ($hariIni == "Thu") {
	$hari = 'Kamis';
} else if ($hariIni == "Fri") {
	$hari = 'Jumat';
} else if ($hariIni == "Sat") {
	$hari = 'Sabtu';
}

$bulanIni = date('m', strtotime('+7days'));
if ($bulanIni == "01") {
	$bulan = 'Januari';
} else if ($bulanIni == "02") {
	$bulan = 'Februari';
} else if ($bulanIni == "03") {
	$bulan = 'Maret';
} else if ($bulanIni == "04") {
	$bulan = 'April';
} else if ($bulanIni == "05") {
	$bulan = 'Mei';
} else if ($bulanIni == "06") {
	$bulan = 'Juni';
} else if ($bulanIni == "07") {
	$bulan = 'Juli';
} else if ($bulanIni == "08") {
	$bulan = 'Agustus';
} else if ($bulanIni == "09") {
	$bulan = 'September';
} else if ($bulanIni == "10") {
	$bulan = 'Oktober';
} else if ($bulanIni == "11") {
	$bulan = 'November';
} else if ($bulanIni == "12") {
	$bulan = 'Desember';
}
?>
<div class="container konten">
	<div class="card-body shadow-lg my-5" data-aos="fade-left" data-aos-duration="1000">
		<h4 class="text-center"><?= $title; ?></h4>
		<hr>
		<div class="table-responsive">
			<table class="table table-hover text-dark" id="dataV">
				<thead>
					<tr>
						<!--<th>#</th>-->
						<th>Buku</th>
						<th>Penerbit</th>
						<th>Tahun&nbsp;Terbit</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>
					<?php $no = 1;
					foreach ($list_cart as $item) : ?>
						<tr>
							<!--<td><?= $no++; ?></td>-->
							<td><?= $item->buku_judul; ?></td>
							<td><?= $item->buku_penerbit; ?></td>
							<td><?= $item->buku_tahunTerbit; ?></td>
							<td>
								<a href="<?= base_url('process_cart_delete/' . $item->cart_id); ?>" class="btn btn-danger btn-sm">Hapus</a>
								<p></p>
							</td>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		</div>
		<?php if ($no > 1) { ?>
			<hr>
			<center>
				<?= form_open('process_cart'); ?>
				<div class="form-group">
					<h6 class="text-primary"><b>Batas Waktu Pengembalian Buku Hari <?= $hari . ", Tanggal&nbsp;" . date('j', strtotime('+7days')) . "&nbsp;" . $bulan . " &nbsp;" . date('Y', strtotime('+7days')); ?></b></h6>
					<h6 class="text-primary"><b>Yakin ingin booking buku di atas ?</b></label>
						<input type="text" name="dikembalikan" value="<?= date('Y-m-d', strtotime('+7days')); ?>" class="form-control text-center" hidden>
				</div>
				<input type="submit" value=">> Booking <<" class="btn btn-primary shadow btn-sm">
				<?= form_close(); ?>
			<center>
		<?php } ?>
	</div>
</div>
