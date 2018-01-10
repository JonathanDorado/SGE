<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/*
  |--------------------------------------------------------------------------
  | Display Debug backtrace
  |--------------------------------------------------------------------------
  |
  | If set to TRUE, a backtrace will be displayed along with php errors. If
  | error_reporting is disabled, the backtrace will not display, regardless
  | of this setting
  |
 */
defined('SHOW_DEBUG_BACKTRACE') OR define('SHOW_DEBUG_BACKTRACE', TRUE);

/*
  |--------------------------------------------------------------------------
  | File and Directory Modes
  |--------------------------------------------------------------------------
  |
  | These prefs are used when checking and setting modes when working
  | with the file system.  The defaults are fine on servers with proper
  | security, but you may wish (or even need) to change the values in
  | certain environments (Apache running a separate process for each
  | user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
  | always be used to set the mode correctly.
  |
 */
defined('FILE_READ_MODE') OR define('FILE_READ_MODE', 0644);
defined('FILE_WRITE_MODE') OR define('FILE_WRITE_MODE', 0666);
defined('DIR_READ_MODE') OR define('DIR_READ_MODE', 0755);
defined('DIR_WRITE_MODE') OR define('DIR_WRITE_MODE', 0755);

/*
  |--------------------------------------------------------------------------
  | File Stream Modes
  |--------------------------------------------------------------------------
  |
  | These modes are used when working with fopen()/popen()
  |
 */
defined('FOPEN_READ') OR define('FOPEN_READ', 'rb');
defined('FOPEN_READ_WRITE') OR define('FOPEN_READ_WRITE', 'r+b');
defined('FOPEN_WRITE_CREATE_DESTRUCTIVE') OR define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care
defined('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE') OR define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care
defined('FOPEN_WRITE_CREATE') OR define('FOPEN_WRITE_CREATE', 'ab');
defined('FOPEN_READ_WRITE_CREATE') OR define('FOPEN_READ_WRITE_CREATE', 'a+b');
defined('FOPEN_WRITE_CREATE_STRICT') OR define('FOPEN_WRITE_CREATE_STRICT', 'xb');
defined('FOPEN_READ_WRITE_CREATE_STRICT') OR define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');

/*
  |--------------------------------------------------------------------------
  | Exit Status Codes
  |--------------------------------------------------------------------------
  |
  | Used to indicate the conditions under which the script is exit()ing.
  | While there is no universal standard for error codes, there are some
  | broad conventions.  Three such conventions are mentioned below, for
  | those who wish to make use of them.  The CodeIgniter defaults were
  | chosen for the least overlap with these conventions, while still
  | leaving room for others to be defined in future versions and user
  | applications.
  |
  | The three main conventions used for determining exit status codes
  | are as follows:
  |
  |    Standard C/C++ Library (stdlibc):
  |       http://www.gnu.org/software/libc/manual/html_node/Exit-Status.html
  |       (This link also contains other GNU-specific conventions)
  |    BSD sysexits.h:
  |       http://www.gsp.com/cgi-bin/man.cgi?section=3&topic=sysexits
  |    Bash scripting:
  |       http://tldp.org/LDP/abs/html/exitcodes.html
  |
 */
defined('EXIT_SUCCESS') OR define('EXIT_SUCCESS', 0); // no errors
defined('EXIT_ERROR') OR define('EXIT_ERROR', 1); // generic error
defined('EXIT_CONFIG') OR define('EXIT_CONFIG', 3); // configuration error
defined('EXIT_UNKNOWN_FILE') OR define('EXIT_UNKNOWN_FILE', 4); // file not found
defined('EXIT_UNKNOWN_CLASS') OR define('EXIT_UNKNOWN_CLASS', 5); // unknown class
defined('EXIT_UNKNOWN_METHOD') OR define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
defined('EXIT_USER_INPUT') OR define('EXIT_USER_INPUT', 7); // invalid user input
defined('EXIT_DATABASE') OR define('EXIT_DATABASE', 8); // database error
defined('EXIT__AUTO_MIN') OR define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
defined('EXIT__AUTO_MAX') OR define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code

define('IP_SERVER', 'localhost'); //Ip Server

$connected = @fsockopen("www.google.com", 80);
//website, port  (try 80 or 443)
if ($connected) {
    define('MODE', 'ONLINE');
    define('DATABASE', 'sge_platform');
//    define('MODE', 'OFFLINE');
//    define('DATABASE', 'sge_platform_offline');
    fclose($connected);
} else {
    define('MODE', 'OFFLINE');
    define('DATABASE', 'sge_platform_offline');
}

//The amount of these constants should be the same with the saved in the table permissions in database
define('ADD_DESIGN_EVENT', 'ADD_DESIGN_EVENT');
define('ADD_PROJECTION_EVENT', 'ADD_PROJECTION_EVENT');
define('ADD_SCORE_EVENT', 'ADD_SCORE_EVENT');
define('ASSIGN_SURVEY', 'ASSIGN_SURVEY');
define('ASSIGN_TOPICS', 'ASSIGN_TOPICS');
define('ASSISTANCE_EVENT', 'ASSISTANCE_EVENT');
define('ASSISTANCE_REPORT', 'ASSISTANCE_REPORT');
define('CONFIRMED_REPORT', 'CONFIRMED_REPORT');
define('CONFIRM_EVENT', 'CONFIRM_EVENT');
define('CREATE_CLIENTS', 'CREATE_CLIENTS');
define('CREATE_PRESENTIAL_EVENT', 'CREATE_PRESENTIAL_EVENT');
define('CREATE_PROVIDERS', 'CREATE_PROVIDERS');
define('CREATE_TOPIC', 'CREATE_TOPIC');
define('CREATE_USERS', 'CREATE_USERS');
define('CREATE_VIRTUAL_EVENT', 'CREATE_VIRTUAL_EVENT');
define('DASHBOARD_EVENT', 'DASHBOARD_EVENT');
define('DASHBOARD_PLATFORM', 'DASHBOARD_PLATFORM');
define('EDIT_CLIENTS', 'EDIT_CLIENTS');
define('EDIT_EVENTS', 'EDIT_EVENTS');
define('EDIT_PERMISSIONS_PROFILE', 'EDIT_PERMISSIONS_PROFILE');
define('EDIT_PROVIDERS', 'EDIT_PROVIDERS');
define('EDIT_TOPIC', 'EDIT_TOPIC');
define('EDIT_USERS', 'EDIT_USERS');
define('ENABLE_USER', 'ENABLE_USER');
define('EVENTS_CALENDAR', 'EVENTS_CALENDAR');
define('INVITE_EVENT', 'INVITE_EVENT');
define('PREREGISTER_REPORT', 'PREREGISTER_REPORT');
define('PRE_REGISTER_EVENT', 'PRE_REGISTER_EVENT');
define('RESET_PASSWORD_USER', 'RESET_PASSWORD_USER');
define('SCORE_CLIENTS_EVENTS', 'SCORE_CLIENTS_EVENTS');
define('SURVEY_REPORT', 'SURVEY_REPORT');
define('VIEW_CLIENTS', 'VIEW_CLIENTS');
define('VIEW_DETAIL_CLIENT', 'VIEW_DETAIL_CLIENT');
define('VIEW_DETAIL_PROVIDER', 'VIEW_DETAIL_PROVIDER');
define('VIEW_DETAIL_TOPIC', 'VIEW_DETAIL_TOPIC');
define('VIEW_DETAIL_USER', 'VIEW_DETAIL_USER');
define('VIEW_EVENTS', 'VIEW_EVENTS');
define('VIEW_EVENT_DETAIL', 'VIEW_EVENT_DETAIL');
define('VIEW_PROFILES', 'VIEW_PROFILES');
define('VIEW_PROVIDERS', 'VIEW_PROVIDERS');
define('VIEW_TOPICS', 'VIEW_TOPICS');
define('VIEW_USERS', 'VIEW_USERS');
define('SYNC_OFFLINE_DATA', 'SYNC_OFFLINE_DATA');
