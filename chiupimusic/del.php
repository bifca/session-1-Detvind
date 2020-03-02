<?php
require_once __DIR__ . "/models/model.php";

$id = isset($_GET["id"]) ? $_GET["id"] : ""; // The ternary operation

// if(isset($_GET["id"])) {
//     $id = $_GET["id"];
// }else{
//     $id = "";
// }


if($id === ""){
    echo "Parameter missing";
    return;
}


$db = new DB();
try {
    $db->delete("album", $id);
} catch (\Throwable $th) {
    echo "Delele error";
    return;
}

echo "
<p>Delete sucessful！return in three seconds<p>

<script>
setTimeout(() => {
    window.history.back();
}, 3000);
</script>";
