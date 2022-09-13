<?php

namespace App\Http\Requests;

use Seblhaire\Uploader\FileuploadRequest;

class Fileupload2Request extends FileuploadRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return array_merge(parent::rules(), [
          'article_title' => "required|string",
          'article_id' => "required|numeric"
        ]);
    }
}