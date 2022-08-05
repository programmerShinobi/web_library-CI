<?= $this->session->flashdata('pesan'); ?>
<div class="container-fluid">
  <h4>Data Penerbit</h4>
  <div class="row">
    <div class="col-md-6">
      <div class="card">
        <div class="card-body">
          <a href="" data-toggle="modal" data-target="#add" class="btn btn-primary btn-sm mb-3">Tambah Penerbit</a>
          <div class="table-responsive">
            <table class="table table-bordered table-hover" id="dataVisibility">
              <thead>
                <tr>
                  <th width="1%">#</th>
                  <th>Penerbit</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php $no=1; foreach($penerbit as $p){ ?>
                <tr>
                  <td><?= $no++; ?></td>
                  <td><?= $p->penerbit_judul; ?></td>
                  <td>
                    <a href="<?= base_url('editPenerbit/'.$p->penerbit_id); ?>" class="btn btn-info btn-sm">Edit</a>
                    <a href="<?= base_url('hapusPenerbit/'.$p->penerbit_id); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin menghapus data?')">Hapus</a>
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
        <h5>Tambah Menu</h5>
        <button type="button" data-dismiss="modal" class="close">&times;</button>
      </div>
      <div class="modal-body">
        <?= form_open('addPenerbit'); ?>
        <div class="form-group">
          <label>Penerbit</label>
          <input type="text" name="penerbit" class="form-control" required>
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