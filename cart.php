<?php
/**
 * WARNING : This application contains multiple vulnerabilities. DO NOT USE
 * for your production site.
 *
 * @author     Sumardi Shukor <smd@php.net.my>
 * @link       www.sumardi.net
 */
include_once('common.php');

if (isset($_COOKIE['items'])) {
    $items = (array) json_decode($_COOKIE['items']);
    $view = '';
    $total = 0;
    foreach($items as $item) {
        $total += $item->price;
        $view .= "<tr><td><input type=\"checkbox\"></td><td>{$item->title}</td><td>1</td><td>MYR {$item->price}</td><td>MYR {$item->price}</td></tr>";
    }
}

$content = render('cart', array('view' => $view, 'total' => number_format($total, 2)));
include('layout.php');
