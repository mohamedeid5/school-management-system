<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Grade;
use App\Models\Classroom;

class ClassroomControllerTest extends TestCase
{

    use RefreshDatabase;

    protected User $user;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();

        $this->actingAs($this->user);
    }

    public function test_index_displays_classroom_page_successfully()
    {
        $grade = Grade::factory()->create();
        $classroom = Classroom::factory()->create([
            'grade_id' => $grade->id
        ]);

        $response = $this->get(route('classrooms.index'));

        $response->assertStatus(200);
        $response->assertViewIs('classrooms.index');
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

        $response = $this->post(route('classrooms.store'), $data);

        $response->assertRedirect(route('classrooms.index'));
        $this->assertDatabaseCount('classrooms', 2);
        $this->assertDatabaseHas('classrooms', [
            'grade_id' => $grade->id
        ]);
    }

    public function test_store_validates_required_fields(): void
    {
        $response = $this->post(route('classrooms.store'), []);

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

        $response = $this->put(route('classrooms.update', $classroom), $data);
        $response->assertRedirect(route('classrooms.index'));

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
            'grade_id' => ''
        ]);
    }
}


