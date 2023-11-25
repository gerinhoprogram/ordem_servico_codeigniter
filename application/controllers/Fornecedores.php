<?php
defined('BASEPATH') OR exit('Ação não permitida');

class Fornecedores extends CI_Controller{

    public function __construct(){
        parent:: __construct();

        //se não estiver logado volta para login
        if(!$this->ion_auth->logged_in()){
            redirect ('login');
        }
    }

    public function index(){

        $data = array(

            'titulo' => 'Fornecedores',

            //cria array de estilos para passar para view header
            'styles' => array('vendor/datatables/dataTables.bootstrap4.min.css'),

            'scripts' => array(
                'vendor/datatables/jquery.dataTables.min.js', 
                'vendor/datatables/dataTables.bootstrap4.min.js',
                'vendor/datatables/app.js'),
            
            //carrega dados da tabela clientes
            'fornecedores' => $this->core_model->get_all('fornecedores_tab'),
        );

        $this->load->view('layout/header', $data);
        $this->load->view('fornecedores/index');
        $this->load->view('layout/footer');

    }

    public function adicionar(){

        $this->form_validation->set_rules('fornecedor_razao', '', 'trim|required|min_length[5]|max_length[200]|is_unique[fornecedores_tab.fornecedor_razao]');
            $this->form_validation->set_rules('fornecedor_nome_fantasia', '', 'trim|required|min_length[5]|max_length[120]|is_unique[fornecedores_tab.fornecedor_nome_fantasia]');
            $this->form_validation->set_rules('fornecedor_ie', '', 'required|trim|required|max_length[45]|is_unique[fornecedores_tab.fornecedor_ie]');
            $this->form_validation->set_rules('fornecedor_cnpj', '', 'trim|required|exact_length[18]|callback_valida_cnpj|is_unique[fornecedores_tab.fornecedor_cnpj]');
            $this->form_validation->set_rules('fornecedor_email', '', 'trim|required|valid_email|max_length[100]|is_unique[fornecedores_tab.fornecedor_email]');
            $this->form_validation->set_rules('fornecedor_celular', '', 'trim|max_length[15]|is_unique[fornecedores_tab.fornecedor_celular]');            
            $this->form_validation->set_rules('fornecedor_telefone', '', 'trim|max_length[15]|is_unique[fornecedores_tab.fornecedor_telefone]');
            $this->form_validation->set_rules('fornecedor_contato', '', 'trim|max_length[100]');
            
            // $this->form_validation->set_rules('fornecedor_endereco', '', 'trim|required|max_length[100]');
            // $this->form_validation->set_rules('fornecedor_numero_endereco', '', 'trim|max_length[20]');
            // $this->form_validation->set_rules('fornecedor_bairro', '', 'trim|max_length[45]');
            // $this->form_validation->set_rules('fornecedor_complemento', '', 'trim|max_length[100]');
            // $this->form_validation->set_rules('fornecedor_cidade', '', 'trim|required|max_length[50]');
            // $this->form_validation->set_rules('fornecedor_estado', '', 'trim|required|exact_length[2]');
            // $this->form_validation->set_rules('fornecedor_obs', '', 'trim|max_length[200]');

            if($this->form_validation->run()){

                 // array para salvar no banco de dados
                 $data = elements(
                    array(
                        'fornecedor_razao',
                        'fornecedor_nome_fantasia',
                        'fornecedor_cnpj',
                        'fornecedor_contato',
                        'fornecedor_celular',
                        'fornecedor_telefone',
                        'fornecedor_email',
                        'fornecedor_ie',
                    ), $this->input->post()
                    );
                
                // funcao strtooupper salva caixa alta no banco de dados
                // $data['fornecedor_estado'] = strtoupper($this->input->post('fornecedor_estado'));

                // limpa dados perigosos
                $data = html_escape($data);

                // salva no banco de dados
                $this->core_model->insert('fornecedores_tab', $data);

                redirect('fornecedores');

            }else{

                $data = array(

                    'titulo' => 'Atualizar fornecedor',
                   
                    'scripts' => array(
                        'vendor/mask/jquery.mask.min.js',
                        'vendor/mask/app.js'
                    ),
                    
                );

                $this->load->view('layout/header', $data);
                $this->load->view('fornecedores/add');
                $this->load->view('layout/footer');
            }

    }

    public function editar($fornecedor_id = null){

        if(!$fornecedor_id || !$this->core_model->get_by_id('fornecedores_tab', array('fornecedor_id' => $fornecedor_id))){

            $this->session->set_flashdata('error', 'Fornecedor não encontrado');
            redirect('fornecedores');

        }else{

            $this->form_validation->set_rules('fornecedor_razao', '', 'trim|required|min_length[5]|max_length[200]|callback_check_razao');
            $this->form_validation->set_rules('fornecedor_nome_fantasia', '', 'trim|required|min_length[5]|max_length[120]|callback_check_fantasia');
            $this->form_validation->set_rules('fornecedor_ie', '', 'required|trim|required|max_length[45]|callback_check_ie');
            $this->form_validation->set_rules('fornecedor_cnpj', '', 'trim|required|exact_length[18]|callback_valida_cnpj');
            $this->form_validation->set_rules('fornecedor_email', '', 'trim|required|valid_email|max_length[100]|callback_check_email');
            $this->form_validation->set_rules('fornecedor_celular', '', 'trim|max_length[15]|callback_check_celular');            
            $this->form_validation->set_rules('fornecedor_telefone', '', 'trim|max_length[15]|callback_check_telefone');
            $this->form_validation->set_rules('fornecedor_contato', '', 'trim|max_length[100]');
            
            // $this->form_validation->set_rules('fornecedor_endereco', '', 'trim|required|max_length[100]');
            // $this->form_validation->set_rules('fornecedor_numero_endereco', '', 'trim|max_length[20]');
            // $this->form_validation->set_rules('fornecedor_bairro', '', 'trim|max_length[45]');
            // $this->form_validation->set_rules('fornecedor_complemento', '', 'trim|max_length[100]');
            // $this->form_validation->set_rules('fornecedor_cidade', '', 'trim|required|max_length[50]');
            // $this->form_validation->set_rules('fornecedor_estado', '', 'trim|required|exact_length[2]');
            // $this->form_validation->set_rules('fornecedor_obs', '', 'trim|max_length[200]');

            if($this->form_validation->run()){

                $fornecedor_ativo = $this->input->post('fornecedor_ativo');

                if($this->db->table_exists('produtos')){

                    if($fornecedor_ativo == 0 && $this->core_model->get_by_id('produtos', array('produto_fornecedor_id' => $fornecedor_id, 'produto_ativo' => 1))){
                            $this->session->set_flashdata('error', 'Este fornecedor não pode ser desativado esta sendo utilizado em Produtos');
                            redirect ('fornecedores');
                    }

                }

                 // array para salvar no banco de dados
                 $data = elements(
                    array(
                        'fornecedor_razao',
                        'fornecedor_nome_fantasia',
                        'fornecedor_cnpj',
                        'fornecedor_contato',
                        'fornecedor_celular',
                        'fornecedor_telefone',
                        'fornecedor_email',
                        'fornecedor_ie',
                    ), $this->input->post()
                    );
                
                // funcao strtooupper salva caixa alta no banco de dados
                // $data['fornecedor_estado'] = strtoupper($this->input->post('fornecedor_estado'));

                // limpa dados perigosos
                $data = html_escape($data);

                // salva no banco de dados
                $this->core_model->update('fornecedores_tab', $data, array('fornecedor_id' => $fornecedor_id));

                redirect('fornecedores');

            }else{

                $data = array(

                    'titulo' => 'Atualizar fornecedor',
                   
                    'scripts' => array(
                        'vendor/mask/jquery.mask.min.js',
                        'vendor/mask/app.js'
                    ),
                    'fornecedor' => $this->core_model->get_by_id('fornecedores_tab', array('fornecedor_id' => $fornecedor_id)),
                );

                $this->load->view('layout/header', $data);
                $this->load->view('fornecedores/edit');
                $this->load->view('layout/footer');
            }

        }

    }

    public function deletar($fornecedor_id = null){
        if(!$fornecedor_id || !$this->core_model->get_by_id('fornecedores_tab', array('fornecedor_id' => $fornecedor_id))){
            $this->session->set_flashdata('error', 'Fornecedor não enontrado!');
            redirect('fornecedores');
        }else{
            // deletar
            $this->core_model->delete('fornecedores_tab', array('fornecedor_id' => $fornecedor_id));
            redirect('fornecedores');
        }
    }


    // validação para não cadastrar repetido
    public function check_razao($fornecedor_razao){
        $fornecedor_id = $this->input->post('fornecedor_id');

        if($this->core_model->get_by_id('fornecedores_tab', array('fornecedor_razao' => $fornecedor_razao, 'fornecedor_id !=' => $fornecedor_id ))){
            $this->form_validation->set_message('check_razao', 'Esta razão social já exite');
            return false;
        }else{
            return true;
        }
    }

    // validação para não cadastrar repetido
    public function check_ie($fornecedor_ie){
        $fornecedor_id = $this->input->post('fornecedor_id');

        if($this->core_model->get_by_id('fornecedores_tab', array('fornecedor_ie' => $fornecedor_ie, 'fornecedor_id !=' => $fornecedor_id ))){
            $this->form_validation->set_message('check_ie', 'Esta inscrição estadual já exite');
            return false;
        }else{
            return true;
        }
    }

     // validação para não cadastrar repetido
     public function check_fantasia($fornecedor_nome_fantasia){
        $fornecedor_id = $this->input->post('fornecedor_id');

        if($this->core_model->get_by_id('fornecedores_tab', array('fornecedor_nome_fantasia' => $fornecedor_nome_fantasia, 'fornecedor_id !=' => $fornecedor_id ))){
            $this->form_validation->set_message('check_fantasia', 'Este nome fantasia já existe');
            return false;
        }else{
            return true;
        }
    }


    // validação para não cadastrar repetido
    public function check_email($fornecedor_email){
        $fornecedor_id = $this->input->post('fornecedor_id');

        if($this->core_model->get_by_id('fornecedores_tab', array('fornecedor_email' => $fornecedor_email, 'fornecedor_id !=' => $fornecedor_id ))){
            $this->form_validation->set_message('check_email', 'Este e-mail já exite');
            return false;
        }else{
            return true;
        }
    }

    // validação para não cadastrar repetido
    public function check_telefone($fornecedor_telefone){
        $fornecedor_id = $this->input->post('fornecedor_id');

        if($this->core_model->get_by_id('fornecedores_tab', array('fornecedor_telefone' => $fornecedor_telefone, 'fornecedor_id !=' => $fornecedor_id ))){
            $this->form_validation->set_message('check_telefone', 'Este telefone já exite');
            return false;
        }else{
            return true;
        }
    }

    // validação para não cadastrar repetido
    public function check_celular($fornecedor_celular){
        $fornecedor_id = $this->input->post('fornecedor_id');

        if($this->core_model->get_by_id('fornecedores_tab', array('fornecedor_celular' => $fornecedor_celular, 'fornecedor_id !=' => $fornecedor_id ))){
            $this->form_validation->set_message('check_celular', 'Este celular já exite');
            return false;
        }else{
            return true;
        }
    }

    public function valida_cnpj($cnpj) {

        // Verifica se um número foi informado
        if (empty($cnpj)) {
            $this->form_validation->set_message('valida_cnpj', 'Por favor digite um CNPJ válido');
            return false;
        }

        if ($this->input->post('fornecedor_id')) {

            $fornecedor_id = $this->input->post('fornecedor_id');

            if ($this->core_model->get_by_id('fornecedores_tab', array('fornecedor_id !=' => $fornecedor_id, 'fornecedor_cnpj' => $cnpj))) {
                $this->form_validation->set_message('valida_cnpj', 'Esse CNPJ já existe');
                return FALSE;
            }
        }

        // Elimina possivel mascara
        $cnpj = preg_replace("/[^0-9]/", "", $cnpj);
        $cnpj = str_pad($cnpj, 14, '0', STR_PAD_LEFT);


        // Verifica se o numero de digitos informados é igual a 11 
        if (strlen($cnpj) != 14) {
            $this->form_validation->set_message('valida_cnpj', 'Por favor digite um CNPJ válido');
            return false;
        }

        // Verifica se nenhuma das sequências invalidas abaixo 
        // foi digitada. Caso afirmativo, retorna falso
        else if ($cnpj == '00000000000000' ||
                $cnpj == '11111111111111' ||
                $cnpj == '22222222222222' ||
                $cnpj == '33333333333333' ||
                $cnpj == '44444444444444' ||
                $cnpj == '55555555555555' ||
                $cnpj == '66666666666666' ||
                $cnpj == '77777777777777' ||
                $cnpj == '88888888888888' ||
                $cnpj == '99999999999999') {
            $this->form_validation->set_message('valida_cnpj', 'Por favor digite um CNPJ válido');
            return false;

            // Calcula os digitos verificadores para verificar se o
            // CPF é válido
        } else {

            $j = 5;
            $k = 6;
            $soma1 = "";
            $soma2 = "";

            for ($i = 0; $i < 13; $i++) {

                $j = $j == 1 ? 9 : $j;
                $k = $k == 1 ? 9 : $k;

                //$soma2 += ($cnpj{$i} * $k);

                //$soma2 = intval($soma2) + ($cnpj{$i} * $k); //Para PHP com versão < 7.4
                $soma2 = intval($soma2) + ($cnpj[$i] * $k); //Para PHP com versão > 7.4

                if ($i < 12) {
                    //$soma1 = intval($soma1) + ($cnpj{$i} * $j); //Para PHP com versão < 7.4
                    $soma1 = intval($soma1) + ($cnpj[$i] * $j); //Para PHP com versão > 7.4
                }

                $k--;
                $j--;
            }

            $digito1 = $soma1 % 11 < 2 ? 0 : 11 - $soma1 % 11;
            $digito2 = $soma2 % 11 < 2 ? 0 : 11 - $soma2 % 11;

            if (!($cnpj{12} == $digito1) and ( $cnpj{13} == $digito2)) {
                $this->form_validation->set_message('valida_cnpj', 'Por favor digite um CNPJ válido');
                return false;
            } else {
                return true;
            }
        }
    }
}