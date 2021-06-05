<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210604130736 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE engine_types (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE engines (id INT AUTO_INCREMENT NOT NULL, engine_types_id INT DEFAULT NULL, name VARCHAR(1000) NOT NULL, displacement INT NOT NULL, power INT NOT NULL, INDEX IDX_88EF988C5440B82A (engine_types_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE engines ADD CONSTRAINT FK_88EF988C5440B82A FOREIGN KEY (engine_types_id) REFERENCES engine_types (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE engines DROP FOREIGN KEY FK_88EF988C5440B82A');
        $this->addSql('DROP TABLE engine_types');
        $this->addSql('DROP TABLE engines');
    }
}
