<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ClaseVehiculo Entity
 *
 * @property int $id
 * @property string $descripcion
 * @property int $tipo_servicio_id
 * @property int $estado_id
 *
 * @property \App\Model\Entity\TipoServicio $tipo_servicio
 * @property \App\Model\Entity\Estado $estado
 */
class ClaseVehiculo extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        '*' => true,
        'id' => false,
        'tipo_servicio_id' => false,
        'estado_id' => false
    ];
}
