<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Seeder;

class PagesSeederr extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Page::create([
            'title'=>'first title',
            'content'=>'this is first content'
        ]);

        Page::create([
            'title'=>'second title',
            'content'=>'this is second content'
        ]);
    }
}
