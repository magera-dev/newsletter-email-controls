# MageRa Newsletter Email Controls

Choose, per Magento configuration scope, whether Magento sends three newsletter lifecycle emails: confirmation request, confirmation success, and unsubscribe confirmation. The controls are opt-in and preserve Magento's normal newsletter behaviour until both the module and an individual suppression switch are enabled.

## What it does

- Suppresses the confirmation-request email when a subscriber first registers.
- Suppresses the confirmation-success email after a subscription is confirmed.
- Suppresses the unsubscribe email after a subscriber unsubscribes.
- Supports global, website, and store-view scopes.
- Intercepts only Magento's native newsletter subscriber email methods.

It is intended for stores whose consent workflow or external messaging system already handles one of these notices. It does not subscribe, confirm, unsubscribe, or modify subscriber data.

## Problems it solves

Some stores centralize subscriber communications in a consent platform, CRM, or
email service provider. Sending Magento's native newsletter lifecycle message
as well can produce duplicate customer emails or a message that does not match
the store's approved communication flow. This module selectively stops the
native send while leaving Magento's subscriber state and confirmation process
unchanged.

Typical uses include:

- an external system sends the approved confirmation or unsubscribe notice;
- a store has an established consent workflow and must prevent a duplicate
  Magento message;
- different store views require different newsletter communication policies.

This module suppresses delivery only. It does not create replacement messages,
sync data to another provider, or prove compliance with any consent or consumer
notification obligation.

## Requirements

- Magento Open Source or Adobe Commerce 2.4.x.
- Magento Newsletter functionality enabled where the controls are used.
- Administrator access to configuration and cache management.

## Installation

```bash
composer require magera/module-newsletter-email-controls
php bin/magento module:enable MageRa_NewsletterEmailControls
php bin/magento setup:upgrade
php bin/magento cache:flush
```

For manual installation, extract the package so that `app/code/MageRa/NewsletterEmailControls` contains `registration.php`, then run the same Magento commands.

## Configuration

Open **Stores > Configuration > MageRa > Newsletter Email Controls** for the required scope.

1. Set **Enable Controls** to `Yes`.
2. Enable only the email types that must be suppressed:
   - **Suppress Confirmation Request Email**
   - **Suppress Confirmation Success Email**
   - **Suppress Unsubscribe Email**
3. Save configuration and flush the cache.

Each email type remains untouched unless its own switch is enabled. Setting **Enable Controls** to `No` restores native Magento sending for all three email types.

### Email journey map

| Customer event | Native Magento email affected by this module | What remains unchanged |
| --- | --- | --- |
| A subscriber registers | Confirmation request | Subscriber record and confirmation-token flow |
| A subscription is confirmed | Confirmation success | Subscription status and confirmation result |
| A subscriber unsubscribes | Unsubscribe confirmation | Unsubscribe action and subscriber status |

Enable only the switch that corresponds to a message your organization has
intentionally replaced or no longer needs. For example, suppressing the
confirmation request does not automatically suppress confirmation-success or
unsubscribe messages.

## Before enabling

Newsletter confirmation and unsubscribe messages can be part of a store's consent record and customer-notification obligations. Confirm the applicable legal, privacy, deliverability, and internal-process requirements before suppressing a message. If another system is expected to send the notification, test that hand-off and preserve the evidence required by your organization.

Use a staging environment and a dedicated test address to test each scenario:

1. New newsletter subscription.
2. Subscription confirmation, if confirmation is enabled in Magento.
3. Unsubscribe.

## Behaviour and limits

- The module does not replace templates or send an alternative email.
- It does not change newsletter subscription status or confirmation-token processing.
- It does not affect non-newsletter transactional emails.
- The configured scope determines which store's native newsletter message is suppressed.

## Troubleshooting

If an email still sends, confirm both the master control and the relevant suppression switch are enabled in the active store scope, then flush configuration cache. If an expected email is missing, temporarily disable the relevant suppression switch and repeat the test with a new test address.

## Safe rollout checklist

1. Document which system, if any, sends the replacement customer notice.
2. Configure one suppression switch in staging at the same scope used in
   production.
3. Test subscription, confirmation, and unsubscribe with separate new test
   addresses; observe both Magento and the replacement system.
4. Confirm the customer-facing notice and retained consent evidence meet your
   organization's requirements before enabling the production setting.
5. To restore Magento's default behavior, disable the relevant switch (or
   **Enable Controls**) and flush cache. No subscriber data migration is needed.

## Support and licensing

This module is proprietary source-available software; see [LICENSE.md](LICENSE.md). For support, contact support@magera.ca with the Magento version, module version, store view, newsletter confirmation setting, and reproducible steps.
