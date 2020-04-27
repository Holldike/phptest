<?php


namespace Model;

class Person extends \Model
{
    public function add($person)
    {
        $data = $this->db->trim($person);

        $this->db->query('
            INSERT INTO person SET 
                name = "' . $data['name'] . '", 
                email = "' . $data['email'] . '", 
                territory = "' . $data['area'] . '"
        ');
    }

    public function validate($data)
    {
        $errors = [];
        $data = $this->db->trim($data);

        foreach ($data as $name => $value) {
            if ($name == 'name') {
                if (strlen($value) < 3) {
                    $errors[$name] = 'ФИО должно быть длинной более чем 3 символа';
                    continue;
                }

                if (!preg_match("/^[a-zA-Z0-9 ]*$/", $value)) {
                    $errors[$name] = 'Доступны только буквы и пробелы';
                    continue;
                }
            }

            if ($name == 'email') {
                if (!$value) {
                    $errors[$name] = 'Email не указан';
                    continue;
                }

                if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
                    $errors[$name] = 'Email не корретный';
                    continue;
                }

                if ($existsPerson = $this->db->query("
                        SELECT p.email, p.name, tkt.ter_address as territory 
                        FROM person p
                        LEFT JOIN t_koatuu_tree tkt ON (tkt.ter_id = p.territory)
                        WHERE email = '" . $value . "'
                    ")->fetch()) {
                    $errors[$name] = [
                        'message' => 'Email уже зарегистрирован',
                        'existsPerson' => $existsPerson
                    ];

                    continue;
                }
            }

            if ($name == 'region') {
                if (!$value) {
                    $errors[$name] = 'Email не указан';
                }

                continue;
            }

            if ($name == 'city') {
                if (!$value) {
                    $errors[$name] = 'Email не указан';
                }

                continue;
            }

        }

        return $errors;
    }
}