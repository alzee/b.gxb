<?php

namespace App\Controller\Admin;

use App\Entity\EquityFee;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\PercentField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;

class EquityFeeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return EquityFee::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPaginatorPageSize(50)
            // ->setDefaultSort(['id' => 'DESC'])
        ;
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->add('index', Action::DETAIL)
            ->disable('detail')
        ;
    }

    public function configureFields(string $pageName): iterable
    {
        $id = IntegerField::new('id', 'ID');
        $l1 = IntegerField::new('l1');
        $l2 = IntegerField::new('l2');
        $rate = PercentField::new('rate');
        $isStar = BooleanField::new('isStar');

        if (Crud::PAGE_INDEX === $pageName) {
            return [$id, $l1, $l2, $rate, $isStar];
        } elseif (Crud::PAGE_DETAIL === $pageName) {
            return [$id, $l1, $l2, $rate, $isStar];
        } elseif (Crud::PAGE_NEW === $pageName) {
            return [$id, $l1, $l2, $rate, $isStar];
        } elseif (Crud::PAGE_EDIT === $pageName) {
            return [$id, $l1, $l2, $rate, $isStar];
        }
    }
}
