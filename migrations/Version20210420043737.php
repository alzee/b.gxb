<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210420043737 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE equity_trade ADD seller_id INT NOT NULL, ADD status SMALLINT NOT NULL');
        $this->addSql('ALTER TABLE equity_trade ADD CONSTRAINT FK_222DAC8DE820D9 FOREIGN KEY (seller_id) REFERENCES `user` (id)');
        $this->addSql('CREATE INDEX IDX_222DAC8DE820D9 ON equity_trade (seller_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE equity_trade DROP FOREIGN KEY FK_222DAC8DE820D9');
        $this->addSql('DROP INDEX IDX_222DAC8DE820D9 ON equity_trade');
        $this->addSql('ALTER TABLE equity_trade DROP seller_id, DROP status');
    }
}
