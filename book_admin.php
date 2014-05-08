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

$sql = "SELECT * FROM books";
$app['db']->query($sql);
$books = $app['db']->all();
$table = '<table class="table table-bordered table-striped">';
$table .= '<tr><thead><th width="5%"><input type="checkbox" /></th><th width="10%">Id</th><th width="50%">Title</th><th>Action</th></tr></thead><tbody>';
foreach($books as $book) {
    $table .= "<tr>
                <td><input type='checkbox' /></td>
                <td>{$book['id']}</td>
                <td>{$book['title']}</td>
                <td class='text-center'>
                    <a href='edit_book.php?id={$book["id"]}' class='btn btn-info btn-sm'>Edit</a>
                    <a href='book_upload.php?id={$book["id"]}' class='btn btn-warning btn-sm'>Upload</a>
                    <a href='delete_book.php?id={$book["id"]}' class='btn btn-danger btn-sm' onclick='return confirm(\"Are you sure?\")'>Delete</a>
                </td>
              </tr>";
}
$table .= '</tbody></table>';


$sidebar = file_get_contents('contents/admin_sidebar.html');
$content = render('book_admin', array('sidebar' => $sidebar, 'book_list' => $table));
include("layout.php");
