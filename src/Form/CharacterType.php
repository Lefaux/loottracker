<?php

namespace App\Form;

use App\Entity\Character;
use App\Utility\WowClassUtility;
use App\Utility\WowSpecUtility;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CharacterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('class', ChoiceType::class,
                [
                    'required' => true,
                    'choices' => array_flip(WowClassUtility::toArray())
                ]
            )
            ->add('spec', ChoiceType::class,
                [
                    'required' => true,
                    'choices' => array_flip(WowSpecUtility::toArray())
                ]
            )
            ->add('name', TextType::class, ['required' => true])
            ->add('submit', SubmitType::class, [
                'label' => 'Save',
                'attr' => ['class' => 'btn btn-primary pull-right'],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Character::class,
        ]);
    }
}
