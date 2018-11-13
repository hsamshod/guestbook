<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CommentControllerTest extends WebTestCase
{
    public function testStore()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/store');
    }

}
