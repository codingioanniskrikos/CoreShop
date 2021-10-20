<?php
/**
 * CoreShop.
 *
 * This source file is subject to the GNU General Public License version 3 (GPLv3)
 * For the full copyright and license information, please view the LICENSE.md and gpl-3.0.txt
 * files that are distributed with this source code.
 *
 * @copyright  Copyright (c) CoreShop GmbH (https://www.coreshop.org)
 * @license    https://www.coreshop.org/license     GNU General Public License version 3 (GPLv3)
 */

declare(strict_types=1);

namespace CoreShop\Component\Store\Context\RequestBased;

use CoreShop\Component\Store\Context\StoreContextInterface;
use CoreShop\Component\Store\Model\StoreInterface;

final class CachedStoreContext implements StoreContextInterface
{
    private ?StoreInterface $cachedStore = null;

    public function __construct(private StoreContextInterface $requestBasedStoreContext)
    {
    }

    public function getStore(): StoreInterface
    {
        if (null === $this->cachedStore) {
            $this->cachedStore = $this->requestBasedStoreContext->getStore();
        }

        return $this->cachedStore;
    }
}
