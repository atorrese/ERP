<?php

namespace Tests\Feature;

use App\Product;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductModuleTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic test example.
     *
     * @return void
     */
    /** @test */
    function it_shows_a_default_message_if_there_list_is_empty()
    {
//        DB::table('users')->truncate();
        $this->get('products')
            ->assertStatus(200)
            ->assertSee('No existen Productos registrados.');
    }
    /** @test */
    public function it_shows_the_produsts_list()
    {
        factory(Product::class)->create([
            'name'=>'Camiseta'
        ]);

        factory(Product::class)->create([
            'name'=>'Zapato'
        ]);

        $this->get('products')
        ->assertStatus(200)
        ->assertSee('Camiseta')
        ->assertSee('Zapato');
    }
    /** @test */
    public function it_display_a_404_error_if_product_is_not_found()
    {
        $this->get('/products/999')
            ->assertStatus(404);
    }
    /** @test */
    public function the_name_is_required()
    {
        $this->post('products',[
            'name'=>'',
            'description'=>'Descripcion de Producto',
            'price'=>10.8,
            'cost'=>5.0,
            'stock'=>100
        ])->assertSessionHasErrors(['name'=>'El campo es obligatorio.']);
        $this->assertEquals(0,Product::count());
    }
    /** @test */
    public function the_name_must_be_unique()
    {
        factory(Product::class)->create([
            'name'=>'Zapato'
        ]);
        $this->post('products',[
            'name'=>'Zapato',
            'description'=>'Descripcion de Producto',
            'price'=>10.8,
            'cost'=>5.0,
            'stock'=>100
        ])->assertSessionHasErrors([
            'name'=>'El campo debe ser unico.'
        ]);
        $this->assertEquals(1,Product::count());

    }
    /** @test */
    public function the_description_is_required()
    {
        $this->post('products',[
            'name'=>'Laptop',
            'description'=>'',
            'price'=>10.8,
            'cost'=>5.0,
            'stock'=>100
        ])->assertSessionHasErrors(['description'=>'El campo es obligatorio.']);
        $this->assertEquals(0,Product::count());
    }
    /** @test */
    public function the_precio_is_required()
    {
        $this->post('products',[
            'name'=>'Laptop',
            'description'=>'dkskdkss',
            'price'=>'',
            'cost'=>5.0,
            'stock'=>100
        ])->assertSessionHasErrors(['price'=>'El campo es obligatorio.']);
        $this->assertEquals(0,Product::count());
    }
    /** @test */
    public function the_cost_is_required()
    {
        $this->post('products',[
            'name'=>'Laptop',
            'description'=>'dkskdkss',
            'price'=>10.0,
            'cost'=>'',
            'stock'=>100
        ])->assertSessionHasErrors(['cost'=>'El campo es obligatorio.']);
        $this->assertEquals(0,Product::count());
    }
    /** @test */
    public function the_stock_is_required()
    {
        $this->post('products',[
            'name'=>'Laptop',
            'description'=>'dkskdkss',
            'price'=>10.0,
            'cost'=>2,
            'stock'=>''
        ])->assertSessionHasErrors(['stock'=>'El campo es obligatorio.']);
        $this->assertEquals(0,Product::count());
    }
    /** @test */
    public function the_name_is_required_when_updating_the_product()
    {
        //$this->withoutExceptionHandling();
        $product=factory(Product::class)->create();
        $this->from("/products/{$product->id}/edit")
            ->put("/products/{$product->id}",[
                'name'=>'',
                'description'=>'dkskdkss',
                'price'=>10.0,
                'cost'=>2,
                'stock'=>100
            ])->assertRedirect("products/{$product->id}/edit")
            ->assertSessionHasErrors(['name']);

        $this->assertDatabaseMissing('products',['name'=>'']);
    }
    /** @test */
    public function the_name_must_be_unique_when_updating_the_product()
    {
        //$this->withoutExceptionHandling();
        factory(Product::class)->create([
            'name'=>'Laptop',
        ]);
        $category = factory(Product::class)->create([
            'name'=>'Laptop Hp Gammer',
        ]);
        $this->from("products/{$category->id}/edit")
            ->put("products/{$category->id}",[
                'name'=>'Laptop',
            ])->assertRedirect("products/{$category->id}/edit")
            ->assertSessionHasErrors(['name']);
    }
    /** @test */
    public function the_description_is_required_when_updating_the_product()
    {
        //$this->withoutExceptionHandling();
        $product=factory(Product::class)->create();
        $this->from("/products/{$product->id}/edit")
            ->put("/products/{$product->id}",[
                'name'=>'Laptop Gammer Asus',
                'description'=>'',
                'price'=>10.0,
                'cost'=>2,
                'stock'=>100
            ])->assertRedirect("products/{$product->id}/edit")
            ->assertSessionHasErrors(['description']);

        $this->assertDatabaseMissing('products',['name'=>'Laptop Gammer Asus']);
    }
    /** @test */
    public function the_price_is_required_when_updating_the_product()
    {
        //$this->withoutExceptionHandling();
        $product=factory(Product::class)->create();
        $this->from("/products/{$product->id}/edit")
            ->put("/products/{$product->id}",[
                'name'=>'Laptop Gammer Asus',
                'description'=>'Disco Duro  1TB, Tarjeta  Grafica de Ultima Gneración',
                'price'=>'',
                'cost'=>2,
                'stock'=>100
            ])->assertRedirect("products/{$product->id}/edit")
            ->assertSessionHasErrors(['price']);

        $this->assertDatabaseMissing('products',['name'=>'Laptop Gammer Asus']);
    }
    /** @test */
    public function the_cost_is_required_when_updating_the_product()
    {
        //$this->withoutExceptionHandling();
        $product=factory(Product::class)->create();
        $this->from("/products/{$product->id}/edit")
            ->put("/products/{$product->id}",[
                'name'=>'Laptop Gammer Asus',
                'description'=>'Disco Duro  1TB, Tarjeta  Grafica de Ultima Gneración',
                'price'=>120,
                'cost'=>'',
                'stock'=>100
            ])->assertRedirect("products/{$product->id}/edit")
            ->assertSessionHasErrors(['cost']);

        $this->assertDatabaseMissing('products',['name'=>'Laptop Gammer Asus']);
    }
    /** @test */
    public function the_stock_is_required_when_updating_the_product()
    {
        //$this->withoutExceptionHandling();
        $product=factory(Product::class)->create();
        $this->from("/products/{$product->id}/edit")
            ->put("/products/{$product->id}",[
                'name'=>'Laptop Gammer Asus',
                'description'=>'Disco Duro  1TB, Tarjeta  Grafica de Ultima Gneración',
                'price'=>120,
                'cost'=>50,
                'stock'=>''
            ])->assertRedirect("products/{$product->id}/edit")
            ->assertSessionHasErrors(['stock']);

        $this->assertDatabaseMissing('products',['name'=>'Laptop Gammer Asus']);
    }
    /** @test */
    public function it_delete_a_product()
    {
        $this->withoutExceptionHandling();

        $product = factory(Product::class)->create([
            'name'=>'Laptop'
        ]);

        $this->delete("products/{$product->id}/")
            ->assertRedirect('products');

        $this->assertDatabaseMissing('products',['name'=>'Laptop']);

    }
}
