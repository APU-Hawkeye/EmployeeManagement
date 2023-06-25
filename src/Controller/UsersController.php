<?php
declare(strict_types=1);

namespace App\Controller;

use App\Model\Table\UsersTable;
use Cake\Event\EventInterface;
use Cake\ORM\TableRegistry;

/**
 * Class UsersController
 * @package App\Controller
 *
 * @property UsersTable $Users
 */
class UsersController extends AppController
{
    public $paginate = [
        'limit' => 50,
        'maxLimit' => 100
    ];

    /**
     * @param EventInterface $event
     * @return \Cake\Http\Response|void|null
     */
    public function beforeFilter(EventInterface $event)
    {
        $this->Authentication->addUnauthenticatedActions([
            'login',
            'logout',
        ]);
        /** @var UsersTable $users */
        $users = TableRegistry::getTableLocator()->get('Users');
        $this->Users = $users;
        parent::beforeFilter($event);
    }

    /**
     * @return void
     */
    public function index()
    {
        $query = $this->Users->find();
        $users = $this->paginate($query, [
            'order' => [
                $this->Users->aliasField('disabled') => 'DESC'
            ]
        ]);
        $this->set('users', $users);
        $this->set('titleForLayout', __("Users"));
    }

    public function dashboard()
    {
        $this->set('titleForLayout', __("Dashboard"));
    }

    /**
     * @return \Cake\Http\Response|void|null
     */
    public function login()
    {
        $result = $this->Authentication->getResult();
        if ($result->isValid()) {
            $redirect = $this->getRequest()->getQuery('redirect', [
                'controller' => 'Users',
                'action' => 'dashboard'
            ]);

            return $this->redirect($redirect);
        }
        else {
            if($this->getRequest()->is('post') && !$result->isValid()) {
                $this->response = $this->response->withStatus(401);
                $this->Flash->error(__("Incorrect username or password."));
            }
        }
        $this->viewBuilder()->disableAutoLayout();
        $this->set('titleForLayout', __("Login"));
    }

    /**
     * @return \Cake\Http\Response|null
     */
    public function logout()
    {
        $this->Flash->set(__("You've successfully logged out."), [
            'element' => 'error'
        ]);
        if ( $this->Authentication->getIdentity() ) {
            $this->Authentication->logout();
        }
        return $this->redirect([
            'action' => 'login'
        ]);
    }
}
