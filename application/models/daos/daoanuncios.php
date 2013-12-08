<?php
    class DAOAnuncios extends CI_Model
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
            $this->load->model('producao/MAnuncios');
            $this->load->model('producao/MArquivosMultimidias');
            $this->load->model('daos/DAOArquivosMultimidias');
            $this->load->model('producao/MAnunciosAM');
            $this->setLimitPage(20);
        }

        public function getLimitPage() {
            return $this->limitPage;
        }

        public function setLimitPage($limitPage) {
            $this->limitPage = $limitPage;
        }
        
        public function getNumberRecords() {
            $this->numberRecords = $this->db->count_all('anuncios');
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
            $results = $this->db->get('anuncios', $this->getLimitPage(), $offSet);
            return $results;
        }
        
        public function getAnuncios()
        {
            $results = $this->db->get('anuncios');
            return $results;
        }                
        
        public function getAnuncioById($id)
        {
            $results = $this->db->get_where('anuncios', array('id' => $id), 1);            
            if($results->num_rows() > 0)
            {
                return $results->result_array()[0];            
            }
        }                

        public function insert($object)
        {
            $this->MAnuncios = $object;
            $this->db->trans_start();
            $this->db->insert('anuncios', $this->MAnuncios);            
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
            $this->MAnuncios = $object;
            $this->db->trans_start();
            $this->db->update('anuncios', $this->MAnuncios, 'id = ' . $this->MAnuncios->getId());
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
        
        public function excluir($id)
        {
            $this->db->trans_start();
            $this->db->delete('anuncios', array('id' => $id));
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
        
        public function insertAM($anuncioId, $objectAM, $arquivoPrincipal)
        {
            //echo $anuncioId;
            $this->db->trans_start();
            if(!$this->DAOArquivosMultimidias->insert($objectAM))
            {
                return false;
            }
            else
            {
                if($arquivoPrincipal == true)
                {
                    if(!$this->unsetArquivosPrincipals($anuncioId))
                    {
                        return false;
                    }
                }
                $this->MAnunciosAM->setAnuncioId($anuncioId);
                $this->MAnunciosAM->setArquivoMultimidiaId($this->DAOArquivosMultimidias->getLastId());
                $this->MAnunciosAM->setArquivoPrincipal($arquivoPrincipal);
                $this->db->insert('anunciosarquivosmultimidias', $this->MAnunciosAM);
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
        
        public function getImagemPrincipal($anuncioId)
        {
            
            $imagens = $this->getImagens($anuncioId)->result_array();
            
            foreach ($imagens as $imagem) {
                
                if($imagem['arquivoprincipal'] == true)
                {   
                    return $imagem;
                }                
            }            
        }
        
        public function getImagens($anuncioId)
        {
            $this->db->select('*');
            $this->db->from('anunciosarquivosmultimidias pam');
            $this->db->join('arquivosmultimidias am', 'am.id = pam.arquivomultimidiaid');
            $this->db->where(array('pam.anuncioid' => $anuncioId, 'am.tipoarquivo' => 0));
            $returns = $this->db->get();
            //echo '<pre>';
            //print_r($returns->result_array());
            //echo '</pre>';
            return $returns;
        }
        
        public function getVideos($anuncioId)
        {
            $this->db->select('*');
            $this->db->from('anunciosarquivosmultimidias pam');
            $this->db->join('arquivosmultimidias am', 'am.id = pam.arquivomultimidiaid');
            $this->db->where(array('pam.anuncioid' => $anuncioId, 'am.tipoarquivo' => 1));
            $returns = $this->db->get();
            //echo '<pre>';
            //print_r($returns->result_array());
            //echo '</pre>';
            return $returns;
        }
        
        private function unsetArquivosPrincipals($anuncioId)
        {
            $this->db->where('anuncioid', $anuncioId);
            $this->db->update('anunciosarquivosmultimidias', array('arquivoprincipal' => false));
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
        
        public function setArquivoPrincipal($anuncioId, $arquivoMultimidiaId)
        {
            $this->db->trans_start();
            if(!$this->unsetArquivosPrincipals($anuncioId))
            {
                $this->db->trans_complete();
                return false;
            }
            $this->db->where('anuncioid', $anuncioId);
            $this->db->where('arquivomultimidiaid', $arquivoMultimidiaId);
            $this->db->update('anunciosarquivosmultimidias', array('arquivoprincipal' => true));
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
        
        public function deleteArquivoMultimidia($anuncioId, $arquivoMultimidiaId)
        {
            //falta excluir o arquivo e registro se possível
            $this->db->trans_start();
            $dadosImage = $this->db->get_where('anunciosarquivosmultimidias', array('anuncioid' => $anuncioId, 'arquivomultimidiaid' => $arquivoMultimidiaId, 'arquivoprincipal' => true));
            $this->db->where('anuncioid', $anuncioId);
            $this->db->where('arquivomultimidiaid', $arquivoMultimidiaId);
            $this->db->delete('anunciosarquivosmultimidias');
            if($this->db->affected_rows() > 0)
            {
                if($dadosImage->num_rows() > 0)
                {
                    $dadosImage = $this->getImagens($anuncioId);
                    if($dadosImage->num_rows() > 0)
                    {
                        if(!$this->setArquivoPrincipal($anuncioId, $dadosImage->result_array()[0]['arquivomultimidiaid']))
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
    }
?>