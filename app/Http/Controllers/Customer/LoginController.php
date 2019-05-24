<?php
namespace App\Http\Controllers\Customer;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth; 
use App\Http\Requests\LoginRequests;
use App\Models\Status;

class LoginController extends BaseController
{
	use AuthenticatesUsers;
	
	protected $redirectTo = '/customer/dashboard';
	
	public function __construct()
	{
		$this->middleware('guest')->except('logout');
	}
	
	public function index() {
		return view("login.login");
	}
	
	public function setLogin(LoginRequests $request) {
		if( $request->method('post') ) {
			$credentials = $request->only('email', 'password');
			$credentials['statusId'] = Status::ACTIVE;
			
			if( Auth::attempt($credentials, $request->has('remember')) ) {
				return redirect()->intended($this->redirectPath());
			}
			
			session()->flash('error', 'Error usuario o contraseña.');
			return redirect('/');
		}
		
		return redirect('/');
	}
	
	protected function redirectPath()
	{
		if (property_exists($this, 'redirectPath')) {
			return $this->redirectPath;
		}
		
		return property_exists($this, 'redirectTo') ? $this->redirectTo : '/customer/dashboard';
	}
	
	public function logout() {
		Auth::logout();
		return redirect('/');
	}
}
