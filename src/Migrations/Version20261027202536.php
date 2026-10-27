<?php

declare(strict_types=1);

namespace App\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20261027202536 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__car AS SELECT id, name, color, model FROM car');
        $this->addSql('DROP TABLE car');
        $this->addSql('CREATE TABLE car (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) DEFAULT NULL, color VARCHAR(255) DEFAULT NULL, model VARCHAR(255) DEFAULT NULL, owner_id INTEGER DEFAULT NULL, CONSTRAINT FK_773DE69D7E3C61F9 FOREIGN KEY (owner_id) REFERENCES owner (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO car (id, name, color, model) SELECT id, name, color, model FROM __temp__car');
        $this->addSql('DROP TABLE __temp__car');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_773DE69D7E3C61F9 ON car (owner_id)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__owner AS SELECT id, full_name FROM owner');
        $this->addSql('DROP TABLE owner');
        $this->addSql('CREATE TABLE owner (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, full_name VARCHAR(255) DEFAULT NULL)');
        $this->addSql('INSERT INTO owner (id, full_name) SELECT id, full_name FROM __temp__owner');
        $this->addSql('DROP TABLE __temp__owner');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__car AS SELECT id, name, color, model FROM car');
        $this->addSql('DROP TABLE car');
        $this->addSql('CREATE TABLE car (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) DEFAULT NULL, color VARCHAR(255) DEFAULT NULL, model VARCHAR(255) DEFAULT NULL)');
        $this->addSql('INSERT INTO car (id, name, color, model) SELECT id, name, color, model FROM __temp__car');
        $this->addSql('DROP TABLE __temp__car');
        $this->addSql('CREATE TEMPORARY TABLE __temp__owner AS SELECT id, full_name FROM owner');
        $this->addSql('DROP TABLE owner');
        $this->addSql('CREATE TABLE owner (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, full_name VARCHAR(255) DEFAULT NULL, car_id INTEGER DEFAULT NULL, CONSTRAINT FK_CF60E67CC3C6F69F FOREIGN KEY (car_id) REFERENCES car (id) ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO owner (id, full_name) SELECT id, full_name FROM __temp__owner');
        $this->addSql('DROP TABLE __temp__owner');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_CF60E67CC3C6F69F ON owner (car_id)');
    }
}
