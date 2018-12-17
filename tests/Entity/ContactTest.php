<?php
// .\vendor\bin\phpunit tests\Entity\ContactTest (WIN)
// ./vendor/bin/phpunit tests/Entity/ContactTest (Unix)

namespace Tests\Entity;

use App\Entity\Contact;
use Doctrine\Common\Collections\ArrayCollection;
use Tests\BaseTestCase;

/**
 * Class ContactTest
 *
 * @package Tests\Entity
 * @author Dariusz Dawidowicz <d.dawidowicz@rusin.info>
 */
class ContactTest extends BaseTestCase
{

    /**
     * The setUp() and tearDown() template methods are run once for each test method (and on fresh instances) of the test case class.
     */
    protected function setUp()
    {
        $contact = new Contact();

        $contact->setFirstName("Jan");
        $contact->setLastName("Kowalski");
        $contact->setEmail("jan.kowalski@example.com");
        $contact->setPhoneNumber("123456789");

        self::$em->persist($contact);
        self::$em->flush();
    }

    /**
     * Testujemy tworzenie nowego kontaktu
     *
     * .\vendor\bin\phpunit --filter testCreate tests\Entity\ContactTest (WIN)
     * ./vendor/bin/phpunit --filter testCreate tests/Entity/ContactTest (Unix)
     */
    public function testCreate(): void
    {
        $contacts = self::$em->getRepository(Contact::class)->findAll();
        /* @var $contacts ArrayCollection */

        $this->assertCount(1, $contacts);

        $contact = self::$em->getRepository(Contact::class)->findOneBy(['lastName' => 'Kowalski']);
        /* @var $contact Contact */

        $this->assertInstanceOf(Contact::class, $contact);
        $this->assertEquals('123456789', $contact->getPhoneNumber());
    }

    /**
     *
     */
    protected function tearDown()
    {
        self::$em
            ->getRepository(Contact::class)
            ->createQueryBuilder('c')
            ->delete()
            ->getQuery()
            ->execute();
    }
}