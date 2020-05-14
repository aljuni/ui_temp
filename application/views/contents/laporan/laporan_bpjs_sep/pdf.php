<html>
<head>
<title><?php echo $title;?></title>
<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<style>

  .row {
    margin-bottom: 15px;
  }

  .centerp {
    padding: 10px 0px 10px 5px !important;
  }

  .centerp-head {
    padding: 10px 0px 10px 5px;
    text-align: center;
  }

  .centerp-row {
    padding: 10px 0px 10px 5px;
  }


  .r_border {
   font-family: serif;
   font-size: 13px;
   padding: 5px;
  }

  .r_border_top {
   font-family: serif;
   font-size: 10px;
   padding: 5px;
   border-top: 1px solid #000;
  }

  .r_border_bottom {
   font-family: serif;
   font-size: 10px;
   padding: 5px;
   border-bottom: 1px solid #000;
  }

  .r_border_non {
   font-family: serif;
   font-size: 10px;
   padding: 5px;
  }

  .r_color {
   background-color: #f5f5f5;
  }

  .r-bold{font-weight:bold;}

  #contents tr:nth-child(even) {
   background-color: #f2f2f2
  }

  /*Start Untuk radio button style*/

  .container {
    display: block;
    position: relative;
    padding-left: 35px;
    margin-bottom: 12px;
    cursor: pointer;
    font-size: 12px;
    font-weight: inherit;
    padding-top: 4px;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
  }
  
  .container input {
    position: absolute;
    opacity: 0;
    cursor: pointer;
  }
  
  .checkmark {
    position: absolute;
    top: 0;
    left: 0;
    height: 25px;
    width: 25px;
    background-color: #eee;
    border-radius: 50%;
  }
  
  .container:hover input ~ .checkmark {
    background-color: #ccc;
  }
  
  .container input:checked ~ .checkmark {
    background-color: #2196F3;
  }
  
  .checkmark:after {
    content: "";
    position: absolute;
    display: none;
  }
  
  .container input:checked ~ .checkmark:after {
    display: block;
  }
  
  .container .checkmark:after {
    top: 9px;
    left: 9px;
    width: 8px;
    height: 8px;
    border-radius: 50%;
    background: white;
  }

  .bd {
    padding: 5px 5px 0px 5px;
  }
/*End radio button style*/
  
  *{
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    text-rendering: optimizeLegibility;
  }

  .font-white{color:#fff;}

  .font-size-18{font-size:18pt;}
  .font-size-12{font-size:12pt;}
  .font-size-10{font-size:10pt;}
  .font-size-9{font-size:9pt;}
  .font-size-8{font-size:8pt;}
  .font-size-7{font-size:7pt;}

  .mt-1{margin-top:1px;}
  .mt-5{margin-top:5px;}
  .mt-10{margin-top:10px;}
  .mt-20{margin-top:20px;}
  .mr-1{margin-right:1px;}
  .mr-2{margin-right:2px;}
  .mr-3{margin-right:3px;}
  .mr-4{margin-right:4px;}
  .mr-5{margin-right:5px;}
  .mr-10{margin-right:10px;}
  .mr-12{margin-right:20px;}

  .mb-5{margin-bottom:5px;}
  .mb-10{margin-bottom:10px;}
  .mb-20{margin-bottom:20px;}
  .m-0{margin:0px}

  .p-0{padding:0px}
  .p-2{padding:2px;}
  .p-3{padding:3px;}
  .p-4{padding:4px;}
  .p-5{padding:5px;}

  .pt-1{padding-top:1px;}
  .pt-2{padding-top:2px;}
  .pt-3{padding-top:3px;}
  .pt-4{padding-top:4px;}
  .pt-5{padding-top:5px;}
  .pt-10{padding-top:10px;}
  
  .pb-0{padding-bottom:0px}  
  .pb-1{padding-bottom:1px;}
  .pb-2{padding-bottom:2px;}
  .pb-3{padding-bottom:3px;}
  .pb-4{padding-bottom:4px;}
  .pb-5{padding-bottom:5px;}
  .pb-10{padding-bottom:10px;}
  .pb-20{padding-bottom:20px;}

  .pl-5{padding-left:5px;}
  .pl-10{padding-left:10px;}

  .pr-1{padding-right:1px;}
  .pr-2{padding-right:2px;}
  .pr-3{padding-right:3px;}
  .pr-4{padding-right:4px;}
  .pr-5{padding-right:5px;}
  .clear{clear:both;}

  .row-panel{
      margin-bottom: 10px;   
      -webkit-box-shadow: 0 1px 1px rgba(0,0,0,.05);
      box-shadow: 0 1px 1px rgba(0,0,0,.05);
  }
  .row-heading {padding: 1px 5px;}
  .border-black{border-color: black;}

  .border-blue{border-color: #18659D;}
  .bg-blue{background-color:#18659D}

  .border-no-bottom{border-top:1px solid black;border-left:1px solid black;border-right:1px solid black;}
  .border-no-top{border-bottom:1px solid black;border-left:1px solid black;border-right:1px solid black;}

  .border-bottom-1{border-bottom:1px solid black}
  .border-top-1{border-top:1px solid black}
  .border-right-1{border-right:1px solid black;}
  .border-left-1{border-left:1px solid black;}

  .border-bottom-0{border-bottom:0px;}
  .border-top-0{border-top:0px;}
  .border-right-0{border-right:0px;}
  .border-left-0{border-left:0px;}

  .border-left-1-right-1{border-left:1px solid black;border-right:1px solid black;}

  .row-header{padding:0px 0px 1px 3px;margin:0px;width:100%}
  .detail-administration{text-align:left;vertical-align:top;}

  .v-align-top{vertical-align:top;}
  .t-align-justify{text-align:justify}


  .column-left{float:left;width:50%;}
  .column-right{float:left;}

  .column-3-left{float:left;width:35%;}
  .column-3-middle{float:left;width:35%;}
  .column-3-right{float:left;}
  
  ol {margin-left:10px;padding-left:5px}
  ol li {padding:0;margin-left:1px;}

  .column-left-header {float:left;width:50%;}
  .column-right-header {float:left;margin-left:5px}
  .column-left-detail {float:left;width:25%;}
  .column-right-detail {float:left;margin-left:5px}
</style>
</head>
<body style="margin:0px;">

  <div class="row" style="margin-bottom:0px;">
    <div class="row-panel">
      <div class="row-heading border-blue bg-blue font-white font-size-9 r-bold">Data Registrasi</div>
      <div class="row-body">
        <table width="100%" cellspacing="0">
          <tr>
            <td width="20%" class="detail-administration r-bold font-size-8 pl-5 pt-2 pr-2 border-left-1 border-right-1">No. Registrasi</td>
            <td width="18%" class="detail-administration r-bold font-size-8 pl-5 pt-2 pr-2 border-left-1 border-right-1">Penjamin</td>
            <td width="10%" class="detail-administration r-bold font-size-8 pl-5 pt-2 pr-2 border-left-1 border-right-1">No. RM</td>
            <td width="10%" class="detail-administration r-bold font-size-8 pl-5 pt-2 pr-2 border-left-1 border-right-1">No. BPJS</td>
            <td colspan="2" class="detail-administration r-bold font-size-8 pl-5 pt-2 pr-2 border-left-1 border-right-1">No. KTP</td>
            <td width="12%" class="detail-administration r-bold font-size-8 pl-5 pt-2 pr-2 border-left-1 border-right-1">Jenis Kelamin</td>
            <td width="18%" class="detail-administration r-bold font-size-8 pl-5 pt-2 pr-2 border-left-1 border-right-1">Golongan Darah</td>
          </tr>
          <tr>
            <td class="font-table font-size-8 pl-5 pb-2 pr-2 border-left-1 border-right-1"><?php echo $list['pasien']['no_reg'];?></td>
            <td class="font-table font-size-8 pl-5 pb-2 pr-2 border-left-1 border-right-1"><?php echo ucwords(strtolower($list['pasien']['nama_penjamin'])); ?></td>
            <td class="font-table font-size-8 pl-5 pb-2 pr-2 border-left-1 border-right-1"><?php echo $list['pasien']['no_rm'];?></td>
            <td class="font-table font-size-8 pl-5 pb-2 pr-2 border-left-1 border-right-1"><?php echo $list['pasien']['no_bpjs'];?></td>
            <td colspan="2" class="font-table font-size-8 pl-5 pb-2 pr-2 border-left-1 border-right-1"><?php echo $list['pasien']['no_ktp']; ?></td>
            <td class="font-table font-size-8 pl-5 pb-2 pr-2 border-left-1 border-right-1"><?php echo $list['pasien']['kelamin'];?></td>
            <td class="font-table font-size-8 pl-5 pb-2 pr-2 border-left-1 border-right-1"><?php echo $list['pasien']['golongan_darah'];?></td>
          </tr>
          <tr>
            <td class="detail-administration r-bold font-size-8 pl-5 pt-2 pr-2 border-left-1 border-right-1 border-top-1">Nama Pasien</td>
            <td class="detail-administration r-bold font-size-8 pl-5 pt-2 pr-2 border-left-1 border-right-1 border-top-1">Tanggal Lahir / Umur</td>
            <td colspan="3" class="detail-administration r-bold font-size-8 pl-5 pt-2 pr-2 border-left-1 border-right-1 border-top-1">Alamat</td>
            <td colspan="2" class="detail-administration r-bold font-size-8 pl-5 pt-2 pr-2 border-left-1 border-right-1 border-top-1">DPJP</td>
            <td class="detail-administration r-bold font-size-8 pl-5 pt-2 pr-2 border-left-1 border-right-1 border-top-1">Kelas</td>
          </tr>
          <tr>
            <td class="font-table font-size-8 pl-5 pb-2 pr-2 border-no-top"><?php echo ucwords(strtolower($list['pasien']['nama_pasien'])); ?></td>
            <td class="font-table font-size-8 pl-5 pb-2 pr-2 border-no-top"><?php echo date("d-m-Y",strtotime($list['pasien']['tanggal_lahir'])) . ' / ' . $list['pasien']['umur_registrasi'];?></td>
            <td colspan="3" class="font-table font-size-8 pl-5 pb-2 pr-2 border-no-top"><?php echo ucwords(strtolower($list['pasien']['alamat1']));?></td>
            <td colspan="2" class="font-table font-size-8 pl-5 pb-2 pr-2 border-no-top"><?php echo ucwords(strtolower($list['pasien']['nama_dokter'])); ?></td>
            <td class="font-table font-size-8 pl-5 pb-2 pr-2 border-no-top"></td>
          </tr>
        </table>
      </div>
    </div>

    <div class="row-panel">
      <div class="row-heading border-blue bg-blue font-white font-size-9 r-bold">Data Laporan Sedasi</div>
        <div class="row-body">
          <table width="100%" cellspacing="0">
          <tr>
            <td width="25%" class="detail-administration r-bold font-size-8 border-bottom-1 border-left-1 border-right-0 centerp-row" style="padding: 5px 20px 5px 5px;">Tanggal Tindakan </td>
            <td width="25%" class="detail-administration r-bold font-size-8 border-left-0 border-right-0 border-bottom-1" style="padding: 5px 20px 5px 5px;">:  <?= $list['notes']['tanggal']; ?></td>
            <td width="25%" class="detail-administration r-bold font-size-8 border-left-0 border-right-0 border-bottom-1 centerp-row" style="padding: 5px 0px 5px 5px;">Jam Mulai : <?= $list['notes']['jam']; ?></td>
            <td width="25%" class="detail-administration r-bold font-size-8 border-left-0 border-right-1 border-bottom-1 centerp-row" style="padding: 5px 0px 5px 5px;">Jam Akhir : <?= $list['notes']['jam_akhir']; ?></td>
          </tr>

          <tr>
            <td width="25%" class="detail-administration r-bold font-size-8 border-bottom-1 border-left-1 border-right-0 centerp-row" style="padding: 5px 20px 5px 5px;">Diagnosis </td>
            <td width="75%" class="detail-administration font-size-8 border-left-0 border-right-1 border-bottom-1" style="padding: 5px 0px 5px 5px;" colspan="3">:  <?= $list['notes']['diagnosis']; ?></td>
          </tr>
          <tr>
            <td width="25%" class="detail-administration r-bold font-size-8 border-bottom-1 border-left-1 border-right-0 centerp-row" style="padding: 5px 20px 5px 5px;">Tindakan </td>
            <td width="75%" class="detail-administration font-size-8 border-left-0 border-right-1 border-bottom-1" style="padding: 5px 0px 5px 5px;" colspan="3">:  <?= $list['notes']['tindakan']; ?></td>
          </tr>
          <tr>
            <td width="25%" class="detail-administration r-bold font-size-8 border-bottom-1 border-left-1 border-right-0 centerp-row" style="padding: 5px 20px 5px 5px;">Level Sedasi </td>
            <td width="75%" class="detail-administration font-size-8 border-left-0 border-right-1 border-bottom-1" style="padding: 5px 0px 5px 5px;" colspan="3">:  <?= $list['notes']['level_sedasi']; ?></td>
          </tr>
          <tr>
            <td width="25%" class="detail-administration r-bold font-size-8 border-bottom-1 border-left-1 border-right-0 centerp-row" style="padding: 5px 20px 5px 5px;">Obat sedasi yang diberikan </td>
            <td width="75%" class="detail-administration font-size-8 border-left-0 border-right-1 border-bottom-1" style="padding: 5px 0px 5px 5px;" colspan="3">:  <?= $list['notes']['obat_sedasi']; ?></td>
          </tr>


          <tr>
            <td width="25%" class="detail-administration r-bold font-size-8 border-bottom-1 border-left-1 border-right-1 centerp-row" style="padding: 15px 0px 7px 5px;" colspan="4">Monitoring Selama Sedasi </td>
          </tr>
          <tr>
            <td width="25%" class="detail-administration r-bold font-size-8 pl-5 pt-2 pr-2 border-bottom-1 border-left-1 border-right-0 centerp-row" style="padding: 5px 20px 5px 5px;">Jam </td>
            <td width="75%" class="detail-administration font-size-8 border-left-1 border-right-1 border-bottom-1" style="padding: 5px 0px 5px 5px;" colspan="3">  <?= $list['notes']['jam_monitoring']; ?></td>
          </tr>
          <tr>
            <td width="25%" class="detail-administration r-bold font-size-8 pl-5 pt-2 pr-2 border-bottom-1 border-left-1 border-right-0 centerp-row" style="padding: 5px 20px 5px 5px;">Tekanan Darah </td>
            <td width="75%" class="detail-administration font-size-8 border-left-1 border-right-1 border-bottom-1" style="padding: 5px 0px 5px 5px;" colspan="3">  <?= $list['notes']['tekanan_darah']; ?></td>
          </tr>
          <tr>
            <td width="25%" class="detail-administration r-bold font-size-8 pl-5 pt-2 pr-2 border-bottom-1 border-left-1 border-right-0 centerp-row" style="padding: 5px 20px 5px 5px;">Nadi </td>
            <td width="75%" class="detail-administration font-size-8 border-left-1 border-right-1 border-bottom-1" style="padding: 5px 0px 5px 5px;" colspan="3">  <?= $list['notes']['nadi']; ?></td>
          </tr>
          <tr>
            <td width="25%" class="detail-administration r-bold font-size-8 pl-5 pt-2 pr-2 border-bottom-1 border-left-1 border-right-0 centerp-row" style="padding: 5px 20px 5px 5px;">Pernapasan </td>
            <td width="75%" class="detail-administration font-size-8 border-left-1 border-right-1 border-bottom-1" style="padding: 5px 0px 5px 5px;" colspan="3">  <?= $list['notes']['pernapasan']; ?></td>
          </tr>
          <tr>
            <td width="25%" class="detail-administration r-bold font-size-8 pl-5 pt-2 pr-2 border-bottom-1 border-left-1 border-right-0 centerp-row" style="padding: 5px 20px 5px 5px;">SpO2 </td>
            <td width="75%" class="detail-administration font-size-8 border-left-1 border-right-1 border-bottom-1" style="padding: 5px 0px 5px 5px;" colspan="3">  <?= $list['notes']['spo2']; ?></td>
          </tr>
        </table>

        <table>
           <tr>
            <td width="25%" class="detail-administration font-size-8 border-bottom-1 border-left-1 border-right-1 centerp-row" style="padding: 20px 0px 5px 5px;" colspan="4">Kriteria Pemulihan Sedasi<br>PAD5</td>
          </tr>
          <tr>
            <td width="20%" class="detail-administration r-bold font-size-8 pl-5 pt-2 pr-2 border-left-1 border-right-1 border-bottom-1 centerp-head">Yang Dinilai</td>
            <td width="60%" class="detail-administration r-bold font-size-8 pl-5 pt-2 pr-2 border-left-1 border-right-1 border-bottom-1" style="padding: 10px 0px 10px 5px; text-align: center">Penilaian</td>
            <td width="10%" class="detail-administration r-bold font-size-8 pl-5 pt-2 pr-2 border-left-1 border-right-1 border-bottom-1 centerp-row" style="padding: 10px 0px 10px 5px; text-align: center;">Score</td>
            <td width="10%" class="detail-administration r-bold font-size-8 pl-5 pt-2 pr-2 border-left-1 border-right-1 border-bottom-1 centerp-row" style="padding: 10px 0px 10px 5px; text-align: center;">Score Pasien</td>
          </tr>
          <tr class="bd">
            <td rowspan="3" class="font-size-8 border-left-1 border-right-1 border-bottom-1 text-center">Tanda Vital (TD dan Nadi)</td>
            <td class="font-size-8 border-left-1 border-right-1 border-bottom-1 bd">< 20% tanda vital sebelum tindakan</td>
            <td class="font-size-8 border-left-1 border-right-1 border-bottom-1 text-center bd">2</td>
            <td class="font-size-8 border-left-1 border-right-1 border-bottom-1 text-center bd">
              <label class="container" style="width: 2%">
                <input type="radio" name="tanda_vital"
                  <?php
                   if ($list['notes']['tanda_vital'] == '2') {
                      echo 'checked="checked"';
                    }
                  ?> value="2" required>
                <span class="checkmark"></span>
              </label>
            </td>
          </tr>

          <tr>
            <td class="font-size-8 border-left-1 border-right-1 border-bottom-1 bd">20%-40 tanda vital sebelum tindakan</td>
            <td class="font-size-8 border-left-1 border-right-1 border-bottom-1 text-center bd">1</td>
            <td class="font-size-8 border-left-1 border-right-1 border-bottom-1 text-center bd">
              <label class="container" style="width: 2%">
                <input type="radio" name="tanda_vital"
                  <?php if ($list['notes']['tanda_vital'] == '1') {
                      echo 'checked="checked"'; 
                    }
                  ?> value="1" required>
                <span class="checkmark"></span>
              </label>
            </td>
          </tr>

          <tr>
            <td class="font-size-8 border-left-1 border-right-1 border-bottom-1 bd">> 40 tanda vital sebelum tindakan</td>
            <td class="font-size-8 border-left-1 border-right-1 border-bottom-1 text-center bd">0</td>
            <td class="font-size-8 border-left-1 border-right-1 border-bottom-1 text-center bd">
              <label class="container" style="width: 2%">
                <input type="radio" name="tanda_vital"

                  <?php if ($list['notes']['tanda_vital'] == '0') {
                      echo 'checked="checked"';  
                    }
                  ?> value="0" required>
                <span class="checkmark"></span>
              </label>
            </td>
          </tr>

          <tr>
            <td rowspan="3" class="font-size-8 border-left-1 border-right-1 border-bottom-1 text-center">Aktivitas</td>
            <td class="font-size-8 border-left-1 border-right-1 border-bottom-1 bd">Sadar penuh dan bisa bergerak sendiri</td>
            <td class="font-size-8 border-left-1 border-right-1 border-bottom-1 bd text-center">2</td>
            <td class="font-size-8 border-left-1 border-right-1 border-bottom-1 bd text-center">
              <label class="container" style="width: 2%">
                <input type="radio" name="aktivitas"
                  <?php if ($list['notes']['aktivitas'] == '2') {
                      echo 'checked="checked"';  
                    }
                  ?> value="2" required>
                <span class="checkmark"></span>
              </label>
            </td>
          </tr>

          <tr>
            <td class="font-size-8 border-left-1 border-right-1 border-bottom-1 bd">Sadar penuh, Membutuhkan bantuan</td>
            <td class="font-size-8 border-left-1 border-right-1 border-bottom-1 bd text-center">1</td>
            <td class="font-size-8 border-left-1 border-right-1 border-bottom-1 bd text-center">
              <label class="container" style="width: 2%">
                <input type="radio" name="aktivitas"
                  <?php if ($list['notes']['aktivitas'] == '1') {
                      echo 'checked="checked"';  
                    }
                  ?> value="1" required>
                <span class="checkmark"></span>
              </label>
            </td>
          </tr>

          <tr>
            <td class="font-size-8 border-left-1 border-right-1 border-bottom-1 bd">Tidak sadar</td>
            <td class="font-size-8 border-left-1 border-right-1 border-bottom-1 bd text-center">0</td>
            <td class="font-size-8 border-left-1 border-right-1 border-bottom-1 bd text-center">
              <label class="container" style="width: 2%">
                <input type="radio" name="aktivitas"
                  <?php if ($list['notes']['aktivitas'] == '0') {
                      echo 'checked="checked"';  
                    }
                  ?> value="0" required>
                <span class="checkmark"></span>
              </label>
            </td>
          </tr>

          <tr>
            <td rowspan="3" class="font-size-8 border-left-1 border-right-1 border-bottom-1 text-center">Mual / Muntah</td>
            <td class="font-size-8 border-left-1 border-right-1 border-bottom-1 bd">Minimal, membutuhkan terapi oral</td>
            <td class="font-size-8 border-left-1 border-right-1 border-bottom-1 bd text-center">2</td>
            <td class="font-size-8 border-left-1 border-right-1 border-bottom-1 bd text-center">
              <label class="container" style="width: 2%">
                <input type="radio" name="mual_muntah"
                  <?php if ($list['notes']['mual_muntah'] == '2') {
                      echo 'checked="checked"';  
                    }
                  ?> value="2" required>
                <span class="checkmark"></span>
              </label>
            </td>
                      </tr>

          <tr>
            <td class="font-size-8 border-left-1 border-right-1 border-bottom-1 bd">Moderate, membutuhkan terapi parenteral</td>
            <td class="font-size-8 border-left-1 border-right-1 border-bottom-1 bd text-center">1</td>
            <td class="font-size-8 border-left-1 border-right-1 border-bottom-1 bd text-center">
              <label class="container" style="width: 2%">
                <input type="radio" name="mual_muntah"
                  <?php if ($list['notes']['mual_muntah'] == '1') {
                      echo 'checked="checked"';  
                    }
                  ?> value="1" required>
                <span class="checkmark"></span>
              </label>
            </td>
          </tr>

          <tr>
            <td class="font-size-8 border-left-1 border-right-1 border-bottom-1 bd">Berat, Membutuhkan terapi lanjut</td>
            <td class="font-size-8 border-left-1 border-right-1 border-bottom-1 bd text-center">0</td>
            <td class="font-size-8 border-left-1 border-right-1 border-bottom-1 bd text-center">
              <label class="container" style="width: 2%">
                <input type="radio" name="mual_muntah"
                  <?php if ($list['notes']['mual_muntah'] == '0') {
                      echo 'checked="checked"';  
                    }
                  ?> value="0" required>
                <span class="checkmark"></span>
              </label>
            </td>
          </tr>

          <tr>
            <td rowspan="2" class="font-size-8 border-left-1 border-right-1 border-bottom-1 text-center">Nyeri</td>
            <td class="font-size-8 border-left-1 border-right-1 border-bottom-1 bd">Nyeri, dapat dikontrol dengan terapi oral</td>
            <td class="font-size-8 border-left-1 border-right-1 border-bottom-1 bd text-center">2</td>
            <td class="font-size-8 border-left-1 border-right-1 border-bottom-1 bd text-center">
              <label class="container" style="width: 2%">
                <input type="radio" name="nyeri"
                  <?php if ($list['notes']['nyeri'] == '2') {
                      echo 'checked="checked"';  
                    }
                  ?> value="2" required>
                <span class="checkmark"></span>
              </label>
            </td>
          </tr>

          <tr>
            <td class="font-size-8 border-left-1 border-right-1 border-bottom-1 bd">Nyeri, tidak dapat dikontrol dengan terapi oral</td>
            <td class="font-size-8 border-left-1 border-right-1 border-bottom-1 bd text-center">1</td>
            <td class="font-size-8 border-left-1 border-right-1 border-bottom-1 bd text-center">
              <label class="container" style="width: 2%">
                <input type="radio" name="nyeri"
                  <?php if ($list['notes']['nyeri'] == '1') {
                      echo 'checked="checked"';  
                    }
                  ?> value="1" required>
                <span class="checkmark"></span>
              </label>
            </td>
          </tr>


          <tr>
            <td rowspan="3" class="font-size-8 border-left-1 border-right-1 border-bottom-1 text-center">Pendarahan dari luka operasi</td>
            <td class="font-size-8 border-left-1 border-right-1 border-bottom-1 bd">Minimal, tidak perlu mengganti balutan</td>
            <td class="font-size-8 border-left-1 border-right-1 border-bottom-1 bd text-center">2</td>
            <td class="font-size-8 border-left-1 border-right-1 border-bottom-1 bd text-center">
              <label class="container" style="width: 2%">
                <input type="radio" name="pendarahan"
                  <?php if ($list['notes']['pendarahan'] == '2') {
                      echo 'checked="checked"';  
                      
                    }
                  ?> value="2" required>
                <span class="checkmark"></span>
              </label>
            </td>
          </tr>

          <tr>
            <td class="font-size-8 border-left-1 border-right-1 border-bottom-1 bd">Moderate, perlu ganti 2 kali balutan</td>
            <td class="font-size-8 border-left-1 border-right-1 border-bottom-1 bd text-center">1</td>
            <td class="font-size-8 border-left-1 border-right-1 border-bottom-1 bd text-center">
              <label class="container" style="width: 2%">
                <input type="radio" name="pendarahan"
                  <?php if ($list['notes']['pendarahan'] == '1') {
                      echo 'checked="checked"';  
                      
                    }
                  ?> value="1" required>
                <span class="checkmark"></span>
              </label>
            </td>
          </tr>

          <tr>
            <td class="font-size-8 border-left-1 border-right-1 border-bottom-1 bd">Banyak, perlu 3 kali atau lebih ganti balutan</td>
            <td class="font-size-8 border-left-1 border-right-1 border-bottom-1 bd text-center">0</td>
            <td class="font-size-8 border-left-1 border-right-1 border-bottom-1 bd text-center">
              <label class="container" style="width: 2%">
                <input type="radio" name="pendarahan"
                  <?php if ($list['notes']['pendarahan'] == '0') {
                      echo 'checked="checked"';  
                      
                    }
                  ?> value="0" required>
                <span class="checkmark"></span>
              </label>
            </td>
          </tr>

          <tr>
            <td class="font-size-8 border-left-1 border-right-1 border-bottom-1 bd text-right" colspan="3">Total Skor Pasien</td>
            <td class="font-size-8 border-left-1 border-right-1 border-bottom-1 bd text-center"><?= $list['notes']['total_skor']; ?></td>
          </tr>

          
        </table>

  <div class="row-panel mt-20">
    <div class="column-left-header">
      <table border="0" width="100%" style="margin-left:150px">
        <tr>
          <td style="vertical-align:top" class="detail-administration r-bold font-size-7">Petugas yang Menyetujui,</td>
        </tr>
        <tr>
          <td style="vertical-align:top" class="font-table font-size-7"><img width="125px" src="<?php echo $list['notes']['digital_signature_approved_petugas'];?>"></td>
        </tr>
        <tr>
          <td style="vertical-align:top" class="font-table font-size-7 pl-3"><?php echo ucwords(strtolower($list['notes']['approved_petugas'])); ?></td>
        </tr>
      </table>
    </div>
    <div class="column-right-header">
      <table border="0" width="100%" style="margin-left:50px">
        <tr>
          <td style="vertical-align:top" class="detail-administration r-bold font-size-7">Dokter yang Menyetujui,</td>
        </tr>
        <tr>
          <td height="77px" style="vertical-align:top" class="font-table font-size-7 pl-5"><img width="125px" src="<?php echo $list['notes']['digital_signature_approved_dokter'];?>"></td>
        </tr>
        <tr>
          <td style="vertical-align:top" class="font-table font-size-7 pl-3"><?php echo ucwords(strtolower($list['notes']['approved_dokter'])); ?>
          <br>digital signature added: <?php echo date("d-m-Y H:i",strtotime($list['notes']['created_date']));?></td>
        </tr>
      </table>
      
    </div>
  </div>

        

        </div>
      </div>
    </div>
  </div>

</body>
</html>