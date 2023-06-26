<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Employee Entity
 *
 * @property string $id
 * @property string $department_id
 * @property string $first_name
 * @property string|null $middle_name
 * @property string $last_name
 * @property \Cake\I18n\FrozenDate $dob
 * @property int $phone
 * @property string $email
 * @property string $image_file
 * @property int $salary
 * @property string $status
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\Department $department
 */
class Employee extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array<string, bool>
     */
    protected $_accessible = [
        'department_id' => true,
        'first_name' => true,
        'middle_name' => true,
        'last_name' => true,
        'dob' => true,
        'phone' => true,
        'email' => true,
        'image_file' => true,
        'salary' => true,
        'status' => true,
        'created' => true,
        'modified' => true,
        'department' => true,
    ];
}
