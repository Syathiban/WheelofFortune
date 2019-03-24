<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Word;

class FortuneTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_If_It_Fetches()
    {
        factory(Word::class,3)->create();
        factory(Word::class,3)->create(['category_id'=>'3']);
        $importantWord=factory(Word::class)->create(['category_id'=>'5']);

        $words = Word::categorise()->get();

        $this->assertEquals($importantWord->id,$words->first()->id);
    }
}
