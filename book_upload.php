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
    $file = $_FILES['file'];
    $id = isset($_POST['id']) ? $_POST['id'] : 0;
    $allowed_ext = array('png', 'jpeg', 'bmp', 'gif', 'jpg');
    $allowed_type = array('image/png', 'image/jpeg', 'image/bmp', 'image/gif', 'image/jpg');

    /**
     * Check file extension
     */
    $file_parts = pathinfo($file['name']);
    if ( ! in_array($file_parts['extension'], $allowed_ext)) {
        flash_message('The file extension not allowed for upload.', 'danger');
        redirect('book_upload.php');
    }

    /**
     * Check file mime type
     */
    if ( ! in_array($file['type'], $allowed_type)) {
        flash_message('The file type not allowed for upload.', 'danger');
        redirect('book_upload.php');
    }

    switch($file['error']) {
        case UPLOAD_ERR_OK:
            $uploaddir = 'uploads/';
            $uploadfile = $uploaddir . basename($file['name']);
            if ( ! move_uploaded_file($file['tmp_name'], $uploadfile)) {
                echo "Couldn't upload file."; exit;
            } else {
                $sql = "UPDATE books SET image = '{$uploadfile}' WHERE id = {$id}";
                $app['db']->query($sql);
                $app['db']->execute();
            }
            flash_message("The file uploaded with success.", "success"); break;
        case UPLOAD_ERR_FORM_SIZE:
            flash_message("The uploaded file exceeds the $max_size bytes limit.", "danger"); break;
        case UPLOAD_ERR_NO_FILE:
            flash_message("No file was uploaded.", "danger"); break;
        default:
            flash_message("Couldn't upload file.", "danger");
    }
    redirect("book_admin.php");
}

$id = !empty($_GET['id']) ? $_GET['id'] : 0;
$size = 1000 * 1024;
$sidebar = file_get_contents('contents/admin_sidebar.html');
$content = render('book_upload', array(
    'sidebar' => $sidebar,
    'id' => $id,
    'size' => $size
));
include("layout.php");
