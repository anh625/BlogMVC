<?php
namespace App\Mappers;
use App\Http\Requests\PostRequest;
use App\Session\UserSession;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

class PostDataMapper{
    private UserSession $userSession;
    public function __construct(UserSession $userSession){
        $this->userSession = $userSession;
    }

    private function getData(PostRequest $request): array
    {
        $imagePath = null;
        $directory = storage_path('app/public/images/posts');

        // Kiểm tra và tạo thư mục nếu chưa tồn tại
        if (!file_exists($directory)) {
            mkdir($directory, 0755, true);  // Tạo thư mục với quyền truy cập là 0755
        }
        // Lưu ảnh vào thư mục public
        if ($request->hasFile('image')) {
            $manager = new ImageManager(new Driver());
            $imageName = time() . '.' . $request->image->extension();
            $img = $manager->read($request->file('image'))->cover(163.762, 163.762);
            $img->save(storage_path('app/public/images/posts/' . $imageName));
            $imagePath = 'images/posts/' . $imageName;
        }

        return [
            'title' => $request->get('title'),
            'description' => $request->get('description'),
            'content' => $request->get('content'),
            'image' => $imagePath,
            'user_id' => $this->userSession->getUser()->getAttributes()['user_id'],
            'category_id' => $request->get('category_id'),
        ];
    }
    public function mapForCreate (PostRequest $request): array{
        return $this->getData($request);
    }

    public function mapForEdit (PostRequest $request): array{
        $data = $this->getData($request);
        // Kiểm tra nếu không có ảnh mới thì giữ lại ảnh cũ (nếu có)
        if (!$request->hasFile('image')) {
            unset($data['image']);  // Nếu không có ảnh mới, bỏ qua trường ảnh
        }

        // Thêm trạng thái bài viết vào dữ liệu
        $data['post_status'] = $request->get('post_status');

        return $data;
    }
}
