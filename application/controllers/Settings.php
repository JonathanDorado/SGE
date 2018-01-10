<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('file');
        $this->load->helper('download');
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->model('clients_model', 'cm');
        $this->load->model('event_clients_model', 'ecm');
        $this->load->model('event_client_topics_model', 'ectm');
        $this->load->model('event_client_payment_model', 'ecpm');
        $this->load->model('modules_model', 'mm');
        $this->load->model('profiles_model', 'pm');
        $this->load->model('permissions_model', 'pem');
        $this->load->model('profile_permissions_model', 'ppm');
        
        if (!$this->session->userdata('user_type')) {
            redirect('/login', 'refresh');
        } else {
            if ($this->session->userdata('user_type') == "CCS") {
                $this->session->set_userdata('module', 'settings');
            } else {
                redirect('/mycourses', 'refresh');
            }
        }
    }

    public function list_profiles() {
        $data['profiles'] = $this->pm->getProfiles();
        $data['content'] = "settings/list_profiles";
        $this->load->view('templates/admin/layout', $data);
    }

    public function show_Profile() {
        $profile_id = $this->input->post('profile_id');
        $data['profile'] = $this->pm->getProfiles($profile_id);
        $data['modules'] = $this->mm->getModules();
        $data['permissions'] = $this->pem->getPermissions();
        $data['profile_permissions'] = $this->ppm->getPermissionsByProfile($profile_id);
        $data['content'] = "settings/form_profile";
        $this->load->view('templates/admin/layout', $data);
    }

    public function show_OfflineMode() {
        $data['content'] = "settings/offline_mode";
        $this->load->view('templates/admin/layout', $data);
    }

    function update_ProfilePermission() {
        $type = $this->input->post('type');
        $profile_id = $this->input->post('profile_id');
        $permission_id = $this->input->post('permission_id');
        if ($type == 0) {
            $this->ppm->delete($profile_id, $permission_id);
            echo json_encode(array('msg' => 'Permiso Deshabilitado Correctamente'));
        } else {
            $data = array(
                'profile_id' => $profile_id,
                'permission_id' => $permission_id);
            $this->ppm->store($data);
            echo json_encode(array('msg' => 'Permiso Habilitado Correctamente'));
        }
    }

    function backup_database() {
        // Load the DB utility class
        $this->load->dbutil();

        $prefs = array(
            'format' => 'zip',
            'filename' => 'backup_db.sql'
        );

        // Backup your entire database and assign it to a variable
        $backup = & $this->dbutil->backup($prefs);

        $fileName = 'backup_db_' . date("Y-m-d_H-i-s") . '.zip';
        $save = FCPATH . '/backups/' . $fileName;

        // Load the file helper and write the file to your server
        $this->load->helper('file');
        write_file($save, $backup);

        // Load the download helper and send the file to your desktop

        force_download($fileName, $backup);
    }

    function getDataOffline() {
        $content = "";
        $content .= $this->getDataClientsOffline();
        $content .= $this->getDataEventClientsOffline();
        $content .= $this->getDataEventClientTopicsOffline();
        $content .= $this->getDataEventClientPaymentOffline();

        $txt_name = "download_data_offline_" . date("Y_m_d-H_i_s") . '.txt';
        if (write_file('./offline/download/' . $txt_name, $content)) {
            force_download('./offline/download/' . $txt_name, null);
        }
    }

    function getDataClientsOffline() {
        $sentences = "";
        $clients = $this->cm->getClientsOffline();
        if (count($clients) > 0) {
            foreach ($clients as $client) {
                $sentences .= 'C|';
                if ($client->offline_mode_create == 1) {
                    $sentences .= 'INSERT|';
                } else {
                    $sentences .= 'UPDATE|';
                }
                $sentences .= $client->client_id . '|';
                $sentences .= $client->person_type_id . '|';
                $sentences .= $client->client_type_id . '|';
                $sentences .= $client->name . '|';
                $sentences .= $client->lastname . '|';
                $sentences .= $client->document_type_id . '|';
                $sentences .= $client->document_number . '|';
                $sentences .= $client->city_id_citizenship . '|';
                $sentences .= $client->address . '|';
                $sentences .= $client->phone_number . '|';
                $sentences .= $client->cellphone_number . '|';
                $sentences .= $client->email . '|';
                $sentences .= $client->company . '|';
                $sentences .= $client->position . '|';
                $sentences .= $client->habeas_data . '|';
                $sentences .= $client->created_at . '|';
                $sentences .= $client->updated_at . '|';
                $sentences .= $client->active . '|';
                $sentences .= $client->created_by_user_id . '|';
                $sentences .= $client->updated_by_user_id . '|';
                $sentences .= $client->active . '|';
                $sentences .= $client->active . '|';
                $sentences .= PHP_EOL;
            }
        }
        return $sentences;
    }

    function getDataEventClientsOffline() {
        $sentences = "";
        $event_clients = $this->ecm->getEventClientsOffline();
        if (count($event_clients) > 0) {
            foreach ($event_clients as $event_client) {
                $sentences .= 'EC|';
                $sentences .= $event_client->document_number . '|';
                $sentences .= $event_client->event_client_id . '|';
                $sentences .= $event_client->event_id . '|';
                $sentences .= $event_client->client_id . '|';
                $sentences .= $event_client->state_id . '|';
                $sentences .= $event_client->created_at . '|';
                $sentences .= $event_client->updated_at . '|';
                $sentences .= $event_client->active . '|';
                $sentences .= $event_client->created_by_user_id . '|';
                $sentences .= PHP_EOL;
            }
        }
        return $sentences;
    }

    function getDataEventClientTopicsOffline() {
        $sentences = "";
        $event_client_topics = $this->ectm->getEventClientTopicsOffline();
        if (count($event_client_topics) > 0) {
            foreach ($event_client_topics as $event_client_topic) {
                $sentences .= 'ECT|';
                $sentences .= $event_client_topic->document_number . '|';
                $sentences .= $event_client_topic->event_id . '|';
                $sentences .= $event_client_topic->event_client_topic_id . '|';
                $sentences .= $event_client_topic->event_client_id . '|';
                $sentences .= $event_client_topic->event_topic_id . '|';
                $sentences .= $event_client_topic->created_at . '|';
                $sentences .= $event_client_topic->updated_at . '|';
                $sentences .= $event_client_topic->created_by_user_id . '|';
                $sentences .= $event_client_topic->updated_by_user_id . '|';
                $sentences .= $event_client_topic->active . '|';
                $sentences .= PHP_EOL;
            }
        }
        return $sentences;
    }

    function getDataEventClientPaymentOffline() {
        $sentences = "";
        $event_client_payments = $this->ecpm->getEventClientPaymentOffline();
        if (count($event_client_payments) > 0) {
            foreach ($event_client_payments as $event_client_payment) {
                $sentences .= 'ECP|';
                if ($event_client_payment->offline_mode_create == 1) {
                    $sentences .= 'INSERT|';
                } else {
                    $sentences .= 'UPDATE|';
                }
                $sentences .= $event_client_payment->document_number . '|';
                $sentences .= $event_client_payment->event_id . '|';
                $sentences .= $event_client_payment->event_client_payment_id . '|';
                $sentences .= $event_client_payment->event_client_id . '|';
                $sentences .= $event_client_payment->payment_type_id . '|';
                $sentences .= $event_client_payment->payment_method_id . '|';
                $sentences .= $event_client_payment->price . '|';
                $sentences .= $event_client_payment->isCompanyPaying_nit_company . '|';
                $sentences .= $event_client_payment->isArlPaying_arl_id . '|';
                $sentences .= $event_client_payment->comment . '|';
                $sentences .= $event_client_payment->isPaid . '|';
                $sentences .= $event_client_payment->paid_date . '|';
                $sentences .= $event_client_payment->invoice_code . '|';
                $sentences .= $event_client_payment->created_at . '|';
                $sentences .= $event_client_payment->updated_at . '|';
                $sentences .= $event_client_payment->created_by_user_id . '|';
                $sentences .= $event_client_payment->updated_by_user_id . '|';
                $sentences .= $event_client_payment->active . '|';
                $sentences .= PHP_EOL;
            }
        }
        return $sentences;
    }

    function processOfflineData() {

        $config['upload_path'] = './offline/upload';
        $config['allowed_types'] = '*';
        $config['max_size'] = 10000;
        $this->load->library('upload', $config);

        if ($this->upload->do_upload('offline_data')) {

            $upload_data = $this->upload->data(); //Returns array of containing all of the data related to the file you uploaded.
            $file_name = $upload_data['file_name'];

            $fp = fopen('./offline/upload/' . $file_name, "r");
            $i = 1;
            $log = "";
            while (!feof($fp)) {

                $line = fgets($fp);
                $data = explode("|", $line);
                $response = '';

                switch ($data[0]) {
                    case 'C':
                        if ($this->processClientOffline($data)) {
                            $response = 'Exitoso';
                        } else {
                            $response = 'Incorrecto';
                        }
                        break;
                    case 'EC':
                        if ($this->processEventClientOffline($data)) {
                            $response = 'Exitoso';
                        } else {
                            $response = 'Incorrecto';
                        }
                        break;
                    case 'ECT':
                        if ($this->processEventClientTopicsOffline($data)) {
                            $response = 'Exitoso';
                        } else {
                            $response = 'Incorrecto';
                        }
                        break;
                    case 'ECP':
                        if ($this->processEventClientPaymentOffline($data)) {
                            $response = 'Exitoso';
                        } else {
                            $response = 'Incorrecto';
                        }
                        break;
                    default:
                        $response = "No data recognized";
                        break;
                }
                $log .= 'Linea ' . $i . ": " . $response . "<br>";
                $i++;
            }
            fclose($fp);
            $this->session->set_flashdata('success', 'Los datos han sido sincronizados correctamente!');
            redirect('/settings/show_OfflineMode');
        }
    }

    function processClientOffline($data) {

        $client = $this->cm->getClients('', $data[8], '');
        if (count($client) > 0) {
            $update = array(
                'person_type_id' => $data[3],
                'client_type_id' => $data[4],
                'name' => $data[5],
                'lastname' => $data[6],
                'document_type_id' => $data[7],
                'document_number' => $data[8],
                'city_id_citizenship' => $data[9],
                'address' => $data[10],
                'phone_number' => $data[11],
                'cellphone_number' => $data[12],
                'email' => $data[13],
                'company' => $data[14],
                'position' => $data[15],
                'created_at' => $data[17],
                'updated_at' => $data[18],
                'created_by_user_id' => $data[19],
            );
            $this->cm->update($client[0]->client_id, $update);
        } else {
            $insert = array(
                'person_type_id' => $data[3],
                'client_type_id' => $data[4],
                'name' => $data[5],
                'lastname' => $data[6],
                'document_type_id' => $data[7],
                'document_number' => $data[8],
                'city_id_citizenship' => $data[9],
                'address' => $data[10],
                'phone_number' => $data[11],
                'cellphone_number' => $data[12],
                'email' => $data[13],
                'company' => $data[14],
                'position' => $data[15],
                'created_at' => $data[17],
                'updated_at' => $data[18],
                'created_by_user_id' => $data[19],
            );
            $this->cm->store($insert);
        }

        return true;
    }

    function processEventClientOffline($data) {

        $client = $this->cm->getClients('', $data[1], '');
        $event_client = $this->ecm->getClientByEvent($data[3], $client[0]->client_id);
        if (count($event_client) > 0) {
            $update = array(
                'event_id' => $data[3],
                'client_id' => $client[0]->client_id,
                'state_id' => $data[5],
                'created_at' => $data[6],
                'updated_at' => $data[7],
                'created_by_user_id' => $data[8],
            );
            $this->ecm->update($event_client[0]->event_client_id, $update);
        } else {
            $insert = array(
                'event_id' => $data[3],
                'client_id' => $client[0]->client_id,
                'state_id' => $data[5],
                'created_at' => $data[6],
                'updated_at' => $data[7],
                'created_by_user_id' => $data[8],
            );
            $this->ecm->store($insert);
        }

        return true;
    }

    function processEventClientTopicsOffline($data) {
        $client = $this->cm->getClients('', $data[1], '');
        $event_client = $this->ecm->getClientByEvent($data[2], $client[0]->client_id);
        $event_client_topic = $this->ectm->getEventClientTopics($event_client[0]->event_client_id);
        if (count($event_client_topic) == 0) {
            $insert = array(
                'event_client_id' => $event_client[0]->event_client_id,
                'event_topic_id' => $data[5],
                'created_at' => $data[6],
                'updated_at' => $data[7],
                'created_by_user_id' => $data[8],
                'updated_by_user_id' => $data[9]
            );
            $this->ectm->store($insert);
        }
        return true;
    }

    function processEventClientPaymentOffline($data) {

        $client = $this->cm->getClients('', $data[2], '');
        $event_client = $this->ecm->getClientByEvent($data[3], $client[0]->client_id);
        $event_client_payment = $this->ecpm->getEventClientPayment($event_client[0]->event_client_id);
        if (count($event_client_payment) > 0) {
            $update = array(
                'event_client_id' => $event_client[0]->event_client_id,
                'payment_type_id' => $data[6],
                'payment_method_id' => $data[7],
                'price' => $data[8],
                'isCompanyPaying_nit_company' => $data[9],
                'isArlPaying_arl_id' => $data[10],
                'comment' => $data[11],
                'isPaid' => $data[12],
                'paid_date' => $data[13],
                'invoice_code' => $data[14],
                'updated_at' => $data[16],
                'updated_by_user_id' => $data[18]
            );
            $this->ecpm->update($event_client_payment[0]->event_client_payment_id, $update);
        } else {
            $insert = array(
                'event_client_id' => $event_client[0]->event_client_id,
                'payment_type_id' => $data[6],
                'payment_method_id' => $data[7],
                'price' => $data[8],
                'isCompanyPaying_nit_company' => $data[9],
                'isArlPaying_arl_id' => $data[10],
                'comment' => $data[11],
                'isPaid' => $data[12],
                'paid_date' => $data[13],
                'invoice_code' => $data[14],
                'created_at' => $data[15],
                'created_by_user_id' => $data[17]
            );
            $this->ecpm->store($insert);
        }

        return true;
    }

}
