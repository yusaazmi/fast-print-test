<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Products extends CI_Migration {

        public function up()
        {
                $this->dbforge->add_field(array(
                        'product_id' => array(
                                'type' => 'INT',
                                'constraint' => 5,
                                'unsigned' => TRUE,
                                'auto_increment' => TRUE
                        ),
                        'name' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '100',
                        ),
                        'price' => array(
                                'type' => 'FLOAT',
                                'constraint' => '20',
                        ),
                        'category_id' => array(
                            'type' => 'INT',
                            'constraint' => 5,
                            'unsigned' => TRUE,
                            'auto_increment' => FALSE
                        ),
                        'status_id' => array(
                            'type' => 'INT',
                            'constraint' => 5,
                            'unsigned' => TRUE,
                            'auto_increment' => FALSE
                        ),
                ));
                $this->dbforge->add_key('product_id', TRUE);
                $this->dbforge->add_field('CONSTRAINT FOREIGN KEY (category_id) REFERENCES categories(category_id)');
                $this->dbforge->add_field('CONSTRAINT FOREIGN KEY (status_id) REFERENCES statuses(status_id)');
                // $this->dbforge->add_foreign_key('category_id', 'categories','category_id');
                // $this->dbforge->add_foreign_key('status_id', 'statuses','status_id');
                $this->dbforge->create_table('products');
        }

        public function down()
        {
                $this->dbforge->drop_table('products');
        }
}