<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Statuses extends CI_Migration {

        public function up()
        {
                $this->dbforge->add_field(array(
                        'status_id' => array(
                                'type' => 'INT',
                                'constraint' => 5,
                                'unsigned' => TRUE,
                                'auto_increment' => TRUE
                        ),
                        'status_name' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '100',
                        ),
                ));
                $this->dbforge->add_key('status_id', TRUE);
                $this->dbforge->create_table('statuses');
        }

        public function down()
        {
                $this->dbforge->drop_table('statuses');
        }
}