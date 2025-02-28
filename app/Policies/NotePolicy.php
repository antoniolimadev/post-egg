<?php

namespace App\Policies;

use App\Models\Note;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class NotePolicy
{
    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Note $note): bool
    {
        return $user?->id === $note->user_id;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): Response
    {
        return $user?->notes()->count() < 100
            ? Response::allow()
            : Response::deny('You have reached the limit of notes per user.');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Note $note): bool
    {
        return $user?->id === $note->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Note $note): bool
    {
        return $user?->id === $note->user_id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function archive(User $user, Note $note): bool
    {
        return $user?->id === $note->user_id;
    }
}
