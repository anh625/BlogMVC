<?php
namespace App\Mappers;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Str;

class UserDataMapper{

    private function getData(UserRequest $request): array
    {
        return [
            'email' => $request->get('email'),
            'password' => $request->get('password'),
            'name' => $request->get('name'),
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
        $data['user_id'] = $request->get('id');
        return $data;
    }
}
