<?php
namespace Messi\Blog\Services\Admin;

use Messi\Blog\Http\Requests\Admin\PostRequest;
use Messi\Blog\Models\Post;
use Messi\Blog\Repositories\Contracts\PostRepository;

class PostService
{
    /**
     * @param PostRequest $request
     * @param PostRepository $repository
     */
    public function store(PostRequest $request, PostRepository $repository)
    {
        $post = $repository->create($request->validated());
        $this->syncData($post, $request);
    }

    /**
     * @param $id
     * @param PostRequest $request
     * @param PostRepository $repository
     */
    public function update($id, PostRequest $request, PostRepository $repository)
    {
        $repository->update($request->validated(), $id);
        $this->syncData($repository->findOrFail($id), $request);
    }

    /**
     * @param Post $post
     * @param PostRequest $request
     */
    private function syncData(Post $post, PostRequest $request)
    {
        if ($categories = $request->categories) {
            $post->categories()->sync($categories);
        }

        if ($tags = $request->tags) {
            $post->tags()->sync($tags);
        }
    }
}
