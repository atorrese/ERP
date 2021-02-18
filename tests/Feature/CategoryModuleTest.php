<?php

namespace Tests\Feature;

use App\Category;
use Faker\Factory;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CategoryTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic test example.
     *
     * @return void
     */
    /** @test */
    public function it_shows_the_categories_list()
    {
        factory(Category::class)->create([
            'name'=>'Medicinas'
            ]);
        factory(Category::class)->create([
            'name'=>'Tecnologia'
            ]);
            
        $this->get('categories')
        ->assertStatus(200)
        ->assertSee('Listado de Categorias')
        ->assertSee('Medicinas')
        ->assertSee('Tecnologia');
    }
    /** @test */
    public function it_display_a_404_error_if_category_is_not_found()
    {
        $this->get('/categories/999')
            ->assertStatus(404)
            ->assertSee('Página no encontrada');
    }
    /** @test */
    function it_shows_a_default_message_if_there_list_is_empty()
    {
//        DB::table('users')->truncate();
        $this->get('categories')
        ->assertStatus(200)
        ->assertSee('No existen Categorias registradas.');
    }
    /** @test */
    public function it_pagination_the_categories()
    {
        factory(Category::class)->create([
            'name'=>'Medicinas'
            ]);
        factory(Category::class,5)->create();
        factory(Category::class)->create([
            'name'=>'Tecnologia'
            ]);
            
        $this->get('categories')
        ->assertStatus(200)
        ->assertSee('Listado de Categorias')
        ->assertSee('Medicinas');

        $this->get('categories?page=2')
        ->assertStatus(200)
        ->assertSee('Listado de Categorias')
        ->assertSee('Tecnologia');
    }
   /** @test */
   public function the_name_is_required()
   {
       $this->from('categories/create')
       ->post('categories',[
           'name'=>''
       ])->assertRedirect('categories/create')
       ->assertSessionHasErrors(['name'=>'El campo es obligatorio.']);

       $this->assertEquals(0,Category::count());
   }  
    /** @test */
    public function the_name_must_be_unique()
    {
        //$this->withoutExceptionHandling();
        factory(Category::class)->create([
            'name'=>'Medicina'
        ]);
        
        $this->from('categories/create')
        ->post('categories',[
            'name'=>'Medicina'
        ])
        ->assertRedirect('categories/create')
        ->assertSessionHasErrors(['name'=>'El campo debe ser unico.']);
 
        $this->assertEquals(1,Category::count());
    }
    /** @test */
    function it_loads_the_edit_category_page()
    {
        $this->withoutExceptionHandling();
        $category = factory(Category::class)->create();
        $this->get("/categories/{$category->id}/edit")
            ->assertStatus(200)
            ->assertViewIs('categories.edit')
           ->assertSee("Editar Categoria")
           ->assertViewHas('category',function ($viewcategory) use  ($category)
           {
               return $viewcategory->id == $category->id;
           });
    }
   /** @test */
   public function the_name_is_required_when_updating_the_category()
   {
       //$this->withoutExceptionHandling();
       $category=factory(Category::class)->create();
       $this->from("/categories/{$category->id}/edit")
       ->put("/categories/{$category->id}",[
           'name'=>'',
       ])->assertRedirect("categories/{$category->id}/edit")
       ->assertSessionHasErrors(['name']);

       $this->assertDatabaseMissing('categories',['name'=>'']);
   }  
    /** @test */
    public function the_name_must_be_unique_when_updating_the_category()
    {
        //$this->withoutExceptionHandling();
        factory(Category::class)->create([
            'name'=>'Tecnologia',
        ]);
        $category = factory(Category::class)->create([
            'name'=>'Medicina',
        ]);
        $this->from("categories/{$category->id}/edit")
        ->put("categories/{$category->id}",[
            'name'=>'Tecnologia',
        ])->assertRedirect("categories/{$category->id}/edit")
        ->assertSessionHasErrors(['name']);
 
        //$this->assertEquals(0,User::count());
    }
    /** @test */
    public function it_delete_a_category()
    {
        $this->withoutExceptionHandling();

        $category = factory(Category::class)->create();
        
        $this->delete("categories/{$category->id}/")
        ->assertRedirect('categories');
        
        $this->assertDatabaseMissing('categories',['id'=>$category->id]);
        //$this->assertSame(0,User::count());
    }
}
