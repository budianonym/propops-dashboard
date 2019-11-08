<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.css"></script>
<style src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.js" type="text/css"></style>
<script src="{{ base_url('assets/js/linechart.js') }}"></script>



<!-- End Row -->
<div class="row" style="padding-right: 20px;padding-left: 20px;">
  <div class="col-xl-12">
    <!-- Default -->
    <div class="widget has-shadow">
      <div class="widget-header bordered no-actions d-flex align-items-center">
        <h4>Table</h4>

      </div>
      <div class="widget-body">
        <h6 align="center" class="text-muted font-italic">Number of Backlog from RA, Airbnb, Expedia, HomeAway. Click the number to see list of the NIDs and the Validation. <br>only show validation code 310, 600, 312<br>Script will be run on 23.55 each day.
</h6>
<br>
        <!-- test -->
                                        <!-- Begin Large Modal -->
  <!--                                       <div class="row">
                                            <div class="col-xl-4 d-flex align-items-center mb-3">
                                                <p class="text-dark mb-0">Large Modal</p>
                                            </div>
                                            <div class="col-xl-8 d-flex align-items-center mb-3">
                                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-large">Launch Modal</button>
                                            </div>
                                        </div> -->
                                        <!-- End Large Modal -->

                                         <!-- Begin Large Modal -->
        <div id="modal-large" class="modal fade">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title statuss"></h4>
                        <button type="button" class="close" data-dismiss="modal">
                            <span aria-hidden="true">×</span>
                            <span class="sr-only">close</span>
                        </button>
                    </div>
                    <div align="center"><img src="{{ base_url('assets/loader.gif') }}" class="loader" style="max-width: 40px;"></div>
                    <div class="modal-body">
                        <p>
                            Test
                        </p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-shadow" data-dismiss="modal">Close</button>
                        <!-- <button type="button" class="btn btn-primary">Save</button> -->
                    </div>
                </div>
            </div>
        </div>
        <!-- End Large Modal -->
        <!-- end test -->
        <!-- begin section -->
        <!--  -->
        <!-- <br>
        <h6 align="center" class="text-muted font-italic">This table shows all properties number each Status.</h6> -->
        <div class="container table-responsive" id="export1">
  <table id="export-table" class="table-striped">
  <thead>
  <tr>
      <th>Date</th>
      <th>RedAwning</th>
      <th>Airbnb</th>
      <th>Expedia</th>
      <th>HomeAway</th>
 
  </tr>
</thead>
 <tbody>
@foreach ($zerobacklognidcount as $key)
  <tr>
      <td>{{ $key['timestamp'] }}</td>
      <td><a data-toggle="modal" data-target="#modal-large" class="tampiltomvol" data-channel="redawning"  data-date="{{ $key['timestamp'] }}">{{ checkzero($key['redawning']) }}</a></td>
      <td><a data-toggle="modal" data-target="#modal-large" class="tampiltomvol" data-channel="airbnb"  data-date="{{ $key['timestamp'] }}">{{ checkzero($key['airbnb']) }}</a></td>
      <td><a data-toggle="modal" data-target="#modal-large" class="tampiltomvol" data-channel="expedia"  data-date="{{ $key['timestamp'] }}">{{ checkzero($key['expedia']) }}</a></td>
      <td><a data-toggle="modal" data-target="#modal-large" class="tampiltomvol" data-channel="homeaway"  data-date="{{ $key['timestamp'] }}">{{ checkzero($key['homeaway']) }}</a></td>
      </tr>
        @php
  array_push($timestamp,$key['timestamp']);
  array_push($redawning,checkzero($key['redawning']));
  array_push($airbnb,checkzero($key['airbnb']));
  array_push($expedia,checkzero($key['expedia']));
  array_push($homeaway,checkzero($key['homeaway']));  
  @endphp
@endforeach
</tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">

// $(document).ready(function(){
//     $("#reviewer").click(function(){
// $('.data').hide();
// $('.loader').show();
//      let a = $('#reviewer').val();
//      $.get("assignmentlist2.php?reviewer="+a+"&check=on&find= .table-striped", function(data){
//     $(".table-striped").html(data);
//     $('.loader').hide();
//     $('.data').show();     });
$(document).ready(function(){
$('.tampiltomvol').on('click', function(){

  const channel = $(this).data('channel');
  const date = $(this).data('date');
 $('.statuss').html(date+' | '+channel); 
console.log(date);
console.log(channel);
$('.modal-body').hide();
$('.loader').show();
$.get("{{ base_url('zerobacklognid/nid') }}?channel="+channel+"&date="+date, function(data){
    $('.loader').hide();
    $(".modal-body").html(data);
    $('.modal-body').show(); });
    // $('.data').show();     });




})

})





    </script>


<!-- End Row -->
<!-- End Row -->
<div class="row" style="padding-right: 20px;padding-left: 20px;">
  <div class="col-xl-12">
    <!-- Default -->
    <div class="widget has-shadow">
      <div class="widget-header bordered no-actions d-flex align-items-center">
        <h4 id="chart">Chart</h4>
        
        
       
        
      </div>
      <div class="widget-body">
        <!-- <h6 align="center" class="text-muted font-italic">This table shows all properties number each integration status.</h6> -->
        <!-- begin section -->
        <!--  -->
        <!-- <br>
        <h6 align="center" class="text-muted font-italic">This table shows all properties number each Status.</h6> -->
<style>
  canvas{
    -moz-user-select: none;
    -webkit-user-select: none;
    -ms-user-select: none;
  }
  </style>
  <div style="width:100%;">
    <canvas id="canvas"></canvas>
  </div>
  <br>
  <br>
<!--  <button id="randomizeData">Randomize Data</button>
  <button id="addDataset">Add Dataset</button>
  <button id="removeDataset">Remove Dataset</button>
  <button id="addData">Add Data</button>
  <button id="removeData">Remove Data</button> -->


<script>
  window.chartColors = {
  red: 'rgb(255, 99, 132)',
  red1: 'rgb(255, 0, 0)',
  orange: 'rgb(255, 159, 64)',
  yellow: 'rgb(255, 205, 86)',
  green: 'rgb(75, 192, 192)',
  blue: 'rgb(54, 162, 235)',
  navy: 'rgb(0, 0, 128)',
  teal: 'rgb(0, 128, 128)',
  airbnb: '#FF5A60',
  peru: 'rgb(205,133,63)',
  purple: 'rgb(153, 102, 255)',
  grey: 'rgb(201, 203, 207)',
  bookingcom1: '#003580',
  bookingcom2: '#009FE3',
  ha1: '#106EB8',
  ha2: '#040404',
  ta1: '#00B288',
  ta2: '#FCC507',
  ex1: '#00355F',
  ex2: '#EEC218'
};


</script>
<script>
    // var MONTHS = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
    var MONTHS = [<?php echo "'".implode("','", $timestamp )."'"; ?>];
    // console.log(MONTHS);
    
    var config = {
      type: 'line',
      data: {
        labels: MONTHS,
        datasets: [{
          label: 'RedAwning',
          backgroundColor: window.chartColors.orange,
          borderColor: window.chartColors.orange,
          data: [
              <?php echo "'".implode("','", $redawning )."'";?>
  
          ],
          fill: false,
        },
         {
          label: 'Airbnb',
          fill: false,
          backgroundColor: window.chartColors.airbnb,
          borderColor: window.chartColors.airbnb,
          data: [
          <?php echo "'".implode("','", $airbnb )."'"; ?>

          ],
        }, {
          label: 'Expedia',
          fill: false,
          backgroundColor: window.chartColors.green,
          borderColor: window.chartColors.green,
          data: [
            <?php echo "'".implode("','", $expedia )."'"; ?>

          ],
        }, {
          label: 'HomeAway',
          fill: false,
          backgroundColor: window.chartColors.blue,
          borderColor: window.chartColors.blue,
          data: [
            <?php echo "'".implode("','", $homeaway )."'"; ?>

          ],
        }
        // end categories
        ]
      },
      options: {
        responsive: true,
        title: {
          display: true,
          text: 'Click Categories below for toggle show/hide'
        },
        tooltips: {
          mode: 'index',
          intersect: false,
        },
        hover: {
          mode: 'nearest',
          intersect: true
        },
        scales: {
          xAxes: [{
            display: true,
            scaleLabel: {
              display: true,
              labelString: 'Date'
            }
          }],
          yAxes: [{
            display: true,
            scaleLabel: {
              display: true,
              labelString: 'Value'
            }
          }]
        }
      }
    };
    window.onload = function() {
      var ctx = document.getElementById('canvas').getContext('2d');
      window.myLine = new Chart(ctx, config);
    };
    document.getElementById('randomizeData').addEventListener('click', function() {
      config.data.datasets.forEach(function(dataset) {
        dataset.data = dataset.data.map(function() {
          return randomScalingFactor();
        });
      });
      window.myLine.update();
    });
    var colorNames = Object.keys(window.chartColors);
    document.getElementById('addDataset').addEventListener('click', function() {
      var colorName = colorNames[config.data.datasets.length % colorNames.length];
      var newColor = window.chartColors[colorName];
      var newDataset = {
        label: 'Dataset ' + config.data.datasets.length,
        backgroundColor: newColor,
        borderColor: newColor,
        data: [],
        fill: false
      };
      for (var index = 0; index < config.data.labels.length; ++index) {
        newDataset.data.push(randomScalingFactor());
      }
      config.data.datasets.push(newDataset);
      window.myLine.update();
    });
    document.getElementById('addData').addEventListener('click', function() {
      if (config.data.datasets.length > 0) {
        var month = MONTHS[config.data.labels.length % MONTHS.length];
        config.data.labels.push(month);
        config.data.datasets.forEach(function(dataset) {
          dataset.data.push(randomScalingFactor());
        });
        window.myLine.update();
      }
    });
    document.getElementById('removeDataset').addEventListener('click', function() {
      config.data.datasets.splice(0, 1);
      window.myLine.update();
    });
    document.getElementById('removeData').addEventListener('click', function() {
      config.data.labels.splice(-1, 1); // remove the label first
      config.data.datasets.forEach(function(dataset) {
        dataset.data.pop();
      });
      window.myLine.update();
    });
  </script>
<!--  -->
 <script src="assets/vendors/js/base/jquery.min.js"></script>
    <script type="text/javascript">
$(function () {
  $('[data-toggle="tooltip"]').tooltip()
});




    </script>
      </div>
    </div>
  </div>
</div>
<!-- End Row
