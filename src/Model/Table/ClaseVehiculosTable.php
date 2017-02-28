<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ClaseVehiculos Model
 *
 * @property \Cake\ORM\Association\BelongsTo $TipoServicios
 * @property \Cake\ORM\Association\BelongsTo $Estados
 *
 * @method \App\Model\Entity\ClaseVehiculo get($primaryKey, $options = [])
 * @method \App\Model\Entity\ClaseVehiculo newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ClaseVehiculo[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ClaseVehiculo|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ClaseVehiculo patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ClaseVehiculo[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ClaseVehiculo findOrCreate($search, callable $callback = null, $options = [])
 */
class ClaseVehiculosTable extends Table
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

        $this->table('clase_vehiculos');
        $this->displayField('id');
        $this->primaryKey(['id', 'tipo_servicio_id', 'estado_id']);

        $this->belongsTo('TipoServicios', [
            'foreignKey' => 'tipo_servicio_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Estados', [
            'foreignKey' => 'estado_id',
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
            ->allowEmpty('descripcion');

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
        $rules->add($rules->existsIn(['tipo_servicio_id'], 'TipoServicios'));
        $rules->add($rules->existsIn(['estado_id'], 'Estados'));

        return $rules;
    }
}
