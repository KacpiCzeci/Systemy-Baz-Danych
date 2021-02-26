<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210225205539 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE obiekty_najmu CHANGE rodzaj_obiektu rodzaj_obiektu ENUM(\'Mieszkanie\', \'Pokój\')');
        $this->addSql('ALTER TABLE osoby CHANGE imie imie VARCHAR(100) NOT NULL, CHANGE nazwisko nazwisko VARCHAR(100) NOT NULL, CHANGE adres adres VARCHAR(100) NOT NULL, CHANGE email email VARCHAR(100) DEFAULT NULL, CHANGE rodzaj_osoby rodzaj_osoby ENUM(\'Lokator\', \'Wynajmujacy\')');
        $this->addSql('ALTER TABLE umowy CHANGE rodzaj_umowy rodzaj_umowy ENUM(\'Krótkoterminowe\', \'Długoterminowe\')');
        $this->addSql('ALTER TABLE zwierzeta CHANGE gatunek gatunek VARCHAR(100) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE obiekty_najmu CHANGE rodzaj_obiektu rodzaj_obiektu VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE osoby CHANGE imie imie VARCHAR(20) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE nazwisko nazwisko VARCHAR(20) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE adres adres VARCHAR(20) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE email email VARCHAR(20) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE rodzaj_osoby rodzaj_osoby VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE umowy CHANGE rodzaj_umowy rodzaj_umowy VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE zwierzeta CHANGE gatunek gatunek VARCHAR(20) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
