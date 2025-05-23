<?php
namespace App\Repositories\Impl;

use App\Models\Post;
use App\Repositories\Contracts\IPostRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class PostRepository extends BaseRepository implements IPostRepository
{
    private int $perPage;
    protected string $primaryKey = 'post_id';
    public function __construct()
    {
        $this->perPage = config('pagination.per_page');
        // Gọi constructor của BaseRepository và truyền vào model User
        parent::__construct(new Post());
    }
    public function getById(int|string $id): Post
    {
        return Post::with(['category', 'user', 'comments.user'])
            ->where('post_id', $id)
            ->where('post_status', true)
            ->whereHas('user', function ($query) {
                $query->where('is_active', true);
            })->firstOrFail();
    }
    public function show(): LengthAwarePaginator
    {
        return Post::with('category')
            ->where('post_status', true)
            ->whereHas('user', function ($query) {
                $query->where('is_active', true);
            })
            ->paginate($this->perPage);
    }

    public function showForAdmin(): LengthAwarePaginator
    {
        return Post::with('category')->paginate($this->perPage);
    }


    public function getByTitle(string $title): ?LengthAwarePaginator
    {
        return Post::where('title', 'like', '%' . $title . '%')
            ->where('post_status', true)
            ->whereHas('user', function ($query) {
                $query->where('is_active', true);
            })->paginate($this->perPage);
    }

    public function getByUserId(string $user_id): ?LengthAwarePaginator
    {
        return Post::where('user_id', $user_id)
            ->whereHas('user', function ($query) {
                $query->where('is_active', true);
            })->paginate($this->perPage);
    }

    public function getByCategoryId(int $category_id): ?LengthAwarePaginator
    {
        return Post::where('category_id', $category_id)
            ->whereHas('user', function ($query) {
                $query->where('is_active', true);
            })->where('post_status', true)->paginate($this->perPage);
    }

    public function getCategoryWithPostCount(): ?Collection
    {
        //dd($post);
        return Post::rightJoin('categories', 'posts.category_id', '=', 'categories.category_id') // sử dụng right join
        ->leftJoin('users', 'posts.user_id', '=', 'users.user_id')
        ->select('categories.category_id',
            'categories.category_name',
            DB::raw("COUNT(CASE
                WHEN posts.post_status = 1 AND users.is_active = 1
                THEN posts.post_id ELSE NULL
            END) as count_post")) // đếm số bài viết trong category
        ->groupBy('categories.category_id', 'categories.category_name') // group theo category_id và category_name
        ->get()
            ->map(function ($post) {
                return [
                    'category_id' => $post->category_id,
                    'category_name' => $post->category_name ?? '(No Name)', // lấy tên category từ kết quả join
                    'count_post' => $post->count_post,
                ];
            });
    }

    public function incrementView(int $id)
    {
        return Post::where($this->primaryKey, $id)
            ->whereHas('user', function ($query) {
                $query->where('is_active', true);
            })->increment('view_counts', 1);
    }

    public function getPopularPosts(int|null $id = null){
        $query = $this->model
            ->where('post_status', true)
            ->whereHas('user', function ($query) {
                $query->where('is_active', true);
            })->orderBy('view_counts', 'desc');

        if (!is_null($id)) {
            $query->where($this->primaryKey, '!=', $id);
        }

        return $query->take(3)->get();
    }
}
