
<div class="col-md-12" id="view-container">
  <div class="row">
    <div class="col-md-4"> 

      <div class="row">
                  <!-- nama -->
        <div class="col-md-3">
          <b>Tanggal</b>
        </div>
        <div class="col-md-5">
          <input type="text" name="tanggal" id="tanggal" class="form-control" value="<?= date('Y-m-d') ?>" required autocomplete="off">
        </div>
        <div class="col-md-4">
          <button class="btn btn-primary">Buka Filter</button>
        </div>
      </div>
      <br>
    </div>

    <div class="col-md-8">  
      <div class="row">
                  <!-- nama -->
        <div class="col-md-4"></div>
        <div class="col-md-2"></div>

         <div class="col-md-12 text-right">
          <!-- <button class="btn btn-primary"><i class="fa fa-print"></i> PDF Summary</button> -->
          <a href="<?php echo  base_url() .'laporan_bpjs_sep' . '/print_pdf';?>" class="btn btn-primary" style=" Margin-top: 10px;"><i class="fa fa-print"></i> PDF</a>
          <a href="<?php echo  base_url() .'laporan_bpjs_sep' . '/export';?>" class="btn btn-success" style=" Margin-top: 10px;"><i class="fa fa-print"></i> Excel</a>
         <!--  <button class="btn btn-success" style=" Margin-top: 10px;"><i class="fa fa-download"></i> Excel</button> -->
        </div>

      </div>
    </div>

  </div>

  <div class="row">
    <div class="col-md-12">
      <table id="laporan_pasien" class="table font" style="width:100%">
        <thead>
          <tr>
          <td>No</td>
          <td>Id Pasien Registrasi</td>
          <td>No. Kartu</td>
          <td>Nama</td>
          <td>Tgl. SEP</td>
          <td>Tgl. Pulang</td>
          <td>No. Sep</td>
          <td>PPK Pelayanan</td>
          <td>Jns. Pelayanan</td>
          <td>Kelas Rawat</td>
          <td>Jns. Rawat</td>
          <td>No Mr</td>
          <td>Asal Rujukan</td>
          <td>Tgl. Rujukan</td>
          <td>No. Rujukan</td>
          <td>No. Rujukan Keluar</td>
          <td>Nama PPK Rujukan</td>
          <td>PPK Rujukan</td>
          <td>Catatan</td>
          <td>Diagnosa Awal</td>
          <td>Kode Diagnosa Awal</td>
          <td>Poli Tujuan</td>
          <td>Kode Poli Tujuan</td>
          <td>Eksekutif</td>
          <td>Cob</td>
          <td>Katarak</td>
          <td>Lakalantas</td>
          <td>Lokasi Laka</td>
          <td>Penjamin</td>
          <td>Tgl Kejadian</td>
          <td>Keterangan</td>
          <td>Suplesi</td>
          <td>No. SEP Suplesi</td>
          <td>kode Propinsi</td>
          <td>Kode Kabupaten</td>
          <td>Kode Kecamatan</td>
          <td>No. Surat</td>
          <td>Kode DPJP</td>
          <td>Nama DPJP</td>
          <td>Diinput Oleh</td>
          <td>Tanggal Dibuat</td>
          <td>Dihapus Oleh</td>
          <td>Petugas Pulang</td>
          <td>No. Telpon</td>
          <td>User</td>
          <td>Vclaim Rujukan</td>
          <td>Ref ICD10</td>

        </tr>
        </thead>
        <tbody>
          <?php 
             $no = 1;
              // trace($data[0]['noKartu']);
              foreach ($laporan_bpjs_sep as $data) {
                ?>
                <tr>
                <td><?= $no++ ?></td>
                <td><?= $data['id_pasien_registrasi'] ?></td>
                <td><?= $data['noKartu'] ?></td>
                <td><?= $data['nama'] ?></td>
                <td><?= $data['tglSep'] ?></td>
                <td><?= $data['tglPulang'] ?></td>
                <td><?= $data['noSep'] ?></td>
                <td><?= $data['ppkPelayanan'] ?></td>
                <td><?= $data['jnsPelayanan']['nama_detail'] ?></td> 
                <td><?= $data['klsRawat'] ?></td>
                <td><?= $data['jenis_rawat']['nama_detail'] ?></td>
                <td><?= $data['noMr'] ?></td>
                <td><?= $data['asalRujukan']['nama_detail'] ?></td> 
                <td><?= $data['tglRujukan'] ?></td>
                <td><?= $data['noRujukan'] ?></td>
                <td><?= $data['noRujukanKeluar'] ?></td>
                <td><?= $data['namaPpkRujukan'] ?></td>
                <td><?= $data['ppkRujukan'] ?></td>
                <td><?= $data['catatan'] ?></td>
                <td><?= $data['diagAwal'] ?></td>
                <td><?= $data['code_diagAwal'] ?></td>
                <td><?= $data['poliTujuan'] ?></td>
                <td><?= $data['code_poliTujuan'] ?></td>
                <td><?= $data['eksekutif'] ?></td>
                <td><?= $data['cob'] ?></td>
                <td><?= $data['katarak'] ?></td>
                <td><?= $data['lakaLantas'] ?></td>
                <td><?= $data['lokasiLaka'] ?></td>
                <td><?= $data['penjamin'] ?></td>
                <td><?= $data['tglKejadian'] ?></td>
                <td><?= $data['keterangan'] ?></td>
                <td><?= $data['suplesi'] ?></td>
                <td><?= $data['noSepSuplesi'] ?></td>
                <td><?= $data['kdPropinsi'] ?></td>
                <td><?= $data['kdKabupaten'] ?></td>
                <td><?= $data['kdKecamatan'] ?></td>
                <td><?= $data['noSurat'] ?></td>
                <td><?= $data['kodeDPJP'] ?></td>
                <td><?= $data['nama_dpjp'] ?></td>
                <td><?= $data['nama_petugas_input'] ?></td>
                <td><?= $data['created_date'] ?></td>
                <td><?= $data['nama_petugas_delete'] ?></td>
                <td><?= $data['nama_petugas_pulang'] ?></td>
                <td><?= $data['noTelp'] ?></td>
                <td><?= $data['user'] ?></td>
                <td><?= $data['vclaim_rujukan'] ?></td>
                <td><?= $data['ref_icd10']['nama_icd10'] ?></td>
              </tr>
             <?php }     ?>
        

        </tbody>
      </table>
    </div>
  </div>

</div>



<div class="col-md-12" id="form-container" style="display:none;"></div>

<script>
  $('#tanggal').datetimepicker({
    format:"YYYY-MM-DD",
    showTodayButton:true,
    timeZone:'',
    dayViewHeaderFormat: 'MMMM YYYY',
    stepping: 5,
    locale:moment.locale(),
    collapse:true,
    icons: {
          time:'fa fa-clock-o',
          date:'fa fa-calendar',
          up:'fa fa-chevron-up',
          down:'fa fa-chevron-down',
          previous:'fa fa-chevron-left',
          next:'fa fa-chevron-right',
          today:'fa fa-crosshairs',
          clear:'fa fa-trash-o',
          close:'fa fa-times'
    },
    sideBySide:true,
    calendarWeeks:false,
    viewMode:'days',
    viewDate:false,
    toolbarPlacement:'bottom',
    widgetPositioning:{
        horizontal: 'left',
        vertical: 'bottom'
    }
  });

  $(document).ready(function() {
    $('table').DataTable({
       "scrollX": true,
       "lengthMenu": [10, 50, 100, 200],
       "info" : true,
       "pageLength": 10,
       "order": [[3, 'desc']],
    });
  } );
</script>
