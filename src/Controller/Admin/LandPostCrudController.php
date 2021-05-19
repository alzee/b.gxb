<?php

namespace App\Controller\Admin;

use App\Entity\LandPost;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;

class LandPostCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return LandPost::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle(Crud::PAGE_INDEX, '领地广告')
            ->setSearchFields(['id', 'price', 'days', 'title', 'body', 'cover', 'pics'])
            ->setDefaultSort(['id' => 'DESC'])
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
        $price = MoneyField::new('price')->setCurrency('CNY');
        $days = IntegerField::new('days');
        $title = TextField::new('title');
        $body = TextEditorField::new('body');
        $cover = ImageField::new('cover');
        $pics = ArrayField::new('pics')->setTemplatePath('t.html.twig');
        $date = DateTimeField::new('date');
        $land = AssociationField::new('land');
        $owner = AssociationField::new('owner');
        $id = IntegerField::new('id', 'ID');

        if (Crud::PAGE_INDEX === $pageName) {
            return [$id, $price, $days, $title, $land,  $body, $date];
        } elseif (Crud::PAGE_DETAIL === $pageName) {
            return [$id, $price, $days, $title, $body, $cover, $pics, $date, $land, $owner];
        } elseif (Crud::PAGE_NEW === $pageName) {
            return [$price, $days, $title, $body, $cover, $pics, $date, $land, $owner];
        } elseif (Crud::PAGE_EDIT === $pageName) {
            return [$price, $days, $title, $body];
        }
    }
}
