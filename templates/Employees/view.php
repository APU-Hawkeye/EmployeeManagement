<?php
/**
 * @var App\View\AppView $this
 * @var \App\Model\Entity\Employee $employee
 */
?>
<div class="content-header">
    <div>
        <h4 class="mg-b-0 tx-spacing-2"><i data-feather="user" class="mr-2"></i>
            <?php echo 'Employee - '. $employee->first_name.' '.$employee->last_name; ?></h4>
    </div>
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
