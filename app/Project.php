<?php

namespace App;

use FileUploader\Services\FileUploaderService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

/**
 * @property \Carbon\Carbon $created_at
 * @property int $id
 * @property \Carbon\Carbon $updated_at
 */
class Project extends Model
{
    /**
     * @var array
     */
    protected $guarded = [];

    /**
     * @param Request $request
     *
     * @return bool
     */
    public function store(Request $request): bool
    {
        $title = $request->request->get('title');
        $slug = $request->request->get('slug');
        $area = $request->request->get('area');
        $size = $request->request->get('size');
        $price = $request->request->get('price');
        $deadline = $request->request->get('deadline');
        $videoLink = $request->request->get('videoLink');
        $isPopular = $request->request->getBoolean('isPopular');
        $isActive = $request->request->getBoolean('isActive');

        $newEntry = new self();
        $newEntry->title     = $title;
        $newEntry->slug      = $slug;
        $newEntry->area      = $area;
        $newEntry->size      = $size;
        $newEntry->price     = $price;
        $newEntry->deadline  = $deadline;
        $newEntry->cover     = null;
        $newEntry->videoLink = $videoLink ? \implode(',', $videoLink) : null;
        $newEntry->images    = null;
        $newEntry->isPopular = $isPopular;
        $newEntry->isActive  = $isActive;

        $newEntry->save();

        $cover = $this->coverUpload($newEntry->id, $request);
        if ($cover) {
            $newEntry->cover = $cover;
        }
        $images = $this->addImagesWithFileUploader($newEntry->id, $request);
        if ($images) {
            $newEntry->images = \implode(',', $images);
        }

        return $newEntry->save();
    }

    /**
     * @param int     $projectId
     * @param Request $request
     *
     * @return string|null
     */
    private function coverUpload(int $projectId, Request $request): ?string
    {
        if (empty($request->file('cover'))) {
            return null;
        }
        Storage::makeDirectory('projects/' . $projectId . '/cover');
        $path = $request->file('cover')->store('projects/' . $projectId . '/cover');
        return $path;
    }

    /**
     * @param int     $projectId
     * @param Request $request
     *
     * @return array|null
     */
    public function addImagesWithFileUploader(int $projectId, Request $request): ?array
    {
        if ($request->request->get('fileuploader-list-images')) {
            return null;
        }

        $uploader = new FileUploaderService('images', ['uploadDir' => storage_path('projects/' . $projectId . '/images') . DIRECTORY_SEPARATOR, 'editor' => [
            'maxWidth'  => 1024,
            'maxHeight' => 1024,
            'quality'   => 75,
        ]]);
        $res = [];
        $uploader->upload();
        $files = $uploader->getFileList();
        foreach ($files as $key => $file) {
            $res[] = $file['name'];
        }
        return $res;
    }
}
