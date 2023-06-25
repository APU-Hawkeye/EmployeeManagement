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
}
