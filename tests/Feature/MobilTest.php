<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Models\User;
use App\Models\Barang;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class MobilTest extends TestCase
{
    use WithoutMiddleware;
    /**
     * A basic unit test example.
     *
     * @return void
     */
    use RefreshDatabase;
    public function test_example()
    {
        $this->assertTrue(true);
    }

    public function test_render_home()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_render_barang_page()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user);
        $response->get('/barang')
            ->assertSeeText('DAFTAR MOBIL')
            ->assertSeeText('Merk')
            ->assertSeeText('Harga')
            ->assertSeeText('Stok')
            ->assertSeeText('Keterangan')
            ->assertSeeText('featured_image')
            ->assertSeeText('Action')
            ->assertStatus(200);
    }

    public function test_store_barang()
    {
        $User = User::factory()->create();
        $this->actingAs($User);
        $response = $this->get('/barang', [
            'Merk' => 'Pajero 456',
            'Harga' => 13000000,
            'Stok' => 3,
            'Keterangan' => 'Mobil keluaran tahun 2022',
            'featured_image' => 'images/8oOfofyjtELx6okqdGw9WZVorkzVbipuegehwjs.jpg',
        ]);
        $response->assertStatus(302);
    }

    public function test_store_barang_invalid_input()
    {
        $User = User::factory()->create();
        $this->actingAs($User);
        $response = $this->get('/barang', [
            'Merk' => '',
            'Harga' => '',
            'Stok' => '',
            'Keterangan' => '',
        ]);
        $response->assertStatus(302);
        $response->assertInvalid([
            'Merk' => 'The Merk field is required.',
            'Harga' => 'The Harga field is required.',
            'Stok' => 'The Stok field is required.',
            'Keterangan' => 'The Keterangan field is required.',
        ]);
    }

    public function test_delete_barang_by_merk()
    {
        //setup
        $response = $this->get('/barang', [
            'Merk' => 'Pajero 456',
            'Harga' => 13000000,
            'Stok' => 3,
            'Keterangan' => 'Mobil keluaran tahun 2022',
            'featured_image' => 'images/8oOfofyjtELx6okqdGw9WZVorkzVbipuegehwjs.jpg',
        ]);

        //do something
        $this->followingRedirects()->delete($response->merk);
        //assert
        $this->assertDatabaseMissing('barangs', $response->toArray());
    }

    public function test_delete_barangs_by_merk()
    {
        //setup
        $Barang = Barang::create([
            'Merk' => 'Pajero 456',
            'Harga' => 13000000,
            'Stok' => 3,
            'Keterangan' => 'Mobil keluaran tahun 2022',
        ]);
        print_r($Barang);
        //do something
        $this->followingRedirects()->delete($Barang->merk);
        //assert
        $this->assertDatabaseMissing('barangs', $Barang->toArray());
    }
}