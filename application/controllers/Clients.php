<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Clients extends CI_Controller {

    private $mode;

    public function __construct() {
        parent::__construct();
        ini_set('memory_limit', '-1');
        set_time_limit(0);
        date_default_timezone_set('America/Bogota');
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->library('excel');
        $this->load->model('document_types_model', 'dtm');
        $this->load->model('countries_model', 'com');
        $this->load->model('cities_model', 'cm');
        $this->load->model('clients_model', 'clm');
        $this->load->model('person_types_model', 'ptm');
        $this->load->model('client_types_model', 'ctm');
        $this->load->helper('file');

        if (!$this->session->userdata('user_type')) {
            redirect('/login', 'refresh');
        } else {
            if ($this->session->userdata('user_type') == "CCS") {
                $this->session->set_userdata('module', 'clients');
            } else {
                redirect('/mycourses', 'refresh');
            }
        }

        if (MODE == "OFFLINE") {
            $this->mode = 1;
        } else {
            $this->mode = 0;
        }
    }

    public function index() {
        $data['clients'] = $this->clm->getClients();
        $data['content'] = "clients/list_clients";
        $this->load->view('templates/admin/layout', $data);
    }

    public function show() {
        $data['client'] = $this->clm->getClients($this->input->post('client_id'));
        $data['person_types'] = $this->ptm->getPersonTypes();
        $data['client_types'] = $this->ctm->getClientTypes();
        $data['countries'] = $this->com->getCountries();
        $data['cities'] = $this->cm->getCities();
        $data['document_types'] = $this->dtm->getDocumentTypes();
        $data['content'] = "clients/form_client";
        $data['only_read'] = "true";
        $this->load->view('templates/admin/layout', $data);
    }

    public function create() {
        $data['person_types'] = $this->ptm->getPersonTypes();
        $data['client_types'] = $this->ctm->getClientTypes();
        $data['countries'] = $this->com->getCountries();
        $data['cities'] = $this->cm->getCities();
        $data['document_types'] = $this->dtm->getDocumentTypes();
        $data['content'] = "clients/form_client";
        $this->load->view('templates/admin/layout', $data);
    }

    public function store() {

        $this->form_validation->set_rules('person_type', 'Tipo de Persona', 'required|trim|xss_clean', array('required' => 'El Tipo de Persona es obligatorio'));
        $this->form_validation->set_rules('client_type', 'Tipo de Cliente', 'required|trim|xss_clean', array('required' => 'El Tipo de Cliente es obligatorio'));
        $this->form_validation->set_rules('name', 'Nombres', 'required|trim|xss_clean', array('required' => 'El Nombre del cliente es obligatorio'));
        $this->form_validation->set_rules('lastname', 'Apellidos', 'required|trim|xss_clean', array('required' => 'El Apellido del cliente es obligatorio'));
        $this->form_validation->set_rules('document_type', 'Tipo de Documento de Identificación', 'required|trim|xss_clean', array('required' => 'El Tipo de Documento de Identificación es obligatorio'));
        $this->form_validation->set_rules('document_number', 'Número de Documento de Identificación', 'required|trim|xss_clean|is_unique[clients.document_number]', array('required' => 'El Número de Documento de Identificación es obligatorio', 'is_unique' => 'El Número de Identificación ingresado ya se encuentra registrado'));
        $this->form_validation->set_rules('city_citizenship', 'Ciudad de Origen', 'required|trim|xss_clean', array('required' => 'La Ciudad de Origen del cliente es obligatoria'));
        $this->form_validation->set_rules('address', 'Dirección Contacto', 'required|trim|xss_clean', array('required' => 'La Dirección de Contacto del Cliente es obligatoria'));
        $this->form_validation->set_rules('phone_number', 'Teléfono de Contacto', 'required|trim|xss_clean', array('required' => 'El Teléfono de Contacto del Cliente es obligatorio'));
        $this->form_validation->set_rules('cellphone_number', 'Celular de Contacto', 'required|trim|xss_clean', array('required' => 'El Cellular de Contacto del Cliente es obligatorio'));
        $this->form_validation->set_rules('email', 'Correo Electrónico', 'required|trim|xss_clean|valid_email', array('required' => 'El Correo Electrónico del Cliente es obligatorio', 'valid_email' => 'El Correo Electrónico ingresado no es válido'));
        $this->form_validation->set_rules('company', 'Empresa', 'required', array('required|trim|xss_clean' => 'La Empresa del Cliente es obligatorio'));
        $this->form_validation->set_rules('position', 'Cargo', 'required', array('required|trim|xss_clean' => 'El Cargo del Cliente es obligatorio'));

        if ($this->form_validation->run()) {

            $insert = array(
                'person_type_id' => $this->input->post('person_type'),
                'client_type_id' => $this->input->post('client_type'),
                'name' => $this->input->post('name'),
                'lastname' => $this->input->post('lastname'),
                'document_type_id' => $this->input->post('document_type'),
                'document_number' => $this->input->post('document_number'),
                'city_id_citizenship' => $this->input->post('city_citizenship'),
                'address' => $this->input->post('address'),
                'phone_number' => $this->input->post('phone_number'),
                'cellphone_number' => $this->input->post('cellphone_number'),
                'email' => $this->input->post('email'),
                'company' => $this->input->post('company'),
                'position' => $this->input->post('position'),
                'created_by_user_id' => $this->session->userdata('user_id'),
                'offline_mode_create' => $this->mode
            );

            $this->clm->store($insert);
            $success = array('success' => 'El Cliente ha sido creado correctamente!');
            $this->session->set_flashdata('success', $success['success']);
            redirect('/clients');
        } else {
            $data['person_types'] = $this->ptm->getPersonTypes();
            $data['client_types'] = $this->ctm->getClientTypes();
            $data['countries'] = $this->com->getCountries();
            $data['cities'] = $this->cm->getCities();
            $data['document_types'] = $this->dtm->getDocumentTypes();
            $data['content'] = "clients/form_client";
            $this->load->view('templates/admin/layout', $data);
        }
    }

    public function edit() {

        $client = $this->clm->getClients($this->input->post('client_id'));
        $data['client'] = $client;
        $data['person_types'] = $this->ptm->getPersonTypes();
        $data['client_types'] = $this->ctm->getClientTypes();
        $data['countries'] = $this->com->getCountries();
        $data['cities'] = $this->cm->getCities($client[0]->country_code);
        $data['document_types'] = $this->dtm->getDocumentTypes();
        $data['content'] = "clients/form_client";
        $this->load->view('templates/admin/layout', $data);
    }

    public function update() {

        $is_unique = "";
        if ($this->input->post('document_number') != $this->input->post('document_number_old')) {
            $is_unique = '|is_unique[clients.document_number]';
        }

        $this->form_validation->set_rules('client_id', 'Id de Cliente', 'required|trim|xss_clean', array('required' => 'El Id del Cliente obligatorio'));
        $this->form_validation->set_rules('person_type', 'Tipo de Persona', 'required|trim|xss_clean', array('required' => 'El Tipo de Persona es obligatorio'));
        $this->form_validation->set_rules('client_type', 'Tipo de Cliente', 'required|trim|xss_clean', array('required' => 'El Tipo de Cliente es obligatorio'));
        $this->form_validation->set_rules('name', 'Nombres', 'required|trim|xss_clean', array('required' => 'El Nombre del cliente es obligatorio'));
        $this->form_validation->set_rules('lastname', 'Apellidos', 'required|trim|xss_clean', array('required' => 'El Apellido del cliente es obligatorio'));
        $this->form_validation->set_rules('document_type', 'Tipo de Documento de Identificación', 'required|trim|xss_clean', array('required' => 'El Tipo de Documento de Identificación es obligatorio'));
        $this->form_validation->set_rules('document_number', 'Número de Documento de Identificación', 'required|trim|xss_clean' . $is_unique, array('required' => 'El Número de Documento de Identificación es obligatorio', 'is_unique' => 'El Número de Identificación ingresado ya se encuentra registrado'));
        $this->form_validation->set_rules('city_citizenship', 'Ciudad de Origen', 'required|trim|xss_clean', array('required' => 'La Ciudad de Origen del cliente es obligatoria'));
        $this->form_validation->set_rules('address', 'Dirección Contacto', 'required|trim|xss_clean', array('required' => 'La Dirección de Contacto del Cliente es obligatoria'));
        $this->form_validation->set_rules('phone_number', 'Teléfono de Contacto', 'required|trim|xss_clean', array('required' => 'El Teléfono de Contacto del Cliente es obligatorio'));
        $this->form_validation->set_rules('cellphone_number', 'Celular de Contacto', 'required|trim|xss_clean', array('required' => 'El Celular de Contacto del Cliente es obligatorio'));
        $this->form_validation->set_rules('email', 'Correo Electrónico', 'required|trim|xss_clean|valid_email', array('required' => 'El Correo Electrónico del Cliente es obligatorio', 'valid_email' => 'El Correo Electrónico ingresado no es válido'));
        $this->form_validation->set_rules('company', 'Empresa', 'required|trim|xss_clean', array('required' => 'La Empresa del Cliente es obligatorio'));
        $this->form_validation->set_rules('position', 'Cargo', 'required|trim|xss_clean', array('required' => 'El Cargo del Cliente es obligatorio'));

        if ($this->form_validation->run()) {

            $update = array(
                'person_type_id' => $this->input->post('person_type'),
                'client_type_id' => $this->input->post('client_type'),
                'name' => $this->input->post('name'),
                'lastname' => $this->input->post('lastname'),
                'document_type_id' => $this->input->post('document_type'),
                'document_number' => $this->input->post('document_number'),
                'city_id_citizenship' => $this->input->post('city_citizenship'),
                'address' => $this->input->post('address'),
                'phone_number' => $this->input->post('phone_number'),
                'cellphone_number' => $this->input->post('cellphone_number'),
                'email' => $this->input->post('email'),
                'company' => $this->input->post('company'),
                'position' => $this->input->post('position'),
                'updated_by_user_id' => $this->session->userdata('user_id'),
                'offline_mode_update' => $this->mode
            );

            $this->clm->update($this->input->post('client_id'), $update);
            $success = array('success' => 'El Cliente ha sido actualizado correctamente!');
            $this->session->set_flashdata('success', $success['success']);
            redirect('/clients');
        } else {
//            $error = array('error' => $this->upload->display_errors());
//            $this->session->set_flashdata('error', $error['error']);

            $data['client'] = $this->clm->getClients($this->input->post('client_id'));
            $data['client_types'] = $this->ctm->getClientTypes();
            $data['countries'] = $this->com->getCountries();
            $data['cities'] = $this->cm->getCities();
            $data['document_types'] = $this->dtm->getDocumentTypes();
            $data['content'] = "clients/form_client";
            $this->load->view('templates/admin/layout', $data);
        }
    }

    public function store_Masive() {

        $config['upload_path'] = './uploads/clients';
        $config['allowed_types'] = '*';
        $config['max_size'] = 10000;
        $this->load->library('upload', $config);

        if ($this->upload->do_upload('masive_clients_file')) {

            $upload_data = $this->upload->data(); //Returns array of containing all of the data related to the file you uploaded.
            $file_name = $upload_data['file_name'];

            $obj_excel = PHPExcel_IOFactory::load('./uploads/clients/' . $file_name);
            $obj_excel->setActiveSheetIndex(0);
            $sheetData = $obj_excel->getActiveSheet()->toArray(null, true, true, true);

            $total_updated = 0;
            $total_error = 0;
            $log_error = "";

            foreach ($sheetData as $index => $value) {
                if ($index != 1) {
                    $log_error .= "Fila " . $index . ": ";
                    if ($value['A'] != '' && $value['B'] != '' && $value['C'] != '' && $value['D'] != '' && $value['E'] != '' && $value['F'] != '' && $value['G'] != '' && $value['H'] != '' && $value['I'] != '' && $value['J'] != '' && $value['K'] != '' && $value['L'] != '' && $value['M'] != '') {
                        $validate_error = true;

                        $person_type = $this->validatePersonType($value['A']);
                        if (!$person_type) {
                            $log_error .= "/Tipo de Persona Incorrecto/";
                            $validate_error = false;
                        }

                        $client_type = $this->validateClientType($value['B']);
                        if (!$client_type) {
                            $log_error .= "/Tipo de Cliente Incorrecto/";
                            $validate_error = false;
                        }

                        $document_type = $this->validateDocumentType($value['E']);
                        if (!$document_type) {
                            $log_error .= "/Tipo de Documento Incorrecto/";
                            $validate_error = false;
                        }

                        if (!$this->validateOnlyNumber($value['F'])) {
                            $log_error .= "/Numero de Documento debe contener solo numeros/";
                            $validate_error = false;
                        }

                        $city = $this->validateCityzenship($value['G']);
                        if (!$city) {
                            $log_error .= "/Ciudadania Incorrecta/";
                            $validate_error = false;
                        }

                        if (!$this->validateEmail($value['K'])) {
                            $log_error .= "/Email con formato Incorrecto/";
                            $validate_error = false;
                        }

                        if ($validate_error) {

                            $data = array(
                                'person_type_id' => $person_type,
                                'client_type_id' => $client_type,
                                'name' => $value['C'],
                                'lastname' => $value['D'],
                                'document_type_id' => $document_type,
                                'document_number' => $value['F'],
                                'city_id_citizenship' => $city,
                                'address' => $value['H'],
                                'phone_number' => $value['I'],
                                'cellphone_number' => $value['J'],
                                'email' => $value['K'],
                                'company' => $value['L'],
                                'position' => $value['M'],
                                'created_by_user_id' => $this->session->userdata('user_id')
                            );

                            $client = $this->clm->getClients("", $value['F']);
                            if (count($client) > 0) {
                                $processed = $this->clm->update($client[0]->client_id, $data);
                                $log_error .= "Registro Actualizado";
                            } else {
                                $processed = $this->clm->store($data);
                                $log_error .= "Registro Insertado";
                            }

                            $total_updated++;
                        } else {
                            $total_error++;
                        }
                    } else {
                        $log_error .= "/Hay uno o varios campos vacios/";
                        $total_error++;
                    }
                }
                $log_error .= PHP_EOL;
            }

            if ($total_error > 0) {
                $txt_name = "log_" . date("Y_m_d-H_i_s") . '.txt';
                if (write_file('./uploads/logs/' . $txt_name, $log_error)) {
                    $this->session->set_flashdata('error', 'Se encontraron errores en el archivo procesado. <a href="' . base_url() . 'uploads/logs/' . $txt_name . '" target="_blank"> Descargar Log</a>');
                } else {
                    $this->session->set_flashdata('error', 'Se encontraron errores en el archivo procesado pero no fue posible generar el Log de errores.');
                }
                redirect('/clients/create');
            } else {
                $this->session->set_flashdata('success', "El archivo fue procesado correctamente!");
                redirect('/clients');
            }
        } else {
            $this->session->set_flashdata('error', $this->upload->display_errors());
            redirect('/clients/create');
        }
    }

    function validatePersonType($name) {
        $person_type = $this->ptm->getPersonTypes("", $name);
        if (count($person_type) > 0) {
            return $person_type[0]->person_type_id;
        } else {
            return false;
        }
    }

    function validateClientType($name) {
        $client_type = $this->ctm->getClientTypes("", $name);
        if (count($client_type) > 0) {
            return $client_type[0]->client_type_id;
        } else {
            return false;
        }
    }

    function validateDocumentType($name) {
        $document_type = $this->dtm->getDocumentTypes("", $name);
        if (count($document_type) > 0) {
            return $document_type[0]->document_type_id;
        } else {
            return false;
        }
    }

    function validateCityzenship($name) {
        $city = $this->cm->getCities("", $name);
        if (count($city) > 0) {
            return $city[0]->city_id;
        } else {
            return false;
        }
    }

    function validateOnlyNumber($string) {
        if (preg_match('/^[0-9]+$/', $string)) {
            return true;
        } else {
            return false;
        }
    }

    function validateEmail($email) {
        $pattern = '/^(?!(?:(?:\\x22?\\x5C[\\x00-\\x7E]\\x22?)|(?:\\x22?[^\\x5C\\x22]\\x22?)){255,})(?!(?:(?:\\x22?\\x5C[\\x00-\\x7E]\\x22?)|(?:\\x22?[^\\x5C\\x22]\\x22?)){65,}@)(?:(?:[\\x21\\x23-\\x27\\x2A\\x2B\\x2D\\x2F-\\x39\\x3D\\x3F\\x5E-\\x7E]+)|(?:\\x22(?:[\\x01-\\x08\\x0B\\x0C\\x0E-\\x1F\\x21\\x23-\\x5B\\x5D-\\x7F]|(?:\\x5C[\\x00-\\x7F]))*\\x22))(?:\\.(?:(?:[\\x21\\x23-\\x27\\x2A\\x2B\\x2D\\x2F-\\x39\\x3D\\x3F\\x5E-\\x7E]+)|(?:\\x22(?:[\\x01-\\x08\\x0B\\x0C\\x0E-\\x1F\\x21\\x23-\\x5B\\x5D-\\x7F]|(?:\\x5C[\\x00-\\x7F]))*\\x22)))*@(?:(?:(?!.*[^.]{64,})(?:(?:(?:xn--)?[a-z0-9]+(?:-+[a-z0-9]+)*\\.){1,126}){1,}(?:(?:[a-z][a-z0-9]*)|(?:(?:xn--)[a-z0-9]+))(?:-+[a-z0-9]+)*)|(?:\\[(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){7})|(?:(?!(?:.*[a-f0-9][:\\]]){7,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?)))|(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){5}:)|(?:(?!(?:.*[a-f0-9]:){5,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3}:)?)))?(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))(?:\\.(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))){3}))\\]))$/iD';
        if (preg_match($pattern, $email) === 1) {
            return true;
        } else {
            return false;
        }
    }

    public function getCitiesByCountry() {
        $country_code = $this->input->post('country_code');
        $cities = $this->cm->getCities($country_code);
        echo json_encode($cities);
    }

}
