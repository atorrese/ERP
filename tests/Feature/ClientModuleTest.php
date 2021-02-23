<?php

namespace Tests\Feature;

use App\Client;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ClientModuleTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function it_shows_the_produsts_list()
    {
        $this->withoutExceptionHandling();
        factory(Client::class)->create([
            'names'=>'Angel Alberto'
        ]);

        factory(Client::class)->create([
            'names'=>'Karina'
        ]);

        $this->get('clients')
            ->assertStatus(200)
            ->assertSee('Karina')
            ->assertSee('Angel Alberto');
    }
    /** @test */
    public function the_name_is_required()
    {
        //$this->withoutExceptionHandling();
        $this->post('clients',[
            'names'=>'',
            'surnames'=>'Torres Espinoza',
            'identification_card'=>'0940113367',
            'birthdate'=>'24-05-1997',
            'address'=>'Milagro',
            'email'=>'at78725@gmail.com',
            'phone'=>'0939932264'
        ])->assertSessionHasErrors(['names'=>'El campo es obligatorio.']);
        $this->assertEquals(0,Client::count());
    }
    /** @test */
    public function the_surnames_is_required()
    {
        //$this->withoutExceptionHandling();
        $this->post('clients',[
            'names'=>'Angel Alberto',
            'surnames'=>'',
            'identification_card'=>'0940113367',
            'birthdate'=>'24-05-1997',
            'address'=>'Milagro',
            'email'=>'at78725@gmail.com',
            'phone'=>'0939932264'
        ])->assertSessionHasErrors(['surnames'=>'El campo es obligatorio.']);
        $this->assertEquals(0,Client::count());
    }
    /** @test */
    public function the_identification_card_is_required()
    {
        //$this->withoutExceptionHandling();
        $this->post('clients',[
            'names'=>'Angel Alberto',
            'surnames'=>'Torres Espinoza',
            'identification_card'=>'',
            'birthdate'=>'24-05-1997',
            'address'=>'Milagro',
            'email'=>'at78725@gmail.com',
            'phone'=>'0939932264'
        ])->assertSessionHasErrors(['identification_card'=>'El campo es obligatorio.']);
        $this->assertEquals(0,Client::count());
    }
    /** @test */
    public function the_name_must_be_unique()
    {
        factory(Client::class)->create([
            'identification_card'=>'0940113360'
        ]);
        $this->post('clients',[
            'names'=>'Angel Alberto',
            'surnames'=>'Torres Espinoza',
            'identification_card'=>'0940113360',
            'birthdate'=>'24-05-1997',
            'address'=>'Milagro',
            'email'=>'at78725@gmail.com',
            'phone'=>'0939932264'
        ])->assertSessionHasErrors([
            'identification_card'=>'El campo debe ser unico.'
        ]);
        $this->assertEquals(1,Client::count());

    }
    /** @test */
    public function the_birthdate_is_required()
    {
        //$this->withoutExceptionHandling();
        $this->post('clients',[
            'names'=>'Angel Alberto',
            'surnames'=>'Torres Espinoza',
            'identification_card'=>'0940113360',
            'birthdate'=>'',
            'address'=>'Milagro',
            'email'=>'at78725@gmail.com',
            'phone'=>'0939932264'
        ])->assertSessionHasErrors(['birthdate'=>'El campo es obligatorio.']);
        $this->assertEquals(0,Client::count());
    }
    /** @test */
    public function the_address_is_required()
    {
        //$this->withoutExceptionHandling();
        $this->post('clients',[
            'names'=>'Angel Alberto',
            'surnames'=>'Torres Espinoza',
            'identification_card'=>'0940113360',
            'birthdate'=>'24-05-1997',
            'address'=>'',
            'email'=>'at78725@gmail.com',
            'phone'=>'0939932264'
        ])->assertSessionHasErrors(['address'=>'El campo es obligatorio.']);
        $this->assertEquals(0,Client::count());
    }
    /** @test */
    public function the_email_is_required()
    {
        //$this->withoutExceptionHandling();
        $this->post('clients',[
            'names'=>'Angel Alberto',
            'surnames'=>'Torres Espinoza',
            'identification_card'=>'0940113360',
            'birthdate'=>'24-05-1997',
            'address'=>'Milagro',
            'email'=>'',
            'phone'=>'0939932264'
        ])->assertSessionHasErrors(['email'=>'El campo es obligatorio.']);
        $this->assertEquals(0,Client::count());
    }
    /** @test */
    public function the_email_must_be_unique()
    {
        factory(Client::class)->create([
            'email'=>'at78725@gmail.com'
        ]);
        $this->post('clients',[
            'names'=>'Angel Alberto',
            'surnames'=>'Torres Espinoza',
            'identification_card'=>'0940113360',
            'birthdate'=>'24-05-1997',
            'address'=>'Milagro',
            'email'=>'at78725@gmail.com',
            'phone'=>'0939932264'
        ])->assertSessionHasErrors([
            'email'=>'El campo debe ser unico.'
        ]);
        $this->assertEquals(1,Client::count());

    }
    /** @test */
    public function the_phone_is_required()
    {
        //$this->withoutExceptionHandling();
        $this->post('clients',[
            'names'=>'Angel Alberto',
            'surnames'=>'Torres Espinoza',
            'identification_card'=>'0940113360',
            'birthdate'=>'24-05-1997',
            'address'=>'Milagro',
            'email'=>'at78725@gmail.com',
            'phone'=>''
        ])->assertSessionHasErrors(['phone'=>'El campo es obligatorio.']);
        $this->assertEquals(0,Client::count());
    }
    /** @test */
    public function the_names_is_required_when_updating_the_client()
    {
        //$this->withoutExceptionHandling();
        $client=factory(Client::class)->create();
        $this->put("/clients/{$client->id}",[
                'names'=>'',
                'surnames'=>'Torres Espinoza',
                'identification_card'=>'0940113360',
                'birthdate'=>'24-05-1997',
                'address'=>'Milagro',
                'email'=>'at78725@gmail.com',
                'phone'=>'0939932264'
            ])->assertSessionHasErrors(['names']);

        $this->assertDatabaseMissing('clients',['surnames'=>'Torres Espinoza']);
    }
    /** @test */
    public function the_surnames_is_required_when_updating_the_client()
    {
        //$this->withoutExceptionHandling();
        $client=factory(Client::class)->create();
        $this->put("/clients/{$client->id}",[
            'names'=>'Angel Alberto',
            'surnames'=>'',
            'identification_card'=>'0940113360',
            'birthdate'=>'24-05-1997',
            'address'=>'Milagro',
            'email'=>'at78725@gmail.com',
            'phone'=>'0939932264'
        ])//->assertRedirect("clients/{$client->id}/edit")
            ->assertSessionHasErrors(['surnames']);

        $this->assertDatabaseMissing('clients',['names'=>'Angel Alberto']);
    }
    /** @test */
    public function the_identification_card_is_required_when_updating_the_client()
    {
        //$this->withoutExceptionHandling();
        $client=factory(Client::class)->create();
        $this->put("/clients/{$client->id}",[
            'names'=>'Angel Alberto',
            'surnames'=>'Torres Espinoza',
            'identification_card'=>'',
            'birthdate'=>'24-05-1997',
            'address'=>'Milagro',
            'email'=>'at78725@gmail.com',
            'phone'=>'0939932264'
        ])//->assertRedirect("clients/{$client->id}/edit")
            ->assertSessionHasErrors(['identification_card']);

        $this->assertDatabaseMissing('clients',['names'=>'Angel Alberto']);
    }
    /** @test */
    public function the_identification_card_must_be_unique_when_updating_the_product()
    {
        //$this->withoutExceptionHandling();
        factory(Client::class)->create([
            'identification_card'=>'0940113360',
        ]);
        $category = factory(Client::class)->create([
            'identification_card'=>'1283897934'
        ]);
        $this->put("clients/{$category->id}",[
                'identification_card'=>'0940113360'
            ])//->assertRedirect("clients/{$category->id}/edit")
            ->assertSessionHasErrors(['identification_card']);
    }
    /** @test */
    public function the_birthdate_is_required_when_updating_the_client()
    {
        //$this->withoutExceptionHandling();
        $client=factory(Client::class)->create();
        $this->put("/clients/{$client->id}",[
            'names'=>'Angel Alberto',
            'surnames'=>'Torres Espinoza',
            'identification_card'=>'0940113389',
            'birthdate'=>'',
            'address'=>'Milagro',
            'email'=>'at78725@gmail.com',
            'phone'=>'0939932264'
        ])//->assertRedirect("clients/{$client->id}/edit")
            ->assertSessionHasErrors(['birthdate']);

        $this->assertDatabaseMissing('clients',['names'=>'Angel Alberto']);
    }
    /** @test */
    public function the_address_is_required_when_updating_the_client()
    {
        //$this->withoutExceptionHandling();
        $client=factory(Client::class)->create();
        $this->put("/clients/{$client->id}",[
            'names'=>'Angel Alberto',
            'surnames'=>'Torres Espinoza',
            'identification_card'=>'0940113389',
            'birthdate'=>'24-05-1997',
            'address'=>'',
            'email'=>'at78725@gmail.com',
            'phone'=>'0939932264'
        ])//->assertRedirect("clients/{$client->id}/edit")
            ->assertSessionHasErrors(['address']);

        $this->assertDatabaseMissing('clients',['names'=>'Angel Alberto']);
    }
    /** @test */
    public function the_email_is_required_when_updating_the_client()
    {
        //$this->withoutExceptionHandling();
        $client=factory(Client::class)->create();
        $this->put("/clients/{$client->id}",[
            'names'=>'Angel Alberto',
            'surnames'=>'Torres Espinoza',
            'identification_card'=>'0940113389',
            'birthdate'=>'24-05-1997',
            'address'=>'Milagro',
            'email'=>'',
            'phone'=>'0939932264'
        ])//->assertRedirect("clients/{$client->id}/edit")
            ->assertSessionHasErrors(['email']);

        $this->assertDatabaseMissing('clients',['names'=>'Angel Alberto']);
    }
    /** @test */
    public function the_email_must_be_unique_when_updating_the_product()
    {
        //$this->withoutExceptionHandling();
        factory(Client::class)->create([
            'email'=>'at78725@gmail.com',
        ]);
        $category = factory(Client::class)->create([
            'email'=>'client@example.com',
        ]);
        $this->put("clients/{$category->id}",[
            'email'=>'at78725@gmail.com',
        ])//->assertRedirect("clients/{$category->id}/edit")
            ->assertSessionHasErrors(['email']);
    }
    /** @test */
    public function the_phone_is_required_when_updating_the_client()
    {
        //$this->withoutExceptionHandling();
        $client=factory(Client::class)->create();
        $this->put("/clients/{$client->id}",[
            'names'=>'Angel Alberto',
            'surnames'=>'Torres Espinoza',
            'identification_card'=>'0940113389',
            'birthdate'=>'24-05-1997',
            'address'=>'Milagro',
            'email'=>'at78725@gmail.com',
            'phone'=>''
        ])//->assertRedirect("clients/{$client->id}/edit")
            ->assertSessionHasErrors(['phone']);

        $this->assertDatabaseMissing('clients',['names'=>'Angel Alberto']);
    }
    /** @test */
    public function it_delete_a_product()
    {
        $this->withoutExceptionHandling();

        $client = factory(Client::class)->create([
            'names'=>'Angel Alberto'
        ]);

        $this->delete("clients/{$client->id}/");
            //->assertRedirect('clients');

        $this->assertDatabaseMissing('clients',['names'=>'Angel Alberto']);

    }
}
