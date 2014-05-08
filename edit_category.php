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

if ($_POST) {
    $name = isset($_POST['name']) ? $_POST['name'] : '';
    $id = isset($_POST['id']) ? $_POST['id'] : 0;
    if ( ! empty($name)) {
        $sql = "UPDATE categories SET name = '{$name}' WHERE id = {$id}";
        $app['db']->query($sql);
        $app['db']->execute();
        flash_message("Category Id : {$id} has been updated!", 'success');
        redirect('category_admin.php');
    } else {
        flash_message('Please insert category name.', 'danger');
    }
}

if ($_GET) {
    $id = isset($_GET['id']) ? $_GET['id'] : 0;
    $sql = "SELECT * FROM categories WHERE id = {$id}";
    $app['db']->query($sql);
    $c = $app['db']->first();
}

$sidebar = file_get_contents('contents/admin_sidebar.html');
$content = render('edit_category', array('sidebar' => $sidebar, 'id' => $c['id'], 'name' => $c['name']));
include("layout.php");
