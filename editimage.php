<?
    require "inc/init.php";
    //Auth::requireLogin();
    if(isset($_GET['id'])){
        $conn = require ('inc/db.php');
        $id = $_GET['id'];// read id from index.php
        $book = Book::getBookById($conn, $id);
        if(!$book){
            Dialog::show('Book not found');
            return;
        }
    }else {
        Dialog::show('Input ID, please!');
        return;
    }
    // upload hinh moi len thu muc upload
    // cap nhap lai hinh moi 
    // xoa hinh cu trung thu muc upload di
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        try {
            $fullname = Uploadfile::process();
            if(!empty($fullname)){
                // lay ten file cu ra
                $oldimage = $book->imagefile;
                // gan ten file moi
                $book->imagefile = $fullname;
                $book->id = $_GET['id'];

                if($book->updateImage($conn)){
                    if($oldimage){
                        unlink("uploads/$oldimage");
                    }
                    header("Location: index.php");
                }
            }
        } catch ( PDOException $e) {
            Dialog::show($e->getMessage());
        }
    }
?>
<? require "inc/header.php"; ?>

<div class="content">
    <form method="post" enctype="multipart/form-data" id='frmEDITIMAGE'>
        <fieldset>
            <legend>Edit Image</legend>

            <? if($book->imagefile): ?>
                <img src="uploads/<?=$book->imagefile?>" width="180" height="180">
            <? endif; ?>
            <div class="row">
                <label for="file">chọn hình ảnh</label>
                <input type="file" name="file" id='file'>
            </div>
            <div class="row">
                <input class="btn" type="submit" value="Update">
                <input class="btn" type="button" value="Cancel" onClick="parent.location='index.php'">
            </div>
        </fieldset>
    </form>
</div>
<?
    require "inc/footer.php";
?>