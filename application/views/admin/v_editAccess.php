<?= $this->session->flashdata('pesan'); ?>
<div class="container-fluid">
  <div class="row">
    <div class="col-md-6">
      <div class="card">
        <div class="card-body">
          <?= form_open('validation_access_edit'); ?>
            <div class="form-group">
              <label>Menu judul</label>
              <input type="hidden" name="access_id" value="<?= $access_item->access_id; ?>">
              <select name="menu_id" class="form-control" required>
                <?php foreach($list_menu as $item) { ?>
                  <option <?php if($item->menu_id == $access_item->menu_id ){ echo "selected"; } ?> value="<?= $item->menu_id ?>"><?= $item->menu_judul; ?></option>
                <?php } ?>
              </select>
              <?= form_error('menu','<small class="text-danger">','</small>') ?>              
            </div>
            <div class="form-group">
              <label>Role</label>
              <select name="role_id" class="form-control" required>
								<option <?php if($access_item->role_id == 1 ) { echo 'selected'; } ?>  value="1">Admin</option>
								<option <?php if($access_item->role_id == 2 ) { echo 'selected'; } ?> value="2">Petugas Perpustakaan (Pemda)</option>
								<option <?php if($access_item->role_id == 4 ) { echo 'selected'; } ?> value="4">Petugas Perpustakaan (Sekolah)</option>
								<option <?php if($access_item->role_id == 6 ) { echo 'selected'; } ?> value="6">Kepala Perpustakaan (Pemda)</option>
								<option <?php if($access_item->role_id == 7 ) { echo 'selected'; } ?> value="7">Kelompok Pustakawan (Pemda)</option>
								<option <?php if($access_item->role_id == 8 ) { echo 'selected'; } ?> value="8">Layanan Pemustaka (Pemda)</option>
								<option <?php if($access_item->role_id == 9 ) { echo 'selected'; } ?> value="9">Layanan Teknis (Pemda)</option>
								<option <?php if($access_item->role_id == 10 ) { echo 'selected'; } ?> value="10">Layanan TIK (Pemda)</option>
              </select>
            </div>
            <a href="<?= base_url("menu") ?>" class="btn btn-info btn-sm mb"><i class="fas fa-chevron-left"></i> Kembali</a>
            <button type="reset" class="btn btn-danger btn-sm"><i class="fa fa-sync"></i> Reset</button>
            <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-save"></i> Simpan</button>
          <?= form_close(); ?>
        </div>
      </div>
    </div>
  </div>
</div>
