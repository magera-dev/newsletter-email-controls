# Newsletter Email Controls Installation

1. Install with `composer require magera/module-newsletter-email-controls`.
2. Run `php bin/magento module:enable MageRa_NewsletterEmailControls` and `php bin/magento setup:upgrade`.
3. Flush the cache with `php bin/magento cache:flush`.
4. Enable only the specific transactional-email suppression rules required for the store view.

Confirm consent and consumer-notification obligations before disabling any customer email.
