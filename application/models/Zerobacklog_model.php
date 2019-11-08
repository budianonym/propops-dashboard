<?php 

class Zerobacklog_model extends CI_Model {

        // public $title;
        // public $content;
        // public $date;
	public $db2;
	public function __construct()
	{
        parent::__construct();
        $this->db2 = $this->load->database('local', TRUE);
    }
        public function local()
        {
                $query = $this->db2->query("SELECT * FROM `backlog_statistic`
				where date between '2019-06-11' and CURDATE()");
                return $query->result_array();
        }
}