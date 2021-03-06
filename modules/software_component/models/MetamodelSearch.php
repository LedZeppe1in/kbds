<?php

namespace app\modules\software_component\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * MetamodelSearch represents the model behind the search form about `app\modules\software_component\models\Metamodel`.
 */
class MetamodelSearch extends Metamodel
{
    /**
     * @return array the validation rules
     */
    public function rules()
    {
        return [
            [['id', 'created_at', 'updated_at', 'type', 'author'], 'integer'],
            [['name', 'description'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied.
     * @param array $params
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Metamodel::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'type' => $this->type,
            'author' => $this->author,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}