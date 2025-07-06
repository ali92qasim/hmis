<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('visits', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tenant_id')->index();
            $table->foreignId('patient_id')
                ->constrained()
                ->onDelete('cascade')
                ->onUpdate('cascade');
            /*
             * uncomment this when RBAC is added
             */
//            $table->foreignId('doctor_id')
//                ->constrained('users')
//                ->onDelete('cascade')
//                ->onUpdate('cascade');
            $table->foreignId('department_id')
                ->constrained()
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->enum('type', ['IPD', 'OPD', 'Emergency']);
            $table->timestamp('visit_date')->default(now()->toDateTimeString());
            $table->text('reason')->nullable();
            $table->text('clinical_notes')->nullable();
            $table->string('prescription')->nullable();
            $table->string('diagnosis')->nullable();
            $table->timestamps();

            // Composite index for common search scenarios
            $table->index(['visit_date']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visits');
    }
};
