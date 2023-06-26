<?php
declare(strict_types=1);

namespace App\Controller;

use App\Model\Table\EmployeesTable;
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
        $employee = $this->Employees->get($id);
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

        $this->set('titleForLayout', __('Edit Employee Data'));
        $this->set('employee', $employee);
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

    public function delete(?string $id = null)
    {
        $employee = $this->Employees->get($id);
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
    }
}
