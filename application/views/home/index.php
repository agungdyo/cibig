  <!-- page content -->
  <div class="right_col" role="main">
  <?php if ($this->session->flashdata('berhasil')) { ?>
  <div class="flash-data" data-flashdata="<?= $this->session->flashdata('berhasil'); ?>" data-tipe="Berhasil"
    data-judul="Data Biaya PPDB"></div>
  <?php } if ($this->session->flashdata('gagal')) { ?>
  <div class="flash-data" data-flashdata="<?= $this->session->flashdata('gagal'); ?>" data-tipe="Gagal"
    data-judul="Data Biaya PPDB"></div>
  <?php } ?>

  <script type="text/javascript">
    function tampilkanwaktu() { //fungsi ini akan dipanggil di bodyOnLoad dieksekusi tiap 1000ms = 1detik    
      var waktu = new Date(); //membuat object date berdasarkan waktu saat 
      var sh = waktu.getHours() +
        ""; //memunculkan nilai jam, //tambahan script + "" supaya variable sh bertipe string sehingga bisa dihitung panjangnya : sh.length    //ambil nilai menit
      var sm = waktu.getMinutes() + ""; //memunculkan nilai detik    
      var ss = waktu.getSeconds() +
        ""; //memunculkan jam:menit:detik dengan menambahkan angka 0 jika angkanya cuma satu digit (0-9)
      document.getElementById("clock").innerHTML = (sh.length == 1 ? "0" + sh : sh) + ":" + (sm.length == 1 ? "0" +
        sm : sm) + ":" + (ss.length == 1 ? "0" + ss : ss) + "''";
    }
  </script>
  <!-- /top tiles -->
  <div class="row">
  <div style="padding: 0" class="col-md-12 col-sm-12 col-xs-12">
      <div class="well" style="overflow: auto; text-align: center">
        <h2><strong>Selamat Datang,</strong></h2>

        <body onload="tampilkanwaktu();setInterval('tampilkanwaktu()', 1000);">
          <h3> </h3>
          <span style="font-size: 30px; font-weight: 600"><span style="font-size: 25px;" id="clock"></span>,
            <?php
                $hari = date('l');
                /*$new = date('l, F d, Y', strtotime($Today));*/
                if ($hari=="Sunday") {
                 echo "Minggu";
                }elseif ($hari=="Monday") {
                 echo "Senin";
                }elseif ($hari=="Tuesday") {
                 echo "Selasa";
                }elseif ($hari=="Wednesday") {
                 echo "Rabu";
                }elseif ($hari=="Thursday") {
                 echo("Kamis");
                }elseif ($hari=="Friday") {
                 echo "Jum'at";
                }elseif ($hari=="Saturday") {
                 echo "Sabtu";
                }
                $tgl =date(' - d');
                echo $tgl;
                $bulan =date('F');
                if ($bulan=="January") {
                  echo " Januari ";
                }elseif ($bulan=="February") {
                  echo " Februari ";
                }elseif ($bulan=="March") {
                  echo " Maret ";
                }elseif ($bulan=="April") {
                  echo " April ";
                }elseif ($bulan=="May") {
                  echo " Mei ";
                }elseif ($bulan=="June") {
                  echo " Juni ";
                }elseif ($bulan=="July") {
                  echo " Juli ";
                }elseif ($bulan=="August") {
                  echo " Agustus ";
                }elseif ($bulan=="September") {
                  echo " September ";
                }elseif ($bulan=="October") {
                  echo " Oktober ";
                }elseif ($bulan=="November") {
                  echo " November ";
                }elseif ($bulan=="December") {
                  echo " Desember ";
                }
                $tahun=date('Y ');
                echo $tahun;
                    
                    ?>
          </span>
      </div>
    </div>
    <!-- top tiles -->
    <div class="row">
      <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="tile-stats">
          <div class="icon"><i class="fas fa-user-alt"></i>
          </div>
          <div class="count"><?= $num_siswa ?></div>

          <h3>Siswa</h3>
          <p style="font-size: 14px;"><a href="<?= site_url('siswa') ?>">Lihat Lebih Lengkap <i
                class="fa fa-arrow-circle-right"></i></a></p>
        </div>
      </div>
      <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="tile-stats">
          <div class="icon"><i class="fas fa-user-graduate"></i>
          </div>
          <div class="count"><?= $num_guru ?></div>
          <h3>Guru</h3>
          <p style="font-size: 14px;"><a href="<?= site_url('guru') ?>">Lihat Lebih Lengkap <i
                class="fa fa-arrow-circle-right"></i></a></p>
        </div>
      </div>
      <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="tile-stats">
          <div class="icon"><i class="fa fa-file-alt"></i>
          </div>
          <div class="count"><?= $num_kelas ?></div>
          <h3>kelas</h3>
          <p style="font-size: 14px;"><a href="<?= site_url('kelas') ?>">Lihat Lebih Lengkap <i
                class="fa fa-arrow-circle-right"></i></a></p>
        </div>
      </div>
      <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="tile-stats">
          <div class="icon"><i class="fa fa-folder"></i>
          </div>
          <div class="count"><?= $num_akunppdb ?></div>
          <h3>Pendaftar</h3>
          <p style="font-size: 14px;"><a href="<?= site_url('ppdb') ?>">Lihat Lebih Lengkap <i
                class="fa fa-arrow-circle-right"></i></a></p>
        </div>
      </div>
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="dashboard_graph">

          <div class="row x_title">
            <div class="col-md-6">
              <h3>Statistik <small>Administrasi</small></h3>
            </div>
            <div class="col-md-6">
              <div id="reportrange" class="pull-right">
                Tahun :
                <select name="" id="tahun_c" class="form-control-sm">
                  <?php for ($tahun_c = date('Y') - 5 ; $tahun_c <= date('Y') + 1 ; $tahun_c++) { ?>
                  <option <?= ($tahun_c == date('Y')) ? 'selected' : NULL ?> value="<?= $tahun_c ?>"><?= $tahun_c ?>
                  </option>
                  <?php } ?>
                </select>
              </div>
            </div>
          </div>

          <div style="padding-left: 20px" class="col-md-12 col-sm-12 col-xs-12">
            <canvas id="administrasiChart"></canvas>
            <h5 style="width: 100%; text-align: center">
              <i style="color: #146474" class="fa fa-circle"></i> PPDB <i style="color: #BCE9E0; margin-left: 10px"
                class="fa fa-circle"></i> SPP
              <span style="margin: 0 20px 0 20px">|</span>
              Bulan
            </h5>
            <h5 style="width: 130px; position: absolute; top: 33%; left: -58.5px; transform: rotate(-90deg)">
              Jumlah Pembayaran
            </h5>
          </div>
          <div class="clearfix"></div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- /page content -->
<!-- Chart.js -->
<script src="<?= base_url() ?>vendors/Chart.js/dist/Chart.min.js"></script>
<!-- Costum Chart -->
<script src="<?= base_url() ?>build/js/costum-chart.js"></script>


<div id="show">
  
</div>
<script>
  $('#show').load("<?= base_url('home/chartAdministrasi/' . date('Y')); ?>");
  $('#tahun_c').on('change', function () {
    var tahun = $('#tahun_c').val();
    $('#show').load("<?= base_url('home/chartAdministrasi/'); ?>" + tahun + '/Ubah');
  });
</script>