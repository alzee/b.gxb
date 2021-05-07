<?php

namespace App\Controller\Admin;

use App\Entity\Bid;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;

class BidCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Bid::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle(Crud::PAGE_INDEX, '竞价记录')
            ->setSearchFields(['id', 'price', 'position'])
            ->setPaginatorPageSize(50);
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->disable('new');
    }

    public function configureFields(string $pageName): iterable
    {
        $price = IntegerField::new('price');
        $position = IntegerField::new('position');
        $date = DateTimeField::new('date');
        $isBuyNow = Field::new('isBuyNow');
        $task = AssociationField::new('task');
        $id = IntegerField::new('id', 'ID');

        if (Crud::PAGE_INDEX === $pageName) {
            return [$id, $price, $position, $date, $isBuyNow, $task];
        } elseif (Crud::PAGE_DETAIL === $pageName) {
            return [$id, $price, $position, $date, $isBuyNow, $task];
        } elseif (Crud::PAGE_NEW === $pageName) {
            return [$price, $position, $date, $isBuyNow, $task];
        } elseif (Crud::PAGE_EDIT === $pageName) {
            return [$price, $position, $date, $isBuyNow, $task];
        }
    }
}
