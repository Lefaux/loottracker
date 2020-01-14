<?php

namespace App\Form;

use App\Entity\Raid;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class RaidDiscordPingType extends AbstractType
{
    /**
     * @var UrlGeneratorInterface
     */
    private $router;
    public function __construct(UrlGeneratorInterface $router)
    {
        $this->router = $router;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        foreach ($options['raids'] as $raid) {
            $builder
                ->add(
                    'raid_'.$raid['event']->getId(),
                    CheckboxType::class,
                    [
                        'required' => false,
                        'value' => true,
                        'label' => false,
                    ]
                );
        }
        $builder->add(
            'submit',
            SubmitType::class,
            [
                'label' => 'Send Discord Message',
                'attr' => ['class' => 'btn btn-success'],
            ]
        );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'raids' => [],
        ]);
    }
}
