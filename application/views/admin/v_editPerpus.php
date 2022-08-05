<?= $this->session->flashdata('pesan'); ?>
<div class="container-fluid">
<h4><?= $title; ?></h4>
  <div class="card">
    <div class="card-header">
      <b><?=$perpus->sekolah_nama?></b><hr>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <a class="text-danger" href="<?= base_url("perpus_check/".$perpus->sekolah_id) ?>">&times;</a>
      </button>
      <h4 class="card-title"><b>Form</b> | Edit Data Perpustakaan</h4>
    </div>
    <div class="card-body">
      <?= form_open_multipart('edit_perpus'); ?>
        <div class="form-group">
          <label>Tahun</label>
          <input type="hidden" name="sekolah_id" class="form-control" value="<?= $perpus->sekolah_id;?>" >
          <input type="hidden" name="perpus_id" class="form-control" value="<?= $perpus->perpus_id;?>" >
          <input type="number" name="perpus_pertahun" class="form-control" value="<?= $perpus->perpus_pertahun; ?>" >
          <?= form_error('perpus_pertahun','<small class="text-danger" ><b>','</b></small>') ?>
        </div>
        <div class="form-group">
          <label>Nama Pengelola</label>
          <input type="text" name="perpus_namaPengelola" class="form-control" value="<?= $perpus->perpus_namaPengelola; ?>" >
          <?= form_error('perpus_namaPengelola','<small class="text-danger" ><b>','</b></small>') ?>
        </div>
        <div class="form-group">
          <label>Kontak Pengelola</label>
          <input type="number" name="perpus_kontakPengelola" class="form-control" value="<?= $perpus->perpus_kontakPengelola; ?>" >
          <?= form_error('perpus_kontakPengelola','<small class="text-danger" ><b>','</b></small>') ?>
        </div>
        <div class="form-group">
          <label>Nama Sekretaris</label>
          <input type="text" name="perpus_namaSekretaris" class="form-control" value="<?= $perpus->perpus_namaSekretaris; ?>" >
          <?= form_error('perpus_namaSekretaris','<small class="text-danger" ><b>','</b></small>') ?>
        </div>
        <div class="form-group">
          <label>Nama Petugas</label>
          <input type="text" name="perpus_namaPetugas" class="form-control" value="<?= $perpus->perpus_namaPetugas; ?>" >
          <?= form_error('perpus_namaPetugas','<small class="text-danger" ><b>','</b></small>') ?>
        </div>
        <a href="<?= base_url("perpus_check/".$perpus->sekolah_id) ?>" class="btn btn-info btn-sm"><i class="fas fa-chevron-left"></i> Kembali</a>
        <button type="reset" class="btn btn-danger btn-sm"><i class="fa fa-sync"></i> Reset</button>
        <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-save"></i> Simpan</button>
      <?= form_close(); ?>
    </div>
  </div>
</div>