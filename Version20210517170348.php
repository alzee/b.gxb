<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210517170348 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('INSERT INTO `conf` VALUES (1,99999,0.08,0.02,100,1,0.05,1,20,10000,0.001,18.88,1,0.01,100,0)');
        $this->addSql('INSERT INTO `coupon` VALUES (1,500,1,\'任务发布\'),(2,500,2,\'任务置顶\'),(3,500,3,\'任务推荐\'),(4,500,8,\'VIP充值\')');
        $this->addSql('INSERT INTO `equity_fee` VALUES (1,0,0,0.95,0),(2,1,1,0.9,0),(3,3,3,0.85,0),(4,5,10,0.8,0),(5,10,20,0.75,0),(6,20,50,0.7,0),(7,30,60,0.65,0),(8,50,100,0.6,0),(9,80,200,0.55,0),(10,100,300,0.5,0),(11,200,600,0.45,0),(12,300,1000,0.4,0),(13,500,2000,0.35,0),(14,1000,3000,0.3,0),(15,2000,6000,0.25,0),(16,3000,10000,0.2,0),(17,5000,20000,0.15,0)');
        $this->addSql('INSERT INTO `level` VALUES (1,\'体验卡\',10,5,0.1,0.05,2,0,5,2,0.2,0.1,1),(2,\'周卡\',28,5,0.1,0.05,7,0,5,2,0.2,0.1,2),(3,\'月卡\',68,5,0.1,0.05,30,0,5,2,0.25,0.15,3),(4,\'季卡\',188,5,0.1,0.05,90,0,5,2,0.3,0.2,4),(5,\'年卡\',688,5,0.1,0.05,360,0,5,2,0.35,0.25,5),(6,\'银卡\',1288,3,0.1,0.05,720,0,5,2,0.4,0.3,6),(7,\'金卡\',1688,2,0.1,0.05,1080,0,5,2,0.45,0.35,7),(8,\'钻卡\',2688,1,0.1,0.05,1800,0,5,2,0.5,0.4,8),(9,\'普通会员\',0,10,0.15,0.1,0,3,10,5,0.2,0.1,0)');
        $this->addSql('INSERT INTO `node_type` VALUES (1,\'股东大会\'),(2,\'股东话题\'),(3,\'新闻\'),(4,\'条款\')');
        $this->addSql('INSERT INTO `status` VALUES (1,\'待审核\',NULL),(2,\'已审核\',NULL),(3,\'已暂停\',NULL),(4,\'已下架\',NULL),(5,\'审核拒绝\',NULL),(11,\'待提交\',NULL),(12,\'验收中\',NULL),(13,\'不合格\',NULL),(14,\'已完成\',NULL)');

    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
