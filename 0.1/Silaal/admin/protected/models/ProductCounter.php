<?php

/**
 * This is the model class for table "yc_product_counter".
 *
 * The followings are the available columns in table 'yc_product_counter':
 * @property integer $id
 * @property integer $product_id
 * @property integer $view_counter
 * @property integer $purchase_counter
 */
class ProductCounter extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ProductCounter the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'yc_product_counter';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			//array('product_id, view_counter, purchase_counter', 'required'),
			//array('product_id, view_counter, purchase_counter', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, product_id, view_counter, purchase_counter', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
				//'Counter'=>array(self::BELONGS_TO,'Products','product_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'product_id' => 'Product',
			'view_counter' => 'View Counter',
			'purchase_counter' => 'Purchase Counter',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.
		
		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('product_id',$this->product_id);
		$criteria->compare('view_counter',$this->view_counter);
		$criteria->compare('purchase_counter',$this->purchase_counter);
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	protected function gridData($data,$row){
		$product = Products::model()->findByAttributes(array('product_id'=>$data->product_id));
		if($product !== null) 
			return $product->title;
		else 
			return $data->product_id;
	}
}