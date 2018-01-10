<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_base extends CI_Migration {

	public function up() {
		ini_set('max_execution_time', 0); 
		## Create Table answer_options
		$this->dbforge->add_field("`answer_option_id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY");
		//$this->dbforge->add_key("answer_option_id",true);
		$this->dbforge->add_field("`name` varchar(100) NOT NULL ");
		$this->dbforge->add_field("`answer_group_id` int(11) NOT NULL ");
		$this->dbforge->add_field("`created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ");
		$this->dbforge->add_field("`updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' on update CURRENT_TIMESTAMP");
		$this->dbforge->add_field("`active` tinyint(1) NOT NULL DEFAULT '1' ");
		$this->dbforge->create_table("answer_options", TRUE);
		$this->db->query('ALTER TABLE  `answer_options` ENGINE = InnoDB');
		## Create Table answer_types
		$this->dbforge->add_field("`answer_type_id` int(11) NOT NULL auto_increment PRIMARY KEY");
		$this->dbforge->add_key("answer_type_id",true);
		$this->dbforge->add_field("`name` varchar(100) NOT NULL ");
		$this->dbforge->add_field("`created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ");
		$this->dbforge->add_field("`updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' on update CURRENT_TIMESTAMP");
		$this->dbforge->add_field("`active` tinyint(1) NOT NULL DEFAULT '1' ");
		$this->dbforge->create_table("answer_types", TRUE);
		$this->db->query('ALTER TABLE  `answer_types` ENGINE = InnoDB');
		## Create Table answers_groups
		$this->dbforge->add_field("`answer_group_id` int(11) NOT NULL auto_increment PRIMARY KEY");
		$this->dbforge->add_key("answer_group_id",true);
		$this->dbforge->add_field("`name` varchar(100) NOT NULL ");
		$this->dbforge->add_field("`answer_type_id` int(11) NOT NULL ");
		$this->dbforge->add_field("`created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ");
		$this->dbforge->add_field("`updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' on update CURRENT_TIMESTAMP");
		$this->dbforge->add_field("`active` tinyint(1) NOT NULL DEFAULT '1' ");
		$this->dbforge->create_table("answers_groups", TRUE);
		$this->db->query('ALTER TABLE  `answers_groups` ENGINE = InnoDB');
		## Create Table areas
		$this->dbforge->add_field("`area_id` int(11) NOT NULL auto_increment PRIMARY KEY");
		$this->dbforge->add_key("area_id",true);
		$this->dbforge->add_field("`name` varchar(100) NOT NULL ");
		$this->dbforge->add_field("`created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ");
		$this->dbforge->add_field("`updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' on update CURRENT_TIMESTAMP");
		$this->dbforge->add_field("`active` tinyint(1) NOT NULL DEFAULT '1' ");
		$this->dbforge->create_table("areas", TRUE);
		$this->db->query('ALTER TABLE  `areas` ENGINE = InnoDB');
		## Create Table arl
		$this->dbforge->add_field("`arl_id` int(11) NOT NULL auto_increment PRIMARY KEY");
		$this->dbforge->add_key("arl_id",true);
		$this->dbforge->add_field("`name` varchar(100) NOT NULL ");
		$this->dbforge->add_field("`created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ");
		$this->dbforge->add_field("`updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' on update CURRENT_TIMESTAMP");
		$this->dbforge->add_field("`active` tinyint(1) NOT NULL DEFAULT '1' ");
		$this->dbforge->create_table("arl", TRUE);
		$this->db->query('ALTER TABLE  `arl` ENGINE = InnoDB');
		## Create Table cities
		$this->dbforge->add_field("`city_id` int(11) NOT NULL auto_increment PRIMARY KEY");
		$this->dbforge->add_key("city_id",true);
		$this->dbforge->add_field("`name` varchar(100) NOT NULL ");
		$this->dbforge->add_field("`country_id` int(11) NOT NULL ");
		$this->dbforge->add_field("`created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ");
		$this->dbforge->add_field("`updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' on update CURRENT_TIMESTAMP");
		$this->dbforge->add_field("`active` tinyint(1) NOT NULL DEFAULT '1' ");
		$this->dbforge->create_table("cities", TRUE);
		$this->db->query('ALTER TABLE  `cities` ENGINE = InnoDB');
		## Create Table client_types
		$this->dbforge->add_field("`client_type_id` int(11) NOT NULL auto_increment PRIMARY KEY");
		$this->dbforge->add_key("client_type_id",true);
		$this->dbforge->add_field("`name` varchar(100) NOT NULL ");
		$this->dbforge->add_field("`created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ");
		$this->dbforge->add_field("`updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' on update CURRENT_TIMESTAMP");
		$this->dbforge->add_field("`active` tinyint(1) NOT NULL DEFAULT '1' ");
		$this->dbforge->create_table("client_types", TRUE);
		$this->db->query('ALTER TABLE  `client_types` ENGINE = InnoDB');
		## Create Table clients
		$this->dbforge->add_field("`client_id` bigint(20) NOT NULL auto_increment PRIMARY KEY");
		$this->dbforge->add_key("client_id",true);
		$this->dbforge->add_field("`client_type_id` int(11) NOT NULL ");
		$this->dbforge->add_field("`affiliated` tinyint(1) NOT NULL ");
		$this->dbforge->add_field("`name` varchar(100) NOT NULL ");
		$this->dbforge->add_field("`lastname` varchar(100) NOT NULL ");
		$this->dbforge->add_field("`document_type_id` int(11) NOT NULL ");
		$this->dbforge->add_field("`document_number` bigint(20) NOT NULL ");
		$this->dbforge->add_field("`country_id_citizenship` int(11) NOT NULL ");
		$this->dbforge->add_field("`address` varchar(100) NOT NULL ");
		$this->dbforge->add_field("`phone_number` varchar(20) NOT NULL ");
		$this->dbforge->add_field("`cellphone_number` varchar(20) NOT NULL ");
		$this->dbforge->add_field("`email` varchar(100) NOT NULL ");
		$this->dbforge->add_field("`company` varchar(100) NOT NULL ");
		$this->dbforge->add_field("`position` varchar(100) NOT NULL ");
		$this->dbforge->add_field("`habeas_data` tinyint(1) NULL ");
		$this->dbforge->add_field("`created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ");
		$this->dbforge->add_field("`updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' on update CURRENT_TIMESTAMP");
		$this->dbforge->add_field("`active` tinyint(1) NOT NULL DEFAULT '1' ");
		$this->dbforge->add_field("`user_id_register` bigint(20) NOT NULL ");
		$this->dbforge->add_field("`registered_by` varchar(50) NULL ");
		$this->dbforge->create_table("clients", TRUE);
		$this->db->query('ALTER TABLE  `clients` ENGINE = InnoDB');
		## Create Table consultant_clasifications
		$this->dbforge->add_field("`consultant_clasification_id` int(11) NOT NULL auto_increment PRIMARY KEY");
		$this->dbforge->add_key("consultant_clasification_id",true);
		$this->dbforge->add_field("`name` varchar(100) NOT NULL ");
		$this->dbforge->add_field("`created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ");
		$this->dbforge->add_field("`updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' on update CURRENT_TIMESTAMP");
		$this->dbforge->add_field("`active` tinyint(1) NOT NULL DEFAULT '1' ");
		$this->dbforge->create_table("consultant_clasifications", TRUE);
		$this->db->query('ALTER TABLE  `consultant_clasifications` ENGINE = InnoDB');
		## Create Table countries
		$this->dbforge->add_field("`country_id` int(11) NOT NULL auto_increment PRIMARY KEY");
		$this->dbforge->add_key("country_id",true);
		$this->dbforge->add_field("`name` varchar(100) NOT NULL ");
		$this->dbforge->add_field("`created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ");
		$this->dbforge->add_field("`updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' on update CURRENT_TIMESTAMP");
		$this->dbforge->add_field("`active` tinyint(1) NOT NULL DEFAULT '1' ");
		$this->dbforge->create_table("countries", TRUE);
		$this->db->query('ALTER TABLE  `countries` ENGINE = InnoDB');
		## Create Table document_types
		$this->dbforge->add_field("`document_type_id` int(11) NOT NULL auto_increment PRIMARY KEY");
		$this->dbforge->add_key("document_type_id",true);
		$this->dbforge->add_field("`name` varchar(100) NOT NULL ");
		$this->dbforge->add_field("`created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ");
		$this->dbforge->add_field("`updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' on update CURRENT_TIMESTAMP");
		$this->dbforge->add_field("`active` tinyint(1) NOT NULL DEFAULT '1' ");
		$this->dbforge->create_table("document_types", TRUE);
		$this->db->query('ALTER TABLE  `document_types` ENGINE = InnoDB');
		## Create Table event_assistance_types
		$this->dbforge->add_field("`event_assistance_type_id` int(11) NOT NULL auto_increment PRIMARY KEY");
		$this->dbforge->add_key("event_assistance_type_id",true);
		$this->dbforge->add_field("`name` varchar(100) NOT NULL ");
		$this->dbforge->add_field("`created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ");
		$this->dbforge->add_field("`updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' on update CURRENT_TIMESTAMP");
		$this->dbforge->add_field("`active` tinyint(1) NOT NULL DEFAULT '1' ");
		$this->dbforge->create_table("event_assistance_types", TRUE);
		$this->db->query('ALTER TABLE  `event_assistance_types` ENGINE = InnoDB');
		## Create Table event_audience_types
		$this->dbforge->add_field("`event_audience_type_id` int(11) NOT NULL auto_increment PRIMARY KEY");
		$this->dbforge->add_key("event_audience_type_id",true);
		$this->dbforge->add_field("`name` varchar(100) NOT NULL ");
		$this->dbforge->add_field("`created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ");
		$this->dbforge->add_field("`updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' on update CURRENT_TIMESTAMP");
		$this->dbforge->add_field("`active` tinyint(1) NOT NULL DEFAULT '1' ");
		$this->dbforge->create_table("event_audience_types", TRUE);
		$this->db->query('ALTER TABLE  `event_audience_types` ENGINE = InnoDB');
		## Create Table event_client_payment
		$this->dbforge->add_field("`event_client_payment_id` bigint(20) NOT NULL auto_increment PRIMARY KEY");
		$this->dbforge->add_key("event_client_payment_id",true);
		$this->dbforge->add_field("`event_client_id` bigint(20) NOT NULL ");
		$this->dbforge->add_field("`event_location_id` bigint(20) NOT NULL ");
		$this->dbforge->add_field("`payment_type_id` int(11) NOT NULL ");
		$this->dbforge->add_field("`arl_id` int(11) NOT NULL ");
		$this->dbforge->add_field("`price` int(11) NOT NULL ");
		$this->dbforge->add_field("`comment` varchar(200) NULL ");
		$this->dbforge->add_field("`order_number` int(11) NULL ");
		$this->dbforge->add_field("`isPaid` tinyint(1) NOT NULL ");
		$this->dbforge->add_field("`created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ");
		$this->dbforge->add_field("`updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' on update CURRENT_TIMESTAMP");
		$this->dbforge->add_field("`active` tinyint(1) NOT NULL DEFAULT '1' ");
		$this->dbforge->add_field("`user_id_register` bigint(20) NOT NULL ");
		$this->dbforge->add_field("`invoice_code` varchar(100) NULL ");
		$this->dbforge->add_field("`event_id` int(11) NULL ");
		$this->dbforge->create_table("event_client_payment", TRUE);
		$this->db->query('ALTER TABLE  `event_client_payment` ENGINE = InnoDB');
		## Create Table event_client_scores
		$this->dbforge->add_field("`event_client_score_id` bigint(20) NOT NULL auto_increment PRIMARY KEY");
		$this->dbforge->add_key("event_client_score_id",true);
		$this->dbforge->add_field("`event_client_id` bigint(20) NOT NULL ");
		$this->dbforge->add_field("`score` int(11) NOT NULL ");
		$this->dbforge->add_field("`created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ");
		$this->dbforge->add_field("`updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' on update CURRENT_TIMESTAMP");
		$this->dbforge->add_field("`active` tinyint(1) NULL DEFAULT '1' ");
		$this->dbforge->add_field("`user_register_id` bigint(20) NOT NULL ");
		$this->dbforge->create_table("event_client_scores", TRUE);
		$this->db->query('ALTER TABLE  `event_client_scores` ENGINE = InnoDB');
		## Create Table event_clients
		$this->dbforge->add_field("`event_client_id` int(11) NOT NULL auto_increment PRIMARY KEY");
		$this->dbforge->add_key("event_client_id",true);
		$this->dbforge->add_field("`event_id` bigint(20) NOT NULL ");
		$this->dbforge->add_field("`client_id` bigint(20) NOT NULL ");
		$this->dbforge->add_field("`state_id` int(11) NOT NULL ");
		$this->dbforge->add_field("`created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ");
		$this->dbforge->add_field("`updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' on update CURRENT_TIMESTAMP");
		$this->dbforge->add_field("`active` tinyint(1) NOT NULL DEFAULT '1' ");
		$this->dbforge->add_field("`user_id_register` bigint(20) NOT NULL ");
		$this->dbforge->create_table("event_clients", TRUE);
		$this->db->query('ALTER TABLE  `event_clients` ENGINE = InnoDB');
		## Create Table event_guests
		$this->dbforge->add_field("`event_guest_id` bigint(20) NOT NULL auto_increment PRIMARY KEY");
		$this->dbforge->add_key("event_guest_id",true);
		$this->dbforge->add_field("`event_id` bigint(20) NOT NULL ");
		$this->dbforge->add_field("`email` varchar(100) NOT NULL ");
		$this->dbforge->add_field("`reply_to_invitation` tinyint(1) NOT NULL ");
		$this->dbforge->add_field("`isInterested` tinyint(1) NOT NULL ");
		$this->dbforge->add_field("`created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ");
		$this->dbforge->add_field("`updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' on update CURRENT_TIMESTAMP");
		$this->dbforge->add_field("`active` tinyint(1) NOT NULL DEFAULT '1' ");
		$this->dbforge->add_field("`user_id_register` bigint(20) NOT NULL ");
		$this->dbforge->create_table("event_guests", TRUE);
		$this->db->query('ALTER TABLE  `event_guests` ENGINE = InnoDB');
		## Create Table event_locations
		$this->dbforge->add_field("`event_location_id` bigint(20) NOT NULL auto_increment PRIMARY KEY");
		$this->dbforge->add_key("event_location_id",true);
		$this->dbforge->add_field("`event_id` bigint(20) NOT NULL ");
		$this->dbforge->add_field("`city_id` int(11) NOT NULL ");
		$this->dbforge->add_field("`place` varchar(100) NOT NULL ");
		$this->dbforge->add_field("`date_from` date NOT NULL ");
		$this->dbforge->add_field("`date_until` date NOT NULL ");
		$this->dbforge->add_field("`total_hours` int(11) NOT NULL ");
		$this->dbforge->add_field("`created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ");
		$this->dbforge->add_field("`updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' on update CURRENT_TIMESTAMP");
		$this->dbforge->add_field("`active` tinyint(1) NOT NULL DEFAULT '1' ");
		$this->dbforge->create_table("event_locations", TRUE);
		$this->db->query('ALTER TABLE  `event_locations` ENGINE = InnoDB');
		## Create Table event_survey_clients
		$this->dbforge->add_field("`event_survey_client_id` bigint(20) NOT NULL auto_increment PRIMARY KEY");
		$this->dbforge->add_key("event_survey_client_id",true);
		$this->dbforge->add_field("`event_survey_id` bigint(20) NOT NULL ");
		$this->dbforge->add_field("`client_id` bigint(20) NOT NULL ");
		$this->dbforge->add_field("`answer_option_id` int(11) NOT NULL ");
		$this->dbforge->add_field("`comment` varchar(200) NULL ");
		$this->dbforge->add_field("`created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ");
		$this->dbforge->add_field("`updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' on update CURRENT_TIMESTAMP");
		$this->dbforge->add_field("`active` tinyint(1) NOT NULL DEFAULT '1' ");
		$this->dbforge->create_table("event_survey_clients", TRUE);
		$this->db->query('ALTER TABLE  `event_survey_clients` ENGINE = InnoDB');
		## Create Table event_surveys
		$this->dbforge->add_field("`event_survey_id` bigint(20) NOT NULL auto_increment PRIMARY KEY");
		$this->dbforge->add_key("event_survey_id",true);
		$this->dbforge->add_field("`event_id` bigint(20) NOT NULL ");
		$this->dbforge->add_field("`question` varchar(200) NOT NULL ");
		$this->dbforge->add_field("`answer_type_id` int(11) NOT NULL ");
		$this->dbforge->add_field("`answer_group_id` int(11) NOT NULL ");
		$this->dbforge->add_field("`created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ");
		$this->dbforge->add_field("`updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' on update CURRENT_TIMESTAMP");
		$this->dbforge->add_field("`active` tinyint(1) NOT NULL DEFAULT '1' ");
		$this->dbforge->add_field("`user_id_register` bigint(20) NOT NULL ");
		$this->dbforge->create_table("event_surveys", TRUE);
		$this->db->query('ALTER TABLE  `event_surveys` ENGINE = InnoDB');
		## Create Table event_topics
		$this->dbforge->add_field("`event_topic_id` bigint(20) NOT NULL auto_increment PRIMARY KEY");
		$this->dbforge->add_key("event_topic_id",true);
		$this->dbforge->add_field("`event_id` bigint(20) NOT NULL ");
		$this->dbforge->add_field("`topic_id` bigint(20) NOT NULL ");
		$this->dbforge->add_field("`provider_id` bigint(20) NOT NULL ");
		$this->dbforge->add_field("`total_hours` int(11) NOT NULL ");
		$this->dbforge->add_field("`url_memories` varchar(100) NULL ");
		$this->dbforge->add_field("`created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ");
		$this->dbforge->add_field("`updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' on update CURRENT_TIMESTAMP");
		$this->dbforge->add_field("`active` tinyint(1) NOT NULL DEFAULT '1' ");
		$this->dbforge->add_field("`user_id_register` bigint(20) NOT NULL ");
		$this->dbforge->create_table("event_topics", TRUE);
		$this->db->query('ALTER TABLE  `event_topics` ENGINE = InnoDB');
		## Create Table event_types
		$this->dbforge->add_field("`event_type_id` int(11) NOT NULL auto_increment PRIMARY KEY");
		$this->dbforge->add_key("event_type_id",true);
		$this->dbforge->add_field("`name` varchar(100) NOT NULL ");
		$this->dbforge->add_field("`created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ");
		$this->dbforge->add_field("`updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' on update CURRENT_TIMESTAMP");
		$this->dbforge->add_field("`active` tinyint(1) NOT NULL DEFAULT '1' ");
		$this->dbforge->create_table("event_types", TRUE);
		$this->db->query('ALTER TABLE  `event_types` ENGINE = InnoDB');
		## Create Table events
		$this->dbforge->add_field("`event_id` bigint(20) NOT NULL auto_increment PRIMARY KEY");
		$this->dbforge->add_key("event_id",true);
		$this->dbforge->add_field("`name` varchar(100) NOT NULL ");
		$this->dbforge->add_field("`date_from` date NOT NULL ");
		$this->dbforge->add_field("`date_until` date NOT NULL ");
		$this->dbforge->add_field("`event_assistance_type_id` int(11) NOT NULL ");
		$this->dbforge->add_field("`event_type_id` int(11) NOT NULL ");
		$this->dbforge->add_field("`event_audience_type_id` int(11) NOT NULL ");
		$this->dbforge->add_field("`training_platform_id` int(11) NOT NULL ");
		$this->dbforge->add_field("`total_hours` int(11) NOT NULL ");
		$this->dbforge->add_field("`isScoreRequired` tinyint(1) NOT NULL ");
		$this->dbforge->add_field("`state_id` int(11) NOT NULL ");
		$this->dbforge->add_field("`projected_guests` int(11) NOT NULL ");
		$this->dbforge->add_field("`projected_pre_registered` int(11) NOT NULL ");
		$this->dbforge->add_field("`projected_confirmed` int(11) NOT NULL ");
		$this->dbforge->add_field("`url_logo` varchar(100) NOT NULL ");
		$this->dbforge->add_field("`url_template_assistance_certificate` varchar(100) NOT NULL ");
		$this->dbforge->add_field("`url_template_certificate` varchar(100) NOT NULL ");
		$this->dbforge->add_field("`url_logo_landing_page` varchar(100) NULL ");
		$this->dbforge->add_field("`created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ");
		$this->dbforge->add_field("`updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' on update CURRENT_TIMESTAMP");
		$this->dbforge->add_field("`active` tinyint(1) NOT NULL DEFAULT '1' ");
		$this->dbforge->add_field("`user_id_register` bigint(20) NOT NULL ");
		$this->dbforge->add_field("`isclosed` tinyint(1) NULL ");
		$this->dbforge->create_table("events", TRUE);
		$this->db->query('ALTER TABLE  `events` ENGINE = InnoDB');
		## Create Table payment_types
		$this->dbforge->add_field("`payment_type_id` int(11) NOT NULL auto_increment PRIMARY KEY");
		$this->dbforge->add_key("payment_type_id",true);
		$this->dbforge->add_field("`name` varchar(100) NOT NULL ");
		$this->dbforge->add_field("`created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ");
		$this->dbforge->add_field("`updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' on update CURRENT_TIMESTAMP");
		$this->dbforge->add_field("`active` tinyint(1) NOT NULL DEFAULT '1' ");
		$this->dbforge->create_table("payment_types", TRUE);
		$this->db->query('ALTER TABLE  `payment_types` ENGINE = InnoDB');
		## Create Table permissions
		$this->dbforge->add_field("`permission_id` int(11) NOT NULL auto_increment PRIMARY KEY");
		$this->dbforge->add_key("permission_id",true);
		$this->dbforge->add_field("`name` varchar(100) NOT NULL ");
		$this->dbforge->add_field("`created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ");
		$this->dbforge->add_field("`updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' on update CURRENT_TIMESTAMP");
		$this->dbforge->add_field("`active` tinyint(1) NOT NULL DEFAULT '1' ");
		$this->dbforge->create_table("permissions", TRUE);
		$this->db->query('ALTER TABLE  `permissions` ENGINE = InnoDB');
		## Create Table profile_permissions
		$this->dbforge->add_field("`profile_permission_id` int(11) NOT NULL auto_increment PRIMARY KEY");
		$this->dbforge->add_key("profile_permission_id",true);
		$this->dbforge->add_field("`profile_id` int(11) NOT NULL ");
		$this->dbforge->add_field("`permission_id` int(11) NOT NULL ");
		$this->dbforge->add_field("`created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ");
		$this->dbforge->add_field("`updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' on update CURRENT_TIMESTAMP");
		$this->dbforge->add_field("`active` tinyint(1) NOT NULL DEFAULT '1' ");
		$this->dbforge->create_table("profile_permissions", TRUE);
		$this->db->query('ALTER TABLE  `profile_permissions` ENGINE = InnoDB');
		## Create Table profiles
		$this->dbforge->add_field("`profile_id` int(11) NOT NULL auto_increment PRIMARY KEY");
		$this->dbforge->add_key("profile_id",true);
		$this->dbforge->add_field("`name` varchar(100) NOT NULL ");
		$this->dbforge->add_field("`created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ");
		$this->dbforge->add_field("`updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' on update CURRENT_TIMESTAMP");
		$this->dbforge->add_field("`active` tinyint(1) NOT NULL DEFAULT '1' ");
		$this->dbforge->create_table("profiles", TRUE);
		$this->db->query('ALTER TABLE  `profiles` ENGINE = InnoDB');
		## Create Table provider_types
		$this->dbforge->add_field("`provider_type_id` int(11) NOT NULL auto_increment PRIMARY KEY");
		$this->dbforge->add_key("provider_type_id",true);
		$this->dbforge->add_field("`name` varchar(100) NOT NULL ");
		$this->dbforge->add_field("`created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ");
		$this->dbforge->add_field("`updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' on update CURRENT_TIMESTAMP");
		$this->dbforge->add_field("`active` tinyint(1) NOT NULL DEFAULT '1' ");
		$this->dbforge->create_table("provider_types", TRUE);
		$this->db->query('ALTER TABLE  `provider_types` ENGINE = InnoDB');
		## Create Table providers
		$this->dbforge->add_field("`provider_id` bigint(20) NOT NULL auto_increment PRIMARY KEY");
		$this->dbforge->add_key("provider_id",true);
		$this->dbforge->add_field("`provider_type_id` int(11) NOT NULL ");
		$this->dbforge->add_field("`name` varchar(100) NOT NULL ");
		$this->dbforge->add_field("`lastname` varchar(100) NOT NULL ");
		$this->dbforge->add_field("`document_type_id` int(11) NOT NULL ");
		$this->dbforge->add_field("`document_number` int(20) NOT NULL ");
		$this->dbforge->add_field("`date_birthday` date NOT NULL ");
		$this->dbforge->add_field("`date_start_ccs` date NOT NULL ");
		$this->dbforge->add_field("`area_id` int(11) NOT NULL ");
		$this->dbforge->add_field("`thematic_area_type_id` int(11) NOT NULL ");
		$this->dbforge->add_field("`consultant_clasification_id` int(11) NOT NULL ");
		$this->dbforge->add_field("`created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ");
		$this->dbforge->add_field("`updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' on update CURRENT_TIMESTAMP");
		$this->dbforge->add_field("`active` tinyint(1) NOT NULL DEFAULT '1' ");
		$this->dbforge->create_table("providers", TRUE);
		$this->db->query('ALTER TABLE  `providers` ENGINE = InnoDB');
		## Create Table states
		$this->dbforge->add_field("`state_id` int(11) NOT NULL auto_increment PRIMARY KEY");
		$this->dbforge->add_key("state_id",true);
		$this->dbforge->add_field("`name` varchar(100) NOT NULL ");
		$this->dbforge->add_field("`created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ");
		$this->dbforge->add_field("`updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' on update CURRENT_TIMESTAMP");
		$this->dbforge->add_field("`active` tinyint(1) NOT NULL ");
		$this->dbforge->create_table("states", TRUE);
		$this->db->query('ALTER TABLE  `states` ENGINE = InnoDB');
		## Create Table thematic_area_types
		$this->dbforge->add_field("`thematic_area_type_id` int(11) NOT NULL auto_increment PRIMARY KEY");
		$this->dbforge->add_key("thematic_area_type_id",true);
		$this->dbforge->add_field("`name` varchar(100) NOT NULL ");
		$this->dbforge->add_field("`created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ");
		$this->dbforge->add_field("`updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' on update CURRENT_TIMESTAMP");
		$this->dbforge->add_field("`active` tinyint(1) NOT NULL DEFAULT '1' ");
		$this->dbforge->create_table("thematic_area_types", TRUE);
		$this->db->query('ALTER TABLE  `thematic_area_types` ENGINE = InnoDB');
		## Create Table topics
		$this->dbforge->add_field("`topic_id` bigint(20) NOT NULL auto_increment PRIMARY KEY");
		$this->dbforge->add_key("topic_id",true);
		$this->dbforge->add_field("`name` varchar(100) NOT NULL ");
		$this->dbforge->add_field("`thematic_area_type_id` int(11) NOT NULL ");
		$this->dbforge->add_field("`created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ");
		$this->dbforge->add_field("`updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' on update CURRENT_TIMESTAMP");
		$this->dbforge->add_field("`active` tinyint(1) NOT NULL DEFAULT '1' ");
		$this->dbforge->create_table("topics", TRUE);
		$this->db->query('ALTER TABLE  `topics` ENGINE = InnoDB');
		## Create Table training_platforms
		$this->dbforge->add_field("`training_platform_id` int(11) NOT NULL auto_increment PRIMARY KEY");
		$this->dbforge->add_key("training_platform_id",true);
		$this->dbforge->add_field("`name` varchar(100) NOT NULL ");
		$this->dbforge->add_field("`created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ");
		$this->dbforge->add_field("`updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' on update CURRENT_TIMESTAMP");
		$this->dbforge->add_field("`active` tinyint(1) NOT NULL DEFAULT '1' ");
		$this->dbforge->create_table("training_platforms", TRUE);
		$this->db->query('ALTER TABLE  `training_platforms` ENGINE = InnoDB');
		## Create Table training_types
		$this->dbforge->add_field("`training_type_id` int(11) NOT NULL auto_increment PRIMARY KEY");
		$this->dbforge->add_key("training_type_id",true);
		$this->dbforge->add_field("`name` varchar(100) NOT NULL ");
		$this->dbforge->add_field("`created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ");
		$this->dbforge->add_field("`updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' on update CURRENT_TIMESTAMP");
		$this->dbforge->add_field("`active` tinyint(1) NOT NULL DEFAULT '1' ");
		$this->dbforge->create_table("training_types", TRUE);
		$this->db->query('ALTER TABLE  `training_types` ENGINE = InnoDB');
		## Create Table users
		$this->dbforge->add_field("`user_id` bigint(20) NOT NULL auto_increment PRIMARY KEY");
		$this->dbforge->add_key("user_id",true);
		$this->dbforge->add_field("`name` varchar(100) NOT NULL ");
		$this->dbforge->add_field("`lastname` varchar(100) NOT NULL ");
		$this->dbforge->add_field("`email` varchar(100) NOT NULL ");
		$this->dbforge->add_field("`password` varchar(100) NOT NULL ");
		$this->dbforge->add_field("`remember_token` varchar(200) NULL ");
		$this->dbforge->add_field("`profile_id` int(11) NOT NULL ");
		$this->dbforge->add_field("`created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ");
		$this->dbforge->add_field("`updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' on update CURRENT_TIMESTAMP");
		$this->dbforge->add_field("`active` tinyint(1) NOT NULL DEFAULT '1' ");
		$this->dbforge->create_table("users", TRUE);
		$this->db->query('ALTER TABLE  `users` ENGINE = InnoDB');
		ini_set('max_execution_time', 30); 
	 }

	public function down()	{
		### Drop table answer_options ##
		$this->dbforge->drop_table("answer_options", TRUE);
		### Drop table answer_types ##
		$this->dbforge->drop_table("answer_types", TRUE);
		### Drop table answers_groups ##
		$this->dbforge->drop_table("answers_groups", TRUE);
		### Drop table areas ##
		$this->dbforge->drop_table("areas", TRUE);
		### Drop table arl ##
		$this->dbforge->drop_table("arl", TRUE);
		### Drop table cities ##
		$this->dbforge->drop_table("cities", TRUE);
		### Drop table client_types ##
		$this->dbforge->drop_table("client_types", TRUE);
		### Drop table clients ##
		$this->dbforge->drop_table("clients", TRUE);
		### Drop table consultant_clasifications ##
		$this->dbforge->drop_table("consultant_clasifications", TRUE);
		### Drop table countries ##
		$this->dbforge->drop_table("countries", TRUE);
		### Drop table document_types ##
		$this->dbforge->drop_table("document_types", TRUE);
		### Drop table event_assistance_types ##
		$this->dbforge->drop_table("event_assistance_types", TRUE);
		### Drop table event_audience_types ##
		$this->dbforge->drop_table("event_audience_types", TRUE);
		### Drop table event_client_payment ##
		$this->dbforge->drop_table("event_client_payment", TRUE);
		### Drop table event_client_scores ##
		$this->dbforge->drop_table("event_client_scores", TRUE);
		### Drop table event_clients ##
		$this->dbforge->drop_table("event_clients", TRUE);
		### Drop table event_guests ##
		$this->dbforge->drop_table("event_guests", TRUE);
		### Drop table event_locations ##
		$this->dbforge->drop_table("event_locations", TRUE);
		### Drop table event_survey_clients ##
		$this->dbforge->drop_table("event_survey_clients", TRUE);
		### Drop table event_surveys ##
		$this->dbforge->drop_table("event_surveys", TRUE);
		### Drop table event_topics ##
		$this->dbforge->drop_table("event_topics", TRUE);
		### Drop table event_types ##
		$this->dbforge->drop_table("event_types", TRUE);
		### Drop table events ##
		$this->dbforge->drop_table("events", TRUE);
		### Drop table payment_types ##
		$this->dbforge->drop_table("payment_types", TRUE);
		### Drop table permissions ##
		$this->dbforge->drop_table("permissions", TRUE);
		### Drop table profile_permissions ##
		$this->dbforge->drop_table("profile_permissions", TRUE);
		### Drop table profiles ##
		$this->dbforge->drop_table("profiles", TRUE);
		### Drop table provider_types ##
		$this->dbforge->drop_table("provider_types", TRUE);
		### Drop table providers ##
		$this->dbforge->drop_table("providers", TRUE);
		### Drop table states ##
		$this->dbforge->drop_table("states", TRUE);
		### Drop table thematic_area_types ##
		$this->dbforge->drop_table("thematic_area_types", TRUE);
		### Drop table topics ##
		$this->dbforge->drop_table("topics", TRUE);
		### Drop table training_platforms ##
		$this->dbforge->drop_table("training_platforms", TRUE);
		### Drop table training_types ##
		$this->dbforge->drop_table("training_types", TRUE);
		### Drop table users ##
		$this->dbforge->drop_table("users", TRUE);

	}
}