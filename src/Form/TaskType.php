<?php

namespace App\Form;

use App\Entity\Deliverable;
use App\Entity\Project;
use App\Entity\Task;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TaskType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('description')
            ->add('due_date', null, [
                'widget' => 'single_text',
            ])
            ->add('status')
            ->add('project', EntityType::class, [
                'class' => Project::class,
                'choice_label' => 'id',
            ])
            ->add('deliverable', EntityType::class, [
                'class' => Deliverable::class,
                'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Task::class,
        ]);
    }
}
