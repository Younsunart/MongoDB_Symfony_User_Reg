<?php

namespace App\Document;

use Doctrine\Bundle\MongoDBBundle\Validator\Constraints\Unique as MongoDBUnique;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Symfony\Component\Validator\Constraints as Assert;
use Nucleos\UserBundle\Model\User as BaseUser;

/**
 * @MongoDB\Document
 */
class User extends BaseUser
{
    /**
     * @MongoDB\Id(strategy="auto")
     */
    protected $id;

    public function setId(string $id): void
    {
        $this->id = $id;
    }

    /**
     * @MongoDB\Field(type="string")
     * @Assert\NotBlank()
     */
    protected $firstname;

    public function setFirstname(string $firstname): void
    {
        $this->firstname = $firstname;
    }

    /**
     * @MongoDB\Field(type="string")
     * @Assert\NotBlank()
     */
    protected $lastname;

    public function setLastname(string $lastname): void
    {
        $this->lastname = $lastname;
    }

}