<?php
    class Login extends CI_Controller
    {
        function __construct()
        {
            parent::__construct();
            $this->load->helper(array('url'));
            $this->load->model('seguranca/MUsuarios');
            $this->load->model('daos/DAOUsuarios');
        }
        
        public function index()
        {
            $datasBody = array();
            $messages['errors'] = '';
            $user = '';
            $password = '';
            $postsDatas = $this->input->post();
            if(isset($postsDatas['bsAcessar']))
            {
                $user = $postsDatas['itUsuario'];
                $password = '';
                $results = $this->validateLogin($postsDatas);
                if($results['isErrors'] == true)
                {
                    $messages['errors'] = $results['messagesErrors'];
                }
            }
            $datasBody['fields']['user'] = $user;
            $datasBody['fields']['password'] = $password;
            $datasBody['messages']['errors'] = $messages['errors'];
            $this->load->view('privado/seguranca/login', $datasBody);
        }
        
        private function validateLogin($postsDatas)
        {
            $usuario = $postsDatas['itUsuario'];
            $senha = $postsDatas['ipSenha'];
            $this->MUsuarios->setLogin($usuario);
            $this->MUsuarios->setSenha($senha);
            $results = $this->MUsuarios->validateLogin();
            if($results['isErrors'] == false)
            {
                redirect(site_url('privado/inicio'));
                exit();
            }
            else
            {
                return $results;
            }
        }
    }
?>