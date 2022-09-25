<?php
namespace Messi\Base\Http\Controllers\Auth;


use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
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
    private UserRepository $repository;

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
     * @return Factory|View
     */
    public function profile(Request $request): Factory|View
    {
        $item = $request->user();
        return view('core/base::auth.profile', compact('item'));
    }

    /**
     * Auth change profile
     *
     * @param ProfileRequest $request
     * @return RedirectResponse
     */
    public function changeProfile(ProfileRequest $request): RedirectResponse
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
     * @return RedirectResponse
     */
    public function password(PasswordRequest $request): RedirectResponse
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
     * @return JsonResponse
     */
    public function avatar(Request $request, ImageService $imageService): JsonResponse
    {
        $filename = $imageService->base64($request->image, 'uploads/avatar/');
        if ($filename){
            $this->repository->update(['avatar' => $filename], $request->user()->id);
            return response()->json(
                [
                    'data' => Storage::url($filename),
                    'code' => 200
                ],
                200);
        }
        return response()->json(['code' => 201], 200);
    }

    /**
     * @param Request $request
     * @return RedirectResponse|Redirector
     */
    public function logout(Request $request): Redirector|RedirectResponse
    {
        auth()->logout();
        $request->session()->invalidate();
        return redirect(route('admin.auth.login'));
    }
}
