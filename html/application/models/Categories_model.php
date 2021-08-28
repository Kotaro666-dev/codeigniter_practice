<?php
    class Categories_model extends CI_Model {
        public function get_categories(){
            $this->db->order_by('name');
            $query = $this->db->get('categories');
            return $query->result_array();
        }
    }