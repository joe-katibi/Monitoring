<!-- <?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('results', function (Blueprint $table) {
            $table->id();
            $table->string('supervisor')->nullable();
            $table->string('category')->nullable();
            $table->string('agent_name')->nullable();
            $table->string('quality_analysts')->nullable();
            $table->dateTime('date_recorded');
            $table->integer('customer_account')->nullable();
            $table->integer('recording_id')->nullable();
            $table->string('qa_call_category')->nullable();
            $table->string('qa_call_nature')->nullable();
            $table->string('agent_call_category')->nullable();
            $table->string('agent_call_nature')->nullable();
            $table->string('general_issue')->nullable();
            $table->string('specific_issue')->nullable();
            $table->string('feedback_from_qc')->nullable();
            $table->string('supervisor_comment')->nullable();
            $table->string('agent_comment')->nullable();
            $table->string('status')->nullable();
            $table->string('percentage')->nullable();
            $table->integer('results')->nullable();
            $table->integer('totals')->nullable();
            $table->integer('final_results')->nullable();
            $table->dateTime('date_updated')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('results');
    }
};
