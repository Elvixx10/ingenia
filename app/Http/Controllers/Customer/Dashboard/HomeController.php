<?php

namespace App\Http\Controllers\Customer\Dashboard;

use Illuminate\Routing\Controller as BaseController;
use App\Models\Users;
use App\Models\Status;
use App\Http\Requests\UpdateRequests;
use App\Http\Requests\CreateRequests;
use App\Models\InformationUsers;
use Carbon\Carbon;
use Log;
use DB;
use PDF;
use Excel;

class HomeController extends BaseController
{	
	public function index(Users $user, $like=null) 
	{
		if( !is_null($like) ) {
			$all = $user->searchingByUser($like);
		} else {
			$all = $user->getListUsers();
		}
		return view("dashboard.index", compact('all', 'like'));
	}
	
	public function  getByUser($id, Status $status, Users $user) {
		$statusOption = $status->all();
		$info = $user->getUserinformationById($id);
		return view("dashboard.update", compact('statusOption', 'info', 'id'));
	}
	
	public function deleteByUser ($id,  Users $user) {
		$user->where('id',$id)->delete();
		return redirect('customer/dashboard');
	}
	
	public function  createByUser(Status $status) {		
		$statusOption = $status->all();
		return view("dashboard.create", compact('statusOption'));
	}
	
	public function  create(CreateRequests $request, Users $user, InformationUsers $iu) {
		if( $request->method('post') ) {
			DB::beginTransaction();
			try {
				$user = new Users;
				$user->email = $request->email;
				$user->password = bcrypt($request->password);
				$user->statusId = $request->status;
				$user->save();
				
				$informationUsers = new  InformationUsers;
				$informationUsers->name = $request->name;
				$informationUsers->lastName= $request->lastname;
				$informationUsers->birthDate= $request->birthdate;
				$informationUsers->phone= $request->phone;
				$informationUsers->card= $request->card;
				$informationUsers->userId= $user->id;
				$informationUsers->save();
				DB::commit();
				return redirect('/customer/dashboard');
			} catch (\Exception $e){
				Log::error('Error: '.$e->getMessage().' - Line:' .$e->getLine());
				DB::rollback();
				session()->flash('error', 'Error al crear el cliente.');
			}
		}
	}
	
	public function update(UpdateRequests $request, Users $user, InformationUsers $iu) {
		if( $request->method('post') ) {
			DB::beginTransaction();
			try {
				$updateByUser = $user->where("id", $request->id)->first();
				if($updateByUser) {
					$updateByUser->email= $request->email;
					if( !empty($request->password) ) {
						$updateByUser->password = bcrypt($request->password);
					}
					$updateByUser->statusId = $request->status;
					$updateByUser->save();
					
					$updateByIu = $iu->where("userId", $request->id)->first();
					if( $updateByIu ) {
						$updateByIu->name= $request->name;
						$updateByIu->lastName= $request->lastname;
						$updateByIu->birthDate= $request->birthdate;
						$updateByIu->phone= $request->phone;
						$updateByIu->card= $request->card;
						$updateByIu->save();
					}
				}
				DB::commit();
				session()->flash('success', 'Información actualizada.');
			} catch (\Exception $e){
				Log::error('Error: '.$e->getMessage().' - Line:' .$e->getLine());
				DB::rollback();
				session()->flash('error', 'Error al intentar actualizar la información.');
			}
			return redirect('customer/edit-by-user/'.$request->id);
		}
	}
	
	public function generatePDF(Users $user, $like=null){
		if( !is_null($like) ) {
			$all = $user->searchingByUser($like);
		} else {
			$all = $user->getListUsers();
		}
		
		$data = [
			'title' => 'Listado de clientes',
			'all' => $all
		];
		
		$pdf = PDF::loadView('report.pdf', $data);
		return $pdf->download('report.pdf');
	}
	
	public function downloadExcel(Users $user,$like=null){
		if( !is_null($like) ) {
			$all = $user->searchingByUser($like);
		} else {
			$all = $user->getListUsers();
		}
		
		$data = $all;
		$name = 'report' . date('YmdHim');
		return Excel::create($name, function($excel) use ($data) {
			$excel->sheet('mySheet', function($sheet) use ($data){
				$sheet->row(1, [
					'#',
					'Nombre',
					'Email',
					'Fecha de nacimiento'
				]);
				
				$array = [];
				foreach ($data as $value) {
					$date = (new Carbon($value->birthDate));
					$array[] = [
						$value->id,
						$value->name. ' '. $value->lastName,
						$value->email,
						$date->format('d/m/Y')
					];
				}
				$sheet->rows($array);
			});
		})->download('xls');
	}
}