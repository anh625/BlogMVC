<?php
namespace App\Mappers;
use App\Http\Requests\ContactRequest;

class ContactDataMapper{
    private function getData(ContactRequest $request): array
    {
        return [
            'contact_name' => $request->get('contact_name'),
            'contact_phone' => $request->get('contact_phone'),
            'subject' => $request->get('subject'),
            'message' => $request->get('message'),
        ];
    }
    public function mapForCreate (ContactRequest $request): array{
        $data = $this->getData($request);
        return $data;
    }

}
