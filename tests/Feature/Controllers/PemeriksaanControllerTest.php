<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Pemeriksaan;

use App\Models\Pemeliharaan2;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PemeriksaanControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $this->actingAs(
            User::factory()->create(['email' => 'admin@admin.com'])
        );

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_displays_index_view_with_pemeriksaans(): void
    {
        $pemeriksaans = Pemeriksaan::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('pemeriksaans.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.pemeriksaans.index')
            ->assertViewHas('pemeriksaans');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_pemeriksaan(): void
    {
        $response = $this->get(route('pemeriksaans.create'));

        $response->assertOk()->assertViewIs('app.pemeriksaans.create');
    }

    /**
     * @test
     */
    public function it_stores_the_pemeriksaan(): void
    {
        $data = Pemeriksaan::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('pemeriksaans.store'), $data);

        $this->assertDatabaseHas('pemeriksaans', $data);

        $pemeriksaan = Pemeriksaan::latest('id')->first();

        $response->assertRedirect(route('pemeriksaans.edit', $pemeriksaan));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_pemeriksaan(): void
    {
        $pemeriksaan = Pemeriksaan::factory()->create();

        $response = $this->get(route('pemeriksaans.show', $pemeriksaan));

        $response
            ->assertOk()
            ->assertViewIs('app.pemeriksaans.show')
            ->assertViewHas('pemeriksaan');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_pemeriksaan(): void
    {
        $pemeriksaan = Pemeriksaan::factory()->create();

        $response = $this->get(route('pemeriksaans.edit', $pemeriksaan));

        $response
            ->assertOk()
            ->assertViewIs('app.pemeriksaans.edit')
            ->assertViewHas('pemeriksaan');
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

        $response = $this->put(
            route('pemeriksaans.update', $pemeriksaan),
            $data
        );

        $data['id'] = $pemeriksaan->id;

        $this->assertDatabaseHas('pemeriksaans', $data);

        $response->assertRedirect(route('pemeriksaans.edit', $pemeriksaan));
    }

    /**
     * @test
     */
    public function it_deletes_the_pemeriksaan(): void
    {
        $pemeriksaan = Pemeriksaan::factory()->create();

        $response = $this->delete(route('pemeriksaans.destroy', $pemeriksaan));

        $response->assertRedirect(route('pemeriksaans.index'));

        $this->assertModelMissing($pemeriksaan);
    }
}
