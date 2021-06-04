<?php

namespace Tests\Feature;

use App\Models\checklistGroup;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminChecklistgroupTest extends TestCase
{
    // use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $admin = User::factory()->create(['is_admin'=>1]);
        $response = $this->actingAs($admin)->post('admin/checklist_groups',['name'=>'Testing..']);
        $response->assertRedirect('welcome');

        $group = checklistGroup::where('name','Testing..')->first();
        $this->assertNotNull($group);
        $response = $this->actingAs($admin)->get('admin/checklist_groups/'.$group->id.'/edit');
        $response->assertStatus(200);

        $response = $this->actingAs($admin)->put('admin/checklist_groups/'.$group->id,['name'=>'Updated testing..']);
        $response->assertRedirect('welcome');

        $group = checklistGroup::where('name','Updated testing..')->first();
        $this->assertNotNull($group);

    }
}
