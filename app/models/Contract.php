<?php 

class Contract extends Eloquent{

	use SoftDeletingTrait;

	public $table      = 'contracts';
	public $guarded    = array('id');

	protected $dates      = ['deleted_at'];
	protected $softDelete = true; 
}