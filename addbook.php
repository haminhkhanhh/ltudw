<?php
require "inc/init.php";
Auth::requireLogin();

// function upload_file()
// {
//     try {
//         if (empty($_FILES)) {
//             Dialog::show('Can not upload files');
//             return null;
//         }

//         $rs = Errorfileupload::err($_FILES['file']['error']);
//         if ($rs != 'OK') {
//             Dialog::show($rs);
//             return null;
//         }

//         $fileMaxSize = FILE_MAX_SIZE;
//         if ($_FILES['file']['size'] > $fileMaxSize) {
//             Dialog::show('File too large, must smaller than: ' .  $fileMaxSize);
//             return null;
//         }

//         // limit file image type
//         $mime_types = FILE_TYPE;
//         // check if image
//         $fileinfo = finfo_open(FILEINFO_MIME_TYPE);
//         // file upload will store in tmp_name
//         $file_mime_type = finfo_file($fileinfo, $_FILES['file']['tmp_name']);
//         if (!in_array($file_mime_type, $mime_types)) {
//             Dialog::show('Invalid file type, file must be an image');
//             return null;
//         }

//         // standardize image before upload to server
//         $pathinfo = pathinfo($_FILES['file']['name']);
//         $filename = $pathinfo['filename'];
//         $filename = preg_replace('/[^a-zA-Z0-9_-]/', '_', $filename);

//         // Handle override file exist in uploads folder
//         $fullname = $filename . '.' . $pathinfo['extension'];
//         // create path to uploads folder in server
//         $fileToHost = 'uploads/' . $fullname;
//         $i = 1;
//         while (file_exists($fileToHost)) {
//             $fullname = $filename . "-$i." . $pathinfo['extension'];
//             $fileToHost = 'uploads/' . $fullname;
//             $i++;
//         }

//         $fileTmp = $_FILES['file']['tmp_name'];
//         if (move_uploaded_file($fileTmp, $fileToHost)) {
//             return $fullname;
//         } else {
//             Dialog::show("Error uploading!");
//             return null;
//         }
//     } catch (Exception $e) {
//         Dialog::show($e->getMessage());
//         return null;
//     }
// }

// 1. gọi process từ class uploadfile ==> nhận kết quả
// 2. nếu thành công ==> insert record vào books
//     2.1. nếu thành công ==> chuyển vào trang index.php
//     2.2. thất bại ==> xóa file image đã upload


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $conn = require "inc/db.php";
    try {
        $fullname = Uploadfile::process();

        if (!empty($fullname)) {
            $title = $_POST['title'];
            $description = $_POST['description'];
            $author = $_POST['author'];
            $book = Book::getInstance($title, $description, $author, $fullname);
            if ($book->addBook($conn)) {
                header("Location: index.php");
            } else {
                unlink("uploads/$fullname");
            }
        }
    } catch (PDOException $e) {
        Dialog::show($e->getMessage());
    }
}
?>

<?php require "inc/header.php" ?>
<div class="content">
    <form name="frmADDBOOK" action="" method="post" id='fromADDUSER' enctype="multipart/form-data">
        <fieldset>
            <legend>Add Book</legend>
            <div class="row">
                <label for="title">Title:</label>
                <span class="error">*</span>
                <input name="title" id="title" type="text" placeholder="Input your title">
            </div>
            <div class="row">
                <label for="description">Description:</label>
                <span class="error">*</span>
                <input name="description" id="description" type="text" placeholder="Input your description">
            </div>
            <div class="row">
                <label for="author">Author:</label>
                <span class="error">*</span>
                <input name="author" id="author" type="text" placeholder="Input your author">
            </div>
            <div class="row">
                <label for="file">File hình ảnh:</label>
                <input type="file" name="file" id="file" />
            </div>
            <div class="row">
                <input type="submit" value="Save">
                <input type="reset" value="Cancel">
            </div>
        </fieldset>
    </form>
</div>
<?php require "inc/footer.php" ?>