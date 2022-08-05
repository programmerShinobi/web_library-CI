<?= $this->session->flashdata('pesan'); ?>
<div class="container-fluid">
  <h4><?=$title;?></h4>
  <div class="card">
    <div class="card-body">
      <a href="" class="btn btn-success btn-sm mb-4" data-toggle="modal" data-target="#addKatalog"><i class="fa fa-plus"></i> Tambah Katalog</a>
      <a href="<?= base_url("export_katalog") ?>" target="_blank" class="btn btn-dark btn-sm mb-4"><i class="fa fa-file-export"></i> Export to excel</a>
      <a href="" data-toggle="modal" data-target="#import" class="btn btn-dark btn-sm mb-4"><i class="fa fa-file-import"></i> Import Excel</a>
      <table class="table table-bordered table-hover table-responsive" id="dataVisibility">
        <thead>
          <tr>
            <th>#</th>
            <th>Author</th>
            <th>Badan Koorporasi</th>
            <th>Seminar</th>
            <th>Judul Seragam</th>
            <th>Judul</th>
            <th>Penulis</th>
            <th>Edisi</th>
            <th>Kota</th>
            <th>Penerbit</th>
            <th>Tahun Terbit</th>
            <th>Kolasi</th>
            <th>Seri</th>
            <th>Judul Asli</th>
            <th>Catatan</th>
            <th>Blibiografi</th>
            <th>Indeks</th>
            <th>ISBN</th>
            <th>Kelas</th>
            <th>Stok</th>
            <th>Jumlah</th>
            <th>Rak</th>
            <th>Sumber Pertama</th>
            <th>Keterangan</th>
            <th>Tahun Anggaran</th>
            <th>Foto</th>
            <th>Aksi</th>

          </tr>
        </thead>
        <tbody>
          <?php $no = 1; foreach($list_katalog as $item) { ?>
          <tr>
            <td><?= $no++; ?></td>
            <td><?= $item->buku_author; ?></td>
            <td><?= $item->buku_badanKoorporasi; ?></td>
            <td><?= $item->buku_seminar; ?></td>
            <td><?= $item->buku_judulSeragam; ?></td>
            <td><?= $item->buku_judul; ?></td>
            <td><?= $item->buku_penulis; ?></td>
            <td><?= $item->buku_edisi; ?></td>
            <td><?= $item->buku_kota; ?></td>
            <td><?= $item->buku_penerbit; ?></td>
            <td><?= $item->buku_tahunTerbit; ?></td>
            <td><?= $item->buku_kolasi; ?></td>
            <td><?= $item->buku_seri; ?></td>
            <td><?= $item->buku_judulAsli; ?></td>
            <td><?= $item->buku_catatan; ?></td>
            <td><?= $item->buku_blibiografi; ?></td>
            <td><?= $item->buku_indeks; ?></td>
            <td><?= $item->buku_isbn; ?></td>
            <td><?= $item->buku_noSKU; ?></td>
            <td><?= $item->buku_stok; ?></td>
            <td><?= $item->buku_jumlah; ?></td>
            <td><?= $item->buku_rak; ?></td>
            <td><?= $item->buku_sumber1; ?></td>
            <td><?= $item->buku_keterangan; ?></td>
            <td><?= $item->buku_tahunAnggaran; ?></td>
            <td><img src="<?= base_url("vendor/img/buku/".$item->buku_foto) ?>" alt="" style="max-width: 70px;"></td>
            <td>
              <div class="form-group card ">
                <a href="<?= base_url("katalog_edit/".$item->buku_id) ?>" class="btn btn-light btn-sm"><i class="fa fa-edit"></i> Edit</a>
              </div>
              <?php if ($user->user_role == 1){?>
                <div class="form-group card ">
                  <a href="<?= base_url("process_katalog_hapus/".$item->buku_id) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin menghapus data?')"><i class="fa fa-trash"></i> Hapus</a>
                </div>
              <?php }?>
            </td>
          </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
</div>


<div class="modal fade" id="import">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4>Import Katalog Buku</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <?= form_open_multipart("import_katalog") ?>
        <div class="form-group">
          <label>Masukkan File Excel</label>
          <input type="file" name="import_katalog" class="form-control">
        </div>
        <input type="submit" value="Import" class="btn btn-success btn-sm">
        <?= form_close(); ?>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="addKatalog">
  <div class="modal-dialog modal-dialog-scrollable modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h4>Tambah Katalog Buku</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <?= form_open("validation_katalog_add"); ?>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Author</label>
              <input type="text" name="buku_author" class="form-control" required>
            </div>
            <div class="form-group">
              <label>Badan Koorporasi</label>
              <input type="text" name="buku_badanKoorporasi" class="form-control" required>
            </div>
            <div class="form-group">
              <label>Seminar</label>
              <input type="text" name="buku_seminar" class="form-control" required>
            </div>
            <div class="form-group">
              <label>Judul Seragam</label>
              <input type="text" name="buku_judulSeragam" class="form-control" required>
            </div>
            <div class="form-group">
              <label>Judul</label>
              <input type="text" name="buku_judul" class="form-control" required>
            </div>
            <div class="form-group">
              <label>Penulis</label>
              <input type="text" name="buku_penulis" class="form-control" required>
            </div>
            <div class="form-group">
              <label>Edisi</label>
              <input type="text" name="buku_edisi" class="form-control" required>
            </div>
            <div class="form-group">
              <label>Kota</label>
              <input type="text" name="buku_kota" class="form-control" required>
            </div>
            <div class="form-group">
              <label>Penerbit</label>
              <input type="text" name="buku_penerbit" class="form-control" required>
            </div>
            <div class="form-group">
              <label>Tahun Terbit</label>
              <input type="number" name="buku_tahunTerbit" class="form-control" required>
            </div>
            <div class="form-group">
              <label>Kolasi</label>
              <input type="text" name="buku_kolasi" class="form-control" required>
            </div>
            <div class="form-group">
              <label>Seri</label>
              <input type="text" name="buku_seri" class="form-control" required>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Judul Asli</label>
              <input type="text" name="buku_judulAsli" class="form-control" required>
            </div>
            <div class="form-group">
              <label>Catatan</label>
              <input type="text" name="buku_catatan" class="form-control" required>
            </div>
            <div class="form-group">
              <label>Blibiografi</label>
              <input type="text" name="buku_blibiografi" class="form-control" required>
            </div>
            <div class="form-group">
              <label>Indeks</label>
              <input type="text" name="buku_indeks" class="form-control" required>
            </div>
            <div class="form-group">
              <label>ISBN</label>
              <input type="text" name="buku_isbn" class="form-control" required>
            </div>
            <div class="form-group">
              <label>Kelas</label>
              <input type="number" name="buku_noSKU" class="form-control" required>
            </div>
            <div class="form-group">
              <label>Stok</label>
              <input type="number" name="buku_stok" class="form-control" required>
            </div>
            <div class="form-group">
              <label>Rak</label>
              <input type="text" name="buku_rak" class="form-control" required>
            </div>
            <div class="form-group">
              <label>Sumber Pertama</label>
              <input type="text" name="buku_sumber1" class="form-control" required>
            </div>
            <div class="form-group">
              <label>Keterangan</label>
              <input type="text" name="buku_keterangan" class="form-control" required>
            </div>
            <div class="form-group">
              <label>Tahun Anggaran</label>
              <input type="number" name="buku_tahunAnggaran" class="form-control" required>
            </div>
          </div>
        </div>
        <input type="submit" value="Simpan" class="btn btn-primary btn-sm">
        <?= form_close(); ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
