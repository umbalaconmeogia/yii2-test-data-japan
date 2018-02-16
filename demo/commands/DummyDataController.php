<?php
namespace app\commands;

use yii\console\Controller;
use app\models\Company;
use app\models\Employee;

/**
 * Create dummy company and employee data.
 */
class DummyDataController extends Controller
{
    /**
     * Syntax
     *   ./yii dummy-data
     */
    public function actionIndex()
    {
        $nCompany = 10;
        $nEmployee = 100;
        $this->createCompanyData($nCompany);
        $this->createEmployeeData($nEmployee, $nCompany);
    }

    /**
     * @param integer $nCompany
     */
    private function createCompanyData($nCompany)
    {
        for ($companyId = 1; $companyId <= $nCompany; $companyId++) {
            $company = Company::findOne(['id' => $companyId]);
            if (!$company) {
                $company = new Company();
            }
            $company->saveThrowError();
        }
    }

    /**
     * @param integer $nEmployee
     * @param integer $nCompany
     */
    private function createEmployeeData($nEmployee, $nCompany)
    {
        for ($employeeId = 1; $employeeId <= $nEmployee; $employeeId++) {
            $employee = Employee::findOne(['id' => $employeeId]);
            if (!$employee) {
                $employee = new Employee();
                $employee->company_id = rand(1, $nCompany);
            }
            $employee->saveThrowError();
        }
    }
}
