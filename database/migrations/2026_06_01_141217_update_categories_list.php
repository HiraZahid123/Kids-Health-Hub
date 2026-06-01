<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Rename Paediatrics -> Paediatrician
        DB::table('categories')
            ->where('slug', 'paediatrics')
            ->update(['name' => 'Paediatrician', 'slug' => 'paediatrician']);

        // Remove Autism Support and Child Development
        DB::table('categories')->whereIn('slug', ['autism-support', 'child-development'])->delete();

        // Add new categories if they don't already exist
        $existing = DB::table('categories')->pluck('slug')->toArray();
        $maxOrder = DB::table('categories')->max('sort_order') ?? 0;

        $toAdd = [
            ['name' => 'Support Workers', 'slug' => 'support-workers'],
            ['name' => 'PBS Providers',   'slug' => 'pbs-providers'],
            ['name' => 'Play Therapy',    'slug' => 'play-therapy'],
        ];

        foreach ($toAdd as $cat) {
            if (!in_array($cat['slug'], $existing)) {
                DB::table('categories')->insert(array_merge($cat, [
                    'sort_order' => ++$maxOrder,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]));
            }
        }
    }

    public function down(): void
    {
        DB::table('categories')->where('slug', 'paediatrician')
            ->update(['name' => 'Paediatrics', 'slug' => 'paediatrics']);

        DB::table('categories')->whereIn('slug', ['support-workers', 'pbs-providers', 'play-therapy'])->delete();

        $maxOrder = DB::table('categories')->max('sort_order') ?? 0;
        DB::table('categories')->insert([
            ['name' => 'Autism Support',    'slug' => 'autism-support',    'sort_order' => ++$maxOrder, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Child Development', 'slug' => 'child-development', 'sort_order' => ++$maxOrder, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
};
