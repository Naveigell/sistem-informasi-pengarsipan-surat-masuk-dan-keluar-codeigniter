<?php
/**
 * @var $surat_masuk
 * @var $surat_keluar
 */
?>
<div class="container-fluid">
	<div class="row">

		<!-- Area Chart -->
		<div class="col-xl-12 col-lg-12 col-12">
			<div class="card shadow mb-4">
				<div class="card shadow mb-4">
					<div class="card-header py-3">
						<h6 class="m-0 font-weight-bold text-primary">Daftar Surat Keluar</h6>
					</div>
					<div class="card-body">
						<a href="<?php echo base_url(); ?>laporan/suratkeluar" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm mb-4"><i class="fas fa-print fa-sm text-white-50"></i> &nbsp; Cetak PDF</a>
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
												<th rowspan="1" colspan="1">Tanggal</th>
											</tr>
											</thead>
											<tfoot>
											<tr>
												<th rowspan="1" colspan="1">No</th>
												<th rowspan="1" colspan="1">No Surat</th>
												<th rowspan="1" colspan="1">Perihal</th>
												<th rowspan="1" colspan="1">Tanggal</th>
											</tr>
											</tfoot>
											<tbody>
											<?php
											for ($i = 0; $i < count($surat_keluar); $i++) {
												?>
												<tr role="row" class="odd">
													<td class="sorting_1"><?php echo $i + 1; ?></td>
													<td><?php echo $surat_keluar[$i]->no_surat; ?></td>
													<td><?php echo $surat_keluar[$i]->perihal; ?></td>
													<td><?php echo $surat_keluar[$i]->tanggal_sk; ?></td>
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
	<div class="row">

		<!-- Area Chart -->
		<div class="col-xl-12 col-lg-12 col-12">
			<div class="card shadow mb-4">
				<div class="card shadow mb-4">
					<div class="card-header py-3">
						<h6 class="m-0 font-weight-bold text-primary">Daftar Surat Masuk</h6>
					</div>
					<div class="card-body">
						<a href="<?php echo base_url(); ?>laporan/suratmasuk" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm mb-4"><i class="fas fa-print fa-sm text-white-50"></i> &nbsp; Cetak PDF</a>
						<div class="table-responsive">
							<div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
								<div class="row">
									<div class="col-sm-12">
										<table class="table table-bordered dataTable" id="dataTable2" width="100%" cellspacing="0" role="grid" aria-describedby="dataTable_info" style="width: 100%;">
											<thead>
											<tr role="row">
												<th rowspan="1" colspan="1">No</th>
												<th rowspan="1" colspan="1">No Surat</th>
												<th rowspan="1" colspan="1">Perihal</th>
												<th rowspan="1" colspan="1">Tanggal</th>
											</tr>
											</thead>
											<tfoot>
											<tr>
												<th rowspan="1" colspan="1">No</th>
												<th rowspan="1" colspan="1">No Surat</th>
												<th rowspan="1" colspan="1">Perihal</th>
												<th rowspan="1" colspan="1">Tanggal</th>
											</tr>
											</tfoot>
											<tbody>
											<?php
											for ($i = 0; $i < count($surat_masuk); $i++) {
												?>
												<tr role="row" class="odd">
													<td class="sorting_1"><?php echo $i + 1; ?></td>
													<td><?php echo $surat_masuk[$i]->no_surat; ?></td>
													<td><?php echo $surat_masuk[$i]->perihal; ?></td>
													<td><?php echo $surat_masuk[$i]->tanggal_sm; ?></td>
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
