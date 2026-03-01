<?php

namespace App\Form;

use App\Entity\Question;
use App\Entity\Lesson;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Length;

class QuestionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('text', TextType::class, [
                'constraints' => [
                    new NotBlank(),
                    new Length(min: 5, max: 255),
                ],
            ])
            ->add('lesson', EntityType::class, [
                'class' => Lesson::class,
                'choice_label' => 'title',
                'constraints' => [
                    new NotBlank(),
                ],
            ])
            ->add('submit', SubmitType::class, ['label' => 'Speichern']);
    }


}