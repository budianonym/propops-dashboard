<?php 

class Velocity_model extends CI_Model {

        // public $title;
        // public $content;
        // public $date;

        public function get_nids($theDate1, $theDate2)
        {
                $query = $this->db->query("SELECT nid from (select nid, min(created_at) 'created_at' from property_state_machine_notes
where 
-- nid in (157940)
-- && 
destination_state = 'live'
group by nid ) b
where date_format(b.created_at, '%Y-%m-%d') between '".$theDate1."' and '".$theDate2."'
;");
                return $query->result_array();
        }

        public function get_nidscreated($theDate1, $theDate2)
        {
                $query = $this->db->query("SELECT c.nid from node c
where date_format(from_unixtime(c.created), '%Y-%m-%d') between '$theDate1' and '$theDate2'
and c.nid not in(
select a.nid from node a
left join property_state_machine_notes b on a.nid = b.nid
where type = 'rental_property'
and date_format(from_unixtime(created), '%Y-%m-%d') between '$theDate1' and '$theDate2'
and (b.source_state ='Live' || b.destination_state ='Live')
group by a.nid )

");
                return $query->result_array();
        }

                public function get_data($theNid)
        {
                $query = $this->db->query("SELECT w.nid, w.state, w.start, w.end, w.duration_in_sec 'duration in sec', w.duration_in_minutes 'duration in minutes', w.duration_in_hour 'duration in hour', w.duration_in_day 'duration in day', u.uid FROM (SELECT nid, state, start, end, duration 'duration_in_sec',
ROUND(duration/60) 'duration_in_minutes', ROUND((duration/60)/60) 'duration_in_hour',
ROUND(((duration/60)/60)/24) 'duration_in_day'
from
(

-- 	select nid, 'Live' state, min(created_at) 'start', max(created_at) 'end', 
-- -- datediff(max(created_at), min(created_at)) 
-- TIME_TO_SEC(timediff(max(created_at), min(created_at))) 'duration'

-- from property_state_machine_notes
-- where (nid in (nidnya) &&( source_state = 'live' || destination_state = 'live'))
-- -- and ((source_state != 'live' && destination_state = 'live') or (source_state = 'live' && destination_state = 'live'))
-- group by nid

-- UNION ALL

select nid, 'FailedValidationNeedsReview' state, min(created_at) 'start', max(created_at) 'end', 
TIME_TO_SEC(timediff(max(created_at), min(created_at))) 'duration'
from property_state_machine_notes
where (nid in ($theNid) &&( source_state = 'FailedValidationNeedsReview' || destination_state = 'FailedValidationNeedsReview'))
group by nid

UNION ALL

select nid, 'ProductionHalted' state, min(created_at) 'start', max(created_at) 'end', 
TIME_TO_SEC(timediff(max(created_at), min(created_at))) 'duration'
from property_state_machine_notes
where (nid in ($theNid) &&( source_state = 'ProductionHalted' || destination_state = 'ProductionHalted'))
group by nid

UNION ALL

select nid, 'LiveNotReviewed' state, min(created_at) 'start', max(created_at) 'end', 
TIME_TO_SEC(timediff(max(created_at), min(created_at))) 'duration'
from property_state_machine_notes
where (nid in ($theNid) &&( source_state = 'LiveNotReviewed' || destination_state = 'LiveNotReviewed'))
group by nid

UNION ALL

select nid, 'BlockedCalendar' state, min(created_at) 'start', max(created_at) 'end', 
TIME_TO_SEC(timediff(max(created_at), min(created_at))) 'duration'
from property_state_machine_notes
where (nid in ($theNid) &&( source_state = 'BlockedCalendar' || destination_state = 'BlockedCalendar'))
group by nid

UNION ALL

select nid, 'BlockedPricing' state, min(created_at) 'start', max(created_at) 'end', 
TIME_TO_SEC(timediff(max(created_at), min(created_at))) 'duration'
from property_state_machine_notes
where (nid in ($theNid) &&( source_state = 'BlockedPricing' || destination_state = 'BlockedPricing'))
group by nid

UNION ALL

select nid, 'BlockedRequest' state, min(created_at) 'start', max(created_at) 'end', 
TIME_TO_SEC(timediff(max(created_at), min(created_at))) 'duration'
from property_state_machine_notes
where (nid in ($theNid) &&( source_state = 'BlockedRequest' || destination_state = 'BlockedRequest'))
group by nid

UNION ALL

select nid, 'BlockedOther' state, min(created_at) 'start', max(created_at) 'end', 
TIME_TO_SEC(timediff(max(created_at), min(created_at))) 'duration'
from property_state_machine_notes
where (nid in ($theNid) &&( source_state = 'BlockedOther' || destination_state = 'BlockedOther'))
group by nid

UNION ALL

select nid, 'BlockedIntegration' state, min(created_at) 'start', max(created_at) 'end', 
TIME_TO_SEC(timediff(max(created_at), min(created_at))) 'duration'
from property_state_machine_notes
where (nid in ($theNid) &&( source_state = 'BlockedIntegration' || destination_state = 'BlockedIntegration'))
group by nid

UNION ALL

select nid, 'AutoBlockedByIntegration' state, min(created_at) 'start', max(created_at) 'end', 
TIME_TO_SEC(timediff(max(created_at), min(created_at))) 'duration'
from property_state_machine_notes
where (nid in ($theNid) &&( source_state = 'AutoBlockedByIntegration' || destination_state = 'AutoBlockedByIntegration'))
group by nid

UNION ALL

select nid, 'DelistedPermanently' state, min(created_at) 'start', max(created_at) 'end', 
TIME_TO_SEC(timediff(max(created_at), min(created_at))) 'duration'
from property_state_machine_notes
where (nid in ($theNid) &&( source_state = 'DelistedPermanently' || destination_state = 'DelistedPermanently'))
group by nid

UNION ALL

select nid, 'AccountStatusNotSet' state, min(created_at) 'start', max(created_at) 'end', 
TIME_TO_SEC(timediff(max(created_at), min(created_at))) 'duration'
from property_state_machine_notes
where (nid in ($theNid) &&( source_state = 'AccountStatusNotSet' || destination_state = 'AccountStatusNotSet'))
group by nid

UNION ALL

select nid, 'WaitingForValidation' state, min(created_at) 'start', max(created_at) 'end', 
TIME_TO_SEC(timediff(max(created_at), min(created_at))) 'duration'
from property_state_machine_notes
where (nid in ($theNid) &&( source_state = 'WaitingForValidation' || destination_state = 'WaitingForValidation'))
group by nid


UNION ALL

select nid, 'BlockedUnderconstruction' state, min(created_at) 'start', max(created_at) 'end', 
TIME_TO_SEC(timediff(max(created_at), min(created_at))) 'duration'
from property_state_machine_notes
where (nid in ($theNid) &&( source_state = 'BlockedUnderconstruction' || destination_state = 'BlockedUnderconstruction'))
group by nid
)a
where a.duration != 0
order by a.nid
) w
left join node u on u.nid = w.nid
;");
                return $query->result_array();
        }

        public function get_statenote($nid)
        {
                $query = $this->db->query("SELECT * from property_state_machine_notes
where nid in ($nid)
order by nid
");
                return $query->result_array();
        }
}