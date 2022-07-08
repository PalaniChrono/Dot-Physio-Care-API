<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Address;
use App\Repositories\ResponseRepository;
use Illuminate\Support\Facades\Log;


class AddressController extends Controller
{
    public function __construct(ResponseRepository $response)
    {
        $this->response = $response;
        $this->storeRules = [
          'address' => 'required',
          'quotes'=> 'required'          
        ];
       
  
    }

    public function getAllAddress(){
        $data = Address::all();
        return $this->response->jsonResponse(false,"All Details Fetched Successfully", $data, 200);
 
     }
     public function updateAlldetails(Request $request)
    {
        $validate = $this->response->validate($request->all(), $this->storeRules);
     
      if($validate === true) {
        $Products = Address::first()->update($request->all());
          return $this->response->jsonResponse(false, $this->response->message('All Details', 'update'),'' , 200);
      } else {
          return $this->response->jsonResponse(true, 'All Details Update Failed', $validate , 201);
      }
   }
}