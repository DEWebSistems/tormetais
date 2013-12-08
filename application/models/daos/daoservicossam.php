<?php
    class DAOServicosAM extends CI_Model
    {
        function __construct()
        {
            parent::__construct();
            $this->load->database();
            $this->load->model('producao/MServicosAM');
        }
    }
?>