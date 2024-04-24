<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<title>@yield('title')</title>
	<meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
	<link rel="icon" href="{{ url('assets/img/logoera.png') }}" type="image/x-icon"/>

	<!-- Fonts and icons -->
	<script src="{{ url('assets/js/plugin/webfont/webfont.min.js') }}"></script>
	<script>
		WebFont.load({
			google: {"families":["Lato:300,400,700,900"]},
			custom: {"families":["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"], urls: ['{{ url('assets/css/fonts.min.css') }}']},
			active: function() {
				sessionStorage.fonts = true;
			}
		});
	</script>
	<!-- CSS Files -->
	<link rel="stylesheet" href="{{ url('assets/css/bootstrap.min.css') }}">
	<link rel="stylesheet" href="{{ url('assets/css/atlantis.css') }}">
	<!-- CSS Just for demo purpose, don't include it in your project -->
	<link rel="stylesheet" href="{{ url('assets/css/demo.css') }}">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
</head>
<body>
    @include('sweetalert::alert', ['cdn' => "https://cdn.jsdelivr.net/npm/sweetalert2@9"])
	<div class="wrapper">
		<div class="main-header">
			<!-- Logo Header -->
			<div class="logo-header" data-background-color="blue">

				<a href="{{ route('dashboard') }}" class="logo">
					<img src="{{ url('assets/img/kemenkop/kemenkop.png') }}" alt="navbar brand" class="navbar-brand" width="150px" height="50px">
				</a>
				<button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon">
						<i class="icon-menu"></i>
					</span>
				</button>
				<button class="topbar-toggler more"><i class="icon-options-vertical"></i></button>
				<div class="nav-toggle">
					<button class="btn btn-toggle toggle-sidebar">
						<i class="icon-menu"></i>
					</button>
				</div>
			</div>
			<!-- End Logo Header -->

			<!-- Navbar Header -->
			<nav class="navbar navbar-header navbar-expand-lg" data-background-color="blue2">

				<div class="container-fluid">
                    <ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
						<li class="nav-item dropdown hidden-caret">
							<a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false">
								<div class="avatar-sm">
									<img src="../assets/img/profile.jpg" alt="..." class="avatar-img rounded-circle">
								</div>
							</a>
							<ul class="dropdown-menu dropdown-user animated fadeIn">
								<div class="dropdown-user-scroll scrollbar-outer">
									<li>
										<div class="user-box">
											<div class="avatar-lg"><img src="../assets/img/profile.jpg" alt="image profile" class="avatar-img rounded"></div>
											<div class="u-text">
												<h4>{{ Auth::user()->name }}</h4>
												<p class="text-muted">hello@example.com</p>
											</div>
										</div>
									</li>
									<li>
										<div class="dropdown-divider"></div>
										<a class="dropdown-item" href="{{ url('admin/profile/'.auth()->user()->id) }}">My Profile</a>
										<div class="dropdown-divider"></div>
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <a class="dropdown-item" href="route('logout')"
                                            onclick="event.preventDefault();
                                            this.closest('form').submit();">{{ __('Logout') }}</a>
                                        </form>
									</li>
								</div>
							</ul>
						</li>
					</ul>
				</div>
			</nav>
			<!-- End Navbar -->
		</div>

		<!-- Sidebar -->
		<div class="sidebar sidebar-style-2">
			<div class="sidebar-wrapper scrollbar scrollbar-inner">
				<div class="sidebar-content">
					<ul class="nav nav-primary">
                        @if (auth()->user()->can('Dashboard'))
                        <li class="nav-item {{ request()->is('dashboard') || request()->is('dashboard/*') ? 'active' : '' }}">
							<a href="{{ route('dashboard') }}">
								<i class="fas fa-home"></i>
								<p>Dashboard</p>
							</a>
						</li>
                        @endif

                        @if (auth()->user()->can('Data Staff', 'Data Jabatan'))
                        <li class="nav-section">
							<span class="sidebar-mini-icon">
								<i class="fa fa-ellipsis-h"></i>
							</span>
                            <h4 class="text-section">Master Data</h4>
						</li>

                        <li class="nav-item {{ request()->is('staff') || request()->is('staff/*') || request()->is('jabatan') || request()->is('jabatan/*') ? 'active' : '' }}">
							<a data-toggle="collapse" href="#staff">
								<i class="fas fa-hand-holding-usd"></i>
								<p>Data Staff</p>
								<span class="caret"></span>
							</a>
							<div class="{{ request()->is('staff') || request()->is('staff/*') || request()->is('jabatan') || request()->is('jabatan/*') ? 'collapse show' : 'collapse' }}" id="staff">
								<ul class="nav nav-collapse">
									<li class="nav-item {{ request()->is('staff') || request()->is('staff/*') ? 'active' : '' }}">
										<a href="{{ route('staff') }}">
											<span class="sub-item">Staff</span>
										</a>
									</li>
									<li class="nav-item {{ request()->is('jabatan') || request()->is('jabatan/*') ? 'active' : '' }}">
										<a href="{{ route('jabatan') }}">
											<span class="sub-item">Jabatan</span>
										</a>
									</li>
								</ul>
							</div>
						</li>
                        @endif
                        @if (auth()->user()->can('Mata Anggaran Akun'))
                        <li class="nav-item {{ request()->is('mak') || request()->is('mak/*') ? 'active' : '' }}">
                            <a href="{{ route('mak') }}">
								<i class="fas fa-plane-departure"></i>
								<p>Mata Anggaran Akun</p>
							</a>
						</li>
                        @endif
                        @if (auth()->user()->can('Mata Anggaran Akun'))
                        <li class="nav-item {{ request()->is('uang_harian') || request()->is('uang_harian/*') ? 'active' : '' }}">
                            <a href="{{ route('uang_harian') }}">
								<i class="fas fa-plane-departure"></i>
								<p>Uang Harian</p>
							</a>
						</li>
                        @endif
						<li class="nav-item {{ request()->is('rekap-data') || request()->is('rekap-data/*') ? 'active' : '' }}">
                            <a href="{{ route('rekap-data') }}">
								<i class="fas fa-plane-departure"></i>
								<p>Rekap Data Perjalanan</p>
							</a>
						</li>
                        @if (auth()->user()->can('Perjalanan'))
                        <li class="nav-section">
							<span class="sidebar-mini-icon">
								<i class="fa fa-ellipsis-h"></i>
							</span>
                            <h4 class="text-section">Perjalanan</h4>
						</li>
                        @endif
                        @if (auth()->user()->can('Pengajuan'))
                        <li class="nav-item {{ request()->is('pengajuan') || request()->is('pengajuan/*') ? 'active' : '' }}">
                            <a href="{{ route('pengajuan') }}">
								<i class="fas fa-plane-departure"></i>
								<p>Pengajuan</p>
							</a>
						</li>
                        @endif
                        @if (auth()->user()->can('Data Perjalanan'))
                        <li class="nav-item {{ request()->is('data-perjalanan') || request()->is('data-perjalanan/*') ? 'active' : '' }}">
                            <a href="{{ route('dataPerjalanan') }}">
								<i class="fas fa-plane-departure"></i>
								<p>Data Perjalanan</p>
							</a>
						</li>
                        @endif						
                        @if (auth()->user()->can('Nota Dinas', 'SPT', 'SPD'))
                        <li class="nav-section">
							<span class="sidebar-mini-icon">
								<i class="fa fa-ellipsis-h"></i>
							</span>
                            <h4 class="text-section">Surat Pre-Perjalanan</h4>
						</li>
                        <li class="nav-item {{ request()->is('nota-dinas') || request()->is('nota-dinas/*') ? 'active' : '' }}">
							<a href="{{ route('nota-dinas') }}">
								<i class="fas fa-file-invoice"></i>
								<p>Nota Dinas</p>
							</a>
						</li>
                        <li class="nav-item {{ request()->is('surat-perintah-tugas') || request()->is('surat-perintah-tugas/*') ? 'active' : '' }}">
                            <a href="{{ route('spt') }}">
								<i class="fas fa-file-signature"></i>
								<p>SPT</p>
                            </a>
						</li>
                        <li class="nav-item {{ request()->is('surat-perjalanan-dinas') || request()->is('surat-perjalanan-dinas/*') ? 'active' : '' }}">
                            <a href="{{ route('spd') }}">
								<i class="fas fa-file-signature"></i>
								<p>SPD</p>
                            </a>
						</li>
                        @endif
                        @if (auth()->user()->can('Bukti Invoice'))
						<li class="nav-section">
							<span class="sidebar-mini-icon">
								<i class="fa fa-ellipsis-h"></i>
							</span>
							<h4 class="text-section">Surat Pra-Perjalanan</h4>
						</li>

                        <li class="nav-item {{ request()->is('bukti-perjalanan') || request()->is('bukti-perjalanan/*') ? 'active' : '' }}">
                            <a href="{{ route('bukti')}}">
                                <i class="fas fa-file-invoice"></i>
                                <p>Bukti Invoice</p>
                            </a>
                        </li>
                        @endif
                        @if (auth()->user()->can('Laporan' || 'Gallery Foto'))
                        <li class="nav-item {{ request()->is('laporan') || request()->is('laporan/*') || request()->is('gallery') || request()->is('gallery/*') || request()->is('geo-tagging') || request()->is('geo-tagging/*') ? 'active' : '' }}">
							<a data-toggle="collapse" href="#upload_laporan">
								<i class="fas fa-hand-holding-usd"></i>
								<p>Dokumentasi</p>
								<span class="caret"></span>
							</a>
							<div class="{{ request()->is('laporan') || request()->is('laporan/*') || request()->is('gallery') || request()->is('gallery/*') || request()->is('geo-tagging') || request()->is('geo-tagging/*') ? 'collapse show' : 'collapse' }}" id="upload_laporan">
								<ul class="nav nav-collapse">
									<li class="nav-item {{ request()->is('laporan') || request()->is('laporan/*') ? 'active' : '' }}">
										<a href="{{ route('laporan') }}">
											<span class="sub-item">Laporan</span>
										</a>
									</li>
									<li class="nav-item {{ request()->is('gallery') || request()->is('gallery/*') ? 'active' : '' }}">
										<a href="{{ route('gallery') }}">
											<span class="sub-item">Gallery Foto</span>
										</a>
									</li>
                                    <li class="nav-item {{ request()->is('geo-tagging') || request()->is('geo-tagging/*') ? 'active' : '' }}">
										<a href="{{ route('geo-tagging') }}">
											<span class="sub-item">Geo Tagging</span>
										</a>
									</li>
								</ul>
							</div>
						</li>
                        @endif
                        @if (auth()->user()->can('Kwitansi'))
                        <li class="nav-item {{ request()->is('kwitansi') || request()->is('kwitansi/*') ? 'active' : '' }}">
							<a href="{{ route('kwitansi' )}}">
								<i class="fas fa-file-invoice-dollar"></i>
								<p>Kwitansi</p>
							</a>
						</li>
                        @endif
                        @if (auth()->user()->can('User' || 'Role'))
                        <li class="nav-section">
							<span class="sidebar-mini-icon">
								<i class="fa fa-ellipsis-h"></i>
							</span>
                            <h4 class="text-section">Management User</h4>
						</li>
                        <li class="nav-item {{ request()->is('role') || request()->is('role/*') ? 'active' : '' }}">
                            <a href="{{ route('role') }}">
								<i class="fas fa-plane-departure"></i>
								<p>Role</p>
							</a>
						</li>
                        <li class="nav-item {{ request()->is('user') || request()->is('user/*') ? 'active' : '' }}">
                            <a href="{{ route('user') }}">
								<i class="fas fa-plane-departure"></i>
								<p>User</p>
							</a>
						</li>
                        @endif
					</ul>
				</div>
			</div>
		</div>
		<!-- End Sidebar -->
        <div class="main-panel">
            @yield('content')
            @stack('end_of_content')
            <footer class="footer">
				<div class="container-fluid">
					<nav class="pull-left">
						<ul class="nav">
							<li class="nav-item">
								<a class="nav-link" href="http://www.themekita.com">
									ThemeKita
								</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="#">
									Help
								</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="#">
									Licenses
								</a>
							</li>
						</ul>
					</nav>
					<div class="copyright ml-auto">
						Kementrian Koperasi dan UMKM &copy; 2023
					</div>
				</div>
			</footer>
        </div>

		<div class="quick-sidebar">
			<div class="quick-sidebar-wrapper">
				<div class="tab-content mt-3">
					<div class="tab-pane fade" id="tasks" role="tabpanel">
						<div class="quick-wrapper tasks-wrapper">
							<div class="tasks-scroll scrollbar-outer">
								<div class="tasks-content">
									<span class="category-title mt-0">Today</span>
									<ul class="tasks-list">
										<li>
											<label class="custom-checkbox custom-control checkbox-secondary">
												<input type="checkbox" checked="" class="custom-control-input"><span class="custom-control-label">Planning new project structure</span>
												<span class="task-action">
													<a href="#" class="link text-danger">
														<i class="flaticon-interface-5"></i>
													</a>
												</span>
											</label>
										</li>
										<li>
											<label class="custom-checkbox custom-control checkbox-secondary">
												<input type="checkbox" class="custom-control-input"><span class="custom-control-label">Create the main structure							</span>
												<span class="task-action">
													<a href="#" class="link text-danger">
														<i class="flaticon-interface-5"></i>
													</a>
												</span>
											</label>
										</li>
										<li>
											<label class="custom-checkbox custom-control checkbox-secondary">
												<input type="checkbox" class="custom-control-input"><span class="custom-control-label">Add new Post</span>
												<span class="task-action">
													<a href="#" class="link text-danger">
														<i class="flaticon-interface-5"></i>
													</a>
												</span>
											</label>
										</li>
										<li>
											<label class="custom-checkbox custom-control checkbox-secondary">
												<input type="checkbox" class="custom-control-input"><span class="custom-control-label">Finalise the design proposal</span>
												<span class="task-action">
													<a href="#" class="link text-danger">
														<i class="flaticon-interface-5"></i>
													</a>
												</span>
											</label>
										</li>
									</ul>

									<span class="category-title">Tomorrow</span>
									<ul class="tasks-list">
										<li>
											<label class="custom-checkbox custom-control checkbox-secondary">
												<input type="checkbox" class="custom-control-input"><span class="custom-control-label">Initialize the project							</span>
												<span class="task-action">
													<a href="#" class="link text-danger">
														<i class="flaticon-interface-5"></i>
													</a>
												</span>
											</label>
										</li>
										<li>
											<label class="custom-checkbox custom-control checkbox-secondary">
												<input type="checkbox" class="custom-control-input"><span class="custom-control-label">Create the main structure							</span>
												<span class="task-action">
													<a href="#" class="link text-danger">
														<i class="flaticon-interface-5"></i>
													</a>
												</span>
											</label>
										</li>
										<li>
											<label class="custom-checkbox custom-control checkbox-secondary">
												<input type="checkbox" class="custom-control-input"><span class="custom-control-label">Updates changes to GitHub							</span>
												<span class="task-action">
													<a href="#" class="link text-danger">
														<i class="flaticon-interface-5"></i>
													</a>
												</span>
											</label>
										</li>
										<li>
											<label class="custom-checkbox custom-control checkbox-secondary">
												<input type="checkbox" class="custom-control-input"><span title="This task is too long to be displayed in a normal space!" class="custom-control-label">This task is too long to be displayed in a normal space!				</span>
												<span class="task-action">
													<a href="#" class="link text-danger">
														<i class="flaticon-interface-5"></i>
													</a>
												</span>
											</label>
										</li>
									</ul>

									<div class="mt-3">
										<div class="btn btn-primary btn-rounded btn-sm">
											<span class="btn-label">
												<i class="fa fa-plus"></i>
											</span>
											Add Task
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Custom template | don't include it in your project! -->
		<div class="custom-template">
			<div class="title">Settings</div>
			<div class="custom-content">
				<div class="switcher">
					<div class="switch-block">
						<h4>Logo Header</h4>
						<div class="btnSwitch">
							<button type="button" class="changeLogoHeaderColor" data-color="dark"></button>
							<button type="button" class="selected changeLogoHeaderColor" data-color="blue"></button>
							<button type="button" class="changeLogoHeaderColor" data-color="purple"></button>
							<button type="button" class="changeLogoHeaderColor" data-color="light-blue"></button>
							<button type="button" class="changeLogoHeaderColor" data-color="green"></button>
							<button type="button" class="changeLogoHeaderColor" data-color="orange"></button>
							<button type="button" class="changeLogoHeaderColor" data-color="red"></button>
							<button type="button" class="changeLogoHeaderColor" data-color="white"></button>
							<br/>
							<button type="button" class="changeLogoHeaderColor" data-color="dark2"></button>
							<button type="button" class="changeLogoHeaderColor" data-color="blue2"></button>
							<button type="button" class="changeLogoHeaderColor" data-color="purple2"></button>
							<button type="button" class="changeLogoHeaderColor" data-color="light-blue2"></button>
							<button type="button" class="changeLogoHeaderColor" data-color="green2"></button>
							<button type="button" class="changeLogoHeaderColor" data-color="orange2"></button>
							<button type="button" class="changeLogoHeaderColor" data-color="red2"></button>
						</div>
					</div>
					<div class="switch-block">
						<h4>Navbar Header</h4>
						<div class="btnSwitch">
							<button type="button" class="changeTopBarColor" data-color="dark"></button>
							<button type="button" class="changeTopBarColor" data-color="blue"></button>
							<button type="button" class="changeTopBarColor" data-color="purple"></button>
							<button type="button" class="changeTopBarColor" data-color="light-blue"></button>
							<button type="button" class="changeTopBarColor" data-color="green"></button>
							<button type="button" class="changeTopBarColor" data-color="orange"></button>
							<button type="button" class="changeTopBarColor" data-color="red"></button>
							<button type="button" class="changeTopBarColor" data-color="white"></button>
							<br/>
							<button type="button" class="changeTopBarColor" data-color="dark2"></button>
							<button type="button" class="selected changeTopBarColor" data-color="blue2"></button>
							<button type="button" class="changeTopBarColor" data-color="purple2"></button>
							<button type="button" class="changeTopBarColor" data-color="light-blue2"></button>
							<button type="button" class="changeTopBarColor" data-color="green2"></button>
							<button type="button" class="changeTopBarColor" data-color="orange2"></button>
							<button type="button" class="changeTopBarColor" data-color="red2"></button>
						</div>
					</div>
					<div class="switch-block">
						<h4>Sidebar</h4>
						<div class="btnSwitch">
							<button type="button" class="selected changeSideBarColor" data-color="white"></button>
							<button type="button" class="changeSideBarColor" data-color="dark"></button>
							<button type="button" class="changeSideBarColor" data-color="dark2"></button>
						</div>
					</div>
					<div class="switch-block">
						<h4>Background</h4>
						<div class="btnSwitch">
							<button type="button" class="changeBackgroundColor" data-color="bg2"></button>
							<button type="button" class="changeBackgroundColor selected" data-color="bg1"></button>
							<button type="button" class="changeBackgroundColor" data-color="bg3"></button>
							<button type="button" class="changeBackgroundColor" data-color="dark"></button>
						</div>
					</div>
				</div>
			</div>
			<div class="custom-toggle">
				<i class="flaticon-settings"></i>
			</div>
		</div>
		<!-- End Custom template -->
	</div>
	<!--   Core JS Files   -->
	<script src="{{ url('assets/js/core/jquery.3.2.1.min.js') }}"></script>
	<script src="{{ url('assets/js/core/popper.min.js') }}"></script>
	<script src="{{ url('assets/js/core/bootstrap.min.js') }}"></script>
	<!-- jQuery UI -->
	<script src="{{ url('assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js') }}"></script>
	<script src="{{ url('assets/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js') }}"></script>
    <!-- Bootstrap Toggle -->
	<script src="{{ url('assets/js/plugin/bootstrap-toggle/bootstrap-toggle.min.js') }}"></script>
	<!-- jQuery Scrollbar -->
	<script src="{{ url('assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js') }}"></script>
    <!-- Magnific Popup -->
	<script src="{{ url('assets/js/plugin/jquery.magnific-popup/jquery.magnific-popup.min.js') }}"></script>
	<!-- Atlantis JS -->
	<script src="{{ url('assets/js/atlantis.min.js') }}"></script>
	<!-- Atlantis DEMO methods, don't include it in your project! -->
	<script src="{{ url('assets/js/setting-demo2.js') }}"></script>
    <!-- Moment JS -->
	<script src="{{ url('assets/js/plugin/moment/moment.min.js') }}"></script>
	<!-- Chart JS -->
	<script src="{{ url('assets/js/plugin/chart.js/chart.min.js') }}"></script>
	<!-- jQuery Sparkline -->
	<script src="{{ url('assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js') }}"></script>
	<!-- Chart Circle -->
	<script src="{{ url('assets/js/plugin/chart-circle/circles.min.js') }}"></script>
	<!-- Datatables -->
	<script src="{{ url('assets/js/plugin/datatables/datatables.min.js') }}"></script>
	{{-- <!-- Bootstrap Notify -->
	<script src="{{ url('assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js') }}"></script> --}}
	<!-- Bootstrap Toggle -->
	<script src="{{ url('assets/js/plugin/bootstrap-toggle/bootstrap-toggle.min.js') }}"></script>
	<!-- jQuery Vector Maps -->
	<script src="{{ url('assets/js/plugin/jqvmap/jquery.vmap.min.js') }}"></script>
	<script src="{{ url('assets/js/plugin/jqvmap/maps/jquery.vmap.world.js') }}"></script>
	<!-- Google Maps Plugin -->
	<script src="{{ url('assets/js/plugin/gmaps/gmaps.js') }}"></script>
	<!-- Dropzone -->
	<script src="{{ url('assets/js/plugin/dropzone/dropzone.min.js') }}"></script>
	<!-- Fullcalendar -->
	<script src="{{ url('assets/js/plugin/fullcalendar/fullcalendar.min.js') }}"></script>
	<!-- DateTimePicker -->
	<script src="{{ url('assets/js/plugin/datepicker/bootstrap-datetimepicker.min.js') }}"></script>
	<!-- Bootstrap Tagsinput -->
	<script src="{{ url('assets/js/plugin/bootstrap-tagsinput/bootstrap-tagsinput.min.js') }}"></script>
	<!-- Bootstrap Wizard -->
	<script src="{{ url('assets/js/plugin/bootstrap-wizard/bootstrapwizard.js') }}"></script>
	<!-- jQuery Validation -->
	<script src="{{ url('assets/js/plugin/jquery.validate/jquery.validate.min.js') }}"></script>
	<!-- Summernote -->
	<script src="{{ url('assets/js/plugin/summernote/summernote-bs4.min.js') }}"></script>
	<!-- Select2 -->
	<script src="{{ url('assets/js/plugin/select2/select2.full.min.js') }}"></script>
	<!-- Sweet Alert -->
	<script src="{{ url('assets/js/plugin/sweetalert/sweetalert.min.js') }}"></script>
	<!-- Owl Carousel -->
	<script src="{{ url('assets/js/plugin/owl-carousel/owl.carousel.min.js') }}"></script>
	<!-- Magnific Popup -->
	<script src="{{ url('assets/js/plugin/jquery.magnific-popup/jquery.magnific-popup.min.js') }}"></script>
	<!-- Atlantis JS -->
	<script src="{{ url('assets/js/atlantis.min.js') }}"></script>
	<!-- Atlantis DEMO methods, don't include it in your project! -->
	<script src="{{ url('assets/js/setting-demo.js') }}"></script>
	<script src="{{ url('assets/js/demo.js') }}"></script>
	<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        function formatIndonesianDate(date) {
            const months = [
                "Januari", "Februari", "Maret", "April", "Mei", "Juni",
                "Juli", "Agustus", "September", "Oktober", "November", "Desember"
            ];

            var date = new Date(date);
            const day = date.getDate();
            const month = months[date.getMonth()];
            const year = date.getFullYear();

            return `${day} ${month} ${year}`;
        }

		$(function () {
			$('select.select2').select2(
                {
                    theme: 'bootstrap',
                    width: '100%',
                }
            );


			$.ajaxSetup({
    		    headers: {
    		        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
    		    },
    		    timeout: 86400,
    		});
		});

		Circles.create({
			id:'circles-1',
			radius:45,
			value:60,
			maxValue:100,
			width:7,
			text: 5,
			colors:['#f1f1f1', '#FF9E27'],
			duration:400,
			wrpClass:'circles-wrp',
			textClass:'circles-text',
			styleWrapper:true,
			styleText:true
		})

		Circles.create({
			id:'circles-2',
			radius:45,
			value:70,
			maxValue:100,
			width:7,
			text: 36,
			colors:['#f1f1f1', '#2BB930'],
			duration:400,
			wrpClass:'circles-wrp',
			textClass:'circles-text',
			styleWrapper:true,
			styleText:true
		})

		Circles.create({
			id:'circles-3',
			radius:45,
			value:40,
			maxValue:100,
			width:7,
			text: 12,
			colors:['#f1f1f1', '#F25961'],
			duration:400,
			wrpClass:'circles-wrp',
			textClass:'circles-text',
			styleWrapper:true,
			styleText:true
		})

		var totalIncomeChart = document.getElementById('totalIncomeChart').getContext('2d');

		var mytotalIncomeChart = new Chart(totalIncomeChart, {
			type: 'bar',
			data: {
				labels: ["S", "M", "T", "W", "T", "F", "S", "S", "M", "T"],
				datasets : [{
					label: "Total Income",
					backgroundColor: '#ff9e27',
					borderColor: 'rgb(23, 125, 255)',
					data: [6, 4, 9, 5, 4, 6, 4, 3, 8, 10],
				}],
			},
			options: {
				responsive: true,
				maintainAspectRatio: false,
				legend: {
					display: false,
				},
				scales: {
					yAxes: [{
						ticks: {
							display: false //this will remove only the label
						},
						gridLines : {
							drawBorder: false,
							display : false
						}
					}],
					xAxes : [ {
						gridLines : {
							drawBorder: false,
							display : false
						}
					}]
				},
			}
		});

		$('#lineChart').sparkline([105,103,123,100,95,105,115], {
			type: 'line',
			height: '70',
			width: '100%',
			lineWidth: '2',
			lineColor: '#ffa534',
			fillColor: 'rgba(255, 165, 52, .14)'
		});
	</script>
    @stack('js')
</body>
</html>
