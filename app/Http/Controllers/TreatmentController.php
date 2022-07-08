<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Treatment;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use App\Repositories\ResponseRepository;


class TreatmentController extends Controller
{
    public function __construct(ResponseRepository $response)
    {
        $this->response = $response;
        $this->storeRules = [
            'header' => 'required',
        ];
    
      
    }
    public function findBanner($id) {
        return Treatment::find($id);
    }

    public function index()
    {

        $data = Treatment::where('active_status', 1)->get();
        return $this->response->jsonResponse(false,"treatment Details Fetched Successfully", $data, 200);
        
    }

    public function getAllTreatment(){
        return $this->response->jsonResponse(false, $this->response->message('treatment', 'index'), Treatment::orderBy('id', 'desc')->get(), 200);

    }

    public function store(Request $request)
    {
        $validate = $this->response->validate($request->all(), $this->storeRules);
        if($validate === true) {
            return $this->response->jsonResponse(false, $this->response->message('treatment', 'store'), Treatment::create($request->all()), 200);
        } else {
            return $validate;
        }
    }

    public function show($id)
    {
        return $this->response->jsonResponse(false, $this->response->message('treatment', 'show'), $this->findBanner($id), 200);
    }

    public function update(Request $request, $id)
    {
        $validate = $this->response->validate($request->all(), [
            'header' => [
                'required'
            ],
        ]);
        if($validate === true) {
            return $this->response->jsonResponse(false, $this->response->message('treatment', 'update'), $this->findBanner($id)->update($request->all()), 200);
        } else {
            return $validate;
        }
    }

    public function destroy($id)
    {
        $size = $this->findBanner($id);
        if($size) {
            return $this->response->jsonResponse(false, $this->response->message('treatment', 'destroy'), $size->delete(), 200);
        }
        return $this->response->jsonResponse(true, 'treatment Not Exists',[], 201);
    }

    public function treatmentSwitch($id) {
        $size = $this->findBanner($id);
        if($size) {
            $value = $size->active_status === 1 ? 0 : 1;
            $msg = $value === 0 ? 'Deactivated': 'Activated';
            return $this->response->jsonResponse(false, 'treatment '.$msg.' SuccessFully', $size->update(['active_status' => $value]), 200);
        }
        return $this->response->jsonResponse(true, 'treatment Not Exists',[], 201);
    }

    

    //image update for 
 
    public function imageUpdateTreatment(Request $request)
    {
        $getBanner = $this->findBanner($request['banner_id']);
        if($request->hasFile('banner_image')) {
            $file = $request->file('banner_image');
            $name = $this->response->generateSlug($getBanner['header']);
            $uploadUrl = $this->response->cloudinaryImage($request->file('banner_image'), 'treatment', $name);
            return $this->response->jsonResponse(false, $this->response->message('treatment', 'image'), $getBanner->update(['logo' => $uploadUrl]), 201);
        } else {
            return $this->response->jsonResponse(true, 'Image Banner is too high', [], 201);
        }
    }
}
