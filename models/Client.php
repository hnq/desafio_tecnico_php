<?php
namespace app\models;

use Yii;
use yii\base\Model;

class Client extends Model
{
    public $name;
    public $cpf;
    public $address;
    public $address_number;
    public $city;
    public $state;
    public $complement;
    public $photo;
    public $sex;

    public function rules()
    {
        return [
            ['name', 'required'],
            ['cpf', 'required', 'on' => ['create', 'update']],
            ['cpf', 'match', 'pattern' => '/^[0-9]{11}$/', 'message' => 'CPF deve conter apenas 11 dígitos numéricos.'],
            ['cpf', 'unique', 'targetClass' => 'app\models\Client', 'message' => 'CPF já existe.'],
            ['address', 'required', 'on' => ['create', 'update']],
            ['address_number', 'required', 'on' => ['create', 'update']],
            ['city', 'required', 'on' => ['create', 'update']],
            ['state', 'required', 'on' => ['create', 'update']],
            ['photo', 'file', 'extensions' => 'png, jpg, jpeg'],
            ['sex', 'in', 'range' => ['male', 'female']],
        ];
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($this->isNewRecord) {
                $this->photo = UploadedFile::getInstance($this, 'photo');
                if ($this->photo) {
                    $this->photo->saveAs(Yii::getAlias('@webroot') . '/uploads/' . $this->photo->baseName . '.' . $this->photo->extension);
                    $this->photo = '/uploads/' . $this->photo->baseName . '.' . $this->photo->extension;
                }
            }
            return true;
        }
        return false;
    }

    public function attributeLabels()
    {
        return [
            'name' => 'Nome',
            'cpf' => 'CPF',
            'address' => 'Logradouro',
            'address_number' => 'Número',
            'city' => 'Cidade',
            'state' => 'Estado',
            'complement' => 'Complemento',
            'photo' => 'Foto',
            'sex' => 'Sexo',
        ];
    }

    public function getProducts()
    {
        return $this->hasMany(Product::class, ['client_id' => 'id']);
    }
}