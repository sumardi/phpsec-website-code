<?php
/**
 * WARNING : This application contains multiple vulnerabilities. DO NOT USE
 * for your production site.
 *
 * @author     Sumardi Shukor <smd@php.net.my>
 * @link       www.sumardi.net
 */
include_once("common.php");
if ( ! is_admin()) {
    flash_message('Please log in to continue.', 'warning');
    redirect('login.php');
}

$id = isset($_GET['id']) ? $_GET['id'] : 0;
$sql = "DELETE FROM categories WHERE id = {$id}";
$app['db']->query($sql);
$app['db']->execute();
flash_message("Category Id : {$id} has been deleted.", 'success');
redirect('category_admin.php');
