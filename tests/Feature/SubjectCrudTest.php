<?php

use App\Models\Subject;

uses(
    Tests\TestCase::class,
    Illuminate\Foundation\Testing\RefreshDatabase::class,
);

it('lists subjects', function () {
    Subject::factory()->count(3)->create();

    $response = $this->get(route('subjects.index'));

    $response->assertStatus(200);
    $response->assertSee(Subject::first()->nombre);
});

it('shows the create form', function () {
    $response = $this->get(route('subjects.create'));

    $response->assertStatus(200);
    $response->assertSee('Registrar Materia');
});

it('stores a new subject', function () {
    $data = Subject::factory()->make()->toArray();

    $response = $this->post(route('subjects.store'), $data);

    $response->assertSessionHasNoErrors();
    $response->assertRedirect(route('subjects.index'));
    $this->assertDatabaseHas('subjects', $data);
});

it('validates required fields on store', function () {
    $response = $this->post(route('subjects.store'), []);

    $response->assertSessionHasErrors(['sigla', 'nombre']);
});

it('validates unique sigla on store', function () {
    Subject::factory()->create(['sigla' => 'INF101']);

    $response = $this->post(route('subjects.store'), [
        'sigla' => 'INF101',
        'nombre' => 'Otra materia',
    ]);

    $response->assertSessionHasErrors('sigla');
});

it('shows a subject', function () {
    $subject = Subject::factory()->create();

    $response = $this->get(route('subjects.show', $subject));

    $response->assertStatus(200);
    $response->assertSee($subject->nombre);
});

it('shows the edit form', function () {
    $subject = Subject::factory()->create();

    $response = $this->get(route('subjects.edit', $subject));

    $response->assertStatus(200);
    $response->assertSee($subject->sigla);
});

it('updates a subject', function () {
    $subject = Subject::factory()->create();

    $response = $this->put(route('subjects.update', $subject), [
        'sigla' => 'INF999',
        'nombre' => 'Materia actualizada',
    ]);

    $response->assertSessionHasNoErrors();
    $response->assertRedirect(route('subjects.index'));
    $this->assertDatabaseHas('subjects', [
        'id' => $subject->id,
        'sigla' => 'INF999',
        'nombre' => 'Materia actualizada',
    ]);
});

it('validates unique sigla on update', function () {
    Subject::factory()->create(['sigla' => 'INF101']);
    $subject = Subject::factory()->create(['sigla' => 'INF102']);

    $response = $this->put(route('subjects.update', $subject), [
        'sigla' => 'INF101',
        'nombre' => 'Materia',
    ]);

    $response->assertSessionHasErrors('sigla');
});

it('allows updating without changing sigla', function () {
    $subject = Subject::factory()->create(['sigla' => 'INF101']);

    $response = $this->put(route('subjects.update', $subject), [
        'sigla' => 'INF101',
        'nombre' => 'Nuevo nombre',
    ]);

    $response->assertSessionHasNoErrors();
});

it('deletes a subject', function () {
    $subject = Subject::factory()->create();

    $response = $this->delete(route('subjects.destroy', $subject));

    $response->assertRedirect(route('subjects.index'));
    $this->assertDatabaseMissing('subjects', ['id' => $subject->id]);
});
