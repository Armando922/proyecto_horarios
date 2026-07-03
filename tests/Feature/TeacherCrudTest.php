<?php

use App\Models\Teacher;

uses(
    Tests\TestCase::class,
    Illuminate\Foundation\Testing\RefreshDatabase::class,
);

it('lists teachers', function () {
    Teacher::factory()->count(3)->create();

    $response = $this->get(route('teachers.index'));

    $response->assertStatus(200);
    $response->assertSee(Teacher::first()->nombre_completo);
});

it('shows the create form', function () {
    $response = $this->get(route('teachers.create'));

    $response->assertStatus(200);
    $response->assertSee('Registrar Docente');
});

it('stores a new teacher', function () {
    $data = Teacher::factory()->make()->toArray();

    $response = $this->post(route('teachers.store'), $data);

    $response->assertSessionHasNoErrors();
    $response->assertRedirect(route('teachers.index'));
    $this->assertDatabaseHas('teachers', $data);
});

it('validates required fields on store', function () {
    $response = $this->post(route('teachers.store'), []);

    $response->assertSessionHasErrors(['prefijo_academico', 'nombre_completo']);
});

it('deletes a teacher', function () {
    $teacher = Teacher::factory()->create();

    $response = $this->delete(route('teachers.destroy', $teacher));

    $response->assertRedirect(route('teachers.index'));
    $this->assertDatabaseMissing('teachers', ['id' => $teacher->id]);
});