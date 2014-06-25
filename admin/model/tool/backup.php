<?php

/*
 * Copyright (C) 2014 ahmet
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */


if (!defined('DIR_APPLICATION'))
    exit('No direct script access allowed');

/**
 * Description of backup
 *
 * @author ahmet
 */
class ModelToolBackup extends Model {

    public function restore($sql) {
        foreach (explode(";\n", $sql) as $sql) {
            $sql = trim($sql);

            if ($sql) {
                $this->db->query($sql);
            }
        }

        $this->cache->delete('*');
    }

    public function getTables() {
        $table_data = array();

        $query = $this->db->query("SHOW TABLES FROM `" . DB_DATABASE . "`");

        foreach ($query->rows as $result) {
            if (utf8_substr($result['Tables_in_' . DB_DATABASE], 0, strlen(DB_PREFIX)) == DB_PREFIX) {
                if (isset($result['Tables_in_' . DB_DATABASE])) {
                    $table_data[] = $result['Tables_in_' . DB_DATABASE];
                }
            }
        }

        return $table_data;
    }

    public function backup($tables) {
        $output = '';

        foreach ($tables as $table) {
            if (DB_PREFIX) {
                if (strpos($table, DB_PREFIX) === false) {
                    $status = false;
                } else {
                    $status = true;
                }
            } else {
                $status = true;
            }

            if ($status) {
                $output .= 'TRUNCATE TABLE `' . $table . '`;' . "\n\n";

                $query = $this->db->query("SELECT * FROM `" . $table . "`");

                foreach ($query->rows as $result) {
                    $fields = '';

                    foreach (array_keys($result) as $value) {
                        $fields .= '`' . $value . '`, ';
                    }

                    $values = '';

                    foreach (array_values($result) as $value) {
                        $value = str_replace(array("\x00", "\x0a", "\x0d", "\x1a"), array('\0', '\n', '\r', '\Z'), $value);
                        $value = str_replace(array("\n", "\r", "\t"), array('\n', '\r', '\t'), $value);
                        $value = str_replace('\\', '\\\\', $value);
                        $value = str_replace('\'', '\\\'', $value);
                        $value = str_replace('\\\n', '\n', $value);
                        $value = str_replace('\\\r', '\r', $value);
                        $value = str_replace('\\\t', '\t', $value);

                        $values .= '\'' . $value . '\', ';
                    }

                    $output .= 'INSERT INTO `' . $table . '` (' . preg_replace('/, $/', '', $fields) . ') VALUES (' . preg_replace('/, $/', '', $values) . ');' . "\n";
                }

                $output .= "\n\n";
            }
        }

        return $output;
    }

}
