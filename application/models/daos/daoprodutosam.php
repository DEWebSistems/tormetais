<?php
    class DAOProdutosAM extends CI_Model
    {
        function __construct()
        {
            parent::__construct();
            $this->load->database();
            $this->load->model('producao/MProdutosAM');
        }
    }
?>