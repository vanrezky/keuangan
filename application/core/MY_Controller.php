<?php
class MY_Controller extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
    }

    function render($view, $data)
    {
        $this->load->view('inc/backend/head', $data);
        $this->load->view('inc/backend/topbar');
        $this->load->view('inc/backend/side');
        $this->load->view('tampilan/' . $view);
        $this->load->view('inc/backend/footer');
    }
}
