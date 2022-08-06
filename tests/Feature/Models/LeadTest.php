<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Maatwebsite\Excel\Facades\Excel;

uses(RefreshDatabase::class);

beforeEach(fn () => User::factory()->create());

test('Lead route is redirecting to login route without login', function () {

    $response = $this->get('/leads/');

    $response->assertRedirect('/login');
    $response->assertStatus(302);
});

test('After login Lead route is working', function () {

    $this->actingAs(\App\Models\User::first());

    $response = $this->get('/leads/');

    $response->assertStatus(200);
});

test( 'import route is working' , function (){
    $this->actingAs(\App\Models\User::first());

    $response = $this->get('/leads/import');

    $response->assertStatus(200);
});


test('Import - Csv file is getting saved', function (){
    $this->actingAs(\App\Models\User::first());

    $header = "email,	prefix,	first_name,	last_name,	active";
    $first = "meet@test.com, Mrs,Meet,	Thosar,	";

    $content = implode('\n', [$header, $first]);

    $response = $this->post('/leads/import', [
        'upload_file' => \Illuminate\Http\UploadedFile::fake()->createWithContent('file.csv', $content)
    ]);
    $response->assertOk();
});

test('Import - Csv file - Throws validation error', function (){
    $this->actingAs(\App\Models\User::first());

    $header = "email,	prefix,	first_name,	last_name,	active";
    $first = "meet@test.com, Mrs,Meet,	Thosar,	";
    $second = "meet@test.com, Mrs,,	Thosar,	";
    $third = "meet@test.com, Mrs,,	Thosar,	";

    $content = implode('\n', [$header, $first, $second, $third]);

    $response = $this->post('/leads/import', [
        'upload_file' => \Illuminate\Http\UploadedFile::fake()->createWithContent('file.csv', $content)
    ]);

    $response->assertSee('2');


});



