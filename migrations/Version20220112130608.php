<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220112130608 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE avis (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, car_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, note INT NOT NULL, commentaire LONGTEXT NOT NULL, date_creation DATE NOT NULL, INDEX IDX_8F91ABF0A76ED395 (user_id), INDEX IDX_8F91ABF0C3C6F69F (car_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE car (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, contract_id INT DEFAULT NULL, modele VARCHAR(255) NOT NULL, image LONGTEXT NOT NULL, couleur VARCHAR(255) NOT NULL, immatriculation VARCHAR(255) NOT NULL, annee VARCHAR(255) NOT NULL, kilometrage VARCHAR(255) NOT NULL, marque VARCHAR(255) NOT NULL, tarif_journee DOUBLE PRECISION NOT NULL, essence VARCHAR(255) NOT NULL, disponibilite INT NOT NULL, commentaire LONGTEXT NOT NULL, INDEX IDX_773DE69DA76ED395 (user_id), UNIQUE INDEX UNIQ_773DE69D2576E0FD (contract_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE contract (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, numero_contrat VARCHAR(255) NOT NULL, debut_contrat DATE NOT NULL, fin_contrat DATE NOT NULL, etat_vehicule LONGTEXT NOT NULL, caution DOUBLE PRECISION NOT NULL, prix_location DOUBLE PRECISION NOT NULL, INDEX IDX_E98F2859A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, nom VARCHAR(255) DEFAULT NULL, prenom VARCHAR(255) DEFAULT NULL, login VARCHAR(255) DEFAULT NULL, numero_rue VARCHAR(255) DEFAULT NULL, nomde_rue VARCHAR(255) DEFAULT NULL, code_postal VARCHAR(5) DEFAULT NULL, ville VARCHAR(255) DEFAULT NULL, numero_portable VARCHAR(15) DEFAULT NULL, numero_permis_conduire VARCHAR(12) DEFAULT NULL, annee DATE DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE avis ADD CONSTRAINT FK_8F91ABF0A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE avis ADD CONSTRAINT FK_8F91ABF0C3C6F69F FOREIGN KEY (car_id) REFERENCES car (id)');
        $this->addSql('ALTER TABLE car ADD CONSTRAINT FK_773DE69DA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE car ADD CONSTRAINT FK_773DE69D2576E0FD FOREIGN KEY (contract_id) REFERENCES contract (id)');
        $this->addSql('ALTER TABLE contract ADD CONSTRAINT FK_E98F2859A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE avis DROP FOREIGN KEY FK_8F91ABF0C3C6F69F');
        $this->addSql('ALTER TABLE car DROP FOREIGN KEY FK_773DE69D2576E0FD');
        $this->addSql('ALTER TABLE avis DROP FOREIGN KEY FK_8F91ABF0A76ED395');
        $this->addSql('ALTER TABLE car DROP FOREIGN KEY FK_773DE69DA76ED395');
        $this->addSql('ALTER TABLE contract DROP FOREIGN KEY FK_E98F2859A76ED395');
        $this->addSql('DROP TABLE avis');
        $this->addSql('DROP TABLE car');
        $this->addSql('DROP TABLE contract');
        $this->addSql('DROP TABLE user');
    }
}
