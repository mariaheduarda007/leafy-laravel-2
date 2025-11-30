<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Book;
use App\Http\Controllers\PermissionController;


class BookPolicy
{
    public function viewAny(User $user): bool
    {
        return PermissionController::isAuthorized('book.index');
       
    }


    public function view(User $user, Book $book): bool
    {
        return PermissionController::isAuthorized('book.show');
    }


    public function create(User $user): bool
    {
        return PermissionController::isAuthorized('book.create');
    }


    public function update(User $user, Book $book): bool
    {
        return PermissionController::isAuthorized('book.edit');
    }


    public function delete(User $user, Book $book): bool
    {
        return PermissionController::isAuthorized('book.delete');
    }
    public function __construct()
    {
        //
    }
}
