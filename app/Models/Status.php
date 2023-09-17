<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\DB;

class Status extends Model
{
    use HasFactory;

    public const SENT = 1;
    public const PREPARING_FOR_INTERVIEW = 2;
    public const PENDING_AFTER_INTERVIEW = 3;
    public const ACCEPTED = 4;
    public const DECLINED = 5;

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
