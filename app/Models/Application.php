<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Application extends Model
{
    use HasFactory;

    public function status(): BelongsTo
    {
        return $this->belongsTo(Status::class, 'status_id', 'id');
    }

    public static function getNextInterview(): string
    {
        $application = Application::where('interview_date', '>', today())->first();

        if($application === null) {
            return 'No Interview Date';
        }

        return $application->inverview_date;
    }
}
