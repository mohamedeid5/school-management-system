<?php

namespace Tests\Feature;

use App\Models\Section;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;
use Tests\TestCase;
use App\Models\Grade;
use App\Models\Classroom;

class SectionControllerTest extends TestCase
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

    public function test_index_displays_sections_page()
    {
        $response = $this->get(route('admin.sections.index'));

        $response->assertStatus(200);
    }

    public function test_it_can_store_section()
    {
        $grade = Grade::factory()->create();
        $classroom = Classroom::factory()->create(['grade_id' => $grade->id]);

        $section = Section::factory()->make([
           'grade_id' => $grade->id,
           'classroom_id' => $classroom->id
        ]);

        $response = $this->post(route('admin.sections.store'), $section->toArray());
        $response->assertRedirect(route('admin.sections.index'));
        $this->assertDatabaseHas('sections', [
            'grade_id' => $grade->id,
            'classroom_id' => $classroom->id
        ]);
    }

    public function test_store_validates_required_fields()
    {
        $response = $this->post(route('admin.sections.store'), []);

        $response->assertSessionHasErrors([
            'name.ar',
            'name.en',
            'status',
            'grade_id',
            'classroom_id',
        ]);
    }

    public function test_it_can_update_section()
    {
        $grade = Grade::factory()->create();

        $classroom = Classroom::factory()->create([
            'grade_id' => $grade->id
        ]);

        $section = Section::factory()->create([
            'grade_id' => $grade->id,
            'classroom_id' => $classroom->id
        ]);

        $data = [
            'name' => [
                'ar' => 'القسم المحدث',
                'en' => 'Updated Section',
            ],
            'status' => true,
            'grade_id' => $grade->id,
            'classroom_id' => $classroom->id,
        ];

        $response = $this->put(route('admin.sections.update', $section), $data);
        $response->assertRedirect(route('admin.sections.index'));
        $section->refresh();
        $this->assertEquals('القسم المحدث', $section->getTranslation('name', 'ar'));
        $this->assertEquals('Updated Section', $section->getTranslation('name', 'en'));

    }

    public function test_update_validates_required_fields()
    {
        $grade = Grade::factory()->create();

        $classroom = Classroom::factory()->create([
            'grade_id' => $grade->id
        ]);

        $section = Section::factory()->create([
            'grade_id' => $grade->id,
            'classroom_id' => $classroom->id
        ]);

        $response = $this->put(route('admin.sections.update', $section), []);
        $response->assertSessionHasErrors([
            'name.ar',
            'name.en',
            'status',
            'grade_id',
            'classroom_id'
        ]);
    }

    public function test_it_can_delete_section()
    {
        $grade = Grade::factory()->create();

        $classroom = Classroom::factory()->create([
            'grade_id' => $grade->id
        ]);

        $section = Section::factory()->create([
            'grade_id' => $grade->id,
            'classroom_id' => $classroom->id
        ]);

        $response = $this->delete(route('admin.sections.destroy', $section));
        $response->assertRedirect(route('admin.sections.index'));
        $this->assertDatabaseMissing('sections', [
            'id' => $section->id
        ]);
    }
}
