<?php declare(strict_types=1);

namespace PresProg\PasswordSuggestion;

use Contao\BackendTemplate;
use Contao\CoreBundle\Routing\ScopeMatcher;
use Contao\CoreBundle\ServiceAnnotation\Callback;
use Contao\CoreBundle\ServiceAnnotation\Hook;
use Contao\Widget;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Contracts\Translation\TranslatorInterface;

class PasswordSuggestion
{
    private RequestStack $requestStack;
    private ScopeMatcher $scopeMatcher;
    private TranslatorInterface $translator;
    private string $characters;
    private ?int $passwordLength;

    public function __construct(RequestStack $requestStack, ScopeMatcher $scopeMatcher, TranslatorInterface $translator, string $characters, ?int $passwordLength = null)
    {
        $this->requestStack   = $requestStack;
        $this->scopeMatcher   = $scopeMatcher;
        $this->translator     = $translator;
        $this->characters     = $characters;
        $this->passwordLength = $passwordLength;
    }

    /**
     * @Hook("parseWidget")
     */
    public function enhancePasswordWidget($buffer, Widget $widget)
    {
        if ($widget->type !== 'password' || !$this->scopeMatcher->isBackendRequest($this->requestStack->getCurrentRequest())) {
            return $buffer;
        }

        $template = new BackendTemplate('pws_password_suggestion');
        $template->setData([
            'widget'              => $widget,
            'characters'          => $this->characters,
            'passwordLength'      => $this->passwordLength ?? $widget->minlength,
            'generateButtonLabel' => $this->translator->trans('pws.generateButtonLabel', [], 'contao_default'),
        ]);

        return $buffer . $template->parse();
    }

    /**
     * @Callback(table="tl_user", target="config.onload")
     * @Callback(table="tl_member", target="config.onload")
     */
    public function addAssets(): void
    {
        if (!$this->scopeMatcher->isBackendRequest($this->requestStack->getCurrentRequest())) {
            return;
        }

        $GLOBALS['TL_JAVASCRIPT'][] = 'bundles/passwordsuggestion/pws.js';
        $GLOBALS['TL_CSS'][]        = 'bundles/passwordsuggestion/pws.css';
    }

}
