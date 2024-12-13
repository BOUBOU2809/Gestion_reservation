<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241213110354 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reservation ADD time_slot VARCHAR(100) NOT NULL, DROP horaireplage, CHANGE eventname event_name VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE user ADD phone_number VARCHAR(15) NOT NULL, DROP phonenumber, CHANGE name name VARCHAR(100) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reservation ADD horaireplage VARCHAR(20) NOT NULL, DROP time_slot, CHANGE event_name eventname VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE user ADD phonenumber VARCHAR(20) NOT NULL, DROP phone_number, CHANGE name name VARCHAR(255) NOT NULL');
    }
}
