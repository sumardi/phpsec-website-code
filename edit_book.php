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
    $title = isset($_POST['title']) ? $_POST['title'] : '';
    $description = isset($_POST['description']) ? $_POST['description'] : '';
    $price = isset($_POST['price']) ? $_POST['price'] : '';
    $id = isset($_POST['id']) ? $_POST['id'] : '';
    $category_id = isset($_POST['category_id']) ? $_POST['category_id'] : array();

    $sql = "UPDATE books SET title = '{$title}', description = '{$description}', price = '{$price}',
            updated_at = NOW() WHERE id = {$id}";
    $app['db']->query($sql);
    $app['db']->execute();

    $sql = "DELETE FROM books_categories WHERE book_id = {$id}";
    $app['db']->query($sql);
    $app['db']->execute();
    foreach($category_id as $category) {
        $sql = "INSERT INTO books_categories SET book_id = {$id}, category_id = {$category}";
        $app['db']->query($sql);
        $app['db']->execute();
    }

    flash_message('Book Id: ' . $id . ' has been added!', 'success');
    redirect('book_admin.php');
}

if ($_GET){
    $id = isset($_GET['id']) ? $_GET['id'] : 0;
    $sql = "SELECT * FROM books WHERE id = {$id}";
    $app['db']->query($sql);
    $book = $app['db']->first();

    $sql = "SELECT category_id FROM books_categories WHERE book_id = {$id}";
    $app['db']->query($sql);
    $c = $app['db']->all();
    $selected_category = array();
    foreach($c as $m) {
        $selected_category[] = $m['category_id'];
    }

    $sql = "SELECT * FROM categories";
    $app['db']->query($sql);
    $categories = $app['db']->all();
    $list_category = '';
    foreach($categories as $category) {
        if (in_array($category['id'], $selected_category)) {
            $list_category .= "<option value=\"{$category['id']}\" selected>{$category['name']}</option>";
        } else {
            $list_category .= "<option value=\"{$category['id']}\">{$category['name']}</option>";
        }
    }
}

$sidebar = file_get_contents('contents/admin_sidebar.html');
$data = array_merge($book, array('sidebar' => $sidebar, 'category' => $list_category));
$content = render('edit_book', $data);
include("layout.php");
