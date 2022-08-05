.<?= $this->session->flashdata('pesan'); ?>
<div class="container-fluid">
  <h4><?= $title; ?></h4>
  <div class="card">
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered table-hover" id="data">
          <thead>
            <tr>
              <th>Nomor</th>
              <th>Nomor Booking</th>
              <th>User</th>
              <th>Buku</th>
              <th>Jumlah</th>
              <th>Harga</th>
              <th>Tanggal Booking</th>
              <th>Tanggal Pengembalian</th>
              <th>Waktu Expired</th>
              <th>Keterangan</th>
              <th>Opsi</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php $no=1; foreach($table as $b) : ?>
            <tr>
              <td><?= $no++; ?></td>
              <td><?= $b->booking_noId; ?></td>
              <td><?= $b->user_nama; ?></td>
              <td><?= $b->buku_judul; ?></td>
              <td><?= $b->booking_jumlah; ?></td>
              <td>Rp. <?= number_format($b->buku_harga * $b->booking_jumlah); ?></td>
              <td><?= date('d M Y', strtotime($b->booking_waktu)); ?></td>
              <td><?php
                if($b->booking_status == 1) {
                  echo '-';
                } else {
                  echo date('d M Y', strtotime($b->booking_pengembalian)); 
                }
              ?></td>
              <td><?= date('d M Y H:i:s', strtotime($b->booking_expired)); ?></td>
              <td>
                <?php 
                  if($b->booking_status == 1) {
                    echo '<div class="badge badge-info">Membeli</div>';
                  } else {
                    echo '<div class="badge badge-info">Meminjam</div>';
                  }
                ?>
              </td>
              <td>
                <?php if($b->booking_accept == 0) : ?>
                <a href="<?= base_url('tolakBooking/'.$b->booking_id); ?>" class="btn btn-danger btn-sm mb-2">Tolak</a>
                <a href="<?= base_url('terimaBooking/'.$b->booking_id); ?>" class="btn btn-success btn-sm">Terima</a>
                <?php elseif($b->booking_accept == 1) : ?>
                <div class="badge badge-success">Diterima</div>
                <?php elseif($b->booking_accept == 2) : ?>
                <div class="badge badge-danger">Ditolak</div>
                <?php endif; ?>
              </td>
              <td>
                <?php if($b->booking_accept == 1 || $b->booking_accept == 2) : ?>
                <a href="<?= base_url('hapusBooking/'.$b->booking_id); ?>" class="btn btn-danger btn-sm">Hapus</a>
                <?php endif; ?>
              </td>
            </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>