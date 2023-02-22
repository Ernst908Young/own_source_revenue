<?php
/* @var $this DefaultController */

$this->breadcrumbs=array(
	$this->module->id,
);
?>
<h1><?php echo $this->uniqueId . '/' . $this->action->id; ?></h1>

<ul>
    <li><a href="<?=$this->createUrl('/admin/documents/admin')?>">Manage Documents</a></li>
    <li><a href="<?=$this->createUrl('/admin/documentsMetainfo/admin')?>">Manage Documents Metainfo</a></li>
    
</ul>