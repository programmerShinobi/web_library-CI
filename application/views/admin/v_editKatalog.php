<?= $this->session->flashdata('pesan'); ?>
<div class="container-fluid">
  <h4>Edit Katalog Buku</h4>
  <div class="card mb-4">
    <div class="card-body">
    <?= form_open_multipart("validation_katalog_edit"); ?>
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label>Author</label>
            <input type="hidden" name="buku_id" value="<?= $katalog->buku_id; ?>">
            <input type="text" name="buku_author" class="form-control" value="<?= $katalog->buku_author; ?>" required>
          </div>
          <div class="form-group">
            <label>Badan Koorporasi</label>
            <input type="text" name="buku_badanKoorporasi" class="form-control" value="<?= $katalog->buku_badanKoorporasi; ?>" required>
          </div>
          <div class="form-group">
            <label>Seminar</label>
            <input type="text" name="buku_seminar" class="form-control" value="<?= $katalog->buku_seminar; ?>" required>
          </div>
          <div class="form-group">
            <label>Judul Seragam</label>
            <input type="text" name="buku_judulSeragam" class="form-control" value="<?= $katalog->buku_judulSeragam; ?>" required>
          </div>
          <div class="form-group">
            <label>Judul</label>
            <input type="text" name="buku_judul" class="form-control" value="<?= $katalog->buku_judul; ?>" required>
          </div>
          <div class="form-group">
            <label>Penulis</label>
            <input type="text" name="buku_penulis" class="form-control" value="<?= $katalog->buku_penulis; ?>" required>
          </div>
          <div class="form-group">
            <label>Edisi</label>
            <input type="text" name="buku_edisi" class="form-control" value="<?= $katalog->buku_edisi; ?>" required>
          </div>
          <div class="form-group">
            <label>Kota</label>
            <input type="text" name="buku_kota" class="form-control" value="<?= $katalog->buku_kota; ?>" required>
          </div>
          <div class="form-group">
            <label>Penerbit</label>
            <input type="text" name="buku_penerbit" class="form-control" value="<?= $katalog->buku_penerbit; ?>" required>
          </div>
          <div class="form-group">
            <label>Tahun Terbit</label>
            <input type="number" name="buku_tahunTerbit" class="form-control" value="<?= $katalog->buku_tahunTerbit; ?>" required>
          </div>
          <div class="form-group">
            <label>Kolasi</label>
            <input type="text" name="buku_kolasi" class="form-control" value="<?= $katalog->buku_kolasi; ?>" required>
          </div>
          <div class="form-group">
            <label>Seri</label>
            <input type="text" name="buku_seri" class="form-control" value="<?= $katalog->buku_seri; ?>" required>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label>Judul Asli</label>
            <input type="text" name="buku_judulAsli" class="form-control" value="<?= $katalog->buku_judulAsli; ?>" required>
          </div>
          <div class="form-group">
            <label>Catatan</label>
            <input type="text" name="buku_catatan" class="form-control" value="<?= $katalog->buku_catatan; ?>" required>
          </div>
          <div class="form-group">
            <label>Blibiografi</label>
            <input type="text" name="buku_blibiografi" class="form-control" value="<?= $katalog->buku_blibiografi; ?>" required>
          </div>
          <div class="form-group">
            <label>Indeks</label>
            <input type="text" name="buku_indeks" class="form-control" value="<?= $katalog->buku_indeks; ?>" required>
          </div>
          <div class="form-group">
            <label>ISBN</label>
            <input type="text" name="buku_isbn" class="form-control" value="<?= $katalog->buku_isbn; ?>" required>
          </div>
          <div class="form-group">
            <label>Kelas</label>
            <input type="number" name="buku_noSKU" class="form-control" value="<?= $katalog->buku_noSKU; ?>" required>
          </div>
          <div class="form-group">
            <label>Stok</label>
            <input type="number" name="buku_stok" class="form-control" value="<?= $katalog->buku_stok; ?>" required>
          </div>
          <div class="form-group">
            <label>Jumlah</label>
            <input type="number" name="buku_jumlah" class="form-control" value="<?= $katalog->buku_jumlah; ?>" required>
          </div>
          <div class="form-group">
            <label>Rak</label>
            <input type="text" name="buku_rak" class="form-control" value="<?= $katalog->buku_rak; ?>" required>
          </div>
          <div class="form-group">
            <label>Sumber Pertama</label>
            <input type="text" name="buku_sumber1" class="form-control" value="<?= $katalog->buku_sumber1; ?>" required>
          </div>
          <div class="form-group">
            <label>Keterangan</label>
            <input type="text" name="buku_keterangan" class="form-control" value="<?= $katalog->buku_keterangan; ?>" required>
          </div>
          <div class="form-group">
            <label>Tahun Anggaran</label>
            <input type="number" name="buku_tahunAnggaran" class="form-control" value="<?= $katalog->buku_tahunAnggaran; ?>" required>
          </div>
          <img src="<?= base_url("vendor/img/buku/".$katalog->buku_foto) ?>" alt="Foto Buku" style="max-width: 25%;">
          <div class="form-group">
            <label>Foto Buku</label>
            <input type="file" name="buku_foto" class="form-control">
          </div>
        </div>
      </div>
      <a href="<?= base_url("katalogBuku") ?>" class="btn btn-info btn-sm mb"><i class="fas fa-chevron-left"></i> Kembali</a>
      <button type="reset" class="btn btn-danger btn-sm"><i class="fa fa-sync"></i> Reset</button>
      <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-save"></i> Simpan</button>
      <?= form_close(); ?>
    </div>
  </div>
</div>