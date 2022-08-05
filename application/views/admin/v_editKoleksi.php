<?= $this->session->flashdata('pesan'); ?>
<div class="container-fluid">
<h4><?= $title; ?></h4>
  <div class="card">
    <div class="card-header">
    <b><?=$koleksi->sekolah_nama?></b><hr>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <a class="text-danger" href="<?= base_url("perpus_check/".$koleksi->sekolah_id."#koleksiTab")?>">&times;</a>
      </button>
      <h4 class="card-title"><b>Form</b> | Edit Data Koleksi Perpustakaan</h4>
    </div>
    <div class="card-body">
      <?= form_open_multipart('edit_koleksi'); ?>
        <div class="form-group">
          <label>Tahun</label>
          <input type="hidden" name="sekolah_id" class="form-control" value="<?= $koleksi->sekolah_id;?>" >
          <input type="hidden" name="koleksi_id" class="form-control" value="<?= $koleksi->koleksi_id;?>" >
          <input type="number" name="koleksi_pertahun" class="form-control" value="<?= $koleksi->koleksi_pertahun; ?>" >
          <?= form_error('koleksi_pertahun','<small class="text-danger" ><b>','</b></small>') ?>
        </div>
        <div class="form-group">
            <label>Kriteria</label>
            <select class="form-control" id="koleksi_kriteria" name="koleksi_kriteria" >
                <option disabled>-- Pilih Kriteria --</option>
                <option <?php if($koleksi->koleksi_kriteria == "umum"){ echo "selected"; }?> value="umum">Umum</option>  
                <option <?php if($koleksi->koleksi_kriteria == "referensi"){ echo "selected"; }?> value="referensi">Referensi</option>
                <option <?php if($koleksi->koleksi_kriteria == "terbitan_berkala"){ echo "selected"; }?> value="terbitan_berkala">Terbitan Berkala</option>  
            </select>
            <?= form_error('koleksi_kriteria','<small class="text-danger" ><b>','</b></small>') ?>           
        </div>
        <div class="form-group">
          <label>Kelas</label>
          <input type="text" name="koleksi_kelas" class="form-control" value="<?= $koleksi->koleksi_kelas; ?>" >
          <?= form_error('koleksi_kelas','<small class="text-danger" ><b>','</b></small>') ?>
        </div>
        <div class="form-group">
          <label>Judul</label>
          <input type="text" name="koleksi_judul" class="form-control" value="<?= $koleksi->koleksi_judul; ?>" >
          <?= form_error('koleksi_judul','<small class="text-danger" ><b>','</b></small>') ?>
        </div>
        <div class="form-group">
          <label>Jumlah</label>
          <input type="number" name="koleksi_jumlah" class="form-control" value="<?= $koleksi->koleksi_jumlah; ?>" >
          <?= form_error('koleksi_jumlah','<small class="text-danger" ><b>','</b></small>') ?>
        </div>
        <a href="<?= base_url("perpus_check/".$koleksi->sekolah_id."#koleksiTab") ?>" class="btn btn-info btn-sm"><i class="fas fa-chevron-left"></i> Kembali</a>
        <button type="reset" class="btn btn-danger btn-sm"><i class="fa fa-sync"></i> Reset</button>
        <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-save"></i> Simpan</button>
      <?= form_close(); ?>
    </div>
  </div>
</div>