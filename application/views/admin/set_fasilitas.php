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
    <li class="submenu "> <a href="#"><i class="icon icon-money"></i> <span>Variabel Harga</span> <span class="label label-important">3</span></a>
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
     <div id="breadcrumb"> <a href="<?php echo base_url(); ?>admin" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Beranda</a></div>
  </div>
<!--End-breadcrumbs-->

<!--Action boxes-->
  <div class="container-fluid">

<!--Chart-box-->    
    <div class="row-fluid">
        <div class="span6">
            <div class="widget-box">
        <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
          <h5>Set Kriteria Fasilitas</h5>
        </div>
        <div class="widget-content nopadding">
          <form action="<?php echo base_url().'variabel_fasilitas/proses_set_fasilitas'?>" method="post" class="form-horizontal">
           <div class="control-group">
              <label class="control-label">Sedikit :</label>
              <div class="controls">
                <input type="text" name="sedikit" class="span11" placeholder="Fasilitas Sedikit" />
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Cukup :</label>
              <div class="controls">
                <input type="text" name="cukup" class="span11" placeholder="Fasilitas Cukup" />
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Banyak :</label>
              <div class="controls">
                <input type="text" name="banyak" class="span11" placeholder="Fasilitas Banyak" />
              </div>
            </div>
            <div class="form-actions">
              <button type="submit" class="btn btn-success">Ubah</button>
            </div>
          </form>
        </div>
        </div>
        </div>

        <div class="span6">
            <div class="widget-box">
        <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
          <h5>Fungsi Keanggotaan Kriteria Fasilitas</h5>
        </div>
        <div class="widget-content nopadding">
            <table class="table table-bordered">
               <thead>
                  <tr>
                    <th>Kriteria</th>
                    <th>Aturan</th>
                    <th>Hasil</th>
                  </tr>
                </thead>
                <?php foreach($kriteria_fasilitas as $row) 
                { 
                    $sedikit = $row['sedikit'];
                    $cukup = $row['cukup'];
                    $banyak = $row['banyak'];
                    $x1 = $row['x1'];
                    $x2 = $row['x2'];
                ?>
                <tr>
                    <td rowspan="3" style="text-align: center;"><b>sedikit</b></td>
                    <td>
                        f <= <?php echo $sedikit ?>
                    </td>
                    <td>1 </td>
                </tr>
                <tr>
                    <td>
                        <?php echo $sedikit ?> <= f <= <?php echo $cukup ?>
                    </td>
                    <td>
                        (<?php echo $cukup ?> - f) / <?php echo $x1 ?>
                    </td>
                </tr>
                <tr>
                    <td>
                         f >= <?php echo $cukup ?>
                    </td>
                    <td>
                        0
                    </td>
                </tr>

                <tr>
                    <td rowspan="3" style="text-align: center;"><b>cukup</b></td>
                    <td>
                        f >= <?php echo $banyak ?> <b>or</b> f <=  <?php echo $sedikit ?> 
                    </td>
                    <td>0</td>
                </tr>
                <tr>
                    <td>
                        <?php echo $sedikit ?> <= f <= <?php echo $cukup ?>
                    </td>
                    <td>
                        (f - <?php echo $sedikit ?>) / <?php echo $x1 ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <?php echo $cukup ?> <= f <= <?php echo $banyak ?>
                    </td>
                    <td>
                        (<?php echo $banyak ?> - f) / <?php echo $x2 ?>
                    </td>
                </tr>

                 <tr>
                    <td rowspan="3" style="text-align: center;"><b>banyak</b></td>
                    <td>
                        f <= <?php echo $cukup ?>
                    </td>
                    <td>0</td>
                </tr>
                <tr>
                    <td>
                        <?php echo $cukup ?> <= f <= <?php echo $banyak ?>
                    </td>
                    <td>
                        (f - <?php echo $cukup ?>) / <?php echo $cukup ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        f >= <?php echo $banyak ?>
                    </td>
                    <td>
                        1
                    </td>
                </tr>
                <?php 
                } ?>
            </table>
        </div>
        </div>
         <a href="<?php echo base_url().'variabel_fasilitas/derajat_fasilitas'?>"><button type="submit" class="btn btn-info">Lihat Derajat Keanggotaan Fasilitas</button></a>
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
