<?= $this->session->flashdata('pesan'); ?>
<div class="container-fluid">
	<h4>Edit <?= $title; ?></h4>
	<div class="card mb-4">
		<div class="card-body">
			<?= form_open_multipart("validation_pengadaan_edit"); ?>
			<div class="row">
				<div class="col-md">
					<input type="hidden" name="pengadaan_id" value="<?= $pengadaan->pengadaan_id; ?>">
					<label> Judul :</label>
					<div class="form-group">
						<input type="text" name="pengadaan_judul" class="form-control" value="<?= $pengadaan->pengadaan_judul; ?>" required>
					</div>
					<label>Pengarang :</label>
					<div class="form-group">
						<input type="text" name="pengadaan_pengarang" class="form-control" value="<?= $pengadaan->pengadaan_pengarang; ?>" required>
					</div>
					<label>Penerbit :</label>
					<div class="form-group">
						<input type="text" name="pengadaan_penerbit" class="form-control" value="<?= $pengadaan->pengadaan_penerbit; ?>" required>
					</div>
				</div>
			</div>
			<a href="<?= base_url("pengadaan") ?>" class="btn btn-info btn-sm mb"><i class="fas fa-chevron-left"></i> Kembali</a>
			<button type="reset" class="btn btn-danger btn-sm"><i class="fa fa-sync"></i> Reset</button>
			<button type="submit" class="btn btn-success btn-sm"><i class="fa fa-save"></i> Simpan</button>
			<?= form_close(); ?>
		</div>
	</div>
</div>
