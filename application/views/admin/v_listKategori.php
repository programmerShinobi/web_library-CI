<?= $this->session->flashdata('pesan'); ?>
<div class="container-fluid">
	<h4>List Data Kategori</h4>
	<div class="row">
		<div class="col-md-6">
			<div class="card">
				<div class="card-body">
					<a href="" class="btn btn-primary btn-sm mb-3" data-toggle="modal" data-target="#add">Tambah Kategori</a>
					<div class="table-responsive">
						<table class="table table-bordered table-hover" id="dataVisibility">
							<thead>
								<tr>
									<th width="1%">#</th>
									<th>Kategori</th>
									<th>Aksi</th>
								</tr>
							</thead>
							<tbody>
								<?php $no = 1;
								foreach ($kategori as $k) { ?>
									<tr>
										<td><?= $no++; ?></td>
										<td><?= $k->kategori_judul; ?></td>
										<td>
											<a href="<?= base_url('editKategori/' . $k->kategori_id); ?>" class="btn btn-info btn-sm">Edit</a>
											<a href="<?= base_url('hapusKategori/' . $k->kategori_id); ?>" class="btn btn-danger btn-sm">Hapus</a>
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

<div class="modal fade" id="add">
	<div class="modal-dialog modal-dialog-scrollable">
		<div class="modal-content">
			<div class="modal-header">
				<h5>Tambah Kategori</h5>
				<button type="button" data-dismiss="modal" class="close">&times;</button>
			</div>
			<div class="modal-body">
				<?= form_open('addKategori'); ?>
				<div class="form-group">
					<label>Kategori</label>
					<input type="text" name="kategori" class="form-control">
				</div>
				<input type="submit" value="Simpan" class="btn btn-success btn-sm">
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" data-dismiss="modal" class="btn btn-danger btn-sm">Close</button>
			</div>
		</div>
	</div>
</div>