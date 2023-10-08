<?php
namespace App\Services\Subscription;

use App\Models\SubscriptionForm;
use App\Services\BaseService;
use App\Services\Utils\FileUploadService;
use App\Utils\GlobalConstant;

class SubscriptionService extends BaseService{

    protected $fileUploadService;

    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
        $model = new SubscriptionForm();
        parent::__construct($model);
        $this->fileUploadService = app(FileUploadService::class);
    }

    public function createOrUpdate(array $data, $id = null)
    {
        try {
            if ($id) {
                $object = $this->model->findOrFail($id);
                $delete_path =  GlobalConstant::PARTNERS_IMAGE_PATH."/".$object->signature;
                if(!is_null($data['signature'])){
                    $data['signature'] = $this->fileUploadService->uploadBase64File($data['signature'], GlobalConstant::PARTNERS_IMAGE_PATH, null, $delete_path
                    ,  300,  150,  GlobalConstant::IMAGE_RESIZE);
                }else{
                    unset($data['signature']);
                }

                // dd($data);
                return $object->updateOrCreate([
                    'id' => $id
                ],$data);
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
