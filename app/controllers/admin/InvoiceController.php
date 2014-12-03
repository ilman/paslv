<?php

namespace Admin;

use BaseController;
use View;
use Input;
use Exception;
use Redirect;
use Notification;

use Invoice;

class InvoiceController extends BaseController {

	public function getIndex()
	{
		$result = (object) Invoice::paginate(12)->toArray();

		$data = array(
			'content' => 'admin/invoice/index',
			'filter' => Input::get('filter'),
			'result' => $result,
		);

		return View::make($this->template, $data);
	}

	public function getPrint($invoice_id)
	{
		$values = (object) Invoice::where('id', '=', $invoice_id)->first()->toArray();

		$data = array(
			'content' => 'admin/invoice/print',
			'values' => $values,
		);

		return View::make($this->template, $data);
	}

	public function getDelete($invoice_id)
	{
		try{
			Invoice::where('id', '=', $invoice_id)->delete();

			Notification::success('messages.delete_invoice_success');
			return Redirect::to('invoice');
		}
		catch(Exception $e){
			Notification::error($e->getMessage());
			return Redirect::to('invoice');
		}
	}

	public function getEdit($invoice_id)
	{
		$values = (object) Invoice::where('id', '=', $invoice_id)->first()->toArray();

		if(count($values)){
			$values->invoice_id = $values->id;
		}

		$data = array(
			'content' => 'admin/invoice/edit',
			'values' => $values,
		);

		return View::make($this->template, $data);
	}

	public function getAdd()
	{
		$row = Invoice::orderBy('id','desc')->first();
		$invoice_id = ($row) ? $row->id + 1 : 1;

		$values = array(
			'created_at' => date('Y-m-d'),
			'invoice_id' => $invoice_id,
		);

		$data = array(
			'content' => 'admin/invoice/add',
			'values' => $values,
		);

		return View::make($this->template, $data);
	}

	public function dataPost()
	{
		$input_invoice_number = Input::get('invoice_number',0);
		$input_client_name = Input::get('client_name','');
		$input_invoice_amount = Input::get('invoice_amount',0);
		$input_invoice_amount_text = Input::get('invoice_amount_text','');
		$input_invoice_text = Input::get('invoice_text','');
		$input_employee_name = Input::get('employee_name','');

		$data = array(
			'invoice_number' => $input_invoice_number,
			'client_name' => $input_client_name,
			'invoice_amount' => $input_invoice_amount,
			'invoice_amount_text' => $input_invoice_amount_text,
			'invoice_text' => $input_invoice_text,
			'employee_name' => $input_employee_name,
		);

		return $data;
	}

	public function postAdd()
	{		
		$data = $this->dataPost();

		try{
			Invoice::create($data);

			Notification::success('messages.add_invoice_success');
			return Redirect::to('invoice');
		}
		catch(Exception $e){
			Notification::error($e->getMessage());
			return Redirect::to('invoice');
		}
	}

	public function postEdit()
	{
		$input_id = Input::get('invoice_id');
		$data = $this->dataPost();

		try{
			Invoice::where('id', '=', $input_id)->update($data);

			Notification::success('messages.update_invoice_success');
			return Redirect::to('invoice');
		}
		catch(Exception $e){
			Notification::error($e->getMessage());
			return Redirect::to('invoice');
		}
	}

}
