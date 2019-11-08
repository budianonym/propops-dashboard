<?php

class Upload extends CI_Controller {

        public function __construct()
        {
                parent::__construct();
                $this->load->helper(array('form', 'url'));
        }

        public function index()
        {
                $data['title'] = 'Facility Name Conversion Bulk Update';
                $this->slice->view('template/header', $data);
                $this->slice->view('upload_form', array('error' => ' ' ));
                $this->slice->view('template/footer', $data);
        }

        public function do_upload()
        {
                $config['upload_path']          = './uploads/';
                $config['allowed_types']        = 'gif|jpg|png|csv';
                $config['max_size']             = 1000000000000;
                // $config['max_width']            = 1024;
                // $config['max_height']           = 768;

                $this->load->library('upload', $config);
                // $data['title'] = 'Facility Name Conversion Bulk Update';
                // $this->slice->view('template/header', $data);
                if ( ! $this->upload->do_upload('userfile'))
                {
                        $error = array('error' => $this->upload->display_errors());

                        $this->slice->view('upload_form', $error);
                }
                else
                {
                        $data = array('upload_data' => $this->upload->data());

                        $this->slice->view('upload_success', $data);
                }
                // $this->slice->view('template/footer', $data);
        }
}
?>