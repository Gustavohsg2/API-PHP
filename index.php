<?php
//https://github.com/bramus/router
require_once "modelo/Router.php";

$router = new Router();


$router->post('/turmas', function () {
  require_once "controle/turma/controle_turma_create.php";
});
$router->get('/turmas', function () {
  require_once "controle/turma/controle_turma_read_all.php";
});
$router->get('/turma/(\d+)', function ($parametro_idTurma) {
  require_once "controle/turma/controle_turma_read_by_id.php";
});
$router->delete('/turma/(\d+)', function ($parametro_idTurma) {
  require_once "controle/turma/controle_turma_delete.php";
});
$router->put('/turma/(\d+)', function ($parametro_idTurma) {
  require_once "controle/turma/controle_turma_update.php";
});


$router->post('/professor', function () {
  require_once "controle/professor/controle_professor_create.php";
});
$router->get('/professores', function () {
  require_once "controle/professor/controle_professor_read_all.php";
});
$router->get('/professor/(\d+)', function ($parametro_idProfessor) {
  require_once "controle/professor/controle_professor_read_by_id.php";
});
$router->delete('/professor/(\d+)', function ($parametro_idProfessor) {
  require_once "controle/professor/controle_professor_delete.php";
});
$router->put('/professor/(\d+)', function ($parametro_idProfessor) {
  require_once "controle/professor/controle_professor_update.php";
});


$router->post('/materia', function () {
  require_once "controle/materia/controle_materia_create.php";
});
$router->get('/materias', function () {
  require_once "controle/materia/controle_materia_read_all.php";
});
$router->get('/materia/(\d+)', function ($parametro_idMateria) {
  require_once "controle/materia/controle_materia_read_by_id.php";
});
$router->delete('/materia/(\d+)', function ($parametro_idMateria) {
  require_once "controle/materia/controle_materia_delete.php";
});
$router->put('/materia/(\d+)', function ($parametro_idMateria) {
  require_once "controle/materia/controle_materia_update.php";
});

$router->run();