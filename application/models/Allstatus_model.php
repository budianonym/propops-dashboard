<?php 

class Allstatus_model extends CI_Model {

        // public $title;
        // public $content;
        // public $date;

        public function get_allstatus()
        {
                $query = $this->db->query("SELECT count(psm.nid) 'num',
-- psm.nid,
psm.state_name 'state'
--  pv.value,
--  u.mail as 'Email',
--  pv.uid  
FROM radb.property_state_machine psm
left join node n on n.nid=psm.nid
left join users u on u.uid=n.uid
left join profile_value pv on n.uid = pv.uid AND pv.fid = 21
left join manager_cc_fees mc on mc.mid=n.uid
where psm.state_name in ('AccountStatusNotSet','OnboardingPaused','CheckAccountStatus','OnboardingUnderReview','LiveNotReviewed','FailedValidationNeedsReview','WaitingForValidation','BlockedUnderConstruction','ProductionHalted','OnboardingUnderReview')
group by psm.state_name;

-- desc
;");
                return $query->result_array();
        }
}