<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\DB;

class Status extends Model
{
    use HasFactory;

    protected $table = 'statuses';

    public function application() : HasMany
    {
        return $this->hasMany(Application::class);
    }

    public static function labelColors() : array
    {
        $result = [];
        $statuses = DB::table('statuses')->select('label', 'color')
            ->get();
        foreach ($statuses as $status ) {
            $result[$status->label] = $status->color;
        }
        return $result;
    }
}
