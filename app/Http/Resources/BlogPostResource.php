<?php

namespace App\Http\Resources;

use App\Models\Author;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class BlogPostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $name = $this->author_id;
        if (isset($name) && is_numeric($name))
            $name = Author::find($this->author_id)->name;

        // return parent::toArray($request);
        return [
            'key' => $this->id,
            'owner' => $name,
            'title' => $this->title,
            'body' => $this->content,
        ];
    }
}


//            $author = Author::find($this->id);
//            if(!$author) {
//                $name = 'Author is unknown';
//            } else {
//                $name = $author->name;
//            }
