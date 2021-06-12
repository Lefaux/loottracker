<?php

namespace App\Form;

use App\Entity\Character;
use App\Utility\WowClassUtility;
use App\Utility\WowProfessionUtility;
use App\Utility\WowRaceUtility;
use App\Utility\WowSpecUtility;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
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
    /**
     * @var WowProfessionUtility
     */
    private $prof;

    public function __construct(
        WowRaceUtility $wowRaceUtility,
        WowClassUtility $wowClassUtility,
        WowSpecUtility $wowSpecUtility,
        WowProfessionUtility $wowProfessionUtility
    ) {
        $this->race = $wowRaceUtility;
        $this->class = $wowClassUtility;
        $this->spec = $wowSpecUtility;
        $this->prof = $wowProfessionUtility;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, ['required' => true])
            ->add('class', ChoiceType::class,
                [
                    'required' => true,
                    'choices' => array_flip($this->class::toArray())
                ]
            )
            ->add('spec', ChoiceType::class,
                [
                    'required' => true,
                    'choices' => array_flip($this->spec::toArray())
                ]
            )
            ->add('twink', CheckboxType::class,
                [
                    'required' => false,
                ]
            )
            ->add('note', TextType::class,
                [
                    'required' => true,
                    'label' => 'Spec Notes',
                ]
            )
            ->add('race', ChoiceType::class,
                [
                    'required' => true,
                    'choices' => array_flip($this->race::toArray())
                ]
            )
            ->add('profession1', ChoiceType::class,
                [
                    'required' => true,
                    'label' => 'Profession A',
                    'choices' => array_flip($this->prof::toArray())
                ]
            )
            ->add('profession1skill', IntegerType::class,
                [
                    'required' => true,
                    'label' => 'Profession A Skill Level',
                ]
            )
            ->add('profession2', ChoiceType::class,
                [
                    'required' => true,
                    'label' => 'Profession B',
                    'choices' => array_flip($this->prof::toArray())
                ]
            )
            ->add('profession2skill', IntegerType::class,
                [
                    'required' => true,
                    'label' => 'Profession B Skill Level',
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
            'data_class' => Character::class,
        ]);
    }
}
