<?php


namespace afashio\articles\queries;


use paulzi\nestedsets\NestedSetsQueryTrait;
use yii\db\ActiveQuery;

/**
 * Class AbstractCategoryQuery
 *
 * @package common\models\query
 */
class AbstractCategoryQuery extends ActiveQuery
{
    use NestedSetsQueryTrait;
}