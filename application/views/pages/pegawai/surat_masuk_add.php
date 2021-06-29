<?php
/**
 * @var $errors
 */
?>
<div class="container-fluid">
	<!-- Page Heading -->
	<div class="d-sm-flex flex-column align-items-start justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800 mb-3">Tambah Surat Masuk</h1>
	</div>
	<div class="row">
		<div class="col-lg-12">
			<!-- Change password card-->
			<div class="card shadow mb-4">
				<div class="card-header py-3">
					<h6 class="m-0 font-weight-bold text-primary">Input Data</h6>
				</div>
				<div class="card-body">
					<form enctype="multipart/form-data" method="post" action="<?php echo base_url(); ?>suratmasuk/create">
						<input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
						<div class="row gx-3 mb-3">
							<!-- Form Group (first name)-->
							<div class="col-md-9">
								<label class="small mb-1" for="nosurat">No Surat</label>
								<input name="nosurat" class="form-control" id="nosurat" type="text" placeholder="Masukkan no surat" value="">
								<?php if (isset($errors['nosurat'])) {?>
									<span class="text text-danger"><?php echo $errors['nosurat']; ?></span>
								<?php } ?>
							</div>
							<!-- Form Group (last name)-->
							<div class="col-md-3">
								<label class="small mb-1" for="tanggal">Tanggal</label>
								<input name="tanggal" class="form-control" id="tanggal" type="date" placeholder="Enter your last name" value="">
								<?php if (isset($errors['tanggal'])) {?>
									<span class="text text-danger"><?php echo $errors['tanggal']; ?></span>
								<?php } ?>
							</div>
						</div>
						<div class="mb-3">
							<label class="small mb-1" for="penerima">Nama Penerima</label>
							<input name="penerima" class="form-control" id="penerima" type="text" placeholder="Masukkan nama penerima" />
							<?php if (isset($errors['penerima'])) {?>
								<span class="text text-danger"><?php echo $errors['penerima']; ?></span>
							<?php } ?>
						</div>
						<div class="mb-3">
							<label class="small mb-1" for="perihal">Perihal</label>
							<input name="perihal" class="form-control" id="perihal" type="text" placeholder="Masukkan perihal" />
							<?php if (isset($errors['perihal'])) {?>
								<span class="text text-danger"><?php echo $errors['perihal']; ?></span>
							<?php } ?>
						</div>
						<div class="mb-3">
							<label class="small mb-1" for="telp">No Telepone</label>
							<input name="telp" class="form-control" id="telp" type="text" placeholder="Masukkan no telepone" />
							<?php if (isset($errors['telp'])) {?>
								<span class="text text-danger"><?php echo $errors['telp']; ?></span>
							<?php } ?>
						</div>
						<div class="mb-3">
							<label class="small mb-1" for="lampiran">Lampiran</label>
							<input name="lampiran" accept="application/pdf" class="form-control" id="lampiran" type="file" />
							<?php if (isset($errors['lampiran'])) {?>
								<span class="text text-danger"><?php echo $errors['lampiran']; ?></span>
							<?php } ?>
						</div>
						<button class="btn btn-primary" type="submit">Tambah</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
