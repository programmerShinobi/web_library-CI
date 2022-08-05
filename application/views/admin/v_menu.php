<?= $this->session->flashdata('pesan'); ?>
<div class="container-fluid">
	<h3>Menu Management</h3>
	<div class="card">
		<div class="card-header">
			<ul class="nav nav-pills" role="tablist">
				<li class="nav-item border border-primary rounded m-1">
					<a class="nav-link active" data-toggle="pill" href="#menuMan"><i class="fas fa-store-alt"></i> Menu Management</a>
				</li>
				<li class="nav-item border border-primary rounded m-1">
					<a class="nav-link" data-toggle="pill" href="#accessMan"><i class="fas fa-book-reader"></i> Access Management</a>
				</li>
			</ul>
		</div>
		<div class="card-body">
			<div class="tab-content">
				<div id="menuMan" class="tab-pane active">
					<b><?= "Menu Management" ?></b>
					<hr>
					<a href="" class="btn btn-success btn-sm mb-3" data-toggle="modal" data-target="#add"><i class="fa fa-plus"></i> Tambah Menu</a>
					<div class="table-responsive">
						<table class="table table-bordered table-hover mb-5" id="dataMenu">
							<thead>
								<tr>
									<th class="text-center">No</th>
									<th class="text-center">Menu</th>
									<th class="text-center">Aksi</th>
								</tr>
							</thead>
							<tbody id="listMenu">
								<?php $no = 1;
								foreach ($list_menu as $item) { ?>
									<tr>
										<td class="text-center"><?= $no++; ?></td>
										<td class="text-center"><?= $item->menu_judul; ?></td>
										<td class="text-center">
											<div class="form-group card ">
												<a href="<?= base_url('view_menu_edit/' . $item->menu_id); ?>" class="btn btn-light btn-sm"><i class="fa fa-edit"></i> Edit</a>
											</div>
											<div class="form-group card ">
												<a href="<?= base_url('process_menu_delete/' . $item->menu_id); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin menghapus data?')"><i class="fa fa-trash"></i> Hapus</a>
											</div>
										</td>
									</tr>
								<?php } ?>
							</tbody>
						</table>
					</div>
				</div>
				<div id="accessMan" class="tab-pane fade">
					<b><?= "Access Management" ?></b>
					<hr>
					<a href="" class="btn btn-success btn-sm mb-3" data-toggle="modal" data-target="#addAcc"><i class="fa fa-plus"></i> Tambah Menu Access</a>
					<div class="table-responsive">
						<table class="table table-bordered table-hover" id="dataAccessMenu">
							<thead>
								<tr>
									<th class="text-center" width="1%">No.</th>
									<th class="text-center">Menu</th>
									<th class="text-center">Role</th>
									<th class="text-center">Aksi</th>
								</tr>
							</thead>
							<tbody id="listAccess">
								<?php $no = 1;
								foreach ($list_access as $item) { ?>
									<tr>
										<td class="text-center"><?= $no++; ?></td>
										<td class="text-center"><?= $item->menu_judul; ?></td>
										<td class="text-center">
											<?php
											if ($item->role_id == 1) {
												echo 'Admin';
											} elseif ($item->role_id == 2) {
												echo 'Petugas Perpustakaan (Pemda)';
											} elseif ($item->role_id == 4) {
												echo 'Petugas Perpustakaan (Sekolah)';
											} elseif ($item->role_id == 6) {
												echo 'Kepala Perpustakaan (Pemda)';
											} elseif ($item->role_id == 7) {
												echo 'Kelompok Pustakawan (Pemda)';
											} elseif ($item->role_id == 8) {
												echo 'Layanan Pemustaka (Pemda)';
											} elseif ($item->role_id == 9) {
												echo 'Layanan Teknis (Pemda)';
											} elseif ($item->role_id == 10) {
												echo 'Layanan TIK (Pemda)';
											}
											?>
										</td>
										<td>
											<div class="form-group card ">
												<a href="<?= base_url('access_edit/' . $item->access_id); ?>" class="btn btn-light btn-sm"><i class="fa fa-edit"></i> Edit</a>
											</div>
											<div class="form-group card ">
												<a href="<?= base_url('access_delete/' . $item->access_id); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin menghapus data?')"><i class="fa fa-trash"></i> Hapus</a>
											</div>
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
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5>Tambah Menu</h5>
				<button type="button" data-dismiss="modal" class="close">&times;</button>
			</div>
			<div class="modal-body">
				<?= form_open('menu'); ?>
				<div class="form-group">
					<?= form_label('Menu') ?>
					<?= form_input("menu_judul", "", "class='form-control' required"); ?>
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

<div class="modal fade" id="addAcc">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5>Tambah Access</h5>
				<button type="button" data-dismiss="modal" class="close">&times;</button>
			</div>
			<div class="modal-body">
				<?= form_open('access_add'); ?>
				<div class="form-group">
					<label>Menu</label>
					<select name="menu_id" class="form-control" required>
						<option disabled selected>-- Pilih Menu --</option>
						<?php foreach ($list_menu as $item) { ?>
							<option value="<?= $item->menu_id; ?>"><?= $item->menu_judul; ?></option>
						<?php } ?>
					</select>
				</div>
				<div class="form-group">
					<label>Role</label>
					<select class="form-control" name="role_id" required>
						<option disabled selected>-- Pilih Role --</option>
						<option value="1">Admin</option>
						<option value="2">Petugas Perpustakaan (Pemda)</option>
						<option value="4">Petugas Perpustakaan (Sekolah)</option>
						<option value="6">Kepala Perpustakaan (Pemda)</option>
						<option value="7">Kelompok Pustakawan (Pemda)</option>
						<option value="8">Layanan Pemustaka (Pemda)</option>
						<option value="9">Layanan Teknis (Pemda)</option>
						<option value="10">Layanan TIK (Pemda)</option>
					</select>
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
