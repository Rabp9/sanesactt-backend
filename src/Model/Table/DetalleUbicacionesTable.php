<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * DetalleUbicaciones Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Ubicaciones
 * @property \Cake\ORM\Association\BelongsTo $Estados
 *
 * @method \App\Model\Entity\DetalleUbicacion get($primaryKey, $options = [])
 * @method \App\Model\Entity\DetalleUbicacion newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\DetalleUbicacion[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\DetalleUbicacion|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\DetalleUbicacion patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\DetalleUbicacion[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\DetalleUbicacion findOrCreate($search, callable $callback = null, $options = [])
 */
class DetalleUbicacionesTable extends Table
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

        $this->table('detalle_ubicaciones');
        $this->entityClass('DetalleUbicacion');
        $this->displayField('descripcion');
        $this->primaryKey('id');

        $this->belongsTo('Ubicaciones', [
            'foreignKey' => 'ubicacion_id',
            'joinType' => 'INNER',
            'propertyName' => 'ubicacion'
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
        $rules->add($rules->existsIn(['ubicacion_id'], 'Ubicaciones'));
        $rules->add($rules->existsIn(['estado_id'], 'Estados'));

        return $rules;
    }
}
