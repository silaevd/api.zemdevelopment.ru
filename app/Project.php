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
     * @return array
     */
    public function getList(): array
    {
        return $this->get()->toArray();
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getById(int $id)
    {
        return self::findOrFail($id)->toArray();
    }

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
        $file = $request->file('cover');
        $path = \public_path('project/'. $projectId . '/cover');
        $newImageName = \md5(\time() . mt_rand(1,10000000)) . '.' . \strtolower($file->getClientOriginalExtension());
        $file->move($path, $path . '/' .$newImageName);
        return 'project/'. $projectId . '/cover/' .$newImageName;
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

        $uploader = new FileUploaderService('images', ['uploadDir' => \public_path('project/' . $projectId . '/images') . DIRECTORY_SEPARATOR, 'editor' => [
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
