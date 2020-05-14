<style>
  .mt-1 {
    margin-top: 1px;
  }

  .mt-2 {
    margin-top: 2px;
  }

  .mt-3 {
    margin-top: 3px;
  }

  .mt-4 {
    margin-top: 4px;
  }

  .mt-5 {
    margin-top: 5px;
  }

  .mt-10 {
    margin-top: 10px;
  }

  .mt-15 {
    margin-top: 15px;
  }

  .mt-20 {
    margin-top: 20px;
  }

  .mb-1 {
    margin-bottom: 1px;
  }

  .mb-2 {
    margin-bottom: 2px;
  }

  .mb-3 {
    margin-bottom: 3px;
  }

  .mb-4 {
    margin-bottom: 4px;
  }

  .mb-5 {
    margin-bottom: 5px;
  }

  .mb-10 {
    margin-bottom: 10px;
  }

  .ml-1 {
    margin-left: 1px;
  }

  .ml-2 {
    margin-left: 2px;
  }

  .ml-3 {
    margin-left: 3px;
  }

  .ml-4 {
    margin-left: 4px;
  }

  .ml-5 {
    margin-left: 5px;
  }

  .tindakan {
    background: #f5f5f5;
    border: 1px solid #e3e3e3;
    min-height: 100px;
    width: 100%;
    border-radius: 3px;
    padding-left: 5px;
  }

  .render-aktif {
    padding-left: 10px;
    padding-right: 10px;
  }
</style>

<div class="row mt-15">
  <div class="col-md-12">
    <div class="row">
      <?php foreach ($list as $k => $v) : ?>
        <div class="col-md-12" style="margin-bottom:15px;">

          <input type="hidden" name="id_dept" id="id_dept_aktif" value="<?= $v['id_dept']; ?>">
          <input type="hidden" name="id_reg" id="id_reg_aktif" value="<?= $v['id_reg']; ?>">
          <input type="hidden" name="id_visit" id="id_visit_aktif" value="<?= $v['id_visit']; ?>">

          <?php if (empty($v['data'])) : ?>
            <div class="row">
              <div class="col-md-8">
                <strong><?= $v['no_visit']; ?> - <?= $v['tanggal_checkin']; ?></strong>
              </div>

              <div class="col-md-4 text-right">
                <button class="btn btn-primary btn-sm tambah-aktif" data-id-visit="<?= $v['id_visit'] ?>" data-id-reg="<?= $v['id_reg'] ?>">Tambah</button>
              </div>
            </div>

          <?php else : ?>
            <div class="row">

              <div class="col-md-7">
                <strong><?= $v['no_visit']; ?> - <?= $v['tanggal_checkin']; ?></strong>
              </div>
              <?php foreach ($v['data'] as $k) : ?>

                <div class="col-md-7"></div>
                <div class="col-md-5 text-right">
                  <button class="btn btn-danger btn-sm hapus-aktif" data-id-notes="<?= $k['notes_id']; ?>"><i class="fa fa-1x fa-fw fa-trash"></i></button>
                  <button class="btn btn-info btn-sm ubah-aktif" data-id-notes="<?= $k['notes_id']; ?>">Ubah</button>
                  <button class="btn btn-success btn-sm cetak-aktif" data-id-notes="<?= $k['notes_id']; ?>">Cetak</button>
                </div>

                <div class="col-md-12 ml-3">
                  <div class="col-xs-5 col-md-5">
                    <div class="row"><strong>Dokter <span class="pull-right">:</span></strong></div>
                  </div>
                  <div class="col-xs-7 col-md-7"><?php echo ucwords(strtolower($k['approved_dokter'])); ?></div>
                </div>

                <div class="col-md-12 ml-3">
                  <div class="col-xs-5 col-md-5">
                    <div class="row"><strong>Petugas <span class="pull-right">:</span></strong></div>
                  </div>
                  <div class="col-xs-7 col-md-7"><?php echo ucwords(strtolower($k['approved_petugas'])); ?></div>
                </div>

                <div class="col-md-12">
                  <b>Parameter :</b>
                  <div class="row">
                    <div class="col-md-5">
                      Tanggal Tindakan
                    </div>
                    <div class="col-md-7">
                      : <?= $k['tanggal']; ?>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-5">
                      Jam Mulai
                    </div>
                    <div class="col-md-7">
                      : <?= $k['jam']; ?>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-5">
                      Jam Berakhir
                    </div>
                    <div class="col-md-7">
                      : <?= $k['jam_akhir']; ?>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-5">
                      Diagnosis
                    </div>
                    <div class="col-md-7">
                      : <?= $k['diagnosis']; ?>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-5">
                      Tindakan
                    </div>
                    <div class="col-md-7">
                      : <?= $k['tindakan']; ?>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-5">
                      Level sedasi
                    </div>
                    <div class="col-md-7">
                      : <?= $k['level_sedasi']; ?>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-5">
                      Obat yang diberikan
                    </div>
                    <div class="col-md-7">
                      : <?= $k['obat_sedasi']; ?>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-5">
                      Jam Monitoring
                    </div>
                    <div class="col-md-7">
                      : <?= $k['jam_monitoring']; ?>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-5">
                      Tekanan Darah
                    </div>
                    <div class="col-md-7">
                      : <?= $k['tekanan_darah']; ?>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-5">
                      Nadi
                    </div>
                    <div class="col-md-7">
                      : <?= $k['nadi']; ?>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-5">
                      Pernapasan
                    </div>
                    <div class="col-md-7">
                      : <?= $k['pernapasan']; ?>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-5">
                      SpO2
                    </div>
                    <div class="col-md-7">
                      : <?= $k['spo2']; ?>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-5">
                      Tanda Vital (TD dan Nadi)
                    </div>
                    <?php
                    if ($k['tanda_vital'] == '2')
                      $tanda_vital = "< 20% tanda vital sebelum tindakan";
                    else if($k['tanda_vital']  == '1')
                      $tanda_vital = "20%-40 tanda vital sebelum tindakan";
                    else
                      $tanda_vital = "> 40% tanda vital sebelum tindakan";
                     ?>
                    <div class="col-md-7">
                      : <?= $tanda_vital; ?>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-5">
                      Aktivitas
                    </div>
                    <?php
                    if ($k['aktivitas'] == '2')
                      $aktivitas = "Sadar penuh dan bisa bergerak sendiri";
                    else if($k['aktivitas']  == '1')
                      $aktivitas = "Sadar penuh, Membutuhkan bantuan";
                    else
                      $aktivitas = "Tidak sadar";
                     ?>
                    <div class="col-md-7">
                      : <?= $aktivitas; ?>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-5">
                      Mual / Muntah
                    </div>
                    <?php
                    if ($k['mual_muntah'] == '2')
                      $mual_muntah = "Minimal, membutuhkan terapi oral";
                    else if($k['mual_muntah']  == '1')
                      $mual_muntah = "Moderate, membutuhkan terapi parental";
                    else
                      $mual_muntah = "Berat, membutuhkan terapi lanjut";
                     ?>
                    <div class="col-md-7">
                      : <?= $mual_muntah; ?>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-5">
                      Nyeri
                    </div>
                    <?php
                    if ($k['nyeri'] == '2')
                      $nyeri = "Nyeri, dapat dikontrol dengan terapi oral";
                    else
                      $nyeri = "Nyeri, tidak dapat dikontrol dengan terapi oral";
                     ?>
                    <div class="col-md-7">
                      : <?= $nyeri; ?>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-5">
                      Pendarahan
                    </div>
                    <?php
                    if ($k['pendarahan'] == '2')
                      $pendarahan = "Minimal, tidak perlu mengganti balutan";
                    else if($k['pendarahan']  == '1')
                      $pendarahan = "Moderate, perlu 2 kali mengganti balutan";
                    else
                      $pendarahan = "Banyak, perlu 2 kali atau lebih mengganti balutan";
                     ?>
                    <div class="col-md-7">
                      : <?= $pendarahan; ?>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-5">
                      Total Skor Pasien
                    </div>
                    <div class="col-md-7">
                      : <?= $k['total_skor']; ?>
                    </div>
                  </div>

                </div>
                <hr>
              <?php endforeach; ?>
            </div>
          <?php endif; ?>

        </div>
      <?php endforeach; ?>
    </div>
  </div>
</div>

<script type="text/javascript">
  $(document).ready(function() {

  });

  $('.tambah-aktif').click(function(e) {
    e.preventDefault();
    $('.tambah-aktif').attr('disabled', true);
    id_reg = $(this).data('id-reg');
    id_visit = $(this).data('id-visit');

    $.post('<?php echo base_url(); ?>' + class_name + '/add/list', {
      'id_reg': id_reg,
      'id_visit': id_visit
    }).done(function(response) {

      $('#form-container').html(response);
      $('#view-container').hide();
      $('#form-container').show();
      $('.tambah-aktif').removeAttr('disabled');

    }).fail(function() {

      alert('Gagal menampilkan data');

    });
  });

  $('.hapus-aktif').click(function(e) {
    e.preventDefault();

    if (confirm("Apa anda yakin ingin menghapus data ini?")) {
      id_reg_aktif = $('.select-aktif').val();
      id_visit_aktif = $('#id_visit_aktif').val();

      delete_url = '<?php echo base_url(); ?>' + class_name + '/delete/' + id_reg_aktif + '/' + id_visit_aktif + '/aktif';

      $.get('<?php echo base_url(); ?>' + class_name + '/delete/', {
        'id_reg': id_reg_aktif,
        'id_visit': $(this).data('id-visit'),
        'id_notes': $(this).data('id-notes'),
        'status': 'aktif',
      }).done(function(response) {
        data = JSON.parse(response);

        if (data.status == 200) {
          if (aktif_pdf) {
            aktif_pdf.close();
          }
          alert(data.message);
          render();
          return false;

        } else {
          alert(data.message);
          return false;

        }

      });
    } else {
      return false;
    }
  });

  $('.ubah-aktif').click(function(e) {
    e.preventDefault();
    id_reg_aktif = $('.select-aktif').val();
    process_button(0);
    $.get('<?php echo base_url(); ?>' + class_name + '/edit/', {
      'id_reg': id_reg_aktif,
      'id_visit': $(this).data('id-visit'),
      'id_notes': $(this).data('id-notes')
    }).done(function(response) {
      process_button(1);
      $('#form-container').html(response);
      $('#view-container').hide();
      $('#form-container').show();

    }).fail(function() {
      process_button(1);
      alert('Gagal menampilkan data')
    });
  });

  $('.cetak-aktif').on("click", function(e) {
    id_notes = $(this).data('id-notes');

    aktif_pdf = window.open('<?php echo base_url(); ?>' + class_name + '/view_pdf/' + id_notes);
  });
</script>