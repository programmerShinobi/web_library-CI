<?= $this->session->flashdata('pesan'); ?>
<div class="container-fluid">
  <h4>Edit data pengunjung</h4>
  <div class="card mb-4">
    <div class="card-body">
      <?= form_open_multipart('validation_pengunjung_edit'); ?>
        <h5>Data Pengunjung</h5>
        <input type="hidden" name="pengunjung_id" class="form-control" value="<?= $pengunjung_detail->pengunjung_id; ?>">
        <div class="form-group">
          <label>Nama</label>
          <input type="text" name="pengunjung_nama" class="form-control" value="<?= $pengunjung_detail->pengunjung_nama; ?>" required>
        </div>
        <div class="form-group">
          <label>Jenis Kelamin</label>
            <select class="form-control" name="pengunjung_jk" required>
              <option name="pengunjung_jk" value="L"   <?php if ($pengunjung_detail->pengunjung_jk =="L" ) {echo 'selected';} ?> /> Laki - laki</option>
              <option name="pengunjung_jk" value="P"  <?php if ($pengunjung_detail->pengunjung_jk =="P" ) {echo 'selected';} ?> /> Perempuan</option>
            </select>           
        </div>
        <div class="form-group">
          <label>Alamat</label>
          <input type="text" name="pengunjung_alamat" class="form-control" value="<?= $pengunjung_detail->pengunjung_alamat; ?>" required>
        </div>       
        <div class="form-group">
          <label>Klasifikasi</label>
            <select class="form-control" name="pengunjung_klasifikasi" required>
              <option name="pengunjung_klasifikasi" value="1"   <?php if ($pengunjung_detail->pengunjung_klasifikasi =="1" ) {echo 'selected';} ?> /> TK</option>
              <option name="pengunjung_klasifikasi" value="2"  <?php if ($pengunjung_detail->pengunjung_klasifikasi =="2" ) {echo 'selected';} ?> /> SD</option>
              <option name="pengunjung_klasifikasi" value="3"  <?php if ($pengunjung_detail->pengunjung_klasifikasi =="3" ) {echo 'selected';} ?> /> SMP</option>
              <option name="pengunjung_klasifikasi" value="4"  <?php if ($pengunjung_detail->pengunjung_klasifikasi =="4" ) {echo 'selected';} ?> /> SMA</option>
              <option name="pengunjung_klasifikasi" value="5"  <?php if ($pengunjung_detail->pengunjung_klasifikasi =="5" ) {echo 'selected';} ?> /> Mahasiswa</option>
              <option name="pengunjung_klasifikasi" value="6"  <?php if ($pengunjung_detail->pengunjung_klasifikasi =="6" ) {echo 'selected';} ?> /> PNS</option>
              <option name="pengunjung_klasifikasi" value="7"  <?php if ($pengunjung_detail->pengunjung_klasifikasi =="7" ) {echo 'selected';} ?> /> Karyawan</option>
              <option name="pengunjung_klasifikasi" value="8"  <?php if ($pengunjung_detail->pengunjung_klasifikasi =="8" ) {echo 'selected';} ?> /> Umum</option>
            </select>           
        </div>
        <div class="form-group">
          <label>Inforamasi Yang Dicari</label>
            <select class="form-control" name="pengunjung_info" required>
              <option name="pengunjung_info" value="Baca"   <?php if ($pengunjung_detail->pengunjung_info =="Baca" ) {echo 'selected';} ?> /> Baca</option>
              <option name="pengunjung_info" value="Pinjam"   <?php if ($pengunjung_detail->pengunjung_info =="Pinjam" ) {echo 'selected';} ?> /> Pinjam</option>
              <option name="pengunjung_info" value="Kembali"   <?php if ($pengunjung_detail->pengunjung_info =="Kembali" ) {echo 'selected';} ?> /> Kembali</option>
            </select>           
        </div>
        <div class="form-group">
          <label>Waktu Masuk</label>
          <input type="time" name="pengunjung_masuk" class="form-control" value="<?= $pengunjung_detail->pengunjung_masuk; ?>" required>
        </div>   
        <div class="form-group">
          <label>Tanggal Kunjungan</label>
          <input type="date" name="pengunjung_tanggal" class="form-control" value="<?= $pengunjung_detail->pengunjung_tanggal; ?>" required>
        </div>             
        <a href="<?= base_url("dataPengunjung") ?>" class="btn btn-info btn-sm mb"><i class="fas fa-chevron-left"></i> Kembali</a>
        <button type="reset" class="btn btn-danger btn-sm"><i class="fa fa-sync"></i> Reset</button>
        <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-save"></i> Simpan</button>
      <?= form_close(); ?>
    </div>
  </div>
</div>
