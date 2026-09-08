<?php
/** Copyright © MageRa. All rights reserved. */
declare(strict_types=1);

namespace MageRa\NewsletterEmailControls\Plugin;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Newsletter\Model\Subscriber;
use Magento\Store\Model\ScopeInterface;

class SuppressSubscriberEmails
{
    private const XML_PATH_ENABLED = 'magera_newsletter_email_controls/general/enabled';

    public function __construct(private readonly ScopeConfigInterface $scopeConfig) {}

    public function aroundSendConfirmationRequestEmail(Subscriber $subject, callable $proceed): mixed
    {
        return $this->isSuppressed('confirmation_request') ? $subject : $proceed();
    }

    public function aroundSendConfirmationSuccessEmail(Subscriber $subject, callable $proceed): mixed
    {
        return $this->isSuppressed('confirmation_success') ? $subject : $proceed();
    }

    public function aroundSendUnsubscriptionEmail(Subscriber $subject, callable $proceed): mixed
    {
        return $this->isSuppressed('unsubscribe') ? $subject : $proceed();
    }

    private function isSuppressed(string $emailType): bool
    {
        return $this->scopeConfig->isSetFlag(self::XML_PATH_ENABLED, ScopeInterface::SCOPE_STORE)
            && $this->scopeConfig->isSetFlag('magera_newsletter_email_controls/general/' . $emailType, ScopeInterface::SCOPE_STORE);
    }
}
