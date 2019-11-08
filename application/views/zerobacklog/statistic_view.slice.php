
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
       <h4 align="center">Backlog Table</h4><hr>
        
        
        
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

        <b>RedAwning Pending</b>
<br>SELECT count(import_pending_id) 'total' FROM radb.pending_property
<br>where last_action_info in ('Waiting SQS for processing','New pending property')
<br>;
<br>
<b>RedAwning LiveNotReviewed</b>
        <br>SELECT count(nid) 'total' from (
<br>SELECT 
<br>d.nid,
<br>n.title as Title,
<br>u.name as 'username', 
<br>u.mail 'email',
<br>n.uid,  
<br>d.state_name
<br>
<br>from (select nid, state_name from (select vr.is_deleted, vr.code, vr.nid, n.uid, psm.state_name, vc.channel, vc.production_severity, vc.description, b.airbnb_opt, b.bookingcom_opt, b.homeaway_opt, b.expedia_opt, b.tripadvisor_opt from validation_results vr
<br>left join validation_channels vc on vc.code=vr.code
<br>left join node n on n.nid = vr.nid
<br>left join property_state_machine psm on n.nid=psm.nid
<br>left join 
<br>-- TABLE CHANNELS OPT IN 2 (CONVERT ROW INTO COLUMN)--
<br>(
<br>select a.mid 'uid', 
<br>group_concat( 
<br>if( 
<br>(a.channel = 'airbnb' && opt = 1), 1, 
<br>null 
<br>) 
<br>) as 'airbnb_opt', 
<br>group_concat( 
<br>if( 
<br>(a.channel = 'homeaway' && opt = 1), 1, 
<br>null 
<br>) 
<br>) as 'homeaway_opt',
<br>group_concat( 
<br>if( 
<br>(a.channel = 'bookingcom' && opt = 1), 1, 
<br>null 
<br>) 
<br>) as 'bookingcom_opt',
<br>group_concat( 
<br>if( 
<br>(a.channel = 'expedia' && opt = 1), 1, 
<br>null 
<br>) 
<br>) as 'expedia_opt',
<br>group_concat( 
<br>if( 
<br>(a.channel = 'tripadvisor' && opt = 1), 1, 
<br>null 
<br>) 
<br>) as 'tripadvisor_opt',
<br>group_concat( 
<br>if( 
<br>(a.channel = 'redawning' && opt = 1), 1, 
<br>null 
<br>) 
<br>) as 'redawning_opt'
<br>from
<br>-- TABLE CHANNELS OPT IN 1 (SHOWING ONLY 5 PRIMARY CHANNELS)--
<br>(select * from manager_opt_channel
<br>where channel in ('expedia','bookingcom','tripadvisor','airbnb','homeaway','redawning')
<br>) a
<br>-- [END]TABLE CHANNELS OPT IN 1 (SHOWING ONLY 5 PRIMARY CHANNELS)--
<br>group by a.mid) b
<br>-- [END]TABLE CHANNELS OPT IN 2 (CONVERT ROW INTO COLUMN)--
<br>on b.uid = n.uid
<br>where psm.state_name = 'livenotreviewed'
<br>-- REMOVING [PO] MARK IN B.COM AND EXPEDIA THAT HAS OPTIN NULL 
<br>and not (vc.description like '[PO]%' && b.bookingcom_opt=null && vc.channel='bookingcom')
<br>and not (vc.description like '[PO]%' && b.expedia_opt=null && vc.channel='expedia')
<br>and not (vc.description like '[PO]%' && b.homeaway_opt=null && vc.channel='homeaway')
<br>and vr.is_deleted = 0
<br>) c
<br>-- SHOWING ONLY TAG [PO] with error code 303,312,824,826,825,827,900
<br>where c.description like '[PO]%'
<br>and c.production_severity in ('fatal','warning')
<br>and c.code in (303,312,824,826,825,827,900)
<br>group by c.nid) d
<br>left join node n on n.nid=d.nid
<br>left join users u on u.uid=n.uid
<br>where u.mail not in ('hello@leavetown.com','Vicky.Lova@redawning.com',<br>'sarah.herz@redawning.com','brett@redawning.com')
<br>order by d.nid
<br>desc
<br>) count_table
;<br><br>

<br><b>RedAwning Total</b>
<br>SELECT count(a.num) 'num' 
<br>from (select psm.nid 'num' from radb.property_state_machine psm 
<br>left join node n on n.nid=psm.nid 
<br>left join profile_value pv on n.uid = pv.uid and pv.fid = 21 
<br>left join manager_cc_fees mc on mc.mid=n.uid 
<br>left join validation_results vr on vr.nid=n.nid and vr.is_deleted=0 
<br>left join validation_channels vc on vc.code=vr.code 
<br>where psm.state_name in (
<br>'FailedValidationNeedsReview', 'WaitingForValidation', 'BlockedUnderConstruction') 
<br>and vc.production_severity in ('fatal') 
<br>and vc.description like ('[PO]%') 
<br>group by psm.nid 
<br>) a <br>
<br><b>RedAwning In</b>
<br>SELECT count(nid) 'total',
<br>timestamp1
<br>
<br>FROM (SELECT nid, uid,
<br>DATE_FORMAT(convert_tz(FROM_UNIXTIME(created),<br>'US/Pacific','Asia/Jakarta')<br>, '%Y-%m-%d') 'timestamp1' FROM node) a
<br>where
<br>timestamp1 like '2019-04-%'
<br>or timestamp1 like '2019-05-%'
<br>group by timestamp1;<br><br>
<b>RedAwning Out</b>
<br>SELECT count(a.nid) 'number', Status, timestamp FROM (SELECT 
<br>min(psmnid), nid, destination_state 'Status', 
<br>state_notes, date_format(convert_tz(created_at,
<br>'US/Pacific','Asia/Jakarta'),'%Y-%m-%d') 'timestamp', created_by 
<br>FROM radb.property_state_machine_notes 
<br>where destination_state = 'Live' 
<br>group by nid
<br>) a 
<br>where timestamp = DATE_FORMAT(CURDATE(),'%Y-%m-%d')
<br>;


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="examplemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Query</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <b>AirBNB Total</b>
<br>SELECT
<br>count(distinct n.nid) 'num'
<br>from
<br>node n
<br>left join manager_opt_channel opt on opt.mid=n.uid
<br>left join users u on u.uid=n.uid
<br>left join property_state_machine psm on psm.nid=n.nid
<br>left join rep_property rep on rep.nid=n.nid
<br>left join channel_properties cp on cp.nid=n.nid and cp.channel='airbnb'
<br>left join field_data_field_calendar_feed_format cal on cal.entity_id=n.nid
<br>left join airbnb_account aa on aa.uid=n.uid
<br>where
<br>opt.channel = 'airbnb'
<br>    and opt.opt = 1
<br>and psm.state_name in ('Live','LiveNotReviewed')
<br>and n.nid not in
<br>(
<br>select nid
<br>from rep_property rep
<br>where rep.parent!=0
<br>)
<br>and n.nid not in 
<br>(
<br>select nid
<br>from channel_properties cp
<br>where channel = 'airbnb'
<br>) <br>
<br><b>AirBNB In</b>
<br>SELECT c.timestamp1, count(c.nid) 'total' from (
<br>select
<br>n.nid, 
<br>u.uid, 
<br>u.name as 'email',
<br>psm.state_name,
<br>cal.field_calendar_feed_format_value as cal_format,
<br>opt.opt as 'opt_pm_level',
<br>case when rep.parent=0 then 'parent' when rep.parent!=0 then 'child' else 'key' end as 'level',
<br>rep.parent as 'parent_nid',
<br>
<br>DATE_FORMAT(convert_tz(b.timestamp1,'US/Pacific','Asia/Jakarta'), '%Y-%m-%d') 'timestamp1'
<br>from
<br>node n
<br>left join manager_opt_channel opt on opt.mid=n.uid
<br>left join users u on u.uid=n.uid
<br>left join property_state_machine psm on psm.nid=n.nid
<br>left join rep_property rep on rep.nid=n.nid
<br>left join channel_properties cp on cp.nid=n.nid and cp.channel='airbnb'
<br>left join field_data_field_calendar_feed_format cal on cal.entity_id=n.nid
<br>left join 
<br>(select a.nid, a.state, a.timestamp1 from (SELECT nid, destination_state 'state', created_at 'timestamp1' FROM radb.property_state_machine_notes
<br>order by psmnid
<br>desc) a
<br>group by nid) b on b.nid=n.nid
<br>where
<br>opt.channel = 'airbnb'
<br>and opt.opt = 1
<br>and psm.state_name in ('Live','LiveNotReviewed')
<br>and n.nid not in
<br>(
<br>select nid
<br>from radb.rep_property rep
<br>where rep.parent!=0
<br>)
<br>and n.nid not in 
<br>(
<br>select nid
<br>from channel_properties cp
<br>where channel = 'airbnb'
<br>)
<br>group by uid, nid) c
<br>group by c.timestamp1<br><br>
<b>AirBNB Out</b>
<br>SELECT count(nid) 'total' from (select nid,channel_id,uid,email,opt_in,channel_status, created_on, date_1 from (select
<br>n.nid,
<br>cp.channel_id,
<br>n.uid,
<br>u.name as 'email',
<br>cp.opt_in,
<br>cp.status as 'channel_status',
<br>cp.created_ts as 'created_on',
<br>substring(convert_tz(created_ts,'US/Pacific','Asia/Jakarta'),1, 10) 'date_1'
<br>from
<br>node n
<br>left join channel_properties cp on cp.nid=n.nid
<br>left join users u on u.uid=n.uid
<br>where
<br>cp.channel='airbnb'
<br>) a
<br>where a.date_1 = DATE_FORMAT(CURDATE()-1,'%Y-%m-%d')) b

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>



<!-- <button class="btn btn-success" onclick="javascript:demoFromHTML()">PDF</button> -->
<!-- Modal -->
<div class="modal fade" id="examplemodalz2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelz2" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabelz2">Query</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <b>Booking.com Total</b>
<br>SELECT
<br>count(distinct n.nid) 'num'
<br>from
<br>node n
<br>left join manager_opt_channel opt on opt.mid=n.uid
<br>left join users u on u.uid=n.uid
<br>left join property_state_machine psm on psm.nid=n.nid
<br>left join rep_property rep on rep.nid=n.nid
<br>left join channel_properties cp on cp.nid=n.nid and cp.channel='bookingcom'
<br>left join field_data_field_calendar_feed_format cal on cal.entity_id=n.nid
<br>left join airbnb_account aa on aa.uid=n.uid
<br>where
<br>opt.channel = 'bookingcom'
<br>    and opt.opt = 1
<br>and psm.state_name in ('Live','LiveNotReviewed')
<br>and n.nid not in
<br>(
<br>select nid
<br>from rep_property rep
<br>where rep.parent!=0
<br>)
<br>and n.nid not in 
<br>(
<br>select nid
<br>from channel_properties cp
<br>where channel = 'bookingcom'
<br>) <br>
<br><b>Booking.com In</b>
<br>SELECT c.timestamp1, count(c.nid) 'total' from (
<br>select
<br>n.nid, 
<br>u.uid, 
<br>u.name as 'email',
<br>psm.state_name,
<br>cal.field_calendar_feed_format_value as cal_format,
<br>opt.opt as 'opt_pm_level',
<br>case when rep.parent=0 then 'parent' when rep.parent!=0 then 'child' else 'key' end as 'level',
<br>rep.parent as 'parent_nid',
<br>
<br>DATE_FORMAT(convert_tz(b.timestamp1,'US/Pacific','Asia/Jakarta'), '%Y-%m-%d') 'timestamp1'
<br>from
<br>node n
<br>left join manager_opt_channel opt on opt.mid=n.uid
<br>left join users u on u.uid=n.uid
<br>left join property_state_machine psm on psm.nid=n.nid
<br>left join rep_property rep on rep.nid=n.nid
<br>left join channel_properties cp on cp.nid=n.nid and cp.channel='bookingcom'
<br>left join field_data_field_calendar_feed_format cal on cal.entity_id=n.nid
<br>left join 
<br>(select a.nid, a.state, a.timestamp1 from (SELECT nid, destination_state 'state', created_at 'timestamp1' FROM radb.property_state_machine_notes
<br>order by psmnid
<br>desc) a
<br>group by nid) b on b.nid=n.nid
<br>where
<br>opt.channel = 'bookingcom'
<br>and opt.opt = 1
<br>and psm.state_name in ('Live','LiveNotReviewed')
<br>and n.nid not in
<br>(
<br>select nid
<br>from radb.rep_property rep
<br>where rep.parent!=0
<br>)
<br>and n.nid not in 
<br>(
<br>select nid
<br>from channel_properties cp
<br>where channel = 'bookingcom'
<br>)
<br>group by uid, nid) c
<br>group by c.timestamp1<br><br>
<b>Booking.com Out</b>
<br>SELECT count(nid) 'total' from (select nid,channel_id,uid,email,opt_in,channel_status, created_on, date_1 from (select
<br>n.nid,
<br>cp.channel_id,
<br>n.uid,
<br>u.name as 'email',
<br>cp.opt_in,
<br>cp.status as 'channel_status',
<br>cp.created_ts as 'created_on',
<br>substring(convert_tz(created_ts,'US/Pacific','Asia/Jakarta'),1, 10) 'date_1'
<br>from
<br>node n
<br>left join channel_properties cp on cp.nid=n.nid
<br>left join users u on u.uid=n.uid
<br>where
<br>cp.channel='bookingcom'
<br>) a
<br>where a.date_1 = DATE_FORMAT(CURDATE()-1,'%Y-%m-%d')) b

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


<!-- <button class="btn btn-success" onclick="javascript:demoFromHTML()">PDF</button> -->
<!-- Modal -->
<div class="modal fade" id="examplemodalz3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelz3" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabelz3">Query</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <b>Expedia Total</b>
<br>SELECT
<br>count(distinct n.nid) 'num'
<br>from
<br>node n
<br>left join manager_opt_channel opt on opt.mid=n.uid
<br>left join users u on u.uid=n.uid
<br>left join property_state_machine psm on psm.nid=n.nid
<br>left join rep_property rep on rep.nid=n.nid
<br>left join channel_properties cp on cp.nid=n.nid and cp.channel='expedia'
<br>left join field_data_field_calendar_feed_format cal on cal.entity_id=n.nid
<br>left join airbnb_account aa on aa.uid=n.uid
<br>where
<br>opt.channel = 'expedia'
<br>    and opt.opt = 1
<br>and psm.state_name in ('Live','LiveNotReviewed')
<br>and n.nid not in
<br>(
<br>select nid
<br>from rep_property rep
<br>where rep.parent!=0
<br>)
<br>and n.nid not in 
<br>(
<br>select nid
<br>from channel_properties cp
<br>where channel = 'expedia'
<br>) <br>
<br><b>Expedia In</b>
<br>SELECT c.timestamp1, count(c.nid) 'total' from (
<br>select
<br>n.nid, 
<br>u.uid, 
<br>u.name as 'email',
<br>psm.state_name,
<br>cal.field_calendar_feed_format_value as cal_format,
<br>opt.opt as 'opt_pm_level',
<br>case when rep.parent=0 then 'parent' when rep.parent!=0 then 'child' else 'key' end as 'level',
<br>rep.parent as 'parent_nid',
<br>
<br>DATE_FORMAT(convert_tz(b.timestamp1,'US/Pacific','Asia/Jakarta'), '%Y-%m-%d') 'timestamp1'
<br>from
<br>node n
<br>left join manager_opt_channel opt on opt.mid=n.uid
<br>left join users u on u.uid=n.uid
<br>left join property_state_machine psm on psm.nid=n.nid
<br>left join rep_property rep on rep.nid=n.nid
<br>left join channel_properties cp on cp.nid=n.nid and cp.channel='expedia'
<br>left join field_data_field_calendar_feed_format cal on cal.entity_id=n.nid
<br>left join 
<br>(select a.nid, a.state, a.timestamp1 from (SELECT nid, destination_state 'state', created_at 'timestamp1' FROM radb.property_state_machine_notes
<br>order by psmnid
<br>desc) a
<br>group by nid) b on b.nid=n.nid
<br>where
<br>opt.channel = 'expedia'
<br>and opt.opt = 1
<br>and psm.state_name in ('Live','LiveNotReviewed')
<br>and n.nid not in
<br>(
<br>select nid
<br>from radb.rep_property rep
<br>where rep.parent!=0
<br>)
<br>and n.nid not in 
<br>(
<br>select nid
<br>from channel_properties cp
<br>where channel = 'expedia'
<br>)
<br>group by uid, nid) c
<br>group by c.timestamp1<br><br>
<b>Expedia Out</b>
<br>SELECT count(nid) 'total' from (select nid,channel_id,uid,email,opt_in,channel_status, created_on, date_1 from (select
<br>n.nid,
<br>cp.channel_id,
<br>n.uid,
<br>u.name as 'email',
<br>cp.opt_in,
<br>cp.status as 'channel_status',
<br>cp.created_ts as 'created_on',
<br>substring(convert_tz(created_ts,'US/Pacific','Asia/Jakarta'),1, 10) 'date_1'
<br>from
<br>node n
<br>left join channel_properties cp on cp.nid=n.nid
<br>left join users u on u.uid=n.uid
<br>where
<br>cp.channel='expedia'
<br>) a
<br>where a.date_1 = DATE_FORMAT(CURDATE()-1,'%Y-%m-%d')) b

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


<!-- <button class="btn btn-success" onclick="javascript:demoFromHTML()">PDF</button> -->
<!-- Modal -->
<div class="modal fade" id="examplemodalz4" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelz4" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabelz4">Query</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <b>HomeAway Total</b>
<br>SELECT
<br>count(distinct n.nid) 'num'
<br>from
<br>node n
<br>left join manager_opt_channel opt on opt.mid=n.uid
<br>left join users u on u.uid=n.uid
<br>left join property_state_machine psm on psm.nid=n.nid
<br>left join rep_property rep on rep.nid=n.nid
<br>left join channel_properties cp on cp.nid=n.nid and cp.channel='homeaway'
<br>left join field_data_field_calendar_feed_format cal on cal.entity_id=n.nid
<br>left join airbnb_account aa on aa.uid=n.uid
<br>where
<br>opt.channel = 'homeaway'
<br>    and opt.opt = 1
<br>and psm.state_name in ('Live','LiveNotReviewed')
<br>and n.nid not in
<br>(
<br>select nid
<br>from rep_property rep
<br>where rep.parent=0
<br>)
<br>and n.nid not in 
<br>(
<br>select nid
<br>from channel_properties cp
<br>where channel = 'homeaway'
<br>) <br>
<br><b>HomeAway In</b>
<br>SELECT c.timestamp1, count(c.nid) 'total' from (
<br>select
<br>n.nid, 
<br>u.uid, 
<br>u.name as 'email',
<br>psm.state_name,
<br>cal.field_calendar_feed_format_value as cal_format,
<br>opt.opt as 'opt_pm_level',
<br>case when rep.parent=0 then 'parent' when rep.parent!=0 then 'child' else 'key' end as 'level',
<br>rep.parent as 'parent_nid',
<br>
<br>DATE_FORMAT(convert_tz(b.timestamp1,'US/Pacific','Asia/Jakarta'), '%Y-%m-%d') 'timestamp1'
<br>from
<br>node n
<br>left join manager_opt_channel opt on opt.mid=n.uid
<br>left join users u on u.uid=n.uid
<br>left join property_state_machine psm on psm.nid=n.nid
<br>left join rep_property rep on rep.nid=n.nid
<br>left join channel_properties cp on cp.nid=n.nid and cp.channel='homeaway'
<br>left join field_data_field_calendar_feed_format cal on cal.entity_id=n.nid
<br>left join 
<br>(select a.nid, a.state, a.timestamp1 from (SELECT nid, destination_state 'state', created_at 'timestamp1' FROM radb.property_state_machine_notes
<br>order by psmnid
<br>desc) a
<br>group by nid) b on b.nid=n.nid
<br>where
<br>opt.channel = 'homeaway'
<br>and opt.opt = 1
<br>and psm.state_name in ('Live','LiveNotReviewed')
<br>and n.nid not in
<br>(
<br>select nid
<br>from radb.rep_property rep
<br>where rep.parent=0
<br>)
<br>and n.nid not in 
<br>(
<br>select nid
<br>from channel_properties cp
<br>where channel = 'homeaway'
<br>)
<br>group by uid, nid) c
<br>group by c.timestamp1<br><br>
<b>HomeAway Out</b>
<br>SELECT count(nid) 'total' from (select nid,channel_id,uid,email,opt_in,channel_status, created_on, date_1 from (select
<br>n.nid,
<br>cp.channel_id,
<br>n.uid,
<br>u.name as 'email',
<br>cp.opt_in,
<br>cp.status as 'channel_status',
<br>cp.created_ts as 'created_on',
<br>substring(convert_tz(created_ts,'US/Pacific','Asia/Jakarta'),1, 10) 'date_1'
<br>from
<br>node n
<br>left join channel_properties cp on cp.nid=n.nid
<br>left join users u on u.uid=n.uid
<br>where
<br>cp.channel='homeaway'
<br>) a
<br>where a.date_1 = DATE_FORMAT(CURDATE()-1,'%Y-%m-%d')) b

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>



<!-- <button class="btn btn-success" onclick="javascript:demoFromHTML()">PDF</button> -->
<!-- Modal -->
<div class="modal fade" id="examplemodalz5" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelz5" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabelz5">Query</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <b>TripAdvisor Total</b>
<br>SELECT
<br>count(distinct n.nid) 'num'
<br>from
<br>node n
<br>left join manager_opt_channel opt on opt.mid=n.uid
<br>left join users u on u.uid=n.uid
<br>left join property_state_machine psm on psm.nid=n.nid
<br>left join rep_property rep on rep.nid=n.nid
<br>left join channel_properties cp on cp.nid=n.nid and cp.channel='tripadvisor'
<br>left join field_data_field_calendar_feed_format cal on cal.entity_id=n.nid
<br>left join airbnb_account aa on aa.uid=n.uid
<br>where
<br>opt.channel = 'tripadvisor'
<br>    and opt.opt = 1
<br>and psm.state_name in ('Live','LiveNotReviewed')
<br>and n.nid not in
<br>(
<br>select nid
<br>from rep_property rep
<br>where rep.parent!=0
<br>)
<br>and n.nid not in 
<br>(
<br>select nid
<br>from channel_properties cp
<br>where channel = 'tripadvisor'
<br>) <br>
<br><b>TripAdvisor In</b>
<br>SELECT c.timestamp1, count(c.nid) 'total' from (
<br>select
<br>n.nid, 
<br>u.uid, 
<br>u.name as 'email',
<br>psm.state_name,
<br>cal.field_calendar_feed_format_value as cal_format,
<br>opt.opt as 'opt_pm_level',
<br>case when rep.parent=0 then 'parent' when rep.parent!=0 then 'child' else 'key' end as 'level',
<br>rep.parent as 'parent_nid',
<br>
<br>DATE_FORMAT(convert_tz(b.timestamp1,'US/Pacific','Asia/Jakarta'), '%Y-%m-%d') 'timestamp1'
<br>from
<br>node n
<br>left join manager_opt_channel opt on opt.mid=n.uid
<br>left join users u on u.uid=n.uid
<br>left join property_state_machine psm on psm.nid=n.nid
<br>left join rep_property rep on rep.nid=n.nid
<br>left join channel_properties cp on cp.nid=n.nid and cp.channel='tripadvisor'
<br>left join field_data_field_calendar_feed_format cal on cal.entity_id=n.nid
<br>left join 
<br>(select a.nid, a.state, a.timestamp1 from (SELECT nid, destination_state 'state', created_at 'timestamp1' FROM radb.property_state_machine_notes
<br>order by psmnid
<br>desc) a
<br>group by nid) b on b.nid=n.nid
<br>where
<br>opt.channel = 'tripadvisor'
<br>and opt.opt = 1
<br>and psm.state_name in ('Live','LiveNotReviewed')
<br>and n.nid not in
<br>(
<br>select nid
<br>from radb.rep_property rep
<br>where rep.parent!=0
<br>)
<br>and n.nid not in 
<br>(
<br>select nid
<br>from channel_properties cp
<br>where channel = 'tripadvisor'
<br>)
<br>group by uid, nid) c
<br>group by c.timestamp1<br><br>
<b>TripAdvisor Out</b>
<br>SELECT count(nid) 'total' from (select nid,channel_id,uid,email,opt_in,channel_status, created_on, date_1 from (select
<br>n.nid,
<br>cp.channel_id,
<br>n.uid,
<br>u.name as 'email',
<br>cp.opt_in,
<br>cp.status as 'channel_status',
<br>cp.created_ts as 'created_on',
<br>substring(convert_tz(created_ts,'US/Pacific','Asia/Jakarta'),1, 10) 'date_1'
<br>from
<br>node n
<br>left join channel_properties cp on cp.nid=n.nid
<br>left join users u on u.uid=n.uid
<br>where
<br>cp.channel='tripadvisor'
<br>) a
<br>where a.date_1 = DATE_FORMAT(CURDATE()-1,'%Y-%m-%d')) b

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
      </div>

      <div class="widget-body">
        
      <div>
            <div style="display: inline-block;float: right!important;"><h1><b></b></h1><div class="badge badge-info" style="background-color: green;">Query</div></div>

      <div style="display: inline-block;float: right!important;"><h1><b></b></h1><button type="button" class="badge badge-info btn" data-toggle="modal" data-target="#examplemodalz5" >TripAdvisor</button></div>
            <div style="display: inline-block;float: right!important;"><h1><b></b></h1><button type="button" class="badge badge-info btn" data-toggle="modal" data-target="#examplemodalz4" >HomeAway</button></div>

      <div style="display: inline-block;float: right!important;"><h1><b></b></h1><button type="button" class="badge badge-info btn" data-toggle="modal" data-target="#examplemodalz3" >Expedia</button></div>

      <div style="display: inline-block;float: right!important;"><h1><b></b></h1><button type="button" class="badge badge-info btn" data-toggle="modal" data-target="#examplemodalz2" >Booking.com</button></div>

      <div style="display: inline-block;float: right!important;"><h1><b></b></h1><button type="button" class="badge badge-info btn" data-toggle="modal" data-target="#examplemodal" >AirBnb</button></div>
      <div style="display: inline-block;float: right!important;"><h1><b></b></h1><button type="button" class="badge badge-info btn" data-toggle="modal" data-target="#examplemodalz" >RedAwning</button></div>







      <br>
      <br>
      <br>
      <hr>
</div>
  <h6 align="center" class="text-muted font-italic">Daily Statistic RedAwning and All Channels, script will be run on 23.50 each day<br></h6>
  <style type="text/css">
  label {
    /*display: none;*/
    float: right;
  }
</style>

        <!-- begin section -->
        <!--  -->
        <!-- <br>
        <h6 align="center" class="text-muted font-italic">This table shows all properties number each Status.</h6> -->

        <div class="container-fluid table-responsive" id="export1">
  <table id="export-table" class="table-striped">
  <thead>
  <tr>
      <th rowspan="2">No</th>
      <th rowspan="2">Date</th>
      <th colspan="5">RedAwning</th>
      <th colspan="3">AirBnb</th>
      <th colspan="3">Booking.com</th>
      <th colspan="3">Expedia</th>
      <th colspan="3">Homeaway</th>
      <th colspan="3">TripAdvisor</th>
 
  </tr>

  <tr>
      <th>Pending</th>
      <th>PO Fatal</th>
      <th>Live Not Reviewed</th>
      <th data-toggle="tooltip" data-placement="bottom" title="Consist of LiveNotReviewed, FailedValidationNeedsReview and Pending Properties">In</th>
      <th>Out</th>
      <th>Total</th>
      <th>In</th>
      <th>Out</th>
      <th>Total</th>
      <th>In</th>
      <th>Out</th>
      <th>Total</th>
      <th>In</th>
      <th>Out</th>
      <th>Total</th>
      <th>In</th>
      <th>Out</th>
      <th>Total</th>
      <th>In</th>
      <th>Out</th>
 
  </tr>
</thead>
 <tbody>
@foreach ($zerobacklog as $key)
  <tr>
      <td>{{ $i }}</td>
      <td>{{ $key['date'] }}</td>
      <td>{{ $key['ra_pending'] }}</td>
      <td>{{ $key['ra_backlog'] }}</td>
      <td>{{ $key['ra_livenot'] }}</td>
      <td>{{ $key['ra_in'];}}</td>
       <td>{{ $key['ra_out'] }}</td>
       <td>{{ $key['airbnb_backlog'] }}</td>
       <td>{{ $key['airbnb_in'];  }}</td>
       <td>{{ $key['airbnb_out'];  }}</td>
       <td>{{ $key['bookingcom_backlog'] }}</td>
       <td>{{ $key['bookingcom_in'] }}</td>
       <td>{{ $key['bookingcom_out'] }}</td>
       <td>{{ $key['expedia_backlog'] }}</td>
       <td>{{ $key['expedia_in'] }}</td>
       <td>{{ $key['expedia_out'] }}</td>
       <td>{{ $key['homeaway_backlog'] }}</td>
       <td>{{ $key['homeaway_in'] }}</td>
       <td>{{ $key['homeaway_out'] }}</td>
       <td>{{ $key['tripadvisor_backlog'] }}</td>
       <td>{{ $key['tripadvisor_in'] }}</td>
       <td>{{ $key['tripadvisor_out'] }}</td>
      </tr>
@if ($key['ra_backlog']!=null)
  @php
  array_push($fatalra,$key['ra_backlog']);
  array_push($pendingra,$key['ra_pending']);
  array_push($livenotra,$key['ra_livenot']);
  array_push($datechart,$key['date']);
  array_push($backlogairbnb,$key['airbnb_backlog']);
  array_push($backlogbookingcom,$key['bookingcom_backlog']);
  array_push($backlogexpedia,$key['expedia_backlog']);
  array_push($backloghomeaway,$key['homeaway_backlog']);
  array_push($backlogtripadvisor,$key['tripadvisor_backlog']);    
  @endphp
@endif
@php
$i++;
@endphp
@endforeach
</tbody>
   </table>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- End Row -->

<!--  -->
<!-- End Row -->
<div class="row" style="padding-right: 20px;padding-left: 20px;">
  <div class="col-xl-12">
    <!-- Default -->
    <div class="widget has-shadow">
      <div class="widget-header bordered no-actions d-flex align-items-center">
        <h4>Backlog Chart</h4>
        
        
       
        
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
    var MONTHS = [<?php echo "'".implode("','", $datechart )."'"; ?>];
    console.log(MONTHS);
    
    var config = {
      type: 'line',
      data: {
        labels: MONTHS,
        datasets: [{
          label: 'Pending',
          backgroundColor: window.chartColors.orange,
          borderColor: window.chartColors.orange,
          data: [
              <?php echo "'".implode("','", $pendingra )."'";?>
  
          ],
          fill: false,
        },
         {
          label: 'PO Fatal',
          fill: false,
          backgroundColor: window.chartColors.red1,
          borderColor: window.chartColors.red1,
          data: [
          <?php echo "'".implode("','", $fatalra )."'"; ?>

          ],
        }, {
          label: 'Live Not Reviewed',
          fill: false,
          backgroundColor: window.chartColors.green,
          borderColor: window.chartColors.green,
          data: [
            <?php echo "'".implode("','", $livenotra )."'"; ?>

          ],
        }, {
          label: 'Backlog Airbnb',
          fill: false,
          backgroundColor: window.chartColors.airbnb,
          borderColor: window.chartColors.airbnb,
          data: [
            <?php echo "'".implode("','", $backlogairbnb )."'"; ?>

          ],
        }, {
          label: 'Backlog Booking.com',
          fill: false,
          backgroundColor: window.chartColors.bookingcom2,
          borderColor: window.chartColors.bookingcom1,
          data: [
            <?php echo "'".implode("','", $backlogbookingcom )."'"; ?>

          ],
        }, {
          label: 'Backlog Expedia',
          fill: false,
          backgroundColor: window.chartColors.ex2,
          borderColor: window.chartColors.ex1,
          data: [
            <?php echo "'".implode("','", $backlogexpedia )."'"; ?>

          ],
        }, {
          label: 'Backlog HomeAway',
          fill: false,
          backgroundColor: window.chartColors.ha2,
          borderColor: window.chartColors.ha1,
          data: [
            <?php echo "'".implode("','", $backloghomeaway )."'"; ?>

          ],
        }, {
          label: 'Backlog TripAdvisor',
          fill: false,
          backgroundColor: window.chartColors.ta2,
          borderColor: window.chartColors.ta1,
          data: [
            <?php echo "'".implode("','", $backlogtripadvisor )."'"; ?>

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