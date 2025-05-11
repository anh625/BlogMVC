<?php
namespace App\Services\Impl;

use App\Http\Requests\ContactRequest;
use App\Mappers\ContactDataMapper;
use App\Models\Contact;
use App\Repositories\Contracts\IContactRepository;
use App\Services\Contracts\IContactService;
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

    public function add(ContactRequest $request) : ?Contact
    {
        $data = $this->contactDataMapper->mapForCreate($request);
        return $this->contactRepository->store($data);
    }

}
