<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * VehiculosAccidentes Model
 *
 * @property \Cake\ORM\Association\BelongsTo $ClaseVehiculos
 *
 * @method \App\Model\Entity\VehiculosAccidente get($primaryKey, $options = [])
 * @method \App\Model\Entity\VehiculosAccidente newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\VehiculosAccidente[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\VehiculosAccidente|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\VehiculosAccidente patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\VehiculosAccidente[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\VehiculosAccidente findOrCreate($search, callable $callback = null, $options = [])
 */
class VehiculosAccidentesTable extends Table
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

        $this->table('vehiculos_accidentes');
        $this->displayField('id');
        $this->primaryKey(['id', 'clase_vehiculo_id', 'accidentes_nro', 'accidentes_anio']);

        $this->belongsTo('ClaseVehiculos', [
            'foreignKey' => 'clase_vehiculo_id',
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

        $validator
            ->integer('accidentes_nro')
            ->allowEmpty('accidentes_nro', 'create');

        $validator
            ->allowEmpty('accidentes_anio', 'create');

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
        $rules->add($rules->existsIn(['clase_vehiculo_id'], 'ClaseVehiculos'));

        return $rules;
    }
}
