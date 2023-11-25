<?php
defined('BASEPATH') OR exit('Ação não permitida');

class Clientes extends CI_Controller{

    public function __construct(){
        parent:: __construct();

        //se não estiver logado volta para login
        if(!$this->ion_auth->logged_in()){
            redirect ('login');
        }
    }

    public function index(){

        $data = array(

            'titulo' => 'Clientes cadastrados',

            //cria array de estilos para passar para view header
            'styles' => array('vendor/datatables/dataTables.bootstrap4.min.css'),

            'scripts' => array(
                'vendor/datatables/jquery.dataTables.min.js', 
                'vendor/datatables/dataTables.bootstrap4.min.js',
                'vendor/datatables/app.js'),
            
            //carrega dados da tabela clientes
            'clientes_cadastro' => $this->core_model->get_all('clientes_tab'),
        );

        $this->load->view('layout/header', $data);
        $this->load->view('clientes/index');
        $this->load->view('layout/footer');

    }

    public function adicionar(){
            //valida cpf e cnpj precisam ser unicos
            $cliente_tipo = $this->input->post('cliente_tipo');
            if($cliente_tipo == 1)
                $this->form_validation->set_rules('cliente_cpf', '', 'trim|required|exact_length[14]|is_unique[clientes_tab.cliente_cpf_cnpj]|callback_valida_cpf');
            else
                $this->form_validation->set_rules('cliente_cnpj', '', 'trim|required|exact_length[18]|is_unique[clientes_tab.cliente_cpf_cnpj]|callback_valida_cnpj');

            // se for direfrente de vazio telefone e celular precisam ser unicos
            if(!empty($this->input->post('cliente_telefone'))){
                $this->form_validation->set_rules('cliente_telefone', '', 'trim|max_length[15]|is_unique[clientes_tab.cliente_telefone]');
            }
            if(!empty($this->input->post('cliente_celular'))){
                $this->form_validation->set_rules('cliente_celular', '', 'trim|max_length[15]|is_unique[clientes_tab.cliente_celular]');
            }

            // precisam ser unicos
            $this->form_validation->set_rules('cliente_rg_ie', '', 'trim|required|max_length[45]|is_unique[clientes_tab.cliente_rg_ie]');
            $this->form_validation->set_rules('cliente_email', '', 'trim|required|valid_email|max_length[100]|is_unique[clientes_tab.cliente_email]');

            //validation normal
            $this->form_validation->set_rules('cliente_nome', '', 'trim|required|min_length[2]|max_length[45]');
            $this->form_validation->set_rules('cliente_sobrenome', '', 'trim|required|min_length[2]|max_length[100]');
            $this->form_validation->set_rules('cliente_data_nascimento', '', 'required');
            $this->form_validation->set_rules('cliente_telefone', '', 'trim|max_length[15]|is_unique[clientes_tab.cliente_telefone]');
            $this->form_validation->set_rules('cliente_celular', '', 'trim|max_length[15]|is_unique[clientes_tab.cliente_celular]');
            $this->form_validation->set_rules('cliente_cep', '', 'trim|required|exact_length[9]');
            $this->form_validation->set_rules('cliente_endereco', '', 'trim|required|max_length[100]');
            $this->form_validation->set_rules('cliente_numero_endereco', '', 'trim|max_length[20]');
            $this->form_validation->set_rules('cliente_bairro', '', 'trim|max_length[45]');
            $this->form_validation->set_rules('cliente_complemento', '', 'trim|max_length[100]');
            $this->form_validation->set_rules('cliente_cidade', '', 'trim|required|max_length[50]');
            $this->form_validation->set_rules('cliente_estado', '', 'trim|required|exact_length[2]');
            $this->form_validation->set_rules('cliente_obs', '', 'trim|max_length[200]');

            if($this->form_validation->run()){

                // array para salvar no banco de dados
                $data = elements(
                    array(
                        'cliente_nome',
                        'cliente_sobrenome',
                        'cliente_obs',
                        'cliente_estado',
                        'cliente_cidade',
                        'cliente_complemento',
                        'cliente_bairro',
                        'cliente_numero_endereco',
                        'cliente_endereco',
                        'cliente_cep',
                        'cliente_celular',
                        'cliente_telefone',
                        'cliente_email',
                        'cliente_rg_ie',
                        'cliente_ativo',
                        'cliente_data_nascimento',
                    ), $this->input->post()
                    );

                if($cliente_tipo == 1)
                    $data['cliente_cpf_cnpj'] = $this->input->post('cliente_cpf');
                else
                    $data['cliente_cpf_cnpj'] = $this->input->post('cliente_cnpj');
                
                // funcao strtooupper salva caixa alta no banco de dados
                $data['cliente_estado'] = strtoupper($this->input->post('cliente_estado'));

                // limpa dados perigosos
                $data = html_escape($data);

                // salva no banco de dados
                $this->core_model->insert('clientes_tab', $data);

                redirect('clientes');

            }else{

                $data = array(

                    'titulo' => 'Cadastrar Clientes',
                
                    'scripts' => array(
                        'vendor/mask/jquery.mask.min.js',
                        'vendor/mask/app.js',
                        'js/clientes.js'
                    ),
                );

                $this->load->view('layout/header', $data);
                $this->load->view('clientes/add');
                $this->load->view('layout/footer');

            }

    }

    public function editar($cliente_id = null){

        if(!$cliente_id || !$this->core_model->get_by_id('clientes_tab', array('cliente_id' => $cliente_id))){

            $this->session->set_flashdata('error', 'Cliente não encontrado');

        }else{

            //valida cpf e cnpj
            $cliente_tipo = $this->input->post('cliente_tipo');
            if($cliente_tipo == 1)
                $this->form_validation->set_rules('cliente_cpf', '', 'trim|required|exact_length[14]|callback_valida_cpf');
            else
                $this->form_validation->set_rules('cliente_cnpj', '', 'trim|required|exact_length[18]|callback_valida_cnpj');
           
             // se for direfrente de vazio vai para a funcao callback
             if(!empty($this->input->post('cliente_telefone'))){
                $this->form_validation->set_rules('cliente_telefone', '', 'trim|max_length[15]|callback_check_telefone');
             }
             if(!empty($this->input->post('cliente_celular'))){
                $this->form_validation->set_rules('cliente_celular', '', 'trim|max_length[15]|callback_check_celular');
             }

            // com callback
            $this->form_validation->set_rules('cliente_rg_ie', '', 'trim|required|max_length[45]|callback_check_rg_ie');
            $this->form_validation->set_rules('cliente_email', '', 'trim|required|valid_email|max_length[100]|callback_check_email');

            //validation normal
            $this->form_validation->set_rules('cliente_nome', '', 'trim|required|min_length[5]|max_length[45]');
            $this->form_validation->set_rules('cliente_sobrenome', '', 'trim|required|min_length[5]|max_length[100]');
            $this->form_validation->set_rules('cliente_data_nascimento', '', 'required');
            $this->form_validation->set_rules('cliente_telefone', '', 'trim|max_length[15]');
            $this->form_validation->set_rules('cliente_celular', '', 'trim|max_length[15]');
            $this->form_validation->set_rules('cliente_cep', '', 'trim|required|exact_length[9]');
            $this->form_validation->set_rules('cliente_endereco', '', 'trim|required|max_length[100]');
            $this->form_validation->set_rules('cliente_numero_endereco', '', 'trim|max_length[20]');
            $this->form_validation->set_rules('cliente_bairro', '', 'trim|max_length[45]');
            $this->form_validation->set_rules('cliente_complemento', '', 'trim|max_length[100]');
            $this->form_validation->set_rules('cliente_cidade', '', 'trim|required|max_length[50]');
            $this->form_validation->set_rules('cliente_estado', '', 'trim|required|exact_length[2]');
            $this->form_validation->set_rules('cliente_obs', '', 'trim|max_length[200]');

            if($this->form_validation->run()){

                $cliente_ativo = $this->input->post('cliente_ativo');

                if($this->db->table_exists('contas_receber')){

                    if($cliente_ativo == 0 && $this->core_model->get_by_id('contas_receber', array('conta_receber_cliente_id' => $cliente_id, 'conta_receber_status' => 1))){
                            $this->session->set_flashdata('error', 'Este cliente não pode ser desativado esta sendo utilizado em Contas a receber');
                            redirect ('clientes');
                    }
                }

                // array para salvar no banco de dados
                $data = elements(
                    array(
                        'cliente_nome',
                        'cliente_sobrenome',
                        'cliente_obs',
                        'cliente_estado',
                        'cliente_cidade',
                        'cliente_complemento',
                        'cliente_bairro',
                        'cliente_numero_endereco',
                        'cliente_endereco',
                        'cliente_cep',
                        'cliente_celular',
                        'cliente_telefone',
                        'cliente_email',
                        'cliente_rg_ie',
                        'cliente_ativo',
                        'cliente_data_nascimento',
                    ), $this->input->post()
                    );

                if($cliente_tipo == 1)
                    $data['cliente_cpf_cnpj'] = $this->input->post('cliente_cpf');
                else
                    $data['cliente_cpf_cnpj'] = $this->input->post('cliente_cnpj');
                
                // funcao strtooupper salva caixa alta no banco de dados
                $data['cliente_estado'] = strtoupper($this->input->post('cliente_estado'));

                // limpa dados perigosos
                $data = html_escape($data);

                // echo"<pre>";
                // print_r($data);
                // exit();

                // salva no banco de dados
                $this->core_model->update('clientes_tab', $data, array('cliente_id' => $cliente_id));

                redirect('clientes');
            
            }else{

                $data = array(

                    'titulo' => 'Atualizar Clientes',
                   
                    'scripts' => array(
                        'vendor/mask/jquery.mask.min.js',
                        'vendor/mask/app.js'
                    ),
                    'cliente' => $this->core_model->get_by_id('clientes_tab', array('cliente_id' => $cliente_id)),
                );
        
                $this->load->view('layout/header', $data);
                $this->load->view('clientes/edit');
                $this->load->view('layout/footer');

            }

        }

    }

    public function deletar($cliente_id = null){
        if(!$cliente_id || !$this->core_model->get_by_id('clientes_tab', array('cliente_id' => $cliente_id))){
            $this->session->set_flashdata('error', 'Cliente não enontrado!');
            redirect('clientes');
        }else{
            // deletar
            $this->core_model->delete('clientes_tab', array('cliente_id' => $cliente_id));
            redirect('clientes');
        }
    }

    // validação para não cadastrar repetido
    public function check_rg_ie($cliente_rg_ie){
        $cliente_id = $this->input->post('cliente_id');

        if($this->core_model->get_by_id('clientes_tab', array('cliente_rg_ie' => $cliente_rg_ie, 'cliente_id !=' => $cliente_id ))){
            $this->form_validation->set_message('check_rg_ie', 'Este documento já exite');
            return false;
        }else{
            return true;
        }
    }

    // validação para não cadastrar repetido
    public function check_email($cliente_email){
        $cliente_id = $this->input->post('cliente_id');

        if($this->core_model->get_by_id('clientes_tab', array('cliente_email' => $cliente_email, 'cliente_id !=' => $cliente_id ))){
            $this->form_validation->set_message('check_email', 'Este e-mail já exite');
            return false;
        }else{
            return true;
        }
    }

    // validação para não cadastrar repetido
    public function check_telefone($cliente_telefone){
        $cliente_id = $this->input->post('cliente_id');

        if($this->core_model->get_by_id('clientes_tab', array('cliente_telefone' => $cliente_telefone, 'cliente_id !=' => $cliente_id ))){
            $this->form_validation->set_message('check_telefone', 'Este telefone já exite');
            return false;
        }else{
            return true;
        }
    }

    // validação para não cadastrar repetido
    public function check_celular($cliente_celular){
        $cliente_id = $this->input->post('cliente_id');

        if($this->core_model->get_by_id('clientes_tab', array('cliente_celular' => $cliente_celular, 'cliente_id !=' => $cliente_id ))){
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

        if ($this->input->post('cliente_id')) {

            $cliente_id = $this->input->post('cliente_id');

            if ($this->core_model->get_by_id('clientes_tab', array('cliente_id !=' => $cliente_id, 'cliente_cpf_cnpj' => $cnpj))) {
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

    public function valida_cpf($cpf) {

        if ($this->input->post('cliente_id')) {

            $cliente_id = $this->input->post('cliente_id');

            if ($this->core_model->get_by_id('clientes_tab', array('cliente_id !=' => $cliente_id, 'cliente_cpf_cnpj' => $cpf))) {
                $this->form_validation->set_message('valida_cpf', 'Este CPF já existe');
                return FALSE;
            }
        }

        $cpf = str_pad(preg_replace('/[^0-9]/', '', $cpf), 11, '0', STR_PAD_LEFT);
        // Verifica se nenhuma das sequências abaixo foi digitada, caso seja, retorna falso
        if (strlen($cpf) != 11 || $cpf == '00000000000' || $cpf == '11111111111' || $cpf == '22222222222' || $cpf == '33333333333' || $cpf == '44444444444' || $cpf == '55555555555' || $cpf == '66666666666' || $cpf == '77777777777' || $cpf == '88888888888' || $cpf == '99999999999') {

            $this->form_validation->set_message('valida_cpf', 'Por favor digite um CPF válido');
            return FALSE;
        } else {
            // Calcula os números para verificar se o CPF é verdadeiro
            for ($t = 9; $t < 11; $t++) {
                for ($d = 0, $c = 0; $c < $t; $c++) {

                    $d += $cpf[$c] * (($t + 1) - $c); 
                }
                $d = ((10 * $d) % 11) % 10;
                if ($cpf[$c] != $d) {
                    $this->form_validation->set_message('valida_cpf', 'Por favor digite um CPF válido');
                    return FALSE;
                }
            }
            return TRUE;
        }
    }

}