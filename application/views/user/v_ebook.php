<div class="container konten">
	<div class="row shadow justify-content-center" data-aos="fade-down" data-aos-duration="1500">
		<h4 class="text-center"><?= $title; ?></h4>
	</div>
	<div class="row shadow justify-content-center" data-aos="fade-up" data-aos-duration="1500">
		<div class="container">
			<div class="row mt-3 justify-content-center">
				<div class="col-md-5">
					<label for="search-input">Masukkan judul literasi</label>
					<div class="input-group mb-3">
						<input type="text" class="form-control" placeholder="Judul literasi.." id="search-input">
						<div class="input-group-append">
							<button class="btn btn-primary" id="search-button">
								<i class="fas fa-search fa-sm"></i>
							</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<hr>
	<div class="row" id="book-list"></div>
	
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Literasi Detail</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body" id="book-detail"></div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
