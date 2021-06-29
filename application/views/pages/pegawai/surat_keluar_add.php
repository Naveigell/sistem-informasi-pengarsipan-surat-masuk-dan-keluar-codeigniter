<div class="container-fluid">
	<!-- Page Heading -->
	<div class="d-sm-flex flex-column align-items-start justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800 mb-3">Tambah Surat Keluar</h1>
	</div>
	<div class="row">
		<div class="col-lg-12">
			<!-- Change password card-->
			<div class="card shadow mb-4">
				<div class="card-header py-3">
					<h6 class="m-0 font-weight-bold text-primary">Input Data</h6>
				</div>
				<div class="card-body">
					<form>
						<div class="row gx-3 mb-3">
							<!-- Form Group (first name)-->
							<div class="col-md-9">
								<label class="small mb-1" for="nosurat">No Surat</label>
								<input class="form-control" id="nosurat" type="text" placeholder="Masukkan no surat" value="">
							</div>
							<!-- Form Group (last name)-->
							<div class="col-md-3">
								<label class="small mb-1" for="tanggal">Tanggal</label>
								<input class="form-control" id="tanggal" type="date" placeholder="Enter your last name" value="">
							</div>
						</div>
						<div class="mb-3">
							<label class="small mb-1" for="pengirim">Nama Pengirim</label>
							<input class="form-control" id="pengirim" type="text" placeholder="Masukkan nama pengirim" />
						</div>
						<div class="mb-3">
							<label class="small mb-1" for="perihal">Perihal</label>
							<input class="form-control" id="perihal" type="text" placeholder="Masukkan perihal" />
						</div>
						<div class="mb-3">
							<label class="small mb-1" for="tujuan">Tujuan</label>
							<input class="form-control" id="tujuan" type="text" placeholder="Masukkan tujuan" />
						</div>
						<div class="mb-3">
							<label class="small mb-1" for="lampiran">Lampiran</label>
							<input class="form-control" id="lampiran" type="file" />
						</div>
						<button class="btn btn-primary" type="button">Tambah</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
