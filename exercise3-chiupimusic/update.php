<?php
require_once __DIR__ . "/models/model.php";

$id = isset($_GET["id"]) ? $_GET["id"] : ""; // 三元运算

if($id === ""){
    echo "Parameter missing";
    return;
}

$db = new DB();
$row = $db->query("select * from album where albumID=$id");
$row = $row[0];

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
        !isset($_POST["albumID"]) ||
        !isset($_POST["albumName"]) ||
        !isset($_POST["coverUrl"]) ||
        !isset($_POST["language"]) ||
        !isset($_POST["releaseDate"]) ||
        !isset($_POST["onlineUrl"])
    ) {
        echo "Missing parameter!";
        return;
    }
    $albumID     = $_POST["albumID"];
    $albumName   = $_POST["albumName"];
    $coverUrl    = $_POST["coverUrl"];
    $language    = $_POST["language"];
    $releaseDate = $_POST["releaseDate"];
    $onlineUrl   = $_POST["onlineUrl"];

    try {
        $db->update("UPDATE album SET albumName='$albumName', coverUrl='$coverUrl', language='$language', releaseDate='$releaseDate', onlineUrl='$onlineUrl'
        WHERE albumID=$albumID");
    } catch (\Throwable $th) {
        echo "Update error: ". $th;
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
    <title>Chiupi Music | Update</title>
</head>
<body>


<div class="container-fluid">
    <form method="post">
        <div class="form-group">
            <input type="hidden" name="albumID" value="<?php echo $row['albumID']; ?>">
        </div>
        <div class="form-group">
            <label>Album name</label>
            <input type="text" class="form-control" name="albumName" placeholder="album name" value="<?php echo $row['albumName']; ?>" required>
        </div>
        <div class="form-group">
            <label>Cover url</label>
            <input type="text" class="form-control" name="coverUrl" placeholder="cover url" value="<?php echo $row['coverUrl']; ?>" required readonly>
            <div class="form-group">
                <label>Select your file</label>
                <input type="file" class="form-control-file" id="file">
            </div>
        </div>
        <div class="form-group">
            <label>Language</label>
            <input type="text" class="form-control" name="language" placeholder="language" value="<?php echo $row['language']; ?>" required>
        </div>
        <div class="form-group">
            <label>Release date</label>
            <input type="text" class="form-control" name="releaseDate" placeholder="release date" value="<?php echo $row['releaseDate']; ?>" required>
        </div>
        <div class="form-group">
            <label>Online url</label>
            <input type="text" class="form-control" name="onlineUrl" placeholder="online url" value="<?php echo $row['onlineUrl']; ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>




<script src="https://cdn.staticfile.org/jquery/1.10.2/jquery.min.js"></script>
<script>
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
