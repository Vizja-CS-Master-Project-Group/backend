<?php

namespace App\Http\Resources;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

/**
 * @mixin Book
 */
class BookResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        /** @var Media $cover */
        $cover = $this->getFirstMedia('cover');

        return [
            'id' => $this->id,
            'name' => $this->name,
            'language' => $this->language,
            'subject' => $this->subject,
            'page_count' => $this->page_count,
            'original' => !!$this->original,
            'allow_loan' => !!$this->barrowable,
            'cover' => $cover->getFullUrl()
        ];
    }
}
