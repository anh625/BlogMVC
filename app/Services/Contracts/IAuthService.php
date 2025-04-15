<?php
namespace App\Services\Contracts;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;

/**
* Interface IAuthService
*
* Defines the contract for authentication services, including user management and session handling.
*/
interface IAuthService
{
/**
* Register a new user.
*
* @param UserRequest $request The request containing user data.
* @return User|null The created user or null if the email already exists.
*/
public function register(UserRequest $request): ?User;

/**
* Log in a user.
*
* @param LoginRequest $request The login request containing user credentials.
* @return User|null The logged-in user or null if authentication fails.
*/
public function login(LoginRequest $request): ?User;

/**
* Log out the current user and clear the session.
*
* @return void
*/
public function logout(): void;
}
