<?php 

class Zerobacklognid_model extends CI_Model {

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
        public function local($channel, $date)
        {
                $query = $this->db2->query("SELECT no, NID, Channel, DATE_FORMAT(timestamp,'%Y-%m-%d') 'timestamp' FROM `backlognid`
                    where Channel = '$channel'
                    and DATE_FORMAT(timestamp,'%Y-%m-%d') = '$date'
				");
                return $query->result_array();
        }

        public function localcount()
        {
                $query = $this->db2->query("SELECT  timestamp,
group_concat( 
if( 
(a.channel = 'redawning'), countnid, 
null 
) 
) as 'redawning',
group_concat( 
if( 
(a.channel = 'airbnb'), countnid, 
null 
) 
) as 'airbnb',
group_concat( 
if( 
(a.channel = 'expedia'), countnid, 
null 
) 
) as 'expedia',
group_concat( 
if( 
(a.channel = 'homeaway'), countnid, 
null 
) 
) as 'homeaway'



from (SELECT count(NID) 'countnid', Channel 'channel', DATE_FORMAT(timestamp,'%Y-%m-%d') 'timestamp' FROM `backlognid` 
-- where timestamp like '%:55:%'
group by DATE_FORMAT(timestamp,'%Y-%m-%d'), Channel) a
group by timestamp
                ");
                return $query->result_array();
        }


public function validation($category, $date)
        {
                $query = $this->db2->query("SELECT `no`, `nid`, `category`, `state_name`, `channel`, `production_severity`, `code`, `description`, DATE_FORMAT(timestamp,'%Y-%m-%d') 'timestamp' FROM `validation_nid`
                    where DATE_FORMAT(timestamp,'%Y-%m-%d') = '$date'
                    and category = '$category'
                    -- and description like '[PO]%'
                    -- and code in (310, 600, 312, 311)
                    ");
                return $query->result_array();
        }
        
        public function validationall()
        {
                $query = $this->db2->query("SELECT `no`, `nid`, `category`, `state_name`, `channel`, `production_severity`, `code`, `description`, DATE_FORMAT(timestamp,'%Y-%m-%d') 'timestamp' FROM `validation_nid`
                    ");
                return $query->result_array();
        }

        public function codenya()
        {
                $query = $this->db2->query("SELECT * from code;
				");
                return $query->result_array();
        }
        public function dailyAssignment()
        {
                $query = $this->db->query("

                SELECT count(nid), date_format(ADDTIME(created_at,'0 14:00:00'), '%Y-%m-%d') 'date' FROM radb.property_state_machine_notes
                where state_notes like 'assigned to %'
                group by date_format(ADDTIME(created_at,'0 14:00:00'), '%Y-%m-%d')
                ");
                return $query->result_array();
        }
}