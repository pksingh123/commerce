<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* __string_template__c58f1de0cf0328d4ec1309fbed54e20b */
class __TwigTemplate_8cf92ccd021eb26b7995fdca7c7b506e extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
        ];
        $this->sandbox = $this->env->getExtension('\Twig\Extension\SandboxExtension');
        $this->checkSecurity();
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 1
        echo "<p>Payment added via <em>";
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["gateway"] ?? null), 1, $this->source), "html", null, true);
        echo "</em> for ";
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->extensions['Drupal\commerce_price\TwigExtension\PriceTwigExtension']->formatPrice($this->sandbox->ensureToStringAllowed(($context["amount"] ?? null), 1, $this->source)), "html", null, true);
        if (($context["method"] ?? null)) {
            echo " using <em>";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["method"] ?? null), 1, $this->source), "html", null, true);
            echo "</em>";
        }
        echo ". State: ";
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["state"] ?? null), 1, $this->source), "html", null, true);
        echo ".";
        if (($context["remote_id"] ?? null)) {
            echo "<br /> Transaction ID: ";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["remote_id"] ?? null), 1, $this->source), "html", null, true);
            echo ".";
        }
        echo "</p>";
    }

    public function getTemplateName()
    {
        return "__string_template__c58f1de0cf0328d4ec1309fbed54e20b";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  39 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "__string_template__c58f1de0cf0328d4ec1309fbed54e20b", "");
    }
    
    public function checkSecurity()
    {
        static $tags = array("if" => 1);
        static $filters = array("escape" => 1, "commerce_price_format" => 1);
        static $functions = array();

        try {
            $this->sandbox->checkSecurity(
                ['if'],
                ['escape', 'commerce_price_format'],
                []
            );
        } catch (SecurityError $e) {
            $e->setSourceContext($this->source);

            if ($e instanceof SecurityNotAllowedTagError && isset($tags[$e->getTagName()])) {
                $e->setTemplateLine($tags[$e->getTagName()]);
            } elseif ($e instanceof SecurityNotAllowedFilterError && isset($filters[$e->getFilterName()])) {
                $e->setTemplateLine($filters[$e->getFilterName()]);
            } elseif ($e instanceof SecurityNotAllowedFunctionError && isset($functions[$e->getFunctionName()])) {
                $e->setTemplateLine($functions[$e->getFunctionName()]);
            }

            throw $e;
        }

    }
}
