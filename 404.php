<?
    $error = $_GET['error'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Books Store</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="d-flex align-items-center justify-content-center vh-100">
        <div class="text-center row">
            <div class="col-md-6">
                <img src="https://cdn.pixabay.com/photo/2017/03/09/12/31/error-2129569__340.jpg" alt="img-fluid">
            </div>
            <div class="col-md-6 mt-5">
                <p class="fs-3">
                    <span class="text-danger">Opps!</span>
                    Có lỗi xảy ra.
                </p>
                <p class="lead"><? echo $error ?></p>
                <a href="index.php" class="btn btn-primary">Về trang chủ</a>
            </div>
        </div>
    </div>
</body>
</html>