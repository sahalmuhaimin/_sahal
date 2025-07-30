<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Portofolio extends CI_Controller
{
    public function index()
    {
        $data = array(
            'title' => 'Web Portofolio GUNA JAYA'
        );
        $this->load->view('portofolio/v_head', $data);
        $this->load->view('portofolio/v_nav', $data);
        $this->load->view('portofolio/v_portofolio', $data);
        $this->load->view('portofolio/v_footer', $data);
    }
}
