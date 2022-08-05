<?= $this->session->flashdata('pesan'); ?>
<div class="container-fluid">
  <div class="row">
    <div class="col-md-4">
      <div class="card">
        <div class="card-body">
          <?= form_open('updateKategori'); ?>
            <div class="form-group">
              <label>Kategori judul</label>
              <input type="hidden" name="id" value="<?= $k->kategori_id; ?>">
              <input type="text" name="kategori" class="form-control" value="<?= $k->kategori_judul; ?>" required>
              <?= form_error('menu','<small class="text-danger">','</small>') ?>              
            </div>
            <input type="submit" value="Simpan" class="btn btn-success btn-sm">
          </form>
        </div>
      </div>
    </div>
  </div>
</div>