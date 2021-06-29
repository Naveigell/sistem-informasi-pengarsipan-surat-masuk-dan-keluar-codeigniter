<?php
/**
 * @var $surat_keluar
 */

if (count($surat_keluar) <= 0) {
	redirect(base_url().'suratkeluar');
}
?>
<div class="container-fluid">
	<!-- Page Heading -->
	<div class="d-sm-flex flex-column align-items-start justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800 mb-3">Lihat Surat Keluar</h1>
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
								<input name="nosurat" disabled class="form-control" id="nosurat" type="text" placeholder="Masukkan no surat" value="<?php echo $surat_keluar[0]->no_surat; ?>">
							</div>
							<!-- Form Group (last name)-->
							<div class="col-md-3">
								<label class="small mb-1" for="tanggal">Tanggal</label>
								<input name="tanggal" disabled class="form-control" id="tanggal" type="date" placeholder="Masukkan tanggal" value="<?php echo $surat_keluar[0]->tanggal_sk; ?>">
							</div>
						</div>
						<div class="mb-3">
							<label class="small mb-1" for="pengirim">Nama Pengirim</label>
							<input name="pengirim" disabled class="form-control" id="pengirim" type="text" placeholder="Masukkan nama pengirim" value="<?php echo $surat_keluar[0]->pengirim; ?>"/>
						</div>
						<div class="mb-3">
							<label class="small mb-1" for="perihal">Perihal</label>
							<input name="perihal" disabled class="form-control" id="perihal" type="text" placeholder="Masukkan perihal" value="<?php echo $surat_keluar[0]->perihal; ?>"/>
						</div>
						<div class="mb-3">
							<label class="small mb-1" for="tujuan">Tujuan</label>
							<input name="tujuan" disabled class="form-control" id="tujuan" type="text" placeholder="Masukkan tujuan" value="<?php echo $surat_keluar[0]->tujuan; ?>"/>
						</div>
						<div class="mb-3">
							<label class="small mb-1" for="lampiran">Lampiran</label><br>
							<a href="<?php echo base_url(); ?>uploads/suratkeluar/<?php echo $surat_keluar[0]->lampiran; ?>" class="btn btn-dark btn-sm">Download</a>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
