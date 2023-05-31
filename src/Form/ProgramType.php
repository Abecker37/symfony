<?php

namespace App\Form;

use App\Entity\Actor;
use App\Entity\Program;
use App\Repository\ActorRepository;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Vich\UploaderBundle\Form\Type\VichFileType;
class ProgramType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title',TextType::class)
            ->add('synopsis',TextType::class)
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
            
            ])
            ->add('posterFile', VichFileType::class, 
            [

                'required'      => false,

                'allow_delete'  => true, // not mandatory, default is true

                'download_uri' => true, // not mandatory, default is true
            ])
            ->addEventListener(FormEvents::SUBMIT, function (FormEvent $event) {
                $program = $event->getData();
                if (null !== $program->getTitle()) {
                    $program->setSlug($program->getTitle());
                }
            })
            ->getForm();
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Program::class,
        ]);
    }
}
