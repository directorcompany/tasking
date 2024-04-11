<?php
session_start();
require_once('controllers/ContactController.php');


$id = isset($_POST['id']) ? $_POST['id'] : (isset($_GET['id']) ? $_GET['id'] : 0);
$name = isset($_POST['name']) ? $_POST['name'] : '';
$phone = isset($_POST['phone']) ? $_POST['phone'] : '';
$contact = new ContactController($id,$name,$phone);
$contact->handleRequest();