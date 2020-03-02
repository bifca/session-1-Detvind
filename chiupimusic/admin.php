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
    <title>Chiupi Music | Content Management</title>
    <style type="text/css">
        *{
            --size:64px;
        }
        .media{width:var(--size);height:var(--size);overflow:hidden;}
        .media img{width:100%;height:auto;}
    </style>
</head>
<body>


<div class="container-fluid">
    <table class="table table-striped">
        <thead>
        <tr>
            <th>Album ID</th>
            <th>Album Name</th>
            <th>Album Cover</th>
            <th>Language</th>
            <th>Release Date</th>
            <th>Online Address</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php  foreach ($rows as $row) { ?>
        <tr>
            <td><?php echo $row["albumID"]; ?></td>
            <td><?php echo $row["albumName"]; ?></td>
            <td>
                <div class="media">
                    <img src="<?php echo "static/".$row["coverUrl"]; ?>">
                </div>
            </td>
            <td><?php echo $row["language"]; ?></td>
            <td><?php echo $row["releaseDate"]; ?></td>
            <td><?php echo $row["onlineUrl"]; ?></td>
            <td>
                <a class="btn btn-outline-danger" href="<?php echo 'del.php?id=' . $row["albumID"]; ?>" role="button">Delete</a>
                <a class="btn btn-outline-info mt-1" href="<?php echo 'update.php?id=' . $row["albumID"]; ?>">Update</a>
            </td>
        </tr>
        <?php } ?>
        </tbody>
    </table>

    <a class="btn btn-outline-primary" href="upload.php" role="button">Upload New Music</a>

</div>

<footer class="text-center mt-5 mb-5">
  &copy; Chiupi | <a href="index.php">Back to Homepage</a>
</footer>

</body>
</html>
