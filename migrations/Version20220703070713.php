<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220703070713 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE reference_size (id INT AUTO_INCREMENT NOT NULL, reference_size INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE size ADD reference_size_id INT DEFAULT NULL, DROP reference_size');
        $this->addSql('ALTER TABLE size ADD CONSTRAINT FK_F7C0246A4EFD0D8F FOREIGN KEY (reference_size_id) REFERENCES reference_size (id)');
        $this->addSql('CREATE INDEX IDX_F7C0246A4EFD0D8F ON size (reference_size_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE size DROP FOREIGN KEY FK_F7C0246A4EFD0D8F');
        $this->addSql('DROP TABLE reference_size');
        $this->addSql('DROP INDEX IDX_F7C0246A4EFD0D8F ON size');
        $this->addSql('ALTER TABLE size ADD reference_size INT NOT NULL, DROP reference_size_id');
    }
}
