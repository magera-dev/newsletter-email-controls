# MageRa Newsletter Email Controls

Manage Magento newsletter confirmation and unsubscribe emails per store view. Each suppression control is disabled by default so Magento's standard consent flow remains unchanged until a merchant deliberately changes it.

## Installation

```bash
composer require magera/module-newsletter-email-controls
php bin/magento module:enable MageRa_NewsletterEmailControls
php bin/magento setup:upgrade
php bin/magento cache:flush
```

Configure it at **Stores > Configuration > MageRa > Newsletter Email Controls**. Confirm applicable consent and consumer-protection obligations before suppressing any customer email.

## Support

Contact support@magera.ca with the Magento version, module version, and reproducible steps.
