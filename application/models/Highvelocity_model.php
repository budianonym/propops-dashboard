<?php 

class Highvelocity_model extends CI_Model {

        // public $title;
        // public $content;
        // public $date;

        public function get_all($pmss, $date1, $date2)
        {
                $query = $this->db->query("SELECT nid, duration_g, Integration, Integration_Default,Created, Published,Duration,
sec_to_time(AVG(time_to_sec(TIMEDIFF( convert_tz(Published,'PST8PDT','GMT'), Created)))) 'ravg',
sec_to_time(AVG(time_to_sec(TIMEDIFF( airbnb_created, convert_tz(Published,'PST8PDT','GMT'))))) 'aavg',
sec_to_time(AVG(time_to_sec(TIMEDIFF( bookingcom_created, convert_tz(Published,'PST8PDT','GMT'))))) 'bavg',
sec_to_time(AVG(time_to_sec(TIMEDIFF( homeaway_created, convert_tz(Published,'PST8PDT','GMT'))))) 'havg',
sec_to_time(AVG(time_to_sec(TIMEDIFF( expedia_created, convert_tz(Published,'PST8PDT','GMT'))))) 'eavg',
sec_to_time(AVG(time_to_sec(TIMEDIFF( tripadvisor_created, convert_tz(Published,'PST8PDT','GMT'))))) 'tavg'
  from(SELECT a.nid 'nid', DATE_FORMAT(timestamp1,'%Y-%m-%d') 'duration_g',


-- sec_to_time(AVG(time_to_sec(TIMEDIFF( b.Published, timestamp1)))),
if(cff.field_calendar_feed_format_value like 'haapi_%', 'homeaway API',cff.field_calendar_feed_format_value) 'Integration',
  cff.field_calendar_feed_format_value 'Integration_Default',
  timestamp1 'Created', 
  b.Published 'Published', 
  TIMEDIFF( b.Published, timestamp1) 'Duration', 
  group_concat(
    if(
      cp.channel = 'airbnb', cp.created_ts, 
      null
    )
  ) as 'airbnb_created', 
  group_concat(
    if(
      cp.channel = 'bookingcom', cp.created_ts, 
      null
    )
  ) as 'bookingcom_created', 
  group_concat(
    if(
      cp.channel = 'homeaway', cp.created_ts, 
      null
    )
  ) as 'homeaway_created', 
  group_concat(
    if(
      cp.channel = 'expedia', cp.created_ts, 
      null
    )
  ) as 'expedia_created', 
  group_concat(
    if(
      cp.channel = 'tripadvisor', cp.created_ts, 
      null
    )
  ) as 'tripadvisor_created' 
FROM 
  (
    SELECT 
      nid, 
      uid, 
      FROM_UNIXTIME(created) 'timestamp1' 
    FROM 
      node
  ) a 
  left join (
    select 
      min(psmnid), 
      psmnid, 
      nid, 
      destination_state, 
      created_at 'Published' 
    from 
      property_state_machine_notes 
    where 
      destination_state = 'live'
      group by nid
  ) b on b.nid = a.nid 
  left join manager_cc_fees mc on mc.mid = a.uid 
  left join channel_properties cp on cp.nid = a.nid 
  left join field_data_field_calendar_feed_format cff on cff.entity_id = a.nid
where timestamp1 between '".$date1." 00:00:00' and '".$date2." 23:59:59'
$pmss
and b.Published !='NULL'
  group by a.nid
  ) h
  group by h.duration_g
  
;");
                return $query->result_array();
        }
       
}