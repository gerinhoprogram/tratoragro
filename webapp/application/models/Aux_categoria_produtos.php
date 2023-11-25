<?php
defined('BASEPATH') OR exit('Ação não permitida');

class Aux_categoria_produtos extends CI_Model{

    public function get_all(){
        $this->db->select([
            'aux_categoria_produtos.*',
            'cadastro_subcategorias.scat_titulo',
        ]);

        $this->db->join('cadastro_subcategorias', 'scat_id = cp_subcategoria', 'left');

        return $this->db->get('aux_categoria_produtos')->result();
    }

    public function get_all_by_id($prod_id = null){
        $this->db->select([
            'aux_categoria_produtos.*',
            'cadastro_subcategorias.scat_titulo',
            'cadastro_categorias.cat_titulo',
        ]);

        $this->db->where('cp_produto', $prod_id);
        $this->db->join('cadastro_subcategorias', 'scat_id = cp_subcategoria', 'left');
        $this->db->join('cadastro_categorias', 'cat_id = cp_categoria', 'left');

        return $this->db->get('aux_categoria_produtos')->result();
    }

}