<?php

declare(strict_types=1);

namespace App\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230915155932 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'create users Table';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('
            CREATE TABLE users (
                id INT AUTO_INCREMENT NOT NULL, 
                username VARCHAR(255) NOT NULL, 
                email VARCHAR(255) NOT NULL, 
                password VARCHAR(255) NOT NULL, 
                PRIMARY KEY(id),
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL
            ) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        ');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs

        $this->addSql('DROP TABLE users');
    }
}
