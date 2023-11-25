<?php
defined('BASEPATH') OR exit('Ação não permitida');

class marcas extends CI_Controller{

    public function __construct(){
        parent:: __construct();

        //se não estiver logado volta para login
        if(!$this->ion_auth->logged_in()){
            redirect ('login');
        }
    }

    public function index(){

        $data = array(

            'titulo' => 'marcas cadastrados',

            //cria array de estilos para passar para view header
            'styles' => array('vendor/datatables/dataTables.bootstrap4.min.css'),

            'scripts' => array(
                'vendor/datatables/jquery.dataTables.min.js', 
                'vendor/datatables/dataTables.bootstrap4.min.js',
                'vendor/datatables/app.js'),
            
            //carrega dados da tabela clientes
            'marcas' => $this->core_model->get_all('marcas'),
        );

        // echo"<pre>";
        // print_r($data);
        // exit();

        $this->load->view('layout/header', $data);
        $this->load->view('marcas/index');
        $this->load->view('layout/footer');

    }

    public function adicionar(){

            $this->form_validation->set_rules('marca_nome', '', 'trim|required|min_length[5]|max_length[145]|is_unique[marcas.marca_nome]');
           
            if($this->form_validation->run()){

                 // array para salvar no banco de dados
                 $data = elements(
                    array(
                        'marca_nome',
                        'marca_ativa',
                    ), $this->input->post()
                    );

                // limpa dados perigosos
                $data = html_escape($data);

                // salva no banco de dados
                $this->core_model->insert('marcas', $data);

                redirect('marcas');

            }else{

                $data = array(

                    'titulo' => 'Adicionar Marca',
                   
                    'scripts' => array(
                        'vendor/mask/jquery.mask.min.js',
                        'vendor/mask/app.js'
                    ),
                );

                $this->load->view('layout/header', $data);
                $this->load->view('marcas/add');
                $this->load->view('layout/footer');
            }
    }

    public function editar($marca_id = null){

        if(!$marca_id || !$this->core_model->get_by_id('marcas', array('marca_id' => $marca_id))){

            $this->session->set_flashdata('error', 'Marca não encontrado');
            redirect('marcas');

        }else{

            $this->form_validation->set_rules('marca_nome', '', 'trim|required|min_length[5]|max_length[145]');

            if($this->form_validation->run()){

                $marca_ativa = $this->input->post('marca_ativa');

                if($this->db->table_exists('produtos')){

                    if($marca_ativa == 0 && $this->core_model->get_by_id('produtos', array('produto_marca_id' => $marca_id, 'produto_ativo' => 1))){
                            $this->session->set_flashdata('error', 'Esta categoria não pode ser desativada esta sendo utilizada em Produtos');
                            redirect ('marcas');
                    }

                }

                 // array para salvar no banco de dados
                 $data = elements(
                    array(
                        'marca_nome',
                        'marca_ativa',
                    ), $this->input->post()
                    );

                // limpa dados perigosos
                $data = html_escape($data);

                // salva no banco de dados
                $this->core_model->update('marcas', $data, array('marca_id' => $marca_id));

                redirect('marcas');

            }else{

                $data = array(

                    'titulo' => 'Atualizar Marca',
                   
                    'scripts' => array(
                        'vendor/mask/jquery.mask.min.js',
                        'vendor/mask/app.js'
                    ),
                    'marca' => $this->core_model->get_by_id('marcas', array('marca_id' => $marca_id)),
                );

                $this->load->view('layout/header', $data);
                $this->load->view('marcas/edit');
                $this->load->view('layout/footer');
            }

        }

    }

    
    public function deletar($marca_id = null){
        if(!$marca_id || !$this->core_model->get_by_id('marcas', array('marca_id' => $marca_id))){
            $this->session->set_flashdata('error', 'Marca não enontrado!');
            redirect('marcas');
        }else{
            // deletar
            $this->core_model->delete('marcas', array('marca_id' => $marca_id));
            redirect('marcas');
        }
    }
}