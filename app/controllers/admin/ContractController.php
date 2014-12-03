<?php

namespace Admin;

use BaseController;
use View;
use Input;
use Exception;
use Redirect;
use Notification;

use Contract;

class ContractController extends BaseController {

	public function getIndex()
	{
		$result = (object) Contract::paginate(12)->toArray();

		$data = array(
			'content' => 'admin/contract/index',
			'filter' => Input::get('filter'),
			'result' => $result,
		);

		return View::make($this->template, $data);
	}

	public function getPrint($contract_id)
	{
		$values = (object) Contract::where('id', '=', $contract_id)->first()->toArray();

		$data = array(
			'content' => 'admin/contract/print',
			'values' => $values,
		);

		return View::make($this->template, $data);
	}

	public function getDelete($contract_id)
	{
		try{
			Contract::where('id', '=', $contract_id)->delete();

			Notification::success('messages.delete_contract_success');
			return Redirect::to('contract');
		}
		catch(Exception $e){
			Notification::error($e->getMessage());
			return Redirect::to('contract');
		}
	}

	public function getEdit($contract_id)
	{
		$values = (object) Contract::where('id', '=', $contract_id)->first()->toArray();

		if(count($values)){
			$values->invoice_id = $values->id;
		}

		$data = array(
			'content' => 'admin/contract/edit',
			'values' => $values,
		);

		return View::make($this->template, $data);
	}

	public function getAdd()
	{
		$row = Contract::orderBy('id','desc')->first();
		$contract_id = ($row) ? $row->id + 1 : 1;

		$values = array(
			'created_at' => date('Y-m-d'),
			'contract_id' => $contract_id,
		);

		$data = array(
			'content' => 'admin/contract/add',
			'values' => $values,
		);

		return View::make($this->template, $data);
	}

	public function dataPost()
	{
		$input_contract_number = Input::get('contract_number',0);
		$input_type = Input::get('type','');
		$input_employee_name = Input::get('employee_name',0);
		$input_client_name = Input::get('client_name','');
		$input_client_address = Input::get('client_address','');
		$input_content_json = Input::get('content','');

		$data = array(
			'contract_number' => $input_contract_number,
			'type' => $input_type,
			'client_name' => $input_client_name,
			'client_address' => $input_client_address,
			'employee_name' => $input_employee_name,
			'content_json' => json_encode($input_content_json),
		);

		return $data;
	}

	public function postAdd()
	{
		$data = $this->dataPost();

		try{
			Contract::create($data);

			Notification::success('messages.add_contract_success');
			return Redirect::to('contract');
		}
		catch(Exception $e){
			Notification::error($e->getMessage());
			return Redirect::to('contract');
		}
	}

	public function postEdit()
	{
		$input_id = Input::get('contract_id');

		$data = $this->dataPost();

		try{
			Contract::where('id', '=', $input_id)->update($data);

			Notification::success('messages.edit_contract_success');
			return Redirect::to('contract');
		}
		catch(Exception $e){
			Notification::error($e->getMessage());
			return Redirect::to('contract');
		}
	}

}
