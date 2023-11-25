<?php
defined('BASEPATH') OR exit('Ação não permitida');

class Sistema extends CI_Controller{

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
    }

    public function index(){

        //pega na tabela sistema os dados
        $data = array(
            'titulo' => 'Editar sistema',
            'sistema' => $this->core_model->get_by_id('system', array('id' => 1)),
            'scripts' => array(
                'vendor/mask/jquery.mask.min.js',
                'vendor/mask/app.js'
            ),
        );

        //validação do formulário
        //matches verifica se um campo é igual ao outro
        //exact_length numero exato de caracter
        $this->form_validation->set_rules('sistema_razao_social', '', 'required|min_length[5]|max_length[100]');
        $this->form_validation->set_rules('sistema_nome_fantasia', '', 'required|min_length[5]|max_length[100]');
        $this->form_validation->set_rules('sistema_cnpj', 'CNPJ', 'required|exact_length[18]');
        $this->form_validation->set_rules('sistema_ie', '', 'required|max_length[200]');
        $this->form_validation->set_rules('sistema_telefone_fixo', '', 'max_length[18]');
        $this->form_validation->set_rules('sistema_email', 'E-mail', 'required|valid_email|max_length[100]');
        $this->form_validation->set_rules('sistema_site_url', 'URL site', 'valid_url|max_length[100]');
        $this->form_validation->set_rules('sistema_cep', 'CEP', 'exact_length[9]');
        $this->form_validation->set_rules('sistema_endereco', '', 'max_length[200]');
        $this->form_validation->set_rules('sistema_numero', '', 'max_length[15]');
        $this->form_validation->set_rules('sistema_estado', '', 'exact_length[2]');
        $this->form_validation->set_rules('sistema_cidade', '', 'required|max_length[100]');
        $this->form_validation->set_rules('sistema_txt_ordem_servico', '', 'max_length[500]');

        if($this->form_validation->run()){
                
            // echo"<pre>";
            // print_r($this->input->post());
            // exit();

            //captura os dados para gravar no banco
            $data = elements(
                array(
                    'sistema_razao_social',
                    'sistema_nome_fantasia',
                    'sistema_cnpj',
                    'sistema_ie',
                    'sistema_telefone_fixo',
                    'sistema_email',
                    'sistema_site_url',
                    'sistema_cep',
                    'sistema_endereco',
                    'sistema_numero',
                    'sistema_estado',
                    'sistema_cidade',
                    'sistema_txt_ordem_servico',
                ), $this->input->post()
            );

            //limpa codigo js dos inputs
            //precisa colocar como TRUE em config.php $config['global_xss_filtering'] = TRUE;
            $data = html_escape($data);

            //atualiza na tabela system com id igual a 1
            $this->core_model->update('system', $data, array('id' => 1));
            redirect ('sistema');

        }else{

            $this->load->view('layout/header', $data);
            $this->load->view('sistema/index');
            $this->load->view('layout/footer');

        }

    }
}