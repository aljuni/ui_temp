<div class="row">
  <div class="col-md-12">

<!-- start input panel col 6 sendiri -->

    <form id="form-edit-1">
      <input type="hidden" class="form-control input-sm" name="id_notes" id="id_notes" value="<?= $result['id_notes']; ?>" >
      <input type="hidden" class="form-control input-sm" name="id_reg" id="id_reg" value="<?= $result['id_reg']; ?>" >
      <input type="hidden" class="form-control input-sm" name="id_visit" id="id_visit" value="<?= $result['id_visit']; ?>" >
      
      <div class="row">
        <div class="col-md-6">
          <div class="panel panel-primary">
            <div class="panel-heading">Edit Data Laporan Sedasi</div>
            <div class="panel-body">

            <div class="row">
              <div class="col-md-4"> 

                <div class="row">
                  <!-- nama -->
                  <div class="col-md-4">
                    <b>Tanggal</b>
                  </div>
                  <div class="col-md-8">
                    <input type="text" name="tanggal" id="tanggal" class="form-control" value="<?= date('Y-m-d', strtotime($result['tanggal'])) ?>" required autocomplete="off">
                  </div>
                </div>
                <br>
              </div>
              
              <div class="col-md-4">  
                <div class="row">
                  <!-- nama -->
                  <div class="col-md-4">
                    <b>Jam Mulai</b>
                  </div>
                  <div class="col-md-8">
                    <input type="text" name="jam" id="jam" class="form-control" value="<?= $result['jam']; ?>" required autocomplete="off">
                  </div>
                </div>
              </div>

              <div class="col-md-4">  
                <div class="row">
                  <!-- nama -->
                  <div class="col-md-4">
                    <b>Jam Berakhir</b>
                  </div>
                  <div class="col-md-8">
                    <input type="text" name="jam_akhir" id="jam_akhir" class="form-control" value="<?= $result['jam_akhir']; ?>" required autocomplete="off">
                  </div>
                </div>

              </div>
            </div>
            <br>

            <div class="row">
              <div class="col-md-12">  

                <div class="row">
                    <!-- nama -->
                  <div class="col-md-4">
                    <b>Dokter Pelaksana</b>
                  </div>
                  <div class="col-md-8">
                    <select name="dokter_approved" class="dokter_approved" style="width: 100%" required>
                      <option value=""></option>
                      <?php foreach ($data_dokter as $k => $v) : 
                        $selected = '';
                        if ($v['nama'] == $result['approved_dokter']) {
                          $selected = 'selected';
                        }
                      ?>
                        <option value="<?= $v['id'] ?>" <?= $selected ?>><?= $v['nama'] ?></option>
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
                      <?php foreach ($data_perawat as $k => $v) : 
                        
                        $selected = '';
                        if ($v['nama'] == $result['approved_petugas']) {
                          $selected = 'selected';
                        }  
                      ?>
                        <option value="<?= $v['id'] ?>" <?= $selected ?>><?= $v['nama'] ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
                <br>

                <div class="row">
                    <!-- nama -->
                  <div class="col-md-4">
                    <b>Diagnosis</b>
                  </div>
                  <div class="col-md-8">
                    <input type="text" class="form-control input-sm" name="diagnosis" id="diagnosis" value="<?= $result['diagnosis']; ?>" >
                  </div>
                </div>
                <br>

                <div class="row">
                    <!-- nama -->
                  <div class="col-md-4">
                    <b>Tindakan</b>
                  </div>
                  <div class="col-md-8">
                    <input type="text" class="form-control input-sm" name="tindakan" id="tindakan" value="<?= $result['tindakan']; ?>" >
                  </div>
                </div>
                <br>

                <div class="row">
                    <!-- nama -->
                  <div class="col-xs-4">
                    <b>Level sedasi</b>
                  </div>
                  <div class="col-xs-8">
                    <div class="row">
                      <div class="col-xs-12">
                        <div class="row">
                          <div class="col-xs-4">
                            <label class="container">Ringan
                              <input type="radio" name="level_sedasi"
                              <?php if ($result['level_sedasi'] == 'ringan') {
                                echo 'checked="checked"';  
                              }
                              ?> value="ringan">
                              <span class="checkmark"></span>
                            </label>
                          </div>
                          <div class="col-xs-4">
                            <label class="container">Sedang
                              <input type="radio" name="level_sedasi"
                              <?php if ($result['level_sedasi'] == 'sedang') {
                                echo 'checked="checked"';  
                              }
                              ?> value="sedang">
                              <span class="checkmark"></span>
                            </label>
                          </div>
                          <div class="col-xs-4">
                            <label class="container">Dalam
                              <input type="radio" name="level_sedasi"
                              <?php if ($result['level_sedasi'] == 'dalam') {
                                echo 'checked="checked"';  
                              }
                              ?> value="dalam">
                              <span class="checkmark"></span>
                            </label>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <br>

                <div class="row">
                    <!-- nama -->
                  <div class="col-md-4">
                    <b>Obat sedasi yang diberikan</b>
                  </div>
                  <div class="col-md-8">
                    <input type="text" class="form-control input-sm" name="obat_sedasi" id="obat_sedasi" value="<?= $result['obat_sedasi']; ?>" >
                  </div>
                </div>
                <br><hr><br>

                <div class="row">
                    <!-- nama -->
                  <div class="col-md-4">
                    <b>Monitoring Selama sedasi</b>
                  </div>
                </div>
                <br>

                <div class="row">
                    <!-- nama -->
                  <div class="col-md-4">
                    <b>Jam Monitoring</b>
                  </div>
                  <div class="col-md-8">
                    <input type="text" name="jam_monitoring" id="jam_monitoring" class="form-control" value="07:00" required autocomplete="off">
                  </div>
                </div>
                <br>

                <div class="row">
                    <!-- nama -->
                  <div class="col-md-4">
                    <b>Tekanan Darah</b>
                  </div>
                  <div class="col-md-8">
                    <input type="text" class="form-control input-sm" name="tekanan_darah" id="tekanan_darah" value="<?= $result['tekanan_darah'] ?>" required>
                  </div>
                </div>
                <br>

                <div class="row">
                    <!-- nama -->
                  <div class="col-md-4">
                    <b>Nadi</b>
                  </div>
                  <div class="col-md-8">
                    <input type="text" class="form-control input-sm" name="nadi" id="nadi" value="<?= $result['nadi'] ?>" required>
                  </div>
                </div>
                <br>

                <div class="row">
                    <!-- nama -->
                  <div class="col-md-4">
                    <b>Pernapasan</b>
                  </div>
                  <div class="col-md-8">
                    <input type="text" class="form-control input-sm" name="pernapasan" id="pernapasan" value="<?= $result['pernapasan'] ?>" required>
                  </div>
                </div>
                <br>

                <div class="row">
                    <!-- nama -->
                  <div class="col-md-4">
                    <b>SpO2</b>
                  </div>
                  <div class="col-md-8">
                    <input type="text" class="form-control input-sm" name="spo2" id="spo2" value="<?= $result['spo2'] ?>" required>
                  </div>
                </div>
                <br><br>

                <div class="row">
                    <!-- nama -->
                  <div class="col-md-4">
                    Kriteria Pemulihan sedasi<br>
                    PAD5
                  </div>
                </div>

                <div class="row">
                  <table width="100%" class="bd">
                    <thead>
                      <tr class="text-center bd bottom">
                        <td width="20%" class="bd bottom"><b>Yang dinilai</b></td>
                        <td width="50%" class="bd bottom"><b>Penilaian</b></td>
                        <td width="15%" class="bd bottom"><b>Skor</b></td>
                        <td width="15%" class="bd bottom"><b>Skor Pasien</b></td>
                      </tr>
                    </thead>
                    <tbody>

                      <tr class="bd">
                        <td rowspan="3" class="text-center centerp bd bottom">Tanda Vital (TD dan Nadi)</td>
                        <td class="centerp bd">< 20% tanda vital sebelum tindakan</td>
                        <td class="text-center bd">2</td>
                        <td class="text-center bd">
                          <label class="container" style="width: 2%">
                            <input onclick="updateTotal()" type="radio" name="tanda_vital"
                              <?php if ($result['tanda_vital'] == '2') {
                                  echo 'checked="checked"';  
                                }
                              ?> value="2">
                            <span class="checkmark"></span>
                          </label>
                        </td>
                      </tr>

                      <tr>
                        <td class="centerp bd">20%-40 tanda vital sebelum tindakan</td>
                        <td class="text-center bd">1</td>
                        <td class="text-center bd">
                          <label class="container" style="width: 2%">
                            <input onclick="updateTotal()" type="radio" name="tanda_vital"
                            <?php if ($result['tanda_vital'] == '1') {
                                echo 'checked="checked"';  
                              }
                            ?> value="1">
                            <span class="checkmark"></span>
                          </label>
                        </td>
                      </tr>

                      <tr>
                        <td class="centerp bd bottom">> 40 tanda vital sebelum tindakan</td>
                        <td class="text-center bd bottom">0</td>
                        <td class="text-center bd bottom">
                          <label class="container" style="width: 2%">
                            <input onclick="updateTotal()" type="radio" name="tanda_vital"
                            <?php if ($result['tanda_vital'] == '0') {
                                echo 'checked="checked"';  
                              }
                            ?> value="0">
                            <span class="checkmark"></span>
                          </label>
                        </td>
                      </tr>

                      <tr>
                        <td rowspan="3" class="text-center centerp bottom">Aktivitas</td>
                        <td class="centerp bd">Sadar penuh dan bisa bergerak sendiri</td>
                        <td class="text-center bd">2</td>
                        <td class="text-center bd">
                          <label class="container" style="width: 2%">
                            <input onclick="updateTotal()" type="radio" name="aktivitas"
                            <?php if ($result['aktivitas'] == '2') {
                                echo 'checked="checked"';  
                              }
                            ?> value="2">
                            <span class="checkmark"></span>
                          </label>
                        </td>
                      </tr>

                      <tr>
                        <td class="centerp bd">Sadar penuh, Membutuhkan bantuan</td>
                        <td class="text-center bd">1</td>
                        <td class="text-center bd">
                          <label class="container" style="width: 2%">
                            <input onclick="updateTotal()" type="radio" name="aktivitas"
                            <?php if ($result['aktivitas'] == '1') {
                                echo 'checked="checked"';  
                              }
                            ?> value="1">
                            <span class="checkmark"></span>
                          </label>
                        </td>
                      </tr>

                      <tr>
                        <td class="centerp bd bottom">Tidak sadar</td>
                        <td class="text-center bd bottom">0</td>
                        <td class="text-center bd bottom">
                          <label class="container" style="width: 2%">
                            <input onclick="updateTotal()" type="radio" name="aktivitas"
                            <?php if ($result['aktivitas'] == '0') {
                                echo 'checked="checked"';  
                              }
                            ?> value="0">
                            <span class="checkmark"></span>
                          </label>
                        </td>
                      </tr>

                      <tr>
                        <td rowspan="3" class="text-center centerp bd bottom">Mual / Muntah</td>
                        <td class="centerp bd">Minimal, membutuhkan terapi oral</td>
                        <td class="text-center bd">2</td>
                        <td class="text-center bd">
                          <label class="container" style="width: 2%">
                            <input onclick="updateTotal()" type="radio" name="mual_muntah"
                            <?php if ($result['mual_muntah'] == '2') {
                                echo 'checked="checked"';  
                              }
                            ?> value="2">
                            <span class="checkmark"></span>
                          </label>
                        </td>
                      </tr>

                      <tr>
                        <td class="centerp bd">Moderate, membutuhkan terapi parenteral</td>
                        <td class="text-center bd">1</td>
                        <td class="text-center bd">
                          <label class="container" style="width: 2%">
                            <input onclick="updateTotal()" type="radio" name="mual_muntah"
                            <?php if ($result['mual_muntah'] == '1') {
                                echo 'checked="checked"';  
                              }
                            ?> value="1">
                            <span class="checkmark"></span>
                          </label>
                        </td>
                      </tr>

                      <tr>
                        <td class="centerp bd bottom">Berat, Membutuhkan terapi lanjut</td>
                        <td class="text-center bd bottom">0</td>
                        <td class="text-center bd bottom">
                          <label class="container" style="width: 2%">
                            <input onclick="updateTotal()" type="radio" name="mual_muntah"
                            <?php if ($result['mual_muntah'] == '0') {
                                echo 'checked="checked"';  
                              }
                            ?> value="0">
                            <span class="checkmark"></span>
                          </label>
                        </td>
                      </tr>

                      <tr>
                        <td rowspan="2" class="text-center centerp bd bottom">Nyeri</td>
                        <td class="centerp bd">Nyeri, dapat dikontrol dengan terapi oral</td>
                        <td class="text-center bd">2</td>
                        <td class="text-center bd">
                          <label class="container" style="width: 2%">
                            <input onclick="updateTotal()" type="radio" name="nyeri"
                            <?php if ($result['nyeri'] == '2') {
                                echo 'checked="checked"';  
                              }
                            ?> value="2">
                            <span class="checkmark"></span>
                          </label>
                        </td>
                      </tr>

                      <tr>
                        <td class="centerp bd bottom">Nyeri, tidak dapat dikontrol dengan terapi oral</td>
                        <td class="text-center bd bottom">1</td>
                        <td class="text-center bd bottom">
                          <label class="container" style="width: 2%">
                            <input onclick="updateTotal()" type="radio" name="nyeri"
                            <?php if ($result['nyeri'] == '1') {
                                echo 'checked="checked"';  
                              }
                            ?> value="1">
                            <span class="checkmark"></span>
                          </label>
                        </td>
                      </tr>

                      <tr>
                        <td rowspan="3" class="text-center centerp bd">Pendarahan dari luka operasi</td>
                        <td class="centerp bd">Minimal, tidak perlu mengganti balutan</td>
                        <td class="text-center bd">2</td>
                        <td class="text-center bd">
                          <label class="container" style="width: 2%">
                            <input onclick="updateTotal()" type="radio" name="pendarahan"
                            <?php if ($result['pendarahan'] == '2') {
                                echo 'checked="checked"';  
                              }
                            ?> value="2">
                            <span class="checkmark"></span>
                          </label>
                        </td>
                      </tr>

                      <tr>
                        <td class="centerp bd">Moderate, perlu ganti 2 kali balutan</td>
                        <td class="text-center bd">1</td>
                        <td class="text-center bd">
                          <label class="container" style="width: 2%">
                            <input onclick="updateTotal()" type="radio" name="pendarahan"
                            <?php if ($result['pendarahan'] == '1') {
                                echo 'checked="checked"';  
                              }
                            ?> value="1">
                            <span class="checkmark"></span>
                          </label>
                        </td>
                      </tr>

                      <tr>
                        <td class="centerp bd">Banyak, perlu 3 kali atau lebih ganti balutan</td>
                        <td class="text-center bd">0</td>
                        <td class="text-center bd">
                          <label class="container" style="width: 2%">
                            <input onclick="updateTotal()" type="radio" name="pendarahan"
                            <?php if ($result['pendarahan'] == '0') {
                                echo 'checked="checked"';  
                              }
                            ?> value="0">
                            <span class="checkmark"></span>
                          </label>
                        </td>
                      </tr>

                      <tr>
                        <td class="text-right" style="padding-right: 20px" colspan="3">Total Score Pasien</td>
                        <td class="text-center">
                          <input type="text" class="form-control input-sm" name="total_skor" id="total_skor" value="<?= $result['total_skor'] ?>" readonly>
                        </td>
                      </tr>
                    </tbody>
                  </table>
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

  $('#jam_akhir').datetimepicker({
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

  $('#jam_monitoring').datetimepicker({
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

  $('.btn-batal-<?= $this->router->fetch_class(); ?>').click(function (e) { 
    e.preventDefault();
    
    $('#view-container').show();
    $('#form-container').hide();
    $('#form-container').html('');
  });

  $('#form-edit-1').submit(function (e) { 
    e.preventDefault();
    $('.btn-kirim-<?= $this->router->fetch_class(); ?>').attr('disabled', true);
    
    $.post('<?php echo base_url();?><?= $class_name; ?>/edit_process/', $(this).serialize()
    ).done(function(data) {
      var data = JSON.parse(data);

      if (data.status == '200') {
        alert('Data berhasil diubah');
        location.reload();
      } else {
        alert(data.message);
        $('.btn-kirim-<?= $this->router->fetch_class(); ?>').removeAttr('disabled');
        $('.btn-kirim-<?= $this->router->fetch_class(); ?>').removeAttr('disabled');
      }
    }).fail(function() {
      alert('Gagal menampilkan data')
      $('.btn-kirim-<?= $this->router->fetch_class(); ?>').removeAttr('disabled');
    });
  });
    

  function updateTotal() {

    var tanda_vital = parseInt($("input[name=tanda_vital]:checked").val()) || 0;
    var aktivitas = parseInt($("input[name=aktivitas]:checked").val()) || 0;
    var mual_muntah = parseInt($("input[name=mual_muntah]:checked").val()) || 0;
    var nyeri = parseInt($("input[name=nyeri]:checked").val()) || 0;
    var pendarahan = parseInt($("input[name=pendarahan]:checked").val()) || 0;

    var nilai = tanda_vital + aktivitas + mual_muntah + nyeri + pendarahan;

    console.log(nilai);
   
    document.getElementById('total_skor').value = nilai;
    document.getElementById('total_skor').innerHTML = nilai;

  }
</script>