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
use Tetranz\Select2EntityBundle\Form\Type\Select2EntityType;

class CharacterLootRequirementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('hasItem', ChoiceType::class,
                [
                    'required' => true,
                    'choices' => ['No' => 0, 'Yes' => 1]
                ]
            )
            ->add('item', Select2EntityType::class,
                [
                    'required' => true,
                    'class' => Item::class,
                    'multiple' => false,
                    'minimum_input_length' => 2,
                    'primary_key' => 'id',
                    'text_property' => 'name',
                    'allow_clear' => true,
                    'delay' => 250,
                    'cache' => true,
                    'cache_timeout' => 60000, // if 'cache' is true
                    'placeholder' => 'Select an item',
                    'remote_route' => 'api_select_items',
                    'req_params' => implode(',',$options['slots']),
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
            'slots' => []
        ]);
    }
}
