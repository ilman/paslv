<?php

namespace Admin;

use BaseController;
use View;
use Input;
use Exception;
use Redirect;
use Notification;

use Client;

class ClientController extends BaseController {

	public function getIndex()
	{
		$result = (object) Client::paginate(12)->toArray();

		$data = array(
			'content' => 'admin/client/index',
			'filter' => Input::get('filter'),
			'result' => $result,
		);

		return View::make($this->template, $data);
	}

	public function getDelete($client_id)
	{
		try{
			Client::where('id', '=', $client_id)->delete();

			Notification::success('messages.delete_client_success');
			return Redirect::to('client');
		}
		catch(Exception $e){
			Notification::error($e->getMessage());
			return Redirect::to('client');
		}
	}

	public function getEdit($client_id)
	{
		$values = (object) Client::where('id', '=', $client_id)->first()->toArray();

		if(count($values)){
			$values->invoice_id = $values->id;
		}

		$data = array(
			'content' => 'admin/client/edit',
			'values' => $values,
		);

		return View::make($this->template, $data);
	}

	public function getAdd()
	{
		$values = array();

		$data = array(
			'content' => 'admin/client/add',
			'values' => $values,
		);

		return View::make($this->template, $data);
	}

	public function dataPost()
	{
		$input_client_name = Input::get('client_name','');
		$input_client_title = Input::get('client_title','');
		$input_client_address = Input::get('client_address','');
		$input_client_phone = Input::get('client_phone','');
		$input_client_id_type = Input::get('client_id_type','');
		$input_client_id_number = Input::get('client_id_number','');
		$input_client_id_expired = Input::get('client_id_expired','');
		$input_company_id = Input::get('company+id',0);

		$data = array(
			'client_name' => $input_client_name,
			'client_title' => $input_client_title,
			'client_address' => $input_client_address,
			'client_phone' => $input_client_phone,
			'client_id_type' => $input_client_id_type,
			'client_id_number' => $input_client_id_number,
			'client_id_expired' => $input_client_id_expired,
			'company_id' => $input_company_id,
		);

		return $data;
	}

	public function postAdd()
	{
		$data = $this->dataPost();

		try{
			Client::create($data);

			Notification::success('messages.add_client_success');
			return Redirect::to('client');
		}
		catch(Exception $e){
			Notification::error($e->getMessage());
			return Redirect::to('client');
		}
	}

	public function postEdit()
	{
		$input_id = Input::get('client_id');

		$data = $this->dataPost();

		try{
			Client::where('id', '=', $input_id)->update($data);

			Notification::success('messages.edit_client_success');
			return Redirect::to('client');
		}
		catch(Exception $e){
			Notification::error($e->getMessage());
			return Redirect::to('client');
		}
	}

}
