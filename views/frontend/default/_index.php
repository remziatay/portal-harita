<?php
use kouosl\theme\helpers\Html;
use kouosl\theme\widgets\Portlet;

$this->title = 'Harita';
$data['title'] = Html::encode($this->title);
//$this->params['breadcrumbs'][] = $this->title;



Portlet::begin(['title' => $this->title]);

echo $this->render('index', ['zoom' => 16]);

Portlet::end();



