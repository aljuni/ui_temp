<html>
<head>
<title><?php echo $title;?></title>
<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<style>
  .row {
    margin-bottom: 15px;
  }

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
      <div class="row-heading border-blue bg-blue font-white font-size-9 r-bold">Data Penolakan Resusitasi</div>
        <div class="row-body">
          <table width="100%" cellspacing="0">
          <tr>
            <td width="5%" class="detail-administration r-bold font-size-8 pl-5 pt-2 pr-2 border-left-1 border-right-1 border-bottom-1 centerp-head">No</td>
            <td width="25%" class="detail-administration r-bold font-size-8 pl-5 pt-2 pr-2 border-left-1 border-right-1 border-bottom-1" style="padding: 10px 0px 10px 5px; text-align: center">Jenis Informasi</td>
            <td width="70%" class="detail-administration r-bold font-size-8 pl-5 pt-2 pr-2 border-left-1 border-right-1 border-bottom-1 centerp-row" style="padding: 10px 0px 10px 5px; text-align: center;">Isi Informasi</td>
          </tr>

          <tr>
            <td width="5%" class="detail-administration font-size-8 pl-5 pt-2 pr-2 border-left-1 border-bottom-1 centerp-head">1</td>
            <td width="25%" class="detail-administration  font-size-8 pl-5 pt-2 pr-2 border-left-1 border-right-1 border-bottom-1 centerp-row">Diagnosis (WD & DD)</td>
            <td width="70%" class="detail-administration  font-size-8 pl-5 pt-2 pr-2 border-left-1 border-right-1 border-bottom-1 centerp-row"><?= $list['notes']['diagnosis']; ?></td>
          </tr>

          <tr>
            <td width="5%" class="detail-administration font-size-8 pl-5 pt-2 pr-2 border-left-1 border-bottom-1 centerp-head">2</td>
            <td width="25%" class="detail-administration  font-size-8 pl-5 pt-2 pr-2 border-left-1 border-right-1 border-bottom-1 centerp-row">Dasar Diagnosis</td>
            <td width="70%" class="detail-administration  font-size-8 pl-5 pt-2 pr-2 border-left-1 border-right-1 border-bottom-1 centerp-row"><?= $list['notes']['dasar_diagnosis']; ?></td>
          </tr>          

          <tr>
            <td width="5%" class="detail-administration font-size-8 pl-5 pt-2 pr-2 border-left-1 border-bottom-1 centerp-head">3</td>
            <td width="25%" class="detail-administration  font-size-8 pl-5 pt-2 pr-2 border-left-1 border-right-1 border-bottom-1 centerp-row">Tindakan Kedokteran</td>
            <td width="70%" class="detail-administration  font-size-8 pl-5 pt-2 pr-2 border-left-1 border-right-1 border-bottom-1 centerp-row"><?= $list['notes']['tindakan']; ?></td>
          </tr>

          <tr>
            <td width="5%" class="detail-administration font-size-8 pl-5 pt-2 pr-2 border-left-1 border-bottom-1 centerp-head">4</td>
            <td width="25%" class="detail-administration  font-size-8 pl-5 pt-2 pr-2 border-left-1 border-right-1 border-bottom-1 centerp-row">Indikasi Tindakan</td>
            <td width="70%" class="detail-administration  font-size-8 pl-5 pt-2 pr-2 border-left-1 border-right-1 border-bottom-1 centerp-row"><?= $list['notes']['indikasi_tindakan']; ?></td>
          </tr>

          <tr>
            <td width="5%" class="detail-administration font-size-8 pl-5 pt-2 pr-2 border-left-1 border-bottom-1 centerp-head" style="padding: 40px 0px 40px 5px">5</td>
            <td width="25%" class="detail-administration  font-size-8 pl-5 pt-2 pr-2 border-left-1 border-right-1 border-bottom-1 centerp-row" style="padding: 40px 0px 40px 5px">Tata Cara</td>
            <td width="70%" class="detail-administration  font-size-8 pl-5 pt-2 pr-2 border-left-1 border-right-1 border-bottom-1 centerp-row"><?= $list['notes']['tata_cara']; ?></td>
          </tr>

          <tr>
            <td width="5%" class="detail-administration font-size-8 pl-5 pt-2 pr-2 border-left-1 border-bottom-1 centerp-head">6</td>
            <td width="25%" class="detail-administration  font-size-8 pl-5 pt-2 pr-2 border-left-1 border-right-1 border-bottom-1 centerp-row">Tujuan</td>
            <td width="70%" class="detail-administration  font-size-8 pl-5 pt-2 pr-2 border-left-1 border-right-1 border-bottom-1 centerp-row"><?= $list['notes']['tujuan']; ?></td>
          </tr>

          <tr>
            <td width="5%" class="detail-administration font-size-8 pl-5 pt-2 pr-2 border-left-1 border-bottom-1 centerp-head">7</td>
            <td width="25%" class="detail-administration  font-size-8 pl-5 pt-2 pr-2 border-left-1 border-right-1 border-bottom-1 centerp-row">Risiko</td>
            <td width="70%" class="detail-administration  font-size-8 pl-5 pt-2 pr-2 border-left-1 border-right-1 border-bottom-1 centerp-row"><?= $list['notes']['risiko']; ?></td>
          </tr>

          <tr>
            <td width="5%" class="detail-administration font-size-8 pl-5 pt-2 pr-2 border-left-1 border-bottom-1 centerp-head">8</td>
            <td width="25%" class="detail-administration  font-size-8 pl-5 pt-2 pr-2 border-left-1 border-right-1 border-bottom-1 centerp-row">Komplikasi</td>
            <td width="70%" class="detail-administration  font-size-8 pl-5 pt-2 pr-2 border-left-1 border-right-1 border-bottom-1 centerp-row"><?= $list['notes']['komplikasi']; ?></td>
          </tr>

          <tr>
            <td width="5%" class="detail-administration font-size-8 pl-5 pt-2 pr-2 border-left-1 border-bottom-1 centerp-head">9</td>
            <td width="25%" class="detail-administration  font-size-8 pl-5 pt-2 pr-2 border-left-1 border-right-1 border-bottom-1 centerp-row">Prognosis</td>
            <td width="70%" class="detail-administration  font-size-8 pl-5 pt-2 pr-2 border-left-1 border-right-1 border-bottom-1 centerp-row"><?= $list['notes']['prognosis']; ?></td>
          </tr>

          <tr>
            <td width="5%" class="detail-administration font-size-8 pl-5 pt-2 pr-2 border-left-1 border-bottom-1 centerp-head">10</td>
            <td width="25%" class="detail-administration  font-size-8 pl-5 pt-2 pr-2 border-left-1 border-right-1 border-bottom-1 centerp-row">Alternatif & Risiko</td>
            <td width="70%" class="detail-administration  font-size-8 pl-5 pt-2 pr-2 border-left-1 border-right-1 border-bottom-1 centerp-row"><?= $list['notes']['alternatif_risiko']; ?></td>
          </tr>

          <tr>
            <td width="5%" class="detail-administration font-size-8 pl-5 pt-2 pr-2 border-left-1 border-bottom-1 centerp-head">11</td>
            <td width="25%" class="detail-administration  font-size-8 pl-5 pt-2 pr-2 border-left-1 border-right-1 border-bottom-1 centerp-row">Lain - Lain</td>
            <td width="70%" class="detail-administration  font-size-8 pl-5 pt-2 pr-2 border-left-1 border-right-1 border-bottom-1 centerp-row"><?= $list['notes']['lain_lain']; ?></td>
          </tr>

        </table>

        <table width="100%" cellspacing="0">
          <tr>
            <td width="50%" style="text-align: justify;" class="detail-administration font-size-10 pl-5 pt-5 pr-5 border-left-1 border-right-1 border-bottom-1">
              Dengan ini menyatakan bahwa saya telah menerangkan secara benar, jelas, dan jujur, disertai kesempatan untuk bertanya dan berdiskusi terhadap hal-hal yang meliputi seperti tersebut di atas.
            </td>
            <td width="50%" style="text-align: center;" class="detail-administration r-bold font-size-8 pl-5 pt-2 pr-2 pb-2 border-left-1 border-right-1 border-bottom-1">
              Pemberi Informasi<br>
              <img width="100px" src="<?php echo $list['notes']['digital_signature_approved_dokter'];?>
              "><br><br>
              <?php echo ucwords(strtolower($list['notes']['approved_dokter'])); ?><br>
              <br>digital signature added: <?php echo date("d-m-Y H:i",strtotime($list['notes']['created_date']));?>
              <!-- Tanda tangan dan Nama jelas<br> -->
            </td>
          </tr>
         
         <tr>
            <td width="50%" style="text-align: justify;" class="detail-administration font-size-10 pl-5 pt-5 pr-5 border-left-1 border-right-1 border-bottom-1">
              Dengan ini menyatakan bahwa saya telah menerima informasi sebagaimana di atas, atas informasi yang diberikan tersebut saya telah mengerti dan memahaminya.
            </td>
            <td width="50%" style="text-align: center;" class="detail-administration r-bold font-size-8 pl-5 pt-2 pr-2 pb-2 border-left-1 border-right-1 border-bottom-1">
              Penerima Informasi<br>
              <img width="100px" src="<?php echo $list['notes']['digital_signature_approved_petugas'];?>"><br><br>
              <?php echo ucwords(strtolower($list['notes']['approved_petugas'])); ?>
              <!-- Tanda tangan dan Nama jelas<br> -->
            </td>
          </tr>

        </table>

        </div>
      </div>
    </div>
  </div>

</body>
</html>