<?php

namespace App\Form\Model;

use Nucleos\ProfileBundle\Form\Model\Registration as BaseRegistration;
use Nucleos\UserBundle\Model\UserInterface;
use Nucleos\UserBundle\Model\UserManagerInterface;

class Registration extends BaseRegistration
{
    /**
     * @var bool|null
     */
    protected $termsAccepted;

    /**
     * @return bool|null
     */
    public function gettermsAccepted(): ?bool
    {
        return $this->termsAccepted;
    }

    /**
     * @param Boolean|null $termsAccepted
     */
    public function setTermsAccepted(?bool $termsAccepted): void
    {
        $this->termsAccepted = $termsAccepted;
    }

    /**
     * @var string|null
     */
    protected $firstname;

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(?string $firstname): void
    {
        $this->firstname = $firstname;
    }

    /**
     * @var string|null
     */
    protected $lastname;

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(?string $lastname): void
    {
        $this->lastname = $lastname;
    }

    public function toUser(UserManagerInterface $manager): UserInterface
    {
        $user = $manager->createUser();
        $user->setFirstname((string) $this->getFirstname());
        $user->setLastname((string) $this->getLastname());
        $user->setEnabled(true);
        $user->setUsername((string) $this->getUsername());
        $user->setEmail((string) $this->getEmail());
        $user->setPlainPassword((string) $this->getPlainPassword());

        return $user;
    }
}