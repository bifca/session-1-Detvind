<?php
require_once __DIR__ . "/models/model.php";


if($_SERVER["REQUEST_METHOD"] === "POST"){
    if(isset($_FILES["img"])){
        $dir = __DIR__ . "/static/img/album/";
        $filename = $_FILES["img"]["name"];
        if(move_uploaded_file($_FILES['img']['tmp_name'], $dir . $filename)){
            $json = [
                'code' => 1,
                'addr' => 'img/album/' . $filename,
            ];
        }else{
            $json = [
                'code' => 0,
            ];
        }
        echo json_encode($json);
        return;
    }

    if (
        !isset($_POST["albumName"]) ||
        !isset($_POST["coverUrl"]) ||
        !isset($_POST["language"]) ||
        !isset($_POST["releaseDate"]) ||
        !isset($_POST["onlineUrl"])
    ) {
        echo "Missing parameter!";
        return;
    }
    $albumName   = $_POST["albumName"];
    $coverUrl    = $_POST["coverUrl"];
    $language    = $_POST["language"];
    $releaseDate = $_POST["releaseDate"];
    $onlineUrl   = $_POST["onlineUrl"];

    try {
        $db = new DB();
        $id = $db->count("album") + 1;
        $sql = "INSERT INTO album (albumID, albumName, coverUrl, language, releaseDate, onlineUrl) VALUES ($id, '$albumName', '$coverUrl', '$language', '$releaseDate', '$onlineUrl')";

        $db->insert($sql);
    } catch (\Throwable $th) {
        echo "Insert error: ". $th;
        return;
    }

    echo "
    <p>Update sucessful！return in three seconds<p>

    <script>
    setTimeout(() => {
        window.history.back();
    }, 3000);
    </script>";
    return;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./static/css/bootstrap.css">
    <link rel="stylesheet" href="./static/css/style.css">
    <link rel="shortcut icon" href="./static/img/favicon.ico">
    <title>Chiupi Music | Upload</title>
</head>
<body>


<div class="container-fluid">
    <form method="post">
        <div class="form-group">
            <label>Album name</label>
            <input type="text" class="form-control" name="albumName" placeholder="album name" required>
        </div>
        <div class="form-group">
            <label>Cover url</label>
            <input type="text" class="form-control" name="coverUrl" placeholder="cover url" required readonly>
            <div class="form-group">
                <label>Select your file</label>
                <input type="file" class="form-control-file" id="file">
            </div>
        </div>
        <div class="form-group">
            <label>Language</label>
            <input type="text" class="form-control" name="language" placeholder="language" required>
        </div>
        <div class="form-group">
            <label>Release date</label>
            <input type="text" class="form-control" name="releaseDate" placeholder="release date" required>
        </div>
        <div class="form-group">
            <label>Online url</label>
            <input type="text" class="form-control" name="onlineUrl" placeholder="online url" required>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

<footer class="text-center mt-5 mb-5">
  &copy; Chiupi | <a href="admin.php">Back to Management</a>
</footer>




<script src="https://cdn.staticfile.org/jquery/1.10.2/jquery.min.js"></script>
<script>

// upload file with ajax
$(function(){
    $("input[type='file']").change(function(e){
        let file = e.currentTarget.files[0];
        uploadImg(file);
    })

    function uploadImg(src){
        var formdata = new FormData();
        formdata.append("img", src);
        $.ajax({
            type:"post",
            url:"",
            data:formdata,
            contentType: false,
            processData: false,
            success:(data) => {
                let res = JSON.parse(data);
                if(res.code != 1){
                    alert("Upload fail!");
                    return
                }
                $("input[name='coverUrl']").val(res.addr);
            }
        })
    }

})

</script>
</body>
</html>
