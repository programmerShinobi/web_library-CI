<?= $this->session->flashdata('pesan'); ?>
<div class="container-fluid">
<h4><?= $title; ?></h4>
  <div class="card">
    <div class="card-header">
    <b><?=$person->sekolah_nama?></b><hr>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <a class="text-danger" href="<?= base_url("perpus_check/".$person->sekolah_id."#personTab")?>">&times;</a>
      </button>
      <h4 class="card-title"><b>Form</b> | Edit Data Person Perpustakaan</h4>
    </div>
    <div class="card-body">
      <?= form_open_multipart('edit_person'); ?>
        <div class="form-group">
          <label>Tahun</label>
          <input type="hidden" name="sekolah_id" class="form-control" value="<?= $person->sekolah_id;?>" >
          <input type="hidden" name="person_id" class="form-control" value="<?= $person->person_id;?>" >
          <input type="number" name="person_pertahun" class="form-control" value="<?= $person->person_pertahun; ?>" >
          <?= form_error('person_pertahun','<small class="text-danger" ><b>','</b></small>') ?>
        </div>
        <div class="form-group">
            <label>Kriteria</label>
            <select class="form-control" id="person_kriteria" name="person_kriteria" >
                <option disabled>-- Pilih Kriteria --</option>
                <option <?php if($person->person_kriteria == "anggota"){ echo "selected"; }?> value="anggota">Anggota</option>  
                <option <?php if($person->person_kriteria == "pemustaka"){ echo "selected"; }?> value="pemustaka">Pemustaka</option>
                <option <?php if($person->person_kriteria == "pengunjung"){ echo "selected"; }?> value="pengunjung">Pengunjung</option>  
            </select>
            <?= form_error('person_kriteria','<small class="text-danger" ><b>','</b></small>') ?>           
        </div>
        <div class="form-group">
          <label>Jumlah Guru/Staff</label>
          <input type="number" name="person_jumlahGuruStaff" class="form-control" value="<?= $person->person_jumlahGuruStaff; ?>" >
          <?= form_error('person_jumlahGuruStaff','<small class="text-danger" ><b>','</b></small>') ?>
        </div>
        <div class="form-group">
          <label>Jumlah Siswa</label>
          <input type="number" name="person_jumlahSiswa" class="form-control" value="<?= $person->person_jumlahSiswa; ?>" >
          <?= form_error('person_jumlahSiswa','<small class="text-danger" ><b>','</b></small>') ?>
        </div>
        <a href="<?= base_url("perpus_check/".$person->sekolah_id."#personTab") ?>" class="btn btn-info btn-sm"><i class="fas fa-chevron-left"></i> Kembali</a>
        <button type="reset" class="btn btn-danger btn-sm"><i class="fa fa-sync"></i> Reset</button>
        <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-save"></i> Simpan</button>
      <?= form_close(); ?>
    </div>
  </div>
</div>