<?php 
$folder = Yii::app()->params->productImagesFolder;

if($model->filename) 
	$path = Yii::app()->baseUrl. '/' . $folder . '/' . $model->filename;
	else
	$path = Yep::register('no-pic.jpg');
?>
<div style="height: 120px;overflow:hidden; ">
<?php

echo CHtml::image($path,
		$model->title,
		array(
			'title' => $model->title,
			'style' => 'margin: 10px;',
			'width' => isset($thumb) && $thumb
			? Yii::app()->params->imageWidthThumb 
			: Yii::app()->params->imageWidth)
		); ?>
</div>
<?php 

if(Yii::app()->params->useWithYum && Yii::app()->user->isAdmin()) 
	echo CHtml::link(Yii::t('msg', 'Delete Image'),
			array('delete', 'id' => $model->id)); ?>
