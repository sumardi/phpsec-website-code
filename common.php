<?php
/**
 * WARNING : This application contains multiple vulnerabilities. DO NOT USE
 * for your production site.
 *
 * @author     Sumardi Shukor <smd@php.net.my>
 * @link       www.sumardi.net
 */
session_start();
require_once("config.php");
require_once("libs/Database.php");
require_once('libs/helpers.php');

$app = array(
    'db'     => new Database(DB_HOST, DB_USER, DB_PASS, DB_NAME)
);
