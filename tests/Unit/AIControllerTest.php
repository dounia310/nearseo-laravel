<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class AIControllerTest extends TestCase
{
    // tests/Unit/AIControllerTest.php
public function test_generate_article_with_valid_data()
{
    $response = $this->post('/ai/generate', [
        'mode' => 'local',
        'business_name' => 'Test Commerce',
        'subject' => 'Test Subject',
        // ...
    ]);
    
    $response->assertStatus(200);
    $response->assertJsonStructure(['success', 'content', 'seo_score']);
}
    public function test_example(): void
    {
        $this->assertTrue(true);
    }
}
