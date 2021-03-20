<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;

$dbhost = 'localhost';
$dbuser = 'kafe';
$dbpass = 'password';
$conn = mysqli_connect($dbhost, $dbuser, $dbpass);
mysqli_select_db($conn, 'kafe_exe');
$sql = "SELECT * FROM kafe_tabla";
$result = mysqli_query($conn, $sql);
$listData = [];
if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
      array_push($listData, $row);
    }
  } else {
    array_push($listData, "No");
}
mysqli_close($conn);


$this->title = 'Show DB';
?>

<div class="site-contact">
    <h1><?= Html::encode($this->title) ?></h1>
    <div class="container">
    <div class="row">
    <?php foreach ($listData as $persona){
        echo "<div>'$persona[nombre]','$persona[apellido]', '$persona[edad]', '$persona[email]', '$persona[dni]', '$persona[amigo]'</div>";
    }?>
    </div>
    </div>
</div>