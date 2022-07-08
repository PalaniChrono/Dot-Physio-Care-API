<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Models\Testimony;
use App\Repositories\ResponseRepository;

class TestimonyController extends Controller

{
    public function __construct(ResponseRepository $response)
    {
        $this->response = $response;
        $this->storeRules = [
            'author'=> 'required',
            // 'testimony_header' => 'required',
            'testimony_description' => 'required',
        ];
    
      
    }
    public function findBanner($id) {
        return Testimony::find($id);
    }

    public function index()
    {

        $data = Testimony::where('active_status', 1)->get();
        return $this->response->jsonResponse(false,"Testimony Details Fetched Successfully", $data, 200);
        
    }

    public function getAllTestimony(){
        return $this->response->jsonResponse(false, $this->response->message('testimony', 'index'), Testimony::orderBy('id', 'desc')->get(), 200);

    }

    public function store(Request $request)
    {
        $validate = $this->response->validate($request->all(), $this->storeRules);
        if($validate === true) {
            return $this->response->jsonResponse(false, $this->response->message('testimony', 'store'), Testimony::create($request->all()), 200);
        } else {
            return $validate;
        }
    }

    public function show($id)
    {
        return $this->response->jsonResponse(false, $this->response->message('testimony', 'show'), $this->findBanner($id), 200);
    }

    public function update(Request $request, $id)
    {
        $validate = $this->response->validate($request->all(), [
            'author' => ['required'],
            'testimony_description' => ['required'],
        ]);
        if($validate === true) {
            return $this->response->jsonResponse(false, $this->response->message('testimony', 'update'), $this->findBanner($id)->update($request->all()), 200);
        } else {
            return $validate;
        }
    }

    public function destroy($id)
    {
        $size = $this->findBanner($id);
        if($size) {
            return $this->response->jsonResponse(false, $this->response->message('testimony', 'destroy'), $size->delete(), 200);
        }
        return $this->response->jsonResponse(true, 'Testimony Not Exists',[], 201);
    }

    public function TestimonySwitch($id) {
        $size = $this->findBanner($id);
        if($size) {
            $value = $size->active_status === 1 ? 0 : 1;
            $msg = $value === 0 ? 'Deactivated': 'Activated';
            return $this->response->jsonResponse(false, 'testimony '.$msg.' SuccessFully', $size->update(['active_status' => $value]), 200);
        }
        return $this->response->jsonResponse(true, 'Testimony Not Exists',[], 201);
    }

    

    //image update for category
    public function imageUpdateTestimonyLab(Request $request)
    {
        $getBanner = $this->findBanner($request['banner_id']);
        if($request->hasFile('banner_image')) {
            $file = $request->file('banner_image');
            $name = $this->response->generateSlug($getBanner['header']);
            $uploadUrl = $this->response->cloudinaryImage($request->file('banner_image'), 'TestimonyLab', $name);
            return $this->response->jsonResponse(false, $this->response->message('TestimonyLab', 'image'), $getBanner->update(['testimony_image' => $uploadUrl]), 201);
        } else {
            return $this->response->jsonResponse(true, 'Image Banner is too high', [], 201);
        }
    }
}
