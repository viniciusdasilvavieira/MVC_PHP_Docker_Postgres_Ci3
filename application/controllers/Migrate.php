<?php  if ( ! defined('BASEPATH')) exit("No direct script access allowed");

class Migrate extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
    $this->load->library('migration');
  }

  //runs migrations
  public function index()
  {
    if ($this->migration->latest() === FALSE) {
      show_error($this->migration->error_string());
    } else {
      echo "Migrations run successfully" . PHP_EOL;
    }
  }

  //runs a specific version
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

  //does version 0 then runs migrations as a way to refresh
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