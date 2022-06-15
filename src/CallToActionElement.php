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
        return _t(__CLASS__ . '.BlockType', 'Multi-CTA');
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

    /**
     * Returns a classname based on the number of CTA elements being displayed
     * No fancy maths here, just a few rules for a small number of elements
     * Otherwise we just default to a 1/3 width
     * @return string
     */
    public function getColumnClass()
    {
        $numItems = $this->CTAs()->count();
        if (($numItems < 3) || ($numItems == 4) || ($numItems == 8)) {
            return 'col-12 col-lg-6';
        }
        return 'col-12 col-lg-4';
    }
}
