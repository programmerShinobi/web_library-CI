<?= $this->session->flashdata('pesan'); ?>
<div class="container-fluid">
<h4><?= $title; ?></h4>
  <div class="card">
    <div class="card-header">
    <b><?=$sarana->sekolah_nama?></b><hr>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <a class="text-danger" href="<?= base_url("perpus_check/".$sarana->sekolah_id."#saranaTab")?>">&times;</a>
      </button>
      <h4 class="card-title"><b>Form</b> | Edit Data Sarana-Prasarana</h4>
    </div>
    <div class="card-body">
      <?= form_open_multipart('edit_sarana'); ?>
        <div class="form-group">
          <label>Tahun</label>
          <input type="hidden" name="sekolah_id" class="form-control" value="<?= $sarana->sekolah_id;?>" >
          <input type="hidden" name="sarana_id" class="form-control" value="<?= $sarana->sarana_id;?>" >
          <input type="number" name="sarana_pertahun" class="form-control" value="<?= $sarana->sarana_pertahun; ?>" >
          <?= form_error('sarana_pertahun','<small class="text-danger" ><b>','</b></small>') ?>
        </div>
        <div class="form-group">
          <label>Luas Gedung (m<sup>2</sup>)</label>
          <input type="number" name="sarana_luasGedung" class="form-control" value="<?= $sarana->sarana_luasGedung; ?>" >
          <?= form_error('sarana_luasGedung','<small class="text-danger" ><b>','</b></small>') ?>
        </div>
        <div class="form-group">
          <label>Jumlah Rak Sirkulasi</label>
          <input type="number" name="sarana_jumlahRakSirkulasi" class="form-control" value="<?= $sarana->sarana_jumlahRakSirkulasi; ?>" >
          <?= form_error('sarana_jumlahRakSirkulasi','<small class="text-danger" ><b>','</b></small>') ?>
        </div>
        <div class="form-group">
          <label>Jumlah Rak Referensi</label>
          <input type="number" name="sarana_jumlahRakReferensi" class="form-control" value="<?= $sarana->sarana_jumlahRakReferensi; ?>" >
          <?= form_error('sarana_jumlahRakReferensi','<small class="text-danger" ><b>','</b></small>') ?>
        </div>
        <div class="form-group">
          <label>Jumlah Rak Terbitan</label>
          <input type="number" name="sarana_jumlahRakTerbitan" class="form-control" value="<?= $sarana->sarana_jumlahRakTerbitan; ?>" >
          <?= form_error('sarana_jumlahRakTerbitan','<small class="text-danger" ><b>','</b></small>') ?>
        </div>
        <a href="<?= base_url("perpus_check/".$sarana->sekolah_id."#saranaTab") ?>" class="btn btn-info btn-sm"><i class="fas fa-chevron-left"></i> Kembali</a>
        <button type="reset" class="btn btn-danger btn-sm"><i class="fa fa-sync"></i> Reset</button>
        <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-save"></i> Simpan</button>
      <?= form_close(); ?>
    </div>
  </div>
</div>