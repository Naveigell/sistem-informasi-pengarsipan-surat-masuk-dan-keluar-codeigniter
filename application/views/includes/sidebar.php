<?php
/**
 * @var CI_Session $session
 */
?>
<style>
	@media (max-width: 768px) {
		.sidebar-brand-icon {
			/*visibility: hidden;*/
			height: 55px !important;
		}

		.sidebar-brand {
			margin-top: 0 !important;
			margin-bottom: 10px !important;
		}
	}

	.sidebar-brand {
		margin-top: 40px;
		margin-bottom: 50px;
	}
</style>
<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

	<!-- Sidebar - Brand -->
	<a class="sidebar-brand d-flex align-items-center justify-content-center">
		<div class="sidebar-brand-icon" style="height: 140px; background: transparent; width: 100%;">
			<img src="<?= base_url(); ?>assets/img/logo/logo.png" height="100%" width="100%" alt="">
		</div>
	</a>

	<!-- Divider -->
	<hr class="sidebar-divider my-0">

	<!-- Nav Item - Dashboard -->
	<li class="nav-item active">
		<a class="nav-link" href="<?= base_url() ?>">
			<i class="fas fa-fw fa-home"></i>
			<span>Beranda</span>
		</a>
	</li>
	<?php
		if ($this->session->userdata('role') == "admin") {
	?>
	<hr class="sidebar-divider">

	<div class="sidebar-heading">
		Data
	</div>

	<li class="nav-item">
		<a class="nav-link" href="<?= base_url() ?>/pegawai">
			<i class="fas fa-fw fa-user"></i>
			<span>Data Pegawai</span>
		</a>
	</li>

	<?php } else if ($this->session->userdata('role') == "pegawai") { ?>

	<hr class="sidebar-divider">

	<div class="sidebar-heading">
		Surat
	</div>

	<li class="nav-item">
		<a class="nav-link" href="<?= base_url() ?>/suratmasuk">
			<i class="fas fa-fw fa-envelope"></i>
			<span>Surat Masuk</span>
		</a>
	</li>

	<li class="nav-item">
		<a class="nav-link" href="<?= base_url() ?>/suratkeluar">
			<i class="fas fa-fw fa-envelope-open"></i>
			<span>Surat Keluar</span>
		</a>
	</li>

	<hr class="sidebar-divider d-none d-md-block">

	<li class="nav-item">
		<a class="nav-link" href="<?= base_url() ?>/laporan">
			<i class="fas fa-fw fa-print"></i>
			<span>Cetak Laporan</span>
		</a>
	</li>

	<?php } ?>

	<hr class="sidebar-divider">

	<div class="sidebar-heading">
		Account
	</div>

	<li class="nav-item">
		<a class="nav-link" href="<?= base_url() ?>biodata">
			<i class="fas fa-fw fa-cogs"></i>
			<span>Biodata</span>
		</a>
	</li>

	<div class="text-center d-none d-md-inline" style="margin: 10px;">
		<a href="<?= base_url(); ?>logout" style="width: 100%;" class="btn btn-danger btn-sm">Logout</a>
	</div>
</ul>
<!-- End of Sidebar -->
