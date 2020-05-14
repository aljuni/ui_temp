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

  .render-arsip {
    padding-left: 10px;
    padding-right: 10px;
  }
</style>

<div class="row mt-15">
  <div class="col-md-12">
    <div class="row">
      <?php foreach ($list as $k => $v) : ?>
        <div class="col-md-12" style="margin-bottom:15px;">

          <input type="hidden" name="id_dept" id="id_dept_arsip" value="<?= $v['id_dept']; ?>">
          <input type="hidden" name="id_reg" id="id_reg_arsip" value="<?= $v['id_reg']; ?>">
          <input type="hidden" name="id_visit" id="id_visit_arsip" value="<?= $v['id_visit']; ?>">

          <?php if (empty($v['data'])) : ?>
            <div class="row">
              <div class="col-md-7">
                <strong><?= $v['no_visit']; ?> - <?= $v['tanggal_checkin']; ?></strong>
              </div>

              <div class="col-md-5 text-right">
                <button class="btn btn-primary btn-sm tambah-arsip" data-id-visit="<?= $v['id_visit'] ?>" data-id-reg="<?= $v['id_reg'] ?>">Tambah</button>
              </div>
            </div>

          <?php else : ?>
            <div class="row">
              
              <div class="col-md-7">
                <strong><?= $v['no_visit']; ?> - <?= $v['tanggal_checkin']; ?></strong>
              </div>
              <?php foreach ($v['data'] as $k) :?>
              
              <div class="col-md-7"></div>
              <div class="col-md-5 text-right">
                <button class="btn btn-danger btn-sm hapus-arsip" data-id-notes="<?= $k['notes_id'];?>"><i class="fa fa-1x fa-fw fa-trash"></i></button>
                <button class="btn btn-info btn-sm ubah-arsip" data-id-notes="<?= $k['notes_id'];?>">Ubah</button>
                <button class="btn btn-success btn-sm cetak-arsip" data-id-notes="<?= $k['notes_id'];?>">Cetak</button>
              </div>

              <div class="col-md-12 ml-3">
                <div class="col-xs-4 col-md-4">
                  <div class="row"><strong>Dokter Approve <span class="pull-right">:</span></strong></div>
                </div>
                <div class="col-xs-8 col-md-8"><?php echo ucwords(strtolower($k['approved_dokter'])); ?></div>
              </div>

              <div class="col-md-12 ml-3">
                <div class="col-xs-4 col-md-4">
                  <div class="row"><strong>Petugas Approve <span class="pull-right">:</span></strong></div>
                </div>
                <div class="col-xs-8 col-md-8"><?php echo ucwords(strtolower($k['approved_petugas'])); ?></div>
              </div>

              <div class="col-md-12">
                <b>Parameter :</b>
                <div class="row">
                  <div class="col-md-5">
                    DATA / PARAMETER KE-1
                  </div>
                  <div class="col-md-7">
                    : <?= $k['data1']; ?>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-5">
                    DATA / PARAMETER KE-2
                  </div>
                  <div class="col-md-7">
                    : <?= $k['data2']; ?>
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

  $('.tambah-arsip').click(function(e) {
    e.preventDefault();
    $('.tambah-arsip').attr('disabled', true);
    id_reg = $(this).data('id-reg');
    id_visit = $(this).data('id-visit');

    $.post('<?php echo base_url(); ?>' + class_name + '/add_submenu/list', {
      'id_reg': id_reg,
      'id_visit': id_visit
    }).done(function(response) {

      $('#form-container').html(response);
      $('#view-container').hide();
      $('#form-container').show();
      $('.tambah-arsip').removeAttr('disabled');

    }).fail(function() {

      alert('Gagal menampilkan data');

    });
  });

  $('.ubah-arsip').click(function(e) {
    e.preventDefault();
    id_reg_arsip = $('.select-arsip').val();
    process_button(0);
    $.get('<?php echo base_url(); ?>' + class_name + '/edit_submenu/', {
      'id_reg': id_reg_arsip,
      'id_visit': $('#id_visit_arsip').val(),
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

  $('.hapus-arsip').click(function(e) {
    if (confirm("Apa anda yakin ingin menghapus data ini?")) {
      id_reg_arsip = $('.select-arsip').val();
      id_visit_arsip = $('#id_visit_arsip').val();

      $.get('<?php echo base_url(); ?>' + class_name + '/delete_submenu/', {
        'id_reg': id_reg_arsip,
        'id_visit': $(this).data('id-visit'),
        'id_notes': $(this).data('id-notes'),
        'status' : 'arsip',
      }).done(function(response) {
        data = JSON.parse(response);

        if (data.status == 200) {
          if (arsip_pdf) {
            arsip_pdf.close();
          }
          alert(data.message);
          render_arsip();
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

  $('.cetak-arsip').on("click", function(e) {
    id_notes = $(this).data('id-notes');

    arsip_pdf = window.open('<?php echo base_url(); ?>' + class_name + '/view_pdf/' + id_notes);
  });
</script>