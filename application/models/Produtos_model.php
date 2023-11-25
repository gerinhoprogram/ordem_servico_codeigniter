<?php
defined('BASEPATH') OR exit('Ação não permitida');

class Produtos_model extends CI_Model{

    public function get_all(){
        $this->db->select([
            'produtos.*',
            'categorias.categoria_id',
            'categorias.categoria_nome as produto_categoria',
            'marcas.marca_id',
            'marcas.marca_nome as produto_marca',
            'fornecedores_tab.fornecedor_id',
            'fornecedores_tab.fornecedor_nome_fantasia as produto_fornecedor',
        ]);

        $this->db->join('categorias', 'categoria_id = produto_categoria_id', 'left');
        $this->db->join('marcas', 'marca_id = produto_marca_id', 'left');
        $this->db->join('fornecedores_tab', 'fornecedor_id = produto_fornecedor_id', 'left');

        return $this->db->get('produtos')->result();
    }

    public function update($produto_id, $diferenca){

        $this->db->set('produto_qtde_estoque', 'produto_qtde_estoque -' . $diferenca, false);
        $this->db->where('produto_id', $produto_id);
        $this->db->update('produtos');

    }

}