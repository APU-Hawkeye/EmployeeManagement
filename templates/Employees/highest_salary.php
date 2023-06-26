<?php
/**
 * @var App\View\AppView $this
 * @var \Cake\Datasource\ResultSetInterface $salaries
 */
?>

<div class="content-header">
    <div>
        <h4 class="mg-b-0 tx-spacing-2"><i data-feather="bar-chart" class="mr-2"></i><?php echo __('Highest Salaries') ?></h4>
    </div>
</div>
<?php echo $this->Flash->render(); ?>
<div class="table-responsive">
    <table class="table table-hover border-bottom bg-white mb-0 us-table">
        <thead>
        <tr class="bg-light">
            <th class="tx-13 tx-spacing-2"><?php echo  __('Department Name') ?></th>
            <th class="tx-13 tx-spacing-2"><?php echo  __('highest Salary') ?></th>
        </tr>
        </thead>
        <tbody>
        <?php if ($salaries->isEmpty()) { ?>
            <tr>
                <td colspan="10" class="text-md-center tx-spacing-2"><?php echo __('No Data To Show')?></td>
            </tr>
        <?php } else { ?>
            <?php
            foreach ($salaries as $salary) {  ?>
                <tr>
                    <td class="tx-12 tx-spacing-2"><?php echo $salary->department_name; ?></td>
                    <td class="tx-12 tx-spacing-2"><?php echo $salary->highest_salary; ?></td>
                </tr>
            <?php } ?>
        <?php } ?>
        </tbody>
    </table>
</div>
