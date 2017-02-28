<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * VehiculosAccidente Entity
 *
 * @property int $id
 * @property int $clase_vehiculo_id
 * @property int $accidentes_nro
 * @property string $accidentes_anio
 *
 * @property \App\Model\Entity\ClaseVehiculo $clase_vehiculo
 */
class VehiculosAccidente extends Entity
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
        'clase_vehiculo_id' => false,
        'accidentes_nro' => false,
        'accidentes_anio' => false
    ];
}
