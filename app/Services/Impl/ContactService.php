<?php
namespace App\Services\Impl;

use App\Http\Requests\ContactRequest;
use App\Mappers\ContactDataMapper;
use App\Models\Contact;
use App\Repositories\Contracts\IContactRepository;
use App\Services\Contracts\IContactService;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class ContactService implements IContactService
{
    private IContactRepository $contactRepository;

    private ContactDataMapper $contactDataMapper;

    public function __construct(IContactRepository $contactRepository,
                                ContactDataMapper $contactDataMapper)
    {
        $this->contactRepository = $contactRepository;
        $this->contactDataMapper = $contactDataMapper;
    }

    public function show() : LengthAwarePaginator{
        return $this->contactRepository->show();
    }

    public function showById(int $id) : ?Contact
    {
        return $this->contactRepository->getById($id);
    }

    public function add(ContactRequest $request) : ?Contact
    {
        $data = $this->contactDataMapper->mapForCreate($request);
        return $this->contactRepository->store($data);
    }

    public function update(Request $request, int $id) : ?Contact
    {
        return $this->contactRepository->update([ 'contact_status' => $request->input('contact_status') ], $id);
    }

    public function destroy(int $id) : ?Contact
    {
        return $this->contactRepository->delete($id);
    }

}
