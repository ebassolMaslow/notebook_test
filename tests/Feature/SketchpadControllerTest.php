<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SketchpadControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function testIndex(): void
    {
        $response = $this->get('/api/v1/sketchpads/');
        $response->assertStatus(200);
    }

    public function testStore(): void
    {
        $response = $this->get('/api/v1/sketchpads/', [
            'FIO' => 'Антуаннета Анна Туретта',
            'company' => 'ООО Тмыв денег',
            'telephone' => '8 (903) 423-12-12',
            'email' => 'ooodddd@example.com',
            'date_of_birth' => '2000-11-11',
            'photo' => 'hjhgfdsddf.jpg',
        ]);
        $response->assertStatus(200);
    }
}
