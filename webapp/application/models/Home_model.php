<?php
defined('BASEPATH') OR exit('Ação não permitida');

class Home_model extends CI_model{

    public function get_cont_marcas(){

        $this->db->select([
            'COUNT(marca_id) as soma',
        ]);

        return $this->db->get('cadastro_marcas')->row();

    }

    public function get_cont_categorias(){

        $this->db->select([
            'COUNT(cat_id) as soma',
        ]);

        return $this->db->get('cadastro_categorias')->row();

    }

    public function get_cont_pecas(){

        $this->db->select([
            'COUNT(peca_id) as soma',
        ]);

        return $this->db->get('cadastro_pecas')->row();

    }

    public function get_cont_subcategorias(){

        $this->db->select([
            'COUNT(scat_id) as soma',
        ]);

        return $this->db->get('cadastro_subcategorias')->row();

    }

    public function get_cont_produtos(){

        $this->db->select([
            'COUNT(prod_id) as soma',
        ]);

        return $this->db->get('cadastro_produtos')->row();

    }

    public function get_emails_recebidos(){
        $data = date('Y-m-d', strtotime("-1 days"));
        $this->db->select([
           'envia_formulario.*'
        ]);

        $this->db->where('contato_data >=', $data);

        return $this->db->get('envia_formulario')->row();

    }

    public function get_emails_produtos(){
        $data = date('Y-m-d', strtotime("-1 days"));
        $this->db->select([
           'formulario_produto.*'
        ]);

        $this->db->where('contato_data >=', $data);

        return $this->db->get('formulario_produto')->row();

    }

}