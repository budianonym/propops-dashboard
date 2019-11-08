<?php 

class Validation_model extends CI_Model {

        // public $title;
        // public $content;
        // public $date;

        public function optincolor($nids)
        {
                $query = $this->db->query("SELECT a.nid,a.homeaway,a.airbnb,a.bookingcom,a.expedia,a.tripadvisor
from(
select n.nid,
substring(group_concat(if(opt.channel='homeaway', opt.opt, null)),1,1)as 'homeaway',
substring(group_concat(if(opt.channel='airbnb', opt.opt, null)),1,1)as 'airbnb',
substring(group_concat(if(opt.channel='bookingcom', opt.opt, null)),1,1)as 'bookingcom',
substring(group_concat(if(opt.channel='expedia', opt.opt, null)),1,1)as 'expedia',
substring(group_concat(if(opt.channel='flipkey', opt.opt, null)),1,1)as 'tripadvisor'
from node n
left join manager_opt_channel opt on opt.mid=n.uid
$nids
group by n.nid
order by n.nid) as a;");
                return $query->result_array();
        }

                public function validation($nid, $nidvalidation)
        {
                $query = $this->db->query("SELECT 
  * 
from 
  (
    select 
      vr.nid, 
      n.uid, 
      psm.state_name, 
      vc.channel, 
      vc.production_severity, 
      vr.is_deleted, 
      vc.description, 
      vc.code,
      b.airbnb_opt, 
      b.bookingcom_opt, 
      b.homeaway_opt, 
      b.expedia_opt, 
      b.tripadvisor_opt 
    from 
      validation_results vr 
      left join validation_channels vc on vc.code = vr.code 
      left join node n on n.nid = vr.nid 
      left join property_state_machine psm on n.nid = psm.nid 
      left join -- TABLE CHANNELS OPT IN 2 (CONVERT ROW INTO COLUMN)--
      (
        select 
          a.mid 'uid', 
          group_concat(
            if(
              (a.channel = 'airbnb' && opt = 1), 
              1, 
              null
            )
          ) as 'airbnb_opt', 
          group_concat(
            if(
              (a.channel = 'homeaway' && opt = 1), 
              1, 
              null
            )
          ) as 'homeaway_opt', 
          group_concat(
            if(
              (a.channel = 'bookingcom' && opt = 1), 
              1, 
              null
            )
          ) as 'bookingcom_opt', 
          group_concat(
            if(
              (a.channel = 'expedia' && opt = 1), 
              1, 
              null
            )
          ) as 'expedia_opt', 
          group_concat(
            if(
              (a.channel = 'tripadvisor' && opt = 1), 
              1, 
              null
            )
          ) as 'tripadvisor_opt' 
        from 
          -- TABLE CHANNELS OPT IN 1 (SHOWING ONLY 5 PRIMARY CHANNELS)--
          (
            select 
              * 
            from 
              manager_opt_channel 
            where 
              channel in (
                'expedia', 'bookingcom', 'tripadvisor', 
                'airbnb', 'homeaway'
              )
          ) a -- [END]TABLE CHANNELS OPT IN 1 (SHOWING ONLY 5 PRIMARY CHANNELS)--
        group by 
          a.mid
      ) b -- [END]TABLE CHANNELS OPT IN 2 (CONVERT ROW INTO COLUMN)--
      on b.uid = n.uid 
    -- where 
    --   psm.state_name in (
    --     'livenotreviewed', 'FailedValidationNeedsReview', 
    --     'WaitingForValidation', 'BlockedUnderConstruction', 
    --     'Live','delisted'
    --   )
    --    -- REMOVING [PO] MARK IN B.COM AND EXPEDIA THAT HAS OPTIN NULL 
    $nid
      and not (
        -- vc.description like '[PO]%' && 
        b.bookingcom_opt is null && vc.channel = 'bookingcom'
      ) 
            and not (
        -- vc.description like '[PO]%' && 
        b.tripadvisor_opt is null && vc.channel = 'tripadvisor'
      ) 
           and not (
        -- vc.description like '[PO]%' && 
        b.airbnb_opt is null && vc.channel = 'airbnb'
      )
            and not (
        -- vc.description like '[PO]%' && 
        b.homeaway_opt is null && vc.channel = 'homeaway'
      )
      -- and not(
        -- vc.code in (600) && b.expedia_opt != 1
      -- )
      and not (
        -- vc.description like '[PO]%' && 
        b.expedia_opt is null && vc.channel = 'expedia'
      ) -- [END] REMOVING [PO] MARK IN B.COM AND EXPEDIA THAT HAS OPTIN NULL 
      -- SHOWING ONLY FATAL(PO AND AM) AND WARNING  PO ( WARNING AM NOT SHOWED)
      and (
        vc.production_severity = 'fatal' || (
          vc.production_severity = 'warning' && vc.description like '[PO]%'
        ) 
        -- || (vc.code in (600,310) && vc.production_severity != 'warning' && vc.channel != 'redawning')
        
      ) -- [END]SHOWING ONLY FATAL(PO AND AM) AND WARNING  PO ( WARNING AM NOT SHOWED)
      ) c 
WHERE 
  c.is_deleted = 0
  and c.description != '[PO] Region taxonomy is not set'
  $nidvalidation

;");
                return $query->result_array();
        }
}