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
        
        public function getLastId()
        {
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
                return true;
            }
            else
            {
                return false;
            }
        }
        
        public function getById($arquivoMultimidiaId)
        {
            $results = $this->db->get_where('arquivosmultimidias', array('id' => $arquivoMultimidiaId));
            return $results;
        }
        
        public function delete($arquivoMultimidiaId)
        {
            $returns = $this->getById($arquivoMultimidiaId);
            if($returns->num_rows() > 0)
            {
                $this->db->where('id', $arquivoMultimidiaId);
                $this->db->delete('arquivosmultimidias');
                if(($this->db->affected_rows() > 0) and ($returns->result_array()[0]['tipoarquivo'] == 0))
                {
                    unlink('C:/xampp/htdocs' . $returns->result_array()[0]['localizacao']);
                }
            }
        }
    }
?>