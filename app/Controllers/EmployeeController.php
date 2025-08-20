<?php
namespace App\Controllers;

use App\Models\Employee;
use App\Core\Auth;

class EmployeeController {
    private $employeeModel;

    public function __construct() {
        $this->employeeModel = new Employee();
        Auth::check();
    }

    public function index() {
        $employees = $this->employeeModel->all();
        require __DIR__ . '/../Views/employee/index.php';
    }

    public function createForm() {
        require __DIR__ . '/../Views/employee/create.php';
    }

    public function store() {
        $this->employeeModel->create([
            'user_id' => $_POST['user_id'],
            'department' => $_POST['department'],
            'position' => $_POST['position'],
            'hire_date' => $_POST['hire_date'],
            'salary' => $_POST['salary'],
            'phone' => $_POST['phone'],
            'address' => $_POST['address'],
        ]);
        header("Location: /employee-portal/public/employees");
        exit;
    }

    public function editForm($id) {
        $employee = $this->employeeModel->find($id);
        if (!$employee) {
            $_SESSION['error'] = "الموظف غير موجود";
            header("Location: /employee-portal/public/employees");
            exit;
        }
        require __DIR__ . '/../Views/employee/edit.php';
    }

    public function update($id) {
        $this->employeeModel->update($id, [
            'user_id' => $_POST['user_id'],
            'department' => $_POST['department'],
            'position' => $_POST['position'],
            'hire_date' => $_POST['hire_date'],
            'salary' => $_POST['salary'],
            'phone' => $_POST['phone'],
            'address' => $_POST['address'],
        ]);
        $_SESSION['success'] = "تم تحديث بيانات الموظف بنجاح";
        header("Location: /employee-portal/public/employees");
        exit;
    }

    public function delete($id) {
        $this->employeeModel->delete($id);
        $_SESSION['success'] = "تم حذف الموظف بنجاح";
        header("Location: /employee-portal/public/employees");
        exit;
    }
}
?>