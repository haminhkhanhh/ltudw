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

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $book->id = $_GET['id'];
        $oldimage = $book->imagefile;

        if($book->deleteByID($conn)){
            if($oldimage){
                if($oldimage){
                    unlink("uploads/$oldimage");
                }
                header("Location: index.php");
                return;
            }
        }
    }
?>

<?
    require "inc/header.php";
?>

<div class="content">
    <form method="post" id="frmDELBOOK">
        <fieldset>
            <legend>Delete book</legend>
            <div class="row">
                <label for="title">Title:</label>
                <span class="error">*</span>
                <input name="title" type="text" value="<?=htmlspecialchars($book->title)?>">
            </div>
            <div class="row">
                <label for="description">Description:</label>
                <span class="error">*</span>
                <input name="description" type="text" value="<?=htmlspecialchars($book->description)?>">
            </div>
            <div class="row">
                <label for="author">Author:</label>
                <span class="error">*</span>
                <input name="author" type="text" value="<?=htmlspecialchars($book->author)?>">
            </div>
            <?
                if($book->imagefile):
            ?>
            <div class="row">
                <img src="uploads/<?=$book->imagefile?>" width="120" height="120">
            </div>
            <? endif; ?>
            <div class="row">
            <input class="btn" type="submit" value="Delete">
                <input class="btn" type="button" value="Cancel" onClick="parent.location='index.php'">
            </div>
        </fieldset>
    </form>
</div>

<? require 'inc/footer.php' ?>

<script>
    $(document)
        .ready(function(){
            $('#frmDELBOOK')
                .submit(function(e){
                    e.preventDefault();
                    if(confirm("Are you sure you want to delete ?")){
                        var frm = $('<form>');
                        frm.attr('method', 'post');
                        frm.attr('action', $(this).attr('href'));
                        frm.appendTo('body');
                        frm.submit();
                    }
                })
        })
</script>