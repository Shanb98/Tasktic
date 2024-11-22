<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Rename the column and fix foreign key
        DB::statement('ALTER TABLE tasks DROP FOREIGN KEY tasks_catogery_id_foreign;');
        DB::statement('ALTER TABLE tasks CHANGE catogery_id category_id BIGINT UNSIGNED NOT NULL;');
        DB::statement('ALTER TABLE tasks ADD CONSTRAINT tasks_category_id_foreign FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE CASCADE;');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Reverse changes if needed
        DB::statement('ALTER TABLE tasks DROP FOREIGN KEY tasks_category_id_foreign;');
        DB::statement('ALTER TABLE tasks CHANGE category_id catogery_id BIGINT UNSIGNED NOT NULL;');
        DB::statement('ALTER TABLE tasks ADD CONSTRAINT tasks_catogery_id_foreign FOREIGN KEY (catogery_id) REFERENCES categories(id) ON DELETE CASCADE;');
    }
};
