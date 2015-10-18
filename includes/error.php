<?php
session_start();

function set_login_error($error) {	$_SESSION['LOGIN_ERROR'] = $error; }
function get_login_error() { if(isSet($_SESSION['LOGIN_ERROR'])) {return $_SESSION['LOGIN_ERROR']; }else { return ""; } }
function clear_login_error() { 	$_SESSION['LOGIN_ERROR'] = ""; } 	

function set_registration_error($msg) { $_SESSION['REG_MSG'] = $msg; }
function get_registration_error() { if(isSet($_SESSION['REG_MSG'])) { return $_SESSION['REG_MSG']; }else { return ""; }}
function clear_registration_error() {  $_SESSION['REG_MSG'] = "";}
?>
