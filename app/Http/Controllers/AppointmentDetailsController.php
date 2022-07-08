<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AppointmentDetails;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use App\Repositories\ResponseRepository;

class AppointmentDetailsController extends Controller
{
    public function __construct(ResponseRepository $response)
    {
        $this->response = $response;
        $this->storeRules = [
            'customer_name' => 'required',
            'customer_no' => 'required',
            'date' => 'required',
            'purpose_visit' => 'required',

        ];
    
      
    }
    public function findBanner($id) {
        return AppointmentDetails::find($id);
    }
    public function index()
    {
        return $this->response->jsonResponse(false, $this->response->message('appointmentDetails', 'index'), AppointmentDetails::orderBy('id', 'desc')->get(), 200);
        
    }
    public function show($id)
    {
        return $this->response->jsonResponse(false, $this->response->message('appointmentDetails', 'show'), $this->findBanner($id), 200);
    }

    public function store(Request $request)
    {
        $validate = $this->response->validate($request->all(), $this->storeRules);
        if($validate === true) {
            return $this->response->jsonResponse(false, $this->response->message('appointmentDetails', 'store'), AppointmentDetails::create($request->all()), 200);
        } else {
            return $validate;
        }
    }

}
