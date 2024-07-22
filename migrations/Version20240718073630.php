<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240718073630 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql(
            'CREATE TABLE question (
            id SERIAL PRIMARY KEY,
            text VARCHAR(255) NOT NULL
        )'
        );

        $this->addSql(
            'CREATE TABLE answer (
            id SERIAL PRIMARY KEY,
            question_id INT NOT NULL,
            text VARCHAR(255) NOT NULL
        )'
        );

        $this->addSql(
            'CREATE INDEX idx_answer_question_id ON answer (question_id)'
        );

        $this->addSql(
            'ALTER TABLE answer ADD CONSTRAINT fk_answer_question FOREIGN KEY (question_id) REFERENCES question (id)'
        );
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE answer DROP CONSTRAINT idx_answer_question_id');

        $this->addSql('DROP INDEX IF EXISTS fk_answer_question');

        $this->addSql('DROP TABLE IF EXISTS answer');
        $this->addSql('DROP TABLE IF EXISTS question');
    }
}
