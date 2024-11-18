<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Pemeriksaan;

use App\Models\Pemeliharaan2;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PemeriksaanTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $user = User::factory()->create(['email' => 'admin@admin.com']);

        Sanctum::actingAs($user, [], 'web');

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_gets_pemeriksaans_list(): void
    {
        $pemeriksaans = Pemeriksaan::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.pemeriksaans.index'));

        $response->assertOk()->assertSee($pemeriksaans[0]->ttd);
    }

    /**
     * @test
     */
    public function it_stores_the_pemeriksaan(): void
    {
        $data = Pemeriksaan::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.pemeriksaans.store'), $data);

        $this->assertDatabaseHas('pemeriksaans', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_pemeriksaan(): void
    {
        $pemeriksaan = Pemeriksaan::factory()->create();

        $pemeliharaan2 = Pemeliharaan2::factory()->create();

        $data = [
            'ttd' => $this->faker->text(255),
            'catatan' => $this->faker->text(255),
            'pemeliharaan2_id' => $pemeliharaan2->id,
        ];

        $response = $this->putJson(
            route('api.pemeriksaans.update', $pemeriksaan),
            $data
        );

        $data['id'] = $pemeriksaan->id;

        $this->assertDatabaseHas('pemeriksaans', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_pemeriksaan(): void
    {
        $pemeriksaan = Pemeriksaan::factory()->create();

        $response = $this->deleteJson(
            route('api.pemeriksaans.destroy', $pemeriksaan)
        );

        $this->assertModelMissing($pemeriksaan);

        $response->assertNoContent();
    }
}
