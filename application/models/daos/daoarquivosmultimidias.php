<?php
    class daoarquivosmultimidias extends CI_Model
    {
        function __construct()
        {
            parent::__construct();
            $this->load->database();
            $this->load->model('producao/MArquivosMultimidias');
        }
        
        public function inserir($object)
        {
            $this->MArquivosMultimidias = $object;
            $this->db->trans_start();
            $this->db->insert('arquivosmultimidias', $this->MArquivosMultimidias);
            $numbersErrors = $this->db->_error_number();
            //echo $this->db->affected_rows();
            //echo $this->db->_error_number();
            //echo $this->db->_error_message();
            $this->db->trans_complete();
            if($numbersErrors == 0)
            {
                return true;
            }
            else
            {
                return false;
            }
        }
    }
?>