<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210225002738 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE budynki CHANGE adres adres VARCHAR(100) NOT NULL, CHANGE typ typ VARCHAR(100) NOT NULL');
        $this->addSql('ALTER TABLE obiekty_najmu CHANGE rodzaj_obiektu rodzaj_obiektu ENUM(\'Mieszkanie\', \'Pokoj\'), CHANGE Adres Adres VARCHAR(100) DEFAULT NULL');
        $this->addSql('ALTER TABLE osoby CHANGE rodzaj_osoby rodzaj_osoby ENUM(\'Lokator\', \'Wynajmujacy\')');
        $this->addSql('ALTER TABLE umowy CHANGE rodzaj_umowy rodzaj_umowy ENUM(\'Krotkoterminowe\', \'Dlugoterminowe\')');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE budynki CHANGE adres adres VARCHAR(20) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE typ typ VARCHAR(20) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE obiekty_najmu CHANGE rodzaj_obiektu rodzaj_obiektu VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE Adres Adres VARCHAR(20) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE osoby CHANGE rodzaj_osoby rodzaj_osoby VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE umowy CHANGE rodzaj_umowy rodzaj_umowy VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
