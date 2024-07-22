<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240722014656 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql(
            "INSERT INTO question (text) VALUES
                ('1+1'),
                ('2+2'),
                ('3+3'),
                ('4+4'),
                ('5+5'),
                ('6+6'),
                ('7+7'),
                ('8+8'),
                ('9+9'),
                ('10+10')"
        );

        $this->addSql(
            "INSERT INTO answer (question_id, text) VALUES
                ((SELECT id FROM question WHERE text = '1+1'), '3'),
                ((SELECT id FROM question WHERE text = '1+1'), '2'),
                ((SELECT id FROM question WHERE text = '1+1'), '0')"
        );

        $this->addSql(
            "INSERT INTO answer (question_id, text) VALUES
                ((SELECT id FROM question WHERE text = '2+2'), '4'),
                ((SELECT id FROM question WHERE text = '2+2'), '3+1'),
                ((SELECT id FROM question WHERE text = '2+2'), '10')"
        );

        $this->addSql(
            "INSERT INTO answer (question_id, text) VALUES
                ((SELECT id FROM question WHERE text = '3+3'), '1+5'),
                ((SELECT id FROM question WHERE text = '3+3'), '1'),
                ((SELECT id FROM question WHERE text = '3+3'), '6'),
                ((SELECT id FROM question WHERE text = '3+3'), '2+4')"
        );

        $this->addSql(
            "INSERT INTO answer (question_id, text) VALUES
                ((SELECT id FROM question WHERE text = '4+4'), '8'),
                ((SELECT id FROM question WHERE text = '4+4'), '4'),
                ((SELECT id FROM question WHERE text = '4+4'), '0'),
                ((SELECT id FROM question WHERE text = '4+4'), '0+8')"
        );

        $this->addSql(
            "INSERT INTO answer (question_id, text) VALUES
                ((SELECT id FROM question WHERE text = '5+5'), '6'),
                ((SELECT id FROM question WHERE text = '5+5'), '18'),
                ((SELECT id FROM question WHERE text = '5+5'), '10'),
                ((SELECT id FROM question WHERE text = '5+5'), '9'),
                ((SELECT id FROM question WHERE text = '5+5'), '0')"
        );

        $this->addSql(
            "INSERT INTO answer (question_id, text) VALUES
                ((SELECT id FROM question WHERE text = '6+6'), '3'),
                ((SELECT id FROM question WHERE text = '6+6'), '9'),
                ((SELECT id FROM question WHERE text = '6+6'), '0'),
                ((SELECT id FROM question WHERE text = '6+6'), '12'),
                ((SELECT id FROM question WHERE text = '6+6'), '5+7')"
        );

        $this->addSql(
            "INSERT INTO answer (question_id, text) VALUES
                ((SELECT id FROM question WHERE text = '7+7'), '5'),
                ((SELECT id FROM question WHERE text = '7+7'), '14')"
        );

        $this->addSql(
            "INSERT INTO answer (question_id, text) VALUES
                ((SELECT id FROM question WHERE text = '8+8'), '16'),
                ((SELECT id FROM question WHERE text = '8+8'), '12'),
                ((SELECT id FROM question WHERE text = '8+8'), '9'),
                ((SELECT id FROM question WHERE text = '8+8'), '5')"
        );

        $this->addSql(
            "INSERT INTO answer (question_id, text) VALUES
                ((SELECT id FROM question WHERE text = '9+9'), '18'),
                ((SELECT id FROM question WHERE text = '9+9'), '9'),
                ((SELECT id FROM question WHERE text = '9+9'), '17+1'),
                ((SELECT id FROM question WHERE text = '9+9'), '2+16')"
        );

        $this->addSql(
            "INSERT INTO answer (question_id, text) VALUES
                ((SELECT id FROM question WHERE text = '10+10'), '0'),
                ((SELECT id FROM question WHERE text = '10+10'), '2'),
                ((SELECT id FROM question WHERE text = '10+10'), '8'),
                ((SELECT id FROM question WHERE text = '10+10'), '20')"
        );
    }

    public function down(Schema $schema): void
    {
        $this->addSql(
            "DELETE FROM answer WHERE question_id IN (SELECT id FROM question WHERE text IN ('1+1', '2+2', '3+3', '4+4', '5+5', '6+6', '7+7', '8+8', '9+9', '10+10'))"
        );

        $this->addSql(
            "DELETE FROM question WHERE text IN ('1+1', '2+2', '3+3', '4+4', '5+5', '6+6', '7+7', '8+8', '9+9', '10+10')"
        );
    }
}
