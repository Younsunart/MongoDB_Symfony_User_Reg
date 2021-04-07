<?php

/*
 * This file is part of the NucleosProfileBundle package.
 *
 * (c) Christian Gripp <mail@core23.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Form\Type;

use Nucleos\ProfileBundle\Form\Model\Registration;
use Nucleos\ProfileBundle\Form\Type\RegistrationFormType;
use Nucleos\UserBundle\Model\UserInterface;
use Nucleos\UserBundle\Model\UserManagerInterface;
use PHPUnit\Framework\MockObject\MockObject;
use Symfony\Component\Form\Extension\Validator\ViolationMapper\ViolationMapper;
use Symfony\Component\Validator\ConstraintViolationList;
use Symfony\Component\Validator\Validator\ValidatorInterface;

final class RegistrationType extends ValidatorExtensionTypeTestCase
{
    /**
     * @var MockObject&UserManagerInterface
     */
    private $userManager;

    /**
     * @var MockObject&ValidatorInterface
     */
    private $validator;

    /**
     * @var MockObject&ViolationMapper
     */
    private $violationMapper;

    protected function setUp(): void
    {
        $this->userManager     = $this->createMock(UserManagerInterface::class);
        $this->validator       = $this->createMock(ValidatorInterface::class);
        $this->violationMapper = $this->createMock(ViolationMapper::class);

        parent::setUp();
    }

    public function testSubmit(): void
    {
        $registration = new Registration();

        $user = $this->createMock(UserInterface::class);

        $this->userManager->method('createUser')->willReturn($user);

        $this->validator->method('validate')->with($user, null, [])
            ->willReturn(new ConstraintViolationList())
        ;

        $form     = $this->factory->create(RegistrationFormType::class, $registration);
        $formData = [
            'username'      => 'bar',
            'email'         => 'john@doe.com',
            'plainPassword' => [
                'first'  => 'test',
                'second' => 'test',
            ],
        ];
        $form->submit($formData);

        static::assertTrue($form->isSynchronized());
        static::assertSame($registration, $form->getData());
        static::assertSame('bar', $registration->getUsername());
        static::assertSame('john@doe.com', $registration->getEmail());
        static::assertSame('test', $registration->getPlainPassword());
    }

    /**
     * @return mixed[]
     */
    protected function getTypes(): array
    {
        return array_merge(
            parent::getTypes(),
            [
                new RegistrationFormType(
                    Registration::class,
                    $this->userManager,
                    $this->validator
                ),
            ]
        );
    }
}