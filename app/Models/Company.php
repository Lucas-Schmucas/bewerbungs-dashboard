<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOneOrMany;

class Company extends Model
{
    use HasFactory;

    public function application(): HasOneOrMany
    {
        return $this->hasMany(Application::class);
    }
}
