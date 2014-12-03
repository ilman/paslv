<?php 

class Invoice extends Eloquent{

	use SoftDeletingTrait;

	public $table      = 'invoices';
	public $guarded    = array('id');

	protected $dates      = ['deleted_at'];
	protected $softDelete = true; 
}