<div class="container-fluid">
	<!-- Page Heading -->
	<div class="d-sm-flex flex-column align-items-start justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800 mb-3">Tambah Pegawai</h1>
	</div>
	<div class="row">
		<div class="col-lg-12">
			<!-- Change password card-->
			<div class="card shadow mb-4">
				<div class="card-header py-3">
					<h6 class="m-0 font-weight-bold text-primary">Input Data</h6>
				</div>
				<div class="card-body">
					<form enctype="application/x-www-form-urlencoded" method="post" action="<?php echo base_url(); ?>pegawai/create">
						<input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
						<div class="mb-3">
							<label class="small mb-1" for="username">Username</label>
							<input name="username" class="form-control" id="username" type="text" placeholder="Masukkan username" />
							<?php if (isset($errors['username'])) {?>
								<span class="text text-danger"><?php echo $errors['username']; ?></span>
							<?php } ?>
						</div>
						<div class="mb-3">
							<label class="small mb-1" for="nama_lengkap">Nama Lengkap</label>
							<input name="nama_lengkap" class="form-control" id="nama_lengkap" type="text" placeholder="Masukkan nama lengkap" />
							<?php if (isset($errors['nama_lengkap'])) {?>
								<span class="text text-danger"><?php echo $errors['nama_lengkap']; ?></span>
							<?php } ?>
						</div>
						<div class="mb-3">
							<label class="small mb-1" for="email">Email</label>
							<input name="email" class="form-control" id="email" type="email" placeholder="Masukkan email" />
							<?php if (isset($errors['email'])) {?>
								<span class="text text-danger"><?php echo $errors['email']; ?></span>
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
							<label class="small mb-1" for="alamat">Alamat</label>
							<textarea class="form-control" name="alamat" id="alamat" cols="30" rows="10"></textarea>
							<?php if (isset($errors['alamat'])) {?>
								<span class="text text-danger"><?php echo $errors['alamat']; ?></span>
							<?php } ?>
						</div>
						<div class="mb-3">
							<label class="small mb-1" for="keahlian">Keahlian</label>
							<input name="keahlian" class="form-control" id="keahlian" type="text" placeholder="Masukkan keahlian" />
							<?php if (isset($errors['keahlian'])) {?>
								<span class="text text-danger"><?php echo $errors['keahlian']; ?></span>
							<?php } ?>
						</div>
						<button class="btn btn-primary" type="submit">Simpan</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
