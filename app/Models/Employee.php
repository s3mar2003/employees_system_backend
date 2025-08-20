<?php
namespace App\Models;

use App\Core\App;
use PDO;

class Employee {
    public function all() {
        $stmt = App::db()->prepare("SELECT employees.*, users.name, users.email, users.role
                                    FROM employees
                                    JOIN users ON employees.user_id = users.id");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function find($id) {
        $stmt = App::db()->prepare("SELECT employees.*, users.name, users.email, users.role
                                    FROM employees
                                    JOIN users ON employees.user_id = users.id
                                    WHERE employees.id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($data) {
        $stmt = App::db()->prepare("INSERT INTO employees
            (user_id, department, position, hire_date, salary, phone, address)
            VALUES (:user_id, :department, :position, :hire_date, :salary, :phone, :address)");
        return $stmt->execute($data);
    }

    public function update($id, $data) {
        $data['id'] = $id;
        $stmt = App::db()->prepare("UPDATE employees SET
            user_id = :user_id,
            department = :department,
            position = :position,
            hire_date = :hire_date,
            salary = :salary,
            phone = :phone,
            address = :address
            WHERE id = :id");
        return $stmt->execute($data);
    }

    public function delete($id) {
        $stmt = App::db()->prepare("DELETE FROM employees WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }

    // إضافة الدوال المطلوبة للـ Dashboard
    public function getByUserId($userId) {
        $stmt = App::db()->prepare("SELECT * FROM employees WHERE user_id = :user_id");
        $stmt->execute(['user_id' => $userId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}