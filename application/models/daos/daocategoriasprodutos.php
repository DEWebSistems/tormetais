<?php
    class DAOCategoriasProdutos extends CI_Model
    {
        private $limitPage;
        private $numberRecords;
        
        function __construct()
        {
            parent::__construct();
            $this->load->database();
            $this->load->model('producao/MCategoriasProdutos');
            $this->setLimitPage(10);
        }
        
        public function getLimitPage() {
            return $this->limitPage;
        }

        public function setLimitPage($limitPage) {
            $this->limitPage = $limitPage;
        }
        
        public function getNumberRecords() {
            $this->numberRecords = $this->db->count_all('categoriasprodutos');
            return $this->numberRecords;
        }

        public function setNumberRecords($numberRecords) {
            $this->numberRecords = $numberRecords;
        }
        
        public function listPagination($numberPage = 1)
        {
            $offSet = ($numberPage - 1) * $this->getLimitPage();
            //$offSet = $numberPage;
            $results = $this->db->get('categoriasprodutos', $this->getLimitPage(), $offSet);
            return $results;
        }
        
        public function getCategoriasProdutos()
        {
            $results = $this->db->get('categoriasprodutos');
            return $results;
        }
        
        public function insert($object)
        {
            $this->MCategoriasProdutos = $object;
            $this->db->trans_start();
            $this->db->insert('categoriasprodutos', $this->MCategoriasProdutos);
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
        
        public function update($object)
        {
            $this->MCategoriasProdutos = $object;
            $this->db->trans_start();
            $this->db->update('categoriasprodutos', $this->MCategoriasProdutos, 'id = ' . $this->MCategoriasProdutos->getId());
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
        
        public function getCategoriaProduto($id)
        {
            $results = $this->db->get_where('categoriasprodutos', array('id' => $id), 1);
            return $results;
        }
        
        public function excluir($id)
        {
            $this->db->trans_start();
            $this->db->delete('categoriasprodutos', array('id' => $id));
            $numberLinesAffecteds = $this->db->affected_rows();
            $this->db->trans_complete();
            if($numberLinesAffecteds == 1)
            {
                return true;
            }
            else
            {
                return false;
            }
        }
        
        public function getCategoriaProdutoById($id)
        {
            $results = $this->db->get_where('categoriasprodutos', array('id' => $id), 1);
            if ($results->num_rows() > 0) {
                return $results->result_array()[0];
            }
        }
        
        public function getCategoriasProdutosNELP($idLinhasProdutos)
        {
            $this->db->distinct();
            $this->db->select('cp.id, cp.nome');
            $this->db->from('categoriasprodutos cp');
            $this->db->join('produtos pr', 'cp.id = pr.categoriaprodutoid');
            $this->db->where(array('pr.linhaprodutoid' => $idLinhasProdutos));
            $returns = $this->db->get();
            return $returns;
        }
    }
?>