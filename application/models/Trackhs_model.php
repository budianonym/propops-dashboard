<?php 

class Trackhs_model extends CI_Model {

        // public $title;
        // public $content;
        // public $date;

        public function get_allstatus()
        {
                $query = $this->db->query("SELECT id, uid, integration_name, client_code, client_name, a.username, a.password FROM radb.integration_client ic
left join (
SELECT client_id,
group_concat( 
if( attribute_name = 'username', attribute_value, null ) 
) as 'username',
group_concat( 
if( attribute_name = 'password', attribute_value, null ) 
) as 'password'
FROM radb.integration_client_attribute ca
where attribute_name in ('username','password')
group by client_id
) a on a.client_id = ic.id
where ic.integration_name = 'trackhs'
;");
                return $query->result_array();
        }
}