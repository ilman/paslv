<?php 

class Client extends Eloquent{

	use SoftDeletingTrait;

	public $table      = 'clients';
	public $guarded    = array('id');

	protected $dates      = ['deleted_at'];
	protected $softDelete = true; 
}