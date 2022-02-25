<?php

declare(strict_types=1);

namespace App\Http\Requests\Admin;

use App\Models\Post;
use App\Services\TranslatableFormRequestRules;
use Illuminate\Foundation\Http\FormRequest as BaseRequest;

class PostRequest extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return TranslatableFormRequestRules::make(Post::class, [
            'title'               => ['required', 'string', 'max:200'],
            'slug'                => ['required', 'string', 'max:200'],
            'description'         => ['required', 'string'],
            'published_at'        => ['nullable', 'date'],
            'categories'          => ['array'],
            'categories.*'        => ['required', 'exists:post_categories,id'],
            'media'               => ['array'],
            'media.*.id'          => ['required', 'exists:media'],
            'blocks'              => ['array'],
            'blocks.*.id'         => ['required', 'numeric', 'integer'],
            'blocks.*.type'       => ['required', 'string'],
            'blocks.*.content'    => ['required', 'array'],
            'blocks.*.children'   => ['array'],
            'blocks.*.media'      => ['array'],
            'blocks.*.media.*.id' => ['required', 'exists:media'],
        ]);
    }
}