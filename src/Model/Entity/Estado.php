<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Estado Entity
 *
 * @property int $id
 * @property string $descripcion
 *
 * @property \App\Model\Entity\Accidente[] $accidentes
 * @property \App\Model\Entity\Causa[] $causas
 * @property \App\Model\Entity\ClaseVehiculo[] $clase_vehiculos
 * @property \App\Model\Entity\TipoServicio[] $tipo_servicios
 * @property \App\Model\Entity\Ubicacione[] $ubicaciones
 */
class Estado extends Entity
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
        'id' => false
    ];
}
