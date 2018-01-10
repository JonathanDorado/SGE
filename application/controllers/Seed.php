<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
class Seed extends CI_Controller{

    public function __construct(){
        parent::__construct();
        //$this->faker = Faker\Factory::create();
        // load any required models
        $this->load->model('users_model', 'User');
    }
    
    function seed(){

        // seed users
        echo "users";
        echo PHP_EOL;
        $this->seed_users();

        // call more seeds here...
        echo "profiles";
        echo PHP_EOL;
        $this->seed_profiles();
        echo "permissions";
        echo PHP_EOL;
        $this->seed_permissions();
        echo "profile permissions";
        echo PHP_EOL;
        $this->seed_profile_permissions();
        echo "states";
        echo PHP_EOL;
        $this->seed_states();
        echo "thematic area types";
        echo PHP_EOL;
        $this->seed_thematic_area_types();
        echo "topics";
        echo PHP_EOL;
        $this->seed_topics();
        echo "provider types";
        echo PHP_EOL;
        $this->seed_provider_types();
        echo "answers_groups";
        echo PHP_EOL;
        $this->seed_answers_groups();
        echo "answer_options";
        echo PHP_EOL;
        $this->seed_answer_options();
        echo "answer_types";
        echo PHP_EOL;
        $this->seed_answer_types();
        echo "areas";
        echo PHP_EOL;
        $this->seed_areas();
        echo "arl";
        echo PHP_EOL;
        $this->seed_arl();
        echo "cities";
        echo PHP_EOL;
        $this->seed_cities();
        echo "client_types";
        echo PHP_EOL;
        $this->seed_client_types();
        echo "consultant_clasifications";
        echo PHP_EOL;
        $this->seed_consultant_clasifications();
        echo "countries";
        echo PHP_EOL;
        $this->seed_countries();
        echo "document_types";
        echo PHP_EOL;
        $this->seed_document_types();
        echo "event_assistance_types";
        echo PHP_EOL;
        $this->seed_event_assistance_types();
        echo "event_audience_types";
        echo PHP_EOL;
        $this->seed_event_audience_types();
        echo "event_types";
        echo PHP_EOL;
        $this->seed_event_types();
        echo "payment_types";
        echo PHP_EOL;
        $this->seed_payment_types();
        echo "training_types";
        echo PHP_EOL;
        $this->seed_training_types();
        echo "training_platforms";
        echo PHP_EOL;
        $this->seed_training_platforms();
        echo "provider_types";
        echo PHP_EOL;
        $this->seed_provider_types();
       
    }

    function seed_users(){

        $this->db->truncate('users');
        $users['super'] = array(
            'user_id' => '1',
            'name' => 'Super',
            'lastname' => 'Admin',
            'email' => 'superadmin@ccs.org.co',
            'password' => '7c222fb2927d828af22f592134e8932480637c0d',
            'remember_token' => null,
            'profile_id' => 1,
            'created_at' => '2017-07-16 22:34:01',
            'updated_at' => '2017-07-16 22:34:01',
            'active' => true
        );
        $users['gestor'] = array(
            'user_id' => '2',
            'name' => 'Gestor',
            'lastname' => 'Eventos',
            'email' => 'supergestoreventosadmin@ccs.org.co',
            'password' => '7c222fb2927d828af22f592134e8932480637c0d',
            'remember_token' => null,
            'profile_id' => 3,
            'created_at' => '2017-07-16 22:34:01',
            'updated_at' => '2017-07-16 22:34:01',
            'active' => true
        );
        $users['analista'] = array(
            'user_id' => '3',
            'name' => 'Analista',
            'lastname' => 'Información',
            'email' => 'analista@ccs.org.co',
            'password' => '7c222fb2927d828af22f592134e8932480637c0d',
            'remember_token' => null,
            'profile_id' => 7,
            'created_at' => '2017-07-16 22:34:01',
            'updated_at' => '2017-07-16 22:34:01',
            'active' => true
        );
        $users['mercadeo'] = array(
            'user_id' => '4',
            'name' => 'Mercadeo',
            'lastname' => 'Comercial',
            'email' => 'mercadeo@ccs.org.co',
            'password' => '7c222fb2927d828af22f592134e8932480637c0d',
            'remember_token' => null,
            'profile_id' => 6,
            'created_at' => '2017-07-16 22:34:01',
            'updated_at' => '2017-07-16 22:34:01',
            'active' => true
        );
        $users['administrador'] = array(
            'user_id' => '5',
            'name' => 'Administrador',
            'lastname' => 'CCS',
            'email' => 'admin@ccs.org.co',
            'password' => '7c222fb2927d828af22f592134e8932480637c0d',
            'remember_token' => null,
            'profile_id' => 2,
            'created_at' => '2017-07-16 22:34:01',
            'updated_at' => '2017-07-16 22:34:01',
            'active' => true
        );
        $users['asesor'] = array(
            'user_id' => '6',
            'name' => 'Asesor',
            'lastname' => 'Evento',
            'email' => 'asesor@ccs.org.co',
            'password' => '7c222fb2927d828af22f592134e8932480637c0d',
            'remember_token' => null,
            'profile_id' => 8,
            'created_at' => '2017-07-16 22:34:01',
            'updated_at' => '2017-07-16 22:34:01',
            'active' => true
        );
        $users['evad'] = array(
            'user_id' => '7',
            'name' => 'EVAD',
            'lastname' => 'Gestor',
            'email' => 'evad@ccs.org.co',
            'password' => 'c129b324aee662b04eccf68babba85851346dff9',
            'remember_token' => null,
            'profile_id' => 5,
            'created_at' => '2017-07-16 22:34:01',
            'updated_at' => '2017-07-16 22:34:01',
            'active' => true
        );
        foreach ($users as $user => $value){
            $this->db->insert('users', $value);
            echo ".";
        }
 
        echo PHP_EOL;
    }

    function seed_profiles(){
        
                $this->db->truncate('profiles');
                $profiles['Superadministrador'] = array(
                    'profile_id' => 1,
                    'name' => 'Superadministrador',
                    'created_at' => '2017-07-16 22:34:01',
                    'updated_at' => '2017-07-16 22:34:01',
                    'active' => true
                );
                $profiles['Administrador'] = array(
                    'profile_id' => 2,
                    'name' => 'Administrador',
                    'created_at' => '2017-07-16 22:34:01',
                    'updated_at' => '2017-07-16 22:34:01',
                    'active' => true
                );
                $profiles['Gestor de Eventos'] = array(
                    'profile_id' => 3,
                    'name' => 'Gestor de Eventos',
                    'created_at' => '2017-07-16 22:34:01',
                    'updated_at' => '2017-07-16 22:34:01',
                    'active' => true
                );
                $profiles['ClienteFinal'] = array(
                    'profile_id' => 4,
                    'name' => 'Cliente Final',
                    'created_at' => '2017-07-16 22:34:01',
                    'updated_at' => '2017-07-16 22:34:01',
                    'active' => true
                );
                $profiles['EVAD'] = array(
                    'profile_id' => 5,
                    'name' => 'EVAD',
                    'created_at' => '2017-07-16 22:34:01',
                    'updated_at' => '2017-07-16 22:34:01',
                    'active' => true
                );
                $profiles['Mercadeo/Comercial'] = array(
                    'profile_id' => 6,
                    'name' => 'Mercadeo/Comercial',
                    'created_at' => '2017-07-16 22:34:01',
                    'updated_at' => '2017-07-16 22:34:01',
                    'active' => true
                );
                $profiles['Analista de Información'] = array(
                    'profile_id' => 7,
                    'name' => 'Analista de Información',
                    'created_at' => '2017-07-16 22:34:01',
                    'updated_at' => '2017-07-16 22:34:01',
                    'active' => true
                );
                $profiles['Asesor Evento'] = array(
                    'profile_id' => 8,
                    'name' => 'Asesor Evento',
                    'created_at' => '2017-07-16 22:34:01',
                    'updated_at' => '2017-07-16 22:34:01',
                    'active' => true
                );
                foreach ($profiles as $profile => $value){
                    $this->db->insert('profiles', $value);
                    echo ".";
                }
         
                echo PHP_EOL;
            }
    function seed_permissions(){
        $this->db->truncate('permissions');
        $permissions = array(
            array( // row #0
                'permission_id' => 1,
                'name' => 'DASHBOARD_PLATFORM',
                'created_at' => '2017-08-09 10:51:34',
                'updated_at' => '0000-00-00 00:00:00',
                'active' => 1,
            ),
            array( // row #1
                'permission_id' => 2,
                'name' => 'CREATE_EVENTS',
                'created_at' => '2017-08-09 10:51:39',
                'updated_at' => '0000-00-00 00:00:00',
                'active' => 1,
            ),
            array( // row #2
                'permission_id' => 3,
                'name' => 'VIEW_EVENTS',
                'created_at' => '2017-08-09 10:51:44',
                'updated_at' => '0000-00-00 00:00:00',
                'active' => 1,
            ),
            array( // row #3
                'permission_id' => 4,
                'name' => 'EDIT_EVENTS',
                'created_at' => '2017-08-09 10:51:49',
                'updated_at' => '0000-00-00 00:00:00',
                'active' => 1,
            ),
            array( // row #4
                'permission_id' => 5,
                'name' => 'INVITE_EVENT',
                'created_at' => '2017-08-09 10:51:54',
                'updated_at' => '0000-00-00 00:00:00',
                'active' => 1,
            ),
            array( // row #5
                'permission_id' => 6,
                'name' => 'PRE_REGISTER_EVENT',
                'created_at' => '2017-08-09 10:52:01',
                'updated_at' => '0000-00-00 00:00:00',
                'active' => 1,
            ),
            array( // row #6
                'permission_id' => 7,
                'name' => 'CONFIRM_EVENT',
                'created_at' => '2017-08-09 10:52:07',
                'updated_at' => '0000-00-00 00:00:00',
                'active' => 1,
            ),
            array( // row #7
                'permission_id' => 8,
                'name' => 'ASSISTANCE_EVENT',
                'created_at' => '2017-08-09 10:52:12',
                'updated_at' => '0000-00-00 00:00:00',
                'active' => 1,
            ),
            array( // row #8
                'permission_id' => 9,
                'name' => 'ASSIGN_TOPICS',
                'created_at' => '2017-08-09 10:52:18',
                'updated_at' => '0000-00-00 00:00:00',
                'active' => 1,
            ),
            array( // row #9
                'permission_id' => 10,
                'name' => 'ASSIGN_SURVEY',
                'created_at' => '2017-08-09 10:52:24',
                'updated_at' => '0000-00-00 00:00:00',
                'active' => 1,
            ),
            array( // row #10
                'permission_id' => 11,
                'name' => 'DASHBOARD_EVENT',
                'created_at' => '2017-08-09 10:52:31',
                'updated_at' => '0000-00-00 00:00:00',
                'active' => 1,
            ),
            array( // row #11
                'permission_id' => 12,
                'name' => 'VIEW_TOPICS',
                'created_at' => '2017-08-09 10:52:38',
                'updated_at' => '0000-00-00 00:00:00',
                'active' => 1,
            ),
            array( // row #12
                'permission_id' => 13,
                'name' => 'CREATE_TOPIC',
                'created_at' => '2017-08-09 10:52:43',
                'updated_at' => '0000-00-00 00:00:00',
                'active' => 1,
            ),
            array( // row #13
                'permission_id' => 14,
                'name' => 'EDIT_TOPIC',
                'created_at' => '2017-08-09 10:52:50',
                'updated_at' => '0000-00-00 00:00:00',
                'active' => 1,
            ),
            array( // row #14
                'permission_id' => 15,
                'name' => 'VIEW_PROVIDERS',
                'created_at' => '2017-08-09 10:52:56',
                'updated_at' => '0000-00-00 00:00:00',
                'active' => 1,
            ),
            array( // row #15
                'permission_id' => 16,
                'name' => 'CREATE_PROVIDERS',
                'created_at' => '2017-08-09 10:53:02',
                'updated_at' => '0000-00-00 00:00:00',
                'active' => 1,
            ),
            array( // row #16
                'permission_id' => 17,
                'name' => 'EDIT_PROVIDERS',
                'created_at' => '2017-08-09 10:53:07',
                'updated_at' => '0000-00-00 00:00:00',
                'active' => 1,
            ),
            array( // row #17
                'permission_id' => 18,
                'name' => 'VIEW_CLIENTS',
                'created_at' => '2017-08-09 10:53:14',
                'updated_at' => '0000-00-00 00:00:00',
                'active' => 1,
            ),
            array( // row #18
                'permission_id' => 19,
                'name' => 'CREATE_CLIENTS',
                'created_at' => '2017-08-09 10:53:19',
                'updated_at' => '0000-00-00 00:00:00',
                'active' => 1,
            ),
            array( // row #19
                'permission_id' => 20,
                'name' => 'EDIT_CLIENTS',
                'created_at' => '2017-08-09 10:53:25',
                'updated_at' => '0000-00-00 00:00:00',
                'active' => 1,
            ),
            array( // row #20
                'permission_id' => 21,
                'name' => 'VIEW_USERS',
                'created_at' => '2017-08-09 10:53:31',
                'updated_at' => '0000-00-00 00:00:00',
                'active' => 1,
            ),
            array( // row #21
                'permission_id' => 22,
                'name' => 'CREATE_USERS',
                'created_at' => '2017-08-09 10:53:35',
                'updated_at' => '0000-00-00 00:00:00',
                'active' => 1,
            ),
            array( // row #22
                'permission_id' => 23,
                'name' => 'EDIT_USERS',
                'created_at' => '2017-08-09 10:53:37',
                'updated_at' => '0000-00-00 00:00:00',
                'active' => 1,
            ),
        );
        foreach ($permissions as $permission => $value){
            $this->db->insert('permissions', $value);
            echo ".";
        }
 
        echo PHP_EOL;
    }

    function seed_profile_permissions(){
        $this->db->truncate('profile_permissions');
        $profile_permissions = array(
            array( // row #0
                'profile_permission_id' => 1,
                'profile_id' => 1,
                'permission_id' => 1,
                'created_at' => '2017-08-09 11:50:07',
                'updated_at' => '2017-08-09 11:50:10',
                'active' => 1,
            ),
            array( // row #1
                'profile_permission_id' => 2,
                'profile_id' => 1,
                'permission_id' => 2,
                'created_at' => '2017-08-09 11:50:11',
                'updated_at' => '2017-08-09 11:50:14',
                'active' => 1,
            ),
            array( // row #2
                'profile_permission_id' => 3,
                'profile_id' => 1,
                'permission_id' => 3,
                'created_at' => '2017-08-09 11:50:15',
                'updated_at' => '2017-08-09 11:50:46',
                'active' => 1,
            ),
            array( // row #3
                'profile_permission_id' => 4,
                'profile_id' => 1,
                'permission_id' => 4,
                'created_at' => '2017-08-09 11:50:16',
                'updated_at' => '2017-08-09 11:50:45',
                'active' => 1,
            ),
            array( // row #4
                'profile_permission_id' => 5,
                'profile_id' => 1,
                'permission_id' => 5,
                'created_at' => '2017-08-09 11:50:16',
                'updated_at' => '2017-08-09 11:50:45',
                'active' => 1,
            ),
            array( // row #5
                'profile_permission_id' => 6,
                'profile_id' => 1,
                'permission_id' => 6,
                'created_at' => '2017-08-09 11:50:19',
                'updated_at' => '2017-08-09 11:50:42',
                'active' => 1,
            ),
            array( // row #6
                'profile_permission_id' => 7,
                'profile_id' => 1,
                'permission_id' => 7,
                'created_at' => '2017-08-09 11:50:19',
                'updated_at' => '2017-08-09 11:50:42',
                'active' => 1,
            ),
            array( // row #7
                'profile_permission_id' => 8,
                'profile_id' => 1,
                'permission_id' => 9,
                'created_at' => '2017-08-09 11:50:20',
                'updated_at' => '2017-08-09 11:50:42',
                'active' => 1,
            ),
            array( // row #8
                'profile_permission_id' => 9,
                'profile_id' => 1,
                'permission_id' => 10,
                'created_at' => '2017-08-09 11:50:22',
                'updated_at' => '2017-08-09 11:50:44',
                'active' => 1,
            ),
            array( // row #9
                'profile_permission_id' => 10,
                'profile_id' => 1,
                'permission_id' => 11,
                'created_at' => '2017-08-09 11:50:23',
                'updated_at' => '2017-08-09 11:50:41',
                'active' => 1,
            ),
            array( // row #10
                'profile_permission_id' => 11,
                'profile_id' => 1,
                'permission_id' => 12,
                'created_at' => '2017-08-09 11:50:24',
                'updated_at' => '2017-08-09 11:50:41',
                'active' => 1,
            ),
            array( // row #11
                'profile_permission_id' => 12,
                'profile_id' => 1,
                'permission_id' => 13,
                'created_at' => '2017-08-09 11:50:24',
                'updated_at' => '2017-08-09 11:50:41',
                'active' => 1,
            ),
            array( // row #12
                'profile_permission_id' => 13,
                'profile_id' => 1,
                'permission_id' => 14,
                'created_at' => '2017-08-09 11:50:25',
                'updated_at' => '2017-08-09 11:50:40',
                'active' => 1,
            ),
            array( // row #13
                'profile_permission_id' => 14,
                'profile_id' => 1,
                'permission_id' => 15,
                'created_at' => '2017-08-09 11:50:26',
                'updated_at' => '2017-08-09 11:50:40',
                'active' => 1,
            ),
            array( // row #14
                'profile_permission_id' => 15,
                'profile_id' => 1,
                'permission_id' => 16,
                'created_at' => '2017-08-09 11:50:28',
                'updated_at' => '2017-08-09 11:50:40',
                'active' => 1,
            ),
            array( // row #15
                'profile_permission_id' => 16,
                'profile_id' => 1,
                'permission_id' => 17,
                'created_at' => '2017-08-09 11:50:29',
                'updated_at' => '2017-08-09 11:50:39',
                'active' => 1,
            ),
            array( // row #16
                'profile_permission_id' => 17,
                'profile_id' => 1,
                'permission_id' => 18,
                'created_at' => '2017-08-09 11:50:30',
                'updated_at' => '2017-08-09 11:50:39',
                'active' => 1,
            ),
            array( // row #17
                'profile_permission_id' => 18,
                'profile_id' => 1,
                'permission_id' => 19,
                'created_at' => '2017-08-09 11:50:32',
                'updated_at' => '2017-08-09 11:50:39',
                'active' => 1,
            ),
            array( // row #18
                'profile_permission_id' => 19,
                'profile_id' => 1,
                'permission_id' => 20,
                'created_at' => '2017-08-09 11:50:33',
                'updated_at' => '2017-08-09 11:50:39',
                'active' => 1,
            ),
            array( // row #19
                'profile_permission_id' => 20,
                'profile_id' => 1,
                'permission_id' => 21,
                'created_at' => '2017-08-09 11:50:34',
                'updated_at' => '2017-08-09 11:50:38',
                'active' => 1,
            ),
            array( // row #20
                'profile_permission_id' => 21,
                'profile_id' => 1,
                'permission_id' => 22,
                'created_at' => '2017-08-09 11:50:34',
                'updated_at' => '2017-08-09 11:50:38',
                'active' => 1,
            ),
            array( // row #21
                'profile_permission_id' => 22,
                'profile_id' => 1,
                'permission_id' => 23,
                'created_at' => '2017-08-09 11:50:36',
                'updated_at' => '2017-08-09 11:50:38',
                'active' => 1,
            ),
            array( // row #22
                'profile_permission_id' => 23,
                'profile_id' => 2,
                'permission_id' => 1,
                'created_at' => '2017-08-09 11:51:16',
                'updated_at' => '2017-08-09 11:51:20',
                'active' => 1,
            ),
            array( // row #23
                'profile_permission_id' => 24,
                'profile_id' => 2,
                'permission_id' => 2,
                'created_at' => '2017-08-09 11:51:16',
                'updated_at' => '2017-08-09 11:51:20',
                'active' => 1,
            ),
            array( // row #24
                'profile_permission_id' => 25,
                'profile_id' => 2,
                'permission_id' => 3,
                'created_at' => '2017-08-09 11:51:17',
                'updated_at' => '2017-08-09 11:51:21',
                'active' => 1,
            ),
            array( // row #25
                'profile_permission_id' => 26,
                'profile_id' => 2,
                'permission_id' => 4,
                'created_at' => '2017-08-09 11:51:18',
                'updated_at' => '2017-08-09 11:51:21',
                'active' => 1,
            ),
            array( // row #26
                'profile_permission_id' => 27,
                'profile_id' => 2,
                'permission_id' => 5,
                'created_at' => '2017-08-09 11:51:22',
                'updated_at' => '2017-08-09 11:51:54',
                'active' => 1,
            ),
            array( // row #27
                'profile_permission_id' => 28,
                'profile_id' => 2,
                'permission_id' => 6,
                'created_at' => '2017-08-09 11:51:22',
                'updated_at' => '2017-08-09 11:51:54',
                'active' => 1,
            ),
            array( // row #28
                'profile_permission_id' => 29,
                'profile_id' => 2,
                'permission_id' => 7,
                'created_at' => '2017-08-09 11:51:23',
                'updated_at' => '2017-08-09 11:51:54',
                'active' => 1,
            ),
            array( // row #29
                'profile_permission_id' => 30,
                'profile_id' => 2,
                'permission_id' => 8,
                'created_at' => '2017-08-09 11:51:23',
                'updated_at' => '2017-08-09 11:51:55',
                'active' => 1,
            ),
            array( // row #30
                'profile_permission_id' => 31,
                'profile_id' => 2,
                'permission_id' => 9,
                'created_at' => '2017-08-09 11:51:27',
                'updated_at' => '2017-08-09 11:51:51',
                'active' => 1,
            ),
            array( // row #31
                'profile_permission_id' => 32,
                'profile_id' => 2,
                'permission_id' => 10,
                'created_at' => '2017-08-09 11:51:29',
                'updated_at' => '2017-08-09 11:51:51',
                'active' => 1,
            ),
            array( // row #32
                'profile_permission_id' => 33,
                'profile_id' => 2,
                'permission_id' => 11,
                'created_at' => '2017-08-09 11:51:30',
                'updated_at' => '2017-08-09 11:51:50',
                'active' => 1,
            ),
            array( // row #33
                'profile_permission_id' => 34,
                'profile_id' => 2,
                'permission_id' => 12,
                'created_at' => '2017-08-09 11:51:30',
                'updated_at' => '2017-08-09 11:51:50',
                'active' => 1,
            ),
            array( // row #34
                'profile_permission_id' => 35,
                'profile_id' => 2,
                'permission_id' => 13,
                'created_at' => '2017-08-09 11:51:32',
                'updated_at' => '2017-08-09 11:51:50',
                'active' => 1,
            ),
            array( // row #35
                'profile_permission_id' => 36,
                'profile_id' => 2,
                'permission_id' => 14,
                'created_at' => '2017-08-09 11:51:33',
                'updated_at' => '2017-08-09 11:51:49',
                'active' => 1,
            ),
            array( // row #36
                'profile_permission_id' => 37,
                'profile_id' => 2,
                'permission_id' => 15,
                'created_at' => '2017-08-09 11:51:34',
                'updated_at' => '2017-08-09 11:51:49',
                'active' => 1,
            ),
            array( // row #37
                'profile_permission_id' => 38,
                'profile_id' => 2,
                'permission_id' => 16,
                'created_at' => '2017-08-09 11:51:35',
                'updated_at' => '2017-08-09 11:51:49',
                'active' => 1,
            ),
            array( // row #38
                'profile_permission_id' => 39,
                'profile_id' => 2,
                'permission_id' => 17,
                'created_at' => '2017-08-09 11:51:37',
                'updated_at' => '2017-08-09 11:51:48',
                'active' => 1,
            ),
            array( // row #39
                'profile_permission_id' => 40,
                'profile_id' => 2,
                'permission_id' => 18,
                'created_at' => '2017-08-09 11:51:38',
                'updated_at' => '2017-08-09 11:51:48',
                'active' => 1,
            ),
            array( // row #40
                'profile_permission_id' => 41,
                'profile_id' => 2,
                'permission_id' => 19,
                'created_at' => '2017-08-09 11:51:39',
                'updated_at' => '2017-08-09 11:51:48',
                'active' => 1,
            ),
            array( // row #41
                'profile_permission_id' => 42,
                'profile_id' => 2,
                'permission_id' => 20,
                'created_at' => '2017-08-09 11:51:41',
                'updated_at' => '2017-08-09 11:51:48',
                'active' => 1,
            ),
            array( // row #42
                'profile_permission_id' => 43,
                'profile_id' => 2,
                'permission_id' => 21,
                'created_at' => '2017-08-09 11:51:42',
                'updated_at' => '2017-08-09 11:51:47',
                'active' => 1,
            ),
            array( // row #43
                'profile_permission_id' => 44,
                'profile_id' => 2,
                'permission_id' => 22,
                'created_at' => '2017-08-09 11:51:43',
                'updated_at' => '2017-08-09 11:51:47',
                'active' => 1,
            ),
            array( // row #44
                'profile_permission_id' => 45,
                'profile_id' => 2,
                'permission_id' => 23,
                'created_at' => '2017-08-09 11:51:44',
                'updated_at' => '2017-08-09 11:51:47',
                'active' => 1,
            ),
            array( // row #45
                'profile_permission_id' => 46,
                'profile_id' => 3,
                'permission_id' => 1,
                'created_at' => '2017-08-09 11:51:59',
                'updated_at' => '2017-08-09 11:52:21',
                'active' => 1,
            ),
            array( // row #46
                'profile_permission_id' => 47,
                'profile_id' => 3,
                'permission_id' => 3,
                'created_at' => '2017-08-09 11:52:39',
                'updated_at' => '2017-08-09 11:52:40',
                'active' => 1,
            ),
            array( // row #47
                'profile_permission_id' => 48,
                'profile_id' => 3,
                'permission_id' => 5,
                'created_at' => '2017-08-09 11:52:59',
                'updated_at' => '2017-08-09 11:53:04',
                'active' => 1,
            ),
            array( // row #48
                'profile_permission_id' => 49,
                'profile_id' => 3,
                'permission_id' => 9,
                'created_at' => '2017-08-09 11:53:00',
                'updated_at' => '2017-08-30 10:54:04',
                'active' => 1,
            ),
            array( // row #49
                'profile_permission_id' => 50,
                'profile_id' => 3,
                'permission_id' => 10,
                'created_at' => '2017-08-09 11:53:00',
                'updated_at' => '2017-08-30 10:54:06',
                'active' => 1,
            ),
            array( // row #50
                'profile_permission_id' => 51,
                'profile_id' => 3,
                'permission_id' => 11,
                'created_at' => '2017-08-09 11:53:01',
                'updated_at' => '2017-08-30 10:54:10',
                'active' => 1,
            ),
            array( // row #51
                'profile_permission_id' => 52,
                'profile_id' => 3,
                'permission_id' => 18,
                'created_at' => '2017-08-09 11:53:47',
                'updated_at' => '2017-08-09 11:53:53',
                'active' => 1,
            ),
            array( // row #52
                'profile_permission_id' => 53,
                'profile_id' => 3,
                'permission_id' => 19,
                'created_at' => '2017-08-09 11:53:49',
                'updated_at' => '2017-08-09 11:53:54',
                'active' => 1,
            ),
            array( // row #53
                'profile_permission_id' => 54,
                'profile_id' => 3,
                'permission_id' => 20,
                'created_at' => '2017-08-09 11:53:50',
                'updated_at' => '2017-08-09 11:53:54',
                'active' => 1,
            ),
            array( // row #54
                'profile_permission_id' => 55,
                'profile_id' => 4,
                'permission_id' => 24,
                'created_at' => '2017-08-10 09:39:40',
                'updated_at' => '0000-00-00 00:00:00',
                'active' => 1,
            ),
            array( // row #55
                'profile_permission_id' => 56,
                'profile_id' => 3,
                'permission_id' => 2,
                'created_at' => '2017-08-30 10:52:10',
                'updated_at' => '0000-00-00 00:00:00',
                'active' => 1,
            ),
            array( // row #56
                'profile_permission_id' => 57,
                'profile_id' => 3,
                'permission_id' => 4,
                'created_at' => '2017-08-30 10:53:03',
                'updated_at' => '0000-00-00 00:00:00',
                'active' => 1,
            ),
            array( // row #57
                'profile_permission_id' => 58,
                'profile_id' => 3,
                'permission_id' => 12,
                'created_at' => '2017-08-30 10:54:27',
                'updated_at' => '2017-08-30 10:54:29',
                'active' => 1,
            ),
            array( // row #58
                'profile_permission_id' => 59,
                'profile_id' => 3,
                'permission_id' => 13,
                'created_at' => '2017-08-30 10:54:33',
                'updated_at' => '2017-08-30 10:54:34',
                'active' => 1,
            ),
            array( // row #59
                'profile_permission_id' => 60,
                'profile_id' => 3,
                'permission_id' => 14,
                'created_at' => '2017-08-30 10:54:36',
                'updated_at' => '2017-08-30 10:54:38',
                'active' => 1,
            ),
            array( // row #60
                'profile_permission_id' => 61,
                'profile_id' => 3,
                'permission_id' => 15,
                'created_at' => '2017-08-30 10:54:48',
                'updated_at' => '2017-08-30 10:54:51',
                'active' => 1,
            ),
            array( // row #61
                'profile_permission_id' => 62,
                'profile_id' => 3,
                'permission_id' => 16,
                'created_at' => '2017-08-30 10:54:48',
                'updated_at' => '2017-08-30 10:54:53',
                'active' => 1,
            ),
            array( // row #62
                'profile_permission_id' => 63,
                'profile_id' => 3,
                'permission_id' => 17,
                'created_at' => '2017-08-30 10:54:50',
                'updated_at' => '2017-08-30 10:54:55',
                'active' => 1,
            ),
            array( // row #63
                'profile_permission_id' => 64,
                'profile_id' => 3,
                'permission_id' => 18,
                'created_at' => '2017-08-30 10:55:06',
                'updated_at' => '2017-08-30 10:55:09',
                'active' => 1,
            ),
            array( // row #64
                'profile_permission_id' => 65,
                'profile_id' => 3,
                'permission_id' => 19,
                'created_at' => '2017-08-30 10:55:06',
                'updated_at' => '2017-08-30 10:55:10',
                'active' => 1,
            ),
            array( // row #65
                'profile_permission_id' => 66,
                'profile_id' => 3,
                'permission_id' => 20,
                'created_at' => '2017-08-30 10:55:07',
                'updated_at' => '2017-08-30 10:55:13',
                'active' => 1,
            ),
            array( // row #66
                'profile_permission_id' => 67,
                'profile_id' => 7,
                'permission_id' => 1,
                'created_at' => '2017-08-30 15:33:47',
                'updated_at' => '2017-08-30 15:34:04',
                'active' => 1,
            ),
            array( // row #67
                'profile_permission_id' => 68,
                'profile_id' => 7,
                'permission_id' => 11,
                'created_at' => '2017-08-30 15:34:07',
                'updated_at' => '0000-00-00 00:00:00',
                'active' => 1,
            ),
            array( // row #68
                'profile_permission_id' => 69,
                'profile_id' => 7,
                'permission_id' => 3,
                'created_at' => '2017-08-30 15:34:20',
                'updated_at' => '0000-00-00 00:00:00',
                'active' => 1,
            ),
            array( // row #69
                'profile_permission_id' => 70,
                'profile_id' => 8,
                'permission_id' => 1,
                'created_at' => '2017-08-30 16:02:40',
                'updated_at' => '2017-08-30 16:02:42',
                'active' => 1,
            ),
            array( // row #70
                'profile_permission_id' => 71,
                'profile_id' => 8,
                'permission_id' => 11,
                'created_at' => '2017-08-30 16:02:43',
                'updated_at' => '2017-08-30 16:02:45',
                'active' => 1,
            ),
            array( // row #71
                'profile_permission_id' => 72,
                'profile_id' => 8,
                'permission_id' => 3,
                'created_at' => '2017-08-30 16:02:47',
                'updated_at' => '2017-08-30 16:03:03',
                'active' => 1,
            ),
            array( // row #72
                'profile_permission_id' => 73,
                'profile_id' => 8,
                'permission_id' => 6,
                'created_at' => '2017-08-30 16:03:04',
                'updated_at' => '2017-08-30 16:03:17',
                'active' => 1,
            ),
            array( // row #73
                'profile_permission_id' => 74,
                'profile_id' => 8,
                'permission_id' => 7,
                'created_at' => '2017-08-30 16:03:19',
                'updated_at' => '2017-08-30 16:03:23',
                'active' => 1,
            ),
            array( // row #74
                'profile_permission_id' => 75,
                'profile_id' => 8,
                'permission_id' => 8,
                'created_at' => '2017-08-30 16:03:24',
                'updated_at' => '2017-08-30 16:03:27',
                'active' => 1,
            ),
            array( // row #75
                'profile_permission_id' => 76,
                'profile_id' => 8,
                'permission_id' => 18,
                'created_at' => '2017-08-30 16:03:52',
                'updated_at' => '2017-08-30 16:03:55',
                'active' => 1,
            ),
            array( // row #76
                'profile_permission_id' => 77,
                'profile_id' => 8,
                'permission_id' => 19,
                'created_at' => '2017-08-30 16:03:53',
                'updated_at' => '2017-08-30 16:03:57',
                'active' => 1,
            ),
            array( // row #77
                'profile_permission_id' => 78,
                'profile_id' => 8,
                'permission_id' => 20,
                'created_at' => '2017-08-30 16:03:59',
                'updated_at' => '2017-08-30 16:04:00',
                'active' => 1,
            ),
            array( // row #78
                'profile_permission_id' => 79,
                'profile_id' => 1,
                'permission_id' => 8,
                'created_at' => '2017-09-01 10:36:22',
                'updated_at' => '0000-00-00 00:00:00',
                'active' => 1,
            ),
            array( // row #79
                'profile_permission_id' => 80,
                'profile_id' => 5,
                'permission_id' => 2,
                'created_at' => '2017-08-09 11:50:16',
                'updated_at' => '2017-08-09 11:50:16',
                'active' => 1,
            ),
            array( // row #80
                'profile_permission_id' => 81,
                'profile_id' => 5,
                'permission_id' => 4,
                'created_at' => '2017-08-09 11:50:16',
                'updated_at' => '2017-08-09 11:50:16',
                'active' => 1,
            ),
            array( // row #81
                'profile_permission_id' => 82,
                'profile_id' => 5,
                'permission_id' => 3,
                'created_at' => '2017-08-09 11:50:16',
                'updated_at' => '2017-08-09 11:50:16',
                'active' => 1,
            ),
            array( // row #82
                'profile_permission_id' => 83,
                'profile_id' => 5,
                'permission_id' => 19,
                'created_at' => '2017-08-09 11:50:16',
                'updated_at' => '2017-08-09 11:50:16',
                'active' => 1,
            ),
            array( // row #83
                'profile_permission_id' => 84,
                'profile_id' => 5,
                'permission_id' => 20,
                'created_at' => '2017-08-09 11:50:16',
                'updated_at' => '2017-08-09 11:50:16',
                'active' => 1,
            ),
            array( // row #84
                'profile_permission_id' => 85,
                'profile_id' => 5,
                'permission_id' => 21,
                'created_at' => '2017-08-09 11:50:16',
                'updated_at' => '2017-08-09 11:50:16',
                'active' => 1,
            ),
            array( // row #85
                'profile_permission_id' => 86,
                'profile_id' => 5,
                'permission_id' => 12,
                'created_at' => '2017-08-09 11:50:16',
                'updated_at' => '2017-08-09 11:50:16',
                'active' => 1,
            ),
            array( // row #86
                'profile_permission_id' => 87,
                'profile_id' => 5,
                'permission_id' => 14,
                'created_at' => '2017-08-09 11:50:16',
                'updated_at' => '2017-08-09 11:50:16',
                'active' => 1,
            ),
            array( // row #87
                'profile_permission_id' => 88,
                'profile_id' => 5,
                'permission_id' => 10,
                'created_at' => '2017-08-09 11:50:16',
                'updated_at' => '2017-08-09 11:50:16',
                'active' => 1,
            ),
            array( // row #88
                'profile_permission_id' => 89,
                'profile_id' => 5,
                'permission_id' => 15,
                'created_at' => '2017-08-09 11:50:16',
                'updated_at' => '2017-08-09 11:50:16',
                'active' => 1,
            ),
            array( // row #89
                'profile_permission_id' => 90,
                'profile_id' => 5,
                'permission_id' => 16,
                'created_at' => '2017-08-09 11:50:16',
                'updated_at' => '2017-08-09 11:50:16',
                'active' => 1,
            ),
            array( // row #90
                'profile_permission_id' => 91,
                'profile_id' => 5,
                'permission_id' => 17,
                'created_at' => '2017-08-09 11:50:16',
                'updated_at' => '2017-08-09 11:50:16',
                'active' => 1,
            ),
            array( // row #91
                'profile_permission_id' => 93,
                'profile_id' => 5,
                'permission_id' => 18,
                'created_at' => '2017-08-09 11:50:16',
                'updated_at' => '2017-08-09 11:50:16',
                'active' => 1,
            ),
        );
        foreach ($profile_permissions as $profile_permission => $value){
            $this->db->insert('profile_permissions', $value);
            echo ".";
        }
 
        echo PHP_EOL;
    }

    function seed_states(){
        $this->db->truncate('states');
        $states = array(
            array( // row #0
                'state_id' => 1,
                'name' => 'Programado',
                'created_at' => '2017-07-17 08:47:45',
                'updated_at' => '0000-00-00 00:00:00',
                'active' => 0,
            ),
            array( // row #1
                'state_id' => 2,
                'name' => 'Pre-registro',
                'created_at' => '2017-07-17 08:47:52',
                'updated_at' => '0000-00-00 00:00:00',
                'active' => 0,
            ),
            array( // row #2
                'state_id' => 3,
                'name' => 'Confirmado',
                'created_at' => '2017-07-17 08:47:56',
                'updated_at' => '2017-07-27 10:45:02',
                'active' => 0,
            ),
            array( // row #3
                'state_id' => 4,
                'name' => 'Finalizado',
                'created_at' => '2017-07-17 08:48:38',
                'updated_at' => '0000-00-00 00:00:00',
                'active' => 0,
            ),
            array( // row #4
                'state_id' => 5,
                'name' => 'Asistio',
                'created_at' => '2017-07-25 13:18:28',
                'updated_at' => '0000-00-00 00:00:00',
                'active' => 0,
            ),
            array( // row #5
                'state_id' => 6,
                'name' => 'En Curso',
                'created_at' => '2017-08-04 08:39:32',
                'updated_at' => '0000-00-00 00:00:00',
                'active' => 0,
            ),
        );

        foreach ($states as $state => $value){
            $this->db->insert('states', $value);
            echo ".";
        }
 
        echo PHP_EOL;
    }

    function seed_thematic_area_types(){
        $this->db->truncate('thematic_area_types');
        $thematic_area_types = array(
            array( // row #0
                'thematic_area_type_id' => 1,
                'name' => 'Seguridad',
                'created_at' => '2017-07-24 00:25:51',
                'updated_at' => '0000-00-00 00:00:00',
                'active' => 1,
            ),
            array( // row #1
                'thematic_area_type_id' => 2,
                'name' => 'Auditoria',
                'created_at' => '2017-07-25 00:49:15',
                'updated_at' => '0000-00-00 00:00:00',
                'active' => 1,
            ),
        );
        foreach ($thematic_area_types as $state => $value){
            $this->db->insert('thematic_area_types', $value);
            echo ".";
        }
 
        echo PHP_EOL;
    }

    function seed_topics(){
        $this->db->truncate('topics');
        $topics = array(
            array( // row #0
                'topic_id' => 1,
                'name' => 'Seguridad en alturas',
                'thematic_area_type_id' => 1,
                'created_at' => '2017-07-24 00:20:26',
                'updated_at' => '2017-07-24 00:20:27',
                'active' => 1,
            ),
            array( // row #1
                'topic_id' => 2,
                'name' => 'Manejo residuos quimicos 2',
                'thematic_area_type_id' => 1,
                'created_at' => '2017-07-17 02:47:12',
                'updated_at' => '2017-08-02 11:12:33',
                'active' => 1,
            ),
            array( // row #2
                'topic_id' => 3,
                'name' => 'Trabajo en Alturas',
                'thematic_area_type_id' => 2,
                'created_at' => '2017-07-17 10:35:45',
                'updated_at' => '2017-07-25 00:54:54',
                'active' => 1,
            ),
            array( // row #3
                'topic_id' => 4,
                'name' => 'Test',
                'thematic_area_type_id' => 1,
                'created_at' => '2017-07-24 00:31:56',
                'updated_at' => '0000-00-00 00:00:00',
                'active' => 1,
            ),
            array( // row #4
                'topic_id' => 5,
                'name' => 'Riesgo Laboral 1',
                'thematic_area_type_id' => 1,
                'created_at' => '2017-07-27 01:17:27',
                'updated_at' => '2017-08-01 12:00:13',
                'active' => 1,
            ),
        );
        foreach ($topics as $topic => $value){
            $this->db->insert('topics', $value);
            echo ".";
        }
 
        echo PHP_EOL;
    }

    function seed_provider_types(){
        $this->db->truncate('provider_types');
        $provider_types = array(
            array( // row #0
                'provider_type_id' => 1,
                'name' => 'Consultor Presencial',
                'created_at' => '2017-07-24 00:35:49',
                'updated_at' => '0000-00-00 00:00:00',
                'active' => 1,
            ),
            array( // row #1
                'provider_type_id' => 2,
                'name' => 'Consultor Virtual',
                'created_at' => '2017-07-24 00:35:56',
                'updated_at' => '0000-00-00 00:00:00',
                'active' => 1,
            ),
        );
        foreach ($provider_types as $provider_type => $value){
            $this->db->insert('provider_types', $value);
            echo ".";
        }
 
        echo PHP_EOL;
    }

    function seed_providers(){
        $this->db->truncate('providers');
        $providers = array(
            array( // row #0
                'provider_id' => 2,
                'provider_type_id' => 1,
                'name' => 'Jonathan',
                'lastname' => 'Dorado',
                'document_type_id' => 1,
                'document_number' => 10184462,
                'date_birthday' => '0000-00-00',
                'date_start_ccs' => '0000-00-00',
                'area_id' => 3,
                'thematic_area_type_id' => 1,
                'consultant_clasification_id' => 1,
                'created_at' => '2017-07-24 10:41:46',
                'updated_at' => '0000-00-00 00:00:00',
                'active' => 1,
            ),
            array( // row #1
                'provider_id' => 3,
                'provider_type_id' => 1,
                'name' => 'Steven',
                'lastname' => 'Dorado',
                'document_type_id' => 1,
                'document_number' => 101844624,
                'date_birthday' => '2017-08-01',
                'date_start_ccs' => '2017-08-02',
                'area_id' => 3,
                'thematic_area_type_id' => 2,
                'consultant_clasification_id' => 1,
                'created_at' => '2017-07-24 10:41:46',
                'updated_at' => '2017-08-01 11:29:05',
                'active' => 1,
            ),
            array( // row #2
                'provider_id' => 4,
                'provider_type_id' => 1,
                'name' => 'Andres',
                'lastname' => 'Dorado',
                'document_type_id' => 1,
                'document_number' => 101844624,
                'date_birthday' => '2017-08-01',
                'date_start_ccs' => '2017-08-02',
                'area_id' => 3,
                'thematic_area_type_id' => 2,
                'consultant_clasification_id' => 1,
                'created_at' => '2017-08-01 10:52:56',
                'updated_at' => '2017-08-01 10:57:09',
                'active' => 1,
            ),
            array( // row #3
                'provider_id' => 5,
                'provider_type_id' => 1,
                'name' => 'Alan Smith',
                'lastname' => 'Dorado',
                'document_type_id' => 1,
                'document_number' => 101844624,
                'date_birthday' => '2016-05-10',
                'date_start_ccs' => '2017-08-02',
                'area_id' => 3,
                'thematic_area_type_id' => 2,
                'consultant_clasification_id' => 1,
                'created_at' => '2017-08-01 10:55:48',
                'updated_at' => '0000-00-00 00:00:00',
                'active' => 1,
            ),
            array( // row #4
                'provider_id' => 6,
                'provider_type_id' => 1,
                'name' => 'Camilo',
                'lastname' => 'Dorado',
                'document_type_id' => 1,
                'document_number' => 101844624,
                'date_birthday' => '2017-08-01',
                'date_start_ccs' => '2017-08-02',
                'area_id' => 3,
                'thematic_area_type_id' => 1,
                'consultant_clasification_id' => 1,
                'created_at' => '2017-08-01 10:56:09',
                'updated_at' => '0000-00-00 00:00:00',
                'active' => 1,
            ),
        );
        foreach ($providers as $provider => $value){
            $this->db->insert('providers', $value);
            echo ".";
        }
 
        echo PHP_EOL;
    }

    function seed_training_platforms(){
        $this->db->truncate('training_platforms');
        $training_platforms = array(
            array( // row #0
                'training_platform_id' => 1,
                'name' => 'Moodle',
                'created_at' => '2017-07-17 09:26:40',
                'updated_at' => '0000-00-00 00:00:00',
                'active' => 1,
            ),
            array( // row #1
                'training_platform_id' => 2,
                'name' => 'WebEx',
                'created_at' => '2017-07-17 09:26:46',
                'updated_at' => '0000-00-00 00:00:00',
                'active' => 1,
            ),
            array( // row #2
                'training_platform_id' => 3,
                'name' => 'No Aplica',
                'created_at' => '2017-07-18 10:26:13',
                'updated_at' => '0000-00-00 00:00:00',
                'active' => 1,
            ),
        );
        foreach ($training_platforms as $training_platform => $value){
            $this->db->insert('training_platforms', $value);
            echo ".";
        }
 
        echo PHP_EOL;
    }

    function seed_training_types(){
        $this->db->truncate('training_types');
        $training_types = array(
            array( // row #0
                'training_type_id' => 1,
                'name' => 'Presencial',
                'created_at' => '2017-07-17 09:43:24',
                'updated_at' => '0000-00-00 00:00:00',
                'active' => 1,
            ),
            array( // row #1
                'training_type_id' => 2,
                'name' => 'Virtual',
                'created_at' => '2017-07-17 09:43:30',
                'updated_at' => '0000-00-00 00:00:00',
                'active' => 1,
            ),
        );
        foreach ($training_types as $training_type => $value){
            $this->db->insert('training_types', $value);
            echo ".";
        }
 
        echo PHP_EOL;
    }

    function seed_payment_types(){
        $this->db->truncate('payment_types');
        $payment_types = array(
            array( // row #0
                'payment_type_id' => 1,
                'name' => 'ARL',
                'created_at' => '2017-07-26 10:55:50',
                'updated_at' => '0000-00-00 00:00:00',
                'active' => 1,
            ),
            array( // row #1
                'payment_type_id' => 2,
                'name' => 'Persona Natural',
                'created_at' => '2017-07-26 10:56:21',
                'updated_at' => '0000-00-00 00:00:00',
                'active' => 1,
            ),
            array( // row #2
                'payment_type_id' => 3,
                'name' => 'Beca',
                'created_at' => '2017-07-26 10:56:26',
                'updated_at' => '0000-00-00 00:00:00',
                'active' => 1,
            ),
            array( // row #3
                'payment_type_id' => 4,
                'name' => 'Empresa',
                'created_at' => '2017-07-26 10:56:31',
                'updated_at' => '0000-00-00 00:00:00',
                'active' => 1,
            ),
        );
        foreach ($payment_types as $payment_type => $value){
            $this->db->insert('payment_types', $value);
            echo ".";
        }
 
        echo PHP_EOL;
    }

    function seed_event_types(){
        $this->db->truncate('event_types');
        $event_types = array(
            array( // row #0
                'event_type_id' => 1,
                'name' => 'Cursos o Diplomados',
                'created_at' => '2017-07-18 15:45:52',
                'updated_at' => '0000-00-00 00:00:00',
                'active' => 1,
            ),
            array( // row #1
                'event_type_id' => 2,
                'name' => 'Macro Evento',
                'created_at' => '2017-07-18 15:45:57',
                'updated_at' => '0000-00-00 00:00:00',
                'active' => 1,
            ),
        );
        foreach ($event_types as $event_type => $value){
            $this->db->insert('event_types', $value);
            echo ".";
        }
 
        echo PHP_EOL;
    }

    function seed_event_audience_types(){
        $this->db->truncate('event_audience_types');
        $event_audience_types = array(
            array( // row #0
                'event_audience_type_id' => 1,
                'name' => 'Abierto',
                'created_at' => '2017-07-18 15:53:03',
                'updated_at' => '0000-00-00 00:00:00',
                'active' => 1,
            ),
            array( // row #1
                'event_audience_type_id' => 2,
                'name' => 'Empresa',
                'created_at' => '2017-07-18 15:53:09',
                'updated_at' => '0000-00-00 00:00:00',
                'active' => 1,
            ),
        );
        foreach ($event_audience_types as $event_audience_type => $value){
            $this->db->insert('event_audience_types', $value);
            echo ".";
        }
 
        echo PHP_EOL;
    }

    function seed_event_assistance_types(){
        $this->db->truncate('event_assistance_types');
        $event_assistance_types = array(
            array( // row #0
                'event_assistance_type_id' => 1,
                'name' => 'Presencial',
                'created_at' => '2017-07-17 09:01:20',
                'updated_at' => '2017-07-18 15:46:27',
                'active' => 1,
            ),
            array( // row #1
                'event_assistance_type_id' => 2,
                'name' => 'Semipresencial',
                'created_at' => '2017-07-17 09:01:25',
                'updated_at' => '2017-07-18 15:46:47',
                'active' => 1,
            ),
            array( // row #2
                'event_assistance_type_id' => 3,
                'name' => 'Virtual',
                'created_at' => '2017-07-18 15:46:50',
                'updated_at' => '2017-07-18 15:46:55',
                'active' => 1,
            ),
        );
        foreach ($event_assistance_types as $event_assistance_type => $value){
            $this->db->insert('event_assistance_types', $value);
            echo ".";
        }
 
        echo PHP_EOL;
    }

    function seed_document_types(){
        $this->db->truncate('document_types');
        $document_types = array(
            array( // row #0
                'document_type_id' => 1,
                'name' => 'Cédula de Ciudadanía',
                'created_at' => '2017-07-23 23:16:19',
                'updated_at' => '0000-00-00 00:00:00',
                'active' => 1,
            ),
            array( // row #1
                'document_type_id' => 2,
                'name' => 'Pasaporte',
                'created_at' => '2017-07-23 23:16:23',
                'updated_at' => '0000-00-00 00:00:00',
                'active' => 1,
            ),
        );
        foreach ($document_types as $document_type => $value){
            $this->db->insert('document_types', $value);
            echo ".";
        }
 
        echo PHP_EOL;
    }

    function seed_countries(){
        $this->db->truncate('countries');
        $countries = array(
            array( // row #0
                'country_id' => 1,
                'name' => 'Colombia',
                'created_at' => '2017-07-16 22:49:42',
                'updated_at' => '0000-00-00 00:00:00',
                'active' => 1,
            ),
        );
        foreach ($countries as $country => $value){
            $this->db->insert('countries', $value);
            echo ".";
        }
 
        echo PHP_EOL;
    }

    function seed_consultant_clasifications(){
        $this->db->truncate('consultant_clasifications');
        $consultant_clasifications = array(
            array( // row #0
                'consultant_clasification_id' => 1,
                'name' => 'Senior',
                'created_at' => '2017-07-24 00:40:13',
                'updated_at' => '0000-00-00 00:00:00',
                'active' => 1,
            ),
        );
        foreach ($consultant_clasifications as $consultant_clasification => $value){
            $this->db->insert('consultant_clasifications', $value);
            echo ".";
        }
 
        echo PHP_EOL;
    }

    function seed_client_types(){
        $this->db->truncate('client_types');
        $client_types = array(
            array( // row #0
                'client_type_id' => 1,
                'name' => 'Persona Natural',
                'created_at' => '2017-07-26 23:51:23',
                'updated_at' => '0000-00-00 00:00:00',
                'active' => 1,
            ),
            array( // row #1
                'client_type_id' => 2,
                'name' => 'Persona Jurídica',
                'created_at' => '2017-07-26 23:51:29',
                'updated_at' => '2017-07-26 23:51:51',
                'active' => 1,
            ),
        );
        foreach ($client_types as $client_type => $value){
            $this->db->insert('client_types', $value);
            echo ".";
        }
 
        echo PHP_EOL;
    }

    function seed_cities(){
        $this->db->truncate('cities');
        $cities = array(
            array( // row #0
                'city_id' => 1,
                'name' => 'Bogotá',
                'country_id' => 1,
                'created_at' => '2017-07-16 22:50:02',
                'updated_at' => '0000-00-00 00:00:00',
                'active' => 1,
            ),
            array( // row #1
                'city_id' => 2,
                'name' => 'Cali',
                'country_id' => 1,
                'created_at' => '2017-08-15 16:37:47',
                'updated_at' => '2017-08-15 16:38:06',
                'active' => 1,
            ),
            array( // row #2
                'city_id' => 3,
                'name' => 'Medellin',
                'country_id' => 1,
                'created_at' => '2017-08-15 16:37:50',
                'updated_at' => '2017-08-15 16:38:06',
                'active' => 1,
            ),
            array( // row #3
                'city_id' => 4,
                'name' => 'Barranquilla',
                'country_id' => 1,
                'created_at' => '2017-08-15 16:37:55',
                'updated_at' => '2017-08-15 16:38:07',
                'active' => 1,
            ),
            array( // row #4
                'city_id' => 5,
                'name' => 'Cartagena',
                'country_id' => 1,
                'created_at' => '2017-08-15 16:37:59',
                'updated_at' => '2017-08-15 16:38:08',
                'active' => 1,
            ),
        );
        foreach ($cities as $city => $value){
            $this->db->insert('cities', $value);
            echo ".";
        }
 
        echo PHP_EOL;
    }

    function seed_arl(){
        $this->db->truncate('arl');
        $arl = array(
            array( // row #0
                'arl_id' => 1,
                'name' => 'No Aplica',
                'created_at' => '2017-07-26 11:30:53',
                'updated_at' => '2017-07-26 11:31:32',
                'active' => 1,
            ),
            array( // row #1
                'arl_id' => 2,
                'name' => 'Positiva',
                'created_at' => '2017-07-26 11:30:58',
                'updated_at' => '0000-00-00 00:00:00',
                'active' => 1,
            ),
            array( // row #2
                'arl_id' => 3,
                'name' => 'Bolivar',
                'created_at' => '2017-07-26 11:31:08',
                'updated_at' => '0000-00-00 00:00:00',
                'active' => 1,
            ),
            array( // row #3
                'arl_id' => 4,
                'name' => 'Mapre',
                'created_at' => '2017-07-26 11:32:12',
                'updated_at' => '0000-00-00 00:00:00',
                'active' => 1,
            ),
        );
        foreach ($arl as $arls => $value){
            $this->db->insert('arl', $value);
            echo ".";
        }
 
        echo PHP_EOL;
    }

    function seed_areas(){
        $this->db->truncate('areas');
        $areas = array(
            array( // row #0
                'area_id' => 1,
                'name' => 'RUC',
                'created_at' => '2017-07-24 00:55:04',
                'updated_at' => '0000-00-00 00:00:00',
                'active' => 1,
            ),
            array( // row #1
                'area_id' => 2,
                'name' => 'CERTIFICACIÓN',
                'created_at' => '2017-07-24 00:55:06',
                'updated_at' => '2017-08-30 10:45:42',
                'active' => 1,
            ),
            array( // row #2
                'area_id' => 3,
                'name' => 'AFILIACIÓN',
                'created_at' => '2017-07-24 00:55:22',
                'updated_at' => '2017-08-30 10:45:52',
                'active' => 1,
            ),
            array( // row #3
                'area_id' => 4,
                'name' => 'CAPACITACIÓN',
                'created_at' => '2017-08-30 10:45:57',
                'updated_at' => '0000-00-00 00:00:00',
                'active' => 1,
            ),
            array( // row #4
                'area_id' => 5,
                'name' => 'NO APLICA',
                'created_at' => '2017-08-30 10:46:09',
                'updated_at' => '0000-00-00 00:00:00',
                'active' => 1,
            ),
        );
        foreach ($areas as $area => $value){
            $this->db->insert('areas', $value);
            echo ".";
        }
 
        echo PHP_EOL;
    }

    function seed_answer_types(){
        $this->db->truncate('answer_types');
        $answer_types = array(
            array( // row #0
                'answer_type_id' => 1,
                'name' => 'Seleccion',
                'created_at' => '2017-08-01 12:37:06',
                'updated_at' => '2017-08-01 12:37:16',
                'active' => 1,
            ),
        );
        foreach ($answer_types as $answer_type => $value){
            $this->db->insert('answer_types', $value);
            echo ".";
        }
 
        echo PHP_EOL;
    }

    function seed_answer_options(){
        $this->db->truncate('answer_options');
        $answer_options = array(
            array( // row #0
                'answer_option_id' => 3,
                'name' => '1',
                'answer_group_id' => 2,
                'created_at' => '2017-08-01 12:33:16',
                'updated_at' => '2017-08-01 12:33:42',
                'active' => 1,
            ),
            array( // row #1
                'answer_option_id' => 4,
                'name' => '2',
                'answer_group_id' => 2,
                'created_at' => '2017-08-01 12:33:18',
                'updated_at' => '2017-08-01 12:33:46',
                'active' => 1,
            ),
            array( // row #2
                'answer_option_id' => 5,
                'name' => '3',
                'answer_group_id' => 2,
                'created_at' => '2017-08-01 12:33:20',
                'updated_at' => '2017-08-01 12:33:43',
                'active' => 1,
            ),
            array( // row #3
                'answer_option_id' => 6,
                'name' => '4',
                'answer_group_id' => 2,
                'created_at' => '2017-08-01 12:33:21',
                'updated_at' => '2017-08-01 12:33:47',
                'active' => 1,
            ),
            array( // row #4
                'answer_option_id' => 7,
                'name' => '5',
                'answer_group_id' => 2,
                'created_at' => '2017-08-01 12:33:23',
                'updated_at' => '2017-08-01 12:33:43',
                'active' => 1,
            ),
            array( // row #5
                'answer_option_id' => 8,
                'name' => '6',
                'answer_group_id' => 2,
                'created_at' => '2017-08-01 12:33:24',
                'updated_at' => '2017-08-01 12:33:47',
                'active' => 1,
            ),
            array( // row #6
                'answer_option_id' => 9,
                'name' => '7',
                'answer_group_id' => 2,
                'created_at' => '2017-08-01 12:33:26',
                'updated_at' => '2017-08-01 12:33:44',
                'active' => 1,
            ),
            array( // row #7
                'answer_option_id' => 10,
                'name' => '8',
                'answer_group_id' => 2,
                'created_at' => '2017-08-01 12:33:27',
                'updated_at' => '2017-08-01 12:33:44',
                'active' => 1,
            ),
            array( // row #8
                'answer_option_id' => 11,
                'name' => '9',
                'answer_group_id' => 2,
                'created_at' => '2017-08-01 12:33:29',
                'updated_at' => '2017-08-01 12:33:48',
                'active' => 1,
            ),
            array( // row #9
                'answer_option_id' => 12,
                'name' => '10',
                'answer_group_id' => 2,
                'created_at' => '2017-08-01 12:33:30',
                'updated_at' => '2017-08-01 12:33:50',
                'active' => 1,
            ),
        );
        foreach ($answer_options as $answer_option => $value){
            $this->db->insert('answer_options', $value);
            echo ".";
        }
 
        echo PHP_EOL;
    }

    function seed_answers_groups(){
        $this->db->truncate('answers_groups');
        $answers_groups = array(
            array( // row #0
                'answer_group_id' => 2,
                'name' => 'Escala 1 a 10',
                'answer_type_id' => 1,
                'created_at' => '2017-08-01 14:06:17',
                'updated_at' => '2017-08-01 14:22:36',
                'active' => 1,
            ),
        );
        foreach ($answers_groups as $answers_group => $value){
            $this->db->insert('answers_groups', $value);
            echo ".";
        }
 
        echo PHP_EOL;
    }
}