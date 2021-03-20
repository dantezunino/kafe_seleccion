<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;

$dbhost = 'localhost';
$dbuser = 'kafe';
$dbpass = 'password';
$conn = mysqli_connect($dbhost, $dbuser, $dbpass);
mysqli_select_db($conn, 'kafe_exe');
$sql = "SELECT nombre, apellido FROM kafe_tabla";
$result = mysqli_query($conn, $sql);
$listData = [];
if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
      $nomlis = $row["nombre"]." ".$row["apellido"];
      array_push($listData, $nomlis);
    }
  } else {
    array_push($listData, "No");
}
mysqli_close($conn);


$this->title = 'Registro';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="site-contact">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">
            <div class="col-lg-5">

                <?php $form = ActiveForm::begin(['id' => 'registro']); ?>

                    <?= $form->field($model, 'nombre')->textInput(['autofocus' => true]) ?>

                    <?= $form->field($model, 'apellido') ?>

                    <?= $form->field($model, 'edad') ?>

                    <?= $form->field($model, 'email') ?>

                    <?= $form->field($model, 'dni') ?>

                    <?= $form->field($model, 'amigo')->dropDownList(
                            $listData,
                            ['prompt'=>'Elegir amigo...']
                            );?>

                    <div class="form-group">
                        <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'registro-button']) ?>
                    </div>

                <?php ActiveForm::end(); ?>

            </div>
            
    </div>
</div>
