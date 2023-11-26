<?php

class Category_model extends CI_Model {
    public function getAllCategory() {
        return $this->db->get('categories')->result();
    }

    public function get_products_by_category($category_id) {
        return $this->db
            ->where('category_id', $category_id)
            ->get('products')
            ->result();
    }
}