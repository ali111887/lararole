<?php

namespace Lararole\Database\Seeds;

use Lararole\Models\Role;
use Lararole\Models\Module;
use Illuminate\Database\Seeder;

class LararoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Modules
        foreach (config('lararole.modules') as $module) {
            $m = Module::create([
                'name' => $module['name'],
                'icon' => @$module['icon'],
            ]);

            if (@$module['modules']) {
                $m->create_modules(@$module['modules']);
            }
        }

        Role::create(['name' => 'Super Admin'])->modules()->attach(Module::isRoot()->get()->pluck('id'), ['permission' => 'write']);

        factory(Role::class, 10)->create();

        Role::where('slug', '!=', 'super_admin')->get()->each(function ($role) {
            $role->modules()->attach(Module::isRoot()->get()->random(rand(1, 3))->pluck('id')->toArray());
        });
    }
}