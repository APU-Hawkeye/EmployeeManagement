<?php
/**
 * @var App\View\AppView $this
 * @var \Cake\Datasource\ResultSetInterface $employees
 */
?>
<div class="content-header">
    <div>
        <h4 class="mg-b-0 tx-spacing-2"><i data-feather="users" class="mr-2"></i><?php echo __('Employee Count by Salary') ?></h4>
    </div>
</div>
<?php echo $this->Flash->render(); ?>
<div class="table-responsive">
    <table class="table table-hover border-bottom bg-white mb-0 us-table">
        <thead>
        <tr class="bg-light">
            <th class="tx-13 tx-spacing-2"><?php echo  __('Salary Range') ?></th>
            <th class="tx-13 tx-spacing-2"><?php echo  __('Total Employees') ?></th>
        </tr>
        </thead>
        <tbody>
        <?php if ($employees->isEmpty()) { ?>
            <tr>
                <td colspan="10" class="text-md-center tx-spacing-2"><?php echo __('No Data To Show')?></td>
            </tr>
        <?php } else { ?>
            <?php
            foreach ($employees as $employee) {  ?>
                <tr>
                    <td class="tx-12 tx-spacing-2"><?php echo $employee->salary_range; ?></td>
                    <td class="tx-12 tx-spacing-2"><?php echo $employee->employee_count; ?></td>
                </tr>
            <?php } ?>
        <?php } ?>
        </tbody>
    </table>
</div>
