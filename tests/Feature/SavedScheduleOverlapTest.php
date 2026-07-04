<?php

use App\Models\AvailableClass;
use App\Models\Semester;
use App\Models\TimeSlot;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

uses(
    TestCase::class,
    RefreshDatabase::class,
);

beforeEach(function () {
    $this->user = User::factory()->create();
    $this->semester = Semester::factory()->create();
});

it('fails when two available classes have the same time slot and semester', function () {
    $timeSlot = TimeSlot::factory()->create();

    $firstClass = AvailableClass::factory()->create([
        'time_slot_id' => $timeSlot->id,
        'semester_id' => $this->semester->id,
    ]);

    $secondClass = AvailableClass::factory()->create([
        'time_slot_id' => $timeSlot->id,
        'semester_id' => $this->semester->id,
    ]);

    $response = $this->actingAs($this->user)->post(route('saved-schedules.store'), [
        'nombre_horario' => 'Horario con cruce',
        'gestion' => '2026-2',
        'available_class_ids' => [$firstClass->id, $secondClass->id],
    ]);

    $response->assertSessionHasErrors('available_class_ids');
});

it('creates a saved schedule when available classes have different time slots', function () {
    $firstClass = AvailableClass::factory()->create([
        'time_slot_id' => TimeSlot::factory()->create()->id,
        'semester_id' => $this->semester->id,
    ]);

    $secondClass = AvailableClass::factory()->create([
        'time_slot_id' => TimeSlot::factory()->create()->id,
        'semester_id' => $this->semester->id,
    ]);

    $response = $this->actingAs($this->user)->post(route('saved-schedules.store'), [
        'nombre_horario' => 'Horario valido',
        'gestion' => '2026-2',
        'available_class_ids' => [$firstClass->id, $secondClass->id],
    ]);

    $response->assertSessionHasNoErrors();
    $response->assertRedirect();

    $this->assertDatabaseHas('saved_schedules', [
        'user_id' => $this->user->id,
        'nombre_horario' => 'Horario valido',
        'gestion' => '2026-2',
    ]);

    $this->assertDatabaseHas('class_selections', [
        'available_class_id' => $firstClass->id,
    ]);

    $this->assertDatabaseHas('class_selections', [
        'available_class_id' => $secondClass->id,
    ]);
});
