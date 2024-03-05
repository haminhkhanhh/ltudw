<?
    require "inc/init.php";
    require "inc/header.php";

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
        // lấy thông tin chỉnh sửa
        $book->id = $_GET['id'];
        $book->title = $_POST['title'];
        $book->description = $_POST['description'];
        $book->author = $_POST['author'];

        // goij caapj nhaapj
        if($book->update($conn)){
           header("Location: index.php");
        }
    }

?>
<div class="content">
    <form method="post" id="frmEDITBOOK">
        <fieldset>
            <legend>Edit book</legend>
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