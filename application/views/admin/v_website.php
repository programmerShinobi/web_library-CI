<?= $this->session->flashdata('pesan'); ?>
<div class="container-fluid">
  <h4>Info Website Anda</h4>
      <div class="card">
        <div class="card-body">
          <?= form_open_multipart('validation_website_edit'); ?>
          <div class="form-group">
            <label>Text Jumbotron</label>
            <input type="hidden" name="website_id" class="form-control" value="<?= $website->website_id; ?>">
            <input type="text" name="website_jum" class="form-control" value="<?= $website->website_jum; ?>">
            <?= form_error('jum','<small class="text-danger">','</small>') ?>
          </div>
          <div class="form-group">
            <label>Text Sub Jumbotron</label>
            <input type="text" name="website_subJum" class="form-control" value="<?= $website->website_subjum; ?>">
            <?= form_error('subJum','<small class="text-danger">','</small>') ?>
          </div>
          <div class="form-group">
            <label>Gambar Jumbotron</label>
            <input type="file" name="website_gbrJum" class="form-control">
            <?= form_error('gbrJum','<small class="text-danger">','</small>') ?>
          </div>
          <div class="form-group">
            <label>Tentang Website</label>
            <textarea name="website_tentang" id="tentang" class="form-control" cols="30" rows="5" ><?= $website->website_tentang; ?></textarea>
            <?= form_error('tentang','<small class="text-danger">','</small>') ?>
          </div>
          <div class="form-group">
            <label>Label</label>
            <input type="text" name="website_kontak" class="form-control" value="<?= $website->website_kontak; ?>">
            <?= form_error('kontak','<small class="text-danger">','</small>') ?>
          </div>          
          <div class="form-group">
            <label>Email</label>
            <input type="email" name="website_email" class="form-control" value="<?= $website->website_email; ?>">
            <?= form_error('email','<small class="text-danger">','</small>') ?>
          </div>          
          <div class="form-group">
            <label>Alamat</label>
            <textarea type="text" name="website_alamat" id="alamat" class="form-control" cols="30" rows="5" ><?= $website->website_alamat; ?></textarea>
            <?= form_error('alamat','<small class="text-danger">','</small>') ?>
          </div>
          <div class="form-group">
            <label>Nomor WhatsApp</label>
            <input type="number" name="website_wa" class="form-control" value="<?= $website->website_wa; ?>">
            <?= form_error('wa','<small class="text-danger">','</small>') ?>
          </div>
          <input type="submit" value="Simpan" class="btn btn-success btn-sm">
          <?= form_close(); ?>
        </div>
      </div>
</div>

<script>
   CKEDITOR.replace('tentang',{
     language: 'id'
   });
</script>

<script>
   CKEDITOR.replace('alamat',{
     language: 'id'
   });
</script>