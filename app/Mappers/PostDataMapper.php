<?php
namespace App\Mappers;
use App\Http\Requests\PostRequest;
use App\Session\UserSession;
use App\Traits\HandlesBase64Image;
class PostDataMapper{
    use HandlesBase64Image;
    private UserSession $userSession;
    public function __construct(UserSession $userSession){
        $this->userSession = $userSession;
    }

    private function getData(PostRequest $request): array
    {
        $titleImagePath = null;
        $thumbnailPath = null;

        if ($request->has('title_image') && $request->get('title_image') != null) {
            $titleImagePath = $this->saveBase64Image($request->input('title_image'), 'images/posts/title', 'title_');
        }

        if ($request->has('thumbnail') && $request->get('thumbnail') != null) {
            $thumbnailPath = $this->saveBase64Image($request->input('thumbnail'), 'images/posts/thumbnail', 'thumb_');
        }

        return [
            'title' => $request->get('title'),
            'description' => $request->get('description'),
            'content' => $request->get('content'),
            'image' => $thumbnailPath,
            'user_id' => $this->userSession->getUser()['user_id'],
            'category_id' => $request->get('category_id'),
        ];
    }
    public function mapForCreate (PostRequest $request): array{
        return $this->getData($request);
    }

    public function mapForEdit (PostRequest $request): array{
        $data = $this->getData($request);
        // Kiểm tra nếu không có ảnh mới thì giữ lại ảnh cũ (nếu có)
        if (!$request->has('thumbnail') || $request->get('thumbnail') == null) {
            unset($data['image']);  // Nếu không có ảnh mới, bỏ qua trường ảnh
        }


        // Thêm trạng thái bài viết vào dữ liệu
        $data['post_status'] = $request->get('post_status');

        return $data;
    }
}
