<?php 

class Receipt extends Eloquent{

	use SoftDeletingTrait;

	public $table      = 'receipts';
	public $guarded    = array('id');

	protected $dates      = ['deleted_at'];
	protected $softDelete = true; 
}