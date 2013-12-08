<?php
    class logout extends CI_Controller
    {
        function __construct()
        {
            parent::__construct();
            $this->load->helper(array('url'));
            $this->load->model('seguranca/MUsuarios');
            $this->load->model('daos/DAOUsuarios');
        }
        
        public function index()
        {
            $this->MUsuarios->unsetUserSession();
        }
    }
?>