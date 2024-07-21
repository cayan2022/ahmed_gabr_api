<?php

namespace App\Http\Controllers\Api\Dashboard;

use App\Helpers\Traits\RespondsWithHttpStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Dashboard\StoreGalleryRequest;
use App\Http\Requests\Api\Dashboard\UpdateGalleryRequest;
use App\Http\Resources\GalleryResource;
use App\Models\Gallery;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class GalleryController extends Controller
{
    use RespondsWithHttpStatus;
    public function index()
    {
        return GalleryResource::collection(Gallery::filter()->latest()->paginate());
    }

    public function store(StoreGalleryRequest $request)
    {
        $gallery = Gallery::create($request->validated());
        if ($request->hasFile('media') && $request->file('media')->isValid()) {
            $gallery->addMultipleMediaFromRequest(['media'])
                ->each(function ($fileAdder) {
                    $fileAdder->sanitizingFileName(fn($fileName) => updateFileName($fileName))
                        ->toMediaCollection(Gallery::MEDIA_COLLECTION_NAME);
                });
        }

        if ($request->hasFile('cover') && $request->file('cover')->isValid()) {
            $gallery->addMultipleMediaFromRequest(['cover'])
                ->each(function ($fileAdder) {
                    $fileAdder->sanitizingFileName(fn($fileName) => updateFileName($fileName))
                        ->toMediaCollection(Gallery::MEDIA_COLLECTION_NAME_COVER);
                });
        }
        return $gallery->getResource();

    }

    public function show(Gallery $gallery)
    {
        return $gallery->getResource();
    }

    public function update(UpdateGalleryRequest $request, Gallery $gallery)
    {
        $gallery->update($request->validated());

        if ($request->hasFile('media') && $request->file('media')->isValid()) {
            $gallery->clearMediaCollection(Gallery::MEDIA_COLLECTION_NAME);
            $gallery->addMultipleMediaFromRequest(['media'])
                ->each(function ($fileAdder) {
                    $fileAdder->sanitizingFileName(fn($fileName) => updateFileName($fileName))
                        ->toMediaCollection(Gallery::MEDIA_COLLECTION_NAME);
                });
        }

        if ($request->hasFile('cover') && $request->file('cover')->isValid()) {
            $gallery->clearMediaCollection(Gallery::MEDIA_COLLECTION_NAME_COVER);
            $gallery->addMultipleMediaFromRequest(['media'])
                ->each(function ($fileAdder) {
                    $fileAdder->sanitizingFileName(fn($fileName) => updateFileName($fileName))
                        ->toMediaCollection(Gallery::MEDIA_COLLECTION_NAME_COVER);
                });
        }

        return $gallery->getResource();

    }

    public function destroy(Gallery $gallery)
    {
        $gallery->delete();
        return $this->success(__('auth.success_operation'));
    }

    public function block(Gallery $gallery)
    {
        $gallery->block();
        return $this->success(__('auth.success_operation'));
    }

    public function active(Gallery $gallery)
    {
        $gallery->active();
        return $this->success(__('auth.success_operation'));
    }


    public function deleteMedia($id)
    {
        \DB::table('media')->where('id', $id)->delete();
        return $this->success(__('auth.success_operation'));
    }
}
