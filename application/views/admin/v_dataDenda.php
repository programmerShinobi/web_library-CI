<?= $this->session->flashdata('pesan'); ?>
<div class="container-fluid">
	<div class="card">
		<div class="card-body">
			<h4><?=$title;?></h4>
			<table class="table table-bordered table-hover">
				<thead>
					<tr>
						<th>Harga Denda</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>Rp. <?= number_format($list_denda->denda_harga, '0', ',', '.'); ?></td>
						<td>
							<div class="form-group card ">
								<a href="<?= base_url('denda_edit'); ?>" class="btn btn-light btn-sm"><i class="fa fa-edit"></i> Edit</a>
							</div>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
