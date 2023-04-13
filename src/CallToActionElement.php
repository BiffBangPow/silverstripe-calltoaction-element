<?php

namespace BiffBangPow\Element;

use BiffBangPow\Element\Control\MultiCallToActionElementController;
use BiffBangPow\Element\Model\CallToActionTile;
use BiffBangPow\Extension\ElementInlineUnEditable;
use DNADesign\Elemental\Models\BaseElement;
use SilverStripe\Forms\GridField\GridField;
use SilverStripe\Forms\GridField\GridFieldConfig_RelationEditor;
use Symbiote\GridFieldExtensions\GridFieldOrderableRows;

class CallToActionElement extends BaseElement
{
    private static $table_name = 'CTAElement';
    private static $description = 'Calls-to-action with images';
    private static $inline_editable = false;

    private static $many_many = [
        'CTAs' => CallToActionTile::class
    ];

    public function getType()
    {
        return _t(__CLASS__ . '.BlockType', 'Calls-to-action');
    }

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();
        $fields->removeByName('CTAs');
        $grid = GridField::create('CTAs', 'CTAs', $this->CTAs(),
            GridFieldConfig_RelationEditor::create()->addComponent(new GridFieldOrderableRows()));
        $fields->addFieldsToTab('Root.Main', [
            $grid
        ]);
        return $fields;
    }

    public function getSimpleClassName()
    {
        return 'bbp-cta';
    }
}
