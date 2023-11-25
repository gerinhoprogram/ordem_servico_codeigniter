<?php
defined('BASEPATH') OR exit('Ação não permitida');

class Formas_pagamentos extends CI_Controller{

    public function __construct(){
        parent:: __construct();

        //se não estiver logado volta para login
        if(!$this->ion_auth->logged_in()){
            redirect ('login');
        }
        $this->load->model('financeiro_model');
    }

    public function index(){

        $data = array(

            'titulo' => 'Contas a formas_pagamentos cadastradas',

            //cria array de estilos para passar para view header
            'styles' => array('vendor/datatables/dataTables.bootstrap4.min.css'),

            'scripts' => array(
                'vendor/datatables/jquery.dataTables.min.js', 
                'vendor/datatables/dataTables.bootstrap4.min.js',
                'vendor/datatables/app.js'),
            
            //carrega dados da tabela clientes
            'formas_pagamentos' => $this->core_model->get_all('formas_pagamentos'),
        );

        // echo"<pre>";
        // print_r($data['formas_pagamentos']);
        // exit();

        $this->load->view('layout/header', $data);
        $this->load->view('formas_pagamentos/index');
        $this->load->view('layout/footer');

    }

    public function adicionar(){

        $this->form_validation->set_rules('forma_pagamento_nome', 'Forma de pagamento', 'required|max_length[100]|is_unique[formas_pagamentos.forma_pagamento_nome]');

            if($this->form_validation->run()){

                $data = elements(
                    array(
                        'forma_pagamento_nome',
                        'forma_pagamento_aceita_parc',
                        'forma_pagamento_ativa',
                    ), $this->input->post()
                );

               $data = html_escape($data);

               $this->core_model->insert('formas_pagamentos', $data);
               redirect('modulo');

            }else{

                $data = array(

                    'titulo' => 'Adicionar Formas de Pagamentos',
        
                );
        
                $this->load->view('layout/header', $data);
                $this->load->view('formas_pagamentos/add');
                $this->load->view('layout/footer');
            }

    }

    public function editar($forma_pagamento_id = null){

        if(!$forma_pagamento_id || !$this->core_model->get_by_id('formas_pagamentos', array('forma_pagamento_id' => $forma_pagamento_id))){
            $this->session->set_flashdata('error', 'Forma de pagamento não encontrada');
            redirect('modulo');
        }else{

            $this->form_validation->set_rules('forma_pagamento_nome', 'Forma de pagamento', 'required|max_length[100]|callback_check_pagamento_nome');

            if($this->form_validation->run()){

                $forma_pagamento_ativa = $this->input->post('forma_pagamento_ativa');

                if($this->db->table_exists('vendas')){

                    if($forma_pagamento_ativa == 0 && $this->core_model('vendas', array('venda_forma_pagamento_id' => $forma_pagamento_ativa, 'venda_status' => 0))){
                        $this->session->set_flashdata('error', 'Forma de pagamento não pode ser desativada, está sendo utilizada em Vendas');
                        redirect('modulo');
                    }

                }

                if($this->db->table_exists('ordem_servicos')){

                    if($forma_pagamento_ativa == 0 && $this->core_model('ordem_servicos', array('ordem_servico_forma_pagamento_id' => $forma_pagamento_ativa, 'ordem_servico_status' => 0))){
                        $this->session->set_flashdata('error', 'Forma de pagamento não pode ser desativada, está sendo utilizada em Ordem de Serviço');
                        redirect('modulo');
                    }

                }

               $data = elements(
                   array(
                       'forma_pagamento_nome',
                       'forma_pagamento_aceita_parc',
                       'forma_pagamento_ativa',
                   ), $this->input->post()
               );

               $data = html_escape($data);

               $this->core_model->update('formas_pagamentos', $data, array('forma_pagamento_id' => $forma_pagamento_id));
               redirect('modulo');

            }else{

                $data = array(
                    'titulo' => 'Editar Formas pagamentos',
                    'forma_pagamento' => $this->core_model->get_by_id('formas_pagamentos', array('forma_pagamento_id' => $forma_pagamento_id)),
                );
        
                $this->load->view('layout/header', $data);
                $this->load->view('formas_pagamentos/edit');
                $this->load->view('layout/footer');
            }
        }
    }

    public function deletar($forma_pagamento_id = null){

        if(!$forma_pagamento_id || !$this->core_model->get_by_id('formas_pagamentos', array('forma_pagamento_id' => $forma_pagamento_id))){
            $this->session->set_flashdata('error', 'Forma de pagamento não encontrada');
            redirect('modulo');
        }

        if($this->core_model->get_by_id('formas_pagamentos', array('forma_pagamento_id' => $forma_pagamento_id, 'forma_pagamento_ativa' => 1))){
            $this->session->set_flashdata('error', 'Forma de pagamento ainda está ativo!');
            redirect('modulo');
        }

        $this->core_model->delete('formas_pagamentos', array('forma_pagamento_id' => $forma_pagamento_id));
        redirect('modulo');

    }

    // validação para não cadastrar repetido
    public function check_pagamento_nome($forma_pagamento_nome){
        $forma_pagamento_id = $this->input->post('forma_pagamento_id');

        if($this->core_model->get_by_id('formas_pagamentos', array('forma_pagamento_nome' => $forma_pagamento_nome, 'forma_pagamento_id !=' => $forma_pagamento_id ))){
            $this->form_validation->set_message('check_pagamento_nome', 'Esta forma de pagamento já exite');
            return false;
        }else{
            return true;
        }
    }
}