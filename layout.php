<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php echo _TITLE_ ?></title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <div class="navbar navbar-fixed-top navbar-inverse" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php"><?php echo _TITLE_ ?></a>
            </div>
            <div class="collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="about.php">About</a></li>
                    <li><a href="contact.php">Contact</a></li>
                </ul>
                <ul class="nav navbar-nav pull-right">

                    <li><a href="cart.php">Cart <span class="badge">
                    <?php
                    if (isset($_COOKIE['items'])) {
                        echo count((array)json_decode($_COOKIE['items']));
                    } else {
                        echo '0';
                    }
                    ?>
                    </span></a></li>
                    <?php if(guest()) : ?>
                        <li><a href="register.php">Register</a></li>
                        <li><a href="login.php">Sign in</a></li>
                    <?php else : ?>
                        <li><a href="account.php">Account</a></li>
                    <?php endif ?>
                    <?php if(is_admin()) : ?>
                        <li><a href="book_admin.php">Admin Panel</a></li>
                    <?php endif ?>
                </ul>
            </div><!-- /.nav-collapse -->
        </div><!-- /.container -->
    </div><!-- /.navbar -->

    <div class="container">
        <?php echo print_message() ?>
        <?php echo isset($content) ? $content : '' ?>
        <hr>

        <footer>
            <p>&copy; <?php echo date('Y', time()) . ' ' . _COMPANY_  ?></p>
        </footer>
    </div><!--/.container-->

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/offcanvas.js"></script>
</div>
</body>
</html>
