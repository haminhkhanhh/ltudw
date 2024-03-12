<?
    require "inc/init.php";
    $conn=require"inc/db.php";
    $page=$_GET['page']?? 1;
    $limit=2;
    $offset =($page-1)*$limit;
    $books=Book::getPaging($conn,$limit,$offset);
    echo json_encode($books); // trả về dạng json
?>