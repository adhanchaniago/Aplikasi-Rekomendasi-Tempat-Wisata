<!DOCTYPE HTML>
<html>
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>PESONA GARUT</title>
	<link rel="icon" type="image/png" href="<?php echo base_url(); ?>assets_admin/img/logo_garut.png"/>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="" />
	<meta name="keywords" content="" />
	<meta name="author" content="" />

    <!-- Facebook and Twitter integration -->
    <?php $this->load->view('pendukung/css_javascript'); ?>

	</head>
	<body>
		
	<div class="colorlib-loader"></div>

	<div id="page">
		<nav class="colorlib-nav" role="navigation">
			<div class="top-menu">
				<div class="container-fluid">
					<div class="row">
						<div class="col-xs-2">
							<div id="colorlib-logo"><a href="<?php echo base_url(); ?>beranda/">Pesona Garut</a></div>
						</div>
						<div class="col-xs-10 text-right menu-1">
							<ul>
								<li><a href="<?php echo base_url(); ?>beranda">Beranda</a></li>
								<li><a href="<?php echo base_url(); ?>beranda/wisata">Wisata</a></li>
								<li class="active"><a href="<?php echo base_url(); ?>beranda/tentang">Tentang</a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</nav>
		<aside id="colorlib-hero">
			 <?php $this->load->view('pendukung/slider'); ?>
		</aside>
		<div id="colorlib-about">
			<div class="container">
				<div class="row">
					<div class="about-flex">
						<div class="col-one-forth aside-stretch animate-box">
							<div class="row">
								<div class="col-md-12 about">
									<h2>Temukan Kami</h2>

									<ul>
										<li><a >IG @Pesona_garut</a></li>
										<li><a>FB Pesona_Garut</a></li>
									</ul>
								</div>
							</div>
						</div>
						<div class="col-three-forth animate-box">
							<h2>Tentang</h2>
							<div class="row">
								<div class="col-md-12">
									<p>Pesona Garut adalah web yang menyediakan fasilitas Sistem Pendukung Keputusan Pemilihan Obyek Wisata di Kabupaten Garut</p>
									<div class="row row-pb-sm">
										<div class="col-md-6">
											<img class="img-responsive" src="<?php echo base_url(); ?>assets_admin/img/logo_garut.png" alt="">
										</div>
										<div class="col-md-6">
											
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<footer id="colorlib-footer" role="contentinfo">
			<div class="container">
				<div class="row row-pb-md">
					<div class="col-md-4 colorlib-widget">
						<h4>Cari Kami</h4>
					
						<p>
							<ul class="colorlib-social-icons">
								<li><a href="#"><i class="icon-twitter"></i></a></li>
								<li><a href="#"><i class="icon-facebook"></i></a></li>
								<li><a href="#"><i class="icon-linkedin"></i></a></li>
								<li><a href="#"><i class="icon-dribbble"></i></a></li>
							</ul>
						</p>
					</div>
					<div class="col-md-4 colorlib-widget">
						<h4>Menu</h4>
						<p>
							<ul class="colorlib-footer-links">
								<li><a href="<?php echo base_url(); ?>beranda">Beranda</a></li>
								<li><a href="<?php echo base_url(); ?>beranda/wisata">Wisata</a></li>
								<li><a href="<?php echo base_url(); ?>beranda/tentang">Tentang</a></li>
							</ul>
						</p>
					</div>

					<div class="col-md-4 col-md-push-1">
						<h4>Informasi Kontak</h4>
						<ul class="colorlib-footer-links">
							<li>Garut, <br> Indonesia</li>
							<li><a href="#">085683949890</a></li>
							<li><a href="pesonagarutindah@gmail.com">pesonagarutindah@gmail.com</a></li>
							<li><a href="#">pesonagarutindah.com</a></li>
						</ul>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12 text-center">
						<p>
							<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
							Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | by <a href="#" >Aldi Surya Pratama</a></span> 
						</p>
					</div>
				</div>
			</div>
		</footer>
	</div>

	<div class="gototop js-top">
		<a href="#" class="js-gotop"><i class="icon-arrow-up2"></i></a>
	</div>
	
	<!-- jQuery -->
	<?php $this->load->view('pendukung/j_query_bawah'); ?>

	</body>
</html>

