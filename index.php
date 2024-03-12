<?php
require "inc/init.php";
$conn = require('inc/db.php');

$total = Book::count($conn);
$limit  = 2; //hard code //sửa chỗ limit=2 thành đọc từ config ra, nếu làm được thì có điểm cộng thêm
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

require "inc/header.php";
?>

<div class="content">
  <table>
    <thead>
      <tr>
        <th>No.</th>
        <th>Title</th>
        <th>Description</th>
        <th>Author</th>
        <th>Image</th>
      </tr>
    </thead>

    <tbody>
            <? static $i=1;?>
            <? foreach($books as $b):?>
                <tr>
                    <td align="center"><? echo $i++?></td>
                    <td><? echo $b->title?></td>
                    <td><? echo $b->description?></td>
                    <td><? echo $b->author?></td>
                    <td>
                      <img src="uploads/<? echo $b->imagefile ?>" alt="" width="100" height="100">
                        <? if (Auth::isLoggedIn()): ?>
                            <div class="row">
                                <a href="editbook.php?id=<?=htmlspecialchars($b->id)?>" class="btn">Sửa</a>
                                <a href="delbook.php?id=<?=htmlspecialchars($b->id)?>" class="btn">Xóa</a>
                                <a href="editimage.php?id=<?=htmlspecialchars($b->id)?>" class="btn">Sửa hình</a>
                            </div>
                        <?endif;?>
                    </td>
                </tr>
            <? endforeach; ?>
        </tbody>

    <tfoot>
      <tr>
        <th colspan="3">Totals</th>
        <th colspan="2"><?php echo count($books) ?></th>
      </tr>
    </tfoot>
  </table>
</div>
<div class="content">
  <?
    $page = new Pagination($config);
    echo $page->getPagination();
  ?>
</div>

<?php require "inc/footer.php"; ?>