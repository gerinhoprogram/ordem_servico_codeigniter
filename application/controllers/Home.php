<?php
defined('BASEPATH') OR exit('Acesso não permitido');

class Home extends CI_controller{
	public function __construct(){
		parent::__construct();

			if(!$this->ion_auth->logged_in()){
				$this->session->set_flashdata('info', 'Sua sessão expirou!');
				redirect ('login');
			}

			$this->load->model('home_model');
	}
	
	public function index(){

		$data = array(
			'titulo' => 'Home',
			'soma_vendas' => $this->home_model->get_sum_vendas(),
			'soma_ordem_servico' => $this->home_model->get_sum_ordem_servicos(),
			'soma_total_pagar' => $this->home_model->get_sum_pagar(),
			'soma_total_receber' => $this->home_model->get_sum_receber(),
			'produtos_mais_vendidos' => $this->home_model->get_produtos_mais_vendidos(),
			'servicos_mais_vendidos' => $this->home_model->get_servicos_mais_vendidos(),

			'contas_receber_vencidas' => $this->home_model->get_contas_receber_vencidas(),
		);

		$contador_notificacao = 0;

		if($this->home_model->get_contas_receber_vencidas()){

			$data ['contas_receber_vencidas'] = true;
			$contador_notificacao ++;

		}else{
			$data ['contas_receber_vencidas'] = false;
		}

		if($this->home_model->get_contas_pagar_vencidas()){
			
			$data ['contas_pagar_vencidas'] = true;
			$contador_notificacao ++;

		}else{
			$data ['contas_pagar_vencidas'] = false;
		}

		if($this->home_model->get_contas_pagar_vencem_hoje()){
			
			$data ['contas_pagar_vence'] = true;
			$contador_notificacao ++;

		}else{
			$data ['contas_pagar_vence'] = false;
		}

		if($this->home_model->get_contas_receber_vencem_hoje()){
			
			$data ['contas_receber_vence'] = true;
			$contador_notificacao ++;

		}else{
			$data ['contas_receber_vence'] = false;
		}

		if($this->home_model->get_users_desativados()){
			
			$data ['usuarios_desativados'] = true;
			$contador_notificacao ++;

		}else{
			$data ['usuarios_desativados'] = false;
		}

		$data ['contador_notificacao'] = $contador_notificacao;

		$this->load->view('layout/header', $data);
		$this->load->view('home/index');
		$this->load->view('layout/footer');
	}
}