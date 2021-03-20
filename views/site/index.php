<?php

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Kafé Sistemas</h1>

        <p class="lead">Ejercicio de Proceso de Selección.</p>

    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-5">
                Buenas. Antes que nada quiero agradecer por la oportunidad que me han dado, y por la experiencia que han sido estos días. 
                Nunca había escrito en PHP, mucho menos utilizado Yii2, del cual ni sabía que existía. Pero después de 4 días bastante intensos llegué a hacer al menos algo, por más rudimentaria que hayan sido mis soluciones.
            </div>
            <div class="col-lg-5">
                Agregué dos nuevas direcciones: Registro y ShowDB, que se pueden acceder desde el navbar. En "Registro" se encuentra el formulario con los campos requeridos y el dropdown de amigos que toma la información de la base de datos.
                En "Show DB" simplemente se muestra la información de la tabla. Está para no tener que salir de la página para ver los cambios. Creo que todos los campos se corresponden con los requerimientos del ejercicio.
            </div>
            <div class="col-lg-2">
                <ul>
                  <li>El nombre de la base de datos es: kafe_exe</li>
                  <li>El nombre de la tabla es: kafe_tabla</li>
                </ul>
            </div>
        </div>

    </div>
</div>
