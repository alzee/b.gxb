<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210308105339 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE equity_trade DROP FOREIGN KEY FK_222DAC8DE820D9');
        $this->addSql('DROP INDEX IDX_222DAC8DE820D9 ON equity_trade');
        $this->addSql('ALTER TABLE equity_trade CHANGE seller_id shop_id INT NOT NULL');
        $this->addSql('ALTER TABLE equity_trade ADD CONSTRAINT FK_222DAC4D16C4DD FOREIGN KEY (shop_id) REFERENCES equity_shop (id)');
        $this->addSql('CREATE INDEX IDX_222DAC4D16C4DD ON equity_trade (shop_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE equity_trade DROP FOREIGN KEY FK_222DAC4D16C4DD');
        $this->addSql('DROP INDEX IDX_222DAC4D16C4DD ON equity_trade');
        $this->addSql('ALTER TABLE equity_trade CHANGE shop_id seller_id INT NOT NULL');
        $this->addSql('ALTER TABLE equity_trade ADD CONSTRAINT FK_222DAC8DE820D9 FOREIGN KEY (seller_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_222DAC8DE820D9 ON equity_trade (seller_id)');
    }
}
