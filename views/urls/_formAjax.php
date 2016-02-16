<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Urls */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="urls-form">

    <?php

    echo Html::beginForm('', 'post', ['id' => 'link_form']);

    echo "<div>" . Html::label('Paste your long URL here:', 'locator') . "</br>"
        . Html::textInput('locator', null, ['id' => 'locator', 'class' => 'form-control']) . "</div>";
    echo "<p></p><p>";
    echo Html::a('Shorten URL', ['link-form'], [
            'id' => 'ajax_link_02',
            'data-on-done' => 'linkFormDone',
            'data-form-id' => 'link_form',
            'class' => 'btn btn-success',
        ]
    );
    echo "</p>";
    echo Html::endForm();

    echo Html::textInput('ddd', null, ['id' => 'ajax_result_02', 'class' => 'form-control']);

    $this->registerJs("$('#ajax_link_02').click(handleAjaxLink);", \yii\web\View::POS_READY);
    $this->registerJs("$('#link_form').submit(handleSubmit);", \yii\web\View::POS_READY);
    ?>

</div>
