<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Estados Model
 *
 * @property \Cake\ORM\Association\HasMany $Accidentes
 * @property \Cake\ORM\Association\HasMany $Causas
 * @property \Cake\ORM\Association\HasMany $ClaseVehiculos
 * @property \Cake\ORM\Association\HasMany $TipoServicios
 * @property \Cake\ORM\Association\HasMany $Ubicaciones
 *
 * @method \App\Model\Entity\Estado get($primaryKey, $options = [])
 * @method \App\Model\Entity\Estado newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Estado[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Estado|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Estado patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Estado[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Estado findOrCreate($search, callable $callback = null, $options = [])
 */
class EstadosTable extends Table
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

        $this->table('estados');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->hasMany('Accidentes', [
            'foreignKey' => 'estado_id'
        ]);
        $this->hasMany('Causas', [
            'foreignKey' => 'estado_id'
        ]);
        $this->hasMany('ClaseVehiculos', [
            'foreignKey' => 'estado_id'
        ]);
        $this->hasMany('TipoServicios', [
            'foreignKey' => 'estado_id'
        ]);
        $this->hasMany('Ubicaciones', [
            'foreignKey' => 'estado_id'
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
}
