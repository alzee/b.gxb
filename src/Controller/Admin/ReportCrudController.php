<?php

namespace App\Controller\Admin;

use App\Entity\Report;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ReportCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Report::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle(Crud::PAGE_INDEX, '举报记录')
            ->setSearchFields(['id', 'descA', 'picsA', 'descB', 'picsB', 'status'])
            ->setPaginatorPageSize(50);
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->disable('new');
    }

    public function configureFields(string $pageName): iterable
    {
        $descA = TextField::new('descA');
        $picsA = ArrayField::new('picsA');
        $descB = TextField::new('descB');
        $picsB = ArrayField::new('picsB');
        $date = DateTimeField::new('date');
        $status = IntegerField::new('status');
        $apply = AssociationField::new('apply');
        $id = IntegerField::new('id', 'ID');

        if (Crud::PAGE_INDEX === $pageName) {
            return [$id, $descA, $descB, $date, $status, $apply];
        } elseif (Crud::PAGE_DETAIL === $pageName) {
            return [$id, $descA, $picsA, $descB, $picsB, $date, $status, $apply];
        } elseif (Crud::PAGE_NEW === $pageName) {
            return [$descA, $picsA, $descB, $picsB, $date, $status, $apply];
        } elseif (Crud::PAGE_EDIT === $pageName) {
            return [$descA, $picsA, $descB, $picsB, $date, $status, $apply];
        }
    }
}
