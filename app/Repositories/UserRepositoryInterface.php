<?php

namespace App\Repositories;

use App\Models\User;

interface UserRepositoryInterface
{
    /** Returns user by id
     * @param int $id
     * @return User|null
     */
    public function getById(int $id): ?User;

    /** Returns user by email
     * @param string $email
     * @return User|null
     */
    public function getByEmail(string $email): ?User;

    /** Creates a new user
     * @param array $attributes
     * @return User|null
     */
    public function create(array $attributes): ?User;
}
