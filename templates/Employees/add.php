<?php
/**
 * @var App\View\AppView $this
 * @var \App\Model\Entity\Employee $employee
 * @var \Cake\Datasource\ResultSetInterface $departments
 */
?>
<style>
    .required:after {
        content:" *";
        color: red;
    }
</style>
<div class="content-header">
    <div>
        <h4 class="mg-b-0 tx-spacing-2"><i data-feather="airplay" class="mr-2"></i><?php echo __("Add New Employee"); ?></h4>
    </div>
</div>
<div class="content-body">
    <?php echo $this->Form->create($employee, [
        'autocomplete' => 'off',
        'type' => 'file',
        'data-submit' => 'disable',
        'novalidate',
        'templates' => [
            'inputContainer' => '<div class="form-group">{{content}}</div>',
            'inputContainerError' => '<div class="form-group was-validated">{{content}}{{error}}</div>',
            'error' => '<div class="invalid-feedback mt-2">{{content}}</div>',
            'label' => '<label class="tx-12 font-weight-bold tx-spacing-2"{{attrs}}>{{text}}</label>',
        ],
        'class' => implode(' ', array_filter([
            'needs-validation',
            $employee->hasErrors() ? 'was-validated' : null,
        ]))
    ]);
    $this->Form->setConfig([
        'autoSetCustomValidity' => false,
        'errorClass' => 'is-invalid'
    ])
    ?>
    <div class="row row-xs">
        <div class="col-sm-5 d-flex align-content-stretch">
            <div class="card card-border w-100">
                <div class="card-body">
                    <div class="ui inverted dimmer">
                        <div class="ui loader"></div>
                    </div>
                    <?php echo $this->Form->control('first_name', [
                        'type' => 'string',
                        'class' => 'form-control',
                        'label' =>  __("First Name"),
                        'required' => true,
                        'templates' => [
                            'label' => '<label class="tx-12 font-weight-bold tx-spacing-2 required"{{attrs}}>{{text}}</label>',
                        ],
                        'templateVars' => [
                            'errorDiv' => '<div class="invalid-feedback mt-2 tx-12 tx-spacing-2"></div>'
                        ],
                    ]); ?>
                    <?php echo $this->Form->control('middle_name', [
                        'type' => 'string',
                        'class' => 'form-control',
                        'label' =>  __("Middle Name"),
                    ]); ?>
                    <?php echo $this->Form->control('last_name', [
                        'type' => 'string',
                        'class' => 'form-control',
                        'label' =>  __('Last Name'),
                        'required' => true,
                        'templates' => [
                            'label' => '<label class="tx-12 font-weight-bold tx-spacing-2 required"{{attrs}}>{{text}}</label>',
                        ],
                        'templateVars' => [
                            'errorDiv' => '<div class="invalid-feedback mt-2 tx-12 tx-spacing-2"></div>'
                        ],
                    ]); ?>
                    <?php echo $this->Form->control('email', [
                        'type' => 'string',
                        'class' => 'form-control',
                        'label' =>  __("Email"),
                        'required' => true,
                        'templates' => [
                            'label' => '<label class="tx-12 font-weight-bold tx-spacing-2 required"{{attrs}}>{{text}}</label>',
                        ],
                        'templateVars' => [
                            'errorDiv' => '<div class="invalid-feedback mt-2 tx-12 tx-spacing-2"></div>'
                        ],
                    ]); ?>
                    <?php echo $this->Form->control('phone', [
                        'type' => 'number',
                        'class' => 'form-control',
                        'label' =>  __("Phone Number"),
                        'required' => true,
                        'templates' => [
                            'label' => '<label class="tx-12 font-weight-bold tx-spacing-2 required"{{attrs}}>{{text}}</label>',
                        ],
                        'templateVars' => [
                            'errorDiv' => '<div class="invalid-feedback mt-2 tx-12 tx-spacing-2"></div>'
                        ],
                    ]); ?>
                    <?php echo $this->Form->control('dob', [
                        'type' => 'date',
                        'class' => 'form-control',
                        'label' =>  __("Date of Birth"),
                        'required' => true,
                        'templates' => [
                            'label' => '<label class="tx-12 font-weight-bold tx-spacing-2 required"{{attrs}}>{{text}}</label>',
                        ],
                        'templateVars' => [
                            'errorDiv' => '<div class="invalid-feedback mt-2 tx-12 tx-spacing-2"></div>'
                        ],
                    ]); ?>
                    <?php echo $this->Form->control('salary', [
                        'type' => 'number',
                        'class' => 'form-control',
                        'label' =>  __("Salary"),
                        'required' => true,
                        'templates' => [
                            'label' => '<label class="tx-12 font-weight-bold tx-spacing-2 required"{{attrs}}>{{text}}</label>',
                        ],
                        'templateVars' => [
                            'errorDiv' => '<div class="invalid-feedback mt-2 tx-12 tx-spacing-2"></div>'
                        ],
                    ]); ?>
                    <?php echo $this->Form->control('image_file', [
                        'type' => 'file',
                        'class' => 'form-control',
                        'label' =>  __("Picture"),
                        'required' => true,
                        'templates' => [
                            'label' => '<label class="tx-12 font-weight-bold tx-spacing-2 required"{{attrs}}>{{text}}</label>',
                        ],
                        'templateVars' => [
                            'errorDiv' => '<div class="invalid-feedback mt-2 tx-12 tx-spacing-2"></div>'
                        ],
                    ]); ?>
                    <?php echo $this->Form->control('department_id', [
                        'type' => 'select',
                        'class' => 'form-control',
                        'label' =>  __("Department"),
                        'required' => true,
                        'options' => $departments,
                        'empty' => __('Please Select'),
                        'templates' => [
                            'label' => '<label class="tx-12 font-weight-bold tx-spacing-2 required"{{attrs}}>{{text}}</label>',
                        ],
                        'templateVars' => [
                            'errorDiv' => '<div class="invalid-feedback mt-2 tx-12 tx-spacing-2"></div>'
                        ],
                    ]); ?>
                    <button type="submit" class="btn btn-block btn-primary tx-spacing-2 tx-12"><?php echo __("Save"); ?></button>
                </div>
            </div>
        </div>
    </div>
    <?php echo $this->Form->end(); ?>
</div>
