<?php
/**
 * @var $errors
 * @var $message_success
 * @var $message_success_biodata
 * @var $message_success_password
 * @var $message_success_avatar
 * @var $biodata
 */

if (count($biodata) <= 0) {
	redirect(base_url().'dashboard');
}
?>
<div class="container-fluid">
	<div class="container-xl px-4 mt-4">
		<div class="row">
			<div class="col-xl-4">
				<div class="row">
					<div class="col-xl-12">
						<!-- Profile picture card-->
						<div class="card shadow mb-4 mb-xl-0">
							<div class="card-header">Ubah foto profile</div>
							<div class="card-body text-center">
								<?php if (isset($message_success_avatar)) { ?>
									<div class="alert alert-success">
										<?php echo $message_success_avatar; ?>
									</div>
								<?php } ?>
								<!-- Profile picture image-->
								<img class="img-account-profile rounded-circle mb-2" src="<?php base_url(); ?>assets/img/avatar/<?php echo $this->session->userdata('avatar'); ?>" style="height: 10rem;" alt="" />
								<!-- Profile picture help block-->
								<div class="small font-italic text-muted mb-4">JPG or PNG no larger than 5 MB</div>
								<input accept="image/png,image/jpg,image/jpeg" onchange="uploadAvatar()" type="file" hidden id="input-upload-avatar">
								<!-- Profile picture upload button-->
								<button class="btn btn-primary" id="button-upload-avatar" type="button">Ubah</button>
							</div>
						</div>
						<script>
							const avatarButton = document.getElementById('button-upload-avatar');
							const avatar = document.getElementById('input-upload-avatar');

							avatarButton.addEventListener('click', function () {
								avatar.click();
							});

							function uploadAvatar() {
								if (avatar.files.length <= 0) return;

								 const form = new FormData();
								 form.append('avatar', avatar.files[0]);
								 form.append('<?php echo $this->security->get_csrf_token_name();?>', '<?php echo $this->security->get_csrf_hash();?>');

								$.ajax({
									type: 'POST',
									url: '<?php base_url(); ?>biodata/image',
									contentType: false,
									processData: false,
									success: function (response, text, code) {
										if (code.status === 200) {
											window.location.reload();
										}
									},
									data: form
								})
							}
						</script>
					</div>
					<div class="col-xl-12 mt-4">
						<!-- Profile picture card-->
						<div class="card shadow mb-4 mb-xl-0">
							<div class="card-header">Ganti Password</div>
							<div class="card-body">
								<?php if (isset($message_success_password)) { ?>
									<div class="alert alert-success">
										<?php echo $message_success_password; ?>
									</div>
								<?php } ?>
								<form enctype="multipart/form-data" method="post" action="<?php echo base_url(); ?>biodata/password">
									<input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
									<div class="mb-3">
										<label class="small mb-1" for="old_password">Password lama</label>
										<input class="form-control" name="old_password" id="old_password" type="text" placeholder="Password lama" value="" />
										<?php if (isset($errors['old_password'])) {?>
											<span class="text text-danger"><?php echo $errors['old_password']; ?></span>
										<?php } ?>
									</div>
									<div class="mb-3">
										<label class="small mb-1" for="new_password">Password baru</label>
										<input class="form-control" name="new_password" id="new_password" type="text" placeholder="Password baru" value="" />
										<?php if (isset($errors['new_password'])) {?>
											<span class="text text-danger"><?php echo $errors['new_password']; ?></span>
										<?php } ?>
									</div>
									<div class="mb-3">
										<label class="small mb-1" for="repeat_new_password">Ulangi password baru</label>
										<input class="form-control" name="repeat_new_password" id="repeat_new_password" type="text" placeholder="Ulangi password baru" value="" />
										<?php if (isset($errors['repeat_new_password'])) {?>
											<span class="text text-danger"><?php echo $errors['repeat_new_password']; ?></span>
										<?php } ?>
									</div>
									<!-- Save changes button-->
									<button class="btn btn-primary" type="submit">Ubah</button>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xl-8">
				<div class="card shadow mb-4">
					<div class="card-header">Detail Biodata</div>
					<div class="card-body">
						<?php if (isset($message_success_biodata)) { ?>
							<div class="alert alert-success">
								<?php echo $message_success_biodata; ?>
							</div>
						<?php } ?>
						<form enctype="multipart/form-data" method="post" action="<?php echo base_url(); ?>biodata/biodata">
							<input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
							<div class="mb-3">
								<label class="small mb-1" for="username">Username</label>
								<input class="form-control" name="username" id="username" type="text" placeholder="Masukkan username" value="<?php echo $biodata[0]->username; ?>" />
								<?php if (isset($errors['username'])) {?>
									<span class="text text-danger"><?php echo $errors['username']; ?></span>
								<?php } ?>
							</div>
							<div class="mb-3">
								<label class="small mb-1" for="namalengkap">Nama lengkap</label>
								<input class="form-control" name="namalengkap" id="namalengkap" type="text" placeholder="Masukkan nama lengkap" value="<?php echo $biodata[0]->nama_lengkap; ?>" />
								<?php if (isset($errors['namalengkap'])) {?>
									<span class="text text-danger"><?php echo $errors['namalengkap']; ?></span>
								<?php } ?>
							</div>
							<div class="mb-3">
								<label class="small mb-1" for="email">Email</label>
								<input class="form-control" name="email" id="email" type="text" placeholder="Masukkan email" value="<?php echo $biodata[0]->email; ?>" />
								<?php if (isset($errors['email'])) {?>
									<span class="text text-danger"><?php echo $errors['email']; ?></span>
								<?php } ?>
							</div>
							<div class="mb-3">
								<label class="small mb-1" for="telp">Phone</label>
								<input class="form-control" name="telp" id="telp" type="text" placeholder="Masukkan nomor telepon" value="<?php echo $biodata[0]->phone; ?>" />
								<?php if (isset($errors['telp'])) {?>
									<span class="text text-danger"><?php echo $errors['telp']; ?></span>
								<?php } ?>
							</div>
							<button class="btn btn-primary" type="submit">Ubah</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
