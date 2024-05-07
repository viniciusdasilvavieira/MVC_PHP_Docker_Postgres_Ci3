<?php  if ( ! defined('BASEPATH')) exit("No direct script access allowed");

/**
 * Migrate Controller
 *
 * This controller provides endpoints to run database migrations using CodeIgniter's Migration library.
 */
class Migrate extends CI_Controller {

  /**
   * Constructor
   *
   * Loads the migration library.
   */
  public function __construct()
  {
    parent::__construct();
    $this->load->library('migration');
  }

  /**
   * Index Method
   *
   * Runs the latest migration available.
   * Displays an error message if migration fails.
   */
  public function index()
  {
    if ($this->migration->latest() === FALSE) {
      show_error($this->migration->error_string());
    } else {
      echo "Migrations run successfully" . PHP_EOL;
    }
  }

  /**
   * Version Method
   *
   * Runs a specific version of migration.
   *
   * @param int|null $version The version number of the migration to run.
   * Displays error messages if migrations fail.
   */
  public function version($version = null)
  {
    if ($version != null) {
      if ($this->migration->version($version) === FALSE) {
        show_error($this->migration->error_string());
      } else {
        echo "Migrations run successfully" . PHP_EOL;
      }
      return;
    }
    else {
      echo "Please provide a version";
    }
  }

  /**
   * Fresh Method
   *
   * Resets the database by running the initial migration (version 0) and then runs the latest migration.
   * Displays error messages if migrations fail.
   */
  public function fresh()
  {
    if ($this->migration->version(0) === FALSE) {
      show_error($this->migration->error_string());
      return;
    }

    if ($this->migration->latest() === FALSE) {
        show_error($this->migration->error_string());
    } else {
        echo "Migrations run successfully" . PHP_EOL;
    }
  }
}