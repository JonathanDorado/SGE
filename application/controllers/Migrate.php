<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migrate extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }
    function make_base(){
        
            $this->load->library('VpxMigration');
        
            // All Tables:
        
            $this->vpxmigration->generate();
        
    }
    public function migrate()
    {
            $this->load->library('migration');
            var_dump($this->migration->current());
            if ($this->migration->current() === FALSE)
            {
                    show_error($this->migration->error_string());
            }
    }
}