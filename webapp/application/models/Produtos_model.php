<?php
defined('BASEPATH') OR exit('Ação não permitida');

class Produtos_model extends CI_Model{

    public function get_all(){
        $this->db->select([
            'cadastro_produtos.*',
            'cadastro_categorias.cat_titulo',
            'cadastro_subcategorias.scat_titulo',
            'cadastro_marcas.marca_nome',
            'cadastro_produtos_fotos.foto_nome',
            'cadastro_produtos_fotos.foto_id',
            'aux_categoria_produtos.cp_produto'
        ]);

        $this->db->join('aux_categoria_produtos', 'cp_produto = prod_id', 'left');
        $this->db->join('cadastro_categorias', 'cat_id = cp_categoria', 'left');
        $this->db->join('cadastro_subcategorias', 'scat_id = cp_subcategoria', 'left');
        $this->db->join('cadastro_marcas', 'marca_id = prod_marca', 'left');
        $this->db->join('cadastro_produtos_fotos', 'foto_produto_id = prod_id', 'left');

        $this->db->group_by('cadastro_produtos.prod_id');

        return $this->db->get('cadastro_produtos')->result();
    }

    public function get_all_fotos($prod_id = null){
        $this->db->select([
            'cadastro_produtos_fotos.*',
        ]);

        $this->db->where('foto_produto_id', $prod_id);

        return $this->db->get('cadastro_produtos_fotos')->result();
    }


    public function delete_old_produtos($prod_id = null){

        if($prod_id){
            $this->db->delete('cadastro_produtos_fotos', array('foto_produto_id' => $prod_id));
        }
        
    }

    public function get_filter($condicao = NUll){

        $this->db->select([
            'cadastro_produtos.*',
            'cadastro_categorias.cat_titulo',
            'cadastro_subcategorias.scat_titulo',
            'cadastro_marcas.marca_nome',
            'cadastro_produtos_fotos.foto_nome',
            'cadastro_produtos_fotos.foto_id',
            'aux_categoria_produtos.cp_categoria'
        ]);


        $this->db->where($condicao);
        $this->db->join('aux_categoria_produtos', 'cp_produto = prod_id', 'left');
        $this->db->join('cadastro_categorias', 'cat_id = cp_categoria', 'left');
        $this->db->join('cadastro_subcategorias', 'scat_id = cp_subcategoria', 'left');
        $this->db->join('cadastro_marcas', 'marca_id = prod_marca', 'left');
        $this->db->join('cadastro_produtos_fotos', 'foto_produto_id = prod_id', 'left');

        $this->db->order_by('prod_titulo');
        $this->db->group_by('cadastro_produtos.prod_id');

        return $this->db->get('cadastro_produtos')->result();
                    
        
    }

    // public function update($produto_id, $diferenca){

    //     $this->db->set('produto_qtde_estoque', 'produto_qtde_estoque -' . $diferenca, false);
    //     $this->db->where('produto_id', $produto_id);
    //     $this->db->update('produtos');

    // }

}