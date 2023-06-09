<?php

namespace App\Form;

use App\Entity\Actor;
use App\Entity\Program;
use App\Repository\ProgramRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Vich\UploaderBundle\Form\Type\VichFileType;


class ActorType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('programs', EntityType::class, [

                'class' => program::class,
                'query_builder' => function (ProgramRepository $er) {
                    return $er->createQueryBuilder('p')
                        ->orderBy('p.title', 'ASC');
                },
            
                'choice_label' => 'title',
            
                'multiple' => true,
            
                'expanded' => true,

                'by_reference' => false,
            
            ])
            ->add('actorFile', VichFileType::class, 
            [
                'required'      => false,

                'allow_delete'  => true, // not mandatory, default is true

                'download_uri' => true, // not mandatory, default is true
            ])
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Actor::class,
        ]);
    }
}
