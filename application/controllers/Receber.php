<?php
defined('BASEPATH') OR exit('Ação não permitida');

class Receber extends CI_Controller{

    public function __construct(){
        parent:: __construct();

        //se não estiver logado volta para login
        if(!$this->ion_auth->logged_in()){
            redirect ('login');
        }

        if(!$this->ion_auth->is_admin()){
            $this->session->set_flashdata('info', 'Usuário não tem permissão de acesso!');
            redirect ('home');
        }

        $this->load->model('financeiro_model');
    }

    public function index(){

        $data = array(

            'titulo' => 'Contas a receber cadastradas',

            //cria array de estilos para passar para view header
            'styles' => array('vendor/datatables/dataTables.bootstrap4.min.css'),

            'scripts' => array(
                'vendor/datatables/jquery.dataTables.min.js', 
                'vendor/datatables/dataTables.bootstrap4.min.js',
                'vendor/datatables/app.js'),
            
            //carrega dados da tabela clientes
            'contas_receber' => $this->financeiro_model->get_all_receber(),
        );

        // echo'<pre>';
        // print_r($data['contas_receber']);
        // exit();

        $this->load->view('layout/header', $data);
        $this->load->view('receber/index');
        $this->load->view('layout/footer');

    }

    public function adicionar(){

            $this->form_validation->set_rules('conta_receber_cliente_id', '', 'required');
            $this->form_validation->set_rules('conta_receber_data_vencto', '', 'required');
            $this->form_validation->set_rules('conta_receber_valor', '', 'required');
            $this->form_validation->set_rules('conta_receber_obs', '', 'max_length[200]');

            if($this->form_validation->run()){

               $data = elements(
                   array(
                       'conta_receber_cliente_id',
                       'conta_receber_data_vencto',
                       'conta_receber_obs',
                       'conta_receber_valor',
                       'conta_receber_status',
                   ), $this->input->post()
               );

               $conta_receber_status = $this->input->post('conta_receber_status');

               if($conta_receber_status = 1){
                   $data['conta_receber_data_pagamento'] = date('y-m-d h:i:s');
               }

               $data = html_escape($data);

               $this->core_model->insert('contas_receber', $data);
               redirect('receber');

            }else{

                $data = array(

                    'titulo' => 'Adicionar Contas a receber',
        
                    //cria array de estilos para passar para view header
                    'styles' => array('vendor/select2/select2.min.css'),
        
                    'scripts' => array(
                        'vendor/mask/jquery.mask.min.js',
                        'vendor/mask/app.js',
                        'vendor/select2/select2.min.js',
                        'vendor/select2/app.js'),
                        
                    //carrega dados da tabela clientes
                    'conta_receber' => $this->core_model->get_by_id('contas_receber', array('conta_receber_id')),
                    'clientes' => $this->core_model->get_all('clientes_tab'),
                );
        
                $this->load->view('layout/header', $data);
                $this->load->view('receber/add');
                $this->load->view('layout/footer');
            }

    }

    public function editar($conta_receber_id = null){

        if(!$conta_receber_id || !$this->core_model->get_by_id('contas_receber', array('conta_receber_id' => $conta_receber_id))){
            $this->session->set_flashdata('error', 'Conta não encontrada');
        }else{

            $this->form_validation->set_rules('conta_receber_cliente_id', '', 'required');
            $this->form_validation->set_rules('conta_receber_data_vencto', '', 'required');
            $this->form_validation->set_rules('conta_receber_valor', '', 'required');
            $this->form_validation->set_rules('conta_receber_obs', '', 'max_length[200]');

            if($this->form_validation->run()){

               $data = elements(
                   array(
                       'conta_receber_cliente_id',
                       'conta_receber_data_vencto',
                       'conta_receber_obs',
                       'conta_receber_valor',
                       'conta_receber_status',
                   ), $this->input->post()
               );

               $conta_receber_status = $this->input->post('conta_receber_status');

               if($conta_receber_status = 1){
                   $data['conta_receber_data_pagamento'] = date('y-m-d h:i:s');
               }

               $data = html_escape($data);

               $this->core_model->update('contas_receber', $data, array('conta_receber_id' => $conta_receber_id));
               redirect('receber');

            }else{

                $data = array(

                    'titulo' => 'Editar Contas a receber',
        
                    //cria array de estilos para passar para view header
                    'styles' => array('vendor/select2/select2.min.css'),
        
                    'scripts' => array(
                        'vendor/mask/jquery.mask.min.js',
                        'vendor/mask/app.js',
                        'vendor/select2/select2.min.js',
                        'vendor/select2/app.js'),
                        
                    //carrega dados da tabela clientes
                    'conta_receber' => $this->core_model->get_by_id('contas_receber', array('conta_receber_id' => $conta_receber_id)),
                    'clientes' => $this->core_model->get_all('clientes_tab', array('cliente_ativo' => 1)),
                );
        
                $this->load->view('layout/header', $data);
                $this->load->view('receber/edit');
                $this->load->view('layout/footer');
            }
        }
    }

    public function deletar($conta_receber_id = null){

        if(!$conta_receber_id || !$this->core_model->get_by_id('contas_receber', array('conta_receber_id' => $conta_receber_id))){
            $this->session->set_flashdata('error', 'Conta não encontrada');
            redirect('receber');
        }

        if($this->core_model->get_by_id('contas_receber', array('conta_receber_id' => $conta_receber_id, 'conta_receber_status' => 0))){
            $this->session->set_flashdata('info', 'Conta ainda está em aberto!');
            redirect('receber');
        }

        $this->core_model->delete('contas_receber', array('conta_receber_id' => $conta_receber_id));
        redirect('receber');

    }
}