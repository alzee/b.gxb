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
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;

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
            ->add('index', 'detail')
            ->disable('new');
    }

    public function configureFields(string $pageName): iterable
    {
        $descA = TextEditorField::new('descA');
        $picsA = ArrayField::new('picsA');
        $descB = TextEditorField::new('descB');
        $picsB = ArrayField::new('picsB');
        $date = DateTimeField::new('date');
        $status = ChoiceField::new('status')->setChoices(['评审中' => 0, '维权无效' => 1, '维权成功' => 2]);
        $apply = AssociationField::new('apply');
        $id = IntegerField::new('id', 'ID');

        if (Crud::PAGE_INDEX === $pageName) {
            return [$id, $descA, $descB, $date, $status, $apply];
        } elseif (Crud::PAGE_DETAIL === $pageName) {
            return [$id, $descA, $picsA, $descB, $picsB, $date, $status, $apply];
        } elseif (Crud::PAGE_NEW === $pageName) {
            return [$descA, $picsA, $descB, $picsB, $date, $status, $apply];
        } elseif (Crud::PAGE_EDIT === $pageName) {
            return [$status];
        }
    }
}
