<?php
namespace App\Mappers;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Str;
use App\Traits\HandlesBase64Image;

class UserDataMapper{
    use HandlesBase64Image;

    private function getData(UserRequest $request): array
    {
        $avatarPath = null;
        $email = null;
        $password = null;
        if ($request->has('email')) $email = $request->get('email');
        if ($request->has('password')) $password = $request->get('password');
        if ($request->has('avatar') && $request->get('avatar') != null) {
            $avatarPath = $this->saveBase64Image($request->input('avatar'), 'images/user/avatar', 'avatar_');
        }
        return [
            'email' => $email,
            'password' => $password,
            'name' => $request->get('name'),
            'user_image' => $avatarPath,
            'phone_number' => $request->get('phone_number'),
        ];
    }
    public function mapForCreate (UserRequest $request): array{
        $data = $this->getData($request);
        $data['user_id'] = Str::uuid();
        return $data;
    }

    public function mapForEdit (UserRequest $request): array{
        $data = $this->getData($request);
        if(!$data['user_image']){
            unset($data['user_image']);
        }
        unset($data['email']);
        unset($data['password']);
        return $data;
    }
}
