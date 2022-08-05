<div class="container-fluid">
	<div class="card">
		<div class="card-body">
			<center>
				<?= form_open('validation_denda_edit'); ?>
				<div class="form-group">
					<label>Harga Denda</label>
					<input type="number" name="denda" value="<?= $denda->denda_harga; ?>" class="form-control text-center">
					<?= form_error('denda', '<small class="text-danger">', '<small>'); ?>
				</div>
				<input style="display: inline;" type="submit" value="Simpan" class="btn btn-success btn-user btn-block">
				<?= form_close(); ?>
			</center>
		</div>
	</div>
</div>
