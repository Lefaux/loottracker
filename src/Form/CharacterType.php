<?php

namespace App\Form;

use App\Entity\Character;
use App\Utility\WowClassUtility;
use App\Utility\WowRaceUtility;
use App\Utility\WowSpecUtility;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CharacterType extends AbstractType
{
    /**
     * @var WowRaceUtility
     */
    private $race;
    /**
     * @var WowClassUtility
     */
    private $class;
    /**
     * @var WowSpecUtility
     */
    private $spec;

    public function __construct(WowRaceUtility $wowRaceUtility, WowClassUtility $wowClassUtility, WowSpecUtility $wowSpecUtility)
    {
        $this->race = $wowRaceUtility;
        $this->class = $wowClassUtility;
        $this->spec = $wowSpecUtility;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('class', ChoiceType::class,
                [
                    'required' => true,
                    'choices' => array_flip($this->class::toArray())
                ]
            )
            ->add('spec', ChoiceType::class,
                [
                    'required' => true,
                    'choices' => array_flip(WowSpecUtility::toArray())
                ]
            )
            ->add('race', ChoiceType::class,
                [
                    'required' => true,
                    'choices' => array_flip(WowRaceUtility::toArray())
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
