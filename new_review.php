<?php
/**
 * WARNING : This application contains multiple vulnerabilities. DO NOT USE
 * for your production site.
 *
 * @author     Sumardi Shukor <smd@php.net.my>
 * @link       www.sumardi.net
 */
include_once("common.php");

if ($_POST) {
    $comment = isset($_POST['comment']) ? $_POST['comment'] : '';
    $rating = isset($_POST['rating']) ? (int) $_POST['rating'] : 0;
    $book_id = isset($_POST['book_id']) ? (int) $_POST['book_id'] : 0;

    $sql = "INSERT INTO reviews SET comment = '{$comment}', rating = {$rating}, book_id = {$book_id},
            created_at = NOW(), updated_at = NOW()";
    $app['db']->query($sql);
    $app['db']->execute();
    flash_message('Your review has been added!', 'success');
    redirect('view.php?by=book&id=' . $book_id);
}

redirect('index.php');
