<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220615134903 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE destination (id INT AUTO_INCREMENT NOT NULL, travel_id INT NOT NULL, name VARCHAR(255) NOT NULL, comment VARCHAR(255) DEFAULT NULL, coord_lat DOUBLE PRECISION DEFAULT NULL, coord_lon DOUBLE PRECISION DEFAULT NULL, cover_link VARCHAR(255) NOT NULL, creation_date DATE NOT NULL, start_date DATE DEFAULT NULL, finish_date DATE DEFAULT NULL, INDEX IDX_3EC63EAAECAB15B3 (travel_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE picture (id INT AUTO_INCREMENT NOT NULL, destination_id INT NOT NULL, title VARCHAR(255) DEFAULT NULL, comment VARCHAR(255) DEFAULT NULL, icon VARCHAR(255) DEFAULT NULL, link VARCHAR(255) NOT NULL, creation_date DATE NOT NULL, taking_date DATE DEFAULT NULL, INDEX IDX_16DB4F89816C6140 (destination_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE travel (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, name VARCHAR(255) NOT NULL, comment VARCHAR(255) DEFAULT NULL, icon VARCHAR(255) NOT NULL, creation_date DATE NOT NULL, start_date DATE DEFAULT NULL, finish_date DATE DEFAULT NULL, INDEX IDX_2D0B6BCEA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE destination ADD CONSTRAINT FK_3EC63EAAECAB15B3 FOREIGN KEY (travel_id) REFERENCES travel (id)');
        $this->addSql('ALTER TABLE picture ADD CONSTRAINT FK_16DB4F89816C6140 FOREIGN KEY (destination_id) REFERENCES destination (id)');
        $this->addSql('ALTER TABLE travel ADD CONSTRAINT FK_2D0B6BCEA76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE picture DROP FOREIGN KEY FK_16DB4F89816C6140');
        $this->addSql('ALTER TABLE destination DROP FOREIGN KEY FK_3EC63EAAECAB15B3');
        $this->addSql('DROP TABLE destination');
        $this->addSql('DROP TABLE picture');
        $this->addSql('DROP TABLE travel');
    }
}
