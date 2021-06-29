<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

	<!-- Sidebar - Brand -->
	<a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
		<div class="sidebar-brand-icon rotate-n-15">
			<i class="fas fa-laugh-wink"></i>
		</div>
		<div class="sidebar-brand-text mx-3">SB Admin <sup>2</sup></div>
	</a>

	<!-- Divider -->
	<hr class="sidebar-divider my-0">

	<!-- Nav Item - Dashboard -->
	<li class="nav-item active">
		<a class="nav-link" href="index.html">
			<i class="fas fa-fw fa-home"></i>
			<span>Beranda</span>
		</a>
	</li>

<!--	<hr class="sidebar-divider">-->
<!---->
<!--	<div class="sidebar-heading">-->
<!--		Data-->
<!--	</div>-->
<!---->
<!--	<li class="nav-item">-->
<!--		<a class="nav-link" href="--><?php //base_url() ?><!--/pegawai">-->
<!--			<i class="fas fa-fw fa-user"></i>-->
<!--			<span>Data Pegawai</span>-->
<!--		</a>-->
<!--	</li>-->

	<hr class="sidebar-divider">

	<div class="sidebar-heading">
		Surat
	</div>

	<li class="nav-item">
		<a class="nav-link" href="<?php base_url() ?>/suratmasuk">
			<i class="fas fa-fw fa-envelope"></i>
			<span>Surat Masuk</span>
		</a>
	</li>

	<li class="nav-item">
		<a class="nav-link" href="<?php base_url() ?>/suratkeluar">
			<i class="fas fa-fw fa-envelope-open"></i>
			<span>Surat Keluar</span>
		</a>
	</li>

	<hr class="sidebar-divider d-none d-md-block">

	<li class="nav-item">
		<a class="nav-link" href="<?php base_url() ?>/laporan">
			<i class="fas fa-fw fa-print"></i>
			<span>Cetak Laporan</span>
		</a>
	</li>

	<div class="text-center d-none d-md-inline" style="margin: 10px;">
		<button style="width: 100%;" class="btn btn-danger btn-sm">Logout</button>
	</div>
</ul>
<!-- End of Sidebar -->
