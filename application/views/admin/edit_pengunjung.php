<!DOCTYPE html>
<html lang="en">
<head>
<?php $this->load->view('pendukung/header'); ?>
</head>
<body>
<!--top-Header-menu-->
<?php $this->load->view('pendukung/top_header'); ?>
<!--close-top-serch-->



<!--sidebar-menu-->
<div id="sidebar"><a href="<?php echo base_url().'admin'?>" class="visible-phone"><i class="icon icon-home"></i> Dashboard</a>
  <ul>
    <li><a href="<?php echo base_url().'admin'?>"><i class="icon icon-home"></i> <span>Dashboard</span></a> </li>
    <li> <a href="<?php echo base_url().'admin/daftar_wisata'?>"><i class="icon icon-th-list"></i><span>Daftar Wisata</span></a> </li>
    <li class="submenu"> <a href="#"><i class="icon icon-money"></i> <span>Variabel Harga</span> <span class="label label-important">3</span></a>
      <ul>
        <li><a href="<?php echo base_url().'variabel_harga'?>">Daftar Harga</a></li>
        <li><a href="<?php echo base_url().'variabel_harga/set_kriteria_harga'?>">Set kriteria Harga</a></li>
        <li><a href="<?php echo base_url().'variabel_harga/derajat_harga'?>">Derajat Keanggotaan Harga</a></li>
      </ul>
    </li>

    <li class="submenu active"> <a href="#"><i class="icon icon-list"></i> <span>Variabel Fasilitas</span> <span class="label label-important">3</span></a>
      <ul>
        <li><a href="<?php echo base_url().'variabel_fasilitas'?>">Daftar Fasilitas</a></li>
        <li><a href="<?php echo base_url().'variabel_fasilitas/set_kriteria_fasilitas'?>">Set kriteria Fasilitas</a></li>
        <li><a href="<?php echo base_url().'variabel_fasilitas/derajat_fasilitas'?>">Derajat Keanggotaan Fasilitas</a></li>
      </ul>
    </li>
    <li class="submenu"> <a href="#"><i class="icon  icon-user"></i> <span>Variabel Pengunjung</span> <span class="label label-important">3</span></a>
      <ul>
        <li><a href="<?php echo base_url().'variabel_pengunjung'?>">Daftar Pengunjung</a></li>
        <li><a href="<?php echo base_url().'variabel_pengunjung/set_kriteria_pengunjung'?>">Set kriteria Pengunjung</a></li>
        <li><a href="<?php echo base_url().'variabel_pengunjung/derajat_pengunjung'?>">Derajat Keanggotaan Pengunjung</a></li>
      </ul>
    </li>
    <li class="submenu"> <a href="#"><i class="icon icon-road"></i> <span>Variabel Jarak</span> <span class="label label-important">3</span></a>
      <ul>
        <li><a href="<?php echo base_url().'variabel_jarak'?>">Daftar Jarak</a></li>
        <li><a href="<?php echo base_url().'variabel_jarak/set_kriteria_jarak'?>">Set kriteria Jarak</a></li>
        <li><a href="<?php echo base_url().'variabel_jarak/derajat_jarak'?>">Derajat Keanggotaan Jarak</a></li>
      </ul>
    </li>
    <li> <a href="<?php echo base_url().'admin/fuzzyfikasi'?>"><i class="icon icon-th"></i><span>Hasil Fuzzyfikasi</span></a> </li>
     <li> <a href="<?php echo base_url().'login/logout'?>"><i class="icon icon-share-alt"></i><span>Logout</span></a>
     </li>
  </ul>
</div>
<!--sidebar-menu-->


<!--main-container-part-->
<div id="content">
<!--breadcrumbs-->
  <div id="content-header">
    <div id="breadcrumb"> <a href="index" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Beranda</a></div>
  </div>
<!--End-breadcrumbs-->

<!--Action boxes-->
  <div class="container-fluid">

<!--Chart-box-->    
    <div class="row-fluid">
        <div class="span8">
            <div class="widget-box">
        <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
          <h5>Edit Pengunjung Wisata</h5>
        </div>
        <div class="widget-content nopadding">
          <form action="<?php echo base_url().'variabel_pengunjung/update_pengunjung'?>" method="post" class="form-horizontal">
            <input type="hidden" value="<?php echo $id; ?>" class="form-control" name="id">
            <div class="control-group">
              <label class="control-label">ID Wisata :</label>
              <div class="controls">
                <input type="text" name="id_wisata" value="<?php echo $id_wisata; ?>" class="span11" readonly/>
              </div>
            </div>
             <div class="control-group">
              <label class="control-label">Nama Wisata :</label>
              <div class="controls">
                <input type="text" name="nama" value="<?php echo $nama; ?>" class="span11" readonly/>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Pengunjung :</label>
              <div class="controls">
                <input type="text" name="pengunjung" value="<?php echo $pengunjung; ?>" class="span11"/>
              </div>
            </div>
            <div class="form-actions">
              <button type="submit" class="btn btn-info">Edit</button>
            </div>
          </form>
        </div>
      </div>
        </div>
    </div>
<!--End-Chart-box--> 
  </div>
</div>

<!--end-main-container-part-->

<!--Footer-part-->

<div class="row-fluid">
    <?php $this->load->view('pendukung/footer'); ?>
</div>

<!--end-Footer-part-->
<?php $this->load->view('pendukung/java_script'); ?>
</body>
</html>
