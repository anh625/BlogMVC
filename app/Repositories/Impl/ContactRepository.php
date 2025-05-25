<?php
namespace App\Repositories\Impl;

use App\Models\Contact;
use App\Repositories\Contracts\IContactRepository;
use Illuminate\Pagination\LengthAwarePaginator;

class ContactRepository extends BaseRepository implements IContactRepository
{
    private int $perPage;
    protected string $primaryKey = 'contact_id';
    public function __construct()
    {
        $this->perPage = config('pagination.per_page');
        // Gọi constructor của BaseRepository và truyền vào model User
        parent::__construct(new Contact());
    }
    public function show(int $perPage = 10): LengthAwarePaginator
    {
        return Contact::paginate($perPage);
    }
}
