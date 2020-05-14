

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