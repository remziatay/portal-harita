<?php

namespace kouosl\harita\widgets;
use kouosl\harita\helpers\Html;
use kouosl\harita\widgets\WGoogleStaticMap;
use kouosl\harita\widgets\Box;
use kouosl\harita\widgets\ActiveForm;
use Yii;

class Admin extends \yii\bootstrap\Widget
{

    public $attrs = array();

    public function init()
	{
        parent::init();
        if (!isset($this->attrs['width']))
            $this->attrs['width'] = 500;

        $this->attrs['block'] = true;
	}

	public function run()
	{
        Box::begin(['attrs' => $this->attrs]); ?>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-md-12">
                                <?php Box::begin(['attrs' => ['block' => true]]); ?>
                                    <?php ActiveForm::begin([
                                        'method' => 'get',
                                        'action' => ['add', 'attrs' => $this->attrs],
                                        'options' => ['data-pjax' => true 
                                        ]]); ?>
                                        <div class="form-row">
                                            <div class="col-md-6">
                                                <label>Address Name:</label>
                                            </div>
                                            <div class="col-md-6">
                                                <input type="text" class="form-control" name="name">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-6">
                                                <label>Address:</label>
                                            </div>
                                            <div class="col-md-6">
                                                <input type="text" class="form-control" name="center">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-6">
                                                <label>Zoom:</label>
                                            </div>
                                            <div class="col-md-6">
                                                <input type="text" class="form-control" name="zoom">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-12">
                                                <button type="submit" class="btn btn-primary btn-info btn-block">Add Address</button>
                                            </div>
                                        </div>
                                    <?php ActiveForm::end(); ?>
                                <?php Box::end(); ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <?php Box::begin(['attrs' => ['block' => true]]); ?>
                                    <?php ActiveForm::begin([
                                        'method' => 'get',
                                        'action' => ['setdefault', 'attrs' => $this->attrs],
                                        'options' => ['data-pjax' => true 
                                        ]]); ?>
                                        <div class="form-row">
                                            <div class="col-md-6">
                                                <label>Address Name:</label>
                                            </div>
                                            <div class="col-md-6">
                                                <input type="text" class="form-control" name="name">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-12">
                                                <button type="submit" class="btn btn-primary btn-success btn-block">Set Default</button>
                                            </div>
                                        </div>
                                        <?php ActiveForm::end(); ?>
                                <?php Box::end(); ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <?php Box::begin(['attrs' => ['block' => true]]); ?>
                                    <?php ActiveForm::begin([
                                        'method' => 'get',
                                        'action' => ['delete', 'attrs' => $this->attrs],
                                        'options' => ['data-pjax' => true 
                                        ]]); ?>
                                        <div class="form-row">
                                            <div class="col-md-6">
                                                <label>Address Name:</label>
                                            </div>
                                            <div class="col-md-6">
                                                <input type="text" class="form-control" name="name">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-12">
                                                <button type="submit" class="btn btn-primary btn-danger btn-block">Delete</button>
                                            </div>
                                        </div>
                                    <?php ActiveForm::end(); ?>
                                <?php Box::end(); ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <?php Box::begin(['attrs' => [
                            'max-height' => $this->attrs['max-height']-15,
                            'block' => true
                            ]]); 
                            $this->getNames();?>
                        <?php Box::end(); ?>
                    </div>
                </div>
            </div>
        <?php Box::end();	
    }
    
    public function getNames()
	{
        $addresses = (new \yii\db\Query())->select('name')->from('default_address')->all();
	
        foreach ($addresses as $address) {
            //echo '<div class="row"><div class="col-md-1">'.$address['name'].' </div></div>';
            echo '<p>' . $address['name'] . "</p>\n";
        }
	}
}