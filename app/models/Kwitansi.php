<?php 

class Kwitansi extends Eloquent{

	use SoftDeletingTrait;

	public $table      = 'kwitansi';
	public $guarded    = array('id');

	protected $dates      = ['deleted_at'];
	protected $softDelete = true; 
}