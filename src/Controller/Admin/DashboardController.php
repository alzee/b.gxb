<?php

namespace App\Controller\Admin;

use App\Entity\Bid;
use App\Entity\Category;
use App\Entity\Dividend;
use App\Entity\Equity;
use App\Entity\EquityFee;
use App\Entity\Finance;
use App\Entity\LandPost;
use App\Entity\LandTrade;
use App\Entity\Level;
use App\Entity\Node;
use App\Entity\NodeType;
use App\Entity\Report;
use App\Entity\Tag;
use App\Entity\Task;
use App\Entity\User;
use App\Entity\Vip;
use App\Entity\Conf;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

class DashboardController extends AbstractDashboardController
{
    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('达人共享宝');
    }

    public function configureCrud(): Crud
    {
        return Crud::new()
            ->setDateTimeFormat('yyyy/MM/dd HH:mm');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToCrud('task', 'fas fa-tasks', Task::class);
        yield MenuItem::linkToCrud('tag', 'fas fa-tags', Tag::class);
        yield MenuItem::linkToCrud('category', 'fas fa-th-large', Category::class);
        yield MenuItem::linkToCrud('bid', 'fas fa-hand-paper', Bid::class);
        yield MenuItem::linkToCrud('dividend', 'fas fa-gift', Dividend::class);
        yield MenuItem::linkToCrud('landtrade', 'fas fa-square', LandTrade::class);
        yield MenuItem::linkToCrud('landpost', 'fas fa-square', LandPost::class);
        yield MenuItem::linkToCrud('equity', 'fas fa-university', Equity::class);
        yield MenuItem::linkToCrud('equityFee', 'fas fa-university', EquityFee::class);
        yield MenuItem::linkToCrud('node', 'fas fa-file-alt', Node::class);
        yield MenuItem::linkToCrud('nodetype', 'fas fa-file-alt', NodeType::class);
        yield MenuItem::linkToCrud('user', 'fas fa-user', User::class);
        yield MenuItem::linkToCrud('vip', 'fas fa-user-circle', Vip::class);
        yield MenuItem::linkToCrud('level', 'far fa-gem', Level::class);
        yield MenuItem::linkToCrud('finance', 'fas fa-dollar-sign', Finance::class);
        yield MenuItem::linkToCrud('report', 'fas fa-flag', Report::class);
        yield MenuItem::linkToCrud('conf', 'fas fa-cog', Conf::class)->setAction('detail')->setEntityId(1);
    }
}
