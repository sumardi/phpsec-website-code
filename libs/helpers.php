<?php
/**
 * WARNING : This application contains multiple vulnerabilities. DO NOT USE
 * for your production site.
 *
 * @author     Sumardi Shukor <smd@php.net.my>
 * @link       www.sumardi.net
 */
function dump($x)
{
    echo "<pre>";
    var_dump($x); exit;
    echo "</pre>";
}

function redirect($to)
{
    header('location:' . $to); exit;
}

function flash_message($message, $type = 'info')
{
    $_SESSION['_flash'] = array(
        'message'     => $message,
        'type'        => $type
    );
}

function print_message()
{
    if (isset($_SESSION['_flash'])) {
        $msg = $_SESSION['_flash'];
        unset($_SESSION['_flash']);
        return '<div class="alert alert-' . $msg['type'] . '">' . $msg['message'] . '</div>';
    }
}

function guest()
{
    if ( ! isset($_SESSION['logged'])) {
        return true;
    }

    return false;
}

function is_admin()
{
    if (isset($_SESSION['is_admin'])) {
        return true;
    }

    return false;
}

function render($content, $vars = array())
{
    $file = "contents/" . $content . ".html";
    if (file_exists($file)) {
        $tpl = file_get_contents($file);
        foreach($vars as $k => $v){
            $tpl = preg_replace('/{\$' . preg_quote($k) . '}/', $v, $tpl);
        }

        return $tpl;
    }
}

function truncate($text, $chars = 200) {
    $text = $text." ";
    $text = substr($text,0,$chars);
    $text = substr($text,0,strrpos($text,' '));
    $text = $text."...";
    return $text;
}
