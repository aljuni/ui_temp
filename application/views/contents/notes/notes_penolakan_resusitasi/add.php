<div class="row">
  <div class="col-md-12">

<!-- start input panel col 6 sendiri -->

    <form id="form-add-1-<?= $this->router->fetch_class(); ?>">
      <input type="hidden" class="form-control input-sm" name="id_reg" id="id_reg" value="<?= $id_reg ?>">
      <input type="hidden" class="form-control input-sm" name="id_visit" id="id_visit" value="<?= $id_visit ?>">
      <div class="row">
        <div class="col-md-6">
          <div class="panel panel-primary">
            <div class="panel-heading">Tambah Data Penolakan Resusitasi</div>
            <div class="panel-body">

            <div class="row">
              <div class="col-md-12">  

                <div class="row">
                    <!-- nama -->
                  <div class="col-md-4">
                    <b>Dokter Pelaksana Tindakan</b>
                  </div>
                  <div class="col-md-8">
                    <select name="dokter_approved" class="dokter_approved" style="width: 100%" required>
                      <option value=""></option>
                      <?php foreach ($data_dokter as $k => $v) : ?>
                        <option value="<?= $v['id'] ?>"><?= $v['nama'] ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
                <br>

                <div class="row">
                    <!-- nama -->
                  <div class="col-md-4">
                    <b>Petugas Pemberi Informasi</b>
                  </div>
                  <div class="col-md-8">
                    <select name="petugas_approved" class="petugas_approved" style="width: 100%" required>
                      <option value=""></option>
                      <?php foreach ($data_perawat as $k => $v) : ?>
                        <option value="<?= $v['id'] ?>"><?= $v['nama'] ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
                <br>

                <div class="row">
                    <!-- nama -->
                  <div class="col-md-4">
                    <b>Penerima Informasi</b>
                  </div>
                  <div class="col-md-8">
                    <input type="text" class="form-control input-sm" name="penerima_informasi" id="penerima_informasi" value="" >
                  </div>
                </div>
                <br>

                <div class="row">
                    <!-- nama -->
                  <div class="col-md-4">
                    <b>Diagnosis</b>
                  </div>
                  <div class="col-md-8">
                    <input type="text" class="form-control input-sm" name="diagnosis" id="diagnosis" value="" >
                  </div>
                </div>
                <br>

                <div class="row">
                    <!-- nama -->
                  <div class="col-md-4">
                    <b>Dasar Diagnosis</b>
                  </div>
                  <div class="col-md-8">
                    <input type="text" class="form-control input-sm" name="dasar_diagnosis" id="dasar_diagnosis" value="" >
                  </div>
                </div>
                <br>

                <div class="row">
                    <!-- nama -->
                  <div class="col-md-4">
                    <b>Tindakan Kedokteran</b>
                  </div>
                  <div class="col-md-8">
                    <input type="text" class="form-control input-sm" name="tindakan" id="tindakan" value="" >
                  </div>
                </div>
                <br>

                <div class="row">
                    <!-- nama -->
                  <div class="col-md-4">
                    <b>Indikasi Tindakan</b>
                  </div>
                  <div class="col-md-8">
                    <input type="text" class="form-control input-sm" name="indikasi_tindakan" id="indikasi_tindakan" value="" >
                  </div>
                </div>
                <br>

                <div class="row">
                    <!-- nama -->
                  <div class="col-md-4">
                    <b>Tata Cara</b>
                  </div>
                  <div class="col-md-8">
                    <input type="text" class="form-control input-sm" name="tata_cara" id="tata_cara" value="" >
                  </div>
                </div>
                <br>

                <div class="row">
                    <!-- nama -->
                  <div class="col-md-4">
                    <b>Tujuan</b>
                  </div>
                  <div class="col-md-8">
                    <input type="text" class="form-control input-sm" name="tujuan" id="tujuan" value="" >
                  </div>
                </div>
                <br>

                <div class="row">
                    <!-- nama -->
                  <div class="col-md-4">
                    <b>Risiko</b>
                  </div>
                  <div class="col-md-8">
                    <input type="text" class="form-control input-sm" name="risiko" id="risiko" value="" >
                  </div>
                </div>
                <br>

                <div class="row">
                    <!-- nama -->
                  <div class="col-md-4">
                    <b>Komplikasi</b>
                  </div>
                  <div class="col-md-8">
                    <input type="text" class="form-control input-sm" name="komplikasi" id="komplikasi" value="" >
                  </div>
                </div>
                <br>

                <div class="row">
                    <!-- nama -->
                  <div class="col-md-4">
                    <b>Prognosis</b>
                  </div>
                  <div class="col-md-8">
                    <input type="text" class="form-control input-sm" name="prognosis" id="prognosis" value="" >
                  </div>
                </div>
                <br>

                <div class="row">
                    <!-- nama -->
                  <div class="col-md-4">
                    <b>Alternatif & Risiko</b>
                  </div>
                  <div class="col-md-8">
                    <input type="text" class="form-control input-sm" name="alternatif_risiko" id="alternatif_risiko" value="" >
                  </div>
                </div>
                <br>

                <div class="row">
                    <!-- nama -->
                  <div class="col-md-4">
                    <b>Lain-Lain</b>
                  </div>
                  <div class="col-md-8">
                    <input type="text" class="form-control input-sm" name="lain_lain" id="lain" value="" >
                  </div>
                </div>
                <br>

              </div>

            </div>
            </div>
            <div class="panel-footer text-right">
            <button class="btn btn-default btn-sm btn-batal-<?= $this->router->fetch_class(); ?>">Batal</button>
            <button type="submit" class="btn btn-primary btn-sm btn-kirim-<?= $this->router->fetch_class(); ?>">Simpan</button>
            </div>
          </div>
        </div>
      </div>
    </form>
<!-- end input panel col 6 sendiri -->

  </div>
</div>


<script type="text/javascript">

  $('.dokter_approved').select2({
    placeholder: "-- Pilih dokter Approve --"
  });

  $('.petugas_approved').select2({
    placeholder: "-- Pilih petugas Approve --"
  });

  $('#jam').datetimepicker({
    format:"HH:mm",
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

  $(".btn-toggle").click(function (e) { 
    e.preventDefault();
    
    $(".btn-toggle").removeClass("btn-primary");
    $(this).addClass("btn-primary");
    var id = $(this).data('id');

    $("input[name='btn-toggle-val']").val(id);
  });

  $('.btn-batal-<?= $this->router->fetch_class(); ?>').click(function (e)
  {
    e.preventDefault();

    $('#view-container').show();
    $('#form-container').hide();
    $('#form-container').html('');
  });

  $('#form-add-1-<?= $this->router->fetch_class(); ?>').submit(function (e) 
  {
    e.preventDefault();
    $('.btn-kirim-<?= $this->router->fetch_class(); ?>').attr('disabled', true);

    $.post('<?php echo base_url();?>'+class_name+'/add_process/list', $(this).serialize()
    ).done(function(data) {
      console.log(data);
      var data = JSON.parse(data);
      console.log(data);
      if (data.status == '200') {
        alert('Data berhasil disimpan');
        location.reload();
      } else {
        alert('Gagal menampilkan data');
        $('.btn-kirim-<?= $this->router->fetch_class(); ?>').removeAttr('disabled');
        $('.btn-kirim-<?= $this->router->fetch_class(); ?>').removeAttr('disabled');
      }
    }).fail(function() {
      alert('Gagal menampilkan data')
      $('.btn-kirim-<?= $this->router->fetch_class(); ?>').removeAttr('disabled');
    });
  });

</script>