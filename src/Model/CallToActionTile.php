<?php

namespace BiffBangPow\Element\Model;

use BiffBangPow\Element\CallToActionElement;
use BiffBangPow\Extension\CallToActionExtension;
use BiffBangPow\Extension\SortableExtension;
use DNADesign\Elemental\Forms\TextCheckboxGroupField;
use SilverStripe\AssetAdmin\Forms\UploadField;
use SilverStripe\Assets\Image;
use SilverStripe\Forms\DropdownField;
use SilverStripe\Forms\HeaderField;
use SilverStripe\Forms\HTMLEditor\HTMLEditorField;
use SilverStripe\Forms\TextareaField;
use SilverStripe\Forms\TextField;
use SilverStripe\ORM\DataObject;


class CallToActionTile extends DataObject
{

    private static $table_name = 'CTATile';
    private static $singular_name = 'Call to action tile';
    private static $plural_name = 'Call to action tiles';
    private static $db = [
        'Title' => 'Varchar',
        'ShowTitle' => 'Boolean',
        'Content' => 'HTMLText',
        'ColsMobile' => 'Int',
        'ColsTablet' => 'Int',
        'ColsDesktop' => 'Int',
        'ColsLarge' => 'Int'
    ];
    private static $has_one = [
        'Image' => Image::class
    ];
    private static $defaults = [
        'ColsMobile' => 12,
        'ColsTablet' => 6,
        'ColsDesktop' => 4,
        'ColsLarge' => 3
    ];
    private static $owns = [
        'Image'
    ];
    private static $belongs_many_many = [
        'Element' => CallToActionElement::class
    ];
    private static $extensions = [
        SortableExtension::class,
        CallToActionExtension::class
    ];

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();
        $fields->removeByName(['Element', 'ColsMobile', 'ColsTablet', 'ColsDesktop', 'ColsLarge', 'ShowTitle']);
        $fields->addFieldsToTab('Root.Main', [
            TextField::create('Title'),
            HTMLEditorField::create('Content'),
            UploadField::create('Image')
                ->setAllowedFileCategories('image/supported')
                ->setFolderName('CTA'),
            HeaderField::create('Width of this tile:'),
            DropdownField::create('ColsMobile', 'Mobile', $this->getColumnSizes()),
            DropdownField::create('ColsTablet', 'Tablet', $this->getColumnSizes()),
            DropdownField::create('ColsDesktop', 'Desktop', $this->getColumnSizes()),
            DropdownField::create('ColsLarge', 'Large screen', $this->getColumnSizes())
        ]);

        $fields->replaceField(
            'Title',
            TextCheckboxGroupField::create()
                ->setName('Title')
        );

        $this->extend('updateTileFields', $fields);

        return $fields;
    }

    /**
     * Get a friendly list of column sizes
     * @return string[]
     */
    private function getColumnSizes()
    {
        $sizes = [
            '1' => '1/12 width',
            '2' => '1/6 width',
            '3' => '1/4 width',
            '4' => '1/3 width',
            '6' => '1/2 width',
            '8' => '2/3 width',
            '9' => '3/4 width',
            '12' => 'Full width'
        ];

        $this->extend('updateColumnSizes', $sizes);
        return $sizes;
    }

    /**
     * Returns a classname based on the number of columns we need to show
     * @return string
     */
    public function getColumnClass()
    {
        $classes = [
            'col-' . $this->ColsMobile,
            'col-md-' . $this->ColsTablet,
            'col-lg-' . $this->ColsDesktop,
            'col-xl-' . $this->ColsLarge
        ];

        $classString = implode(" ", $classes);
        $this->extend('updateClassString', $classString);

        return $classString;
    }
}
