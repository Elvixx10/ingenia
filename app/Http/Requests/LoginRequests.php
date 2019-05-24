<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequests extends FormRequest{
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
			'email' => 'required|email',
			'password' => 'required|min:8'
		];
	}
	
	public function messages()
	{
		return [
			'email.required' => 'El correo electrónico es requerido.',
			'email.email' => 'El correo electrónico no es v&aacutelido.',
			'password.required' => 'La contraseña es requerida.',
			'password.min' => 'La contraseña debe tener mínimo 8 caracteres.',
		];
	}
}