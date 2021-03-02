<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210302200705 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE obiekty_najmu DROP FOREIGN KEY FK_9C29F4DB9106E5EA');
        $this->addSql('ALTER TABLE obiekty_najmu CHANGE rodzaj_obiektu rodzaj_obiektu ENUM(\'Mieszkanie\', \'Pokój\')');
        $this->addSql('DROP INDEX idx_9c29f4db9106e5ea ON obiekty_najmu');
        $this->addSql('CREATE INDEX Adres_idx ON obiekty_najmu (Adres)');
        $this->addSql('ALTER TABLE obiekty_najmu ADD CONSTRAINT FK_9C29F4DB9106E5EA FOREIGN KEY (Adres) REFERENCES budynki (adres)');
        $this->addSql('ALTER TABLE umowy CHANGE rodzaj_umowy rodzaj_umowy ENUM(\'Krótkoterminowe\', \'Długoterminowe\')');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE obiekty_najmu DROP FOREIGN KEY FK_9C29F4DB9106E5EA');
        $this->addSql('ALTER TABLE obiekty_najmu CHANGE rodzaj_obiektu rodzaj_obiektu VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('DROP INDEX adres_idx ON obiekty_najmu');
        $this->addSql('CREATE INDEX IDX_9C29F4DB9106E5EA ON obiekty_najmu (Adres)');
        $this->addSql('ALTER TABLE obiekty_najmu ADD CONSTRAINT FK_9C29F4DB9106E5EA FOREIGN KEY (Adres) REFERENCES budynki (adres)');
        $this->addSql('ALTER TABLE umowy CHANGE rodzaj_umowy rodzaj_umowy VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
