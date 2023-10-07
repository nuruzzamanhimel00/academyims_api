<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PartnersInfoRequest;
use App\Http\Resources\PartnersInfoResource;
use App\Models\PartnersInfo;
use App\Services\PartnersInfos\PartnersInfoService;
use App\Traits\BaseTrait;
use Illuminate\Http\Request;

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
        // dd($data);
        try {
            // $created = PartnersInfo::create($data);
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
