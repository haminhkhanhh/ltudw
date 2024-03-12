<?
    require "inc/init.php";

    $conn = require("inc/db.php");
    $total = Book::count($conn);
    $limit  = 3; //hard code //sửa chỗ limit=2 thành đọc từ config ra, nếu làm được thì có điểm cộng thêm
    $currentpage = $_GET['page'] ?? 1; //biết sao ?? không, t cũng kh biết
    //thông tin cho việc phân trang
    $config = [
        'total' => $total,
        'limit' => $limit,
        'full' => false,
    ];
    // $books = Book::getAllBooks($conn);
    $book = Book::getPaging($conn, $limit, ($currentpage - 1) * $limit); //không còn là getAll nữa
// print_r($books);
    // $books = Book::getAll($const);
    // $books = Book::getAllBooks($conn);

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
<div class="content">
  <?
    $page = new Pagination($config);
    echo $page->getPagination();
  ?>
</div>

<? require "inc/footer.php"; ?>