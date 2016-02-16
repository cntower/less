<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UrlsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Urls';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="urls-index">

    <?= $this->render('_formAjax.php') ?>

</div>
