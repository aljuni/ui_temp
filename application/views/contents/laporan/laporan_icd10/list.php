
<div class="col-md-12" id="view-container">
  <div class="row">
    <div class="col-md-5"> 
      <div class="row">
        <div class="col-md-2">
          <b>Bulan</b>
          <br>
          
       </div>
                  <!-- nama -->
        <div class="col-md-11">
          <div class="box-button">
        <button class="btn btn-default" style=" Margin-top: 10px;">Januari</button>&nbsp;
        <button class="btn btn-default" style=" Margin-top: 10px;">Februari</button>&nbsp;
        <button class="btn btn-default" style=" Margin-top: 10px;">Maret</button>&nbsp;
        <button class="btn btn-default" style=" Margin-top: 10px;">April</button>&nbsp;
        <button class="btn btn-default" style=" Margin-top: 10px;">Mei</button>&nbsp;
        <button class="btn btn-default" style=" Margin-top: 10px;">Juni</button>&nbsp;
        <button class="btn btn-default" style=" Margin-top: 10px;">Juli</button>&nbsp;
        <button class="btn btn-default" style=" Margin-top: 10px;">Agustus</button>&nbsp;
        <button class="btn btn-default" style=" Margin-top: 10px;">September</button>&nbsp;
        <button class="btn btn-default" style=" Margin-top: 10px;">Oktober</button>&nbsp;
        <button class="btn btn-default" style=" Margin-top: 10px;">November</button>&nbsp;
        <button class="btn btn-default" style=" Margin-top: 10px;">Desember</button>&nbsp;
       </div>
       </div>
     </div>
   </div>

    <div class="col-md-4"> 
      <div class="row">
        <div class="col-md-2">
          <b>Tahun</b>
        <br>
      
        </div>
                          <!-- nama -->
        <div class="col-md-12">
           <div class="box-button">
        <button class="btn btn-default" style=" Margin-top: 10px;">2017</button>&nbsp;
        <button class="btn btn-default" style=" Margin-top: 10px;">2018</button>&nbsp;
        <button class="btn btn-default" style=" Margin-top: 10px;">2019</button>&nbsp;
        <button class="btn btn-default" style=" Margin-top: 10px;">2020</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <button class="btn btn-primary" style=" Margin-top: 10px;">Buka Filter</button>
      </div>
        </div>
      </div>
    </div>
      

    <div class="col-md-3">  
      <div class="row">
                  <!-- nama -->
        <div class="col-md-2">
          <br>
          
          </div>
        <div class="col-md-12 text-right">
          <!-- <button class="btn btn-primary"><i class="fa fa-print"></i> PDF Summary</button> -->
          <a href="<?php echo  base_url() .'laporan_icd10' . '/print_pdf';?>" class="btn btn-primary" style=" Margin-top: 10px;"><i class="fa fa-print"></i> PDF</a>
          <a href="<?php echo  base_url() .'laporan_icd10' . '/export';?>" class="btn btn-success" style=" Margin-top: 10px;"><i class="fa fa-print"></i> Excel</a>
         <!--  <button class="btn btn-success" style=" Margin-top: 10px;"><i class="fa fa-download"></i> Excel</button> -->
        </div>

      </div>
    </div>

  </div>
  <br>
  <br>

  <div class="row">
    <div class="col-md-12">
      <table id="laporan_pasien" class="table" style="width:100%">
        <thead>
          <td>#</td>
          <td>Kode ICD</td>
          <td>Deskripsi</td>
          <td>Total Pria</td>
          <td>Total Wanita</td>
          <td>Total Pasien</td>
        </thead>
        <tbody>
        
        <?php 
              $data = $laporan_icd10;
              $keys = array_keys((array)$data);
              $tipe = '';
               $no=1;
              for ($i=0; $i < count($keys); $i++) { 
               
                $total = 0;
                if (isset($data[$keys[$i]]['primary'])) {
                  $tipe = 'primary';
                } else {
                  $tipe = 'secondary';
                }
          ?>
            <?php

            if (isset($data[$keys[$i]]['primary']) && isset($data[$keys[$i]]['secondary'])) {

                  $total_pria = $data[$keys[$i]]['primary']['total']['pria'] + $data[$keys[$i]]['secondary']['total']['pria'];
                  $total_wanita = $data[$keys[$i]]['primary']['total']['wanita'] + $data[$keys[$i]]['secondary']['total']['wanita'];
                } elseif(isset($data[$keys[$i]]['primary'])) {
                  $total_pria = $data[$keys[$i]]['primary']['total']['pria'];
                  $total_wanita = $data[$keys[$i]]['primary']['total']['wanita'];
                }else {
                  $total_pria = $data[$keys[$i]]['secondary']['total']['pria'];
                  $total_wanita = $data[$keys[$i]]['secondary']['total']['wanita'];
                }
              ?>
           <tr>
            <td><?= $no++ ?></td>
            <td><?= $keys[$i] ?></td>
            <td><?= $data[$keys[$i]][$tipe]['deskripsi'] ?> </td>
            <td><?= $total_pria; ?></td>
            <td><?= $total_wanita; ?></td>
            <td><?= $total_pria+=$total_wanita; ?></td>
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
    $('#laporan_pasien').DataTable();
  } );

</script>

<script>
 $(document).ready(function(){
  $('.box-button').on('click','button', function(){
    $(this).addClass('active').siblings().removeClass('active');
  });
});
</script>