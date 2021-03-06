<?php

/**
 * This is the model class for table "yc_user".
 *
 * The followings are the available columns in table 'yc_user':
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property string $firstname
 * @property string $lastname
 * @property string $email
 * @property integer $address_id
 * @property string $ip
 * @property integer $status
 * @property string $date_added
 */
class User extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return User the static model class
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
		return 'yc_user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('address_id, status,email,password', 'required'),
			array('address_id, status', 'numerical', 'integerOnly'=>true),
			array('username', 'length', 'max'=>20),
			array('username', 'uniqueUsername'),
			array('password, firstname, lastname', 'length', 'max'=>32),
			array('email', 'length', 'max'=>96),
			array('email', 'uniqueEmail'),
			array('ip', 'length', 'max'=>15),
			array('date_added', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, username, password, firstname, lastname, email, address_id, ip, status, date_added', 'safe', 'on'=>'search'),
		);
	}
	public function uniqueUsername($attributes,$params){
		if(!$this->hasErrors()){
			$user = User::findByAttributes(array('username'=>$this->username));
			if(count($user)>0)
			$this->addError("username", "Username is not unique. Please try another.");
		}	
	}
	public function uniqueEmail($attributes,$params){
		if(!$this->hasErrors()){
			$user = User::findByAttributes(array('email'=>$this->email));
			if(count($user)>0)
				$this->addError("email", "Email is not unique. Please try another.");
		}
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'username' => 'Username',
			'password' => 'Password',
			'firstname' => 'Firstname',
			'lastname' => 'Lastname',
			'email' => 'Email',
			'address_id' => 'Address',
			'ip' => 'Ip',
			'status' => 'Status',
			'date_added' => 'Date Added',
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
		$criteria->compare('username',$this->username,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('firstname',$this->firstname,true);
		$criteria->compare('lastname',$this->lastname,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('address_id',$this->address_id);
		$criteria->compare('ip',$this->ip,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('date_added',$this->date_added,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	public function beforeSave(){
		$this->password = md5($this->password);
		//$this->address_id = '1';
		return false;
	}
}