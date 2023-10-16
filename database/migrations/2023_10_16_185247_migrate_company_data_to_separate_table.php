<?php

use App\Models\Application;
use App\Models\Company;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (!Schema::hasColumn('applications', 'company_id')) {
            Schema::table('applications', function (Blueprint $table) {
                $table->foreignId('company_id');
            });
        }

        $applications = Application::all();

        if ($applications->isNotEmpty()) {
            $this->migrateCompanies($applications);
        }

        Schema::table('applications', function (Blueprint $table) {
            $table->dropColumn(['company_name', 'url']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

    }

    private function migrateCompanies(Collection $applications)
    {
        foreach ($applications as $application) {
            $company = Company::create([
                'name' => $application->company_name,
                'url' => $application->url,
            ]);
            $application->company_id = $company->id;
            $application->save();
        }
    }
};
