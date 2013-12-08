<?php
    class DAOAnunciosAM extends CI_Model
    {
        function __construct()
        {
            parent::__construct();
            $this->load->database();
            $this->load->model('producao/MAnunciosAM');
        }
    }
?>