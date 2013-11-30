<?php
    class DAOArquivosMultimidias extends CI_Model
    {
        private $lastId;
        
        function __construct()
        {
            parent::__construct();
            $this->load->database();
            $this->load->model('producao/MArquivosMultimidias');
        }
        
        public function getLastId() {
            return $this->lastId;
        }
        
        public function insert($object)
        {
            $this->MArquivosMultimidias = $object;
            //$this->db->trans_start();
            $this->db->insert('arquivosmultimidias', $this->MArquivosMultimidias);
            $numbersErrors = $this->db->_error_number();
            //echo $this->db->affected_rows();
            //echo $this->db->_error_number();
            //echo $this->db->_error_message();
            //$this->db->trans_complete();
            if($numbersErrors == 0)
            {
                $this->db->select_max('id', 'thebiggestid');
                $this->lastId = $this->db->get('arquivosmultimidias')->result_array()[0]['thebiggestid'];
                //echo '<br/>' . $this->lastId;
                return true;
            }
            else
            {
                return false;
            }
        }
    }
?>