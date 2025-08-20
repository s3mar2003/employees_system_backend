<?php
namespace App\Controllers;
use App\Core\Auth;
use App\Core\Controller;
use App\Models\Employee;
use App\Models\Leave;
use App\Models\Salary;

class DashboardController extends Controller {
    private $auth;
    private $employeeModel;
    private $salaryModel;
    private $leaveModel;
    
    public function __construct() {
        $this->auth = new Auth();
        $this->employeeModel = new Employee();
        $this->salaryModel = new Salary();
        $this->leaveModel = new Leave();
        
        if (!$this->auth->isLoggedIn()) {
            header('Location: /login');
            exit;
        }
    }
    
    public function index() {
        $user = $this->auth->getUser();
        $employee = $this->employeeModel->getByUserId($user['id']);
        $salaries = $this->salaryModel->getByEmployee($employee['id']);
        $leaves = $this->leaveModel->getByEmployee($employee['id']);
        
        $this->view('dashboard/index', [
            'user' => $user,
            'employee' => $employee,
            'salaries' => $salaries,
            'leaves' => $leaves
        ]);
    }
}