<?php

namespace Admin;

use BaseController;
use View;
use Input;
use Exception;
use Redirect;
use Notification;

use Company;

class CompanyController extends BaseController {

	public function getIndex()
	{
		$result = (object) Company::paginate(12)->toArray();

		$data = array(
			'content' => 'admin/company/index',
			'filter' => Input::get('filter'),
			'result' => $result,
		);

		return View::make($this->template, $data);
	}

	public function getDelete($company_id)
	{
		try{
			Company::where('id', '=', $company_id)->delete();

			Notification::success('messages.delete_company_success');
			return Redirect::to('company');
		}
		catch(Exception $e){
			Notification::error($e->getMessage());
			return Redirect::to('company');
		}
	}

	public function getEdit($company_id)
	{
		$values = (object) Company::where('id', '=', $company_id)->first()->toArray();

		if(count($values)){
			$values->invoice_id = $values->id;
		}

		$data = array(
			'content' => 'admin/company/edit',
			'values' => $values,
		);

		return View::make($this->template, $data);
	}

	public function getAdd()
	{
		$values = array();

		$data = array(
			'content' => 'admin/company/add',
			'values' => $values,
		);

		return View::make($this->template, $data);
	}

	public function dataPost()
	{
		$input_company_name = Input::get('company_name','');
		$input_company_address = Input::get('company_address','');
		$input_company_phone = Input::get('company_phone','');
		$input_company_fax = Input::get('company_fax','');

		$data = array(
			'company_name' => $input_company_name,
			'company_address' => $input_company_address,
			'company_phone' => $input_company_phone,
			'company_fax' => $input_company_phone,
		);

		return $data;
	}

	public function postAdd()
	{
		$data = $this->dataPost();

		try{
			Company::create($data);

			Notification::success('messages.add_company_success');
			return Redirect::to('company');
		}
		catch(Exception $e){
			Notification::error($e->getMessage());
			return Redirect::to('company');
		}
	}

	public function postEdit()
	{
		$input_id = Input::get('company_id');

		$data = $this->dataPost();

		try{
			Company::where('id', '=', $input_id)->update($data);

			Notification::success('messages.edit_company_success');
			return Redirect::to('company');
		}
		catch(Exception $e){
			Notification::error($e->getMessage());
			return Redirect::to('company');
		}
	}

}
