<?php
/**
 * WARNING : This application contains multiple vulnerabilities. DO NOT USE
 * for your production site.
 *
 * @author     Sumardi Shukor <smd@php.net.my>
 * @link       www.sumardi.net
 */
include_once('common.php');

setcookie('items', json_encode(array()), -3600);
flash_message('Your cart is empty', 'warning');
redirect('cart.php');
