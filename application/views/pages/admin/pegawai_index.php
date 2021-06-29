<!-- Begin Page Content -->
<div class="container-fluid">

	<!-- Page Heading -->
	<div class="d-sm-flex flex-column align-items-start justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800 mb-3">Data Pegawai</h1>
		<a href="<?php base_url() ?>/pegawai/add" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> &nbsp; Tambah Pegawai</a>
	</div>
	<!-- Content Row -->

	<div class="row">

		<!-- Area Chart -->
		<div class="col-xl-12 col-lg-12 col-12">
			<div class="card shadow mb-4">
				<div class="card shadow mb-4">
					<div class="card-header py-3">
						<h6 class="m-0 font-weight-bold text-primary">Daftar Pegawai</h6>
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
								<div class="row">
									<div class="col-sm-12">
										<table class="table table-bordered dataTable" id="dataTable" width="100%" cellspacing="0" role="grid" aria-describedby="dataTable_info" style="width: 100%;">
											<thead>
											<tr role="row">
												<th rowspan="1" colspan="1">No</th>
												<th rowspan="1" colspan="1">Id Pegawai</th>
												<th rowspan="1" colspan="1">Nama</th>
												<th rowspan="1" colspan="1">Email</th>
												<th rowspan="1" colspan="1">No Telepone</th>
												<th rowspan="1" colspan="1">Alamat</th>
												<th rowspan="1" colspan="1">Aksi</th>
											</tr>
											</thead>
											<tfoot>
											<tr>
												<th rowspan="1" colspan="1">No</th>
												<th rowspan="1" colspan="1">Id Pegawai</th>
												<th rowspan="1" colspan="1">Nama</th>
												<th rowspan="1" colspan="1">Email</th>
												<th rowspan="1" colspan="1">No Telepone</th>
												<th rowspan="1" colspan="1">Alamat</th>
												<th rowspan="1" colspan="1">Aksi</th>
											</tr>
											</tfoot>
											<tbody>
											<?php
												for ($i = 0; $i < 90; $i++) {
											?>
												<tr role="row" class="odd">
													<td class="sorting_1"><?php echo rand();?></td>
													<td>Accountant</td>
													<td>Tokyo</td>
													<td>33</td>
													<td>2008/11/28</td>
													<td>$162,700</td>
													<td>
														<button class="btn btn-primary btn-sm" type="button">Lihat</button>
														<button class="btn btn-warning btn-sm" type="button">Ubah</button>
														<button class="btn btn-danger btn-sm" type="button">Hapus</button>
													</td>
												</tr>
											<?php
												}
											?>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- /.container-fluid -->
