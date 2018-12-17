<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Contact
 *
 * @package App\Entity
 *
 * @ORM\Entity
 * @ORM\Table(name="contacts")
 */
class Contact implements \JsonSerializable
{
    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(type="string", name="first_name")
     */
    private $firstName;

    /**
     * @var string
     *
     * @ORM\Column(type="string", name="last_name")
     */
    private $lastName;

    /**
     * @var string
     *
     * @ORM\Column(type="string", name="email")
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(type="string", name="phone_number")
     */
    private $phoneNumber;

    /**
     * @var string
     *
     * @ORM\Column(type="string", name="ean", length=12)
     */
    private $ean;

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return
            [
                'id' => $this->getId(),
                'firstName' => $this->getFirstName(),
                'lastName' => $this->getLastName(),
                'email' => $this->getEmail(),
                'phoneNumber' => $this->getPhoneNumber(),
            ];
    }

    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set firstName.
     *
     * @param string $firstName
     *
     * @return Contact
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get firstName.
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set lastName.
     *
     * @param string $lastName
     *
     * @return Contact
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get lastName.
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set email.
     *
     * @param string $email
     *
     * @return Contact
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email.
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set phoneNumber.
     *
     * @param string $phoneNumber
     *
     * @return Contact
     */
    public function setPhoneNumber($phoneNumber)
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }

    /**
     * Get phoneNumber.
     *
     * @return string
     */
    public function getPhoneNumber()
    {
        return $this->phoneNumber;
    }

    /**
     * Set ean.
     *
     * @param string $ean
     *
     * @return Contact
     */
    public function setEan($ean)
    {
        $this->ean = $ean;

        return $this;
    }

    /**
     * Get ean.
     *
     * @return string
     */
    public function getEan()
    {
        return $this->ean;
    }
}