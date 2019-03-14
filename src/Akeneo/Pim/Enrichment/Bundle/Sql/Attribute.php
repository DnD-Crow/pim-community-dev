<?php

namespace Akeneo\Pim\Enrichment\Bundle\Sql;

use Doctrine\Common\Collections\ArrayCollection;

final class Attribute
{
    /** @var int */
    private $id;

    /** @var string */
    private $code;

    /** @var string */
    private $label;

    /** @var string */
    private $type;

    /** @var string */
    private $backendType;

    /** @var bool */
    private $required;

    /** @var bool */
    private $unique;

    /** @var bool */
    private $localizable;

    /** @var bool */
    private $scopable;

    /** @var ArrayCollection */
    private $properties;

    /** @var array */
    private $options;

    /** @var string */
    private $groupCode;

    /** @var bool */
    private $useableAsGridFilter;

    /** @var ArrayCollection */
    private $availableLocales;

    /** @var ArrayCollection */
    private $families;

    /** @var int */
    private $maxCharacters;

    /** @var string */
    private $validationRule;

    /** @var string */
    private $validationRegexp;

    /** @var bool */
    private $wysiwygEnabled;

    /** @var float */
    private $numberMin;

    /** @var float */
    private $numberMax;

    /** @var bool */
    private $decimalsAllowed;

    /** @var bool */
    private $negativeAllowed;

    /** @var \Datetime */
    private $dateMin;

    /** @var \Datetime */
    private $dateMax;

    /** @var string */
    private $metricFamily;

    /** @var string */
    private $defaultMetricUnit;

    /**
     * @var float expressed in MB so decimal is needed for values < 1 MB
     */
    private $maxFileSize;

    /** @var array */
    private $allowedExtensions;

    /** @var int */
    private $minimumInputLength;

    /**
     * @param int             $id
     * @param string          $code
     * @param string          $type
     * @param string          $backendType
     * @param bool            $required
     * @param bool            $unique
     * @param bool            $localizable
     * @param bool            $scopable
     * @param ArrayCollection $properties
     * @param array           $options
     * @param string          $groupCode
     * @param bool            $useableAsGridFilter
     * @param ArrayCollection $availableLocales
     * @param int             $maxCharacters
     * @param string          $validationRule
     * @param string          $validationRegexp
     * @param int           $numberMin
     * @param int           $numberMax
     * @param bool            $decimalsAllowed
     * @param bool            $negativeAllowed
     * @param \Datetime       $dateMin
     * @param \Datetime       $dateMax
     * @param string          $metricFamily
     * @param string          $defaultMetricUnit
     * @param float           $maxFileSize
     * @param array           $allowedExtensions
     * @param int             $minimumInputLength
     */
    public function __construct(
        int $id,
        string $code,
        ?string $type,
        ?string $backendType,
        ?bool $required,
        ?bool $unique,
        ?bool $localizable,
        ?bool $scopable,
        ArrayCollection $properties,
        //array $options,
        ?string $groupCode,
        ?bool $useableAsGridFilter,
        ArrayCollection $availableLocales,
        int $maxCharacters,
        ?string $validationRule,
        ?string $validationRegexp,
        ?int $numberMin,
        ?int $numberMax,
        ?bool $decimalsAllowed,
        ?bool $negativeAllowed,
        ?\Datetime $dateMin,
        ?\Datetime $dateMax,
        ?string $metricFamily,
        ?string $defaultMetricUnit,
        ?int $maxFileSize,
        array $allowedExtensions,
        ?int $minimumInputLength
    ) {
        $this->id = $id;
        $this->code = $code;
        $this->type = $type;
        $this->backendType = $backendType;
        $this->required = $required;
        $this->unique = $unique;
        $this->localizable = $localizable;
        $this->scopable = $scopable;
        $this->properties = $properties;
        //$this->options = $options;
        $this->groupCode = $groupCode;
        $this->useableAsGridFilter = $useableAsGridFilter;
        $this->availableLocales = $availableLocales;
        $this->maxCharacters = $maxCharacters;
        $this->validationRule = $validationRule;
        $this->validationRegexp = $validationRegexp;
        $this->numberMin = $numberMin;
        $this->numberMax = $numberMax;
        $this->decimalsAllowed = $decimalsAllowed;
        $this->negativeAllowed = $negativeAllowed;
        $this->dateMin = $dateMin;
        $this->dateMax = $dateMax;
        $this->metricFamily = $metricFamily;
        $this->defaultMetricUnit = $defaultMetricUnit;
        $this->maxFileSize = $maxFileSize;
        $this->allowedExtensions = $allowedExtensions;
        $this->minimumInputLength = $minimumInputLength;
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    public function getCode()
    {
        return $this->code;
    }

    public function getBackendType()
    {
        return $this->backendType;
    }

    public function getAttributeType()
    {
        return $this->type;
    }

    public function isRequired()
    {
        return $this->required;
    }

    public function isUnique()
    {
        return $this->unique;
    }

    public function isLocalizable()
    {
        return $this->localizable;
    }

    public function isScopable()
    {
        return $this->scopable;
    }

    public function getOptions()
    {
        return $this->options;
    }

    public function getProperties()
    {
        return $this->properties;
    }

    public function getProperty($property)
    {
        return isset($this->properties[$property]) ? $this->properties[$property] : null;
    }

    public function getGroupCode()
    {
        return $this->groupCode;
    }

    public function isUseableAsGridFilter()
    {
        return $this->useableAsGridFilter;
    }

    public function getLocaleSpecificCodes()
    {
        return $this->getAvailableLocaleCodes();
    }

    public function getMaxCharacters()
    {
        return $this->maxCharacters;
    }

    public function getValidationRule()
    {
        return $this->validationRule;
    }

    public function getValidationRegexp()
    {
        return $this->validationRegexp;
    }

    public function getNumberMin()
    {
        return $this->numberMin;
    }

    public function getNumberMax()
    {
        return $this->numberMax;
    }

    public function isDecimalsAllowed()
    {
        return $this->decimalsAllowed;
    }

    public function isNegativeAllowed()
    {
        return $this->negativeAllowed;
    }

    public function getDateMin()
    {
        return $this->dateMin;
    }

    public function getDateMax()
    {
        return $this->dateMax;
    }

    public function getMetricFamily()
    {
        return $this->metricFamily;
    }

    public function getDefaultMetricUnit()
    {
        return $this->defaultMetricUnit;
    }

    public function getMaxFileSize()
    {
        return $this->maxFileSize;
    }

    public function getAllowedExtensions(): array
    {
        return $this->allowedExtensions ? array_map('trim', explode(',', $this->allowedExtensions)) : [];
    }

    public function getMinimumInputLength(): int
    {
        return $this->minimumInputLength;
    }

    public function sortOrder(): int
    {
        return $this->sortOrder;
    }

    public function isLocaleSpecific(): bool
    {
       return !$this->availableLocales->isEmpty();
    }
}
