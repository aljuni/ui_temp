<br>
<div class="col-md-12" id="view-container">
  <div class="row">
    <div class="col-md-4"> 

      <div class="row">
                  <!-- nama -->
        <div class="col-md-3">
        </div>
        <div class="col-md-5">
        </div>
        <div class="col-md-4">
        </div>
      </div>
      <br>
    </div>

    <div class="col-md-8">  
      <div class="row">
                  <!-- nama -->
        <div class="col-md-4"></div>
        <div class="col-md-2"></div>

        <div class="col-md-6 text-right">
          <a href="<?php echo base_url() . 'laporan_statistik'. '/print_pdf';?>" class="btn btn-primary" target="blank"><i class="fa fa-print"></i> PDF</a>
          <a href="<?php echo base_url() . 'laporan_statistik'. '/export';?>" class="btn btn-success"><i class="fa fa-download"></i> Excel</a>
        </div>

      </div>
    </div>

  </div>

  <br><br>

<!-- Tabel culumn 1 -->
  <div class="row">
    <div class="col-md-4">
      <table id="data_umur" class="table nowrap" style="width:100%">
        <thead>
          <td>Pasien - Umur</td>
          <td>L</td>
          <td>P</td>
          <td>Total</td>
        </thead>
        <tbody>
          <?php 
              $data = $laporan_statistik['data_umur'];
              $keys = array_keys((array)$data);
              
              for ($i=0; $i < count($keys); $i++) { 
                
          ?>
          <tr>
            <td><?= $keys[$i] ?></td>
            <td><?= $data[$keys[$i]]['pria'] ?></td>
            <td><?= $data[$keys[$i]]['wanita'] ?></td>
            <td><?= $data[$keys[$i]]['pria'] + $data[$keys[$i]]['wanita'] ?></td>
          </tr>
          <?php } ?>
        </tbody>
      </table>
      <br><br>
      
      <table id="data_lokasi" class="table nowrap" style="width:100%">
        <thead>
          <tr>
            <td colspan="4" class="text-center">Geolocation</td>
          </tr>
          <tr>
            <td>Kecamatan</td>
            <td>L</td>
            <td>P</td>
            <td>Total</td>
          </tr>
        </thead>
        <tbody>
          <?php 
              $data = $laporan_statistik['data_lokasi'];
              $keys = array_keys((array)$data);
              
              for ($i=0; $i < count($keys); $i++) { 
                
          ?>
          <!-- Dummy data -->
          <tr>
            <td><?= $keys[$i] ?></td>
            <td><?= $data[$keys[$i]]['pria'] ?></td>
            <td><?= $data[$keys[$i]]['wanita'] ?></td>
            <td><?= $data[$keys[$i]]['pria'] + $data[$keys[$i]]['wanita'] ?></td>
          </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>


<!-- Tabel Column 2 -->
    <div class="col-md-4">
      <table id="icd10" class="table nowrap" style="width:100%">
        <thead>
          <td width="15%">ICD 10</td>
          <td width="75%">Deskripsi</td>
          <td width="10%">Total</td>
        </thead>
        <tbody>
           <?php 
              $data = $laporan_icd10;
              $keys = array_keys((array)$data);
              
              for ($i=0; $i < count($keys); $i++) { 
                
          ?>
          <!-- Dummy data -->
          <tr>
            <td><?= $keys[$i] ?></td>
            <?php
            $total = 0;
            if (isset($data[$keys[$i]]['primary']) && isset($data[$keys[$i]]['secondary'])) {
              $type = 'primary';
              $total_icd10 = $data[$keys[$i]]['primary']['total']['pria'] + $data[$keys[$i]]['primary']['total']['wanita'];
              $total_icd10 += $data[$keys[$i]]['secondary']['total']['pria'] + $data[$keys[$i]]['secondary']['total']['wanita'];
            }elseif (isset($data[$keys[$i]]['secondary'])) {
              $type = 'secondary';
              $total_icd10 = $data[$keys[$i]][$type]['total']['pria'] + $data[$keys[$i]][$type]['total']['wanita'];
            }else{
              $type = 'primary';
              $total_icd10 = $data[$keys[$i]][$type]['total']['pria'] + $data[$keys[$i]][$type]['total']['wanita'];
            }

            ?>
            <td><?= $data[$keys[$i]][$type]['deskripsi'] ?></td>
            <td><?= $total_icd10 ?></td>
          </tr>

          <?php } ?>

        </tbody>
      </table>
    </div>

<!-- Tabel Column 3 -->
    <div class="col-md-4">
      
      <table id="" class="table nowrap" style="width:100%">
        <thead>
          <td colspan="2" class="text-center">Pasien Lama / Baru</td>
        </thead>
        <tbody>
          <?php 
              $data = $laporan_statistik['data_status_pasien'];
              $total_pasien = $data['lama'] + $data['baru'];
          ?>
          <!-- Dummy data -->
          <tr>
            <td width="90%">Pasien Lama</td>
            <td><?= $data['lama'] ?></td>
          </tr>
          <tr>
            <td>Pasien Baru</td>
            <td><?= $data['baru'] ?></td>
          </tr>
        </tbody>
      </table>
      
      <br>
      
      <table id="" class="table nowrap" style="width:100%">
        <thead>
          <td colspan="2" class="text-center">Pasien Laki-laki / Perempuan</td>
        </thead>
        <tbody>
          <?php 
              $data = $laporan_statistik['data_kelamin'];
          ?>
          <!-- Dummy data -->
          <tr>
            <td width="90%">Pasien Laki-laki</td>
            <td><?= $data['pria'] ?></td>
          </tr>
          <tr>
            <td>Pasien Perempuan</td>
            <td><?= $data['wanita'] ?></td>
          </tr>
        </tbody>
      </table>

      <br>

      <table id="" class="table nowrap" style="width:100%">
        <thead>
          <td colspan="2" class="text-center">Pasien total</td>
        </thead>
        <tbody>
          <!-- Dummy data -->
          <tr>
            <td width="90%">Total Pasien</td>
            <td><?= $total_pasien ?></td>
          </tr>
        </tbody>
      </table>

      <br>

      <table id="" class="table nowrap" style="width:100%">
        <thead>
          <td colspan="2" class="text-center">Penjamin</td>
        </thead>
        <tbody>
          <?php 
              $data = $laporan_statistik['data_penjamin'];
              $keys = array_keys((array)$data);
              
              for ($i=0; $i < count($keys); $i++) { 
          ?>
          <tr>
            <td width="90%"><?= $keys[$i] ?></td>
            <td><?= $data[$keys[$i]] ?></td>
          </tr>
          <?php } ?>
        </tbody>
      </table>

      <br>

      <table id="" class="table nowrap" style="width:100%">
        <thead>
          <td colspan="2" class="text-center">Dokter</td>
        </thead>
        <tbody>
          <!-- Dummy data -->
          <?php 
              $data = $laporan_statistik['data_dokter'];
              $keys = array_keys((array)$data);
              
              for ($i=0; $i < count($keys); $i++) { 
                
          ?>
          <tr>
            <td width="90%"><?= $keys[$i] ?></td>
            <td><?= $data[$keys[$i]] ?></td>
          </tr>
          <?php } ?>
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
    $('table#data_umur').DataTable({
       "scrollX": true,
       "lengthMenu": [10, 50, 100, 200],
       "info" : true,
       "pageLength": 10,
       "order": [[3, 'desc']],
    });
    $('table#data_lokasi').DataTable({
       "scrollX": true,
       "lengthMenu": [10, 50, 100, 200],
       "info" : true,
       "pageLength": 10,
       "order": [[3, 'desc']],
    });
    $('table#icd10').DataTable({
       "scrollX": true,
       "lengthMenu": [10, 50, 100, 200],
       "info" : true,
       "pageLength": 10,
       "order": [[2, 'desc']],
    });
  });

</script>