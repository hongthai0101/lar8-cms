<?php
namespace Messi\Base\Http\Controllers\Auth;


use Illuminate\Http\Request;
use Messi\Base\Http\Controllers\BaseController;
use Messi\Base\Http\Requests\Auth\PasswordRequest;
use Messi\Base\Http\Requests\Auth\ProfileRequest;
use Messi\Base\Repositories\Contracts\UserRepository;
use Messi\Base\Services\ImageService;

class AuthController extends BaseController
{
    /**
     * @var UserRepository
     */
    private $repository;

    /**
     * UserController constructor.
     * @param UserRepository $repository
     */
    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }
    /**
     * Show profile use login
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function profile(Request $request)
    {
        $item = $request->user();
        return view('core/base::auth.profile', compact('item'));
    }

    /**
     * Auth change profile
     *
     * @param ProfileRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function changeProfile(ProfileRequest $request)
    {
        $data = $request->validated();
        if ($this->repository->update($data, $request->user()->id)){
            return $this->redirect(route('admin.auth.profile'));
        }
        return $this->redirect(route('admin.auth.profile'));
    }

    /**
     * Auth change password
     *
     * @param PasswordRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function password(PasswordRequest $request)
    {
        $data = $request->only('password');
        if ($this->repository->update($data, $request->user()->id)){
            return $this->redirect(route('admin.auth.profile'));
        }
        return $this->redirect(route('admin.auth.profile'));
    }

    /**
     * Auth change avatar
     *
     * @param Request $request
     * @param ImageService $imageService
     * @return \Illuminate\Http\JsonResponse
     */
    public function avatar(Request $request, ImageService $imageService)
    {
        $filename = $imageService->base64($request->image, 'uploads/avatar/');
        if ($filename){
            $filename = '/' . $filename;
            $this->repository->update(['avatar' => $filename], $request->user()->id);
            return response()->json(
                [
                    'data' => $filename,
                    'code' => 200
                ],
                200);
        }
        return response()->json(['code' => 201], 200);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function logout(Request $request)
    {
        auth()->logout();
        $request->session()->invalidate();
        return redirect(route('admin.auth.login'));
    }
}