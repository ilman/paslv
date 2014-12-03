<?php

namespace Admin;

use BaseController;
use View;
use Input;
use Exception;
use Redirect;
use Notification;

use Kwitansi;

class KwitansiController extends BaseController {

	public function getIndex()
	{
		$result = (object) Kwitansi::paginate(12)->toArray();

		$data = array(
			'content' => 'admin/kwitansi/index',
			'filter' => Input::get('filter'),
			'result' => $result,
		);

		return View::make($this->template, $data);
	}

	public function getPrint($kwitansi_id)
	{
		$values = (object) Kwitansi::where('id', '=', $kwitansi_id)->first()->toArray();

		$data = array(
			'content' => 'admin/kwitansi/print',
			'values' => $values,
		);

		return View::make($this->template, $data);
	}

	public function getDelete($kwitansi_id)
	{
		try{
			Kwitansi::where('id', '=', $kwitansi_id)->delete();

			Notification::success('messages.delete_kwitansi_success');
			return Redirect::to('kwitansi');
		}
		catch(Exception $e){
			Notification::error($e->getMessage());
			return Redirect::to('kwitansi');
		}
	}

	public function getEdit($kwitansi_id)
	{
		$values = (object) Kwitansi::where('id', '=', $kwitansi_id)->first()->toArray();

		if(count($values)){
			$values->kwitansi_id = $values->id;
		}

		$data = array(
			'content' => 'admin/kwitansi/edit',
			'values' => $values,
		);

		return View::make($this->template, $data);
	}

	public function getAdd()
	{
		$row = Kwitansi::orderBy('id','desc')->first();
		$kwitansi_id = ($row) ? $row->id + 1 : 1;

		$values = array(
			'created_at' => date('Y-m-d'),
			'kwitansi_id' => $kwitansi_id,
		);

		$data = array(
			'content' => 'admin/kwitansi/add',
			'values' => $values,
		);

		return View::make($this->template, $data);
	}

	public function dataPost()
	{
		$input_kwitansi_number = Input::get('kwitansi_number',0);
		$input_client_name = Input::get('client_name','');
		$input_kwitansi_amount = Input::get('kwitansi_amount',0);
		$input_kwitansi_amount_text = Input::get('kwitansi_amount_text','');
		$input_kwitansi_text = Input::get('kwitansi_text','');
		$input_employee_name = Input::get('employee_name','');

		$data = array(
			'kwitansi_number' => $input_kwitansi_number,
			'client_name' => $input_client_name,
			'kwitansi_amount' => $input_kwitansi_amount,
			'kwitansi_amount_text' => $input_kwitansi_amount_text,
			'kwitansi_text' => $input_kwitansi_text,
			'employee_name' => $input_employee_name,
		);

		return $data;
	}

	public function postAdd()
	{		
		$data = $this->dataPost();

		try{
			Kwitansi::create($data);

			Notification::success('messages.add_kwitansi_success');
			return Redirect::to('kwitansi');
		}
		catch(Exception $e){
			Notification::error($e->getMessage());
			return Redirect::to('kwitansi');
		}
	}

	public function postEdit()
	{
		$input_id = Input::get('kwitansi_id');
		$data = $this->dataPost();

		try{
			Kwitansi::where('id', '=', $input_id)->update($data);

			Notification::success('messages.update_kwitansi_success');
			return Redirect::to('kwitansi');
		}
		catch(Exception $e){
			Notification::error($e->getMessage());
			return Redirect::to('kwitansi');
		}
	}

}
