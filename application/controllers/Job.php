<?php
class Job extends CI_Controller{
    public function __construct() {
        parent::__construct();
        $this->load->model('events_model', 'Events');

    }
    
    function closeEvents(){
        $current_date = strtotime(date("Y-m-d"));
        $events = $this->db->query("select * from events");
        foreach($events->result() as $key => $event) {
            $event_finished_date = strtotime($event->date_until);
            if ($current_date > $event_finished_date) {
                //modify event
            }
        }
        
    }
}
