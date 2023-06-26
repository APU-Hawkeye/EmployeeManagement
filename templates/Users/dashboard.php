<?php
/**
 * @var App\View\AppView $this
 */
?>

<div class="content-header">
    <div>
        <h4 class="mg-b-0 tx-spacing-2"><i data-feather="home" class="mr-2"></i>
            <?php echo 'Dashboard' ?></h4>
    </div>
</div>
<div class="content-body">
    <div class="row tx-14 tx-spacing-2">
        <div class="col-sm-3 d-flex align-items-stretch">
            <div class="bg-white bd pd-20 pd-lg-30 w-100 mb-4">
                <div class="mg-b-25"><i data-feather="bar-chart" class="wd-50 ht-50 tx-gray-500"></i></div>
                <h5 class="tx-inverse mg-b-20"><?php echo __("Highest Salary") ?></h5>
                <p class="mg-b-20"><?php echo __("Department wise highest salary of employees") ?></p>
                <a href="<?php echo $this->Url->build([
                    'controller' => 'Employees',
                    'action' => 'highestSalary',
                    '?' => [
                        'referer' => $this->getRequest()->getRequestTarget()
                    ]
                ]) ?>" class="btn btn-outline-primary tx-medium"><?php echo __("Highest Salary"); ?></a>
            </div>
        </div><!-- col-6 -->
        <div class="col-sm-3 d-flex align-items-stretch">
            <div class="bg-white bd pd-20 pd-lg-30 w-100 mb-4">
                <div class="mg-b-25"><i data-feather="smile" class="wd-50 ht-50 tx-gray-500"></i></div>
                <h5 class="tx-inverse mg-b-20"><?php echo __("Youngest Employee") ?></h5>
                <p class="mg-b-20"><?php echo __("Name and age of the youngest employee of each department.") ?></p>
                <a href="<?php echo $this->Url->build([
                    'controller' => 'Employees',
                    'action' => 'youngestEmployee',
                    '?' => [
                        'referer' => $this->getRequest()->getRequestTarget()
                    ]
                ]) ?>" class="btn btn-outline-primary tx-medium"><?php echo __("Youngest Employee"); ?></a>
            </div>
        </div>
    </div>
</div>
