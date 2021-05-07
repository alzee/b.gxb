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
use EasyCorp\Bundle\EasyAdminBundle\Filter\EntityFilter;

class TaskCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Task::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setSearchFields(['id', 'name', 'title', 'price', 'description', 'quantity', 'bidPosition', 'link', 'note', 'guides', 'reviews', 'workHours', 'reviewHours'])
            ->setPaginatorPageSize(50);
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add(EntityFilter::new('platform'))
            ->add(EntityFilter::new('category'))
            ->add(EntityFilter::new('tag'))
            ->add('quantity');
    }

    public function configureFields(string $pageName): iterable
    {
        $name = TextField::new('name');
        $title = TextField::new('title');
        $price = IntegerField::new('price');
        $description = TextareaField::new('description');
        $prepaid = TextareaField::new('prepaid');
        $owner = AssociationField::new('owner');
        $platform = AssociationField::new('platform');
        $category = AssociationField::new('category');
        $tag = AssociationField::new('tag');
        $quantity = IntegerField::new('quantity');
        $applies = AssociationField::new('applies');
        $showdays = Field::new('showdays');
        $approvedays = Field::new('approvedays');
        $applydays = Field::new('applydays');
        $bidPosition = IntegerField::new('bidPosition');
        $approved = BooleanField::new('approved');
        $id = IntegerField::new('id', 'ID');
        $date = DateTimeField::new('date');
        $link = TextField::new('link');
        $note = TextField::new('note');
        $guides = ArrayField::new('guides');
        $reviews = ArrayField::new('reviews');
        $stickyUntil = DateTimeField::new('stickyUntil');
        $recommendUntil = DateTimeField::new('recommendUntil');
        $showUntil = DateTimeField::new('showUntil');
        $workHours = IntegerField::new('workHours');
        $reviewHours = IntegerField::new('reviewHours');
        $status = AssociationField::new('status');

        if (Crud::PAGE_INDEX === $pageName) {
            return [$id, $title, $price, $prepaid, $owner, $platform, $category, $tag, $quantity, $applies, $approved, $date];
        } elseif (Crud::PAGE_DETAIL === $pageName) {
            return [$id, $name, $title, $price, $description, $quantity, $date, $bidPosition, $link, $note, $guides, $reviews, $stickyUntil, $recommendUntil, $showUntil, $workHours, $reviewHours, $owner, $platform, $category, $tag, $applies, $status];
        } elseif (Crud::PAGE_NEW === $pageName) {
            return [$name, $title, $price, $description, $prepaid, $owner, $platform, $category, $tag, $quantity, $applies, $showdays, $approvedays, $applydays, $bidPosition, $approved];
        } elseif (Crud::PAGE_EDIT === $pageName) {
            return [$name, $title, $price, $description, $prepaid, $owner, $platform, $category, $tag, $quantity, $applies, $showdays, $approvedays, $applydays, $bidPosition, $approved];
        }
    }
}
