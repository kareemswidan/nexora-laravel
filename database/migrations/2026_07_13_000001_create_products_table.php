<?php
use Illuminate\Database\Migrations\Migration;use Illuminate\Database\Schema\Blueprint;use Illuminate\Support\Facades\Schema;
return new class extends Migration{public function up(){Schema::create('products',function(Blueprint $t){$t->id();$t->string('name');$t->string('name_ar');$t->text('description');$t->text('description_ar');$t->string('category');$t->string('category_ar');$t->decimal('price',10,2);$t->decimal('old_price',10,2)->nullable();$t->decimal('rating',2,1)->default(5);$t->string('badge')->nullable();$t->string('badge_ar')->nullable();$t->string('color')->default('violet');$t->string('icon',10)->default('✦');$t->boolean('is_active')->default(true);$t->timestamps();});}public function down(){Schema::dropIfExists('products');}};

