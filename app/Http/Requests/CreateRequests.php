<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequests extends FormRequest{
	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return true;
	}
	
	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'name' => 'required|regex:/^[a-zA-ZáéíóúñÁÉÍÓÚÑ ]+$/',
			'lastname' => 'required|regex:/^[a-zA-ZáéíóúñÁÉÍÓÚÑ ]+$/',
			'email' => ['required', 'email', 'unique:users,email'],
			'birthdate' => 'required|date_format:"Y-m-d"',
		    'phone' => 'required|numeric',
			'card' => 'required|numeric',
			'status' => 'required'
		];
	}
	
	public function messages()
	{
		return [
			'name.required' => 'El campo nombre es requerido.',
			'name.regex' => 'El formato del campo nombre es inválido.',
			'lastname.required' =>  'El campo apellido(s) es requerido.',
			'lastname.regex' =>  'El formato del campo apellido(s) es inválido.',
			'email.required' => 'El campo correo electrónico es requerido.',
			'email.email' => 'El correo electrónico no es válido.',
			'email.unique' => 'El correo electrónico que intenta registrar ya esta en uso.',
			'birthdate.required' => 'El campo Fecha de nacimiento es requerido.',
			'birthdate.date_format' => 'El formato del campo fecha de nacimiento es inválido.',
		    'phone.required' => 'El campo teléfono es requerido.',
			'phone.numeric' => 'El campo teléfono debe ser de tipo númerico.',
			'card.required' => 'El campo número de tarjeta de crédito es requerido.',
			'card.numeric' => 'El campo número de tarjeta de crédito debe ser de tipo númerico.',
			'status.required' => 'El campo estatus es requerido.'
		];
	}
}