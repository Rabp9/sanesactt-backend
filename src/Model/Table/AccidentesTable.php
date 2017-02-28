<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Accidentes Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Ubicaciones
 * @property \Cake\ORM\Association\BelongsTo $Causas
 * @property \Cake\ORM\Association\BelongsTo $Estados
 *
 * @method \App\Model\Entity\Accidente get($primaryKey, $options = [])
 * @method \App\Model\Entity\Accidente newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Accidente[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Accidente|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Accidente patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Accidente[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Accidente findOrCreate($search, callable $callback = null, $options = [])
 */
class AccidentesTable extends Table
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

        $this->table('accidentes');
        $this->displayField('nro');
        $this->primaryKey(['nro', 'anio', 'ubicacion_id', 'causa_id', 'estado_id']);

        $this->belongsTo('Ubicaciones', [
            'foreignKey' => 'ubicacion_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Causas', [
            'foreignKey' => 'causa_id',
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
            ->integer('nro')
            ->allowEmpty('nro', 'create');

        $validator
            ->allowEmpty('anio', 'create');

        $validator
            ->dateTime('fechaHora')
            ->allowEmpty('fechaHora');

        $validator
            ->integer('fallecidos_hombres')
            ->allowEmpty('fallecidos_hombres');

        $validator
            ->integer('fallecidos_mujeres')
            ->allowEmpty('fallecidos_mujeres');

        $validator
            ->integer('heridos_hombres')
            ->allowEmpty('heridos_hombres');

        $validator
            ->integer('heridos_mujeres')
            ->allowEmpty('heridos_mujeres');

        $validator
            ->allowEmpty('dia');

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
        $rules->add($rules->existsIn(['causa_id'], 'Causas'));
        $rules->add($rules->existsIn(['estado_id'], 'Estados'));

        return $rules;
    }
}
