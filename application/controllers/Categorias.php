<?php
defined('BASEPATH') OR exit('Ação não permitida');

class Categorias extends CI_Controller{

    public function __construct(){
        parent:: __construct();

        //se não estiver logado volta para login
        if(!$this->ion_auth->logged_in()){
            redirect ('login');
        }
    }

    public function index(){

        $data = array(

            'titulo' => 'categorias cadastrados',

            //cria array de estilos para passar para view header
            'styles' => array('vendor/datatables/dataTables.bootstrap4.min.css'),

            'scripts' => array(
                'vendor/datatables/jquery.dataTables.min.js', 
                'vendor/datatables/dataTables.bootstrap4.min.js',
                'vendor/datatables/app.js'),
            
            //carrega dados da tabela clientes
            'categorias' => $this->core_model->get_all('categorias'),
        );

        $this->load->view('layout/header', $data);
        $this->load->view('categorias/index');
        $this->load->view('layout/footer');

    }

    public function adicionar(){

            $this->form_validation->set_rules('categoria_nome', '', 'trim|required|min_length[5]|max_length[145]|is_unique[categorias.categoria_nome]');
           
            if($this->form_validation->run()){

                 // array para salvar no banco de dados
                 $data = elements(
                    array(
                        'categoria_nome',
                        'categoria_ativa',
                    ), $this->input->post()
                    );

                // limpa dados perigosos
                $data = html_escape($data);

                // salva no banco de dados
                $this->core_model->insert('categorias', $data);

                redirect('categorias');

            }else{

                $data = array(

                    'titulo' => 'Adicionar categoria',
                   
                    'scripts' => array(
                        'vendor/mask/jquery.mask.min.js',
                        'vendor/mask/app.js'
                    ),
                );

                $this->load->view('layout/header', $data);
                $this->load->view('categorias/add');
                $this->load->view('layout/footer');
            }
    }

    public function editar($categoria_id = null){

        if(!$categoria_id || !$this->core_model->get_by_id('categorias', array('categoria_id' => $categoria_id))){

            $this->session->set_flashdata('error', 'categoria não encontrado');
            redirect('categorias');

        }else{

            $this->form_validation->set_rules('categoria_nome', '', 'trim|required|min_length[5]|max_length[145]');

            if($this->form_validation->run()){

                $categoria_ativa = $this->input->post('categoria_ativa');

                if($this->db->table_exists('produtos')){

                    if($categoria_ativa == 0 && $this->core_model->get_by_id('produtos', array('produto_categoria_id' => $categoria_id, 'produto_ativo' => 1))){
                            $this->session->set_flashdata('error', 'Esta categoria não pode ser desativada esta sendo utilizada em Produtos');
                            redirect ('categorias');
                    }

                }

                 // array para salvar no banco de dados
                 $data = elements(
                    array(
                        'categoria_nome',
                        'categoria_ativa',
                    ), $this->input->post()
                    );

                // limpa dados perigosos
                $data = html_escape($data);

                // salva no banco de dados
                $this->core_model->update('categorias', $data, array('categoria_id' => $categoria_id));

                redirect('categorias');

            }else{

                $data = array(

                    'titulo' => 'Atualizar categoria',
                   
                    'scripts' => array(
                        'vendor/mask/jquery.mask.min.js',
                        'vendor/mask/app.js'
                    ),
                    'categoria' => $this->core_model->get_by_id('categorias', array('categoria_id' => $categoria_id)),
                );

                $this->load->view('layout/header', $data);
                $this->load->view('categorias/edit');
                $this->load->view('layout/footer');
            }

        }

    }

    
    public function deletar($categoria_id = null){
        if(!$categoria_id || !$this->core_model->get_by_id('categorias', array('categoria_id' => $categoria_id))){
            $this->session->set_flashdata('error', 'categoria não enontrado!');
            redirect('categorias');
        }else{
            // deletar
            $this->core_model->delete('categorias', array('categoria_id' => $categoria_id));
            redirect('categorias');
        }
    }
}