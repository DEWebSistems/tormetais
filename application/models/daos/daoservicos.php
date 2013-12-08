<?php
    class DAOServicos extends CI_Model
    {
        
        private $limitPage;
        private $numberRecords;
        private $numbersErrors;
        private $rowsAffecteds;
        private $messagesErros;
        
        function __construct()
        {
            parent::__construct();
            $this->load->database();
            $this->load->model('producao/MServicos');
            $this->load->model('producao/MArquivosMultimidias');
            $this->load->model('daos/DAOArquivosMultimidias');
            $this->load->model('producao/MServicosAM');
            $this->setLimitPage(20);
        }

        public function getLimitPage() {
            return $this->limitPage;
        }

        public function setLimitPage($limitPage) {
            $this->limitPage = $limitPage;
        }
        
        public function getNumberRecords() {
            $this->numberRecords = $this->db->count_all('servicos');
            return $this->numberRecords;
        }

        public function setNumberRecords($numberRecords) {
            $this->numberRecords = $numberRecords;
        }
        
        public function getNumbersErrors() {
            return $this->numbersErrors;
        }
        
        public function getRowsAffecteds() {
            return $this->rowsAffecteds;
        }

        public function getMessagesErros() {
            return $this->messagesErros;
        }
        
        public function listPagination($numberPage = 1)
        {
            $offSet = ($numberPage - 1) * $this->getLimitPage();
            //$offSet = $numberPage;
            $results = $this->db->get('servicos', $this->getLimitPage(), $offSet);
            return $results;
        }
        
        public function getServicos()
        {
            $results = $this->db->get('servicos');
            return $results;
        }
        
        public function getServicosByCategoriaServicoId($categoriaServicoId)
        {
            $results = $this->db->get_where('servicos', array('categoriaservicoid' => $categoriaServicoId));            
            if($results->num_rows() > 0)
            {
                return $results->result_array();            
            }
        }
        
        public function getServicoById($id)
        {
            $results = $this->db->get_where('servicos', array('id' => $id), 1);            
            if($results->num_rows() > 0)
            {
                return $results->result_array()[0];            
            }
        }                

        public function insert($object)
        {
            $this->MServicos = $object;
            $this->db->trans_start();
            $numeroRegistros = $this->getNumberRecords();
            if($numeroRegistros == 0){
                $this->MServicos->setPrincipal(true);
            }
            else if(($this->MServicos->getPrincipal()) && ($numeroRegistros != 0))
            {
                $this->unsetServicoPrincipal();
            }
            $this->db->insert('servicos', $this->MServicos);            
            $numbersErrors = $this->db->_error_number();            
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
            $this->MServicos = $object;
            $this->db->trans_start();
            if($this->MServicos->getPrincipal())
            {
                $this->unsetServicoPrincipal();
            }
            $this->db->update('servicos', $this->MServicos, 'id = ' . $this->MServicos->getId());
            $numbersErrors = $this->db->_error_number();
            
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
        
        public function excluir($id)
        {
            $this->db->trans_start();
            $this->db->delete('servicos', array('id' => $id));
            $this->numbersErrors = $this->db->_error_number();
            $this->rowsAffecteds = $this->db->affected_rows();
            $this->messagesErros = $this->db->_error_message();
            $this->db->trans_complete();
            if($this->rowsAffecteds == 1)
            {
                return true;
            }
            else
            {
                return false;
            }
        }
        
        public function insertAM($servicoId, $objectAM, $arquivoPrincipal)
        {
            //echo $servicoId;
            $this->db->trans_start();
            if(!$this->DAOArquivosMultimidias->insert($objectAM))
            {
                return false;
            }
            else
            {
                if($arquivoPrincipal == true)
                {
                    if(!$this->unsetArquivosPrincipals($servicoId))
                    {
                        return false;
                    }
                }
                $this->MServicosAM->setServicoId($servicoId);
                $this->MServicosAM->setArquivoMultimidiaId($this->DAOArquivosMultimidias->getLastId());
                $this->MServicosAM->setArquivoPrincipal($arquivoPrincipal);
                $this->db->insert('servicosarquivosmultimidias', $this->MServicosAM);
            }
            $this->numbersErrors = $this->db->_error_number();
            $this->rowsAffecteds = $this->db->affected_rows();
            $this->messagesErros = $this->db->_error_message();
            $this->db->trans_complete();
            if($this->numbersErrors == 0)
            {
                return true;
            }
            else
            {
                return false;
            }
        }
        
        public function getImagemPrincipal($servicoId)
        {
            
            $imagens = $this->getImagens($servicoId)->result_array();
            
            foreach ($imagens as $imagem) {
                
                if($imagem['arquivoprincipal'] == true)
                {   
                    return $imagem;
                }                
            }            
        }
        
        public function getImagens($servicoId)
        {
            $this->db->select('*');
            $this->db->from('servicosarquivosmultimidias pam');
            $this->db->join('arquivosmultimidias am', 'am.id = pam.arquivomultimidiaid');
            $this->db->where(array('pam.servicoid' => $servicoId, 'am.tipoarquivo' => 0));
            $returns = $this->db->get();
            //echo '<pre>';
            //print_r($returns->result_array());
            //echo '</pre>';
            return $returns;
        }
        
        public function getVideos($servicoId)
        {
            $this->db->select('*');
            $this->db->from('servicosarquivosmultimidias pam');
            $this->db->join('arquivosmultimidias am', 'am.id = pam.arquivomultimidiaid');
            $this->db->where(array('pam.servicoid' => $servicoId, 'am.tipoarquivo' => 1));
            $returns = $this->db->get();
            //echo '<pre>';
            //print_r($returns->result_array());
            //echo '</pre>';
            return $returns;
        }
        
        private function unsetArquivosPrincipals($servicoId)
        {
            $this->db->where('servicoid', $servicoId);
            $this->db->update('servicosarquivosmultimidias', array('arquivoprincipal' => false));
            if($this->db->_error_number() == 0)
            {
                return true;
            }
            else
            {
                $this->numbersErrors = $this->db->_error_number();
                $this->rowsAffecteds = $this->db->affected_rows();
                $this->messagesErros = $this->db->_error_message();
                return false;
            }
        }
        
        public function setArquivoPrincipal($servicoId, $arquivoMultimidiaId)
        {
            $this->db->trans_start();
            if(!$this->unsetArquivosPrincipals($servicoId))
            {
                $this->db->trans_complete();
                return false;
            }
            $this->db->where('servicoid', $servicoId);
            $this->db->where('arquivomultimidiaid', $arquivoMultimidiaId);
            $this->db->update('servicosarquivosmultimidias', array('arquivoprincipal' => true));
            if($this->db->affected_rows() > 0)
            {
                $this->db->trans_complete();
                return true;
            }
            else
            {
                $this->numbersErrors = $this->db->_error_number();
                $this->rowsAffecteds = $this->db->affected_rows();
                $this->messagesErros = $this->db->_error_message();
                $this->db->trans_complete();
                return false;
            }
        }
        
        public function deleteArquivoMultimidia($servicoId, $arquivoMultimidiaId)
        {
            //falta excluir o arquivo e registro se possível
            $this->db->trans_start();
            $dadosImage = $this->db->get_where('servicosarquivosmultimidias', array('servicoid' => $servicoId, 'arquivomultimidiaid' => $arquivoMultimidiaId, 'arquivoprincipal' => true));
            $this->db->where('servicoid', $servicoId);
            $this->db->where('arquivomultimidiaid', $arquivoMultimidiaId);
            $this->db->delete('servicosarquivosmultimidias');
            if($this->db->affected_rows() > 0)
            {
                if($dadosImage->num_rows() > 0)
                {
                    $dadosImage = $this->getImagens($servicoId);
                    if($dadosImage->num_rows() > 0)
                    {
                        if(!$this->setArquivoPrincipal($servicoId, $dadosImage->result_array()[0]['arquivomultimidiaid']))
                        {
                            $this->db->trans_complete();
                            return false;
                        }
                    }
                }
                $this->DAOArquivosMultimidias->delete($arquivoMultimidiaId);
                $this->db->trans_commit();
                $this->db->trans_complete();
                return true;
            }
            else
            {
                $this->numbersErrors = $this->db->_error_number();
                $this->rowsAffecteds = $this->db->affected_rows();
                $this->messagesErros = $this->db->_error_message();
                $this->db->trans_complete();
                return false;
            }
        }
        
        private function unsetServicoPrincipal()
        {            
            $this->db->update('servicos', array('principal' => false));
            if($this->db->_error_number() == 0)
            {
                return true;
            }
            else
            {
                $this->numbersErrors = $this->db->_error_number();
                $this->rowsAffecteds = $this->db->affected_rows();
                $this->messagesErros = $this->db->_error_message();
                return false;
            }
        }     
        
        public function getServicoPrincipal()
        {                                
            $this->db->where('principal', true);
            $results = $this->db->get('servicos');
            return $results;
        }
    }
?>