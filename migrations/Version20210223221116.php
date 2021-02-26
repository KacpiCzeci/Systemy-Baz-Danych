<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210223221116 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE zwierzeta (id INT AUTO_INCREMENT NOT NULL, gatunek VARCHAR(20) NOT NULL, ilosc NUMERIC(2, 0) NOT NULL, Id_umowy INT DEFAULT NULL, INDEX IDX_DB6C451323833EAE (Id_umowy), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE zwierzeta ADD CONSTRAINT FK_DB6C451323833EAE FOREIGN KEY (Id_umowy) REFERENCES umowy (id)');
        $this->addSql('ALTER TABLE obiekty_najmu CHANGE rodzaj_obiektu rodzaj_obiektu ENUM(\'Mieszkanie\', \'Pokoj\')');
        $this->addSql('ALTER TABLE osoby CHANGE rodzaj_osoby rodzaj_osoby ENUM(\'Lokator\', \'Wynajmujacy\')');
        $this->addSql('ALTER TABLE umowy CHANGE rodzaj_umowy rodzaj_umowy ENUM(\'Krotkoterminowe\', \'Dlugoterminowe\')');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE zwierzeta');
        $this->addSql('ALTER TABLE obiekty_najmu CHANGE rodzaj_obiektu rodzaj_obiektu VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE osoby CHANGE rodzaj_osoby rodzaj_osoby VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE umowy CHANGE rodzaj_umowy rodzaj_umowy VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
