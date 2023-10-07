<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PartnersInfoRequest;
use App\Http\Resources\PartnersInfoResource;
use App\Models\PartnersInfo;
use App\Services\PartnersInfos\PartnersInfoService;
use App\Traits\BaseTrait;
use App\Utils\GlobalConstant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PartnersInfoController extends Controller
{
    use BaseTrait;
    protected $partnersInfoService;
    public function __construct()
    {
        $this->partnersInfoService = resolve(PartnersInfoService::class);
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
        $parnerInfos = PartnersInfo::query()
        ->when(!is_null($select), function($query) use($select){
            $query->select($select);
        })
        ->paginate($request->per_page ?? 30);
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
            return $this->sendError('error.', ['error'=>$th->getMessage()]);
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
            return $this->sendError('error.', ['error'=>$th->getMessage()]);
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
