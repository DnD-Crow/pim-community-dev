<?php

declare(strict_types=1);

namespace Akeneo\Pim\Enrichment\Component\Product\Connector\UseCase\Validator;

use Akeneo\Tool\Component\Api\Exception\InvalidQueryException;
use Akeneo\Tool\Component\StorageUtils\Repository\IdentifiableObjectRepositoryInterface;

/**
 * @author    Pierre Allard <pierre.allard@akeneo.com>
 * @author    Alexandre Hocquard <alexandre.hocquard@akeneo.com>
 * @author    Mathias Métayer <mathias.metayer@akeneo.com>
 * @copyright 2019 Akeneo SAS (http://www.akeneo.com)
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
final class ValidateSearchLocale
{
    private static $COMPLETENESS_PROPERTY = 'completeness';

    /** @var IdentifiableObjectRepositoryInterface */
    private $localeRepository;

    public function __construct(
        IdentifiableObjectRepositoryInterface $localeRepository
    ) {
        $this->localeRepository = $localeRepository;
    }

    /**
     * @throws InvalidQueryException
     */
    public function validate(array $search, ?string $searchLocale): void
    {
        $localeCodes = [];
        foreach ($search as $propertyCode => $filters) {
            foreach ($filters as $filter) {
                $localeFilter = isset($filter['locale']) ? $filter['locale'] : $searchLocale;

                if (null !== $localeFilter && !is_string($localeFilter) && $propertyCode !== self::$COMPLETENESS_PROPERTY) {
                    throw new InvalidQueryException(
                        sprintf('Property "%s" expects a string with the key "locale".', $propertyCode)
                    );
                }

                if (null !== $localeFilter) {
                    $localeCodes[] = $localeFilter;
                }

                if (isset($filter['locales']) && $propertyCode === self::$COMPLETENESS_PROPERTY) {
                    if (!is_array($filter['locales'])) {
                        throw new InvalidQueryException(
                            sprintf('Property "%s" expects an array with the key "locales".', $propertyCode)
                        );
                    }

                    $localeCodes = array_merge($localeCodes, $filter['locales']);
                }
            }
        }

        $localeCodes = array_unique($localeCodes);
        $errors = [];
        foreach ($localeCodes as $localeCode) {
            $locale = $this->localeRepository->findOneByIdentifier($localeCode);
            if (null === $locale || !$locale->isActivated()) {
                $errors[] = $localeCode;
            }
        }

        if (!empty($errors)) {
            $plural = count($errors) > 1 ?
                'Locales "%s" do not exist or are not activated.' : 'Locale "%s" does not exist or is not activated.';
            throw new InvalidQueryException(sprintf($plural, implode(', ', $errors)));
        }
    }
}
