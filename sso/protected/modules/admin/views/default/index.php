<?php
/* @var $this DefaultController */

$this->breadcrumbs=array(
	$this->module->id,
);
?>
<ul>
    <li><a href="<?=$this->createUrl('/admin/activeTokens/admin')?>">Manage Active Tokens</a></li>
    <li><a href="<?=$this->createUrl('/admin/logs/admin')?>">Manage Logs</a></li>
    <li><a href="<?=$this->createUrl('/admin/users/admin')?>">Manage Users</a></li>
     <li><a href="<?=$this->createUrl('/admin/serviceProviders/admin')?>">Manage Service Providers</a></li>
</ul>