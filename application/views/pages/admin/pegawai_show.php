<?php
/**
 * @var $pegawai
 */

if (count($pegawai) <= 0) {
	redirect(base_url().'pegawai');
}
?>
<div class="container-fluid">
	<!-- Page Heading -->
	<div class="d-sm-flex flex-column align-items-start justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800 mb-3">Lihat Pegawai</h1>
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
						<div class="mb-3">
							<label class="small mb-1" for="username">Username</label>
							<input name="username" disabled class="form-control" id="username" type="text" placeholder="Masukkan username" value="<?php echo $pegawai[0]->username; ?>"/>
						</div>
						<div class="mb-3">
							<label class="small mb-1" for="nama_lengkap">Nama Lengkap</label>
							<input name="nama_lengkap" disabled class="form-control" id="nama_lengkap" type="text" placeholder="Masukkan nama lengkap" value="<?php echo $pegawai[0]->nama_lengkap; ?>"/>
						</div>
						<div class="mb-3">
							<label class="small mb-1" for="email">Email</label>
							<input name="email" disabled class="form-control" id="email" type="email" placeholder="Masukkan email" value="<?php echo $pegawai[0]->email; ?>"/>
						</div>
						<div class="mb-3">
							<label class="small mb-1" for="telp">No Telepone</label>
							<input name="telp" disabled class="form-control" id="telp" type="text" placeholder="Masukkan no telepone" value="<?php echo $pegawai[0]->phone; ?>"/>
						</div>
						<div class="mb-3">
							<label class="small mb-1" for="alamat">Alamat</label>
							<textarea class="form-control" disabled name="alamat" id="alamat" cols="30" rows="10" >alamat not implemented yet</textarea>
						</div>
						<div class="mb-3">
							<label class="small mb-1" for="keahlian">Keahlian</label>
							<input name="keahlian" disabled class="form-control" id="keahlian" type="text" placeholder="Masukkan keahlian" value="keahlian not implemented yet"/>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
