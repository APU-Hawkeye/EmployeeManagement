<?php
/**
 * @var App\View\AppView $this
 * @var \Cake\Datasource\ResultSetInterface $employees
 */

$this->Html->css([
    "/lib/semantic-ui/dropdown/dropdown.min",
    "/lib/semantic-ui/transition/transition.min",
], ["block" => true]);
?>
    <div class="content-header">
        <div>
            <h4 class="mg-b-0 tx-spacing-2"><i data-feather="globe" class="mr-2"></i><?php echo __('Employees') ?></h4>
        </div>
    </div>
    <div class="content-body p-0">
        <div class="px-3 py-4 bg-light border-bottom">
            <div class="d-flex bd-highlight">
                <div class="pr-3"><?php echo $this->Paginator->limitControl([
                        25 => __("25 Records"),
                        50 => __("50 Records"),
                        75 => __("75 Records"),
                        100 => __("100 Records"),
                    ], null, [
                        'label' => false,
                        'class' => 'ui dropdown',
                        'empty' => __("Records")
                    ]); ?></div>
                <div class="px-3 flex-grow-1">
                    <?php echo $this->Form->create(null, [
                        'type' => 'GET',
                        'templates' => [
                            'inputContainer' => '{{content}}',
                        ],
                        'valueSources' => ['query']
                    ]); ?>
                    <div class="input-group w-100">
                        <?php echo $this->Form->control('q', [
                            'class' => 'form-control tx-spacing-2',
                            'label' => false,
                            'placeholder' => __("Search...")
                        ]); ?>
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-primary btn-block tx-spacing-2"><i data-feather="search"></i></button>
                        </div>
                    </div>
                    <?php echo $this->Form->end(); ?>
                </div>
                <div class="px-3 flex-grow-1">&nbsp;</div>
                <div class="pl-0">
                    <ul class="pagination pagination-outline justify-content-end mg-b-0">
                        <?php echo $this->Paginator->prev(); ?>
                        <?php echo $this->Paginator->next(); ?>
                    </ul>
                </div>
            </div>
        </div>
        <?php echo $this->Flash->render(); ?>
        <div class="table-responsive">
            <table class="table table-hover border-bottom bg-white mb-0 us-table">
                <thead>
                <tr class="bg-light">
                    <th  style="width:1%"></th>
                    <th class="tx-13 tx-spacing-2"><?php echo  __('Name') ?></th>
                    <th class="tx-13 tx-spacing-2"><?php echo  __('Email') ?></th>
                    <th class="tx-13 tx-spacing-2"><?php echo  __('Salary') ?></th>
                    <th class="tx-13 tx-spacing-2"><?php echo  __('Status') ?></th>
                </tr>
                </thead>
                <tbody>
                <?php if ($employees->isEmpty()) { ?>
                    <tr>
                        <td colspan="10" class="text-md-center tx-spacing-2"><?php echo __('No Data To Show')?></td>
                    </tr>
                <?php } else { ?>
                    <?php /** @var \App\Model\Entity\Employee $employee */
                    foreach ($employees as $employee) {  ?>
                        <tr>
                            <td class="tx-12 tx-spacing-2"><a href="<?php echo $this->Url->build([
                                    'action' => 'view',
                                    $employee->id,
                                    '?' => [
                                        'referer' => $this->getRequest()->getRequestTarget()
                                    ]
                                ]) ?>"><?php echo __("View")?> </a></td>
                            <td class="tx-12 tx-spacing-2"><?php echo $employee->first_name. ' ' . $employee->last_name; ?></td>
                            <td class="tx-12 tx-spacing-2"><?php echo $employee->email; ?></td>
                            <td class="tx-12 tx-spacing-2"><?php echo $employee->salary; ?></td>
                            <td class="tx-12 tx-spacing-2"><?php echo $employee->status; ?></td>
                        </tr>
                    <?php } ?>
                <?php } ?>
                </tbody>
            </table>
        </div>
        <div class="p-3 d-flex flex-row justify-content-between bg-light">
            <div class="justify-content-start tx-spacing-2 pd-t-8"><?php echo $this->Paginator->counter('Page {{page}} of {{pages}}, showing {{current}} records out of total {{count}} records'); ?></div>
            <ul class="pagination pagination-outline justify-content-end mg-b-0">
                <?php echo $this->Paginator->first(); ?>
                <?php echo $this->Paginator->prev(); ?>
                <?php echo $this->Paginator->numbers(); ?>
                <?php echo $this->Paginator->next(); ?>
                <?php echo $this->Paginator->last(); ?>
            </ul>
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
});
<?php $this->Html->scriptEnd(); ?>
