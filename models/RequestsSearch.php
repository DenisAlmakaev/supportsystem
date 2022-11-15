<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;


/**
 * RequestsSearch представляет собой модель формы поиска `app\models\Requests`.

 */
class RequestsSearch extends Requests
{
    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['id'], 'integer'],
            [['email', 'text'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios(): array
    {
        // обойти реализацию сценариев() в родительском классе
        return Model::scenarios();
    }

    /**
     * Создает экземпляр поставщика данных с примененным поисковым запросом
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search(array $params): ActiveDataProvider
    {
        $query = Requests::find();



        // добавить условия, которые всегда должны применяться здесь

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' =>
                ['pageSize' => 10,

        ]]);



        $this->load($params);

        if (!$this->validate()) {
            // раскомментируйте следующую строку, если вы не хотите возвращать какие-либо записи в случае сбоя проверки
            // $query->where('0=1');
            return $dataProvider;
        }

        // условия фильтрации сетки
        $user_id = Yii::$app->user->id;;
        $query->andFilterWhere([
            'id' => $this->id,
            'user_id' => $user_id
        ]);

        $query->andFilterWhere(['like', 'theme', $this->theme])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'text', $this->text]);





        return $dataProvider;
    }

}
