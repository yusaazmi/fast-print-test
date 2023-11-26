<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once FCPATH . 'vendor/autoload.php';
use GuzzleHttp\Client;

class Page extends CI_Controller 
{
    public function index()
    {
        $this->load->model('Product_model');
        $data['products'] = $this->Product_model->getProductWithDetail();
        $this->load->view('page/layouts/app');
        $this->load->view('page/index',$data);
        $this->load->view('page/layouts/footer');
    }
    public function add()
    {
        $this->load->model('Product_model');
        $this->load->model('Category_model');
        $data['categories'] = $this->Category_model->getAllCategory();
        $this->load->model('Status_model');
        $data['statuses'] = $this->Status_model->getAllStatus();

        $this->load->view('page/layouts/app');
        $this->load->view('page/add',$data);
        $this->load->view('page/layouts/footer');
    }
    
    public function storeData()
    {
        $this->load->model('Product_model');

        $this->load->library('form_validation');
        $this->form_validation->set_rules('name','Nama Produk','required');
        $this->form_validation->set_rules('price','Harga','numeric');
        if ($this->form_validation->run() === FALSE) {
            $this->load->view('page/add');
        } else {
            $data = array(
                'name' => $this->input->post('name'),
                'price' => $this->input->post('price'),
                'category_id' => $this->input->post('category_id'),
                'status_id' => $this->input->post('status_id'),
            );
            $this->Product_model->storeProduct($data);
            echo "<script>alert('Berhasil Tambah Data!');window.location='/fast-print-test';</script>";
        }
    }
    public function getData()
    {
        $client = new Client();
        $currentDateTime = new DateTime();
        // Set the time zone to Asia/Jakarta
        $jakartaTimeZone = new DateTimeZone('Asia/Jakarta');
        $currentDateTime->setTimezone($jakartaTimeZone);
        $currentDateTime->modify('+1 hour');
        $date = $currentDateTime->format('d-m-y');
        $dateNoDash = str_replace('-', '', $date);
        $newTime = $currentDateTime->format('H');
        $username = 'tesprogrammer'.$dateNoDash.'C'.$newTime;
        $password = 'bisacoding-'.$date;
        $data = array(
            'username' => $username,
            'password' => md5($password),
        );

        $api_url = 'https://recruitment.fastprint.co.id/tes/api_tes_programmer';
        try {
            $response = $client->post($api_url,[
                'form_params' => $data
            ]);
            $response = $response->getBody()->getContents();
            $dataArray = json_decode($response, true);
            $apiData = $dataArray['data'];
            $statusNames = ['bisa dijual', 'tidak bisa dijual'];
            foreach($apiData as $d)
            {
                $this->db->where('status_name',$d['status']);
                $statusNumber = $this->db->count_all_results('statuses');
                // check the status db
                if($statusNumber == 0){
                    $dataStatus = array(
                        'status_name' => $d['status']
                    );
                    $this->db->insert('statuses',$dataStatus);
                }
                $this->db->where('category_name',$d['kategori']);
                $categoryNumber = $this->db->count_all_results('categories');
                if($categoryNumber == 0){
                    $dataCategory = array(
                        'category_name' => $d['kategori']
                    );
                    $this->db->insert('categories',$dataCategory);
                }
                $this->db->where('category_name',$d['kategori']);
                $queryCategory = $this->db->get('categories');
                $this->db->where('status_name',$d['status']);
                $queryStatus = $this->db->get('statuses');
                if($queryCategory->num_rows() > 0 && $queryStatus->num_rows() > 0){
                    $resultCategory = $queryCategory->row();
                    $resultStatus = $queryStatus->row();
                    $data = array(
                        'name' => $d['nama_produk'],
                        'price' => $d['harga'],
                        'category_id' => $resultCategory->category_id,
                        'status_id' => $resultStatus->status_id,
                    );
                }
                $this->db->insert('products', $data);
            }
            $this->db->close();
            echo "<script>alert('Berhasil Sync Data!');window.location='/fast-print-test';</script>";
        } catch (\Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function editData($id)
    {
        $this->load->model('Product_model');
        $data['product'] = $this->Product_model->getProductById($id);
        $this->load->model('Category_model');
        $data['categories'] = $this->Category_model->getAllCategory();
        $this->load->model('Status_model');
        $data['statuses'] = $this->Status_model->getAllStatus();
        $this->load->view('page/layouts/app');
        $this->load->view('page/edit',$data);
        $this->load->view('page/layouts/footer');
    }
    public function updateData($id) {
        $this->load->model('Product_model');

        $this->load->library('form_validation');
        $this->form_validation->set_rules('name','Nama Produk','required');
        $this->form_validation->set_rules('price','Harga','numeric');
        if ($this->form_validation->run() === FALSE) {
            $this->load->view('page/edit', $data);
        } else {
            $newData = array(
                'name' => $this->input->post('name'),
                'price' => $this->input->post('price'),
                'category_id' => $this->input->post('category_id'),
                'status_id' => $this->input->post('status_id'),
            );
            $this->Product_model->updateProduct($id, $newData);
            echo "<script>alert('Berhasil Update Data!');window.location='/fast-print-test';</script>";
        }
    }
    public function deleteData($id)
    {
        $this->load->model('Product_model');
        $this->Product_model->deleteProduct($id);
        echo "<script>alert('Berhasil Hapus Data!');window.location='/fast-print-test';</script>";
    }
}