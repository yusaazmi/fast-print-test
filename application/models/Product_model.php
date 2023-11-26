<?php


class Product_model extends CI_Model {
    public function getProductWithDetail() {
        $this->db->select('products.*, statuses.status_name, categories.category_name');
        $this->db->from('products');
        $this->db->join('statuses', 'products.status_id = statuses.status_id', 'left');
        $this->db->join('categories', 'products.category_id = categories.category_id', 'left');
        $this->db->order_by('products.product_id', 'asc');
        $this->db->where('statuses.status_name','bisa dijual');
        
        return $this->db->get()->result();
    }

    public function getProductById($id) {
        return $this->db->get_where('products', array('product_id' => $id))->row();
    }
    public function storeProduct($data){
        $this->db->insert('products', $data);
    }
    public function updateProduct($id, $data) {
        $this->db->where('product_id', $id);
        $this->db->update('products', $data);
    }
    public function deleteProduct($id){
        $this->db->delete('products', array('product_id' => $id));
    }   
}