<?php
namespace Messi\Base\Http\Requests\Api;

class AuthRequest extends ApiRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        $routeName = $this->route()->getName();
        if ($routeName === 'api.auth.login') {
            return $this->loginRules();
        }

        if ($routeName === 'api.auth.register') {
            return $this->registerRules();
        }

        if ($routeName === 'api.auth.logout') {
            return $this->logoutRules();
        }

        return [];
    }

    /**
     * @return array
     */
    private function loginRules() : array
    {
        return [
            'email' => 'required|email',
            'password' => 'required|min:6'
        ];
    }

    /**
     * @return array
     */
    private function registerRules() : array
    {
        return [
            'name' => 'required|string|between:2,100',
            'email' => 'required|string|email|max:100|unique:users',
            'password' => 'required|string|confirmed|min:6',
            'phone' => 'nullable|string|max:15|unique:users'
        ];
    }

    /**
     * @return array
     */
    private function logoutRules(): array
    {
        return [
            'token' => 'required'
        ];
    }
}
