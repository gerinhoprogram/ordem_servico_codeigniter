<?php
defined('BASEPATH') OR exit('Ação não permitida');

class Servicos extends CI_Controller{

    public function __construct(){
        parent:: __construct();

        //se não estiver logado volta para login
        if(!$this->ion_auth->logged_in()){
            redirect ('login');
        }
    }

    public function index(){

        $data = array(

            'titulo' => 'Servicos cadastrados',

            //cria array de estilos para passar para view header
            'styles' => array('vendor/datatables/dataTables.bootstrap4.min.css'),

            'scripts' => array(
                'vendor/datatables/jquery.dataTables.min.js', 
                'vendor/datatables/dataTables.bootstrap4.min.js',
                'vendor/datatables/app.js'),
            
            //carrega dados da tabela clientes
            'servicos' => $this->core_model->get_all('servicos'),
        );

        // echo"<pre>";
        // print_r($data);
        // exit();

        $this->load->view('layout/header', $data);
        $this->load->view('servicos/index');
        $this->load->view('layout/footer');

    }

    public function adicionar(){

            $this->form_validation->set_rules('servico_nome', '', 'trim|required|min_length[5]|max_length[145]|is_unique[servicos.servico_nome]');
            $this->form_validation->set_rules('servico_descricao', '', 'trim|min_length[1]|max_length[500]');
            $this->form_validation->set_rules('servico_preco', '', 'trim|required|max_length[20]');

            if($this->form_validation->run()){

                // echo"<pre>";
                // print_r('validado');
                // exit();

                 // array para salvar no banco de dados
                 $data = elements(
                    array(
                        'servico_nome',
                        'servico_preco',
                        'servico_descricao',
                        'servico_ativo',
                    ), $this->input->post()
                    );

                // limpa dados perigosos
                $data = html_escape($data);

                // salva no banco de dados
                $this->core_model->insert('servicos', $data);

                redirect('servicos');

            }else{

                $data = array(

                    'titulo' => 'Adicionar Serviço',
                   
                    'scripts' => array(
                        'vendor/mask/jquery.mask.min.js',
                        'vendor/mask/app.js'
                    ),
                );

                $this->load->view('layout/header', $data);
                $this->load->view('servicos/add');
                $this->load->view('layout/footer');
            }
    }

    public function editar($servico_id = null){

        if(!$servico_id || !$this->core_model->get_by_id('servicos', array('servico_id' => $servico_id))){

            $this->session->set_flashdata('error', 'Serviço não encontrado');
            redirect('servicos');

        }else{

            $this->form_validation->set_rules('servico_nome', '', 'trim|required|min_length[5]|max_length[145]');
            $this->form_validation->set_rules('servico_descricao', '', 'trim|min_length[15]|max_length[500]');
            $this->form_validation->set_rules('servico_preco', '', 'trim|required|max_length[20]');

            if($this->form_validation->run()){

                // echo"<pre>";
                // print_r('validado');
                // exit();

                 // array para salvar no banco de dados
                 $data = elements(
                    array(
                        'servico_nome',
                        'servico_preco',
                        'servico_descricao',
                        'servico_ativo',
                    ), $this->input->post()
                    );

                // limpa dados perigosos
                $data = html_escape($data);

                // salva no banco de dados
                $this->core_model->update('servicos', $data, array('servico_id' => $servico_id));

                redirect('servicos');

            }else{

                $data = array(

                    'titulo' => 'Atualizar serviço',
                   
                    'scripts' => array(
                        'vendor/mask/jquery.mask.min.js',
                        'vendor/mask/app.js'
                    ),
                    'servico' => $this->core_model->get_by_id('servicos', array('servico_id' => $servico_id)),
                );

                $this->load->view('layout/header', $data);
                $this->load->view('servicos/edit');
                $this->load->view('layout/footer');
            }

        }

    }

    
    public function deletar($servico_id = null){
        if(!$servico_id || !$this->core_model->get_by_id('servicos', array('servico_id' => $servico_id))){
            $this->session->set_flashdata('error', 'Serviço não enontrado!');
            redirect('servicos');
        }else{
            // deletar
            $this->core_model->delete('servicos', array('servico_id' => $servico_id));
            redirect('servicos');
        }
    }
}