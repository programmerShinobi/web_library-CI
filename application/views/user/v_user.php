<?= $this->session->flashdata('pesan'); ?>
<br>
<div id="home" class="container">
	<div class="container-fluid konten">
		<div class="row d-flex flex-wrap justify-content-center">
			<div data-aos="fade-up" data-aos-duration="1000" class="container col-md-7 d-flex flex-column  align-items-center justify-content-center">
				<h3 class="text-dark text-center"><?= $website->website_jum; ?></h2>
				<p class="text-dark text-center"><?= $website->website_subjum ?></p>
			</div>
		</div>
	</div>
</div>

<div class="container " data-aos="fade-up" data-aos-duration="1000">
	<div class="carousel slide containershadow" data-ride="carousel">
		<div class="carousel-inner">
			<div class="carousel-item active">
				<img class="d-block  w-100" src="<?= base_url('vendor/img/website/view-a.jpg'); ?>" alt="First slide">
				<div class="carousel-caption">
					<h2 class="xs-"></h2>
				</div>
			</div>
			<div class="carousel-item">
				<img class="d-block xs- w-100" src="<?= base_url('vendor/img/website/view-b.jpg'); ?>" alt="Second slide">
				<div class="carousel-caption">
					<h2 class="xs-"></h2>
				</div>
			</div>
			<div class="carousel-item ">
				<img class="d-block xs- w-100" src="<?= base_url('vendor/img/website/view-c.jpg'); ?>" alt="Third slide">
				<div class="carousel-caption">
					<h2 class="xs-"></h2>
				</div>
			</div>
			<div class="carousel-item ">
				<img class="d-block xs- w-100" src="<?= base_url('vendor/img/website/view-e.jpg'); ?>" alt="Fourth slide">
				<div class="carousel-caption">
					<h2 class="xs-"></h2>
				</div>
			</div>
			<div class="carousel-item ">
				<img class="d-block xs- w-100" src="<?= base_url('vendor/img/website/view-d.jpg'); ?>" alt="Fourth slide">
				<div class="carousel-caption">
					<h2 class="xs-" data-aos="fade-right" data-aos-duration="1000"></h2>
				</div>
			</div>
		</div>
	</div>
</div><br>

<div class="container " data-aos="fade-up" data-aos-duration="1000">
	<div class="container-shadow">
		<div class="content-center">
			<div class="col-md-12 shadow">
				<h4 class="text-center text-dark">Halo, perkenalkan kami</h4>
				<div class="text-justify text-dark">
					<?= $website->website_tentang; ?>
				</div>
			</div>
		</div>
	</div>
</div><br>

<div class="container " data-aos="fade-up" data-aos-duration="1000">
	<div class="container shadow">

		<div class="content-center">
			<div class="">
				<div class="row">
					<div class="col-md-6">
						<p></p>
						<!--<h4 class="text-center text-dark" >Alamat</h4>-->
						<div class="text-center text-dark">
							<p><i class="fas fa-map-marker-alt fa-lg mr-2"></i><?= $website->website_alamat; ?></p>
						</div>
					</div>
					<div class="col-md-6">
						<p></p>
						<!--<h4 class="text-center text-dark ">Kontak</h4>-->
						<div class="text-center text-dark">
							<!--<?= $website->website_kontak; ?>-->
							<p><i class="fas fa-phone-square-alt fa-lg mr-2"></i><?= $website->website_wa; ?></p>
							<p><i class="fas fa-envelope-open-text fa-lg mr-2 "></i><?= $website->website_email; ?></p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
