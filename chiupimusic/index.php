<?php
require_once __DIR__ . "/models/model.php";

$db = new DB();
$rows = $db->query("select * from album");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./static/css/bootstrap.css">
    <link rel="stylesheet" href="./static/css/style.css">
    <link rel="shortcut icon" href="./static/img/favicon.ico">
    <title>Chiupi Music</title>
</head>
<body>

<div class="container-fluid">
  <h1 class="mt-5">Chiupi's Music</h1>
    <div class="row">

        <?php foreach ($rows as $row) { ?>
        <div class="col-12 col-xl-3 col-lg-4 col-md-6 mt-5" style="width: 18rem;">

            <div class="card">
                <img src="<?php echo "static/".$row["coverUrl"]; ?>" class="card-img-top">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $row["albumName"]; ?></h5>
                    <p class="card-text"><?php echo $row["releaseDate"]; ?></p>
                    <a href="<?php echo $row["onlineUrl"]; ?>" target="_blank" class="btn btn-primary">Listen Now</a>
                </div>
            </div>

        </div>
        <?php } ?>

    </div>

    <footer class="text-center mt-5 mb-5">
      &copy; Chiupi | <a href="admin.php">Mangement</a>
    </footer>


</div>
</body>
</html>
