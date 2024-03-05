<!DOCTYPE html>
<html>
<head>
<title>My Books Store</title>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="css/style_form.css" />
    <link rel="stylesheet" href="css/style_card.css" />
    <script src="https://cdn.jsdelivr.net/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
    <script src="js/script.js"></script>
    <!-- <link rel="stylesheet" href="vendors/font-awesome-4.7.0/css/font-awesome.min.css" /> -->
</head>
<body>
    <div class="page">
        <div class="header">
            <div class="multi-columns">
                <div class="left col-2">
                    <div class="brand">
                        <i class="icon"></i>
                        <h1 class="name">Books</h1>
                    </div>
                </div>
                <div class="right col-6">
                    <ul class="main-nav">
                        <li class="item active"><a href="index.php" class="text">Home</a></li>
                        <li class="item"><a href="products.php" class="text">Products</a></li>
                        <li class="item"><a href="services.php" class="text">Services</a></li>
                        <li class="item"><a href="contact.php" class="text">Contact</a></li>
                        <? if(Auth::isLoggedIn()): ?>
                            <li class="item"><a href="adduser.php" class="text">Add User</a></li>
                            <li class="item"><a href="addbook.php" class="text">Add Book</a></li>
                            <li class="item"><a href="logout.php" class="text">Logout</a></li>
                        <? else: ?>
                            <li class="item"><a href="login.php" class="text">Login</a></li>
                        <? endif; ?>
                    </ul>
                </div>
            </div>
        </div>
        <div class="content">
            <div class="promotions">
                <div class="item">
                    <img class="photo" src="images\books.png" />
                    <div class="summary">
                        <h3 class="title">Books are an endless source of knowledge</h3>
                        <p class="desc">Always enrich your knowledge <br/> Reader today - Leader tomorrow</p>
                    </div>
                </div>
            </div>
        </div>