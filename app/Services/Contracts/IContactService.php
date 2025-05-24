<?php

namespace App\Services\Contracts;

use App\Http\Requests\ContactRequest;
use App\Models\Contact;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Interface IPostService
 *
 * Defines the contract for authentication services, including user management and session handling.
 */
interface IContactService
{
    public function show() : LengthAwarePaginator;
    public function add(ContactRequest $request) : ?Contact;
    public function showById(int $id) : ?Contact;
    public function update(Request $request, int $id) : ?Contact;
    public function destroy(int $id) : ?Contact;
}
