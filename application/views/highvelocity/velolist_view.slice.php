

<!-- End Page Header -->
            <div class="row">
              <div class="col-xl-12">
                <!-- Default -->
                <div class="widget has-shadow">
                  <div class="widget-header bordered no-actions d-flex align-items-center">
                    <h4></h4>

                    
<div align="center"><h1 align="center" style="display: inline-block;"><b></b></h1><button type="button" class="badge badge-info btn" data-toggle="modal" data-target="#examplemodalz" >query</button></div>

<!-- <button class="btn btn-success" onclick="javascript:demoFromHTML()">PDF</button> -->
<!-- Modal -->
<div class="modal fade" id="examplemodalz" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelz" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabelz">Query</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
-

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
                  </div>
                  <div class="widget-body">

<br>
<h6 align="center" class="text-muted font-italic">Select Dates Interval to get list of NIDs on the interval.
<br>
then select pre/post live
<br>
click the nid to see complete state transitions</h6>

<hr>


<form method="get">
      <div class="form-group">  
  <div class="senter"><select class="form-control form-control" name="live" id="keyword" style="width: 25%; text-align: center;">
<option>Pre Live</option>
<option>Post Live</option>
  </select>
  </div>
</div>

  <div class="form-group">
<div class="senter"><input type="date" name="theDate1" id="date1">
<h5>&emsp; &emsp; &emsp; &emsp;</h5>
<input type="date" name="theDate2" id="date2"> </div>
    <br>
  <div class="senter"><button type="submit" class="btn btn-dark" name="submit">Submit</button>


  </form>

  </div></div>
<br>
<br>
<?php 
// var_dump($opt);
// error_reporting(0);
// $inputnid = explode(",",$_GET['nid']);
// var_dump($inputnid); ?>
<div class="container table-responsive" id="export1">
  <table id="export-table" class="table-striped">
  <thead>
    <tr>
      <th rowspan="2">no</th>
      <th rowspan="2">UID</th>
      <th rowspan="2">NID</th>
      <!-- <th>Live</th> -->
<th rowspan="2">State</th>
<th rowspan="2">Start</th>
<th rowspan="2">End</th>
<th colspan="4">Duration</th>
    </tr>
        <tr>
<th>inSecond</th>
<th>inMinutes</th>
<th>inHour</th>
<th>inDay</th>
    </tr>
  </thead>
  <tbody>
    <?php 
$i = 1;
foreach ($result as $key):?>
    <tr>
      <td scope="row"><?php echo $i; ?></th>
        <td><?php echo $key['uid']; ?></td>
      <td><a data-toggle="modal" data-target="#modal-large" class="tampiltomvol" data-nid="<?php echo $key['nid']; ?>"><?php echo $key['nid']; ?></a></td>
      <td><?php echo $key['state']; ?></td>
      <td><?php echo $key['start']; ?></td>
      <td><?php echo $key['end']; ?></td>
      <td><?php echo $key['duration in sec']; ?></td>
      <td><?php echo $key['duration in minutes']; ?></td>
      <td><?php echo $key['duration in hour']; ?></td>
      <td><?php echo $key['duration in day']; ?></td>
    </tr>
<?php 
$i++;
endforeach; ?>
  </tbody>
</table>

 </div>
 <?php 
// $profile = json_decode(http_request("https://EQC_Redawning:EWK3E7KDY4V2iR7@services.expediapartnercentral.com/properties/v1/redawning/"."280891"), TRUE);
// echo $profile['errors'][0]['message'];
  ?>
<!-- </div> -->
<!-- load jquery js file -->
<!--     <script src="js/jquery.min.js"></script>
    load bootstrap js file
    <script src="js/bootstrap.min.js"></script> -->
                  </div>
                </div>
                 </div>
                  </div>


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
<script type="text/javascript">
console.log("gfbfgngfn");
// alert('sdsdsdsd');
<?php 
if (isset($_GET['submit'])):?>
      document.getElementById('date1').value = "<?php echo $_GET['theDate1']; ?>"
      document.getElementById('date2').value = "<?php echo $_GET['theDate2']; ?>"
      document.getElementById('keyword').value = "<?php echo $_GET['live']; ?>"
<?php endif; ?>

</script>

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

  const nid = $(this).data('nid');
 $('.statuss').html(nid+ "| property_state_machine_notes"); 
$('.modal-body').hide();
$('.loader').show();
$.get("{{ base_url('velocity_list/statenote') }}?nid="+nid, function(data){
    $('.loader').hide();
    $(".modal-body").html(data);
    $('.modal-body').show(); });
    // $('.data').show();     });




})
// console.log("{{ base_url('velocity_list/statenote') }}?nid="+nid);
})





    </script>