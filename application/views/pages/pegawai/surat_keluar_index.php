<?php
/**
 * @var $errors
 * @var $message_success
 * @var $surat_keluar
 */
?>
<div class="container-fluid">

	<!-- Page Heading -->
	<div class="d-sm-flex flex-column align-items-start justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800 mb-3">Surat Keluar</h1>
		<a href="<?php base_url() ?>/suratkeluar/add" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> &nbsp; Tambah Surat Keluar</a>
	</div>
	<!-- Content Row -->

	<div class="row">

		<!-- Area Chart -->
		<div class="col-xl-12 col-lg-12 col-12">
			<div class="card shadow mb-4">
				<div class="card shadow mb-4">
					<div class="card-header py-3">
						<h6 class="m-0 font-weight-bold text-primary">Daftar Surat Keluar</h6>
					</div>
					<div class="card-body">
						<?php if (isset($message_success)) { ?>
							<div class="alert alert-success">
								<?php echo $message_success; ?>
							</div>
						<?php } ?>
						<div class="table-responsive">
							<div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
								<div class="row">
									<div class="col-sm-12">
										<table class="table table-bordered dataTable" id="dataTable" width="100%" cellspacing="0" role="grid" aria-describedby="dataTable_info" style="width: 100%;">
											<thead>
											<tr role="row">
												<th rowspan="1" colspan="1">No</th>
												<th rowspan="1" colspan="1">No Surat</th>
												<th rowspan="1" colspan="1">Perihal</th>
												<th rowspan="1" colspan="1">Pengirim</th>
												<th rowspan="1" colspan="1">Tanggal</th>
												<th rowspan="1" colspan="1">Aksi</th>
											</tr>
											</thead>
											<tfoot>
											<tr>
												<th rowspan="1" colspan="1">No</th>
												<th rowspan="1" colspan="1">No Surat</th>
												<th rowspan="1" colspan="1">Perihal</th>
												<th rowspan="1" colspan="1">Pengirim</th>
												<th rowspan="1" colspan="1">Tanggal</th>
												<th rowspan="1" colspan="1">Aksi</th>
											</tr>
											</tfoot>
											<tbody>
											<?php
											for ($i = 0; $i < count($surat_keluar); $i++) {
												?>
												<tr role="row" class="odd">
													<td><?php echo $i + 1; ?></td>
													<td class="sorting_1"><?php echo $surat_keluar[$i]->no_surat; ?></td>
													<td><?php echo $surat_keluar[$i]->perihal; ?></td>
													<td><?php echo $surat_keluar[$i]->pengirim; ?></td>
													<td><?php echo $surat_keluar[$i]->tanggal_sk; ?></td>
													<td>
														<a href="<?php base_url(); ?>suratkeluar/show/<?php echo $surat_keluar[$i]->id_sk; ?>" class="btn btn-primary btn-sm" type="button">Lihat</a>
														<a href="<?php base_url(); ?>suratkeluar/edit/<?php echo $surat_keluar[$i]->id_sk; ?>" class="btn btn-warning btn-sm" type="button">Ubah</a>
														<button data-surat="<?php echo $surat_keluar[$i]->no_surat; ?>" data-id="<?php echo $surat_keluar[$i]->id_sk; ?>" class="btn btn-danger btn-sm delete-button" type="button">Hapus</button>
													</td>
												</tr>
												<?php
											}
											?>
											</tbody>
										</table>
									</div>
								</div>
								<script>
									const buttons = document.getElementsByClassName('delete-button');
									for (const button of buttons) {
										button.addEventListener('click', function (evt) {
											const id = evt.target.getAttribute('data-id');
											const no = evt.target.getAttribute('data-surat');

											Swal.fire({
												title: `Hapus surat keluar dengan nomor ${no} ?`,
												text: "Surat akan dihapus secara permanen",
												icon: 'warning',
												showCancelButton: true,
												confirmButtonColor: '#e74a3b',
												confirmButtonText: 'Hapus',
												cancelButtonText: 'Batal'
											}).then((result) => {
												if (result.isConfirmed) {
													$.ajax({
														type: 'POST',
														url: '<?php base_url(); ?>suratkeluar/delete/' + id,
														success: function (response) {
															Swal.fire(
																	'Berhasil dihapus!',
																	response.message,
																	'success'
															).then(() => {
																window.location.reload();
															});
														},
														data: {
															csrf_test_name: '<?php echo $this->security->get_csrf_hash();?>'
														}
													});
												}
											})
										});
									}

									function deleteItem(event) {

									}
								</script>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- /.container-fluid -->
