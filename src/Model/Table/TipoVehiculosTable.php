<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * TipoVehiculos Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Estados
 *
 * @method \App\Model\Entity\TipoVehiculo get($primaryKey, $options = [])
 * @method \App\Model\Entity\TipoVehiculo newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\TipoVehiculo[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\TipoVehiculo|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TipoVehiculo patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\TipoVehiculo[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\TipoVehiculo findOrCreate($search, callable $callback = null, $options = [])
 */
class TipoVehiculosTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config) {
        parent::initialize($config);

        $this->table('tipo_vehiculos');
        $this->displayField('descripcion');
        $this->primaryKey('id');

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
            ->requirePresence('descripcion', 'create')
            ->notEmpty('descripcion')
            ->add('descripcion', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

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
        $rules->add($rules->isUnique(['descripcion']));
        $rules->add($rules->existsIn(['estado_id'], 'Estados'));

        return $rules;
    }
}
