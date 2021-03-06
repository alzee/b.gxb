<?php

namespace App\Controller\Admin;

use App\Entity\Task;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Filter\EntityFilter;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Dto\EntityDto;
use EasyCorp\Bundle\EasyAdminBundle\Config\KeyValueStore;
use EasyCorp\Bundle\EasyAdminBundle\Context\AdminContext;
use Symfony\Component\Form\FormInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Status;

class TaskCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Task::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setSearchFields(['id', 'name', 'title', 'price', 'description', 'quantity', 'link', 'note', 'workHours', 'reviewHours'])
            ->setPaginatorPageSize(50)
            ->setDefaultSort(['id' => 'DESC'])
        ;
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add(EntityFilter::new('category'))
            ->add(EntityFilter::new('status'))
        ;
    }

    public function configureFields(string $pageName): iterable
    {
        $statuses = $this->getDoctrine()->getRepository(Status::class)->getTaskStatuses();
        $name = TextField::new('name');
        $title = TextField::new('title');
        $price = MoneyField::new('price')->setCurrency('CNY');
        $description = TextEditorField::new('description');
        $owner = AssociationField::new('owner');
        $category = AssociationField::new('category');
        $tag = AssociationField::new('tag');
        $quantity = IntegerField::new('quantity');
        $applies = AssociationField::new('applies');
        $id = IntegerField::new('id', 'ID');
        $date = DateTimeField::new('date');
        $link = TextField::new('link');
        $note = TextField::new('note');
        $guides = ArrayField::new('guides')->setTemplatePath('tt.html.twig');
        $reviews = ArrayField::new('reviews')->setTemplatePath('tt.html.twig');
        $stickyUntil = DateTimeField::new('stickyUntil');
        $recommendUntil = DateTimeField::new('recommendUntil');
        $workHours = IntegerField::new('workHours');
        $reviewHours = IntegerField::new('reviewHours');
        $status = AssociationField::new('status')->setFormTypeOptions(["choices" => $statuses]);
        $opinion = TextField::new('opinion');

        if (Crud::PAGE_INDEX === $pageName) {
            return [$id, $name, $title, $price, $owner, $category, $date, $status];
        } elseif (Crud::PAGE_DETAIL === $pageName) {
            return [$id, $name, $title, $price, $description, $quantity, $date, $link, $note, $guides, $reviews, $workHours, $reviewHours, $owner, $category, $tag, $applies, $status, $opinion];
        } elseif (Crud::PAGE_NEW === $pageName) {
            return [$name, $title, $price, $description, $owner, $category, $tag, $quantity, $applies];
        } elseif (Crud::PAGE_EDIT === $pageName) {
            return [$name, $title, $description, $category, $tag, $status, $opinion];
        }
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->add('index', Action::DETAIL)
            ->disable('new')
        ;
    }

    public function createEditForm(EntityDto $entityDto, KeyValueStore $formOptions, AdminContext $context): FormInterface
    {
        $b = $this->createEditFormBuilder($entityDto, $formOptions, $context);
        $f = $b->getForm();
        if ($f->get('status')->getData()->getId() > 1) {
            $b->add('status', EntityType::class, ['class' => Status::class, 'disabled' => true]);
            $f = $b->getForm();
        }
        return $f;
    }
}
