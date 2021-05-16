<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210516050656 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE conf (id INT AUTO_INCREMENT NOT NULL, equity INT NOT NULL, refer_reward DOUBLE PRECISION NOT NULL, refer_reward2 DOUBLE PRECISION NOT NULL, refer_gxb SMALLINT NOT NULL, mainland_min_price DOUBLE PRECISION NOT NULL, land_min_price DOUBLE PRECISION NOT NULL, mainland_min_days SMALLINT NOT NULL, land_min_days SMALLINT NOT NULL, max_per_day INT NOT NULL, equity_gxbrate DOUBLE PRECISION NOT NULL, equity_price DOUBLE PRECISION NOT NULL, equity_price_max DOUBLE PRECISION NOT NULL, equity_price_min DOUBLE PRECISION NOT NULL, dividend_fund DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE conf');
    }
}
