<?php
defined('BASEPATH') OR exit('Ação não permitida');

class Home_model extends CI_model{

    public function get_sum_vendas(){

        $this->db->select([
            'FORMAT(SUM(REPLACE(venda_valor_total, ",", "")), 2) as venda_valor_total',
        ]);

        return $this->db->get('vendas_tab')->row();

    }

    public function get_sum_ordem_servicos(){

        $this->db->select([
            'FORMAT(SUM(REPLACE(ordem_servico_valor_total, ",", "")), 2) as ordem_servico_valor_total',
        ]);

        return $this->db->get('ordens_servicos')->row();

    }

    public function get_sum_receber(){

        $this->db->select([
            'FORMAT(SUM(REPLACE(conta_receber_valor, ",", "")), 2) as conta_receber_valor_total',
        ]);

        $this->db->where('conta_receber_status', 0);

        return $this->db->get('contas_receber')->row();

    }

    public function get_sum_pagar(){

        $this->db->select([
            'FORMAT(SUM(REPLACE(conta_pagar_valor, ",", "")), 2) as conta_pagar_valor_total',
        ]);

        $this->db->where('conta_pagar_status', 0);

        return $this->db->get('contas_pagar')->row();

    }

    public function get_contas_pagar_vencem_hoje(){

        $this->db->select([
           'contas_pagar.*',
           'fornecedor_id',
           'fornecedor_nome_fantasia as fornecedor'
        ]);

        $this->db->where('conta_pagar_status', 0);
        $this->db->where('conta_pagar_data_vencto =', date('Y-m-d'));

        $this->db->join('fornecedores_tab', 'fornecedor_id = conta_pagar_fornecedor_id', 'left');

        return $this->db->get('contas_pagar')->row();

    }

    public function get_contas_receber_vencem_hoje(){

        $this->db->select([
           'contas_receber.*',
           'cliente_id',
           'CONCAT(clientes_tab.cliente_nome, " ", clientes_tab.cliente_sobrenome) as cliente_nome_completo',
        ]);

        $this->db->where('conta_receber_status', 0);
        $this->db->where('conta_receber_data_vencto =', date('Y-m-d'));

        $this->db->join('clientes_tab', 'cliente_id = conta_receber_cliente_id', 'left');

        return $this->db->get('contas_receber')->row();

    }

    public function get_produtos_mais_vendidos(){

        $this->db->select([
            'venda_produtos.*',
            'SUM(venda_produto_quantidade) as vendidos',
            'produtos.produto_id',
            'produtos.produto_descricao'
        ]);

        $this->db->join('produtos', 'produto_id = venda_produto_id_produto', 'left');
        $this->db->limit(3);
        $this->db->group_by('venda_produto_id_produto');
        $this->db->order_by('vendidos', 'desc');

        return $this->db->get('venda_produtos')->result();

    }

    public function get_servicos_mais_vendidos(){

        $this->db->select([
            'ordem_tem_servicos.*',
            'SUM(ordem_ts_quantidade) as vendidos',
            'servicos.servico_id',
            'servicos.servico_nome'
        ]);

        $this->db->join('servicos', 'servico_id = ordem_ts_id_servico', 'left');
        $this->db->limit(3);
        $this->db->group_by('ordem_ts_id_servico');
        $this->db->order_by('vendidos', 'desc');

        return $this->db->get('ordem_tem_servicos')->result();

    }

    public function get_users_desativados(){

        $this->db->where('active', 0);

        return $this->db->get('users')->row();

    }

    public function get_contas_receber_vencidas(){

        $this->db->where('conta_receber_data_vencto <', date('Y-m-d'));
        $this->db->where('conta_receber_status', 0);

        return $this->db->get('contas_receber')->row();

    }

    public function get_contas_pagar_vencidas(){

        $this->db->where('conta_pagar_data_vencto < ', date('Y-m-d'));
        $this->db->where('conta_pagar_status', 0);

        return $this->db->get('contas_pagar')->row();

    }


}