<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class RegisterUserTest extends WebTestCase
{
    public function testSomething(): void
    {
        $client = static::createClient();

        $client->request('GET', '/Inscription');

        $client->submitForm('register_user_type_form[submit]', [

            'register_user_type_form[user_email]' => 'John@Doe.fr',
            'register_user_type_form[user_pseudo]' => 'John Doe',
            'register_user_type_form[plainPassword][first]' => '159753Aq.MpH@r!B0',
            'register_user_type_form[plainPassword][second]' => '159753Aq.MpH@r!B0'

        ]);

        $this->assertResponseRedirects('/Connexion');
        $client->followRedirect();

        $this->assertSelectorExists('div:contains("Votre compte est bien créé, vous pouvez vous connecter.")');

    }
}
