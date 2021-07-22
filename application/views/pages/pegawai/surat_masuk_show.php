<?php
/**
 * @var $surat_masuk
 */

if (count($surat_masuk) <= 0) {
	redirect(base_url().'suratmasuk');
}
?>
<div class="container-fluid">
	<!-- Page Heading -->
	<div class="d-sm-flex flex-column align-items-start justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800 mb-3">Lihat Surat Masuk</h1>
	</div>
	<div class="row">
		<div class="col-lg-12">
			<!-- Change password card-->
			<div class="card shadow mb-4">
				<div class="card-header py-3">
					<h6 class="m-0 font-weight-bold text-primary">Informasi Data</h6>
				</div>
				<div class="card-body">
					<form>
						<div class="row gx-3 mb-3">
							<!-- Form Group (first name)-->
							<div class="col-md-9">
								<label class="small mb-1" for="nosurat">No Surat</label>
								<input name="nosurat" disabled class="form-control" id="nosurat" type="text" placeholder="Masukkan no surat" value="<?php echo $surat_masuk[0]->no_surat; ?>">
							</div>
							<!-- Form Group (last name)-->
							<div class="col-md-3">
								<label class="small mb-1" for="tanggal">Tanggal</label>
								<input name="tanggal" disabled class="form-control" id="tanggal" type="date" placeholder="Masukkan tanggal" value="<?php echo $surat_masuk[0]->tanggal_sm; ?>">
							</div>
						</div>
						<div class="mb-3">
							<label class="small mb-1" for="penerima">Nama Penerima</label>
							<input name="penerima" disabled class="form-control" id="penerima" type="text" placeholder="Masukkan nama penerima" value="<?php echo $surat_masuk[0]->nama_lengkap; ?>"/>
						</div>
						<div class="mb-3">
							<label class="small mb-1" for="perihal">Perihal</label>
							<input name="perihal" disabled class="form-control" id="perihal" type="text" placeholder="Masukkan perihal" value="<?php echo $surat_masuk[0]->perihal; ?>"/>
						</div>
						<div class="mb-3">
							<label class="small mb-1" for="telp">No Telepone</label>
							<input name="telp" disabled class="form-control" id="telp" type="text" placeholder="Masukkan no telepone" value="<?php echo $surat_masuk[0]->no_hp; ?>"/>
						</div>
						<div class="mb-3">
							<label class="small mb-1" for="lampiran">Lampiran</label><br>
							<a href="<?php echo base_url(); ?>suratmasuk/download/<?php echo $surat_masuk[0]->id_sm; ?>" class="btn btn-dark btn-sm">Download</a>
							<span class="text text-secondary small d-block mt-2">Download file untuk mengubah status menjadi dibaca</span>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
