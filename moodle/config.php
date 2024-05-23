<?php  // Moodle configuration file

unset($CFG);
global $CFG;
$CFG = new stdClass();

$CFG->dbtype    = 'mariadb';
$CFG->dblibrary = 'native';
$CFG->dbhost    = 'db'; // Name of the db service in docker-compose.yml
$CFG->dbname    = 'moodle_db';
$CFG->dbuser    = 'root';
$CFG->dbpass    = 'example'; // Ensure this matches the environment variable in docker-compose.yml
$CFG->prefix    = 'mdl_';
$CFG->dboptions = array (
  'dbpersist' => 0,
  'dbport' => 3306,
  'dbsocket' => '',
  'dbcollation' => 'utf8mb4_general_ci',
);

$CFG->wwwroot   = 'http://localhost:8080'; // Adjusted to include port if needed
$CFG->dataroot  = '/var/www/moodledata';
$CFG->admin     = 'admin';

$CFG->directorypermissions = 0777;

require_once(__DIR__ . '/lib/setup.php');

// There is no PHP closing tag in this file,
// it is intentional because it prevents trailing whitespace problems!
