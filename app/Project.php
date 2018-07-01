<?php

namespace App;

use FileUploader\Services\FileUploaderService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;
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
        $description = $request->request->get('description');
        $videoLink = $request->request->get('videoLink');
        $isPopular = $request->request->getBoolean('isPopular');
        $isActive = $request->request->getBoolean('isActive');
        $projectId = $request->request->getInt('id');

        if (empty($projectId)) {
            $newEntry = new self();
        } else {
            $newEntry = self::findOrFail($projectId);
        }
        $newEntry->title     = $title;
        $newEntry->slug      = $slug;
        $newEntry->area      = $area;
        $newEntry->size      = $size;
        $newEntry->price     = $price;
        $newEntry->deadline  = $deadline;
        $newEntry->description  = $description;
        $newEntry->videoLink = $this->getVideoLinks($videoLink);
        $newEntry->isPopular = $isPopular;
        $newEntry->isActive  = $isActive;

        $newEntry->save();

        $cover = $this->coverUpload($newEntry->id, $request);
        if ($cover) {
            $newEntry->cover = $cover;
        }
        $images = $this->addImagesWithFileUploader($newEntry, $request);
        if ($images) {
            $newEntry->images = \implode(',', $images);
        }

        return $newEntry->save();
    }

    /**
     * @param Project $project
     * @param Request $request
     *
     * @return array|null
     */
    public function addImagesWithFileUploader(Project $project, Request $request): ?array
    {
        if (empty($request->request->get('fileuploader-list-images'))) {
            return null;
        }

        $imgPath = \public_path('project/' . $project->id . '/images');
        if (!File::exists($imgPath)) {
            File::makeDirectory($imgPath, 0777, true);
        }

        $uploader = new FileUploaderService('images', ['uploadDir' => $imgPath . DIRECTORY_SEPARATOR, 'editor' => [
            'maxWidth'  => 1280,
            'maxHeight' => 720,
            'quality'   => 75,
        ]]);
        $res = [];
        $uploader->upload();
        $files = $uploader->getFileList();

        foreach ($files as $key => $file) {
            $res[] = $file['file'];
        }

        if (isset($project->images)) {
            \array_push($res, $project->images);
        }

        return $res;
    }

    /**
     * @param int    $id
     * @param string $image
     *
     * @return bool
     * @throws \Exception
     */
    public function removeImage(int $id, string $image): bool
    {
        $project = self::findOrFail($id);
        if (empty($project)) {
            throw new \Exception('project not found');
        }
        if (empty($project['images'])) {
            throw new \Exception('nothing to remove');
        }
        $images = \explode(',', $project->images);
        foreach ($images as $key => $imageDb) {
            if ($image === $imageDb) {
                unset($images[$key]);
                File::delete(\public_path($image));
            }
        }
        $project->images = \implode(',', $images);
        return $project->save();
    }

    /**
     * @param int $id
     *
     * @return bool
     */
    public function disableProject(int $id): bool
    {
        $project = self::findOrFail($id);
        $project->isActive = false;
        return $project->save();
    }

    /**
     * @param int $id
     *
     * @return bool
     */
    public function coverRemove(int $id): bool
    {
        $project = self::findOrFail($id);
        $project->cover = null;
        return $project->save();
    }

    /**
     * @param int $id
     *
     * @return bool
     */
    public function enableProject(int $id): bool
    {
        $project = self::findOrFail($id);
        $project->isActive = true;
        return $project->save();
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
     * @param array|null $videoLinks
     * @return string
     */
    public function getVideoLinks(?array $videoLinks): ?string
    {
        if (empty($videoLinks)) {
            return null;
        }
        $res = [];
        foreach ($videoLinks as $videoLink) {
            if (empty($videoLink)) {
                continue;
            }
            $res[] = $videoLink;
        }
        return \implode(',', $res);
    }
}
