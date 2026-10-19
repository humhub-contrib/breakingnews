<?php

namespace humhub\modules\breakingnews\models;

use DateTime;
use humhub\libs\DateHelper;
use humhub\libs\DbDateValidator;
use humhub\modules\breakingnews\Module;
use humhub\modules\content\widgets\richtext\RichText;
use humhub\modules\user\models\Group;
use Yii;
use yii\base\Model;

class EditForm extends Model
{
    /**
     * @var Module $module
     */
    private $module;

    public $active;
    public $expiresAt;
    public $activeGroups;
    public $title;
    public $message;
    public $reset;

    public $expiresTime;

    /**
     * @inheritdoc
     */
    public function init()
    {
        $this->module = Yii::$app->getModule('breakingnews');

        $this->title = $this->module->settings->get('title');
        $this->message = $this->module->settings->get('message');
        $this->expiresAt = $this->module->settings->get('expiresAt');
        $this->active = $this->module->settings->get('active');
        $this->activeGroups = $this->module->settings->getSerialized('activeGroups');

        $this->initTime();
    }

    private function initTime()
    {
        if (empty($this->expiresAt)) {
            $this->expiresAt = null;
            $this->expiresTime = '';
        } else {
            // The expiration date is stored in the system time zone (see DbDateValidator)
            $expiresAt = new DateTime($this->expiresAt, DateHelper::getSystemTimeZone());
            $this->expiresTime = Yii::$app->formatter->asTime($expiresAt, 'short');

            if ($expiresAt < new DateTime('now', DateHelper::getSystemTimeZone())) {
                $this->active = false;
            }
        }
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // Arrays and other non-scalar values are not allowed (they would also break the form rendering)
            [['title', 'message', 'expiresAt', 'expiresTime'], 'filter', 'filter' => static fn($value) => is_scalar($value) ? (string)$value : ''],
            [['reset', 'active'], 'filter', 'filter' => static fn($value) => is_scalar($value) ? $value : 0],
            [['title', 'message'], 'required'],
            [['expiresAt'], DbDateValidator::class, 'timeAttribute' => 'expiresTime'],
            [['expiresAt'], 'validateNotInPast'],
            [['expiresTime'], 'date', 'type' => 'time', 'format' => Yii::$app->formatter->isShowMeridiem() ? 'h:mm a' : 'php:H:i'],
            [['activeGroups'], 'validateActiveGroups', 'skipOnEmpty' => false],
        ];
    }

    /**
     * The expiration date can't be in the past for an active breaking news
     */
    public function validateNotInPast($attribute)
    {
        if (!$this->active || empty($this->$attribute)) {
            return;
        }

        $expiresAt = DateTime::createFromFormat('Y-m-d H:i:s', $this->$attribute, DateHelper::getSystemTimeZone());
        if ($expiresAt && $expiresAt < new DateTime('now', DateHelper::getSystemTimeZone())) {
            $this->addError($attribute, Yii::t('BreakingnewsModule.base', 'The expiration date must not be in the past.'));
        }
    }

    /**
     * Only an array of existing group IDs is allowed
     */
    public function validateActiveGroups($attribute)
    {
        $value = $this->$attribute;

        if ($value === null || $value === '') {
            $this->$attribute = [];
            return;
        }

        $groupIds = array_map('strval', Group::find()->select('id')->column());
        $valid = is_array($value);
        foreach ($valid ? $value : [] as $groupId) {
            if (!is_scalar($groupId) || !in_array((string)$groupId, $groupIds, true)) {
                $valid = false;
                break;
            }
        }

        if (!$valid) {
            // Reset an invalid value, so it can't break the form rendering
            $this->$attribute = [];
            $this->addError($attribute, Yii::t('BreakingnewsModule.base', 'Invalid groups.'));
            return;
        }

        $this->$attribute = array_values(array_unique(array_map('intval', $value)));
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'active' => Yii::t('BreakingnewsModule.base', 'Active'),
            'expiresAt' => Yii::t('BreakingnewsModule.base', 'Expire'),
            'activeGroups' => Yii::t('BreakingnewsModule.base', 'Groups whose members will see this breaking news'),
            'title' => Yii::t('BreakingnewsModule.base', 'Title'),
            'message' => Yii::t('BreakingnewsModule.base', 'Message'),
            'reset' => Yii::t('BreakingnewsModule.base', 'Mark as unseen for all users'),
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeHints()
    {
        return [
            'activeGroups' => Yii::t('BreakingnewsModule.base', 'If no group is ticked, everyone will see this breaking news.'),
            'message' => Yii::t('BreakingnewsModule.base', 'Note: You can use markdown syntax.'),
        ];
    }

    /**
     * Saves the given form settings.
     */
    public function save(): bool
    {
        if (!$this->validate()) {
            return false;
        }

        if (!$this->active) {
            $this->expiresAt = '';
        }

        $this->module->settings->set('title', $this->title);
        $this->module->settings->set('message', $this->message);
        $this->module->settings->set('active', $this->active);
        $this->module->settings->set('expiresAt', $this->expiresAt);
        $this->module->settings->setSerialized('activeGroups', $this->activeGroups);

        $lastTimeStamp = $this->module->settings->get('timestamp');
        if ($this->reset || $lastTimeStamp == null) {
            $this->module->settings->set('timestamp', time());
        }

        if ($setting = Setting::findByName('message')) {
            RichText::postProcess($this->message, $setting);
        }

        return true;
    }

}
