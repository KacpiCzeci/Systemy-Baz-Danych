<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210301025257 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE budynki (adres VARCHAR(100) NOT NULL, typ VARCHAR(100) NOT NULL, Nazwa VARCHAR(100) NOT NULL, INDEX IDX_5001ADE1A1D6D22A (Nazwa), PRIMARY KEY(adres)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE obiekty_najmu (mieszkanie INT AUTO_INCREMENT NOT NULL, nr_mieszkania NUMERIC(3, 0) NOT NULL, powierzchnia NUMERIC(7, 2) NOT NULL, rodzaj_obiektu ENUM(\'Mieszkanie\', \'Pokój\'), liczba_pokoi NUMERIC(2, 0) DEFAULT NULL, typ_mieszkania VARCHAR(100) DEFAULT NULL, nr_pokoju NUMERIC(3, 0) DEFAULT NULL, Adres VARCHAR(100) DEFAULT NULL, INDEX IDX_9C29F4DB9106E5EA (Adres), PRIMARY KEY(mieszkanie)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE osoby (pesel VARCHAR(11) NOT NULL, imie VARCHAR(100) NOT NULL, nazwisko VARCHAR(100) NOT NULL, nr_telefonu VARCHAR(9) NOT NULL, adres VARCHAR(100) NOT NULL, email VARCHAR(100) DEFAULT NULL, rodzaj_osoby ENUM(\'Lokator\', \'Wynajmujacy\'), PRIMARY KEY(pesel)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE spoldzielnie (nazwa VARCHAR(100) NOT NULL, adres VARCHAR(100) NOT NULL, nr_telefonu NUMERIC(9, 0) NOT NULL, PRIMARY KEY(nazwa)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE umowy (id INT AUTO_INCREMENT NOT NULL, nr_umowy VARCHAR(100) NOT NULL, wynajem_od DATE NOT NULL, wynajem_do DATE NOT NULL, data_zawarcia_umowy DATE NOT NULL, rodzaj_umowy ENUM(\'Krótkoterminowe\', \'Długoterminowe\'), Lokator VARCHAR(11) DEFAULT NULL, Wynajmujacy VARCHAR(11) DEFAULT NULL, Mieszkanie INT DEFAULT NULL, INDEX IDX_34701DC8858B0C32 (Lokator), INDEX IDX_34701DC868A70A16 (Wynajmujacy), INDEX IDX_34701DC831EAEC7E (Mieszkanie), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE wyposazenie (id INT AUTO_INCREMENT NOT NULL, nazwa VARCHAR(100) NOT NULL, ilosc NUMERIC(2, 0) NOT NULL, Mieszkanie INT DEFAULT NULL, INDEX IDX_25B6630931EAEC7E (Mieszkanie), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE zwierzeta (id INT AUTO_INCREMENT NOT NULL, gatunek VARCHAR(100) NOT NULL, ilosc NUMERIC(2, 0) NOT NULL, Id_umowy INT DEFAULT NULL, INDEX IDX_DB6C451323833EAE (Id_umowy), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE budynki ADD CONSTRAINT FK_5001ADE1A1D6D22A FOREIGN KEY (Nazwa) REFERENCES spoldzielnie (nazwa)');
        $this->addSql('ALTER TABLE obiekty_najmu ADD CONSTRAINT FK_9C29F4DB9106E5EA FOREIGN KEY (Adres) REFERENCES budynki (adres)');
        $this->addSql('ALTER TABLE umowy ADD CONSTRAINT FK_34701DC8858B0C32 FOREIGN KEY (Lokator) REFERENCES osoby (pesel)');
        $this->addSql('ALTER TABLE umowy ADD CONSTRAINT FK_34701DC868A70A16 FOREIGN KEY (Wynajmujacy) REFERENCES osoby (pesel)');
        $this->addSql('ALTER TABLE umowy ADD CONSTRAINT FK_34701DC831EAEC7E FOREIGN KEY (Mieszkanie) REFERENCES obiekty_najmu (mieszkanie)');
        $this->addSql('ALTER TABLE wyposazenie ADD CONSTRAINT FK_25B6630931EAEC7E FOREIGN KEY (Mieszkanie) REFERENCES obiekty_najmu (mieszkanie)');
        $this->addSql('ALTER TABLE zwierzeta ADD CONSTRAINT FK_DB6C451323833EAE FOREIGN KEY (Id_umowy) REFERENCES umowy (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE obiekty_najmu DROP FOREIGN KEY FK_9C29F4DB9106E5EA');
        $this->addSql('ALTER TABLE umowy DROP FOREIGN KEY FK_34701DC831EAEC7E');
        $this->addSql('ALTER TABLE wyposazenie DROP FOREIGN KEY FK_25B6630931EAEC7E');
        $this->addSql('ALTER TABLE umowy DROP FOREIGN KEY FK_34701DC8858B0C32');
        $this->addSql('ALTER TABLE umowy DROP FOREIGN KEY FK_34701DC868A70A16');
        $this->addSql('ALTER TABLE budynki DROP FOREIGN KEY FK_5001ADE1A1D6D22A');
        $this->addSql('ALTER TABLE zwierzeta DROP FOREIGN KEY FK_DB6C451323833EAE');
        $this->addSql('DROP TABLE budynki');
        $this->addSql('DROP TABLE obiekty_najmu');
        $this->addSql('DROP TABLE osoby');
        $this->addSql('DROP TABLE spoldzielnie');
        $this->addSql('DROP TABLE umowy');
        $this->addSql('DROP TABLE wyposazenie');
        $this->addSql('DROP TABLE zwierzeta');
    }
}
