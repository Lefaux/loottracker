<?php

namespace App\Form;

use App\Entity\Character;
use App\Entity\CharacterLootRequirement;
use App\Entity\Item;
use App\Enum\Slots;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CharacterLootRequirementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('priority', ChoiceType::class,
                [
                    'required' => true,
                    'choices' => array_flip(CharacterLootRequirement::PRIORITIES),
                ]
            )
            ->add('hasItem', ChoiceType::class,
                [
                    'required' => true,
                    'choices' => ['No' => 0, 'Yes' => 1]
                ]
            )
            ->add('slot', ChoiceType::class,
                [
                    'required' => true,
                    'choices' => array_flip(Slots::SLOTS)
                ]
            )
            ->add('item', EntityType::class,
                [
                    'required' => true,
                    'class' => Item::class,
                ]
            )
            ->add('playerCharacter', EntityType::class,
                [
                    'required' => true,
                    'class' => Character::class,
                    'query_builder' => static function (EntityRepository $er) use ($options) {
                            return $er->createQueryBuilder('c')
                                ->where('c.account = :account')
                                ->setParameter('account', $options['user']->getId())
                                ->orderBy('c.name', 'ASC');
                        },
                ]
            )
            ->add('submit', SubmitType::class, [
                'label' => 'Save',
                'attr' => ['class' => 'btn btn-primary pull-right'],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => CharacterLootRequirement::class,
            'user' => null,
        ]);
    }
}
