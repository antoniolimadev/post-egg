<?php

namespace App\Enums;

enum NoteEvent: string
{
    case CREATED = 'note:created';
    case DESTROYED = 'note:destroyed';
    case EDIT = 'note:edit';
}
