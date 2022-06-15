<?php

namespace BiffBangPow\Element\Model;

use BiffBangPow\Element\CallToActionElement;
use BiffBangPow\Element\MultiCallToActionElement;
use BiffBangPow\Extension\CallToActionExtension;
use BiffBangPow\Extension\SortableExtension;
use SilverStripe\AssetAdmin\Forms\UploadField;
use SilverStripe\Assets\File;
use SilverStripe\Assets\Image;
use SilverStripe\CMS\Model\SiteTree;
use SilverStripe\Forms\DropdownField;
use SilverStripe\Forms\LiteralField;
use SilverStripe\Forms\TextareaField;
use SilverStripe\Forms\TextField;
use SilverStripe\Forms\TreeDropdownField;
use SilverStripe\ORM\DataObject;


class CallToActionTile extends DataObject
{
    private static $table_name = 'CTATile';
    private static $singular_name = 'Call to action tile';
    private static $plural_name = 'Call to action tiles';
    private static $db = [
        'Title' => 'Varchar',
        'Content' => 'Text'
    ];
    private static $has_one = [
        'Image' => Image::class
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
        $fields->removeByName(['CTAType', 'ActionID', 'DownloadFile']);
        $fields->addFieldsToTab('Root.Main', [
            TextField::create('Title'),
            TextareaField::create('Content'),
            UploadField::create('Image')
                ->setAllowedFileCategories('image/supported')
                ->setFolderName('CTA')
        ]);

        return $fields;
    }
}
