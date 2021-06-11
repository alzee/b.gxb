<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210611011054 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE vip');
        $this->addSql('DROP TABLE work');
        $this->addSql('ALTER TABLE apply ADD approved_at DATETIME DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE vip (id INT AUTO_INCREMENT NOT NULL, uid_id INT DEFAULT NULL, level VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, date DATETIME NOT NULL, days INT NOT NULL, UNIQUE INDEX UNIQ_4B076C22534B549B (uid_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE work (id INT AUTO_INCREMENT NOT NULL, apply_id INT DEFAULT NULL, img_url VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_534E68804DDCCBDE (apply_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE vip ADD CONSTRAINT FK_4B076C22534B549B FOREIGN KEY (uid_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE work ADD CONSTRAINT FK_534E68804DDCCBDE FOREIGN KEY (apply_id) REFERENCES apply (id)');
        $this->addSql('ALTER TABLE apply DROP approved_at');
    }
}
