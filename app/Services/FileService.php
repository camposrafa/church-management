<?php

namespace App\Services;

use App\Models\File;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Image;
use Symfony\Component\Mime\MimeTypes;

class FileService
{

    /**
     * @param UploadedFile $file
     * @param $description
     * @return File $file
     */
    public function store(UploadedFile $file, $prefix, $description): File
    {
        return File::create([
            'description' => $description,
            'path' => $file->store($prefix),
            'type' => $file->getMimeType(),
        ]);
    }

    /**
     * Return a photo thumbnail
     *
     * @param File $file
     * @param integer $minPixel
     * @param float $resizable
     * @return File
     */
    public function thumbnail(File $file, $thumb_path = 'thumbnail', int $minPixel = 32, float $resizable = null): File
    {
        if (in_array($file->type, MimeTypes::getDefault()->getMimeTypes('svg'))) {
            return $file;
        }

        $original_path = Storage::disk()->path($file->path);
        $path = pathinfo($original_path);
        $tmp_path = $path['dirname'] . '/tmp_' . $path['basename'];

        $image = Image::make($original_path);

        $height = $image->getHeight();
        $width = $image->getWidth();

        $resizable = $resizable ?? $this->resizable($height, $width, $minPixel);

        if ($resizable === false) {
            return $file;
        }

        $image->resize(
            floor($height - $height * $resizable),
            floor($width - $width * $resizable),
            function ($constraint) {
                $constraint->aspectRatio();
            }
        );

        $image->save($tmp_path);

        $uploadedFile = new UploadedFile($tmp_path, $image->filename, $image->mime);

        $thumb = $this->store($uploadedFile, $thumb_path, $file->description . " - Thumbnail");

        \Illuminate\Support\Facades\File::delete($tmp_path);

        return $thumb;
    }

    /**
     * Calculate resizible percent of a height and width, by a minimum pixel
     *
     * @param integer $height
     * @param integer $width
     * @param integer $minPixel
     * @return float|bool
     */
    public function resizable(int $height, int $width, int $minPixel)
    {
        if ($height <= $minPixel || $width <= $minPixel) {
            return false;
        }

        $minSize = min($height, $width);

        return ($minSize - $minPixel) / $minSize;
    }
}
