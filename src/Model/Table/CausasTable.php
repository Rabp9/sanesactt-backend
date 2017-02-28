<?php
namespace App\Model\Table;

use App\Model\Entity\Causa;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Causas Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Estados
 * @property \Cake\ORM\Association\HasMany $DetalleCausas
 *
 * @method \App\Model\Entity\Causa get($primaryKey, $options = [])
 * @method \App\Model\Entity\Causa newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Causa[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Causa|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Causa patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Causa[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Causa findOrCreate($search, callable $callback = null, $options = [])
 */
class CausasTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config) {
        parent::initialize($config);

        $this->table('causas');
        $this->displayField('descripcion');
        $this->primaryKey('id');

        $this->belongsTo('Estados', [
            'foreignKey' => 'estado_id',
            'joinType' => 'INNER'
        ]);
        
        $this->hasMany('DetalleCausas', [
            'foreignKey' => 'causa_id'
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
            $entity->detalle_causas = $this->_buildDetalleCausas($entity->variaciones);
            debug($entity->detalle_causas);
        }
    }
    
    protected function _buildDetalleCausas($variaciones) {
        $new = array_unique(array_map('trim', explode(';', $variaciones)));
        $new = array_filter($new, function($value) { 
            return $value != ''; 
        });
        $out = [];
        $query = $this->DetalleCausas->find()
            ->where(['DetalleCausas.descripcion IN' => $new]);
            // Remove existing detalleCausas from the list of new variaciones.
        foreach ($query->extract('descripcion') as $existing) {
            $index = array_search($existing, $new);
            if ($index !== false) {
                unset($new[$index]);
            }
        }
        // Add existing variaciones.
        foreach ($query as $detalleCausa) {
            $out[] = $detalleCausa;
        }// Add new variaciones.
        foreach ($new as $detalleCausa) {
            $out[] = $this->DetalleCausas->newEntity([
                'descripcion' => $detalleCausa,
                'estado_id' => 1
            ]);
        }
        return $out;
    }
}
