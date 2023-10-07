<?php
namespace App\Services\PartnersInfos;

use App\Models\PartnersInfo;
use App\Services\BaseService;
use App\Services\Utils\FileUploadService;
use App\Utils\GlobalConstant;

class PartnersInfoService extends BaseService{

    protected $fileUploadService;

    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
        $model = new PartnersInfo();
        parent::__construct($model);
        $this->fileUploadService = app(FileUploadService::class);
    }

    public function createOrUpdate(array $data, $id = null)
    {
        try {
            if ($id) {

                return $this->model->findOrFail($id)->update($data);
            } else {

                $data['signature'] = $this->fileUploadService->uploadBase64File($data['signature'], GlobalConstant::PARTNERS_IMAGE_PATH, null,null
                ,  300,  150,  GlobalConstant::IMAGE_RESIZE);
                return $this->model::create($data);
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
