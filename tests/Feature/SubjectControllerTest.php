<?php

namespace Tests\Feature;

use App\Models\Classroom;
use App\Models\Grade;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class SubjectControllerTest extends TestCase
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

    public function test_index_displays_subjects_page()
    {
        $response = $this->get(route('admin.subjects.index'));

        $response->assertStatus(200);
    }

    public function test_it_can_store_subject()
    {
        $grade = Grade::factory()->create();
        $classroom = Classroom::factory()->create(['grade_id' => $grade->id]);
        $teacher = Teacher::factory()->create();

        $data = Subject::factory()->make([
            'grade_id' => $grade->id,
            'classroom_id' => $classroom->id,
            'teacher_id' => $teacher->id
        ]);

        $response = $this->post(route('admin.subjects.store'), $data->toArray());
        $response->assertRedirect(route('admin.subjects.index'));
        $this->assertDatabaseHas('subjects', [
            'grade_id' => $grade->id,
            'classroom_id' => $classroom->id,
            'teacher_id' => $teacher->id
        ]);
    }

    public function test_store_validates_required_fields()
    {
        $response = $this->post(route('admin.subjects.store'), []);
        $response->assertSessionHasErrors([
            'name.ar',
            'name.en',
            'grade_id',
            'classroom_id',
            'teacher_id'
        ]);
    }

    public function test_it_can_update_subject()
    {
        $grade = Grade::factory()->create();
        $classroom = Classroom::factory()->create(['grade_id' => $grade->id]);
        $teacher = Teacher::factory()->create();

        $subject = Subject::factory()->create([
            'grade_id' => $grade->id,
            'classroom_id' => $classroom->id,
            'teacher_id' => $teacher->id
        ]);

        $newGrade = Grade::factory()->create();
        $newClassroom = Classroom::factory()->create(['grade_id' => $newGrade->id]);
        $newTeacher = Teacher::factory()->create();

        $data = [
            'name' => ['en' => 'Updated Subject', 'ar' => 'المادة المحدثة'],
            'grade_id' => $newGrade->id,
            'classroom_id' => $newClassroom->id,
            'teacher_id' => $newTeacher->id
        ];

        $response = $this->put(route('admin.subjects.update', $subject), $data);
        $response->assertRedirect(route('admin.subjects.index'));
        $this->assertDatabaseHas('subjects', [
            'id' => $subject->id,
            'name->en' => 'Updated Subject',
            'name->ar' => 'المادة المحدثة',
            'grade_id' => $newGrade->id,
            'classroom_id' => $newClassroom->id,
            'teacher_id' => $newTeacher->id
        ]);
    }

    public function test_update_validates_required_fields()
    {
        $subject = Subject::factory()->create();

        $response = $this->put(route('admin.subjects.update', $subject), []);
        $response->assertSessionHasErrors([
            'name.ar',
            'name.en',
            'grade_id',
            'classroom_id',
            'teacher_id'
        ]);
    }

    public function test_it_can_delete_subject()
    {
        $subject = Subject::factory()->create();

        $response = $this->delete(route('admin.subjects.destroy', $subject));
        $response->assertRedirect(route('admin.subjects.index'));
        $this->assertDatabaseMissing('subjects', ['id' => $subject->id]);
    }
}
