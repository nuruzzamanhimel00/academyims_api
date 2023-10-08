<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PartnersInfoRequest;
use App\Http\Resources\PartnersInfoResource;
use App\Models\PartnersInfo;
use App\Services\PartnersInfos\PartnersInfoService;
use App\Services\Utils\FileUploadService;
use App\Traits\BaseTrait;
use App\Utils\GlobalConstant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PartnersInfoController extends Controller
{
    use BaseTrait;
    protected $partnersInfoService;
    protected $fileUploadService;
    public function __construct()
    {
        $this->partnersInfoService = resolve(PartnersInfoService::class);
        $this->fileUploadService = app(FileUploadService::class);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function getPartnersInfo(Request $request){
        $select = $request->select;
        $get_type = $request->get_type;

        $parnerInfos = PartnersInfo::query()
        ->when(!is_null($select), function($query) use($select){
            $query->select($select);
        });

        if(isset($get_type)){
            if($get_type == 'paginate'){
                $parnerInfos = $parnerInfos->paginate($request->per_page ?? 30);

            }else{
                $parnerInfos =  $parnerInfos->get();
            }
        }else{
            $parnerInfos =  $parnerInfos->get();
        }

        // ->when(!isset($get_type), function($query) use($request){
        //     $query->paginate($request->per_page ?? 30);
        // });

        return PartnersInfoResource::collection($parnerInfos);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PartnersInfoRequest $request)
    {
        $data = $request->validated();

        try {
            $created = $this->partnersInfoService->createOrUpdate($data);
            return $this->sendResponse( new PartnersInfoResource($created), 'Partner Infos Created');
        } catch (\Exception $th) {
            return $this->sendError('error', ['error'=>$th->getMessage()]);
        }


    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PartnersInfoRequest $request, string $id)
    {
        $data = $request->validated();

        try {
            $created = $this->partnersInfoService->createOrUpdate($data, $id);
            return $this->sendResponse( new PartnersInfoResource($created), 'Partner Infos Updated');
        } catch (\Exception $th) {
            return $this->sendError('error', ['error'=>$th->getMessage()]);
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $object = $this->partnersInfoService->get($id);
        try {
            if(!is_null($object)){
                $delete_path =  GlobalConstant::PARTNERS_IMAGE_PATH."/".$object->signature;
                $this->fileUploadService->delete($delete_path);
                if($object->delete()){
                    return $this->sendResponse( null, 'Partner Deleted Successfully.');
                }
            }
        } catch (\Exception $th) {
            return $this->sendError('error', ['error'=>$th->getMessage()]);
        }


    }
}
