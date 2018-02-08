<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Accidente Entity
 *
 * @property int $id
 * @property string $anio
 * @property \Cake\I18n\Time $fechaHora
 * @property int $fallecidos_hombres
 * @property int $fallecidos_mujeres
 * @property int $heridos_hombres
 * @property int $heridos_mujeres
 * @property string $dia
 * @property int $ubicacion_id
 * @property int $causa_id
 * @property int $estado_id
 *
 * @property \App\Model\Entity\Estado $estado
 */
class Accidente extends Entity
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
        '*' => true
    ];
}
