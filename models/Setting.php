<?php
/**
 * @link https://www.humhub.org/
 * @copyright Copyright (c) 2022 HumHub GmbH & Co. KG
 * @license https://www.humhub.com/licences
 */

namespace humhub\modules\breakingnews\models;

use humhub\components\ActiveRecord;

/**
 * This model is used for proper attaching files to module setting text fields
 *
 * @property integer $id
 * @property string $name
 * @property string $value
 * @property string $module_id
 */
class Setting extends ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'setting';
    }

    /**
     * Get a record by setting name
     *
     * @param string $name
     * @return Setting|null
     */
    public static function findByName(string $name): ?self
    {
        return self::findOne([
            'module_id' => 'breakingnews',
            'name' => $name,
        ]);
    }

    /**
     * Get a setting value by name
     *
     * @param string $name
     * @return string|null
     */
    public static function get(string $name): ?string
    {
        $setting = self::findByName($name);
        return $setting ? $setting->value : null;
    }

}