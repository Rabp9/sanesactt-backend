<?php
namespace App\Model\Table;

use App\Model\Entity\Ubicacion;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Ubicaciones Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Estados
 * @property \Cake\ORM\Association\HasMany $DetalleUbicaciones
 *
 * @method \App\Model\Entity\Ubicacion get($primaryKey, $options = [])
 * @method \App\Model\Entity\Ubicacion newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Ubicacion[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Ubicacion|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Ubicacion patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Ubicacion[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Ubicacion findOrCreate($search, callable $callback = null, $options = [])
 */
class UbicacionesTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config) {
        parent::initialize($config);

        $this->table('ubicaciones');
        $this->entityClass('Ubicacion');
        $this->displayField('descripcion');
        $this->primaryKey('id');

        $this->belongsTo('Estados', [
            'foreignKey' => 'estado_id',
            'joinType' => 'INNER'
        ]);
        
        $this->hasMany('DetalleUbicaciones', [
            'foreignKey' => 'ubicacion_id'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator) {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->allowEmpty('descripcion');

        $validator
            ->allowEmpty('longitud');

        $validator
            ->allowEmpty('latitud');

        $validator
            ->allowEmpty('foto');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules) {
        $rules->add($rules->existsIn(['estado_id'], 'Estados'));
        return $rules;
    }
    
    public function beforeSave($event, $entity, $options) {
        if ($entity->variaciones) {
            $entity->detalle_ubicaciones = $this->_buildDetalleUbicaciones($entity->variaciones);
        }
    }
    
    protected function _buildDetalleUbicaciones($variaciones) {
        $new = array_unique(array_map('trim', explode(';', $variaciones)));
        $new = array_filter($new, function($value) { 
            return $value != ''; 
        });
        $out = [];
        $query = $this->DetalleUbicaciones->find()
            ->where(['DetalleUbicaciones.descripcion IN' => $new]);
            // Remove existing detalle_ubicaciones from the list of new variaciones.
        foreach ($query->extract('descripcion') as $existing) {
            $index = array_search($existing, $new);
            if ($index !== false) {
                unset($new[$index]);
            }
        }
        // Add existing variaciones.
        foreach ($query as $detalleUbicacion) {
            $out[] = $detalleUbicacion;
        }// Add new variaciones.
        foreach ($new as $detalleUbicacion) {
            $out[] = $this->DetalleUbicaciones->newEntity([
                'descripcion' => $detalleUbicacion,
                'estado_id' => 1
            ]);
        }
        return $out;
    }
}
