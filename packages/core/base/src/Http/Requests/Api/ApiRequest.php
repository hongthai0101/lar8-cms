<?php
namespace Messi\Base\Http\Requests\Api;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Arr;

class ApiRequest extends FormRequest
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
     * @param Validator $validator
     * @return void
     */
    protected function failedValidation(Validator $validator)
    {
        $failed = $validator->failed();
        $field = array_key_first($failed);
        $errorCode = $this->errorCode();
        $keyValidate = strtolower(array_key_first(Arr::get($failed, $field)));
        throw new HttpResponseException(response([
            'errorCode' => Arr::get($errorCode, $field . '.' . $keyValidate, 9999)
        ]));
    }

    /**
     * @return array
     */
    private function errorCode(): array
    {
        return [
            'email' => [
                'unique' => 1000,
                'email' => 1001
            ],
            'password' => [
                'required' => 1002,
                'min' => 1003
            ],
        ];
    }
}
