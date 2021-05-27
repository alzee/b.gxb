<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210527091410 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE conf CHANGE dividend_fund dividend_fund INT NOT NULL');
        $this->addSql('ALTER TABLE dividend ADD user_id INT DEFAULT NULL, ADD amount INT NOT NULL, ADD coin INT NOT NULL, ADD coin_total INT NOT NULL, ADD fund INT NOT NULL, ADD coin_threshold INT NOT NULL, DROP total, DROP share');
        $this->addSql('ALTER TABLE dividend ADD CONSTRAINT FK_2D0D0909A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('CREATE INDEX IDX_2D0D0909A76ED395 ON dividend (user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE conf CHANGE dividend_fund dividend_fund DOUBLE PRECISION NOT NULL');
        $this->addSql('ALTER TABLE dividend DROP FOREIGN KEY FK_2D0D0909A76ED395');
        $this->addSql('DROP INDEX IDX_2D0D0909A76ED395 ON dividend');
        $this->addSql('ALTER TABLE dividend ADD total DOUBLE PRECISION NOT NULL, ADD share VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, DROP user_id, DROP amount, DROP coin, DROP coin_total, DROP fund, DROP coin_threshold');
    }
}
