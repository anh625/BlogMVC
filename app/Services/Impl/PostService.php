<?php
namespace App\Services\Impl;

use App\Http\Requests\PostRequest;
use App\Mappers\PostDataMapper;
use App\Models\Post;
use App\Repositories\Contracts\IPostRepository;
use App\Repositories\Contracts\IUserRepository;
use App\Repositories\Contracts\ICategoryRepository;
use App\Services\Contracts\IPostService;
use App\Session\UserSession;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class PostService implements IPostService
{
    private IPostRepository $postRepository;
    private ICategoryRepository $categoryRepository;
    //private IUserRepository $userRepository;
    private PostDataMapper $postDataMapper;
    private UserSession $userSession;

    public function __construct(IPostRepository $postRepository,
                                ICategoryRepository $categoryRepository,
                                //IUserRepository $userRepository,
                                PostDataMapper $postDataMapper,
                                UserSession $userSession)
    {
        $this->postRepository = $postRepository;
        $this->categoryRepository = $categoryRepository;
        //->userRepository = $userRepository;
        $this->postDataMapper = $postDataMapper;
        $this->userSession = $userSession;
    }

    public function show() : LengthAwarePaginator{
        return $this->postRepository->show();
    }
    public function showForAdmin() : LengthAwarePaginator{
        return $this->postRepository->showForAdmin();
    }
    public function showById(int $id) : ?array
    {
        $data['post'] = $this->postRepository->getById($id);
        if(empty($data['post'])){
            return $data['post'];
        }
        //dd($this->userSession->getUser());
        $user_id = '';
        if($this->userSession->getUser()){
            $user_id = $this->userSession->getUser()['user_id'];
        }

        if( $user_id != $data['post']->user_id ){
            $this->postRepository->incrementView($id);
        }
        return $data;
    }
    public function getById(int $id) : ?Post
    {
        return $this->postRepository->getById($id);
    }
    public function searchByTitle(string $title) : ?array
    {
        $data['posts'] = $this->postRepository->getByTitle($title);
        return $data;
    }

    public function searchByUserId(string $user_id) : ?array
    {
        $data['posts'] = $this->postRepository->getByUserId($user_id);
        return $data;
    }
    public function searchByCategoryId(int $category_id) : ?array
    {
        try{
            $data['category_name'] = $this->categoryRepository->findById($category_id)->category_name;
        }catch (\Exception $exception){
            $data['category_name'] = "No results found";
        }

        $data['posts'] = $this->postRepository->getByCategoryId($category_id);
        //dd($data);
        return $data;
    }
    public function add(PostRequest $request) : ?Post
    {
        $data = $this->postDataMapper->mapForCreate($request);
        return $this->postRepository->store($data);
    }
    public function edit(int $post_id,PostRequest $request) : ?Post
    {
        $user_id = $this->postRepository->getById($post_id)->user_id;
        if(!$this->userSession->isUserUsing($user_id)){
            return null;
        }
        $data = $this->postDataMapper->mapForEdit($request);
        return $this->postRepository->update($data, $post_id);
    }
    public function destroy(int $post_id) : ?Post
    {
        $user_id = $this->postRepository->getById($post_id)->user_id;
        if(!$this->userSession->isUserUsing($user_id)){
            return null;
        }
        return $this->postRepository->delete($post_id);
    }

    public function getAllCategories() : ?Collection
    {
        return $this->postRepository->getCategoryWithPostCount();
    }
    public function getPopularPosts(int|null $id = null){
        return $this->postRepository->getPopularPosts($id);
    }

public function updateStatus(string $status, int $postId ): bool
{
    $result = $this->postRepository->update(["post_status" => $status], $postId);
    return $result !== null;
}


}
