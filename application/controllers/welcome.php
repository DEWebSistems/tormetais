<<<<<<< HEAD
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
            $this->load->database();
            $results = $this->db->query('select * from dadosempresa');
            echo '<pre>';
            //print_r($results);
            //echo '<br/>';
            print_r($results->result());
            echo '</pre>';
            $this->load->view('cabecalho');
            $this->load->view('corpo_variavel');
            $this->load->view('rodape');
	}
}

/* End of file welcome.php */
=======
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
            //$this->load->database();
            //$results = $this->db->query('select * from dadosempresa');
            //echo '<pre>';
            //print_r($results);
            //echo '<br/>';
            //print_r($results->result());
            //echo '</pre>';
            //$this->load->view('welcome_message');
            //echo link_tag('assets/bootstrap/3.0.0/css/bootstrap.css');
            $this->load->view('fragmentos/cabecalho');
            $this->load->view('fragmentos/rodape');
	}
}

/* End of file welcome.php */
>>>>>>> 65c2152e09529a0177759df09027d24cecf64003
/* Location: ./application/controllers/welcome.php */