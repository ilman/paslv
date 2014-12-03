<?php 

class Company extends Eloquent{

	use SoftDeletingTrait;

	public $table      = 'companies';
	public $guarded    = array('id');

	protected $dates      = ['deleted_at'];
	protected $softDelete = true; 
}