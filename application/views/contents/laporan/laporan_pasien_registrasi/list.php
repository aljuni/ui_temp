
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

        <div class="col-md-6 text-right">
          <button class="btn btn-primary"><i class="fa fa-print"></i> PDF Summary</button>
          <button class="btn btn-primary"><i class="fa fa-print"></i> PDF</button>
          <button class="btn btn-success"><i class="fa fa-download"></i> Excel</button>
        </div>

      </div>
    </div>

  </div>

  <div class="row">
    <div class="col-md-12">
      <table id="laporan_pasien" class="table" style="width:100%">
        <thead>
          <td>No</td>
          <td>No Reg</td>
          <td>No BPJS</td>
          <td>No RM</td>
          <td>Penjamin</td>
          <td>Nama Pasien</td>
          <td>Umur</td>
          <td>Jenis Kelamin</td>
          <td>Alamat</td>
        </thead>
        <tbody>
        
        <!-- <?php foreach ($laporan_pasien_registrasi as $k => $v) : ?>
          <tr>
            <td><?= ++$k; ?></td>
            <td><?= $v['data_registrasi']['no_reg']; ?></td>
            <td><?= $v['data_pasien']['no_bpjs']; ?></td>
            <td><?= $v['data_pasien']['no_rm']; ?></td>
            <td><?= $v['data_pasien']['penjamin']; ?></td>
            <td><?= $v['data_pasien']['nama_pasien']; ?></td>
            <td><?= $v['data_pasien']['umur']; ?></td>
            <td><?= $v['data_pasien']['kelamin']; ?></td>
            <td><?= $v['data_pasien']['alamat_2']; ?></td>
          </tr>
        <?php endforeach; ?> -->

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