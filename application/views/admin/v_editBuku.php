<?= $this->session->flashdata('pesan'); ?>
<div class="container-fluid">
  <h4>Edit Buku</h4>
  <div class="row">
    <div class="col-md-8">
      <div class="card">
        <div class="card-body">
          <?= form_open_multipart('updateBuku'); ?>
          <div class="form-group">
            <label>Judul Buku</label>
            <input type="hidden" name="id" value="<?= $b->buku_id; ?>">
            <input type="text" name="judul" class="form-control" value="<?= $b->buku_judul; ?>" required>
          </div>
          <div class="form-group">
            <label>Kelas</label>
            <input type="number" name="sku" class="form-control" value="<?= $b->buku_noSKU; ?>" required>
          </div>
          <div class="form-group">
            <label>Penulis</label>
            <input type="text" name="penulis" class="form-control" value="<?= $b->buku_penulis; ?>" required>
          </div>
          <div class="form-group">
            <label>Penerbit</label>
            <select name="penerbit" class="form-control" required>
              <option disabled selected>-- Pilih Penerbit --</option>
              <?php foreach($penerbit as $p) { ?>
              <option <?php if($b->buku_penerbit == $p->penerbit_id){ echo 'selected'; } ?> value="<?= $p->penerbit_id ?>"><?= $p->penerbit_judul ?></option>
              <?php } ?>
            </select>
          </div>
          <div class="form-group">
            <label>Kategori</label>
            <select name="kategori" class="form-control">
              <option disabled selected>-- Pilih Kategori --</option>
              <?php foreach($kategori as $k) { ?>
              <option <?php if($b->buku_kategori == $k->kategori_id){ echo 'selected'; } ?> value="<?= $k->kategori_id ?>"><?= $k->kategori_judul ?></option>
              <?php } ?>
            </select>
          </div>
          <div class="form-group">
            <label>Tahun Terbit</label>
            <input type="number" name="tahun" class="form-control" value="<?= $b->buku_tahunTerbit; ?>" required>
          </div>
          <div class="form-group">
            <label>Tebal (Halaman)</label>
            <input type="number" name="tebal" class="form-control" value="<?= $b->buku_tebal; ?>" required>
          </div>
          <img src="<?= base_url('vendor/img/buku/'.$b->buku_foto); ?>" alt="Foto Buku" class="gbr-buku-admin">
          <div class="form-group">          
            <label>Foto Buku</label>            
            <input type="file" name="foto" class="form-control">
          </div>
          <div class="form-group">
            <label>Stok Buku</label>
            <input type="number" name="stok" class="form-control" value="<?= $b->buku_stok; ?>" required>
          </div>
          <div class="form-group">
            <label>Stok Buku</label>
            <input type="number" name="harga" class="form-control" value="<?= $b->buku_harga; ?>" required>
          </div>
          <div class="form-group">
            <label>Status Buku</label>
            <select name="status" class="form-control" required>
              <option selected disabled>-- Pilih status buku --</option>
              <option <?php if($b->buku_status == 1){ echo 'selected'; } ?> value="1">Ready</option>
              <option <?php if($b->buku_status == 5){ echo 'selected'; } ?> value="5">Akan dibeli</option>
            </select>
          </div>
          <div class="form-group">
            <label>Status Jual</label>
            <select name="jual" class="form-control" required>
              <option selected disabled>-- Pilih status jual --</option>
              <option <?php if($b->buku_jual == 1){ echo 'selected'; } ?> value="1">Dijual</option>
              <option <?php if($b->buku_jual == 2){ echo 'selected'; } ?> value="2">Hanya dipinjam</option>
            </select>
          </div>
          <input type="submit" value="Simpan" class="btn btn-success btn-sm">
          </form>
        </div>
      </div>
    </div>
  </div>
</div>