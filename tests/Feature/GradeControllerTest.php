<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Grade;
use Spatie\Permission\Models\Role;

class GradeControllerTest extends TestCase
{
    use RefreshDatabase;

    protected User $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
        $role = Role::create(['name' => 'admin']);
        $this->user->assignRole($role);
        $this->actingAs($this->user);
    }

    public function test_index_page_is_displayed()
    {

        $response = $this->get(route('admin.grades.index'));
        $response->assertStatus(200);
        $response->assertViewIs('admin.grades.index');
    }

    public function test_it_can_store_a_new_grade()
    {
        $data = [
            'name' => ['en' => 'Grade 1', 'ar' => 'الصف الأول'],
            'notes' => 'This is grade 1',
        ];

        $response = $this->post(route('admin.grades.store'), $data);
        $response->assertRedirect(route('admin.grades.index'));
        $this->assertDatabaseHas('grades', [
            'name->en' => 'Grade 1',
            'name->ar' => 'الصف الأول',
            'notes' => 'This is grade 1'
        ]);
    }

    public function test_store_requires_valid_data()
    {
        $response = $this->from(route('admin.grades.index'))->post(route('admin.grades.store'), []);
        $response->assertRedirect(route('admin.grades.index'));
        $response->assertSessionHasErrors(['name.ar', 'name.en']);
    }

    public function test_it_can_update_a_grade()
    {
        $grade = Grade::factory()->create();

        $data = [
            'name' => [
                'en' => 'Updated Grade',
                'ar' => 'الصف المحدث'
            ],
            'notes' => 'This is the updated grade',
        ];

        $response = $this->put(route('admin.grades.update', $grade->id), $data);
        $response->assertRedirect(route('admin.grades.index'));
        $this->assertDatabaseHas('grades', [
            'id' => $grade->id,
            'name->en' => 'Updated Grade',
            'name->ar' => 'الصف المحدث',
            'notes' => 'This is the updated grade'
        ]);
    }

    public function test_it_can_delete_a_grade()
    {
        $grade = Grade::factory()->create();

       $response = $this->delete(route('admin.grades.destroy', $grade->id));
       $response->assertRedirect(route('admin.grades.index'));
       $this->assertDatabaseMissing('grades', [
            'id' => $grade->id
       ]);
    }
}
