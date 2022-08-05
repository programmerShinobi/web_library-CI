<?= $this->session->flashdata('pesan'); ?>
<div class="container-fluid">
	<h4>Denda Peminjaman Buku</h4>
	<div class="row">
		<div class="col-md-8">
			<div class="card">
				<div class="card-body">
					<?= form_open('validation_peminjaman_denda'); ?>
					<div class="form-group">
						<label>Nama</label>
						<input type="text" name="" class="form-control" value="<?= $peminjaman->user_nama; ?>" readonly>
					</div>
					<div class="form-group">
						<label>Buku</label>
						<input type="text" name="" class="form-control" value="<?= $peminjaman->buku_judul;; ?>" readonly>
					</div>
					<div class="form-group">
						<label>Jumlah Peminjaman</label>
						<input type="hidden" name="peminjaman_id" value="<?= $peminjaman->peminjaman_id; ?>">
						<input type="number" name="peminjaman_jumlah" class="form-control" value="<?= $peminjaman->peminjaman_jumlah; ?>" readonly>
					</div>
					<div class="form-group">
						<label>Tanggal Peminjaman</label>
						<input type="date" name="peminjaman_dari" class="form-control" value="<?= $peminjaman->peminjaman_dari; ?>" readonly>
					</div>
					<div class="form-group">
						<label>Tanggal Pengembalian</label>
						<input type="date" name="peminjaman_sampai" class="form-control" value="<?= $peminjaman->peminjaman_sampai; ?>" readonly>
					</div>
					<div class="form-group">
						<label>Tanggal Dikembalikan</label>
						<input type="date" name="peminjaman_sampai" class="form-control" value="<?= $peminjaman->peminjaman_kembali; ?>" readonly>
					</div>
					<div class="form-group">
						<label>Jumlah Denda</label>
						<input type="text" name="peminjaman_denda" class="form-control" value="<?= "Rp. " . number_format($peminjaman->peminjaman_denda, 0, ',', '.'); ?>" readonly>
					</div>
					<div class="form-group">
						<label>Denda Yang Telah Terbayar</label>
						<input type="text" class="form-control" value="<?= "Rp. " . number_format($peminjaman->peminjaman_denda_bayar, 0, ',', '.'); ?>" readonly>
					</div>
					<?php
					$denda_now = $peminjaman->peminjaman_denda;
					$denda_new = $peminjaman->peminjaman_denda_bayar;
					if ($denda_now > $denda_new) { ?>
						<div class="form-group">
							<label>Denda Masih Kurang</label>
							<?php
							$denda_kurang = $peminjaman->peminjaman_denda - $peminjaman->peminjaman_denda_bayar;
							?>
							<input type="text" class="form-control" value="<?= "Rp. " . number_format($denda_kurang, 0, ',', '.'); ?>" readonly>
						</div>
						<div class="form-group">
							<label>Bayar Denda Sekarang</label>
							<input type="number" name="peminjaman_denda_bayar" class="form-control" placeholder="Rp. ...">
						</div>
					<?php } elseif ($denda_now < $denda_new) { ?>
						<div class="form-group">
							<label>Denda Lebih</label>
							<?php
							$denda_kurang = $peminjaman->peminjaman_denda_bayar - $peminjaman->peminjaman_denda;
							?>
							<input type="text" class="form-control" value="<?= "Rp. " . number_format($denda_kurang, 0, ',', '.'); ?>" readonly>
						</div>
						<div class="form-group">
							<label>Kembalikan Denda Lebih Sekarang</label>
							<input type="number" name="peminjaman_denda_bayar" class="form-control" placeholder="Rp. ...">
						</div>
					<?php } elseif ($denda_now == $denda_new) {echo "Pembayaran Lunas"; } ?>
					<input type="submit" value="Simpan" class="btn btn-success btn-sm">
					<?= form_close() ?>
				</div>
			</div>
		</div>
	</div>
</div>
