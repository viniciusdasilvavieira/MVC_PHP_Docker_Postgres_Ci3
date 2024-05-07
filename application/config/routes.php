<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Routes Configuration
 * Contains routing requests to controllers and methods.
 */

$route['default_controller'] = 'School';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

// Main / School Routes

// Default route to the School controller's index method
$route[''] = 'School/index';

// School views and actions routes
$route['alunos'] = 'School/studentsView';                   // View and insert students
$route['turmas'] = 'School/unitsView';                      // View and insert units

// Assignment views and actions routes
$route['enturmar']                = 'School/assignView';    // View for assigning students to units
$route['enturmar/criar/enviar']   = 'School/assign';        // POST route for assigning students to units
$route['enturmar/limpar/(:num)']  = 'School/clear/$1';      // Clear a unit

$route['relatorio'] = 'School/reportView';                  // Report view

// Create report PDF route
$route['relatorio/pdf'] = 'Pdf/index';


// Student Routes
$route['aluno/editar/(:num)']     = 'Student/editView/$1';  // Edit student view
$route['aluno/salvar']            = 'Student/save';         // POST route for saving a student
$route['aluno/atualizar/(:num)']  = 'Student/update/$1';    // POST route for updating a student
$route['aluno/excluir/(:num)']    = 'Student/delete/$1';    // Delete a student


// Unit Routes
$route['turma/editar/(:num)']     = 'Unit/editView/$1';     // Edit unit view
$route['turma/salvar']            = 'Unit/save';            // POST route for saving a unit
$route['turma/atualizar/(:num)']  = 'Unit/update/$1';       // POST route for updating a unit
$route['turma/excluir/(:num)']    = 'Unit/delete/$1';       // Delete a unit


//Obs: the name 'unit' was used to avoid conflicts with 'Class'