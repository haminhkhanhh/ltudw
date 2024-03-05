<?
    require "inc/init.php";

    $conn = require("inc/db.php");
    // $books = Book::getAll($const);
    $books = Book::getAllBooks($conn);

    require "inc/header.php";
?>

<!-- trình bày sp dạng thẻ -->
<div class="content">
    <? foreach($books as $b): ?>
        <div class="flip-card">
            <div class="flip-card-inner">
                <div class="flip-card-front">
                    <img src="uploads/<? echo $b->imagefile ?>" alt="<?echo $b->title?>">
                </div>
                <div class="flip-card-back">
                    <h2><? echo $b->title?></h2>
                    <p><? echo $b->description ?></p>
                    <p><? echo $b->author ?></p>
                </div>
            </div>
        </div>
    <? endforeach; ?>
</div>

<? require "inc/footer.php"; ?>