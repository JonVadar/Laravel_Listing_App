<?php

namespace App\Policies;

use App\Models\Listing;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ListingPolicy
{
    public function view(?User $user, Listing $listing): bool
    {
        return $listing->user->role !== 'suspended' && $listing->approved;
    }

    public function create(User $user): bool
    {
        return $user->role !== 'suspended';
    }

    public function modify(User $user, Listing $listing): bool
    {
        return $user->role !== 'suspended' && $user->id === $listing->user_id;
    }
}
