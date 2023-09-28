<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Persona Entity
 *
 * @property int $id
 * @property string|null $cedula
 * @property string|null $nombre
 * @property string|null $telefono
 * @property string|null $correo
 * @property bool|null $activo
 * @property \Cake\I18n\FrozenTime|null $created_at
 * @property \Cake\I18n\FrozenTime|null $modified_at
 */
class Persona extends Entity
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
        'cedula' => true,
        'nombre' => true,
        'telefono' => true,
        'correo' => true,
        'activo' => true,
        'created_at' => true,
        'modified_at' => true,
    ];
}
