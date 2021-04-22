<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210422025046 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE equity_trade DROP FOREIGN KEY FK_222DAC4D16C4DD');
        $this->addSql('DROP INDEX IDX_222DAC4D16C4DD ON equity_trade');
        $this->addSql('ALTER TABLE equity_trade DROP shop_id, DROP rate');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE equity_trade ADD shop_id INT NOT NULL, ADD rate DOUBLE PRECISION NOT NULL');
        $this->addSql('ALTER TABLE equity_trade ADD CONSTRAINT FK_222DAC4D16C4DD FOREIGN KEY (shop_id) REFERENCES equity_shop (id)');
        $this->addSql('CREATE INDEX IDX_222DAC4D16C4DD ON equity_trade (shop_id)');
    }
}
