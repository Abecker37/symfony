<?php

namespace App\Form;

use App\Entity\Actor;
use App\Entity\Program;
use App\Repository\ActorRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class ProgramType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title',TextType::class)
            ->add('synopsis',TextType::class)
            ->add('poster')
            ->add('country',TextType::class)
            ->add('year')
            ->add('category', null, ['choice_label' => 'name']);
            $builder->add('actors', EntityType::class, [

                'class' => Actor::class,
                'query_builder' => function (ActorRepository $er) {
                    return $er->createQueryBuilder('a')
                        ->orderBy('a.name', 'ASC');
                },
            
                'choice_label' => 'name',
            
                'multiple' => true,
            
                'expanded' => true,

                'by_reference' => false,
            
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Program::class,
        ]);
    }
}
