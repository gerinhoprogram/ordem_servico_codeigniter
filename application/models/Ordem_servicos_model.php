<?php   
    defined('BASEPATH') OR exit('Ação não permitida');

    class Ordem_servicos_model extends CI_Model{

        public function get_all(){
            $this->db->select([
                'ordens_servicos.*',
                'clientes_tab.cliente_id',
                'clientes_tab.cliente_nome',
                'formas_pagamentos.forma_pagamento_id',
                'formas_pagamentos.forma_pagamento_nome as forma_pagamento'
            ]);

            $this->db->join('clientes_tab', 'cliente_id = ordem_servico_cliente_id', 'left');
            $this->db->join('formas_pagamentos', 'forma_pagamento_id = ordem_servico_forma_pagamento_id', 'left');

            return $this->db->get('ordens_servicos')->result();
        }

        public function get_all_servicos_by_ordem($ordem_servico_id = null){
            if($ordem_servico_id){
                $this->db->select([
                    'ordem_tem_servicos.*',
                    'servicos.servico_descricao'
                ]);

                $this->db->join('servicos', 'servico_id = ordem_ts_id_servico', 'left');
                $this->db->where('ordem_ts_id_ordem_servico', $ordem_servico_id);

                return $this->db->get('ordem_tem_servicos')->result();
            }
        }

        public function delete_old_services($ordem_servico_id = null){
            if($ordem_servico_id){
                $this->db->delete('ordem_tem_servicos', array('ordem_ts_id_servico' => $ordem_servico_id));
            }
        }

        public function get_by_id($ordem_servico_id = null){
            $this->db->select([
                'ordens_servicos.*',
                'clientes_tab.cliente_id',
                'clientes_tab.cliente_nome',
                'clientes_tab.cliente_sobrenome',
                'clientes_tab.cliente_telefone',
                'CONCAT(clientes_tab.cliente_nome, " ", clientes_tab.cliente_sobrenome) as cliente_nome_completo',
                'formas_pagamentos.forma_pagamento_id',
                'formas_pagamentos.forma_pagamento_nome as forma_pagamento',
            ]);
            
         
            $this->db->where('ordem_servico_id', $ordem_servico_id);
         
         
            $this->db->join('clientes_tab', 'cliente_id = ordem_servico_cliente_id', 'LEFT');
            $this->db->join('formas_pagamentos', 'forma_pagamento_id = ordem_servico_forma_pagamento_id', 'LEFT');
         
            return $this->db->get('ordens_servicos')->row();
        }

        public function get_all_services($ordem_servico_id = null){

            if($ordem_servico_id){

                $this->db->select([
                    'ordem_tem_servicos.*',
                    'FORMAT(SUM(REPLACE(ordem_ts_valor_unitario, ",", "")), 2) as ordem_ts_valor_unitario',
                    'FORMAT(SUM(REPLACE(ordem_ts_valor_total, ",", "")), 2) as ordem_ts_valor_total',
                    'servicos.servico_id',
                    'servicos.servico_nome'
                ]);

                $this->db->join('servicos', 'servico_id = ordem_ts_id_servico', 'left');
                $this->db->where('ordem_ts_id_ordem_servico', $ordem_servico_id);
                $this->db->group_by('ordem_ts_id_servico');

                return $this->db->get('ordem_tem_servicos')->result();

            }

        }

        public function valor_final_os($ordem_servico_id = null){

            if($ordem_servico_id){
            
                $this->db->select([
                    'FORMAT(SUM(REPLACE(ordem_ts_valor_total, ",", "")), 2) as os_valor_total',
                ]);

                $this->db->join('servicos', 'servico_id = ordem_ts_id_servico', 'left');
                $this->db->where('ordem_ts_id_ordem_servico', $ordem_servico_id);
            
            }
            return $this->db->get('ordem_tem_servicos')->row();
        }

         //usado em relatorio os
         public function gerar_relatorio_os($data_inicial = null, $data_final = null){

            $this->db->select([
                'ordens_servicos.*',
                'clientes_tab.cliente_id',
                'CONCAT(clientes_tab.cliente_nome, " ", clientes_tab.cliente_sobrenome) as cliente_nome_completo',
                'formas_pagamentos.forma_pagamento_id',
                'formas_pagamentos.forma_pagamento_nome as forma_pagamento',
            ]);

            $this->db->join('clientes_tab', 'cliente_id = ordem_servico_cliente_id', 'left');
            $this->db->join('formas_pagamentos', 'forma_pagamento_id = ordem_servico_forma_pagamento_id', 'left');

            // SUBSTR -> captura os caracteres entre os numeros 12-12-2012
            if($data_inicial && $data_final){
                $this->db->where("
                    substr(ordem_servico_data_emissao, 1, 10) >= '$data_inicial' and 
                    substr(ordem_servico_data_emissao, 1, 10) <= '$data_final'
                ");
            }else{
                $this->db->where("
                    substr(ordem_servico_data_emissao, 1, 10) >= '$data_inicial'
                ");
            }

            return $this->db->get('ordens_servicos')->result();

        }

        public function get_valor_final_relatorio($data_inicial = null, $data_final = null){

            $this->db->select([
                'FORMAT(SUM(REPLACE(ordem_servico_valor_total, ",", "")), 2) as ordem_servico_valor_total',
            ]);

            if($data_inicial && $data_final){
                $this->db->where("
                    substr(ordem_servico_data_emissao, 1, 10) >= '$data_inicial' and 
                    substr(ordem_servico_data_emissao, 1, 10) <= '$data_final'
                ");
            }else{
                $this->db->where("
                    substr(ordem_servico_data_emissao, 1, 10) >= '$data_inicial'
                ");
            }

            return $this->db->get('ordens_servicos')->row();

        }
    }