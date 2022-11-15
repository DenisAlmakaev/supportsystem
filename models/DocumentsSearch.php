<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;


class DocumentsSearch extends Documents
{

    public function rules(): array
    {
        return [
            [['id'], 'integer'],
            [['name', 'description', 'filename'], 'safe'],
        ];
    }

    public function scenarios(): array
    {

        return Model::scenarios();
    }

    public function search(array $params): ActiveDataProvider
    {
        $query = Documents::find();


        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => ['pageSize' => 10,

            ]]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }


        $query->andFilterWhere([
            'id' => $this->id,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'filename', $this->filename]);

        return $dataProvider;
    }

}