<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210604132643 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE car_bodys (id INT AUTO_INCREMENT NOT NULL, width INT NOT NULL, height INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cars (id INT AUTO_INCREMENT NOT NULL, marks_id INT DEFAULT NULL, engines_id INT DEFAULT NULL, car_bodys_id INT DEFAULT NULL, name VARCHAR(1000) NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_95C71D144B8FD494 (marks_id), INDEX IDX_95C71D14743D8A7 (engines_id), INDEX IDX_95C71D148209AD05 (car_bodys_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE marks (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE cars ADD CONSTRAINT FK_95C71D144B8FD494 FOREIGN KEY (marks_id) REFERENCES marks (id)');
        $this->addSql('ALTER TABLE cars ADD CONSTRAINT FK_95C71D14743D8A7 FOREIGN KEY (engines_id) REFERENCES engines (id)');
        $this->addSql('ALTER TABLE cars ADD CONSTRAINT FK_95C71D148209AD05 FOREIGN KEY (car_bodys_id) REFERENCES car_bodys (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cars DROP FOREIGN KEY FK_95C71D148209AD05');
        $this->addSql('ALTER TABLE cars DROP FOREIGN KEY FK_95C71D144B8FD494');
        $this->addSql('DROP TABLE car_bodys');
        $this->addSql('DROP TABLE cars');
        $this->addSql('DROP TABLE marks');
    }
}
