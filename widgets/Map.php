<?php

namespace kouosl\harita\widgets;
use kouosl\harita\helpers\Html;
use kouosl\harita\widgets\WGoogleStaticMap;
use kouosl\harita\widgets\Box;
use kouosl\harita\widgets\ActiveForm;

class Map extends \yii\bootstrap\Widget
{

    public $attrs = array();

    public function init()
	{
        parent::init();
        if (!isset($this->attrs['zoom']))
            $this->attrs['zoom'] = 16;
	}

	public function run()
	{
        Box::begin(['attrs' => [
            'width' => $this->attrs['width']+35,
            'height' => $this->attrs['height']+150
            ]]); ?>
            <div class="container-fluid">
                <?php ActiveForm::begin([
                    'method' => 'get',
                    'action' => ['search', 'attrs' => $this->attrs],
                    'options' => ['data-pjax' => true ]
                    ]); ?>
                    <div class="row">
                        <div class="col-md-4">
                            <label>Location:</label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="center">
                        </div>
                        
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary btn-success btn-block">Search</button>
                        </div>
                    </div>
                <?php ActiveForm::end(); ?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6">
                                <?= Html::a("+", ['zoomin', 'attrs' => $this->attrs], ['class' => 'btn  btn-primary btn-block']) ?>
                            </div>
                            <div class="col-md-6">
                                <?= Html::a("-", ['zoomout', 'attrs' => $this->attrs], ['class' => 'btn  btn-primary btn-block']) ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <?= Html::a("Save Address", ['save', 'attrs' => $this->attrs], ['class' => 'btn btn-success btn-block']) ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <?= WGoogleStaticMap::widget([
                            'center'=>$this->attrs['center'],
                            'alt'=>"Map",
                            'markers'=>array(
                                array(
                                    'style'=>array('color'=>'red'),
                                    'locations'=>array($this->attrs['center']),
                                )),
                            'zoom'=>$this->attrs['zoom'],
                            'width'=>$this->attrs['width'],
                            'height'=>$this->attrs['height'],
                            'apiKey'=>'/*APİ KEY GİRİNİZ*/'
                        ]);?>
                    </div>
                </div>
            </div>
        <?php Box::end();	
	}
}