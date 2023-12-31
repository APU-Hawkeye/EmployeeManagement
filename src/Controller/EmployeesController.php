<?php
declare(strict_types=1);

namespace App\Controller;

use App\Model\Table\EmployeesTable;
use Cake\Database\Expression\QueryExpression;
use Cake\Event\EventInterface;
use Cake\ORM\TableRegistry;

/**
 * Class UsersController
 * @package App\Controller
 *
 * @property EmployeesTable $Employees
 */
class EmployeesController extends AppController
{
    public $paginate = [
        'limit' => 50,
        'maxLimit' => 500
    ];

    /**
     * @param EventInterface $event
     * @return \Cake\Http\Response|void|null
     */
    public function beforeFilter(EventInterface $event)
    {
        /** @var  \App\Model\Table\EmployeesTable $employees */
        $employees = TableRegistry::getTableLocator()->get('Employees');
        $this->Employees = $employees;
        parent::beforeFilter($event);
    }

    /**
     * @return void
     */
    public function index()
    {
        $query = $this->Employees->find()->contain([
            'Departments'
        ]);
        $employees = $this->paginate($query, [
            'order' => [
                $this->Employees->aliasField('modified') => 'DESC',
                $this->Employees->aliasField('first_name') => 'ASC',
            ]
        ]);
        $this->set('employees', $employees);
        $this->set('titleForLayout', __("Users"));
    }

    /**
     * @return \Cake\Http\Response|void|null
     */
    public function add()
    {
        $employee = $this->Employees->newEmptyEntity();
        if ($this->getRequest()->is(['post'])) {
            $postData = $this->getRequest()->getData();
            $image = $this->getRequest()->getData('image_file');
            $fileName = $image->getClientFileName();
            $postData['image_file'] = $fileName;
            $employee = $this->Employees->patchEntity($employee ,$postData);
            if (!$employee->getErrors()) {
                $targetPath = WWW_ROOT.'img'.DS.$fileName;
                $image->moveTo($targetPath);
                $employee->image_file = $fileName;
            }
            //dd($employee);
            if ($this->Employees->save($employee)) {
                $this->Flash->success(__('Employee {0} has been successfully registered', [
                    $employee->first_name
                ]));

                return $this->redirect([
                    'action' => 'view',
                    $employee->id,
                    '?' => [
                        'referer' => $this->getRequest()->getQuery('referer')
                    ]
                ]);

            } else{
                $this->response = $this->response->withStatus(400);
                $this->Flash->error(__('Something went wrong. Please check your inputs'));
            }
            return $this->redirect($this->referer());
        }
        $departments = $this->Employees->Departments->find('list')->orderDesc('name');
        $this->set('titleForLayout', __('Add New Employee'));
        $this->set('employee', $employee);
        $this->set('departments', $departments);
    }

    /**
     * @param string|null $id Employee ID
     * @return \Cake\Http\Response|void|null
     */
    public function edit(?string $id = null)
    {
        $employee = $this->Employees->get($id, [
            'contain' => [
                'Departments',
            ],
        ]);
        if ($this->getRequest()->is(['post','put','patch'])) {
            /** @var array $postData */
            $postData = $this->getRequest()->getData();
            $employee = $this->Employees->patchEntity($employee, $postData);
            if ($this->Employees->save($employee)) {
                $this->Flash->success(__('Employee data of {0} has been successfully updated.', [
                    $employee->first_name
                ]));

                return $this->redirect([
                    'action' => 'view',
                    $employee->id,
                    '?' => [
                        'referer' => $this->getRequest()->getQuery('referer'),
                    ],
                ]);
            } else {
                $this->Flash->error('Something went wrong. Please, try again.');
                $this->response = $this->response->withStatus(400);
            }
        }
        $departments = $this->Employees->Departments->find('list')->orderDesc('name');
        $this->set('titleForLayout', __('Edit Employee Data'));
        $this->set('employee', $employee);
        $this->set('departments', $departments);
    }

    /**
     * @param string|null $id Employee ID
     * @return void
     */
    public function view(?string $id = null)
    {
        $employee = $this->Employees->get($id, [
            'contain' => [
                'Departments'
            ]
        ]);
        $this->set('titleForLayout', __('Employee - {0} {1}', [
            $employee->first_name,
            $employee->last_name
        ]));
        $this->set('employee', $employee);
    }

    /**
     * @param string|null $id
     * @return \Cake\Http\Response|void|null
     */
    public function delete(?string $id = null)
    {
        $employee = $this->Employees->get($id);
        try {
            $this->Employees->deleteOrFail($employee);
            $this->Flash->success('Employee successfully deleted');
            return $this->redirect([
                'action' => 'index',
            ]);
        } catch (\Cake\ORM\Exception\PersistenceFailedException $e) {
            echo $e->getEntity();
            $this->Flash->error('Something went wrong please try again');
        }
    }

    /**
     * @return void
     */
    public function highestSalary()
    {
        $query = $this->Employees->find();
        $query->select([
                'department_name' => 'Departments.name',
                'highest_salary' => $query->func()->max('salary')
            ])
            ->innerJoinWith('Departments')
            ->group('Departments.name');

        $salaries = $this->paginate($query);
        $this->set('salaries', $salaries);
        $this->set('titleForLayout', __('highest Salary'));
    }

    /**
     * @return void
     */
    public function youngestEmployee()
    {
        $subQuery = $this->Employees->find();
        $subQuery
            ->select([
                'age' => $subQuery->func()->min($subQuery->func()->extract('YEAR', 'AGE(NOW(), Employees.dob)'))
            ])
            ->group('Employees.department_id');
        $query = $this->Employees->find();
        $query
            ->select([
                'first_name' => 'Employees.first_name',
                'last_name' => 'Employees.last_name',
                'department_name' => 'Departments.name',
                'min_age' => 'EXTRACT(YEAR FROM AGE(NOW(), Employees.dob))'
            ])
            ->innerJoinWith('Departments')
            ->where(function (QueryExpression $expression) use ($subQuery) {
                return $expression->in(
                    'EXTRACT(YEAR FROM AGE(NOW(), Employees.dob))',
                    $subQuery
                );
            });

        $employees = $this->paginate($query);
        $this->set('employees', $employees);
        $this->set('titleForLayout', __('Youngest Employees'));
    }

    /**
     * @return void
     */
    public function employeeCount()
    {
        $query = $this->Employees->find();
        $query
            ->select([
                'salary_range' => $query->newExpr("CASE
                    WHEN salary <= 30000 THEN '0-30000'
                    WHEN salary <= 60000 THEN '30001-60000'
                    WHEN salary <= 100000 THEN '60001-100000'
                    ELSE '100000+'
                    END"),
                'employee_count' => $query->func()->count('*')
            ])
            ->group('salary_range')
            ->orderAsc('salary_range');

        $employees = $this->paginate($query);
        $this->set('employees', $employees);
        $this->set('titleForLayout', __('Employee Count'));

    }
}
