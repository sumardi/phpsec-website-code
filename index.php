<?php
/**
 * WARNING : This application contains multiple vulnerabilities. DO NOT USE
 * for your production site.
 *
 * @author     Sumardi Shukor <smd@php.net.my>
 * @link       www.sumardi.net
 */
include_once("common.php");

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

/**
 * Books
 */
$sql = "SELECT * FROM books ORDER BY created_at DESC LIMIT 6";
$app['db']->query($sql);
$books = $app['db']->all();
$featured_book = '';
foreach($books as $book) {
    $featured_book .= "<div class=\"col-6 col-sm-6 col-lg-4\">
        <dl>
          <dt><h2>{$book['title']}</h2></dt>
          <dd>" . truncate($book['description']) . "</dd>
        </dl>
        <p><a class=\"btn btn-info\" href=\"view.php?by=book&id={$book['id']}\" role=\"button\">View details &raquo;</a></p>
    </div>";
}

$content = render('home', array('menus' => $menus, 'featured' => $featured_book));
include("layout.php");
