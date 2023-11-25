<?php
defined('BASEPATH') OR exit('Ação não permitida');

class Subcategorias_model extends CI_Model{

    public function get_all(){
        $this->db->select([
            'cadastro_subcategorias.*',
            'cadastro_categorias.cat_titulo',
        ]);

        $this->db->join('cadastro_categorias', 'cat_id = scat_categoria', 'left');

        return $this->db->get('cadastro_subcategorias')->result();
    }

    public function get_by_id($scat_id = null){
        $this->db->select([
            'cadastro_subcategorias.scat_id',
        ]);

        $this->db->join('aux_categoria_produtos', 'cp_subcategoria = scat_id', 'left');
        $this->db->where('cp_subcategoria', $scat_id);

        return $this->db->get('cadastro_subcategorias')->result();
    }


    // public function update($produto_id, $diferenca){

    //     $this->db->set('produto_qtde_estoque', 'produto_qtde_estoque -' . $diferenca, false);
    //     $this->db->where('produto_id', $produto_id);
    //     $this->db->update('produtos');

    // }

}