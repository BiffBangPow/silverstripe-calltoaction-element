<?php

namespace BiffBangPow\Element;

use DNADesign\Elemental\Models\BaseElement;
use Sheadawson\Linkable\Forms\LinkField;
use Sheadawson\Linkable\Models\Link;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\HTMLEditor\HTMLEditorField;

class CallToActionElement extends BaseElement
{
    /**
     * @var string
     */
    private static $table_name = 'ElementCallToAction';

    private static $singular_name = 'call to action element';

    private static $plural_name = 'call to action elements';

    private static $description = 'Text with a call to action button';

    private static $inline_editable = false;

    /**
     * @var array
     */
    private static $db = [
        'Text' => 'HTMLText',
    ];

    /**
     * @var array
     */
    private static $has_one = [
        'CallToAction' => Link::class,
    ];

    /**
     * @var array
     */
    private static $owns = [
        'CallToAction',
    ];

    /**
     * @return FieldList
     */
    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        $fields->addFieldsToTab(
            'Root.Main',
            [
                HTMLEditorField::create('Text'),
                LinkField::create(
                    'CallToActionID',
                    'Call To Action'
                ),
            ]
        );

        return $fields;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return 'Call to Action';
    }

    public function getSimpleClassName()
    {
        return 'call-to-action-element';
    }
}