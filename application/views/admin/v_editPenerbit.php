<?= $this->session->flashdata('pesan'); ?>
<div class="container-fluid">
  <h4>Edit Penerbit</h4>
  <div class="row">
    <div class="col-md-5">
      <div class="card">
        <div class="card-body">
          <?= form_open('updatePenerbit'); ?>
          <div class="form-group">
            <label>Penerbit</label>
            <input type="hidden" name="id" value="<?= $p->penerbit_id; ?>">
            <input type="text" name="penerbit" class="form-control" value="<?= $p->penerbit_judul; ?>" required>
          </div>
          <input type="submit" value="Simpan" class="btn btn-success btn-sm">
          <?= form_close(); ?>
        </div>
      </div>
    </div>
  </div>
</div>