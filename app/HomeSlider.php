<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class HomeSlider
 * @package App
 */
class HomeSlider extends Model
{
    /**
     * @return array|null
     */
    public function getList(): ?array
    {
        return self::all()->toArray() ?? null;
    }

    /**
     * @param Request $request
     * @return bool
     */
    public function upload(Request $request)
    {
        $files  = $request->files->get('images');
        if (empty($files)) {
            return false;
        }

        foreach ($files as $file) {
            $obj = new self();
            $obj->file_name = $this->getFileName($file);
            $obj->is_active = true;
            $obj->save();
        }
        return true;
    }

    /**
     * @param int $id
     * @return bool
     */
    public function removeById(int $id): bool
    {
        $item = $this->getItem($id);
        if (empty($item)) {
            return false;
        }
        return $item->delete();
    }

    /**
     * @param int|null $id
     * @return null
     */
    private function getItem(?int $id)
    {
        if (empty($id)) {
            return null;
        }
        return self::find($id);
    }

    /**
     * @param UploadedFile $file
     * @return null|string
     */
    private function getFileName(UploadedFile $file): ?string
    {
        if (empty($file)) {
            return null;
        }
        $path = \public_path('slider');
        $newImageName = \md5(\time() . mt_rand(1,10000000)) . '.' . \strtolower($file->getClientOriginalExtension());
        $file->move($path, $path . '/' .$newImageName);
        return 'slider/' . $newImageName;
    }
}
