<?php

namespace App\Form;

use App\Entity\Comment;
use App\Entity\Episode;
use App\Repository\EpisodeRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CommentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('comment')
            ->add('rate')
            ->add('user', null, ['choice_label' => 'email'])
            ->add('episode', null, [
                'by_reference' => false,
                'class' => Episode::class,
                'query_builder' => function (EpisodeRepository $e) {
                    return $e->createQueryBuilder('e')
                        ->orderBy('e.title', 'ASC');
                },
                'choice_label' => 'title',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Comment::class,
        ]);
    }
}
