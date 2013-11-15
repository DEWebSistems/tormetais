<?php
    class DAOProdutos extends CI_Model
    {
        function __construct()
        {
            parent::__construct();
            $this->load->database();
            $this->load->model('producao/MProdutos');
        }
        
        public function getProdutos()
        {
            $results = $this->db->get_where('produtos', array());
            $returns = array();
            if($results->num_rows() > 0)
            {
                $results = $results->result_array();                
                foreach($results as $key => $value)
                {
                    $returns[$key] = $value;
                }
                return $returns;
            }
        }
        
        public function getProdutosByCategoriaProdutoId($categoriaProdutoId)
        {
            $results = $this->db->get_where('produtos', array('categoriaprodutoid' => $categoriaProdutoId));            
            if($results->num_rows() > 0)
            {
                return $results->result_array();            
            }
        }
        
        public function getProdutoById($id)
        {
            $results = $this->db->get_where('produtos', array('id' => $id), 1);            
            if($results->num_rows() > 0)
            {
                return $results->result_array()[0];            
            }
        }                

        public function inserir($mProduto)
        {
            $this->MProduto = $mProduto;
            $this->db->trans_start();
            $this->db->insert('produtos', $this->MProduto);
            $this->db->trans_complete();
        }
        
        public function alterar($mProduto)
        {
            $this->MProduto = $mProduto;
            $this->db->trans_start();
            $this->db->update('produtos', $this->MProduto, 'id = ' . $this->MProduto->getId());
            $this->db->trans_complete();
        }        
        
        public function excluir($idProduto)
        {            
            $this->db->trans_start();
            $this->db->delete('produtos', array('id' => $idProduto));
            $this->db->trans_complete();
        }
    }
?>