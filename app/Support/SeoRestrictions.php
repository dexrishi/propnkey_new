<?php

namespace App\Support;

class SeoRestrictions
{
    /** Foreign keys on properties that SEO staff cannot change. */
    public const PROPERTY_RELATIONSHIP_FIELDS = [
        'partner_id',
        'agent_id',
        'location_id',
        'property_condition_id',
        'property_category_id',
        'property_type_id',
    ];

    public static function stripPropertyRelationshipFields(array $data): array
    {
        foreach (self::PROPERTY_RELATIONSHIP_FIELDS as $field) {
            unset($data[$field]);
        }

        return $data;
    }
}
