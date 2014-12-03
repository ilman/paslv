<?php

namespace Admin;

use BaseController;
use View;
use Input;
use Exception;
use Redirect;
use Notification;

use Receipt;

class ReceiptController extends BaseController {

	public function getIndex()
	{
		$result = (object) Receipt::paginate(12)->toArray();

		$data = array(
			'content' => 'admin/receipt/index',
			'filter' => Input::get('filter'),
			'result' => $result,
		);

		return View::make($this->template, $data);
	}

	public function getPrint($receipt_id)
	{
		$values = (object) Receipt::where('id', '=', $receipt_id)->first()->toArray();

		$data = array(
			'content' => 'admin/receipt/print',
			'values' => $values,
		);

		return View::make($this->template, $data);
	}

	public function getDelete($receipt_id)
	{
		try{
			Receipt::where('id', '=', $receipt_id)->delete();

			Notification::success('messages.delete_receipt_success');
			return Redirect::to('receipt');
		}
		catch(Exception $e){
			Notification::error($e->getMessage());
			return Redirect::to('receipt');
		}
	}

	public function getEdit($receipt_id)
	{
		$values = (object) Receipt::where('id', '=', $receipt_id)->first()->toArray();

		if(count($values)){
			$values->invoice_id = $values->id;
		}

		$data = array(
			'content' => 'admin/receipt/edit',
			'values' => $values,
		);

		return View::make($this->template, $data);
	}

	public function getAdd()
	{
		$row = Receipt::orderBy('id','desc')->first();
		$receipt_id = ($row) ? $row->id + 1 : 1;

		$values = array(
			'created_at' => date('Y-m-d'),
			'receipt_id' => $receipt_id,
		);

		$data = array(
			'content' => 'admin/receipt/add',
			'values' => $values,
		);

		return View::make($this->template, $data);
	}

	public function dataPost()
	{
		$input_receipt_number = Input::get('receipt_number',0);
		$input_type = Input::get('type','');
		$input_employee_name = Input::get('employee_name',0);
		$input_client_name = Input::get('client_name','');
		$input_client_address = Input::get('client_address','');
		$input_content_json = Input::get('content','');

		$data = array(
			'receipt_number' => $input_receipt_number,
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
			Receipt::create($data);

			Notification::success('messages.add_receipt_success');
			return Redirect::to('receipt');
		}
		catch(Exception $e){
			Notification::error($e->getMessage());
			return Redirect::to('receipt');
		}
	}

	public function postEdit()
	{
		$input_id = Input::get('receipt_id');

		$data = $this->dataPost();

		try{
			Receipt::where('id', '=', $input_id)->update($data);

			Notification::success('messages.edit_receipt_success');
			return Redirect::to('receipt');
		}
		catch(Exception $e){
			Notification::error($e->getMessage());
			return Redirect::to('receipt');
		}
	}

}
