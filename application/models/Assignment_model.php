<?php 

class Assignment_model extends CI_Model {

        // public $title;
        // public $content;
        // public $date;

        public function get_allnumber()
        {
                $query = $this->db->query("SELECT kk.state_notes, count(kk.nid) 'Total' From (
SELECT 
c.nid,
c.title as Title,
c.name as 'username', 
c.mail 'email',
c.value as 'Company Name',
c.uid,  
c.state_name, c.state_notes

from (select vr.is_deleted, vr.code, vr.nid, n.uid,n.title,pv.value, u.name, ss.state_notes, u.mail, psm.state_name, vc.channel, vc.production_severity, vc.description, b.airbnb_opt, b.bookingcom_opt, b.homeaway_opt, b.expedia_opt, b.tripadvisor_opt from validation_results vr
left join validation_channels vc on vc.code=vr.code
left join node n on n.nid = vr.nid
left join users u on u.uid=n.uid
left join profile_value pv on n.uid = pv.uid AND pv.fid = 21
left join field_data_field_calendar_feed_format cal on cal.entity_id=n.nid
left join property_state_machine psm on n.nid=psm.nid
left join (
select nid, state_notes from (select  psmnid, nid, state_notes from property_state_machine_notes
where
state_notes like 'assigned to%'
order by psmnid
desc) y
group by y.nid
) ss on ss.nid=n.nid
left join 
-- TABLE CHANNELS OPT IN 2 (CONVERT ROW INTO COLUMN)--
(
select a.mid 'uid', 
group_concat( 
if( 
(a.channel = 'airbnb' && opt = 1), 1, 
null 
) 
) as 'airbnb_opt', 
group_concat( 
if( 
(a.channel = 'homeaway' && opt = 1), 1, 
null 
) 
) as 'homeaway_opt',
group_concat( 
if( 
(a.channel = 'bookingcom' && opt = 1), 1, 
null 
) 
) as 'bookingcom_opt',
group_concat( 
if( 
(a.channel = 'expedia' && opt = 1), 1, 
null 
) 
) as 'expedia_opt',
group_concat( 
if( 
(a.channel = 'tripadvisor' && opt = 1), 1, 
null 
) 
) as 'tripadvisor_opt'
from
-- TABLE CHANNELS OPT IN 1 (SHOWING ONLY 5 PRIMARY CHANNELS)--
(select * from manager_opt_channel
where channel in ('expedia','bookingcom','tripadvisor','airbnb','homeaway')
) a
-- [END]TABLE CHANNELS OPT IN 1 (SHOWING ONLY 5 PRIMARY CHANNELS)--
group by a.mid) b
-- [END]TABLE CHANNELS OPT IN 2 (CONVERT ROW INTO COLUMN)--
on b.uid = n.uid
where psm.state_name in ('livenotreviewed','FailedValidationNeedsReview', 'BlockedUnderConstruction')
and n.type = 'rental_property'
and vc.description like '[PO]%'
-- REMOVING [PO] MARK IN B.COM AND EXPEDIA THAT HAS OPTIN NULL 
and not (b.bookingcom_opt is null && vc.channel='bookingcom')
and not (b.expedia_opt is null && vc.channel='expedia')
and (vc.production_severity = 'fatal' || (vc.production_severity = 'warning' && vc.channel = 'redawning' && vc.code in (303, 312, 824)) )
and vr.is_deleted = 0
and u.mail not in ('hello@leavetown.com','Vicky.Lova@redawning.com',
'sarah.herz@redawning.com','brett@redawning.com')
group by n.nid
) c
where c.state_notes like 'assigned to%'
order by c.state_notes, c.nid

                        ) kk
                        where kk.state_notes is not null
                        group by kk.state_notes
                        ;");
                return $query->result_array();
        }
        public function propertiesPerUser($reviewer){
                $query = $this->db->query("SELECT 
c.nid,
c.title as Title,
-- c.name as 'username', 
c.mail 'email',
c.Integration,
c.value as 'Company Name',
c.uid,  
c.state_name, c.state_notes

from (select vr.is_deleted, vr.code, vr.nid, n.uid,n.title,pv.value, cal.field_calendar_feed_format_value 'Integration', u.name, ss.state_notes, u.mail, psm.state_name, vc.channel, vc.production_severity, vc.description, b.airbnb_opt, b.bookingcom_opt, b.homeaway_opt, b.expedia_opt, b.tripadvisor_opt from validation_results vr
left join validation_channels vc on vc.code=vr.code
left join node n on n.nid = vr.nid
left join users u on u.uid=n.uid
left join profile_value pv on n.uid = pv.uid AND pv.fid = 21
left join field_data_field_calendar_feed_format cal on cal.entity_id=n.nid
left join property_state_machine psm on n.nid=psm.nid
left join (
select nid, state_notes from (select  psmnid, nid, state_notes from property_state_machine_notes
where
state_notes like 'assigned to%'
order by psmnid
desc) y
group by y.nid
) ss on ss.nid=n.nid
left join 
-- TABLE CHANNELS OPT IN 2 (CONVERT ROW INTO COLUMN)--
(
select a.mid 'uid', 
group_concat( 
if( 
(a.channel = 'airbnb' && opt = 1), 1, 
null 
) 
) as 'airbnb_opt', 
group_concat( 
if( 
(a.channel = 'homeaway' && opt = 1), 1, 
null 
) 
) as 'homeaway_opt',
group_concat( 
if( 
(a.channel = 'bookingcom' && opt = 1), 1, 
null 
) 
) as 'bookingcom_opt',
group_concat( 
if( 
(a.channel = 'expedia' && opt = 1), 1, 
null 
) 
) as 'expedia_opt',
group_concat( 
if( 
(a.channel = 'tripadvisor' && opt = 1), 1, 
null 
) 
) as 'tripadvisor_opt'
from
-- TABLE CHANNELS OPT IN 1 (SHOWING ONLY 5 PRIMARY CHANNELS)--
(select * from manager_opt_channel
where channel in ('expedia','bookingcom','tripadvisor','airbnb','homeaway')
) a
-- [END]TABLE CHANNELS OPT IN 1 (SHOWING ONLY 5 PRIMARY CHANNELS)--
group by a.mid) b
-- [END]TABLE CHANNELS OPT IN 2 (CONVERT ROW INTO COLUMN)--
on b.uid = n.uid
where psm.state_name in ('livenotreviewed','FailedValidationNeedsReview', 'BlockedUnderConstruction')
and n.type = 'rental_property'
and vc.description like '[PO]%'
-- REMOVING [PO] MARK IN B.COM AND EXPEDIA THAT HAS OPTIN NULL 
and not (b.bookingcom_opt is null && vc.channel='bookingcom')
and not (b.expedia_opt is null && vc.channel='expedia')
and (vc.production_severity = 'fatal' || (vc.production_severity = 'warning' && vc.channel = 'redawning' && vc.code in (303, 312, 824)) )
and vr.is_deleted = 0
and u.mail not in ('hello@leavetown.com','Vicky.Lova@redawning.com',
'sarah.herz@redawning.com','brett@redawning.com')
group by n.nid
) c
where c.state_notes like 'assigned to ".$reviewer."%'
order by c.state_notes, c.nid
                        ;");
                return $query->result_array();

        }

        public function propertiesNone(){
                $query = $this->db->query("SELECT
        psm.nid as 'NID',
z.field_manager_property_code_value as 'PID',
        n.title as 'Title',
n.uid as 'UID', 
u.name as 'E-mail', 
pv.value as 'Company Name',
mc.account_status  as 'Account Status', 
psm.state_name  as 'Property State', 
notes.state_notes  as 'Notes',
date_format(convert_tz(notes.created_at,'US/Pacific','Asia/Jakarta'),'%M %d %Y') as 'Timestamp',
cal.field_calendar_feed_format_value as 'Parser',
n.status as 'Status'
from property_state_machine psm
left join property_state_machine_notes notes on psm.nid=notes.nid
left join property_state_machine_notes n2 on (notes.nid=n2.nid and notes.psmnid < n2.psmnid)
left join node n on n.nid=psm.nid
left join users u on u.uid=n.uid
left join profile_value pv on n.uid = pv.uid AND pv.fid = 21
left join field_data_field_calendar_feed_format cal on cal.entity_id=n.nid
left join integration_properties ip on ip.nid=n.nid
left join manager_cc_fees mc on mc.mid=n.uid
left join field_data_field_manager_property_code z on z.entity_id=psm.nid
where psm.state_name = 'sdskvksbvkbsdkvbksdbvksbv'
-- where psm.state_name in ('live','livenotreviewed','failedvalidationneedsreview','AccountStatusNotSet','OnboardingUnderReview','livenotreviewed','failedvalidationneedsreview','waitingforvalidation')
-- and n.type = 'rental_property'
-- and n2.psmnid is null
-- and (notes.state_notes like '%assigned tosdvsdvsvsdvsdvsdvsdvsv%' or notes.state_notes like '%[PENDING]sdvsdvdvsvdvsvsdvsdv%')
-- order by 2, 7
;");
                return $query->result_array();

        }

        public function get_nids($a)
        {
                $query = $this->db->query("SELECT b.nid, b.state_notes from (select max(psmnid) 'psmnid' from property_state_machine_notes
where state_notes like '%[PO]%'
and nid in ($a)
group by nid) a
left join property_state_machine_notes b on b.psmnid = a.psmnid
;");
                return $query->result_array();
        }
}