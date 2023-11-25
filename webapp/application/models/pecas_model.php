<?php
defined('BASEPATH') OR exit('Ação não permitida');

class Pecas_model extends CI_Model{

    public function get_all(){
        $this->db->select([
            'cadastro_pecas.*',
            'cadastro_marcas.marca_nome',
        ]);

        $this->db->join('cadastro_marcas', 'marca_id = peca_marca', 'left');

        return $this->db->get('cadastro_pecas')->result();
    }

    public function get_filter($condicao = NUll){

        $this->db->select([
            'cadastro_pecas.*',
            'cadastro_marcas.marca_nome',
        ]);


        $this->db->where($condicao);
        $this->db->join('cadastro_marcas', 'marca_id = peca_marca', 'left');
        $this->db->order_by('peca_nome');

        return $this->db->get('cadastro_pecas')->result();
                    
        
    }

}