<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository extends BaseRepository
{
    public function __construct(User $user)
    {
        parent::__construct($user);
    }

    public function search(array $filters = [])
    {
        return $this->query()
            ->when(!empty($filters['keyword']), function ($query) use ($filters) {
                $query->where('name', 'like', '%' . $filters['keyword'] . '%');
            })
            ->latest()
            ->paginate($filters['per_page'] ?? 15);
    }
}
