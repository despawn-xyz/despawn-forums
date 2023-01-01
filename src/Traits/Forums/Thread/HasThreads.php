<?php

namespace Despawn\Traits\Forums\Thread;

use Illuminate\Database\Eloquent\Casts\Attribute;

trait HasThreads
{
    public function threadsCount(): Attribute
    {
        return new Attribute(
            get: fn () => $this->threads()->count()
        );
    }
}
