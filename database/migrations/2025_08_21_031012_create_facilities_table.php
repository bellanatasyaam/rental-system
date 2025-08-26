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
            Schema::create('facilities', function (Blueprint $table) {
                $table->id();
                $table->string('name'); // tambahkan kembali, jangan dikomentari
                $table->string('type'); // tambahkan kembali, jangan dikomentari
                $table->string('room')->nullable();
                $table->string('floor')->nullable();
                $table->enum('ac', ['AC', 'No AC'])->default('No AC');
                $table->text('description')->nullable();
                $table->decimal('cost', 10, 2);
                $table->string('biling_type');
                $table->timestamps();
            });
        }


            /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('facilities');
    }

        // /**
        //  * Reverse the migrations.
        //  */
        // public function down(): void
        // {
        //     Schema::table('facilities', function (Blueprint $table) {
        //         $table->dropColumn(['room', 'floor', 'ac']);
        //     });
        // }
    };
