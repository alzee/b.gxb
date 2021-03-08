<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210308083231 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE equity_trade (id INT AUTO_INCREMENT NOT NULL, seller_id INT NOT NULL, buyer_id INT NOT NULL, equity INT NOT NULL, rmb INT NOT NULL, rate DOUBLE PRECISION NOT NULL, INDEX IDX_222DAC8DE820D9 (seller_id), INDEX IDX_222DAC6C755722 (buyer_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE exchange (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, equity INT NOT NULL, date DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', gxb INT NOT NULL, INDEX IDX_D33BB079A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE equity_trade ADD CONSTRAINT FK_222DAC8DE820D9 FOREIGN KEY (seller_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE equity_trade ADD CONSTRAINT FK_222DAC6C755722 FOREIGN KEY (buyer_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE exchange ADD CONSTRAINT FK_D33BB079A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE land_trade ADD date DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE equity_trade');
        $this->addSql('DROP TABLE exchange');
        $this->addSql('ALTER TABLE land_trade DROP date');
    }
}
