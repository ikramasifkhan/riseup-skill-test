<?php

namespace App\Service;
use App\Repository\Interfaces\FileInterface;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class FileUploadService
{
    protected $file;
    public function __construct(FileInterface $file)
    {
        $this->file = $file;
    }
    public function addFile($storageFolder, $postId){
        try {
            $fileName = time() . Str::random(8) . '.' . request()->thumbnail->extension();
            request()->thumbnail->move(storage_path('app/public/' . $storageFolder), $fileName);

            return $this->file->createFile([
                'post_id'=>$postId,
                'file_name' => $fileName,
                'file_path' => $storageFolder.'/'.$fileName,
            ]);
        } catch (\Exception $exception) {
            Log::info($exception->getMessage());
        }
    }

    public function updateFile($fileData, $storageFolder)
    {
        $filePath = storage_path('app/public/' . $storageFolder . '/' . $fileData->file_name);
        if (file_exists($filePath)) {
            unlink($filePath);
            try {
                $fileName = time() . Str::random(8) . '.' . request()->thumbnail->extension();
                request()->thumbnail->move(storage_path('app/public/' . $storageFolder), $fileName);

                $this->file->updateFile([
                    'file_name' => $fileName,
                    'file_path' => $storageFolder.'/'.$fileName,
                ], $fileData);
            } catch (\Exception $exception) {
                Log::info($exception->getMessage());
            }
        }
    }
}
