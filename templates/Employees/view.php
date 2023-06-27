<?php
/**
 * @var App\View\AppView $this
 * @var \App\Model\Entity\Employee $employee
 */
$this->Html->css([
    "/lib/semantic-ui/dropdown/dropdown.min",
    "/lib/semantic-ui/transition/transition.min",
], ["block" => true]);
?>

<div class="content-header">
    <div>
        <h4 class="mg-b-0 tx-spacing-2"><i data-feather="user" class="mr-2"></i>
            <?php echo 'Employee - '. $employee->first_name.' '.$employee->last_name; ?></h4>
    </div>
    <nav class="nav">
        <div class="ui nav-link icon top left pointing dropdown">
            <i data-feather="settings" class="icon"></i>
            <div class="menu">
                <div class="item tx-spacing-2"><a href="<?php echo $this->Url->build([
                        'controller' => 'Employees',
                        'action' => 'edit',
                        $employee->id,
                        '?' => [
                            'referer' => $this->getRequest()->getRequestTarget()
                        ]
                    ]); ?>" class="text-dark d-block"><i data-feather="edit"></i>
                        <?php echo __("Edit"); ?>
                    </a>
                </div>
                <div class="item tx-spacing-2"><a href="<?php echo $this->Url->build([
                        'controller' => 'Employees',
                        'action' => 'delete',
                        $employee->id,
                    ]); ?>" class="text-dark d-block"><i data-feather="trash"></i>
                        <?php echo __("Delete"); ?>
                    </a>
                </div>
            </div>
        </div>
    </nav>
</div>
<div class="content-body">
    <?php echo $this->Flash->render(); ?>
    <div class="row">
        <div class="col-sm-8 col-md-8 col-lg-6 col-xl-5 d-flex align-items-stretch">
            <div class="card border w-100 mb-4">
                <div class="card-body tx-13">
                    <div class="font-weight-bold tx-spacing-2 pd"><?php echo  __('Department')?></div>
                    <p class="tx-spacing-2"> <?php echo $employee->department->name ;?> </p>
                    <div class="font-weight-bold tx-spacing-2"><?php echo  __('First Name')?></div>
                    <p class="tx-spacing-2"> <?php echo $employee->first_name ;?> </p>
                    <div class="font-weight-bold tx-spacing-2"><?php echo  __('Last Name')?></div>
                    <p class="tx-spacing-2"> <?php echo $employee->last_name ;?> </p>
                    <div class="font-weight-bold tx-spacing-2"><?php echo  __('Email')?></div>
                    <p class="tx-spacing-2"> <?php echo $employee->email ;?> </p>
                    <div class="font-weight-bold tx-spacing-2"><?php echo  __('Phone')?></div>
                    <p class="tx-spacing-2"> <?php echo $employee->phone ;?> </p>
                    <div class="font-weight-bold tx-spacing-2"><?php echo  __('Date of Birth')?></div>
                    <p class="tx-spacing-2"> <?php echo $employee->dob ;?> </p>
                    <div class="font-weight-bold tx-spacing-2"><?php echo  __('Salary')?></div>
                    <p class="tx-spacing-2"> <?php echo $employee->salary;?> </p>
                    <div class="font-weight-bold tx-spacing-2"><?php echo  __('Status')?></div>
                    <p class="tx-spacing-2"> <?php echo $employee->status ;?> </p>
                    <p class="tx-spacing-2"> <?php echo $employee->created->format("F d, Y h:i:s A T");?> </p>
                    <div class="font-weight-bold tx-spacing-2"><?php echo  __('Modified') ?></div>
                    <p class="tx-spacing-2"> <?php echo $employee->modified->format("F d, Y h:i:s A T");?> </p>
                </div>
            </div>
        </div>
        <div class="col-sm-8 col-md-8 col-lg-6 col-xl-5 d-flex align-items-stretch">
            <div class="card border w-100 mb-4">
                <div class="card-body tx-13">
                    <img class="img-fluid" src="<?php echo Cake\Routing\Router::fullBaseUrl().DS.'img'.DS.$employee->image_file ;?>">
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->Html->script([
    "/lib/semantic-ui/transition/transition.min",
    "/lib/semantic-ui/dropdown/dropdown.min",
], [
    'block' => 'scriptBottom'
]); ?>
<?php $this->Html->scriptStart([ 'block' => 'scriptBottom' ]); ?>
$(function(){
    $('.ui.dropdown').dropdown({
        selectOnKeydown: false,
        forceSelection: false
    });
})
<?php $this->Html->scriptEnd(); ?>
