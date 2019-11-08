

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
SELECT nid, duration_g, Integration, Integration_Default,Created, Published,Duration,
<br>sec_to_time(AVG(time_to_sec(TIMEDIFF( convert_tz(Published,'PST8PDT','GMT'), Created)))) 'ravg',
<br>sec_to_time(AVG(time_to_sec(TIMEDIFF( airbnb_created, convert_tz(Published,'PST8PDT','GMT'))))) 'aavg',
<br>sec_to_time(AVG(time_to_sec(TIMEDIFF( bookingcom_created, convert_tz(Published,'PST8PDT','GMT'))))) 'bavg',
<br>sec_to_time(AVG(time_to_sec(TIMEDIFF( homeaway_created, convert_tz(Published,'PST8PDT','GMT'))))) 'havg',
<br>sec_to_time(AVG(time_to_sec(TIMEDIFF( expedia_created, convert_tz(Published,'PST8PDT','GMT'))))) 'eavg',
<br>sec_to_time(AVG(time_to_sec(TIMEDIFF( tripadvisor_created, convert_tz(Published,'PST8PDT','GMT'))))) 'tavg'
<br>  from(SELECT a.nid 'nid', DATE_FORMAT(timestamp1,'%Y-%m-%d') 'duration_g',
<br>if(cff.field_calendar_feed_format_value like 'haapi_%', 'homeaway API',cff.field_calendar_feed_format_value) 'Integration',
<br>  cff.field_calendar_feed_format_value 'Integration_Default',
<br>  timestamp1 'Created', 
<br>  b.Published 'Published', 
<br>  TIMEDIFF( b.Published, timestamp1) 'Duration', 
<br>  group_concat(
<br>    if(
<br>      cp.channel = 'airbnb', cp.created_ts, 
<br>      null
<br>    )
<br>  ) as 'airbnb_created', 
<br>  group_concat(
<br>    if(
<br>      cp.channel = 'bookingcom', cp.created_ts, 
<br>      null
<br>    )
<br>  ) as 'bookingcom_created', 
<br>  group_concat(
<br>    if(
<br>      cp.channel = 'homeaway', cp.created_ts, 
<br>      null
<br>    )
<br>  ) as 'homeaway_created', 
<br>  group_concat(
<br>    if(
<br>      cp.channel = 'expedia', cp.created_ts, 
<br>      null
<br>    )
<br>  ) as 'expedia_created', 
<br>  group_concat(
<br>    if(
<br>      cp.channel = 'tripadvisor', cp.created_ts, 
<br>      null
<br>    )
<br>  ) as 'tripadvisor_created' 
<br>FROM 
<br>  (
<br>    SELECT 
<br>      nid, 
<br>      uid, 
<br>      FROM_UNIXTIME(created) 'timestamp1' 
<br>    FROM 
<br>      node
<br>  ) a 
<br>  left join (
<br>    select 
<br>      min(psmnid), 
<br>      psmnid, 
<br>      nid, 
<br>      destination_state, 
<br>      created_at 'Published' 
<br>    from 
<br>      property_state_machine_notes 
<br>    where 
<br>      destination_state = 'live'
<br>      group by nid
<br>  ) b on b.nid = a.nid 
<br>  left join manager_cc_fees mc on mc.mid = a.uid 
<br>  left join channel_properties cp on cp.nid = a.nid 
<br>  left join field_data_field_calendar_feed_format cff on cff.entity_id = a.nid
<br>where timestamp1 between '$date1 00:00:00' and '$date2 23:59:59'
<br>and if(cff.field_calendar_feed_format_value like 'haapi_%', 'homeaway API',cff.field_calendar_feed_format_value) = '$pms'
<br>and b.Published !='NULL'
<br>  group by a.nid
<br>  ) h
<br>  group by h.duration_g
<br>

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
<h6 align="center" class="text-muted font-italic">Select Dates Interval and PMS below. the result show the average each day</h6>

<hr>


<form method="get">
  <div class="form-group">
<div class="senter"><input type="date" name="date1" id="date1">
<h5>&emsp; &emsp; &emsp; &emsp;</h5>
<input type="date" name="date2" id="date2"> </div>
    <br>
      <div class="form-group">  
  <div class="senter"><select class="form-control form-control" name="pms" id="keyword" style="width: 25%; text-align: center;">
     <option value="">All</option>
<option>aaxsys</option>
<option>alpineski</option>
<option>angelfire</option>
<option>barefoot</option>
<option>belvilla</option>
<option>breckenridge</option>
<option>breken</option>
<option>buckingham_tahoe</option>
<option>cambriaandrs</option>
<option>casanovacondos</option>
<option>cbv_custom</option>
<option>chasenrainbows</option>
<option>clearstay</option>
<option>entech</option>
<option>escapia</option>
<option>exclusiveproperty</option>
<option>homeaway API</option>
<option>hawaiilife</option>
<option>highcountry</option>
<option>homeaway</option>
<option>homeaway2</option>
<option>ical</option>
<option>ical2</option>
<option>interhome</option>
<option>isilink</option>
<option>kokopelli</option>
<option>liverez</option>
<option>llag</option>
<option>nextpax</option>
<option>palmera</option>
<option>pyramidpeak</option>
<option>racalendar</option>
<option>rdp</option>
<option>redawningportal</option>
<option>redwoodyosemite</option>
<option>resortrealty</option>
<option>rocky</option>
<option>tahoekeys</option>
<option>telluride</option>
<option>travelkeys</option>
<option>truckee_reservations</option>
<option>vacationbridge</option>
<option>vail</option>
<option>vaycayhero</option>
<option>vaycayhero_pms</option>
<option>villas</option>
<option>vrbo</option>
  </select>
  </div>
</div>
  <div class="senter"><button type="submit" class="btn btn-dark" name="submit">Submit</button>
  </div></div>
<br>
<br>
<?php 
// var_dump($opt);
// error_reporting(0);
// $inputnid = explode(",",$_GET['nid']);
// var_dump($inputnid); ?>
<div class="container-fluid table-responsive" id="export1">
    <?php if( !isset($_GET['submit'])) {
}else{?>



<table class="table-striped" >
  <tr>
      <th >No</th>
      <th >Date</th>
      <th >Integration</th>
      <th >RedAwning</th>
      <th >AirBnb</th>
      <th >Booking.com</th>
      <th >Expedia</th>
      <th >Homeaway</th>
      <th >TripAdvisor</th>
  </tr>
  <?php $i = 1; 
  $total= array();?>
  <?php foreach ($result as $key) {;?>

  <tr>
      <td><?php echo $i; ?></td>
      <td><?php echo $key["duration_g"]; ?></td>
      <td><?php 
      if ($_GET['pms']=="") {
        echo "All";
      }else { echo $key["Integration"]; };

      ?></td>
      <td><?php 
      // echo substr($key["ravg"],0,-6); 

     echo  str_replace("-","",strstr($key["ravg"], ".", true));
      ?></td>
      <td><?php echo str_replace("-","",strstr($key["aavg"], ".", true)); ?></td>
      <td><?php echo str_replace("-","",strstr($key["bavg"], ".", true)); ?></td>
      <td><?php echo str_replace("-","",strstr($key["eavg"], ".", true)); ?></td>
      <td><?php echo str_replace("-","",strstr($key["havg"], ".", true)); ?></td>
      <td><?php echo str_replace("-","",strstr($key["tavg"], ".", true)); ?></td>

  </tr>
<?php $i++;}; ?>
   </table>
 <?php }; ?>
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
<script type="text/javascript">



      document.getElementById('keyword').value = "<?php echo $_GET['pms']; ?>"
      document.getElementById('date1').value = "<?php echo $_GET['date1']; ?>"
      document.getElementById('date2').value = "<?php echo $_GET['date1']; ?>"


</script>