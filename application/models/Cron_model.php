<?php 

class Cron_model extends CI_Model {

        // public $title;
        // public $content;
        // public $date;
    // NID, Channel Category, state name,channel for validation, severity, code(validation result), description(validation result)
	public $db2;
	public function __construct()
	{
        parent::__construct();
        $this->db2 = $this->load->database('local', TRUE);
    }


public function expedia()
        {
                $query = $this->db->query("SELECT 
distinct
n.nid, 
'expedia' as category,
psm.state_name,
vc.channel,
       vc.production_severity, 
vc.code,
vc.description
from 
node n 
left join manager_opt_channel opt on opt.mid=n.uid 
left join property_state_machine psm on psm.nid=n.nid 
left join rep_property rep on rep.nid=n.nid 
left join channel_properties cp on cp.nid=n.nid and cp.channel='expedia'
    left join radb.validation_results vr on vr.nid=n.nid and vr.is_deleted = 0
left join radb.validation_channels vc on vc.code=vr.code and vc.channel in ('redawning','expedia')
where 
opt.channel='expedia' 
and opt.opt=1 
and psm.state_name in ('Live') 
and n.nid not in 
( 
select nid 
from rep_property rep 
where rep.parent!=0 
) 
and n.nid not in 
( 
select nid 
from channel_properties cp 
where channel='expedia' 
)
and n.nid not in
(
select nid
from validation_results vr
left join validation_channels vc on vc.code=vr.code
where vr.is_deleted=0
and vc.channel in ('redawning','expedia')
and vc.production_severity='fatal'
and vc.channel IS NOT NULL
)");
                return $query->result_array();
        }


        public function local($a)
        {
                $query = $this->db2->query("$a");
                return $query->result_array();
        }

        
}