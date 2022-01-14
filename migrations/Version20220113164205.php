<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220113164205 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE car DROP FOREIGN KEY FK_773DE69D2576E0FD');
        $this->addSql('DROP INDEX UNIQ_773DE69D2576E0FD ON car');
        $this->addSql('ALTER TABLE car DROP contract_id');
        $this->addSql('ALTER TABLE contract ADD car_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE contract ADD CONSTRAINT FK_E98F2859C3C6F69F FOREIGN KEY (car_id) REFERENCES car (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_E98F2859C3C6F69F ON contract (car_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE car ADD contract_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE car ADD CONSTRAINT FK_773DE69D2576E0FD FOREIGN KEY (contract_id) REFERENCES contract (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_773DE69D2576E0FD ON car (contract_id)');
        $this->addSql('ALTER TABLE contract DROP FOREIGN KEY FK_E98F2859C3C6F69F');
        $this->addSql('DROP INDEX UNIQ_E98F2859C3C6F69F ON contract');
        $this->addSql('ALTER TABLE contract DROP car_id');
    }
}
