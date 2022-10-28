
<!DOCTYPE html>
<html lang="en">
<head>
	<title><?= $data['page_tag'] ?></title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="<?= media() ?>/atencion/images/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= media() ?>/atencion/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= media() ?>/atencion/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= media() ?>/atencion/fonts/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= media() ?>/atencion/fonts/linearicons-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= media() ?>/atencion/vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="<?= media() ?>/atencion/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= media() ?>/atencion/vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= media() ?>/atencion/vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="<?= media() ?>/atencion/vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= media() ?>/atencion/vendor/slick/slick.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= media() ?>/atencion/vendor/MagnificPopup/magnific-popup.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= media() ?>/atencion/vendor/perfect-scrollbar/perfect-scrollbar.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= media() ?>/atencion/css/util.css">
	<link rel="stylesheet" type="text/css" href="<?= media() ?>/atencion/css/main.css">
<!--===============================================================================================-->
</head>
<body class="animsition">
	
	<!-- Header -->
	<header>
		<!-- Header desktop -->
		<div class="container-menu-desktop">
			<!-- Topbar -->
			<div class="top-bar">
				<div class="content-topbar flex-sb-m h-full container">
					<div class="left-top-bar">
						Bienvenido Usuario: Edvin Letona
					</div>

					<div class="right-top-bar flex-w h-full">
						<a href="#" class="flex-c-m trans-04 p-lr-25">
							Ayuda
						</a>

						<a href="#" class="flex-c-m trans-04 p-lr-25">
							Mi Cuenta
						</a>					

						<a href="#" class="flex-c-m trans-04 p-lr-25">
							Salir
						</a>
					</div>
				</div>
			</div>

			<div class="wrap-menu-desktop">
				<nav class="limiter-menu-desktop container">
					
					<!-- Logo desktop -->		
					<a href="<?= base_url(); ?>" class="logo">
						<img src="<?= media() ?>/atencion/images/logo.png" alt="Logo-Atencion">
					</a>

					<!-- Menu desktop -->
					<div class="menu-desktop">
						<ul class="main-menu">
							<li class="active-menu">
								<a href="<?= base_url(); ?>">Inicio</a>								
							</li>

							<li>
								<a href="<?= base_url(); ?>/tienda">Requerimientos</a>
							</li>
							
						</ul>
					</div>	

					<!-- Icon header -->
					<div class="wrap-icon-header flex-w flex-r-m">
						<div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 js-show-modal-search">
							<i class="zmdi zmdi-search"></i>
						</div>

						<div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 icon-header-noti js-show-cart" data-notify="2">
							<i class="zmdi zmdi-shopping-cart"></i>
						</div>
						
					</div>
				</nav>
			</div>	
		</div>

		<!-- Header Mobile -->
		<div class="wrap-header-mobile">
			<!-- Logo moblie -->		
			<div class="logo-mobile">
				<a href="<?= base_url(); ?>"><img src="<?= media() ?>/atencion/images/logo.png" alt="logo atencion"></a>
			</div>

			<!-- Icon header -->
			<div class="wrap-icon-header flex-w flex-r-m m-r-15">
				<div class="icon-header-item cl2 hov-cl1 trans-04 p-r-11 js-show-modal-search">
					<i class="zmdi zmdi-search"></i>
				</div>

				<div class="icon-header-item cl2 hov-cl1 trans-04 p-r-11 p-l-10 icon-header-noti js-show-cart" data-notify="2">
					<i class="zmdi zmdi-shopping-cart"></i>
				</div>				
			</div>

			<!-- Button show menu -->
			<div class="btn-show-menu-mobile hamburger hamburger--squeeze">
				<span class="hamburger-box">
					<span class="hamburger-inner"></span>
				</span>
			</div>
		</div>


		<!-- Menu Mobile -->
		<div class="menu-mobile">
			<ul class="topbar-mobile">
				<li>
					<div class="left-top-bar">
						Bienvenido Usuario
					</div>
				</li>

				<li>
					<div class="right-top-bar flex-w h-full">
						<a href="#" class="flex-c-m p-lr-10 trans-04">
							Ayuda
						</a>

						<a href="#" class="flex-c-m p-lr-10 trans-04">
							Mi Cuenta
						</a>				

						<a href="#" class="flex-c-m p-lr-10 trans-04">
							Salir
						</a>
					</div>
				</li>
			</ul>

			<ul class="main-menu-m">
				<li>
					<a href="<?= base_url(); ?>">Inicio</a>			
					
				</li>

				<li>
					<a href="<?= base_url(); ?>/tienda">Requerimientos</a>
				</li>				
			</ul>
		</div>

		<!-- Modal Search -->
		<div class="modal-search-header flex-c-m trans-04 js-hide-modal-search">
			<div class="container-search-header">
				<button class="flex-c-m btn-hide-modal-search trans-04 js-hide-modal-search">
					<img src="<?= media() ?>/atencion/images/icons/icon-close2.png" alt="CLOSE">
				</button>

				<form class="wrap-search-header flex-w p-l-15">
					<button class="flex-c-m trans-04">
						<i class="zmdi zmdi-search"></i>
					</button>
					<input class="plh3" type="text" name="search" placeholder="Search...">
				</form>
			</div>
		</div>
	</header>