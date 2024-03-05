<?php
require "inc/init.php";
$conn = require('inc/db.php');

$books = Book::getAllBooks($conn);
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

<?php require "inc/footer.php"; ?>