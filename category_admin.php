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

$sql = "SELECT * FROM categories";
$app['db']->query($sql);
$categories = $app['db']->all();
$table = '<table class="table table-bordered table-striped">';
$table .= '<tr><thead><th width="5%"><input type="checkbox" /></th><th width="10%">Id</th><th width="60%">Name</th><th>Action</th></tr></thead><tbody>';
foreach($categories as $category) {
    $table .= "<tr>
                <td><input type='checkbox' /></td>
                <td>{$category['id']}</td>
                <td>{$category['name']}</td>
                <td class='text-center'>
                    <a href='edit_category.php?id={$category["id"]}' class='btn btn-info btn-sm'>Edit</a>
                    <a href='delete_category.php?id={$category["id"]}' class='btn btn-danger btn-sm' onclick='return confirm(\"Are you sure?\")'>Delete</a>
                </td>
              </tr>";
}
$table .= '</tbody></table>';

$sidebar = file_get_contents('contents/admin_sidebar.html');
$content = render('category_admin', array('sidebar' => $sidebar, 'category_list' => $table));
include("layout.php");
