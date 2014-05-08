<?php
/**
 * WARNING : This application contains multiple vulnerabilities. DO NOT USE
 * for your production site.
 *
 * @author     Sumardi Shukor <smd@php.net.my>
 * @link       www.sumardi.net
 */
include_once("common.php");

function book($id) {
    global $app;
    $sql = "SELECT * FROM books WHERE id = {$id}";
    $app['db']->query($sql);
    $book = $app['db']->first();

    $sql = "SELECT * FROM reviews WHERE book_id = {$id}";
    $app['db']->query($sql);
    $reviews = $app['db']->all();
    $h = '<hr><div class="row"><div class="col-md-12">';
    foreach($reviews as $review) {
        for($i = 1; $i <= 5; $i++) {
            if ($i < $review['rating']) {
                $h .= "<span class=\"glyphicon glyphicon-star\"></span>";
            } else {
                $h .= "<span class=\"glyphicon glyphicon-star-empty\"></span>";
            }
        }
        $h .= "<span class=\"pull-right\"></span><blockquote>{$review['comment']}</blockquote>";
    }
    $h .= '</div></div>';

    $view = render('view_book', array_merge($book, array('review' => $h)));

    return $view;
}

function category($id) {
    global $app;
    $sql = "SELECT * FROM books_categories LEFT JOIN books ON books_categories.book_id =
            books.id WHERE books_categories.category_id = {$id}";
    $app['db']->query($sql);
    $books = $app['db']->all();
    $book_list = '';
    foreach($books as $book) {
        $book_list .= "<div class=\"col-6 col-sm-6 col-lg-4\">
            <dl>
              <dt><h2>{$book['title']}</h2></dt>
              <dd>" . truncate($book['description']) . "</dd>
            </dl>
            <p><a class=\"btn btn-info\" href=\"view.php?by=book&id={$book['id']}\" role=\"button\">View details &raquo;</a></p>
        </div>";
    }

    return $book_list;
}

/**
 * Categories
 */
$sql = "SELECT * FROM categories";
$app['db']->query($sql);
$categories = $app['db']->all();
$menus = '';
foreach($categories as $category) {
    $menus .= "<a href='view.php?by=category&id={$category['id']}' class='list-group-item'>{$category['name']}</a>";
}

$by = !empty($_GET['by']) ? $_GET['by'] : 'book';
$id = !empty($_GET['id']) ? $_GET['id'] : 0;
$view = $by($id);
$content = render('book', array('menus' => $menus, 'view' => $view));
include('layout.php');
