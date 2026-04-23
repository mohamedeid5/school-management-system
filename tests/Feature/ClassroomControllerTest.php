<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Grade;
use App\Models\Classroom;
use Spatie\Permission\Models\Role;

class ClassroomControllerTest extends TestCase
{

    use RefreshDatabase;

    protected User $user;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();

        Role::create(['name' => 'admin']);
        $this->user->assignRole('admin');

        $this->actingAs($this->user);
    }

    public function test_index_displays_classroom_page_successfully()
    {
        $grade = Grade::factory()->create();
        $classroom = Classroom::factory()->create([
            'grade_id' => $grade->id
        ]);

        $response = $this->get(route('admin.classrooms.index'));

        $response->assertStatus(200);
        $response->assertViewIs('admin.classrooms.index');
        $response->assertViewHasAll(['classrooms', 'grades']);
    }

    public function test_it_can_store_multiple_classrooms(): void
    {
        $grade = Grade::factory()->create();

        $data = [
            'list_classrooms' => [
                [
                    'name' => 'الصف الاول',
                    'name_en' => 'classroom A',
                    'grade_id' => $grade->id
                ],
                [
                    'name' => 'الصف الثاني',
                    'name_en' => 'classroom B',
                    'grade_id' => $grade->id
                ],
            ]
        ];

        $response = $this->post(route('admin.classrooms.store'), $data);

        $response->assertRedirect(route('admin.classrooms.index'));
        $this->assertDatabaseCount('classrooms', 2);
        $this->assertDatabaseHas('classrooms', [
            'grade_id' => $grade->id
        ]);
    }

    public function test_store_validates_required_fields(): void
    {
        $response = $this->post(route('admin.classrooms.store'), []);

        $response->assertSessionHasErrors();
    }

    public function test_it_can_update_a_classroom(): void
    {
        $grade = Grade::factory()->create([
            'name' => [
                'ar' => 'المرحلة الاولى',
                'en' => 'Grade 1'
            ]
        ]);

        $classroom = Classroom::factory()->create([
            'name' => [
                'ar' => 'الصف الاول',
                'en' => 'classroom 1',
            ],
            'grade_id' => $grade->id
        ]);

        $data = [
            'name' => [
                'ar' => 'الصف الثاني',
                'en' => 'classroom 2',
            ],
            'grade_id' => $grade->id
        ];

        $response = $this->put(route('admin.classrooms.update', $classroom), $data);
        $response->assertRedirect(route('admin.classrooms.index'));

        $classroom->refresh();

        $this->assertEquals('الصف الثاني', $classroom->getTranslation('name', 'ar'));
        $this->assertEquals('classroom 2', $classroom->getTranslation('name', 'en'));
    }

    public function test_update_validates_required_fields(): void
    {

        $grade = Grade::factory()->create();

        $classroom = Classroom::create([
            'name' => [
                'ar' => 'الصف الاول',
                'en' => 'grade 1'
            ],
            'grade_id' => $grade->id
        ]);

        $response = $this->put(
            route('admin.classrooms.update', $classroom),
            []
        );

        $response->assertSessionHasErrors([
            'name.ar',
            'name.en',
            'grade_id'
        ]);
    }
}


