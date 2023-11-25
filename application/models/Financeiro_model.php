<?php
defined('BASEPATH') OR exit('Ação não permitida');

class Financeiro_model extends CI_Model{

    public function __construct(){
        parent:: __construct();

        //se não estiver logado volta para login
        if(!$this->ion_auth->logged_in()){
            redirect ('login');
        }
    }

    public function get_all_pagar(){

        $this->db->select([
            'contas_pagar.*',
            'fornecedor_id',
            'fornecedor_nome_fantasia as fornecedor'
            ]);

        $this->db->join(
            'fornecedores_tab', 'fornecedor_id = conta_pagar_fornecedor_id', 'left'
        );

        return $this->db->get('contas_pagar')->result();

    }

    public function get_all_receber(){

        $this->db->select([
            'contas_receber.*',
            'cliente_id',
            'cliente_nome'
            ]);

        $this->db->join(
            'clientes_tab', 'cliente_id = conta_receber_cliente_id', 'left'
        );

        return $this->db->get('contas_receber')->result();

    }

    public function get_contas_receber_relatorio($conta_receber_status = null, $data_vencimento = null){

        $this->db->select([
            'contas_receber.*',
            'cliente_id',
            'cliente_nome'
            ]);

        $this->db->where(
            'conta_receber_status', $conta_receber_status
        );

        if($data_vencimento){
            
            date_default_timezone_set('America/Fortaleza');

            $this->db->where(
                'conta_receber_data_vencto < ', date('y-m-d')
            );
        }

         $this->db->join(
            'clientes_tab', 'cliente_id = conta_receber_cliente_id', 'left'
        );

        return $this->db->get('contas_receber')->result();

    }

    public function get_sum_contas_receber_relatorio($conta_receber_status = null, $data_vencimento = null){

        $this->db->select([
            'FORMAT(SUM(REPLACE(conta_receber_valor, ",", "")), 2) as conta_receber_valor_total',
        ]);

        $this->db->where(
            'conta_receber_status', $conta_receber_status
        );

        if($data_vencimento){
            
            date_default_timezone_set('America/Fortaleza');

            $this->db->where(
                'conta_receber_data_vencto < ', date('y-m-d')
            );
        }

         $this->db->join(
            'clientes_tab', 'cliente_id = conta_receber_cliente_id', 'left'
        );

        return $this->db->get('contas_receber')->row();

    }

    public function get_contas_pagar_relatorio($conta_pagar_status = null, $data_vencimento = null){

        $this->db->select([
            'contas_pagar.*',
            'fornecedor_id',
            'fornecedor_nome_fantasia',
            'fornecedor_cnpj'
            ]);

        $this->db->where(
            'conta_pagar_status', $conta_pagar_status
        );

        if($data_vencimento){
            
            date_default_timezone_set('America/Fortaleza');

            $this->db->where(
                'conta_pagar_data_vencto < ', date('y-m-d')
            );
        }

         $this->db->join(
            'fornecedores_tab', 'fornecedor_id = conta_pagar_fornecedor_id', 'left'
        );

        return $this->db->get('contas_pagar')->result();

    }

    public function get_sum_contas_pagar_relatorio($conta_pagar_status = null, $data_vencimento = null){

        $this->db->select([
            'FORMAT(SUM(REPLACE(conta_pagar_valor, ",", "")), 2) as conta_pagar_valor_total',
        ]);

        $this->db->where(
            'conta_pagar_status', $conta_pagar_status
        );

        if($data_vencimento){
            
            date_default_timezone_set('America/Fortaleza');

            $this->db->where(
                'conta_pagar_data_vencto < ', date('y-m-d')
            );
        }

         $this->db->join(
            'fornecedores_tab', 'fornecedor_id = conta_pagar_fornecedor_id', 'left'
        );

        return $this->db->get('contas_pagar')->row();

    }

}