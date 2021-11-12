<?php

namespace App\Repository\Interfaces;

interface FileInterface
{
    public function createFile($requestData);
    public function getFileData($condition);
    public function updateFile($requestData, $fileData);
    public function deleteFile($whereCondition);
}
