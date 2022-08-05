<?= $this->session->flashdata('pesan'); ?>
<div class="container-fluid">
	<div class="card">
		<div class="card-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<a href="<?= base_url() ?>dataSekolah">&times;</a>
			</button>
			<h4 class="card-title"><b>Form</b> | Edit Data Sekolah</h4>
		</div>
		<div class="card-body">
			<?= form_open_multipart('validation_sekolah_edit'); ?>
			<div class="form-group">
				<label>Sekolah</label>
				<input type="hidden" name="sekolah_id" class="form-control" value="<?= $sekolah_detail->sekolah_id; ?>">
				<input type="text" name="sekolah_nama" class="form-control" value="<?= $sekolah_detail->sekolah_nama; ?>">
			</div>
			<div class="form-group">
				<label>Kepala Sekolah</label>
				<input type="text" name="sekolah_namaKepala" class="form-control" value="<?= $sekolah_detail->sekolah_namaKepala; ?>">
			</div>
			<div class="form-group">
				<label>Alamat</label>
				<input name="sekolah_alamat" class="form-control" value="<?= $sekolah_detail->sekolah_alamat; ?>">
			</div>
			<a href="<?= base_url("dataSekolah") ?>" class="btn btn-info btn-sm mb"><i class="fas fa-chevron-left"></i> Kembali</a>
			<button type="reset" class="btn btn-danger btn-sm"><i class="fa fa-sync"></i> Reset</button>
			<button type="submit" class="btn btn-success btn-sm"><i class="fa fa-save"></i> Simpan</button>
			<?= form_close(); ?>
		</div>
	</div>
</div>
