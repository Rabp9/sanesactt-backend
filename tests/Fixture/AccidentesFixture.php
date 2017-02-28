<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * AccidentesFixture
 *
 */
class AccidentesFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'nro' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'anio' => ['type' => 'string', 'fixed' => true, 'length' => 4, 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null],
        'fechaHora' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'fallecidos_hombres' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'fallecidos_mujeres' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'heridos_hombres' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'heridos_mujeres' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'dia' => ['type' => 'string', 'length' => 10, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'ubicacion_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'causa_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'estado_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        '_indexes' => [
            'fk_accidentes_ubicacion_idx' => ['type' => 'index', 'columns' => ['ubicacion_id'], 'length' => []],
            'fk_accidentes_causas1_idx' => ['type' => 'index', 'columns' => ['causa_id'], 'length' => []],
            'fk_accidentes_estados1_idx' => ['type' => 'index', 'columns' => ['estado_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['nro', 'anio', 'ubicacion_id', 'causa_id', 'estado_id'], 'length' => []],
            'fk_accidentes_causas1' => ['type' => 'foreign', 'columns' => ['causa_id'], 'references' => ['causas', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'fk_accidentes_estados1' => ['type' => 'foreign', 'columns' => ['estado_id'], 'references' => ['estados', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'fk_accidentes_ubicacion' => ['type' => 'foreign', 'columns' => ['ubicacion_id'], 'references' => ['ubicaciones', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
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
            'nro' => 1,
            'anio' => '670059eb-f315-4d9a-83c6-83d4a397a2b1',
            'fechaHora' => '2017-01-23 18:24:01',
            'fallecidos_hombres' => 1,
            'fallecidos_mujeres' => 1,
            'heridos_hombres' => 1,
            'heridos_mujeres' => 1,
            'dia' => 'Lorem ip',
            'ubicacion_id' => 1,
            'causa_id' => 1,
            'estado_id' => 1
        ],
    ];
}
