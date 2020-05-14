<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.css"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
<br><br>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>

<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap.min.css"> -->

<div class="col-md-12 text-center hide" id="load-data"></div>
<div class="row">
  <div class="col-xs-4">
      <canvas id="jk_pasien" width="600" height="400"></canvas>
  </div>
  <div class="col-xs-4">
      <canvas id="status_pasien" width="600" height="400"></canvas>
  </div>
  <div class="col-xs-4">
      <canvas id="penjamin_pasien" width="600" height="400"></canvas>
  </div>
</div>
<div class="class-col-md-12 table-process" id="table-process">
  <div class="row load-view"></div>
</div>

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

  table.table thead {
    background-color: #cecece;
    font-weight: bold;
    font-size: 12px;
  }

  table#icd10 thead td {
    text-align: center;
    vertical-align: middle;
  }

</style>

<script type="text/javascript">
  const class_name = '<?php echo $class_name;?>';
  $(document).ready(function()
  {
    document.title = '<?= $title; ?>';
    refresh();
  });

  function refresh() 
  {
    $.get('<?php echo base_url()?>' + class_name + '/get_data', function(data) 
    {
      $('.load-view').html(data);
    })
    .done(function() 
    {
      grafik();
      console.log("Sukses");
    })
    .fail(function() {
      grafik();
      console.log("gagal");
    });
  }

  function grafik() 
  {
     $.ajax({    //create an ajax request to display.php
        type: "GET",
        url: "http://178.128.118.107/api/lumen_laporan/statistik/registrasi?type_tgl=checkin&tgl_start=2019-01-06&tgl_end=2020-04-16",
        headers: {
          'Content-Type': 'application/json',
          'x-token' : 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJuYW1lIjoiTkFNQSAyIiwiaWRfdXNlciI6IjM3MzY4MSIsInJtX251bWJlciI6ImFkbWluIiwicnNfa2V5IjoiQTEyMyIsImlwX2FkZHJlc3MiOiIxMjcuMC4xLjEiLCJhY2Nlc3MiOiJ1c2VyIn0.ubW6fyc7ErYOW2T5qFbjXvLIVTLp05s3A0paQ6wfcmo'
        },
        dataType: "json",   //expect html to be returned                
        success: function(response){
            // $("#responsecontainer").html(response); 
            //alert(response);
            data = response.data;
            // console.log(data);

            var jkPasien = document.getElementById("jk_pasien");
    
            Chart.defaults.global.defaultFontFamily = "Lato";
            Chart.defaults.global.defaultFontSize = 18;
            
            
            var lineChart = new Chart(jkPasien, {
              type: 'pie',
              data: {
                labels: ["Laki-Laki", "Perempuan"],
                datasets: [{
                  backgroundColor: ["#3e95cd", "#8e5ea2"],
                  data: [data.data_kelamin['pria'],data.data_kelamin['wanita']]
                }]
              },
              options: {
                title: {
                  display: true,
                  text: 'Data Jenis Kelamin Pasien'
                }
              }
            });


            // Start Chart Status Pasien
            ////////////////////////////////

            var statusPasien = document.getElementById("status_pasien");
    
            Chart.defaults.global.defaultFontFamily = "Lato";
            Chart.defaults.global.defaultFontSize = 18;
            
            var lineChart = new Chart(statusPasien, {
              type: 'pie',
              data: {
                labels: ["Pasien Baru", "Pasien Lama"],
                datasets: [{
                  backgroundColor: ["#26ed58", "#f2d724"],
                  data: [data.data_status_pasien['baru'],data.data_status_pasien['lama']]
                }]
              },
              options: {
                title: {
                  display: true,
                  text: 'Data Status Pasien'
                },
                pieceLabel: {
                   render: 'value' //show values
                }
              }
            });

            // Start Chart Penjamin
            /////////////////////////////////
            var penjaminPasien = document.getElementById("penjamin_pasien");
    
            Chart.defaults.global.defaultFontFamily = "Arial";
            Chart.defaults.global.defaultFontSize = 12;
            
            var keys = Object.keys(data.data_penjamin);
            var banyak = Object.keys(data.data_penjamin).length;
            var chartData = {};

            var color = [banyak];
            var labelData = [banyak];

            for (var i = 0; i < banyak; i++) {
              color[i] = '#' + (Math.random()*0xFFFFFF<<0).toString(16);
              var splitStr = keys[i].toLowerCase().split(' ');

              for (var n = 0; n < splitStr.length; n++) {
                   splitStr[n] = splitStr[n].charAt(0).toUpperCase() + splitStr[n].substring(1);     
              }

              labelData[i] = splitStr.join(' '); 
            }
             

            var dataPie = {
                  labels: [],
                  datasets: [{
                    backgroundColor: [],
                    data: []
                  }]
              };

            for (var i = 0; i < banyak; i++) {
              dataPie.labels.push(labelData[i]);
              dataPie.datasets[0].backgroundColor.push(color[i]);
              dataPie.datasets[0].data.push(data.data_penjamin[keys[i]]);
            }
            
            console.log(dataPie);

            var lineChart = new Chart(penjaminPasien, {
              type: 'pie',
              data: dataPie,
              options: {
                title: {
                  display: true,
                  text: 'Data Penjamin Pasien'
                },
                pieceLabel: {
                   render: 'value' //show values
                }
              }
            });

        }
  });
}
</script>
<!-- 
<script>
  Untuk pengingat only
    console.log(Object.values(data.data_dokter)[0])
    console.log(Object.keys(data.data_dokter).length)
    $data = array_values((array)$laporan_statistik['data_dokter']);
    $key = array_keys((array)$laporan_statistik['data_dokter']);

        // tooltips: {
                //   callbacks: {
                //     label: function (tooltipItem, data) {
                //       try {
                //         let label = ' ' + data.labels[tooltipItem.index] || '';

                //         if (label) {
                //           label += ': ';
                //         }

                //         const sum = data.datasets[0].data.reduce((accumulator, curValue) => {
                //           return accumulator + curValue;
                //         });
                //         const value = data.datasets[tooltipItem.datasetIndex].data[tooltipItem.index];

                //         label += Number((value / sum) * 100).toFixed(2) + '%';
                //         return label;
                //       } catch (error) {
                //         console.log(error);
                //       }
                //     }
                //   }
                // }
              // }
  </script>
 -->