<?php
/**
 * WARNING : This application contains multiple vulnerabilities. DO NOT USE
 * for your production site.
 *
 * @author     Sumardi Shukor <smd@php.net.my>
 * @link       www.sumardi.net
 */
include_once('common.php');

$content = render('account', array('full_name' => $_SESSION['user']['full_name']));
include('layout.php');
