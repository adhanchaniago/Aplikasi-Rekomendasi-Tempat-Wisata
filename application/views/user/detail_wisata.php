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
                <li class="active"><a href="<?php echo base_url(); ?>beranda">Beranda</a></li>
                <li><a href="<?php echo base_url(); ?>beranda/wisata">Wisata</a></li>
                <li><a href="<?php echo base_url(); ?>beranda/tentang">Tentang</a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </nav>
    <aside id="colorlib-hero">
       <?php $this->load->view('pendukung/slider'); ?>
    </aside>
    
    <div class="colorlib-wrap">
      <div class="container">
        <div class="row">
          <div class="col-md-9">
            <div class="row">
              <h3 style="text-align: center;">Detail "<i><?php echo $nama ?>"</i></h3>
              <div class="wrap-division">
                <div class="col-md-12 col-sm-12 animate-box">
                  <div class="hotel-entry">
                      <img src="<?php echo base_url() ?><?php echo $foto ?>" class="hotel-img" width="500" >
                      <p class="price"><span>Tiket Masuk Rp <?php echo $harga ?></span></p>
                    </a>
                    <div class="desc">

                      <h3><a href="hotel-room.html"><?php echo $nama; ?></a></h3>
                      <p class="star"> <?php echo $pengunjung ?> Total Pengunjung</p>
                      <p class="star">Terdapat <?php echo $fasilitas ?> Fasiltas</p>
                      <p>Lokasi: <?php echo $alamat ?></p>
                      <p><?php echo $deskripsi ?></p>
                      
                    </div>
                  </div>
                </div>
              </div>
            </div>
            
          </div>

          <!-- SIDEBAR-->
          <div class="col-md-3">
            <h3 class="sidebar-heading" style="text-align: center;">Cari Lagi Wisata</h3>
            <div class="sidebar-wrap">
              <div class="side search-wrap animate-box">
                <form action="<?php echo base_url().'beranda/cari_wisata'?>" method="post" class="colorlib-form">
                        <div class="row">
                        <div class="col-md-12">
                          <div class="form-group">
                            <label for="guests">Harga</label>
                            <div class="form-field">
                              <i class="icon icon-arrow-down3"></i>
                              <select name="harga" id="people" class="form-control">
                                <option value="harga_murah" style="color: black">Murah</option>
                                <option value="harga_sedang" style="color: black">Sedang</option>
                                <option value="harga_mahal" style="color: black">Mahal</option>
                              </select>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-12">
                          <div class="form-group">
                            <label for="guests">Fasilitas</label>
                            <div class="form-field">
                              <i class="icon icon-arrow-down3"></i>
                              <select name="fasilitas" id="people" class="form-control">
                                <option value="fas_sedikit" style="color: black">Sedikit</option>
                                <option value="fas_cukup" style="color: black">Cukup</option>
                                <option value="fas_banyak" style="color: black">Banyak</option>
                              </select>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-12">
                          <div class="form-group">
                            <label for="guests">Pengunjung</label>
                            <div class="form-field">
                              <i class="icon icon-arrow-down3"></i>
                              <select name="pengunjung" id="people" class="form-control">
                                <option value="pengunjung_sepi" style="color: black">Sepi</option>
                                <option value="pengunjung_biasa" style="color: black">Biasa</option>
                                <option value="pengunjung_ramai" style="color: black">Ramai</option>
                              </select>
                            </div>
                          </div>
                        </div>
                         <div class="col-md-12">
                          <div class="form-group">
                            <label for="guests">Jarak</label>
                            <div class="form-field">
                              <i class="icon icon-arrow-down3"></i>
                              <select name="jarak" id="people" class="form-control">
                                <option value="jarak_dekat" style="color: black">Dekat</option>
                                <option value="jarak_sedang" style="color: black">Sedang</option>
                                <option value="jarak_jauh" style="color: black">Jauh</option>
                              </select>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-12">
                          <input type="submit" name="submit" id="submit" value="Cari" class="btn btn-primary btn-block">
                        </div>
                      </div>
                    </form>
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

