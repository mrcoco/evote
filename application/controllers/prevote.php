<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Prevote extends CI_Controller {
	public function __construct() {
		parent::__construct();
		
		$this->load->model('pemilih_model');
		$this->pemilih = new Pemilih_model();
	}
	
	/******************************************************************************
	 * 	url: base_url()/index.php/prevote/index 
	 *
	 * 	Halaman index. sama dengan halaman main
	 * 
	 ******************************************************************************/
	public function index()
	{
		$this->profile();
	}
	
	/******************************************************************************
	 * 	url: base_url()/index.php/prevote/main 
	 *
	 * 	Halaman utama.  
	 * 
	 ******************************************************************************/
	public function main()
	{
		$this->profile();
	}

	/******************************************************************************
	 * 	url: base_url()/index.php/prevote/login 
	 *
	 * 	Menampilkan halaman login. Jika sudah login maka akan langsung diarahkan
	 *	ke halaman profile
	 * 
	 ******************************************************************************/
	public function login() {
		$this->profile();
	}

	/******************************************************************************
	 * 	url: base_url()/index.php/prevote/validate_login 
	 *
	 * 	Melakukan validasi terhadap data login
	 * 
	 ******************************************************************************/
	public function validate_login() {
		if( $this->is_vote_time() ) {
			// Load library untuk form validation
			$this->load->library('form_validation');		
			// Tetapkan aturan
			$this->form_validation->set_rules('username','Username','trim|required|xss_clean');
			$this->form_validation->set_rules('pass','Password','trim|required|xss_clean');		
			// Mulai validasi
			if($this->form_validation->run() == false) {
				// Tampilkan error
				$error = array( 'error' => 'Invalid data. Please check your input' );
				$this->load->view('vw_login.php', $error);
			} else {	// valid?
				// Load model
				$query = $this->pemilih->get($this->input->post('username'), $this->input->post('pass'));
				if( $query != NULL ) {
					// Masuk, buat session
					$session = array (
						'vote_id' => $this->generate_id(),
						'NIM' => $query->NIM,
						'has_vote' => $query->has_vote
					);
					$this->session->set_userdata($session);
					redirect('prevote/profile');
				} else {
					$error = array('error' => 'Invalid data. Please check your input');
					$this->load->view('vw_login.php', $error);
				}
			}
		} else {
			$error = array('error' => 'It\'s not voting time yet. Check again later');
			$this->load->view('vw_login.php', $error);
		}
	}
	
	/******************************************************************************
	 * 	url: base_url()/index.php/prevote/logout 
	 *
	 * 	Keluar dari aplikasi
	 * 
	 ******************************************************************************/
	public function logout() {
		// Periksa jika terdapat session maka session dihapus
		$this->session->unset_userdata('vote_id');
		$this->session->unset_userdata('NIM');
		$this->session->unset_userdata('has_vote');		
		// Arahkan ke halaman utama
		redirect('prevote/main');		
	}

	/******************************************************************************
	 * 	url: base_url()/index.php/prevote/profile 
	 *
	 * 	Mengolah login system dan autentikasi ke halaman aplikasi
	 *  Serta tampilkan halaman profile jika berhasil login
	 * 
	 ******************************************************************************/
	public function profile() {
		// Periksa jika terdapat session
		$logged = $this->session->userdata('NIM');
		
		// Jika tidak terdapat session, arahkan ke login
		if( !isset($logged) || $logged == 0 )
			$this->load->view('vw_main.php');
		// Jika ada maka arahkan ke halaman profile
		else {
			// Periksa apakah dapat melanjutkan ke halaman selanjutnya
			if( $this->session->userdata('has_vote') == 0 ) {
				$data['available'] = true;
			} else {
				$data['available'] = false;
			}
			$this->load->view('vw_profile.php', $data);
		}
	}

	public function regenerate_id() {
		// Periksa jika terdapat session
		$logged = $this->session->userdata('NIM');
		
		// Jika tidak terdapat session, arahkan ke login
		if( !isset($logged) || $logged == 0 )
			$this->load->view('vw_main.php');
		// Jika ada maka arahkan ke halaman profile
		else {
			// Periksa apakah dapat melanjutkan ke halaman selanjutnya
			if( $this->session->userdata('has_vote') == 0 ) {
				$data['available'] = true;
			} else {
				$data['available'] = false;
			}
			echo $this->session->userdata('vote_id');
			$session = array (
				'vote_id' => $this->generate_id(),
				'NIM' => $this->session->userdata('NIM'),
				'has_vote' => $this->session->userdata('has_vote')
			);
			$this->session->unset_userdata('vote_id');
			$this->session->unset_userdata('NIM');
			$this->session->unset_userdata('has_vote');
			$this->session->set_userdata($session);
			echo " ".$this->session->userdata('vote_id');
			$this->load->view('vw_profile.php', $data);
		}
	}
	
	private function generate_id() {
		// buat id unik
		return substr(str_shuffle(str_repeat("0123456789abcdefghijklmnopqrstuvwxyz", 5)), 0, 5);
	}
	
	private function is_vote_time() {
		date_default_timezone_set("Asia/Jakarta");
		$start_time = strtotime( "02/11/2013 00:00" );
		$end_time = strtotime( "02/14/2013 00:00" );
		$now = time();
		return $now<=$start_time && $now<=$end_time;
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
