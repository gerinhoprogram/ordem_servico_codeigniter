<?php   
    defined('BASEPATH') OR exit('Ação não permitida');

    class Vendas_model extends CI_Model{

        public function get_all(){
            $this->db->select([
                'vendas_tab.*',
                'clientes_tab.cliente_id',
                '(CONCAT(clientes_tab.cliente_nome, " ", clientes_tab.cliente_sobrenome)) as cliente_nome_completo',
                'vendedores.vendedor_id',
                'vendedores.vendedor_nome_completo',
                'formas_pagamentos.forma_pagamento_id',
                'formas_pagamentos.forma_pagamento_nome as forma_pagamento'
            ]);

            $this->db->join('clientes_tab', 'cliente_id = venda_cliente_id', 'left');
            $this->db->join('vendedores', 'vendedor_id = venda_vendedor_id', 'left');
            $this->db->join('formas_pagamentos', 'forma_pagamento_id = venda_forma_pagamento_id', 'left');

            return $this->db->get('vendas_tab')->result();
        }

        public function get_all_produtos_by_venda($venda_id = null){

            if($venda_id){
                $this->db->select([
                    'venda_produtos.*',
                    'produtos.produto_descricao'
                ]);

                $this->db->join('produtos', 'produto_id = venda_produto_id_produto', 'left');
                $this->db->where('venda_produto_id_venda', $venda_id);

                return $this->db->get('venda_produtos')->result();
            }

        }

        public function delete_old_produtos($venda_id = null){

            if($venda_id){
                $this->db->delete('venda_produtos', array('venda_produto_id_venda' => $venda_id));
            }
            
        }

        public function get_by_id($venda_id = null){
            $this->db->select([
                'vendas_tab.*',
                'clientes_tab.cliente_id',
                'clientes_tab.cliente_sobrenome',
                'clientes_tab.cliente_telefone',
                'CONCAT(clientes_tab.cliente_nome, " ", clientes_tab.cliente_sobrenome) as cliente_nome_completo',
                'formas_pagamentos.forma_pagamento_id',
                'formas_pagamentos.forma_pagamento_nome as forma_pagamento',
            ]);
            
         
            $this->db->where('venda_id', $venda_id);
            $this->db->join('clientes_tab', 'cliente_id = venda_cliente_id', 'left');
            $this->db->join('vendedores', 'vendedor_id = venda_vendedor_id', 'left');
            $this->db->join('formas_pagamentos', 'forma_pagamento_id = venda_forma_pagamento_id', 'left');

            return $this->db->get('vendas_tab')->row();
        }

        // utilizado em vendas pdf
        public function get_all_produtos($venda_id = null){

            if($venda_id){

                $this->db->select([
                    'venda_produtos.*',
                    'FORMAT(SUM(REPLACE(venda_produto_valor_unitario, ",", "")), 2) as venda_produto_valor_unitario',
                    'FORMAT(SUM(REPLACE(venda_produto_valor_total, ",", "")), 2) as venda_produto_valor_total',
                    'FORMAT(SUM(REPLACE(venda_produto_valor_total, ",", "")), 2) as venda_valor_total',
                    'produtos.produto_id',
                    'produtos.produto_descricao'
                ]);

                $this->db->join('produtos', 'produto_id = venda_produto_id_produto', 'left');
                $this->db->where('venda_produto_id_venda', $venda_id);
                $this->db->group_by('venda_produto_id_produto');

                return $this->db->get('venda_produtos')->result();

            }

        }

        // utilizado em vendas pdf
        public function valor_final_venda($venda_id = null){

            if($venda_id){
            
                $this->db->select([
                    'FORMAT(SUM(REPLACE(venda_produto_valor_total, ",", "")), 2) as venda_valor_total',
                ]);

                $this->db->join('produtos', 'produto_id = venda_produto_id_produto', 'left');
                $this->db->where('venda_produto_id_venda', $venda_id);
            
            }
            return $this->db->get('venda_produtos')->row();
        }

        //usado em relatorio vendas
        public function gerar_relatorio_vendas($data_inicial = null, $data_final = null){

            $this->db->select([
                'vendas_tab.*',
                'clientes_tab.cliente_id',
                'CONCAT(clientes_tab.cliente_nome, " ", clientes_tab.cliente_sobrenome) as cliente_nome_completo',
                'formas_pagamentos.forma_pagamento_id',
                'formas_pagamentos.forma_pagamento_nome as forma_pagamento',
            ]);

            $this->db->join('clientes_tab', 'cliente_id = venda_cliente_id', 'left');
            $this->db->join('formas_pagamentos', 'forma_pagamento_id = venda_forma_pagamento_id', 'left');

            // SUBSTR -> captura os caracteres entre os numeros 12-12-2012
            if($data_inicial && $data_final){
                $this->db->where("
                    substr(venda_data_emissao, 1, 10) >= '$data_inicial' and 
                    substr(venda_data_emissao, 1, 10) <= '$data_final'
                ");
            }else{
                $this->db->where("
                    substr(venda_data_emissao, 1, 10) >= '$data_inicial'
                ");
            }

            return $this->db->get('vendas_tab')->result();

        }

        public function get_valor_final_relatorio($data_inicial = null, $data_final = null){

            $this->db->select([
                'FORMAT(SUM(REPLACE(venda_valor_total, ",", "")), 2) as venda_valor_total',
            ]);

            if($data_inicial && $data_final){
                $this->db->where("
                    substr(venda_data_emissao, 1, 10) >= '$data_inicial' and 
                    substr(venda_data_emissao, 1, 10) <= '$data_final'
                ");
            }else{
                $this->db->where("
                    substr(venda_data_emissao, 1, 10) >= '$data_inicial'
                ");
            }

            return $this->db->get('vendas_tab')->row();

        }
    }