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
    $category_id = isset($_POST['category_id']) ? $_POST['category_id'] : array();

    $sql = "INSERT INTO books SET title = '{$title}', description = '{$description}', price = '{$price}',
            created_at = NOW(), updated_at = NOW()";
    $app['db']->query($sql);
    $app['db']->execute();

    $book_id = $app['db']->lastInsertId();
    foreach($category_id as $category) {
        $sql = "INSERT INTO books_categories SET book_id = {$book_id}, category_id = {$category}";
        $app['db']->query($sql);
        $app['db']->execute();
    }

    flash_message('New book has been added!', 'success');
    redirect('book_admin.php');
}

$sql = "SELECT * FROM categories";
$app['db']->query($sql);
$categories = $app['db']->all();
$list_category = '';
foreach($categories as $category) {
    $list_category .= "<option value=\"{$category['id']}\">{$category['name']}</option>";
}

$sidebar = file_get_contents('contents/admin_sidebar.html');
$content = render('new_book', array('sidebar' => $sidebar, 'category' => $list_category));
include("layout.php");
