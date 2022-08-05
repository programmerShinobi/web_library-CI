<?= $this->session->flashdata('pesan'); ?>
<div class="container-fluid">
  <h4>Edit data petugas</h4>
  <div class="card mb-4">
    <div class="card-body">
      <?= form_open_multipart('validation_petugas_edit'); ?>
        <div class="row">
          <div class="col-md-6">
            <h5>Data Pribadi</h5>
            <div class="form-group">
              <label>Kode Petugas</label>
              <input type="hidden" name="petugas_id" value="<?= $petugas->user_id; ?>">
              <input type="text" name="user_noId" class="form-control" value="<?= $petugas->user_noId; ?>" required>
            </div>
            <div class="form-group">
              <label>Nama</label>
              <input type="text" name="user_nama" class="form-control" value="<?= $petugas->user_nama; ?>" required>
            </div>
            <div class="form-group">
              <label>Tempat Lahir</label>
              <input type="text" name="user_tempatLahir" class="form-control" value="<?= $petugas->user_tempatLahir; ?>" required>
            </div>
            <div class="form-group">
              <label>Tanggal Lahir</label>
              <input type="date" name="user_tanggalLahir" class="form-control" value="<?= $petugas->user_tanggalLahir; ?>" required>
            </div>
            <div class="form-group">
              <label>Klasifikasi</label>
                <select class="form-control" name="user_klasifikasi" required>
                  <option name="user_klasifikasi" value="1"   <?php if ($petugas->user_klasifikasi =="1" ) {echo 'selected';} ?> /> TK</option>
                  <option name="user_klasifikasi" value="2"  <?php if ($petugas->user_klasifikasi =="2" ) {echo 'selected';} ?> /> SD</option>
                  <option name="user_klasifikasi" value="3"  <?php if ($petugas->user_klasifikasi =="3" ) {echo 'selected';} ?> /> SMP</option>
                  <option name="user_klasifikasi" value="4"  <?php if ($petugas->user_klasifikasi =="4" ) {echo 'selected';} ?> /> SMA</option>
                  <option name="user_klasifikasi" value="5"  <?php if ($petugas->user_klasifikasi =="5" ) {echo 'selected';} ?> /> Mahasiswa</option>
                  <option name="user_klasifikasi" value="6"  <?php if ($petugas->user_klasifikasi =="6" ) {echo 'selected';} ?> /> PNS</option>
                  <option name="user_klasifikasi" value="7"  <?php if ($petugas->user_klasifikasi =="7" ) {echo 'selected';} ?> /> Karyawan</option>
                  <option name="user_klasifikasi" value="8"  <?php if ($petugas->user_klasifikasi =="8" ) {echo 'selected';} ?> /> Umum</option>
                </select>           
            </div>

            <div class="form-group">
              <label>KTP</label>
              <input type="text" name="user_ktp" class="form-control" value="<?= $petugas->user_ktp; ?>" required>
            </div>
            <div class="form-group">
              <label>Username</label>
              <input type="text" name="user_username" class="form-control" value="<?= $petugas->user_username; ?>" required>
            </div>
            <div class="form-group">
              <label>Password</label>
              <input type="password" name="user_password" class="form-control" placeholder="Isi jika ingin ganti password">
            </div>
              <div class="form-group">
                <label>Nomor HP</label>
                <input type="number" name="user_noHP" class="form-control" value="<?= $petugas->user_noHP; ?>" required>
              </div>
              <div class="form-group">
                <label>Email</label>
                <input type="email" name="user_email" class="form-control" value="<?= $petugas->user_email; ?>" required>
              </div>
              <img src="<?= base_url("vendor/img/user/".$petugas->user_foto); ?>" alt="Foto Petugas" style="max-width: 20%;">
              <div class="form-group">
                <label>Foto User</label>
                <input type="file" name="user_foto" class="form-control">
              </div>
          </div>
          <div class="col-md-6">
            <h5>Data Orang Tua</h5>
            <div class="form-group">
              <label>Nama Orang Tua</label>
              <input type="text" name="orangtua_nama" class="form-control" value="<?= $petugas->orangtua_nama; ?>" required>
            </div>
            <div class="form-group">
              <label>Nomor HP Orang Tua</label>
              <input type="number" name="orangtua_noHP" class="form-control" value="<?= $petugas->orangtua_noHP; ?>" required>
            </div>
            <div class="form-group">
              <label>Tempat Lahir Orang Tua</label>
              <input type="text" name="orangtua_tempatLahir" class="form-control" value="<?= $petugas->orangtua_tempatLahir; ?>" required>
            </div>
            <div class="form-group">
              <label>Tanggal Lahir Orang Tua</label>
              <input type="date" name="orangtua_tanggalLahir" class="form-control" value="<?= $petugas->orangtua_tanggalLahir; ?>" required>
            </div>
            <h5>Pertanyaan Keamanan</h5>
            <div class="form-group">
              <select name="pertanyaan" class="form-control" required>
                <option disabled selected>-- Pilih Pertanyaan --</option>
                <option <?php if($petugas->pertanyaan == "Siapa nama peliharaan anda?") { echo "selected"; } ?> value="Siapa nama peliharaan anda?">Siapa nama peliharaan anda?</option>
                <option <?php if($petugas->pertanyaan == "Siapa nama kakek anda?") { echo "selected"; } ?> value="Siapa nama kakek anda?">Siapa nama kakek anda?</option>
                <option <?php if($petugas->pertanyaan == "Siapa nama saudara anda?") { echo "selected"; } ?> value="Siapa nama saudara anda?">Siapa nama saudara anda?</option>
                <option <?php if($petugas->pertanyaan == "Nama sekolah SD anda adalah?") { echo "selected"; } ?> value="Nama sekolah SD anda adalah?">Nama sekolah SD anda adalah?</option>
              </select>
            </div>
            <div class="form-group">
              <input type="text" name="jawaban" class="form-control" value="<?= $petugas->pertanyaan_jawaban; ?>" required>
            </div>
          </div>
        </div>
        <a href="<?= base_url("dataPetugas") ?>" class="btn btn-info btn-sm mb"><i class="fas fa-chevron-left"></i> Kembali</a>
        <button type="reset" class="btn btn-danger btn-sm"><i class="fa fa-sync"></i> Reset</button>
        <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-save"></i> Simpan</button>
      <?= form_close(); ?>
    </div>
  </div>
</div>