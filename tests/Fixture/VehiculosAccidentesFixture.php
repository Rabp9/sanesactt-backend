<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * VehiculosAccidentesFixture
 *
 */
class VehiculosAccidentesFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'clase_vehiculo_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'accidentes_nro' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'accidentes_anio' => ['type' => 'string', 'fixed' => true, 'length' => 4, 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null],
        '_indexes' => [
            'fk_vehiculos_accidentes_clase_vehiculos1_idx' => ['type' => 'index', 'columns' => ['clase_vehiculo_id'], 'length' => []],
            'fk_vehiculos_accidentes_accidentes1_idx' => ['type' => 'index', 'columns' => ['accidentes_nro', 'accidentes_anio'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id', 'clase_vehiculo_id', 'accidentes_nro', 'accidentes_anio'], 'length' => []],
            'fk_vehiculos_accidentes_accidentes1' => ['type' => 'foreign', 'columns' => ['accidentes_nro', 'accidentes_anio'], 'references' => ['accidentes', '1' => ['nro', 'anio']], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'fk_vehiculos_accidentes_clase_vehiculos1' => ['type' => 'foreign', 'columns' => ['clase_vehiculo_id'], 'references' => ['clase_vehiculos', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
        ],
        '_options' => [
            'engine' => 'InnoDB',
            'collation' => 'utf8_general_ci'
        ],
    ];
    // @codingStandardsIgnoreEnd

    /**
     * Records
     *
     * @var array
     */
    public $records = [
        [
            'id' => 1,
            'clase_vehiculo_id' => 1,
            'accidentes_nro' => 1,
            'accidentes_anio' => '700a5ab5-af92-457b-9f48-0dfc0afc7ee4'
        ],
    ];
}
