<?php

namespace App\Repository\Repos;

use App\Models\File;
use App\Repository\Interfaces\FileInterface;

class FileRepo implements FileInterface
{

    public function createFile($requestData)
    {
        return File::create($requestData);
    }

    public function getFileData($condition){
        return File::where($condition)->first();
    }

    public function updateFile($requestData, $fileData){
        return $fileData->update($requestData);
    }

    public function deleteFile($whereCondition)
    {
        return File::where($whereCondition)->delete();
    }
}
