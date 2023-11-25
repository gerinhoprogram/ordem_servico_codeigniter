<?php
defined('BASEPATH') OR exit('Ação não permitida');

class Produtos extends CI_Controller{

    public function __construct(){
        parent:: __construct();

        //se não estiver logado volta para login
        if(!$this->ion_auth->logged_in()){
            redirect ('login');
        }
        $this->load->model('produtos_model');
    }

    public function index(){

        $data = array(

            'titulo' => 'Produtos cadastrados',

            //cria array de estilos para passar para view header
            'styles' => array('vendor/datatables/dataTables.bootstrap4.min.css'),

            'scripts' => array(
                'vendor/datatables/jquery.dataTables.min.js', 
                'vendor/datatables/dataTables.bootstrap4.min.js',

                'vendor/datatables/export/datatables.buttons.min.js',
                'vendor/datatables/export/pdfmake.min.js',
                'vendor/datatables/export/vfs_fonts.js',
                'vendor/datatables/export/buttons.html5.min.js',

                'vendor/datatables/app.js'),
            
            //carrega dados da tabela clientes
            'produtos' => $this->produtos_model->get_all(),
        );

        // echo"<pre>";
        // print_r($data['produtos']);
        // exit();

        $this->load->view('layout/header', $data);
        $this->load->view('produtos/index');
        $this->load->view('layout/footer');

    }

    public function adicionar(){

            $this->form_validation->set_rules('produto_descricao', 'Descrição', 'trim|required|min_length[2]|max_length[145]|is_unique[produtos.produto_descricao]');
            $this->form_validation->set_rules('produto_unidade', 'Unidade', 'trim|required|min_length[2]|max_length[5]');
            $this->form_validation->set_rules('produto_preco_custo', 'Preço de custo', 'trim|required|min_length[2]|max_length[80]');
            $this->form_validation->set_rules('produto_preco_venda', 'Preço de venda', 'trim|required|min_length[2]|max_length[80]|callback_produto_preco_venda');
            $this->form_validation->set_rules('produto_estoque_minimo', 'Estoque mínimo', 'trim|greater_than_equal_to[0]');
            $this->form_validation->set_rules('produto_qtde_estoque', 'Estoque qdt', 'trim|required|max_length[10]');
            $this->form_validation->set_rules('produto_obs', 'Observação', 'trim|max_length[200]');

            if($this->form_validation->run()){

                $data = elements(
                    array(
                        'produto_codigo',
                        'produto_descricao',
                        'produto_unidade',
                        'produto_preco_custo',
                        'produto_preco_venda',
                        'produto_estoque_minimo',
                        'produto_qtde_estoque',
                        'produto_obs',
                        'produto_ativo',
                        'produto_categoria_id',
                        'produto_marca_id',
                        'produto_fornecedor_id',

                    ), $this->input->post()
                );

                $data = html_escape($data);

                $this->core_model->insert('produtos', $data);
                redirect('produtos');
               
            }else{
                $data = array(

                    'titulo' => 'Atualizar produtos',
        
                    //cria array de estilos para passar para view header
                    'styles' => array('vendor/datatables/dataTables.bootstrap4.min.css'),
        
                    'scripts' => array(
                        'vendor/mask/jquery.mask.min.js',
                        'vendor/mask/app.js'
                    ),
                    'produto_codigo' => $this->core_model->generate_unique_code('produtos', 'numeric', 8, 'produto_codigo'),
                    'marcas' => $this->core_model->get_all('marcas', array('marca_ativa' => 1)),
                    'fornecedores' => $this->core_model->get_all('fornecedores_tab', array('fornecedor_ativo' => 1)),
                    'categorias' => $this->core_model->get_all('categorias', array('categoria_ativa' => 1)),
                );
    
                $this->load->view('layout/header', $data);
                $this->load->view('produtos/add');
                $this->load->view('layout/footer');
            }
    }

    public function editar($produto_id){
        if(!$produto_id || !$this->core_model->get_by_id('produtos', array('produto_id' => $produto_id))){
            $this->session->set_flashdata('error', 'Produto não encontrado');
            redirect ('produtos');
        }else{

            $this->form_validation->set_rules('produto_descricao', 'Descrição', 'trim|required|min_length[2]|max_length[145]|callback_check_produto_descricao');
            $this->form_validation->set_rules('produto_unidade', 'Unidade', 'trim|required|min_length[2]|max_length[5]');
            $this->form_validation->set_rules('produto_preco_custo', 'Preço de custo', 'trim|required|min_length[2]|max_length[80]');
            $this->form_validation->set_rules('produto_preco_venda', 'Preço de venda', 'trim|required|min_length[2]|max_length[80]|callback_check_produto_preco_venda');
            $this->form_validation->set_rules('produto_estoque_minimo', 'Estoque mínimo', 'trim|greater_than_equal_to[0]');
            $this->form_validation->set_rules('produto_qtde_estoque', 'Estoque qdt', 'trim|required|max_length[10]');
            $this->form_validation->set_rules('produto_obs', 'Observação', 'trim|max_length[200]');

            if($this->form_validation->run()){

                $data = elements(
                    array(
                        'produto_codigo',
                        'produto_descricao',
                        'produto_unidade',
                        'produto_preco_custo',
                        'produto_preco_venda',
                        'produto_estoque_minimo',
                        'produto_qtde_estoque',
                        'produto_obs',
                        'produto_ativo',
                        'produto_categoria_id',
                        'produto_marca_id',
                        'produto_fornecedor_id',

                    ), $this->input->post()
                );

                $data = html_escape($data);

                $this->core_model->update('produtos', $data, array('produto_id' => $produto_id));
                redirect('produtos');
               
            }else{
                $data = array(

                    'titulo' => 'Atualizar produtos',
        
                    //cria array de estilos para passar para view header
                    'styles' => array('vendor/datatables/dataTables.bootstrap4.min.css'),
        
                    'scripts' => array(
                        'vendor/mask/jquery.mask.min.js',
                        'vendor/mask/app.js'
                    ),
    
                    'produto' => $this->core_model->get_by_id('produtos', array('produto_id' => $produto_id)),
                    'marcas' => $this->core_model->get_all('marcas', array('marca_ativa' => 1)),
                    'fornecedores' => $this->core_model->get_all('fornecedores_tab', array('fornecedor_ativo' => 1)),
                    'categorias' => $this->core_model->get_all('categorias', array('categoria_ativa' => 1)),
                );
    
                $this->load->view('layout/header', $data);
                $this->load->view('produtos/edit');
                $this->load->view('layout/footer');
            }
        }
    }

    public function deletar($produto_id = null){

        if(!$produto_id || !$this->core_model->get_by_id('produtos', array('produto_id' => $produto_id))){
            $this->session->set_flashdata('eror', 'Produto não encontrado');
            redirect ('produtos');
        }else{
            $this->core_model->delete('produtos', array('produto_id' => $produto_id));
            redirect ('produtos');
        }
    }

    public function check_produto_descricao($produto_descricao){
        $produto_id = $this->input->post('produto_id');
        if($this->core_model->get_by_id('produtos', array('produto_descricao' => $produto_descricao, 'produto_id !=' => $produto_id))){
                $this->form_validation->set_message('check_produto_descricao', 'Este produto já existe');
                return false;
        }else{
            return true;
        }
    }

    public function check_produto_preco_venda($produto_preco_venda){

        $produto_preco_custo = $this->input->post('produto_preco_custo');

        $produto_preco_custo = str_replace('.', '', $produto_preco_custo);
        $produto_preco_venda = str_replace('.', '', $produto_preco_venda);

        $produto_preco_custo = str_replace(',', '', $produto_preco_custo);
        $produto_preco_venda = str_replace(',', '', $produto_preco_venda);
        
        if($produto_preco_custo > $produto_preco_venda){
            $this->form_validation->set_message('check_produto_preco_venda', 'Preço de venda deve ser maior ou igual ao preço de custo');
            return false;
        }else{
            return true;
        }
    }
}