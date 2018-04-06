<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * DetalleAccidentes Model
 *
 * @property \Cake\ORM\Association\BelongsTo $TipoVehiculos
 * @property \Cake\ORM\Association\BelongsTo $TipoServicios
 *
 * @method \App\Model\Entity\DetalleAccidente get($primaryKey, $options = [])
 * @method \App\Model\Entity\DetalleAccidente newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\DetalleAccidente[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\DetalleAccidente|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\DetalleAccidente patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\DetalleAccidente[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\DetalleAccidente findOrCreate($search, callable $callback = null, $options = [])
 */
class DetalleAccidentesTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->table('detalle_accidentes');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('Accidente', [
            'foreignKey' => 'accidente_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('TipoVehiculos', [
            'foreignKey' => 'tipo_vehiculo_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('TipoServicios', [
            'foreignKey' => 'tipo_servicio_id',
            'joinType' => 'INNER'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['tipo_vehiculo_id'], 'TipoVehiculos'));
        $rules->add($rules->existsIn(['tipo_servicio_id'], 'TipoServicios'));

        return $rules;
    }
}