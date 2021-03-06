<style type="text/css">
	.section-header
	{
		background: #337AB7;
    padding: 5px 10px 5px 10px;
    text-transform: uppercase;
    color: white;
    font-size: 14px;
	}

	.section-header a
	{
	    color: white;
	    padding: 5px 10px 5px 10px;
	    margin: -5px -10px 0 0;
	    background: #D9534F;
	}

	div.pad3
	{
		padding: 10px;
    	margin-bottom: 20px;
	}

	.conrm
	{
		margin-bottom: 25px;
	}

	.tgl
	{
		font-size:12px;
	}

  textarea 
  {
    resize: vertical;
  }
  
  .sptr{
    margin-top: 0px;
    margin-bottom: 0px;
    border: 0;
    border-top: 1px solid #eee;
  }


  .mt-5{margin-top:5px !important}
  .mt-20{margin-top:20px !important}
  .pt-20{padding-top:20px !important}
  
  .mb-5{margin-bottom:5px}
  .mb-20{padding-bottom:20px}


/*Start Untuk radio button style*/

  .container {
    display: block;
    position: relative;
    padding-left: 35px;
    margin-bottom: 12px;
    cursor: pointer;
    font-size: 12px;
    font-weight: inherit;
    padding-top: 4px;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
  }
  
  .container input {
    position: absolute;
    opacity: 0;
    cursor: pointer;
  }
  
  .checkmark {
    position: absolute;
    top: 0;
    left: 0;
    height: 25px;
    width: 25px;
    background-color: #eee;
    border-radius: 50%;
  }
  
  .container:hover input ~ .checkmark {
    background-color: #ccc;
  }
  
  .container input:checked ~ .checkmark {
    background-color: #2196F3;
  }
  
  .checkmark:after {
    content: "";
    position: absolute;
    display: none;
  }
  
  .container input:checked ~ .checkmark:after {
    display: block;
  }
  
  .container .checkmark:after {
    top: 9px;
    left: 9px;
    width: 8px;
    height: 8px;
    border-radius: 50%;
    background: white;
  }
/*End radio button style*/

/*Tambahan style untuk tabel laporan sedasi*/
  .centerp {
    padding: 10px 5px 10px 5px;
  }

  .bd {
    border: 1px solid #ddd;
    padding: 8px;
  }  

  .bottom {
    border-bottom: 1px solid #000;
    padding: 8px;
  }  

</style>
<br>
<br>
<div class="col-md-12" id="view-container">
  <div class="row">
    <div class="col-md-6">
      <div class="panel panel-primary">
        <div class="panel-heading">Template (AKTIF)</div>
        <div class="panel-body">
          <div class="row">
            <div class="col-md-12">
              <div class="col-md-7">
                <div class="row">
                  <select class="select2 select-aktif form-control">
                  <?php foreach($data_reg_aktif as $d_aktif):?>
                    <option value="<?=$d_aktif['id_registrasi'];?>"><?=$d_aktif['no_reg'];?> - <?=$d_aktif['tanggal_checkin'];?></option>
                  <?php endforeach;?>
                  </select>
                </div>
              </div>
              
            </div>
            <div class="col-md-12 render-aktif"></div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-6">
      <div class="panel panel-primary">
        <div class="panel-heading">Template (ARSIP)</div>
        <div class="panel-body">
          <div class="row">
            <?php if(count($data_reg_arsip) <= 0 ):?>
              <div class="col-md-12"><strong>Pasien belum memiliki (Arsip)</strong></div>
            <?php else : ?>
              <div class="col-md-12">  
                <div class="col-md-7">
                  <div class="row">
                    <select class="select2 select-arsip form-control">
                      <?php foreach($data_reg_arsip as $d_arsip):?>
                        <option value="<?=$d_arsip['id_registrasi'];?>"><?=$d_arsip['no_reg'];?> - <?=$d_arsip['tanggal_checkin'];?></option>
                      <?php endforeach;?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-md-12 render-arsip"></div>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="col-md-12" id="form-container" style="display:none;"></div>

<script type="text/javascript">
  var aktif_pdf,arsip_pdf;
  
  $(document).ready(function ()
  {
    $(window).scrollTop(0);
    
    $('.select-aktif').select2();
    $('.select-arsip').select2();

    render();
    render_arsip();
  });

  function render() 
  {
    id_reg_aktif = $('.select-aktif').val();

    $.get('<?php echo base_url();?>'+class_name+"/render_data/list/"+ id_reg_aktif + "/1",

    function(response){
      $('.render-aktif').html(response);
    });
  }

  function render_arsip() 
  {
    id_reg_arsip = $('.select-arsip').val();

    $.get('<?php echo base_url();?>'+class_name+"/render_data/list/"+ id_reg_arsip + "/2",
    function(response)
    {
      $('.render-arsip').html(response);
    });   
  }

  $('.select-aktif').change(function(e) 
  { 
    e.preventDefault();
    render();
  });

  $('.select-arsip').change(function(e) 
  {
    e.preventDefault();
    render_arsip();
  });




  function process_button(type)
  {
    if(type == 1)
    {
      $('.tambah-aktif').attr("disabled",false);
      $('.ubah-aktif').attr("disabled",false);
      $('.hapus-aktif').attr("disabled",false);
      $('.cetak-aktif').attr("disabled",false);
      $('.tambah-arsip').attr("disabled",false);
      $('.ubah-arsip').attr("disabled",false);
      $('.hapus-arsip').attr("disabled",false);
      $('.cetak-arsip').attr("disabled",false);
    }
    else
    {
      $('.tambah-aktif').attr("disabled",true);
      $('.ubah-aktif').attr("disabled",true);
      $('.hapus-aktif').attr("disabled",true);
      $('.cetak-aktif').attr("disabled",true);
      $('.tambah-arsip').attr("disabled",true);
      $('.ubah-arsip').attr("disabled",true);
      $('.hapus-arsip').attr("disabled",true);
      $('.cetak-arsip').attr("disabled",true);
    }
  }
</script>