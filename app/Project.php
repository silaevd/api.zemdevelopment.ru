<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Symfony\Component\HttpFoundation\Request;

/**
 * @property \Carbon\Carbon $created_at
 * @property int $id
 * @property \Carbon\Carbon $updated_at
 */
class Project extends Model
{
    protected $guarded = [];

    public function store(Request $request)
    {
        $title = $request->request->get('title');
        $slug = $request->request->get('slug');
        $area = $request->request->get('area');
        $size = $request->request->get('size');
        $price = $request->request->get('price');
        $deadline = $request->request->get('deadline');
        $videoLink = $request->request->get('videoLink');
        $cover = $request->request->get('cover', '');
        $images = $request->request->get('images', []);
        $isPopular = $request->request->getBoolean('isPopular');
        $isActive = $request->request->getBoolean('isActive');

        return self::create([
            'title' => $title,
            'slug' => $slug,
            'area' => $area,
            'size' => $size,
            'price' => $price,
            'deadline' => $deadline,
            'videoLink' => !empty($videoLink) ? \implode('|', $videoLink) : '',
            'cover' => $cover,
            'images' => !empty($images) ? \implode('|', $images) : '',
            'isPopular' => $isPopular,
            'isActive' => $isActive,
        ]);
    }
}
